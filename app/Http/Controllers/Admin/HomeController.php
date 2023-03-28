<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Order;
use App\Models\Product;
use App\Models\SpecialPrice;
use App\Models\User;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        if(!$request->ajax()){
            $lastOrders = Order::where('did_pay','!=',3)->with(['user','franchise'])->orderBy('id','desc')->take(5)->get();
            $totalOrders = Order::where('did_pay','!=',3)->count();
            $totalCustomers = User::role('customer')->count();
            $totalProducts = Product::where('status','active')->count();
            $totalActiveProducts = Product::where('status','active')->count();
            $adminCommission = Order::where('did_pay','!=',3)->sum('admin_commission');
            $franchise_earning = Order::where('did_pay','!=',3)->sum('total');
            $franchises = Franchise::where('status','active')->get();
            $specialPrice = Product::where('status','inactive')->count();

        }else{
            if($request->franchsie == 0){
                $lastOrders = Order::where('did_pay','!=',3)->with(['user','franchise'])->orderBy('id','desc')->take(5)->get();
                $totalOrders = Order::where('did_pay','!=',3)->count();
                $adminCommission = Order::where('did_pay','!=',3)->sum('admin_commission');
                $franchise_earning = Order::where('did_pay','!=',3)->sum('total');
                $totalActiveProducts = Product::where('status','active')->count();
                $specialPrice = Product::where('status','inactive')->count();
               // $adminCommison->where('franchise_id',$request->franchsie);
                //$orderTotalAmount->where('franchise_id',$request->franchsie);
            }else{

                $specialPrice = SpecialPrice::where('franchise_id', '=', $request->franchsie)->where('status','inactive')->count();
                $lastOrders = Order::where('did_pay','!=',3)->with(['user','franchise'])->where('franchise_id',$request->franchsie)->orderBy('id','desc')->take(5)->get();
                $totalOrders = Order::where('did_pay','!=',3)->where('franchise_id',$request->franchsie)->count();
                $adminCommission = Order::where('did_pay','!=',3)->where('franchise_id',$request->franchsie)->sum('admin_commission');
                $franchise_earning = Order::where('did_pay','!=',3)->where('franchise_id',$request->franchsie)->sum('total');
                $totalActiveProducts = Product::where('status','active')->count();
               // $adminCommison->where('franchise_id',$request->franchsie);
                //$orderTotalAmount->where('franchise_id',$request->franchsie);
            }

        }
        if($request->ajax()){
            $response = [
                'lastOrders' => $lastOrders,
                'totalOrders' => $totalOrders,
                'adminCommission' => $adminCommission,
                'franchise_earning' => $franchise_earning,
                'totalActiveProducts'=> $totalActiveProducts,
                'specialPrice'=>$specialPrice
            ];
            return response()->json($response);
        }
        return view('admin.dashboard',compact('lastOrders','adminCommission','totalOrders','totalCustomers','totalProducts','franchise_earning','franchises','totalActiveProducts','specialPrice'));
    }

    public function realTimeDashboard()
    {
        return view('franchise.real-time-dashbaord');
    }



}
