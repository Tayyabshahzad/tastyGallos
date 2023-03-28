<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\BogoExtra;
use App\Models\BogoModifier;
use App\Models\Franchise;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderPromotion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FranchiseController extends Controller
{
    public function orders(Request $request)
    {
        $user = Auth()->user();
        $franchise = Franchise::select('id')->where('user_id', $user->id)->first();
        $orders = Order::where('did_pay', '!=', 3)->where('franchise_id', $franchise->id)->with('user')->orderby('id', 'desc');
        if ($request->ajax()) {
            if ($request->has('orderType')) {
                if ($request->orderType != '*') {
                    $orders = Order::where('did_pay', '!=', 3)->where('franchise_id', $franchise->id)->with('user')->where('type', $request->orderType)->orderby('id', 'desc');
                }
            }
            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('created_at', function ($orders) {
                    return Carbon::parse($orders['created_at'])->format('d-M-Y h:i:s A');
                })
                ->make(true);
        }
        return view('franchise.orders');
    }
    public function orderDetail(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        //$orderProducts =  OrderProduct::where('order_id', $request->id)->with('product', 'items', 'items.product')->get();
        //   $itemsTotal =      OrderProduct::where('order_id', $request->id)->with('product')->with(['items'])->sum('price');
        // $order = Order::where('did_pay','!=',3)->where('id',$request->id)->with('user')->first();
        //   $totalAmount = ($itemsTotal+$order->total);
        // return response([
        //             'orderProducts' => $orderProducts,
        //             'order'=> $order,
        //             'itemsTotal'=> $itemsTotal,
        //             'total' => $totalAmount,
        // ]);

        //return  $order = Order::where('id',$request->id)->where('did_pay','!=',3)->first();

        // $order = Order::where('did_pay','!=',3)->where('id',$request->id)->with('user','orderExtras','orderExtras.extra')->first();

        $order = Order::
            where('id', $request->id)->
            with('user',
            'orderExtras', 'orderExtras.extra',
            'orderDeals', 'orderDeals.deal', 'orderDeals.deal.products', 'orderDealsExtra', 'orderDealsExtra.extra', 'orderDealsModifiers', 'orderDealsModifiers.modifier', 'orderDealsModifiers.item',
            'bogoProducts', 'bogoProducts.product', 'bogoProducts.freeProduct', 'bogoProducts.bogoModifiers', 'bogoProducts.bogoModifiers.modifier')->
            first();

        $orderPromotions = OrderPromotion::where('order_id', $order->id)->with('promotion', 'promotion.buyProduct', 'promotion.getProduct')->get();
        $orderProducts = OrderProduct::where('order_id', $order->id)->with('product', 'items', 'items.product', 'product.promotions')->get();
        $itemsTotal = OrderProduct::where('order_id', $order->id)->with('product')->with(['items'])->sum('price');
        $totalAmount = ($itemsTotal + $order->total);
        return response([
            'orderProducts' => $orderProducts,
            'order' => $order,
            'itemsTotal' => $itemsTotal,
            'total' => $totalAmount,
            'promotions' => $orderPromotions,
        ]);

    }

    public function orderFilter(Request $request)
    {
        $request->validate([
            'ordertype' => 'required',
            'franchise_id' => 'required',
        ]);

        $sales = Order::where('did_pay', '!=', 3)->sum('total');
        if ($request->has('to_date') && $request->has('from_date')) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();

            if ($request->franchise == '0' && $request->orderType == '0') {
                $sales = Order::where('did_pay', '!=', 3)->whereBetween('created_at', [$fromDate, $toDate])->sum('total');
            } else if ($request->franchise == '0') {
                $sales = Order::where('did_pay', '!=', 3)->where('type', $request->orderType)->whereBetween('created_at', [$fromDate, $toDate])->sum('total');
            } elseif ($request->orderType == '0') {
                $sales = Order::where('did_pay', '!=', 3)->where('franchise_id', $request->franchise)->whereBetween('created_at', [$fromDate, $toDate])->sum('total');
            } else {
                $sales = Order::where('did_pay', '!=', 3)->where('franchise_id', $request->franchise)->where('type', $request->orderType)->whereBetween('created_at', [$fromDate, $toDate])->sum('total');
            }

            //$sales->where('franchise_id',$request->franchise);
        }

        return $sales;
    }

    public function changeOrderStatus(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
        $order = Order::with('user')->findOrFail($request->id);
        $user = User::select('notification_token', 'id')->findOrFail($order->user_id);
        $token = $user->notification_token;
        $currentStatus = $order->status;
        $newStatus = $request->status;
        if ($currentStatus == $newStatus) {
            return response([
                'success' => false,
                'message' => 'Status "' . ucfirst($request->status) . '" is already set please select new status',
            ]);
        }
        if ($request->status == 'dp') {
            $orderType = $order->type;
            if ($orderType == 'pickup') {
                $order->status = 'pickup';
            } else {
                $order->status = 'delivery';
            }
        }
        if ($request->status == 'dc') {
            $orderType = $order->type;
            if ($orderType == 'pickup') {
                $order->status = 'collected';
            } else {
                $order->status = 'delivered';
            }
        }
        if ($request->status != 'dc' and $request->status != 'dp') {
            $order->status = $request->status;
        }
        $orderDetails = '{ "order_id":' . $order->id . ',"order_status":"' . $order->status . '","notification_type":"order status changed"}';
        $orderToJson = json_decode($orderDetails, true);
        if ($order->save()) {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = [$user->notification_token];
            $appToken = Option::where('option_name', 'app_firebase_server_key')->first();
            $serverKey = $appToken->option_value;
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => "Order #".$order->order_number,
                    "body" => "Order status has been updated to ".$order->status,
                    "sound"=>"default"
                ],
                "data" => [
                    "order_status" => $order->status,
                    "notification_type" => 'order status changed',
                    "order_id" => $order->id,
                    "order_number" => $order->order_number,
                ],
            ];
            $encodedData = json_encode($data);
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            $result = curl_exec($ch);
            if ($result === false) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);

        }

        return response([
            'success' => true,
            'order' => $order->status,
            'message' => 'Order status changed to "' . ucfirst($request->status) . '" ',
        ]);
    }

    public function orderCancel(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ]);
        $order = Order::with('user')->findOrFail($request->id);
        $user = User::select('notification_token', 'id')->findOrFail($order->user_id);
        $token = $user->notification_token;
        $currentStatus = $order->status;
        $newStatus = $request->status;
        $order->status = 'cancelled';
        if ($order->save()) {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = [$user->notification_token];
            $serverKey = 'AAAAfexbmoo:APA91bE5VzPqQqF_U1CIgYTV2mk_q-SmW6veR4w1pF2IYH6Jw1WoFqsQ8VN7mQcJOqyaAinByslgyvSy8JDABeXCuyn1rNegjk8MTwEFck97uaf1AD9aBFPQdsNVkbFExdKeON6VaYyp';
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => "Order #".$order->order_number,
                    "body" => "Order status has been updated to ".$order->status,
                    "sound"=>"default"
                ],
                "data" => [
                    "order_status" => $order->status,
                    "notification_type" => 'order status changed',
                    "order_id" => $order->id,
                    "order_number" => $order->order_number,
                ],
            ];
            $encodedData = json_encode($data);
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            $result = curl_exec($ch);
            if ($result === false) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);

        }

        return response([
            'success' => true,
            'order' => $order->status,
            'message' => 'Order has been cancelled',
        ]);
    }

    public function changeOrderState(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'value' => 'required',
            'reason' => 'required',
        ]);
        //
        $order = Order::with('user')->findOrFail($request->order_id);
        if ($request->value == 'accept') {
            $order->status = 'preparation';
        } else {
            $order->status = 'cancelled';
            $order->cancel_reason = $request->reason;
        }
        if ($order->save()) {
            $user = User::select('notification_token', 'id')->findOrFail($order->user_id);
            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = [$user->notification_token];
            $appToken = Option::where('option_name', 'app_firebase_server_key')->first();
            $serverKey = $appToken->option_value;
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => "Order #".$order->order_number,
                    "body" => "Order status has been updated to ".$order->status,
                    "sound"=>"default"
                ],
                "data" => [
                    "order_status" => $order->status,
                    "notification_type" => 'order status changed',
                    "order_id" => $order->id,
                    "order_number" => $order->order_number,
                ],
            ];
            $encodedData = json_encode($data);
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            $result = curl_exec($ch);
            if ($result === false) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);




            return response([
                'success' => true,
                'order' => $order,
                'message' => 'Order status has been set to ' . $order->status,
            ]);
        }
    }

    public function orderExtras(Request $request)
    {
        $request->validate([
            'extra_id' => 'required',
        ]);
        $mainExtras = BogoExtra::where('bogo_product_id', $request->extra_id)->with('extra')->get();
        return response([
            'extra_products' => $mainExtras,
        ]);

    }
    public function orderBogoModifier(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
        ]);

        $bogoOrderModifiers = BogoModifier::where('order_id', $request->order_id)->with('bogoModifier', 'item')->get();
        return response([
            'bogoOrderModifiers' => $bogoOrderModifiers,
        ]);

    }

}
