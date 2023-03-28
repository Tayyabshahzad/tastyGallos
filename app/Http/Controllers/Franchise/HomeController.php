<?php

namespace App\Http\Controllers\Franchise;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Option;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth()->user();
        $franchise = Franchise::where('user_id',$user->id)->first();
        $missingDetailsCounter = Franchise::where('user_id',$user->id)->where('bank','!=',null)->where('account_holder','!=',null)->where('branch','!=',null)->where('account_number','!=',null)->count();
        $orders = Order::select('id','type','danger','order_number','created_at')->
                  where('did_pay','!=',3)->
                  where('status','!=','delivered')->
                  where('status','!=','collected')->
                  where('status','!=','canc')->
                  where('status','!=','order')->
                  where('franchise_id',$franchise->id)->
                  withCount('orderProducts')->
                  withCount('bogoProducts')->
                  withCount('orderDealProduct')->get();
        if($request->ajax()){
            if($request->has('orderNumber')){
                $orders = Order::where('franchise_id', $franchise->id)->where('order_number',$request->orderNumber)->with('user')->orderby('id', 'desc')->get();
                return response([
                        'success' => true,
                        'orders' => $orders,
                ]);
            };
        }
        return view('franchise.dashboard',compact('franchise','missingDetailsCounter','orders'));
    }
    public function orderFilter(Request $request)
    {
        $user = Auth()->user();
        $franchise = Franchise::where('user_id',$user->id)->first();
        $missingDetailsCounter = Franchise::where('user_id',$user->id)->where('bank','!=',null)->where('account_holder','!=',null)->where('branch','!=',null)->where('account_number','!=',null)->count();
        if($request->color == 'red'){
             $currentTime = Carbon::now()->format('Y-m-d h:i:s');
            $orders = Order::select('danger','id','order_number','created_at')->where('did_pay','!=',3)->where('franchise_id',$franchise->id)->where('danger' ,'<' ,$currentTime)->withCount('orderProducts')->get();
        }else{
            $orders = Order::select('id','danger','order_number','created_at')->where('did_pay','!=',3)->where('franchise_id',$franchise->id)->withCount('orderProducts')->get();
        }
        return view('franchise.dashboard',compact('franchise','missingDetailsCounter','orders'));
    }
    public function realTimeDashboard()
    {
        $user = Auth()->user();
        $franchise = Franchise::where('user_id',$user->id)->first();
        $orders = Order::select('id','type','danger','order_number','created_at')->where('did_pay','!=',3)->where('status','order')->where('franchise_id',$franchise->id)->
        withCount('orderProducts')->
        withCount('bogoProducts')->
        withCount('orderDealProduct')->get();

        $firebase_api_key = Option::where('option_name', 'firebase_api_key')->first();
        $commission = Option::where('option_name', 'commission')->first();
        $database_url = Option::where('option_name', 'database_url')->first();
        $auth_domain = Option::where('option_name', 'auth_domain')->first();
        $project_id = Option::where('option_name', 'project_id')->first();
        $storage_bucket = Option::where('option_name', 'storage_bucket')->first();
        $messaging_sender_id = Option::where('option_name', 'messaging_sender_id')->first();
        $app_id = Option::where('option_name', 'app_id')->first();
        $measurement_id = Option::where('option_name', 'measurement_id')->first();



        return view('franchise.real-time-dashbaord',
                    compact('franchise',
                            'orders',
                            'commission',
                            'firebase_api_key',
                            'database_url',
                            'auth_domain',
                            'project_id',
                            'storage_bucket',
                            'messaging_sender_id',
                            'app_id','measurement_id'));
    }
}
