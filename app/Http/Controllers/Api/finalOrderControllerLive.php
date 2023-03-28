<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderResource;
use App\Models\Extra;
use App\Models\Franchise;
use App\Models\Modifier;
use App\Models\Option;
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
use App\Notifications\OrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        return view('test.index2');
    }
    public function ordersByUser($id)
    {
        $order = Order::where('user_id', $id)->where('did_pay', '!=', 3)->get();
        return response([
            'success' => true,
            'orders' => OrderResource::collection($order),
        ]);
    }
    public function activeOrder($id)
    {

        // $order = Order::where(function($query) use ($id){
        //     $query->where('did_pay' ,'=',2);
        //     $query->orWhere('did_pay' ,'=',1);
        //     $query->where('user_id' ,'=',$id);
        // })->first();

        // $order = Order::where('user_id', $id)->where('did_pay','!=',3)->get();

        $order = Order::where('user_id', $id)->where('did_pay', '!=', 3)->where('status', '!=', 'delivered')->where('status', '!=', 'collected')->orderby('id', 'desc')->first();
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
        $order = Order::where('id', $id)->first();

        // $order = Order::where(function($query) use ($id){
        //     $query->where('did_pay' ,'=',2);
        //     $query->orWhere('did_pay' ,'=',1);
        //     $query->where('status' ,'!=','delivered');
        //     $query->where('status' ,'!=','collected');
        //     $query->where('id' ,'=',$id);
        // })->first();

        if ($order) {
            return response([
                'success' => true,
                'order' => OrderDetailResource::make($order),
            ]);
        } else {
            return response([
                'success' => false,
            ]);
        }
    }
    public function take(Request $request)
    {

        $extraPrice = 0;
        $subTotal = 0;
        $discountAmount = 0;
        $extraAmount = 0;
        $totalVatAmout = 0;
        $total = 0;
        $adminComm = Option::where('option_name', 'commission')->first();
        if ($adminComm) {
            $adminCommision = $adminComm->option_value;
        } else {
            $adminCommision = 5;
        }

        //var discount = (data.order.discount / 100) * data.order.sub_total;
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
            // $order->did_pay = 2;
        } else {
            $orderType = 'delivery';
            // $order->did_pay = 3;
            $order->address = json_encode($request['address']);
        }
        $order->type = $orderType;
        $order->sub_total = 0;
        $order->items_extra = 0;
        $order->extras = 0;
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
        $order->grandTotal = 0;
        $order->tax = 0;
        $order->save();
        exit();
        $ids_promotion = '';
