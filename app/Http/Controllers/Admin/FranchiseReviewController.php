<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\Review;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Button;

class FranchiseReviewController extends Controller
{
    public function getReviews(Request $request)
    {
        $reviews = Review::where('franchise_id', $request->franchiseId)->with(['user', 'order'])->orderby('id', 'desc');
        if($request->has('review_from_date') && $request->has('review_to_date')){
            $fromDate =  Carbon::parse($request->review_from_date)->startOfDay();
            $toDate =  Carbon::parse($request->review_to_date)->endOfDay();
            $reviews->whereBetween('created_at',[$fromDate, $toDate]);
        }
        return DataTables::of($reviews)
            ->addIndexColumn()

            ->editColumn('created_at', function ($reviews) {
                return  $createdAt = Carbon::parse($reviews['created_at'])->format('Y-M-d h:i:s A');;
            })
            ->make(true);
    }


    public function reviewDetail(Request $request)
    {
        $request->validate([
            'orderid' => 'required',
        ]);
        $orderProducts =   OrderProduct::where('order_id', $request->orderid)->with('product', 'items', 'items.product')->get();
        $itemsTotal =      OrderProduct::where('order_id', $request->orderid)->with('product')->with(['items'])->sum('price');
        $order = Order::where('did_pay','!=',3)->where('id',$request->orderid)->with('user','review')->first();
        $totalAmount = ($itemsTotal+$order->total);
        return response([
            'orderProducts' => $orderProducts,
            'order'=> $order,
            'itemsTotal'=> $itemsTotal,
            'total' => $totalAmount,
        ]);


    }






}
