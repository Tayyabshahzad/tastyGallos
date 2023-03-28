<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Order;
use App\Models\Payable;
use App\Models\PayableDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
class PayableController extends Controller
{
    public function index(Request $request)
    {

        $franchises = Franchise::where('status', 'active')->get();
        if ($request->ajax()) {
            $request->validate([
                'franchise' => 'required',
                'fromDate' => 'required',
                'toDate' => 'required',
            ]);
            $dateFrom =  Carbon::parse($request->fromDate)->startOfDay();
            $dateTo =  Carbon::parse($request->toDate)->endOfDay();
            $orderCashTotal   = Order::Where('status','collected')->
                                whereBetween('created_at', [$dateFrom, $dateTo])->
                                where('franchise_id', $request->franchise)->
                                where('payment_clear',0)->
                                where('payment_method','cash')->sum('total');
            $orderOnlineTotal = Order::where('status','delivered')->
                                orWhere('status','collected')->
                                whereBetween('created_at', [$dateFrom, $dateTo])->
                                where('franchise_id', $request->franchise)->
                                where('payment_clear',0)->
                                where('payment_method','pay_gate')->sum('total');
            $commissionCash   = Order::where('status','delivered')->
                                orWhere('status','collected')->
                                whereBetween('created_at', [$dateFrom, $dateTo])->
                                where('franchise_id', $request->franchise)->
                                where('payment_clear',0)->
                                where('payment_method','cash')->sum('admin_commission');

            $commissionOnline = Order::where('status','delivered')->
                                orWhere('status','collected')->
                                whereBetween('created_at', [$dateFrom, $dateTo])->
                                where('franchise_id', $request->franchise)->
                                where('payment_clear',0)->
                                where('payment_method','pay_gate')->sum('admin_commission');

            $getTotalOrders   = Order::where('status','delivered')->
                                orWhere('status','collected')->
                                whereBetween('created_at', [$dateFrom, $dateTo])->
                                where('franchise_id', $request->franchise)->
                                where('payment_clear',0)->count();

            $cashTotal   =  ($orderCashTotal - $commissionCash);
            $cashTotal =  number_format((float)$cashTotal, 2);
            $onlineTotal =  ($orderOnlineTotal - $commissionOnline);
            $onlineTotal =  number_format((float)$onlineTotal, 2);
            $amountDueFranchise = ($onlineTotal - $cashTotal);
            $amountDueFranchise =  number_format((float)$amountDueFranchise, 2);
            return response([
                'orderCashTotal' => $orderCashTotal,
                'orderOnlineTotal' => $orderOnlineTotal,
                'commissionOnline' => $commissionOnline,
                'amountDueFranchise' => $amountDueFranchise,
                'commissionCash' => $commissionCash,
                'getTotalOrders' => $getTotalOrders,
                'franchise' => $request->franchise,
                'cashTotal' => $cashTotal,
                'onlineTotal' => $orderOnlineTotal,
                'dateFrom' => $dateFrom->format('d-M-Y'),
                'dateTo' => $dateTo->format('d-M-Y'),
            ]);
        }
        return view('admin.payable.index', compact('franchises'));
    }

    public function pay(Request $request)
    {
        $request->validate([
            'franchiseId' => 'required',
            'onineTotal' => 'required',
            'cashTotal' => 'required',
            'gatewayFee' => 'required',
            'onlineCommission' => 'required',
            'cashCommission' => 'required',
            'amountDueToFranchise' => 'required',
            'dateFrom' => 'required',
            'dateTo' => 'required',
        ]);

        $fromDate =  Carbon::parse($request->dateFrom)->startOfDay();
        $toDate =  Carbon::parse($request->dateTo)->endOfDay();
        $latest = Payable::latest()->first();
        if (!$latest) {
            $batch = '1000';
        } else {
            $batch = $latest->batch + 1;
        }
        $payable = new Payable;
        $payable->totalOnline = $request->onineTotal;
        $payable->totalCash = $request->cashTotal;
        $payable->gatewayFee = $request->gatewayFee;
        $payable->comissionOnline = $request->onlineCommission;
        $payable->comissionCash = $request->cashCommission;
        $payable->amountDueToFranchise = $request->amountDueToFranchise;
        $payable->from_date = $fromDate;
        $payable->to_date = $toDate;
        $payable->franchise_id = $request->franchiseId;

        $orders = Order::where('did_pay','!=',3)->whereBetween('created_at', [$fromDate, $toDate])->where('franchise_id', $request->franchiseId)->where('payment_clear', 1)->first();
        if ($orders == null or $orders == '') {
            $payable->save();
            Order::where('did_pay','!=',3)->whereBetween('created_at', [$fromDate, $toDate])->where('franchise_id', $request->franchiseId)->update(array('payment_clear' => 1,'payable_id' => $payable->id));
            return response([
                'error' => false,
                'message' => 'Payment transfered to franchise',
                'payableId' => $payable->id
            ]);
        } else {
            return response([
                'error' => true,
                'message' => 'Payables already clear for selectd date',
            ]);
        }
    }
}