//    return 555;
        foreach ($request['products'] as $product) {
            $productPrice = Product::select('id', 'vat','sale_price','price')->where('id', $product['id'])->with('promotions')->first();
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $productPrice->id;
            $orderProduct->quantity = $product['quantity'];
            if($productPrice->sale_price == null or $productPrice->sale_price == 0){
                $price = $productPrice->price;
            }else{
                $price = $productPrice->sale_price;
            }
            $orderProduct->price = $price;
            // Calculate VAT
            $totalVat = ($productPrice->vat / 100) * $price;
            $orderProduct->vat = $totalVat;
            $totalVatAmout += ($totalVat*$product['quantity']);
            $subTotal += ($productPrice->sale_price * $product['quantity']);
            if ($productPrice->promotions) {
                if ($productPrice->promotions->count() > 0) {
                    //return 'many promotions';
                    foreach ($productPrice->promotions as $promo) {
                        if ($promo->type == 'bogo' && $promo->buy_product_id == $product['id']) {
                            $orderPromotion = new OrderPromotion;
                            // $orderPromotion->order_id = $order->id;
                            // $orderPromotion->promotion_id = $promo->id;
                            // $orderPromotion->free_product = $promo->get_product_id;
                            $orderPromotion->order_id = $order->id;
                            $orderPromotion->promotion_id = $promo->id;
                            $orderPromotion->free_product = $promo->get_product_id;
                            $orderPromotion->buy_product = $promo->buy_product_id;
                            $orderPromotion->discount_type = $promo->discount_type;
                            $orderPromotion->discount_amount = $promo->amount;
                            $orderProduct->discount = 0;
                            $orderPromotion->save();
                            $ids_promotion .= $promo->id . ',';
                        } else {
                            // Get Promotion Product if promotion type is discount
                            foreach ($promo->products as $discountedProducts) {
                                if ($discountedProducts->id == $product['id']) {
                                    $orderPromotion = new OrderPromotion;
                                    $orderPromotion->order_id = $order->id;
                                    $orderPromotion->promotion_id = $promo->id;
                                    $orderPromotion->free_product = $promo->get_product_id;
                                    $orderPromotion->discount_type = $promo->discount_type;
                                    if ($promo->discount_type == 'percentage') {
                                        $orderPromotion->discount_amount = ($promo->amount / 100) * $productPrice->sale_price;
                                        $newDiscount = ($promo->amount / 100) * $productPrice->sale_price;
                                    } else {
                                        $orderPromotion->discount_amount = $promo->amount;
                                        $newDiscount = $promo->amount;
                                    }
                                    $orderPromotion->save();
                                    $ids_promotion .= $promo->id . ',';
                                    // $orderProduct->discount = $newDiscount;
                                    $orderProduct->discount = ($newDiscount * $product['quantity']);
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
                    $promotion = Promotion::with('buyProduct')->with('buyProduct')->where('buy_product_id', $product['id'])->first();
                    if ($promotion) {
                        $orderPromotion = new OrderPromotion;
                        $orderPromotion->order_id = $order->id;
                        $orderPromotion->promotion_id = $promotion->id;
                        $orderPromotion->buy_product = $promotion->buy_product_id;
                        $orderPromotion->free_product = $promotion->get_product_id;
                        $orderPromotion->discount_type = $promotion->discount_type;
                        $orderPromotion->discount_amount = 666;
                        $orderPromotion->save();
                    }

                }

            }
            $orderProduct->save();
            if ($product['extras']) {
                //Log::info($product['extras']);
                foreach ($product['extras'] as $extra) {
                    $extraDetail = Extra::findOrFail($extra);
//Log::info($extraDetail);
                    //         // $extraItem = new Extra;
                    $extraItem = new OrderProductExtra;
                    $extraItem->product_id = $product['id'];
                    $extraItem->extra_id = $extra;
                    $extraItem->price = $extraDetail->price;
                    $extraItem->order_id = $order->id;
                    $extraAmount += ($extraDetail->price*$product['quantity']);
                    $extraItem->save();
                    Log::info($extraItem);
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
                        $orderProductItem->price = ($pivotItem->pivot->price*$product['quantity']);
                        $orderProductItem->save();
                        $extraPrice += ($pivotItem->pivot->price*$product['quantity']);
                    }
                }
            }
//    return 'ffff';
        }
//return 'Final';
        $totalVat = OrderProduct::where('order_id', $order->id)->sum('vat');
        $orderUpdate = Order::with('franchise')->findOrFail($order->id);
        $estimated_time = $orderUpdate->franchise->estimated_time;
        $orderUpdate->sub_total = $subTotal;
        $orderUpdate->extras = $extraAmount;
        $orderUpdate->items_extra = $extraPrice;
        $orderUpdate->warning = $order->created_at;
        $orderUpdate->tax = $totalVatAmout;
        $orderUpdate->total = ($subTotal + $extraPrice + $extraAmount);
        //$orderUpdate->grandTotal = ($subTotal+$extraPrice);
        // $orderUpdate->admin_commission = 0;
        $orderUpdate->danger = Carbon::parse($orderUpdate->created_at)->addMinutes($estimated_time);
        $getDiscount = OrderPromotion::where('order_id', $order->id)->get();
        if (count($getDiscount) > 0) {
            //  $getDiscount = OrderPromotion::where('order_id', $order->id)->sum('discount_amount');
            $getDiscount = OrderProduct::where('order_id', $order->id)->sum('discount');
            $orderUpdate->discount = $getDiscount;
        } else {
            $orderUpdate->discount = 0;
        }
        $orderUpdate->save();
        $myOrder = Order::findOrFail($orderUpdate->id);
        // Get Percentage value
        if ($myOrder->discount > 0) {
            $discountType = $myOrder->discount_type;
            // if ($discountType == 'amount') {
            //     $grandTotal = ($myOrder->total - $myOrder->discount);
            // } else if ($discountType == 'percentage') {
            //     $percentage = ($myOrder->discount / 100) * $myOrder->total;
            //     $grandTotal = $myOrder->total - $percentage;
            // } else {
            //     $grandTotal = ($myOrder->total);
            // }
            $grandTotal = ($myOrder->total - $myOrder->discount);
        } else {
            $grandTotal = ($myOrder->total);
        }

        $myOrder->admin_commission = ($adminCommision / 100) * $grandTotal;
        $myOrder->grandTotal = ($grandTotal+$myOrder->tax);
        $myOrder->save();

            $franchiseUser = Franchise::with('user')->findorFail($myOrder->franchise_id);
            $owner = $franchiseUser->user->id;
            $user = User::findorFail($owner);
            $user->notify(new OrderNotification($user,$order));
            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken =  [$user->order_notification];
           // $FcmToken = User::whereNotNull('order_notification')->pluck('order_notification')->all();
            $serverKey = 'AAAAMJTS_hs:APA91bG2OvAw5DUMtJshyqVLeAlX-tA72JDC-A4eZfFyK87GPUynTnS1FxnnCJHA4AsFWTJmnNUs8wBHbMm1MTc6buZq4R2ErypavRArnvGCMBVXbL-FHidmi7aIkMoh14ESr-3RUykh';
            $orderProductCount = OrderProduct::where('order_id',$myOrder->id)->count();

            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" =>  $myOrder->order_number,
                    "body" => $myOrder->id,
                    "icon" => $myOrder->franchise_id,
                ],
                "data" => [
                    "franchise_id" =>  $franchiseUser->id,
                    "user_id" => $user->id,
                    "order_type" => $myOrder->type,
                    "order_number" => $myOrder->order_number,
                    "order_id" => $myOrder->id,
                    "orderProducts"=>$orderProductCount,
                    "orderTime"=> Carbon::parse($myOrder->created_at)->format('d-m-Y H:i:s A'),
                ]
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
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
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
            'RETURN_URL' => 'https://tastygallos.brhythym.com/api/orders/payment/confirm',
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
