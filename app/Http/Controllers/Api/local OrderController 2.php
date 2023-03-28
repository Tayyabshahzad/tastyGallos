<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderResource;
use App\Models\Extra;
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

        $request2 = '{"franchise_id":1,"note":null,"products":[{"id":8,"quantity":1,"extras":[2,1],"modifier":[{"id":3,"items":[4,5,6,7]}]}],"address":null,"is_pickup":true,"user_id":"14","sub_total":1595,"total":1595,"payment_method":"cash"}';
        $request2 = json_decode($request2);
        $extraPrice = 0;
        $subTotal = 0;
        $discountAmount = 0;
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
        $order->user_id = $request2->user_id;
        $order->franchise_id = $request2->franchise_id;
        $order->order_number = $orderNumber;
        $order->time_ago = Carbon::now();
        if ($request->is_pickup == true) {
            $orderType = 'pickup';
           // $order->did_pay = 2;
        } else {
            $orderType = 'delivery';
           // $order->did_pay = 2;
            $order->address = json_encode($request2->address);
        }
        $order->type = $orderType;
        $order->sub_total = 0;
        $order->extra = 0;
        $order->total = 0;
        $order->admin_commission = 0;
        $order->status = 'order';
        $order->note = $request2->note;
        $order->created_at = Carbon::now();
        $order->warning = Carbon::now();
        $order->danger = Carbon::now();

        $order->payment_method = $request2->payment_method;
        if ($request2->payment_method == 'cash') {
            $order->did_pay = 2;
        } else {
            $order->did_pay = 3;
        }
        $order->grandTotal = 0;

        $order->save();
        $ids_promotion = '';

        foreach ($request2->products as $product) {

            $productPrice = Product::select('id', 'sale_price')->where('id', $product->id)->with('promotions')->first();
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $productPrice->id;
            $orderProduct->quantity = $product->quantity;
            $orderProduct->price = $productPrice->sale_price;
            $subTotal += ($productPrice->sale_price * $product['quantity']);
            if ($productPrice->promotions) {
                if ($productPrice->promotions->count() > 0) {
                    //return 'many promotions';
                    foreach ($productPrice->promotions as $promo) {
                        if ($promo->type == 'bogo' && $promo->buy_product_id == $product->id) {

                            $orderPromotion = new OrderPromotion;
                            $orderPromotion->order_id = $order->id;
                            $orderPromotion->promotion_id = $promo->id;
                            $orderPromotion->free_product = $promo->get_product_id;
                            $orderPromotion->buy_product = $promo->buy_product_id;
                            $orderPromotion->discount_type = $promo->discount_type;
                            $orderPromotion->discount_amount = $promo->amount;
                            $orderPromotion->save();
                            $ids_promotion .= $promo->id . ',';

                        } else {
                            // Get Promotion Product if promotion type is discount
                            foreach ($promo->products as $discountedProducts) {
                                if ($discountedProducts->id == $product->id) {
                                    $orderPromotion = new OrderPromotion;
                                    $orderPromotion->order_id = $order->id;
                                    $orderPromotion->promotion_id = $promo->id;
                                    $orderPromotion->free_product = $discountedProducts->id;
                                    $orderPromotion->discount_type = $promo->type;
                                    $orderPromotion->discount_amount = $promo->amount;
                                    $orderPromotion->save();
                                    $ids_promotion .= $promo->id . ',';
                                }
                            }
                            $promotionOrder = Order::findOrFail($order->id);
                            $promotionOrder->promotion_type = $promo->type;
                            $promotionOrder->discount_type = $promo->discount_type;
                            $promotionOrder->discount = $promo->amount;
                            $discountAmount += $promo->amount;
                            $promotionOrder->promotions = $ids_promotion;
                            $promotionOrder->save();
                        }
                    }


                } else {
                    $promotion = Promotion::with('buyProduct')->where('buy_product_id', $product->id)->first();
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
            if ($product->extras) {
                foreach ($product->extras as $extra) {
                    $extraDetail = Extra::findOrFail($extra);
                    // $extraItem = new Extra;
                    $extraItem = new OrderProductExtra;
                    $extraItem->product_id = $product['id'];
                    $extraItem->extra_id = $extra;
                    $extraItem->price = $extraDetail->price;
                    $extraItem->order_id = $order->id;
                    $extraItem->save();
                }
            }
            if ($product->modifier) {
                foreach ($product->modifier as $modifiers) {
                    $modifierDetail = Modifier::findOrFail($modifiers['id']);
                    foreach ($modifiers->items as $item) {
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
        }
        //return $subTotal .'|'. $discountAmount . '|' .$extraPrice;




        $orderUpdate = Order::with('franchise')->findOrFail($order->id);
        $estimated_time = $orderUpdate->franchise->estimated_time;
        $orderUpdate->sub_total = $subTotal;
        $orderUpdate->extra = $extraPrice;
        $orderUpdate->warning = $order->created_at;
        $orderUpdate->total = ($subTotal + $extraPrice);
        //$orderUpdate->grandTotal = ($subTotal+$extraPrice);
        // $orderUpdate->admin_commission = 0;
        $orderUpdate->danger = Carbon::parse($orderUpdate->created_at)->addMinutes($estimated_time);
        $getDiscount = OrderPromotion::where('order_id', $order->id)->get();
        if(count($getDiscount)>0){
            $getDiscount = OrderPromotion::where('order_id', $order->id)->sum('discount_amount');
            $orderUpdate->discount = $getDiscount;
        }else{
            $orderUpdate->discount = 0;
        }

        $orderUpdate->save();
        $myOrder = Order::findOrFail($orderUpdate->id);
        // Get Percentage value
        if ($myOrder->discount > 0) {
            $discountType = $myOrder->discount_type;
            if ($discountType == 'amount') {
                $grandTotal = ($myOrder->total - $myOrder->discount);
            } else if ($discountType == 'percentage') {
                $percentage = ($myOrder->discount / 100) * $myOrder->total;
                $grandTotal = $myOrder->total - $percentage;
            } else {
                $grandTotal = ($myOrder->total);
            }
        } else {
            $grandTotal = ($myOrder->total);
        }

        $myOrder->admin_commission = ($adminCommision / 100) * $grandTotal;
        $myOrder->grandTotal = $grandTotal;
        $myOrder->save();
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
}
