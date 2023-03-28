<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class notificationController extends Controller
{
    public function allow()
    {
        return view('allowNotification');
    }
    public function storeToken(Request $request)
    {
         auth()->user()->update(['order_notification'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }

    public function markNotification(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'value' => 'required',
            //'notification' => 'required',
        ]);
        $order = Order::select('id','status')->where('id',$request->order_id)->first();
        if($request->value == 'approve'){
            $order->status = 'preparation';
        }else if($request->value == 'decline'){
            $order->status = 'cancelled';
        }
        if($order->save()){
            auth()->user()->unreadNotifications->markAsRead();
            return response([
                'success'=>true,
                'order'=>$order,
                'message'=>'Order status changed to '.$order->status,

            ]);
        }

        //return view('allowNotification');
    }
    public function sound()
    {
        $arr=array("sound"=>"yes1");
        return response([
            'data' => $arr,
            'success'=> true,
        ]);

    }
}
