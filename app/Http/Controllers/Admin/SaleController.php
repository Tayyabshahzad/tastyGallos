<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
class SaleController extends Controller
{
    public function index(Request $request)
    {

        $franchises = Franchise::where('status','active')->get();

        // $auto_seggestions = AutoSuggestion::relationCounts()->with('postType:id,title')->withCount('websiteBadges','websiteKeywords','badges', 'tags', 'keywords', 'languages', 'formats', 'fileIncludes', 'worksWith', 'softwareVersions', 'compatibleBrowsers', 'permissions', 'operatingSystems', 'processors', 'graphics');

            $sales = Order::where('did_pay','!=',3)->where('status','!=','refunded')->with('franchise')->with('user');
            if($request->ajax()){
                if($request->has('to_date') && $request->has('from_date')){
                             $fromDate =  Carbon::parse($request->from_date)->startOfDay();
                             $toDate =  Carbon::parse($request->to_date)->endOfDay();

                        if($request->franchise == '0' &&  $request->orderStatus == '0'){
                              $sales = Order::where('did_pay','!=',3)->with('franchise')->with('user')->whereBetween('created_at',[$fromDate,$toDate]);
                        }else if($request->franchise == '0' && $request->orderStatus != '0'){
                            $status = $request->orderStatus;
                            if($status == 'delivered'){
                                $sales->where('status','delivered')->orWhere('status','collected')->with('franchise')->with('user')->whereBetween('created_at',[$fromDate,$toDate]);
                             }else{
                                $sales->where('status','!=','delivered')->where('status','!=','collected')->with('franchise')->with('user')->whereBetween('created_at',[$fromDate,$toDate]);
                             }

                        }elseif($request->orderStatus == '0' && $request->franchise != '0'){
                            $sales->where('franchise_id',$request->franchise)->with('franchise')->with('user')->whereBetween('created_at',[$fromDate,$toDate]);
                        }else{

                            $status = $request->orderStatus;
                            if($status == 'delivered'){
                                $sales->where('franchise_id',$request->franchise)->where('status','delivered')->orWhere('status','collected')->with('franchise')->with('user')->whereBetween('created_at',[$fromDate,$toDate]);
                             }else if($status == 'pending-delivery'){
                                $sales->where('franchise_id',$request->franchise)->where('status','!=','delivered')->where('status','!=','collected')->with('franchise')->with('user')->whereBetween('created_at',[$fromDate,$toDate]);
                             }elseif($status == 'collected'){
                                $sales->where('franchise_id',$request->franchise)->where('status','!=','delivered')->where('status','!=','collected')->with('franchise')->with('user')->whereBetween('created_at',[$fromDate,$toDate]);
                             }


                        }
                }
                return DataTables::of($sales)
                        ->editColumn('created_at',function($sales){
                        return  Carbon::parse($sales->created_at)->format('d-M-Y h:i:s A');
                    })->make(true);
            }

        return view('admin.sales.index',compact('franchises'));

    }

    public function getTotal(Request $request)
    {
        $sales = Order::where('did_pay','!=',3)->where('status','!=','refunded')->sum('total');
        if($request->has('to_date') && $request->has('from_date')){
            $fromDate =  Carbon::parse($request->from_date)->startOfDay();
            $toDate =  Carbon::parse($request->to_date)->endOfDay();
            if($request->franchise == '0' &&  $request->orderType == '0'){
                $sales = Order::where('did_pay','!=',3)->whereBetween('created_at',[$fromDate,$toDate])->sum('total');
            }else if($request->franchise == '0'){
                $sales = Order::where('did_pay','!=',3)->where('type',$request->orderType)->whereBetween('created_at',[$fromDate,$toDate])->sum('total');
            }elseif($request->orderType == '0'){
                $sales = Order::where('did_pay','!=',3)->where('franchise_id',$request->franchise)->whereBetween('created_at',[$fromDate,$toDate])->sum('total');
            }else{
                $sales = Order::where('did_pay','!=',3)->where('franchise_id',$request->franchise)->where('type',$request->orderType)->whereBetween('created_at',[$fromDate,$toDate])->sum('total');
            }


            //$sales->where('franchise_id',$request->franchise);
        }

        return $sales;
    }

    public function submitRefund(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $order = Order::with('user')->findOrFail($request->id);
        $token =  $order->user->notification_token;
        $order->status = 'refunded';
        $order->refund_type = 'manual_refund';
        $order->save();
        $orderDetails = '{ "order_id":'.$order->id.',"order_status":"'.$order->status.'","notification_type":"order status changed"}';
        $orderToJson = json_decode($orderDetails,true);
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
        CURLOPT_POSTFIELDS => array('to' => $token,'data' => $orderDetails),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer AAAAtxRHABo:APA91bGQR3Pu10v3SFiUdLQHvdGVaKSK1j4cduqoQ6yBLkA1l-zBR9d6X24dG5W8aga1yGXA7znNdf_nnsx8Dsdd3LwWMyUd64HAdSKP2IRABtmOZu9C-sdbV2o19jiyiv_2CiWDvNGN'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;
        return response([
            'success'=>true,
            'message'=>'Order has been mark as manual refund',
        ]);
    }





}
