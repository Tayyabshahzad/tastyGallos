<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Refund;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
class RefundController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $refunds = Refund::with('user','order')->orderBy('id','desc');
            return DataTables::of($refunds)
                ->addIndexColumn()
                ->addColumn('orderNumber',function($refunds){
                    return $refunds->order->order_number;
                })
                ->addColumn('totalAmount',function($refunds){
                    return $refunds->order->grandTotal;
                })
                ->addColumn('user',function($refunds){
                    return $refunds->user->name;
                })
                ->make(true);
        }
       return view('franchise.refund.index');
    }
    public function search(Request $request)
    {
            if($request->ajax()){
                $orders = Order::select('id','order_number','franchise_id')->
                where('did_pay','!=',3)->
                where('franchise_id',$request->franchise_id)->
                where('order_number',$request->search)->
                get();
                return response([
                    'success'=>true,
                    'orders' =>$orders,
                ]);
            }
    }

    public function orderDetails(Request $request)
    {
            if($request->ajax()){
                $id = $request->id;
                $order = Order::select('id','order_number','user_id','order_date','franchise_id')->where('did_pay','!=',3)->where('id',$id)->with('user')->first();
                $products = OrderProduct::where('order_id',$order->id)->with('product')->get();
                return response([
                    'success'=>true,
                    'order' =>$order,
                    'products' =>$products,

                ]);
            }
    }


    public function create()
    {
       $user = Auth::user();
       $franchise = $user->franchise->id;
       return view('franchise.refund.create',compact('franchise'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'order_id' => 'required|unique:refunds,order_id',
            'franchise_id' => 'required',
            'user_id' => 'required',
            'reason' => 'required',
        ]);
        $refund  = new Refund;
        $refund->order_id = $request->order_id;
        $refund->franchise_id = $request->franchise_id;
        $refund->user_id = $request->user_id;
        $refund->reason = $request->reason;
        $refund->status = 'pending';
        $refund->date = Carbon::now()->format('Y-m-d');
        $refund->save();
        return redirect()->route('franchise.refunds')->with('success','Refund request has been submited successfully');
    }

    public function refundOrderDetail(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'refund' => 'required',
        ]);
        $refund = Refund::findOrFail($request->refund);
        $orderProducts =  OrderProduct::where('order_id', $request->id)->with('product', 'items', 'items.product')->get();
        $itemsTotal =      OrderProduct::where('order_id', $request->id)->with('product')->with(['items'])->sum('price');
        $order = Order::where('id',$request->id)->where('did_pay','!=',3)->with('user')->first();
        $totalAmount = ($itemsTotal+$order->total);
        return response([
                    'orderProducts' => $orderProducts,
                    'order'=> $order,
                    'itemsTotal'=> $itemsTotal,
                    'total' => $totalAmount,
                    'refund'=>$refund,
        ]);
    }

    public function delete(Request $request)
    {
        $refund =  Refund::findOrFail($request->id);
        if ($refund->delete()) {
            return response(['success' => true, 'message' => 'Refund request has been deleted successfully']);
        } else {
            return response(['success' => false, 'message' => 'Refund request not deleted']);
        }
    }




    }
