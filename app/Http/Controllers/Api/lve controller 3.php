<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderResource;
use App\Models\Extra;
use App\Models\Modifier;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductExtra;
use App\Models\OrderProductItem;
use App\Models\OrderPromotion;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Refund;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('test.index2');
    }
    public function ordersByUser($id)
    {
        $order = Order::where('user_id', $id)->get();
        return response([
            'success' => true,
            'orders' => OrderResource::collection($order),
        ]);
    }
    public function activeOrder($id)
    {
        $order = Order::where('user_id', $id)->orderby('id', 'desc')->first();
        if ($order) {
            return response([
                'success' => true,
                'order' => $order->id,
            ]);
        }
        return response([
            'success' => false,
            'message' => 'there are no order',
        ]);

    }
    public function singleOrder($id)
    {
        $order = Order::where('id', $id)->where('status', '!=', 'collected')->where('status', '!=', 'delivered')->where('status', '!=', 'cancelled')->first();
        return response([
            'success' => true,
            'order' => OrderDetailResource::make($order),
        ]);
    }
    public function take(Request $request)
    {
        $extraPrice = 0;
        $subTotal = 0;
        $discountAmount = 0;
        $total = 0;
        $uniqueOrder = Order::orderBy('id', 'DESC')->first();
        if ($uniqueOrder == null or $uniqueOrder == "") {
            $orderNumber = 1000;
        } else {
            $orderNumber = $uniqueOrder->order_number + 1;
        }
        $order = new Order;
        $order->user_id = $request['user_id'];
        $order->franchise_id = $request['franchise_id'];
        $order->order_number = $orderNumber;
        $order->time_ago = Carbon::now();
        if ($request->is_pickup == true) {
            $orderType = 'pickup';
        } else {
            $orderType = 'delivery';
            $order->address = json_encode($request['address']);
        }
        $order->type = $orderType;
        $order->sub_total = 0;
        $order->extra = 0;
        $order->total = 0;
        $order->admin_commission = 0;
        $order->status = 'order';
        $order->note = $request->note;
        $order->created_at = Carbon::now();
        $order->warning = Carbon::now();
        $order->danger = Carbon::now();
        $order->payment_method = $request->payment_method;
        if ($request->payment_method == 'cash') {
            $order->did_pay = 2;
        } else {
            $order->did_pay = 3;
        }
        $order->save();
        $ids_promotion = '';
//    return 555;
        foreach ($request['products'] as $product) {
            $productPrice = Product::select('id', 'sale_price')->where('id', $product['id'])->with('promotions')->first();
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $productPrice->id;
            $orderProduct->quantity = $product['quantity'];
            $orderProduct->price = $productPrice->sale_price;
            $subTotal += $productPrice->sale_price * $product['quantity'];
            if ($productPrice->promotions) {
                if ($productPrice->promotions->count() > 0) {
                    //return 'many promotions';
                    foreach ($productPrice->promotions as $promo) {
                        if ($promo->type == 'bogo' && $promo->buy_product_id == $product['id']) {
                            $orderPromotion = new OrderPromotion;
                            $orderPromotion->order_id = $order->id;
                            $orderPromotion->promotion_id = $promo->id;
                            $orderPromotion->free_product = $promo->get_product_id;
                            $orderPromotion->save();
                            $ids_promotion .= $promo->id . ',';
                        } else {
                            // Get Promotion Product if promotion type is discount
                            foreach ($promo->products as $discountedProducts) {
                                if ($discountedProducts->id == $product['id']) {
                                    $orderPromotion = new OrderPromotion;
                                    $orderPromotion->order_id = $order->id;
                                    $orderPromotion->promotion_id = $promo->id;
                                    $orderPromotion->free_product = $discountedProducts->id;
                                    $orderPromotion->save();
                                    $ids_promotion .= $promo->id . ',';
                                }
                            }
                        }
                        $promotionOrder = Order::findOrFail($order->id);
                        $promotionOrder->promotion_type = $promo->type;
                        $promotionOrder->discount_type = $promo->discount_type;
                        if ($promo->amount == null) {
                            $promotionOrder->discount = 0;
                        } else {
                            $promotionOrder->discount = $promo->amount;
                        }
                        $promotionOrder->promotions = $ids_promotion;
                        $discountAmount += $promo->amount;
                        $promotionOrder->save();
                    }
                } else {
                    //return "Bogo";
                    $promotion = Promotion::with('buyProduct')->where('buy_product_id', $product['id'])->first();
                    if ($promotion) {
                        $orderPromotion = new OrderPromotion;
                        $orderPromotion->order_id = $order->id;
                        $orderPromotion->promotion_id = $promotion->id;
                        $orderPromotion->free_product = $promotion->buyProduct->id;
                        $orderPromotion->save();
                    }

                }

            }
            $orderProduct->save();
            if ($product['extras']) {
                foreach ($product['extras'] as $extra) {
                    $extraDetail = Extra::findOrFail($extra);
                    // $extraItem = new Extra;
                    $extraItem = new OrderProductExtra;
                    $extraItem->product_id = $product['id'];
                    $extraItem->extra_id = $extra;
                    $extraItem->price = $extraDetail->price;
                    $extraItem->save();
                }
            }
            if ($product['modifier']) {
                foreach ($product['modifier'] as $modifiers) {
                    $modifierDetail = Modifier::findOrFail($modifiers['id']);
                    foreach ($modifiers['items'] as $item) {
                        $pivotItem = $modifierDetail->products()
                            ->wherePivot('item_id', $item)
                            ->first(); // execute the query
                        $orderProductItem = new OrderProductItem;
                        $orderProductItem->order_product_id = $orderProduct->id;
                        $orderProductItem->item_id = $item;
                        $orderProductItem->price = $pivotItem->pivot->price;
                        $orderProductItem->save();
                        $extraPrice += $pivotItem->pivot->price;
                    }
                }
            }
//    return 'ffff';
        }
//return 'Final';
        $orderUpdate = Order::with('franchise')->findOrFail($order->id);
        $estimated_time = $orderUpdate->franchise->estimated_time;
        $orderUpdate->sub_total = $subTotal;
        $orderUpdate->extra = $extraPrice;
        $orderUpdate->warning = $order->created_at;
        $orderUpdate->total = ($subTotal + $extraPrice);

        $orderUpdate->danger = Carbon::parse($orderUpdate->created_at)->addMinutes($estimated_time);
        $orderUpdate->save();
        return response([
            'success' => true,
            'order' => $order,
        ]);
    }

    public function refundRequest(Request $request)
    {

        $request->validate([
            'order_id' => 'required',
            'user_id' => 'required',
            'reason' => 'required',
        ]);
        $order = Refund::where('order_id', $request->order_id)->first();
        if ($order != null) {
            return response([
                'success' => false,
                'message' => 'Refund request for current order already exists',
            ]);
        }
        $order = Order::findOrFail($request->order_id);
        $refund = new Refund;
        $refund->order_id = $request->order_id;
        $refund->franchise_id = $order->franchise->id;
        $refund->user_id = $request->user_id;
        $refund->reason = $request->reason;
        $refund->status = 'pending';
        $refund->date = Carbon::now()->format('Y-m-d');
        $refund->save();
        return response([
            'success' => true,
            'message' => 'Refund request has been submited',
        ]);

    }
    public function addReview(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            // 'franchise_id' => 'required',
            'order_id' => 'required',
            'rating' => 'required',
            'comments' => 'required',
        ]);
        $review = Review::where('order_id', $request->order_id)->first();
        $order = Order::with('franchise')->findOrFail($request->order_id);
        $franchise_id = $order->franchise->id;
        if ($review) {
            return response([
                'success' => false,
                'message' => 'review already exists for selected order',
            ]);
        }
        $review = new Review;
        $review->user_id = $request->user_id;
        $review->franchise_id = $franchise_id;
        $review->order_id = $request->order_id;
        $review->rating = $request->rating;
        $review->comments = $request->comments;
        $review->title = $request->title;
        $review->save();
        $order->has_review = true;
        $order->save();
        return response([
            'success' => true,
            'message' => 'review has been submited',
        ]);
    }

    function catch (Request $request) {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => 'eg7O_FN8ToO-ioYQb1s90e:APA91bH8hQs-MZUW00yPUONGjt_HfkqVHPsLzJ0jLI2LNco6DthgvF6lKxalbddCLZ9WB3nbFQ5nisxJP5s5BqS_SHqoihB0j0nJliGMy9z1YV_qcQcgq9-DTnLelBMa2PeZHzgbg32e', 'data' => 'order'),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAAtxRHABo:APA91bGQR3Pu10v3SFiUdLQHvdGVaKSK1j4cduqoQ6yBLkA1l-zBR9d6X24dG5W8aga1yGXA7znNdf_nnsx8Dsdd3LwWMyUd64HAdSKP2IRABtmOZu9C-sdbV2o19jiyiv_2CiWDvNGN',
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

    // public function paymentInit($id)
    // {
    //     $order = Order::with('user')->findOrFail($id);
    //     $encryptionKey = 'secret';
    //     $DateTime = Carbon::now()->format('Y-m-d H:i:s');
    //     $data = array(
    //         'PAYGATE_ID' => 10011072130,
    //         'REFERENCE' => 'pgtest_123456789',
    //         'AMOUNT' => $order->sub_total,
    //         'CURRENCY' => 'PKR',
    //         'RETURN_URL' => 'https://tastygallos.zinormous.xyz/api/orders/payment/confirm',
    //         'TRANSACTION_DATE' => $DateTime,
    //         'LOCALE' => 'en-za',
    //         'COUNTRY' => 'PAK',
    //         'EMAIL' => $order->user->email,
    //     );
    //     //
    //     $checksum = md5(implode('', $data) . $encryptionKey);
    //     $data['CHECKSUM'] = $checksum;
    //     $fieldsString = http_build_query($data);
    //     //open connection
    //     $ch = curl_init();
    //     //set the url, number of POST vars, POST data
    //     curl_setopt($ch, CURLOPT_URL, 'https://secure.paygate.co.za/payweb3/initiate.trans');
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_NOBODY, false);
    //     curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
    //     //execute post
    //     $result = curl_exec($ch);
    //     $str_arr = explode("&", $result);
    //     $payRequest = $str_arr[1];
    //     $checkSum = $str_arr[3];
    //     $payRequest = explode("=", $payRequest);
    //     $checkSum = explode("=", $checkSum);
    //     $PAY_REQUEST_ID = $payRequest[1];
    //     $CHECKSUM = $checkSum[1];
    //     curl_close($ch);
    //     $order->pay_request_id = $PAY_REQUEST_ID;
    //     $order->checksum = $CHECKSUM;
    //     $order->save();
    //     return view('paymentProcessing', compact('PAY_REQUEST_ID', 'CHECKSUM'));

    // }

    public function paymentInit($id)
    {
        $order = Order::with('user')->findOrFail($id);
        $encryptionKey = 'secret';
        $DateTime = Carbon::now()->format('Y-m-d H:i:s');
        $data = array(
            'PAYGATE_ID' => 10011072130,
            'REFERENCE' => 'pgtest_123456789',
            'AMOUNT' => $order->sub_total,
            'CURRENCY' => 'ZAR',
            'RETURN_URL' => 'https://tastygallos.zinormous.xyz/api/orders/payment/confirm',
            'TRANSACTION_DATE' => $DateTime,
            'LOCALE' => 'en-za',
            'COUNTRY' => 'PAK',
            'EMAIL' => $order->user->email,
        );
        //
        $checksum = md5(implode('', $data) . $encryptionKey);
        $data['CHECKSUM'] = $checksum;
        $fieldsString = http_build_query($data);
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, 'https://secure.paygate.co.za/payweb3/initiate.trans');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, false);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
        //execute post
        $result = curl_exec($ch);
        $str_arr = explode("&", $result);
        $payRequest = $str_arr[1];
        $checkSum = $str_arr[3];
        $payRequest = explode("=", $payRequest);
        $checkSum = explode("=", $checkSum);
        $PAY_REQUEST_ID = $payRequest[1];
        $CHECKSUM = $checkSum[1];
        curl_close($ch);
        $order->pay_request_id = $PAY_REQUEST_ID;
        $order->checksum = $CHECKSUM;
        $order->save();
        return view('paymentProcessing', compact('PAY_REQUEST_ID', 'CHECKSUM'));

    }

    public function paymentConfirm(Request $request)
    {
        $order = Order::with('user')->where('pay_request_id', $request->PAY_REQUEST_ID)->first();
        if (!$order) {
            return response([
                'success' => false,
                'message' => 'order not exists',
            ]);
        }
        if ($request->TRANSACTION_STATUS == 1) {
            $user = User::select('notification_token', 'id')->findOrFail($order->user_id);
            $token = $user->notification_token;
            $order->did_pay = 1;
            $order->save();
            $orderDetails = '{ "order_id":' . $order->id . ',"did_pay":"' . $order->did_pay . '","notification_type":"order_payment"}';
            $orderToJson = json_decode($orderDetails, true);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('to' => $token, 'data' => $orderDetails),
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer AAAAtxRHABo:APA91bGQR3Pu10v3SFiUdLQHvdGVaKSK1j4cduqoQ6yBLkA1l-zBR9d6X24dG5W8aga1yGXA7znNdf_nnsx8Dsdd3LwWMyUd64HAdSKP2IRABtmOZu9C-sdbV2o19jiyiv_2CiWDvNGN',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            return response([
                'success' => true,
                'did_pay' => $order->did_pay,
                'message' => 'payment completed',
            ]);
        } else {
            return response([
                'success' => false,
                'message' => 'payment not completed',
            ]);
        }
    }
}
