<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderPromotion;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        $franchises = Franchise::where('status', 'active')->get();
        if ($request->ajax()) {
            $refund = Refund::with('order')->with('franchise')->with('user')->orderby('id', 'desc');
            if ($request->has('from_date') && $request->has('to_date')) {
                if ($request->franchise == '0') {
                    $refund->whereBetween('date', [$request->from_date, $request->to_date]);
                } else {
                    $refund->whereBetween('date', [$request->from_date, $request->to_date])->where('franchise_id', $request->franchise);
                }

            }
            return DataTables::of($refund)
                ->addColumn('refund_status', function ($refund) {
                    if ($refund->status == 'pending') {
                        $button = 'text-warning';
                    } elseif ($refund->status == 'refunded') {
                        $button = 'text-success';
                    } else {
                        $button = 'text-danger';
                    }
                    return $button;
                })
                ->addColumn('user', function ($refund) {
                    return $refund->user->name;
                })
                ->addColumn('franchise', function ($refund) {
                    return $refund->franchise->name;
                })

                ->make(true);
        }
        return view('admin.refund.index', compact('franchises'));
    }

    public function orderDetail(Request $request)
    {
        $request->validate([
            'refund_id' => 'required',
        ]);
        //  $order = Order::where('did_pay', '!=', 3)->findOrFail($refund->order_id);
        //$orderProducts = OrderProduct::where('order_id', $order->id)->with('product', 'items.product')->get();
        $refund = Refund::where('id', $request->refund_id)->with('user')->first();
        // $order = Order::where('id',$refund->order_id)->with('user','orderExtras','orderExtras.extra')->first();
        $order = Order::
            where('id', $refund->order_id)->
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
            'refund' => $refund,
            'orderProducts' => $orderProducts,
            'order' => $order,
            'itemsTotal' => $itemsTotal,
            'total' => $totalAmount,
            'promotions' => $orderPromotions,
        ]);
    }
    public function issueRefund(Request $request)
    {
        $request->validate([
            'refund_id' => 'required',
            'order_id' => 'required',
        ]);
        $order = Order::where('did_pay', '!=', 3)->with('user')->findOrFail($request->order_id);
        $user = User::select('notification_token', 'id')->findOrFail($order->user_id);
        $token = $user->notification_token;
        $refund = Refund::findOrFail($request->refund_id);
        $order = Order::where('did_pay', '!=', 3)->findOrFail($request->order_id);
        $refund->status = 'refunded';
        $order->status = 'refunded';
        $refund->act_by = Auth::id();
        $orderDetails = '{ "order_id":' . $order->id . ',"order_status":"' . $order->status . '","notification_type":"refund"}';
        $orderToJson = json_decode($orderDetails, true);
        if ($refund->save()) {
            $order->save();
            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = [$user->notification_token];
            $appToken = Option::where('option_name', 'app_firebase_server_key')->first();
            $serverKey = $appToken->option_value;
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => "Order #" . $order->order_number,
                    "body" => "Refund for Order #".$order->order_number." has been approved",
                    "sound"=>"default"
                ],
                "data" => [
                    "order_status" => $order->status,
                    "notification_type" => 'refund',
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

            return response(['success' => true, 'message' => 'Refunds has been issued successfully']);
        } else {
            return response(['success' => false, 'message' => 'Refunds not issued']);
        }

    }
    public function cancelRefund(Request $request)
    {
        $request->validate([
            'cancel_refund_id' => 'required',
            'cancel_refund_reason' => 'required',
        ]);
        $refund = Refund::with('order')->findOrFail($request->cancel_refund_id);
        $order = Order::findOrFail($refund->order_id);
        $user = User::select('notification_token', 'id')->findOrFail($refund->order->user_id);
        $token = $user->notification_token;
        $refund->status = 'cancelled';
        $refund->cancel_reason = $request->cancel_refund_reason;
        $refund->act_by = Auth::id();
        if ($refund->save()) {
            $order->status = 'refunded';
            $order->save();
            $orderDetails = '{ "reason":' . $refund->cancel_reason . ', "order_id":' . $refund->order_id . ',"order_status":"' . $refund->order->status . '","notification_type":"cancel_refund"}';
            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = [$user->notification_token];
            $appToken = Option::where('option_name', 'app_firebase_server_key')->first();
            $serverKey = $appToken->option_value;
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => "Order #" . $refund->order_number,
                    "body" => "Refund for Order #".$refund->order->order_number." has been rejected",
                    "sound"=>"default"
                ],
                "data" => [
                    "reason"=>$refund->cancel_reason,
                    "order_status" => $refund->order->status,
                    "notification_type" => 'cancel_refund',
                    "order_id" => $refund->order_id,
                    "order_number" => $refund->order->order_number,
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
            return response(['success' => true, 'message' => 'Refund request has been canceled']);
        } else {
            return response(['success' => false, 'message' => 'Unable to cancel refunds']);
        }

    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            $request->refund_id;
            $refund = Refund::where('id', $request->refund_id)->with(['order'])->with('franchise')->with('user')->first();
            $response = [
                'refund' => $refund,
            ];
            return $response;
        }

    }

}
