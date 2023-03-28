<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deal;
use App\Models\Franchise;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DealsController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()){
            $deals = Deal::withCount('products','franchises');
            return DataTables::of($deals)
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.deals.index');
    }
    public function create()
    {
        $franchises = Franchise::select('id','name')->where('status','active')->get();
        $categories = Category::get();
        $products = Product::where('status','active')->get();
        return view('admin.deals.create',compact('products','categories','franchises'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'price'=>'required',
            'product_name' => 'array',
            'product_name'=>'required',
            'product_id'=>'required',
            'product_quantity'=>'required',
            'franchises'=>'required',
        ]);
        $deal = new Deal;
        $deal->status = $request->status;
        $deal->title = $request->title;
        $deal->price = $request->price;
        $deal->description = $request->description;
        if ($deal->save()) {
            // Assigning Franchises
            $deal->franchises()->attach($request->franchises);
            if ($request->hasFile('photos')) {
                $fileAdders = $deal->addMultipleMediaFromRequest(['photos'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('deals');
            }); }


            $countProduct = count($request->product_id);
            for($i = 0; $i<$countProduct; $i++){
                $product = Product::find($request->product_id[$i]);
                $deal->products()->attach($product,['product_quantity' => $request->product_quantity[$i]]);
            }
            $deal->categories()->attach($request->categories);
            return redirect()->route('admin.deals.index')->with('success', 'Deal has been created successfully');
        } else {
            return redirect()->back()->with('error', 'Deal not created');
        }
    }


    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $deal = Deal::findOrfail($request->id);
        if ($deal->delete()) {
            // if ($request->hasFile('photos')) {
            //     $fileAdders = $deal->addMultipleMediaFromRequest(['photos'])
            // ->each(function ($fileAdder) {
            //     $fileAdder->toMediaCollection('photos');
            // }); }

           //$deal->products()->attach($request->products);
           return response(['success' => true, 'message' => 'Deal has been deleted successfully']);
        } else {
            return response(['success' => false, 'message' => 'Deal not deleted']);
        }
    }
    public function edit($id)
    {
        $categories = Category::get();
        $deal = Deal::findOrfail($id);
        $photos = $deal->getMedia('deals');
        $products = Product::where('status','active')->get();
        $assign_items = $deal->products->pluck('id')->toArray();
        $franchises = Franchise::select('id','name')->where('status','active')->get();
        $assign_franchises = $deal->franchises->pluck('id')->toArray();
        $categories = Category::where('status', 'active')->get();
        $assign_categories = $deal->categories->pluck('id')->toArray();

        return view('admin.deals.edit',compact('products','deal','photos','assign_items','categories','assign_categories','assign_franchises','franchises'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'id' => 'required',
            'product_name' => 'array',
            'product_name'=>'required',
            'product_id'=>'required',
            'product_quantity'=>'required',
            'franchises'=>'required',
        ]);

        $deal = Deal::findOrfail($request->id);

        $deal->status = $request->status;
        $deal->title = $request->title;
        $deal->price = $request->price;
        $deal->description = $request->description;

        $countProduct = count($request->product_id);

        if ($deal->save()) {
            if ($request->hasFile('photos')) {
                $fileAdders = $deal->addMultipleMediaFromRequest(['photos'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('deals');
            }); }
            $deal->franchises()->sync($request->franchises);
            $countProduct = count($request->product_id);
            for($i = 0; $i<$countProduct; $i++){
                $product = Product::find($request->product_id[$i]);
                $deal->products()->detach($request->product_id[$i]);
                $deal->products()->attach($product,['product_quantity' => $request->product_quantity[$i]]);
            }

            $deal->categories()->sync($request->categories);
            //$deal->products()->sync($request->products);
            return redirect()->route('admin.deals.index')->with('success', 'Deal has been updated successfully');
        } else {
            return redirect()->back()->with('error', 'Deal not update');
        }
    }

    public function deletePhoto(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'deal' => 'required',
        ]);
        $deal    = Deal::findOrFail($request->deal);
        $photos = $deal->getMedia('deals');
        $image = $photos->where('id',$request->id)->first();
        if($image->delete()){
            return response(['success' => true, 'message' => 'Deal photo been deleted successfully']);
        }else{
            return response(['success' => false, 'message' => 'Photo not deleted']);
        }
    }

    public function dealProductPrice(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $product    = Product::findorFail($request->id);
        return response([
                         'success' => true,
                          'product'=>$product]);
    }

    public function removeProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'deal_id' => 'required',
        ]);

        $product = Product::findorFail($request->product_id);
        $deal = Deal::findorFail($request->deal_id);
        $deal->products()->detach($product->id);
        return response([
                         'success' => true,
                         'message'=>'Product has been deleted']);
    }



}
