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

        $request2 = '{"franchise_id":1,"note":"this is note","products":[{"id":2,"quantity":1,"extras":[],"modifier":[]},{"id":3,"quantity":1,"extras":[],"modifier":[]}],"address":null,"is_pickup":true,"user_id":"1","sub_total":1600,"total":1600}';
        $request2 = json_decode($request2);
        $extraPrice = 0;
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
        } else {
            $orderType = 'delivery';
            $order->address = json_encode($request2->address);
        }
        $order->type = $orderType;
        $order->sub_total = $request2->sub_total;
        $order->extra = 0;
        $order->total = $request2->total;
        $order->admin_commission = 0;
        $order->status = 'order';
        $order->note = $request2->note;
        $order->created_at = Carbon::now();
        $order->warning = Carbon::now();
        $order->danger = Carbon::now();
        $order->save();
        $ids_promotion = '';

        foreach ($request2->products as $product) {

            $productPrice = Product::select('id', 'sale_price')->where('id', $product->id)->with('promotions')->first();

            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $productPrice->id;
            $orderProduct->quantity = $product->quantity;
            $orderProduct->price = $productPrice->sale_price;

            if ($productPrice->promotions) {
                if ($productPrice->promotions->count() > 0) {
                    //return 'many promotions';
                    foreach ($productPrice->promotions as $promo) {
                        if ($promo->type == 'bogo' && $promo->buy_product_id == $product->id) {

                            $orderPromotion = new OrderPromotion;
                            $orderPromotion->order_id = $order->id;
                            $orderPromotion->promotion_id = $promo->id;
                            $orderPromotion->free_product = $promo->get_product_id;
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
                                    $orderPromotion->save();
                                    $ids_promotion .= $promo->id . ',';
                                }
                            }
                            $promotionOrder = Order::findOrFail($order->id);
                            $promotionOrder->promotion_type = $promo->type;
                            $promotionOrder->discount_type = $promo->discount_type;
                            $promotionOrder->discount = $promo->amount;
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
                        $orderPromotion->free_product = $promotion->buyProduct->id;
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

        $orderUpdate = Order::findOrFail($order->id);
        $orderUpdate->extra = $extraPrice;
        $orderUpdate->warning = $order->created_at;
        $orderUpdate->danger = Carbon::parse($orderUpdate->created_at)->addMinutes(30);
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
}
