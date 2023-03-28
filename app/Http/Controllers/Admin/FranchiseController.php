<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\FranchiseCreateRequest;
use App\Http\Requests\FranchiseEdit;
use App\Mail\UpdatePassword;
use App\Models\BogoExtra;
use App\Models\BogoModifier;
use App\Models\DealExtra;
use App\Models\Franchise;
use App\Models\FranchiseWorkingHour;
use App\Models\Modifier;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderPromotion;
use App\Models\Product;
use App\Models\ProductStatus;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\SpecialPrice;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
class FranchiseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $franchises = Franchise::with('user')->orderby('id', 'desc');
            if ($request->has('status')) {
                if ($request->status == 'all') {
                    $franchises = Franchise::with('user');
                } else {
                    $franchises = Franchise::with('user')->where('status', $request->status);
                }

            }
            return Datatables::of($franchises)
                ->addIndexColumn()
                ->addColumn('userEmail', function (Franchise $franchise) {
                    return strtolower($franchise->user->email);
                })->make(true);
        }
        return view('admin.franchise.index');
    }
    public function create()
    {
        return view('admin.franchise.create');
    }
    public function save(FranchiseCreateRequest $request)
    {

        $request->validated();
        // $checkUserEmail = User::where('email', $request->admin_email)->orWhere('username',$request->username)->first();
        // if ($checkUserEmail != '' or $checkUserEmail != null) {
        //     return redirect()->back()->with('error', 'Franchise email or username already exists');
        // }
        // if ($checkUserEmail) {
        //     return redirect()->back()->with('error', 'Franchise email or username already exists');
        // }
        // // Check Franchise Name Exists.
        // $franchise = Franchise::select('id','name')->where('name',$request->franchise_name)->first();
        // if ($franchise) {
        //     return redirect()->back()->with('error', 'Franchise name already exists');
        // }

            DB::beginTransaction();
            try{
                $user = new User;
                $user->name = $request->admin_name;
                $user->email = $request->admin_email;
                $user->username = $request->username;
                $password = Str::random(20);
                $user->password = Hash::make($password);
                $user->status = 'inactive';
                $token = Crypt::encryptString($request->admin_name . ',' . $request->admin_email);
                $user->save();
                $user->assignRole('franchise');
                $franchise = new Franchise;
                $franchise->user_id = $user->id;
                $franchise->name = $request->franchise_name;
                $franchise->contact_phone = $request->franchise_phone;
                $franchise->contact_email = $request->contact_email;
                $franchise->vat = $request->franchise_vat;
                $franchise->address = $request->franchise_address;
                $franchise->delivery_charge = $request->delivery_charge;
                $franchise->lat = $request->lat;
                $franchise->lng = $request->lng;
                $franchise->estimated_time = $request->estimated_time;
                $franchise->payment_method = $request->payment_method;
                if ($request->pickup == 'yes') {
                    $franchise->pickup = true;
                } else {
                    $franchise->pickup = false;
                }
                if ($request->delivery == 'yes') {
                    $franchise->delivery = true;
                } else {
                    $franchise->delivery = false;
                }
                $franchise->about = $request->about_franchise;
                $franchise->busy_time = $request->busy_time;
                $franchise->free_time = $request->free_time;
                $franchise->status = 'active';
                $franchise->save();
                if ($request->hasFile('franchise_banner')) {
                    $franchise->addMediaFromRequest('franchise_banner')->toMediaCollection('franchise_banner');
                }
                $dayCount = count($request->opening_time);
                for ($i = 0; $i < $dayCount; $i++) {
                    $hours = new FranchiseWorkingHour;
                    $hours->franchise_id = $franchise->id;
                    $hours->day = $request['day'][$i];
                    $hours->code = $request['code'][$i];
                    if ($request['time_status'][$i] == 'open') {
                        $hours->opening_time = $request['opening_time'][$i];
                        $hours->closing_time = $request['closing_time'][$i];
                    }
                    $hours->status = $request['time_status'][$i];
                    $hours->save();
                }
                DB::commit();
                Mail::to($request->admin_email)->send((new UpdatePassword($user, $token))->afterCommit());
                return redirect()->route('admin.franchises')->with('success', 'Franchise has been created successfully');
            }catch(Exception $er){

                DB::rollBack();

                $er1062 = strstr( $er->getMessage(), '1062');//Duplicae Entry
                if($er1062){
                    return redirect()->back()->with('error', 'Username or email already exists')->withInput();
                }
                return redirect()->back()->with('error', 'Error while creating franchise')->withInput();

            }

    }
    public function edit($id)
    {

        $franchise = Franchise::with('workingHours','productSpecialPrice')->withCount('reviews','activePromotions')->find($id);
        $promotionCount = Promotion::where('on_all_franchises',true)->where('is_schedule',true)->count();
        $totalPromotions = ($promotionCount+$franchise->active_promotions_count);
        $orderCount = Order::where('franchise_id', $id)->where('did_pay','!=',3)->count();
        $productCount = Product::where('status', 'active')->count();
        $inActiveProductCount = SpecialPrice::where('franchise_id', $id)->where('status', 'inactive')->count();
        $todaySales = Order::where('franchise_id', $id)->where('created_at', '2022-02-28 09:49:53')->where('did_pay', '!=', 3)->sum('total');
        $earningToday = Order::where('franchise_id', $id)->where('order_date', Carbon::now()->format('Y-m-d'))->where('did_pay', '!=', 3)->sum('total');
        $activePromotions = Order::where('franchise_id', $id)->where('order_date', Carbon::now()->format('Y-m-d'))->where('did_pay', '!=', 3)->sum('total');
        $avgRating = Review::where('franchise_id', $id)->avg('rating');
        $GLOBALS['my_fracnhise_id']  = $id;
         $products = Product::with('promotions')->with(array('specialPrice' => function ($q) {
            $q->where('franchise_id',$GLOBALS['my_fracnhise_id']);
        }))->with(array('productStatus'=>function($q){
            $q->where('franchise_id',$GLOBALS['my_fracnhise_id']);
        }))->get();


        return view('admin.franchise.edit', compact('totalPromotions','franchise', 'orderCount', 'productCount', 'todaySales', 'earningToday', 'activePromotions', 'avgRating', 'inActiveProductCount', 'products'));
    }
    public function update(FranchiseEdit $request)
    {

        $request->validated();
        $franchise = Franchise::findOrFail($request->edit_id);
        $franchise->name = $request->franchise_name;
        $franchise->contact_phone = $request->franchise_phone;
        $franchise->contact_email = $request->contact_email;
        $franchise->vat = $request->franchise_vat;
        $franchise->address = $request->franchise_address;
        $franchise->delivery_charge = $request->delivery_charge;
        $franchise->about = $request->about_franchise;
        $franchise->busy_time = $request->busy_time;
        $franchise->free_time = $request->free_time;
        $franchise->lat = $request->lat;
        $franchise->lng = $request->lng;
        $franchise->estimated_time = $request->estimated_time;
        $franchise->bank =  $request->bank;
        $franchise->account_holder =  $request->account_holder;
        $franchise->branch =  $request->branch;
        $franchise->payment_method =  $request->payment_method;
        $franchise->account_number =  $request->account_number;
        // $franchise->franchiseTimings = $request->franchiseTimings;
        if ($request->pickup == 'yes') {
            $franchise->pickup = true;
        } else {
            $franchise->pickup = false;
        }
        if ($request->delivery == 'yes') {
            $franchise->delivery = true;
        } else {
            $franchise->delivery = false;
        }
        foreach ($request->workingHourId as $item => $v) {
            $data = array(
                'opening_time' => $request->opening_time[$item],
                'closing_time' => $request->closing_time[$item],
                'status' => $request->time_status[$item],
            );
            $workingHours = FranchiseWorkingHour::where('id', $request->workingHourId[$item])->first();
            $workingHours->update($data);
        }
        if ($franchise->save()) {
            if ($request->hasFile('franchise_banner')) {
                $franchise->clearMediaCollection('franchise_banner');
                $franchise->addMediaFromRequest('franchise_banner')->toMediaCollection('franchise_banner');
            }
            $user = User::select('id','name')->where('id',$request->user_id)->first();
            $user->name = $request->admin_name;
            if ($user->save()) {
                return redirect()->route('admin.franchises.edit', $franchise->id . '#tab_2')->with('success', 'Franchise has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'Franchise not updated');
            }
        }
    }
    public function delete(Request $request)
    {
        $request->validate([
            'delete_id' => 'required',
        ]);
        $franchise = Franchise::with('user')->findOrFail($request->delete_id);
        $user = User::findOrFail($franchise->user->id);
        if ($user->delete()) {
            $franchise->delete();
            return redirect()->route('admin.franchises')->with('success', 'Franchise with user has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Franchise not deleted');
        }
    }
    public function passwordReset(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'same:password_confirmation',
            'status' => 'required',
            'franchiseId' => 'required',
            'email' => 'required',
        ]);

        $user = User::findOrFail($request->id);
        $franchise = Franchise::findOrFail($request->franchiseId);

        if ($request->password == '') {
            $password = $user->password;
        } else {
            $password = Hash::make($request->password);
        }
        $user->password = $password;
        $user->email = $request->email;
        $user->status = $request->status;
        if ($user->save()) {

            $franchise->status = $request->status;
            $franchise->save();
            return response(['success' => true, 'message' => 'Record has been updated successfully']);
        } else {
            return response(['success' => false, 'message' => 'Record not updated']);
        }
    }
    public function orderDetails(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        //return  $order = Order::where('id',$request->id)->where('did_pay','!=',3)->first();
        $order = Order::
                  where('id', $request->id)->
                  with('user','review',
                        'orderExtras', 'orderExtras.extra',
                        'orderDeals','orderDeals.deal','orderDealProduct','orderDealProduct.product','orderDealProduct.dealExtras','orderDealProduct.dealExtras.extra','orderDealProduct.dealModifiers','orderDealProduct.dealModifiers.item',
                        'bogoProducts','bogoProducts.product','bogoProducts.freeProduct','bogoProducts.bogoModifiers','bogoProducts.bogoModifiers.modifier')->
                  first();


                //   $order = Order::
                //   where('id', $request->id)->
                //   with('user',
                //         'orderExtras', 'orderExtras.extra',
                //         'orderDealProduct','orderDealProduct.product','orderDealProduct.dealExtras','orderDeals','orderDeals.deal','orderDeals.deal.products','orderDealsExtra','orderDealsExtra.extra','orderDealsModifiers','orderDealsModifiers.modifier','orderDealsModifiers.item',
                //         'bogoProducts','bogoProducts.product','bogoProducts.freeProduct','bogoProducts.bogoModifiers','bogoProducts.bogoModifiers.modifier')->
                //   first();

        $orderPromotions = OrderPromotion::where('order_id', $order->id)->with('promotion', 'promotion.buyProduct', 'promotion.getProduct')->get();
        $orderProducts = OrderProduct::where('order_id', $request->id)->with('product', 'items', 'items.product', 'product.promotions')->get();
        $itemsTotal = OrderProduct::where('order_id', $request->id)->with('product')->with(['items'])->sum('price');
        $totalAmount = ($itemsTotal + $order->total);
        return response([
            'orderProducts' => $orderProducts,
            'order' => $order,
            'itemsTotal' => $itemsTotal,
            'total' => $totalAmount,
            'promotions' => $orderPromotions,

        ]);
    }
    public function allOrders(Request $request)
    {
        $id = $request->franchiseId;
        $orders = Order::where(function ($query) use ($id) {
            $query->where('did_pay', '!=', 3);
            $query->where('franchise_id', '=', $id);
        })->where('franchise_id', $request->franchiseId)->with('user', 'review')->orderBy('id', 'desc');
        if ($request->has('order_from_date') && $request->has('order_to_date')) {
            $fromDate = Carbon::parse($request->order_from_date)->startOfDay();
            $toDate = Carbon::parse($request->order_to_date)->endOfDay();
            $orders->whereBetween('created_at', [$fromDate, $toDate]);
        }
        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('time_ago', function ($allorders) {
                return Carbon::parse($allorders['created_at'])->format('d-M-Y h:i:s A');
            })
            ->make(true);
    }
    public function specialPrice(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'franchise_id' => 'required',
            'specialPrice' => 'required',
        ]);


        $specialPrice = SpecialPrice::where('product_id', $request->product_id)->where('franchise_id', $request->franchise_id)->first();
        if ($specialPrice) {
            $specialPrice->price = $request->specialPrice;
            $specialPrice->save();
        } else {

            $newSpcialPrice = new SpecialPrice;
            $newSpcialPrice->product_id = $request->product_id;
            $newSpcialPrice->franchise_id = $request->franchise_id;
            $newSpcialPrice->price = $request->specialPrice;
            $newSpcialPrice->status = 'active';
            $newSpcialPrice->save();
        }
        // SpecialPrice::updateOrCreate(
        //     ['product_id' => $request->product_id, 'franchise_id' => $request->franchise_id],
        //     ['price' => $request->specialPrice]
        // );
        return response(['success' => true, 'message' => 'Special price has been updated successfully']);
    }
    public function updateSpecialPrice(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'price' => 'required',
        ]);

        $specialPrice = SpecialPrice::findOrfail($request->product_id);
        $specialPrice->price = $request->price;
        $specialPrice->save();
        return response(['success' => true, 'message' => 'Special price has been updated successfully']);
    }
    public function productStatus(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'status' => 'required',
            'franchise_id' => 'required',
        ]);
        $product = ProductStatus::where('product_id', $request->product_id)->where('franchise_id', $request->franchise_id)->first();
        if ($product) {
            if ($product->status == 'inactive') {
                $product->status = 'active';
            } else if ($product->status == 'active') {
                $product->status = 'inactive';
            }
        } else {
            $product = new ProductStatus;
            $product->product_id = $request->product_id;
            $product->franchise_id = $request->franchise_id;
            $product->status = 'inactive';
        }
        $product->save();
        // SpecialPrice::updateOrCreate(
        //     ['product_id' => $request->product_id, 'franchise_id' => $request->franchise_id],
        //     ['status' => $request->status]
        // );
        return response(['success' => true, 'message' => 'Product status has been updated successfully']);
    }
    public function removePrice(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);
        $specialPrice = SpecialPrice::findOrfail($request->product_id);
        if ($specialPrice->delete()) {
            return response(['success' => true, 'message' => 'Special price has been removed']);
        } else {
            return response(['success' => false, 'message' => 'Special price not removed']);
        }
    }
    public function activeOrders(Request $request)
    {
        $id = $request->franchiseId;
        $orders = Order::where(function ($query) use ($id) {
            $query->where('did_pay', '!=', 3);
            $query->where('franchise_id', '=', $id);
            $query->where('status', '!=', 'collected');
            $query->where('status', '!=', 'delivered');
        })->where('franchise_id', $request->franchiseId)->with('user')->orderBy('id', 'desc');

        if ($request->has('orderType')) {
            if ($request->orderType != 'all') {
                $orders->where('type', $request->orderType);
            }
        }
        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('time_ago', function ($activeOrders) {
                return Carbon::parse($activeOrders['created_at'])->format('d-M-Y h:i:s A');
            })
            ->make(true);
    }
    public function modifiers(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $product = Product::find($request->id);
        $assign_modifiers = $product->modifierGroups;
        return response([
            'modifiers' => $assign_modifiers,
        ]);
    }
    public function modifiersItem(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
        ]);
        $items = Modifier::findOrFail($request->group_id);
        return response([
            'modifiers_items' => $items->products,
        ]);
    }
    public function getProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);
        $product = Product::select('id', 'name')->where('id', $request->product_id)->first();
        return response([
            'product' => $product,
        ]);

    }
    public function orderExtras(Request $request)
    {
        $request->validate([
            'extra_id' => 'required',
        ]);

         $mainExtras = BogoExtra::where('bogo_product_id',$request->extra_id)->with('extra')->get();
        return response([
            'extra_products' => $mainExtras,
        ]);

    }
    public function orderBogoModifier(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
        ]);

        $bogoOrderModifiers = BogoModifier::where('order_id',$request->order_id)->with('bogoModifier','item')->get();
        return response([
            'bogoOrderModifiers' => $bogoOrderModifiers,
        ]);

    }

    public function orderDealExtra(Request $request)
    {
        $request->validate([
            'order_deal_product_id' => 'required',
        ]);

        $deal_extras = DealExtra::where('order_deal_product_id',$request->order_deal_product_id)->with('extra')->get();
        return response([
            'dealExtras' => $deal_extras,
        ]);

    }




}
