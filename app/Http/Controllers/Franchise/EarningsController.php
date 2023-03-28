<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
class EarningsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $franchise_id =  $user->franchise->id;
            $payables = Payable::where('franchise_id',$franchise_id)->orderBy('id','desc');
            if($request->has('fromDate') && $request->has('toDate') ){
                $fromDate =  Carbon::parse($request->fromDate)->startOfDay();
                $toDate =  Carbon::parse($request->toDate)->endOfDay();
                $payables =  Payable::where('franchise_id',$franchise_id)->whereBetween('created_at',[$fromDate,$toDate]);
            }
            return DataTables::of($payables)
                ->addIndexColumn()
                ->addColumn('paydate',function($payables){
                    return  Carbon::parse($payables->created_at)->startOfDay()->format('d-m-Y');
                })
                ->addColumn('dateRnage',function($payables){
                   $date =  Carbon::parse($payables->from_date)->startOfDay()->format('d-m-Y') .' &harr; '. Carbon::parse($payables->to_date)->startOfDay()->format('d-m-Y');
                    return $date;
                })
                ->rawColumns(['dateRnage'])
                ->make(true);
        }
        return view('franchise.earnings.index');
    }
    public function details($id)
    {
        $payable = Payable::findOrFail($id);
        $fromDate =  Carbon::parse($payable->from_date)->startOfDay();
        $toDate =  Carbon::parse($payable->to_date)->endOfDay();
        $netAmountDueFranchiseOnline = ($payable->totalOnline - $payable->comissionOnline);
        $netAmountDueFranchiseCash   = ($payable->totalCash - $payable->comissionCash);
        $remaningAmountDueFranchise   = ($netAmountDueFranchiseOnline - $payable->comissionCash);
        $getTotalOrders   = Order::where('did_pay','!=',3)->whereBetween('created_at', [$fromDate, $toDate])->where('payment_clear',1)->count();
        return view('franchise.earnings.details',compact('payable','netAmountDueFranchiseOnline','netAmountDueFranchiseCash','remaningAmountDueFranchise','getTotalOrders'));

    }


}
