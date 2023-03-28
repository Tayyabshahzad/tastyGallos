<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\PromotionBanner;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $promotions = Promotion::orderby('id','desc');
            return Datatables::of($promotions)
            ->addIndexColumn()
            ->addColumn('statEnd',function($promotions){
                $startDate =   Carbon::parse($promotions->start_date_time)->format('d-m-Y');
                $endDate = Carbon::parse($promotions->end_date_time)->format('d-m-Y');
                return $startDate . ' <i class="fas fa-arrows-alt-h"></i> ' . $endDate;

            })
            ->addColumn('promotionStatus',function($promotions){

                    $startDate =   Carbon::parse($promotions->start_date_time)->startOfDay();
                    $endDate =     Carbon::parse($promotions->end_date_time)->endOfDay();
                    $today = Carbon::now();
                    if($promotions->isCanceled == true){
                        return 4;
                    }else{

                        if($today->greaterThanOrEqualTo(Carbon::parse($startDate)) and $today->lessThanOrEqualTo(Carbon::parse(($endDate))) ){
                            return 1; //scheduled
                        }elseif($today->greaterThan(Carbon::parse($endDate))){
                            return 2; //completed
                        }elseif($today->lessThan(Carbon::parse($startDate))){
                            return 3;//pending
                        }
                    }


                    // if($startDate->greaterThanOrEqualTo($today)){
                    //     return 'Sch';
                    // }else{
                    //     return '11';
                    // }
                    // if($today->gt($endDate)){
                    //     return "completed";
                    // }elseif($today->lt($endDate)){
                    //     return "pending";
                    // }
                    // if($today > $startDate){
                    //     return 'completed';
                    // }

            })
            ->rawColumns(['promotionStatus','statEnd'])
            ->make(true);
        }
       return view('admin.promotion.index');
    }

    public function create()
    {
        $products = Product::where('status','active')->get();
        $franchises = Franchise::where('status','active')->get();
        return view('admin.promotion.create',compact('franchises','products'));
    }

    public function store(Request $request)
    {
        //this
        $request->validate([
            'type' => 'required',
            'buy_product_id' => 'integer:',
            'get_product_id'=>'integer',
            'start_date_time' => 'required',
            'end_date_time' => 'required',
            'status'=>'required',

        ]);
        //dd($request->start_date_time);
        $today = Carbon::now()->startOfDay();
        $startDate =  Carbon::parse($request->start_date_time)->startOfDay();
        $endDate   =  Carbon::parse($request->end_date_time)->startOfDay();
        if($startDate->lt($today)){
            return redirect()->back()->with('error','Start date must equal or grater then today');
        }

        if($endDate->lt($startDate)){
            return redirect()->back()->with('error','End date must be  grater then start date');
        }

        if($request->franchises == null){
            $on_all_franchises = true;
        }else{
            $on_all_franchises = false;
        }
        $promotion = new Promotion;
        $promotion->status = $request->status;
        $promotion->end_date_time = $request->end_date_time;
        $promotion->start_date_time = $request->start_date_time;
        $promotion->discount_type = $request->discountType;
        $promotion->on_all_franchises = $on_all_franchises;
        $promotion->type = $request->type;
        if($request->type == 'bogo') {
            $promotion->buy_product_id = $request->buy_product_id;
            $promotion->get_product_id = $request->get_product_id;
        }
        if($request->discountType == 'percentage'){
            $promotion->amount = $request->percentage;
        }elseif($request->discountType == 'amount'){
            $promotion->amount = $request->amount;
        }
        if($promotion->save()){
            $today = Carbon::now()->format('Y-m-d');
            if($promotion->start_date_time == $today){
                $promotion->is_schedule = true;
            }else{
                $promotion->is_schedule = false;
            }
            $promotion->save();
            $photo = 'Promotion-'.$promotion->id.'.'.$request->promotion_photo->extension();
            $promotion->addMediaFromRequest('promotion_photo')->usingName($photo)->toMediaCollection('promotions');

            if( $promotion->on_all_franchises == false){
                $promotion->franchises()->attach($request->franchises);
            }else{
                $franchises = Franchise::select('id')->get();
                foreach($franchises as $franchise){
                    $promotion->franchises()->attach($franchise->id);
                }
            }
            if( $promotion->type == 'discount'){
                $promotion->products()->attach($request->products_on_discount);
            }elseif($promotion->type == 'bogo')
            {
                $promotion->products()->attach($request->buy_product_id,['free_product'=>$request->get_product_id]);
            }
            return redirect()->route('admin.promotions')->with('success','Promotion has been created successfully');
        }
        return redirect()->back()->with('error','There is an error while creating promotion');
    }


    function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $promotion =  Promotion::findOrFail($request->id);
        if($promotion->delete()){
            $promotion->clearMediaCollection('promotion_photo');
            return response(['success' => true,'message' => 'Promotion has been deleted successfully']);
        }else{
            return response(['success' => false,'message' => 'Promotion not deleted']);

        }
    }

    function inactive(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $promotion =  Promotion::findOrFail($request->id);
        $promotion->status = 'inactive';
        $promotion->is_schedule = false;
        if($promotion->save()){
            return response(['success' => true,'message' => 'Promotion deactivated successfully']);
        }else{
            return response(['success' => false,'message' => 'Promotion not deactivated']);

        }
    }

    public function edit($id)
    {
        $promotion =  Promotion::findOrFail($id);
        $products = Product::where('status','active')->get();
        $franchises = Franchise::where('status','active')->get();
        $discountedProducts = $promotion->products->pluck('id')->toArray();
        $assignFranchises = $promotion->franchises->pluck('id')->toArray();

       return view('admin.promotion.edit',compact('promotion','products','franchises','discountedProducts','assignFranchises'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'edit_id' => 'required',

        ]);

        $startDate =  Carbon::parse($request->start_date_time)->startOfDay();
        $endDate   =  Carbon::parse($request->end_date_time)->startOfDay();
        $today = Carbon::now()->startOfDay();
        if($startDate->lt($today)){
            return redirect()->back()->with('error','Start date must equal or grater then today');
        }
        if($endDate->lt($startDate)){
            return redirect()->back()->with('error','End date must be  grater then start date');
        }
        $promotion =  Promotion::findOrFail($request->edit_id);
        if($request->franchises == null){
            $on_all_franchises = true;
        }else{
            $on_all_franchises = false;
        }
        $promotion->status = $request->status;
        $promotion->end_date_time = $request->end_date_time;
        $promotion->start_date_time = $request->start_date_time;
        $promotion->on_all_franchises = $on_all_franchises;
        $promotion->type = $request->type;

        if($request->type == 'bogo') {
            $promotion->buy_product_id = $request->buy_product_id;
            $promotion->get_product_id = $request->get_product_id;
            $promotion->discount_type = null;
            $promotion->amount = null;
        }
        if($request->type == 'discount'){
             $promotion->buy_product_id = null;
             $promotion->get_product_id = null;
             if($request->discountType == 'percentage'){

                $promotion->discount_type = 'percentage';
                $promotion->amount = $request->percentage;

             }elseif($request->discountType == 'amount'){

                $promotion->discount_type = 'amount';
                $promotion->amount = $request->amount;
             }
        }

        if($promotion->save()){
            if($request->has('promotion_photo')){
               $promotion->clearMediaCollection('promotions');
               $photo = 'Promotion-'.$promotion->id.'.'.$request->promotion_photo->extension();
               $promotion->addMediaFromRequest('promotion_photo')->usingName($photo)->toMediaCollection('promotions');
            }
            if( $promotion->on_all_franchises == false){
                $promotion->franchises()->sync($request->franchises);
            }else{
                $promotion->franchises()->detach($request->franchises);
            }
            if( $promotion->type = 'discount'){
                $promotion->products()->sync($request->products_on_discount);
            }

            $today = Carbon::now()->format('Y-m-d');
            if($promotion->start_date_time == $today){
                $promotion->is_schedule = true;
            }else{
                $promotion->is_schedule = false;
            }
            $promotion->save();


            return redirect()->route('admin.promotions')->with('success','Promotion has been updated successfully!');
        }
            return redirect()->back()->with('error','There is an error while updating promotion.');

    }

    public function view($id)
    {
          $promotion =  Promotion::with('products','buyProduct','getProduct')->findOrFail($id);
         return view('admin.promotion.view',compact('promotion'));

    }

    public function banners()
    {
        $banners =  PromotionBanner::get();
        return view('admin.promotion.banner',compact('banners'));

    }


    public function bannersCreate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'banner' => 'required',
        ]);
        $banner = new PromotionBanner;
        $banner->title =  $request->title;
        $banner->status =  'active';
        $banner->save();
        if ($request->hasFile('banner')) {

            $fileAdders = $banner->addMultipleMediaFromRequest(['banner'])
        ->each(function ($fileAdder) {
            $fileAdder->toMediaCollection('promotion_banners');
        }); }
        return redirect()->back()->with('success','Promotion banner been added successfully!');
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'value'=> 'required',
        ]);
        $promotion =  Promotion::findOrFail($request->id);
        if($request->value == 'active'){
            $promotion->isCanceled = false;
            $promotion->is_schedule = true;
        }else if($request->value == 'inactive'){
            $promotion->isCanceled = true;
            $promotion->is_schedule = false;
        }
         $promotion->save();

        return response(['success' => true,
                        'value'=> $promotion->isCanceled,
                        'message' => 'Promotion status has been updated']);
    }

    public function bannersDelete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $promotion =  PromotionBanner::findOrFail($request->id);
        if($promotion->delete()){
            $promotion->clearMediaCollection('banner');
            return response(['success' => true,'message' => 'Promotion banner has been deleted successfully']);
        }else{
            return response(['success' => false,'message' => 'Promotion banner not deleted']);

        }
    }






}
