<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendInvoice;
use App\Models\Order;
use App\Models\Payable;
use App\Notifications\InvoiceMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function index()
    {
        $payables = Payable::get();
        return view('admin.invoices.index',compact('payables'));
    }
    public function detail($id)
    {
        $payable = Payable::findOrFail($id);
        $fromDate =  Carbon::parse($payable->from_date)->startOfDay();
        $toDate =  Carbon::parse($payable->to_date)->endOfDay();
        $netAmountDueFranchiseOnline = ($payable->totalOnline - $payable->comissionOnline);
        $netAmountDueFranchiseCash   = ($payable->totalCash - $payable->comissionCash);
        $remaningAmountDueFranchise   = ($netAmountDueFranchiseOnline - $payable->comissionCash);
        $getTotalOrders   = Order::where('did_pay','!=',3)->whereBetween('created_at', [$fromDate, $toDate])->where('payment_clear',1)->count();
        return view('admin.invoices.detail',compact('payable','netAmountDueFranchiseOnline','netAmountDueFranchiseCash','remaningAmountDueFranchise','getTotalOrders'));
    }
    public function email($id)
    {
        $payable = Payable::findOrFail($id);
        $fromDate =  Carbon::parse($payable->from_date)->startOfDay();
        $toDate =  Carbon::parse($payable->to_date)->endOfDay();
        $netAmountDueFranchiseOnline = ($payable->totalOnline - $payable->comissionOnline);
        $netAmountDueFranchiseCash   = ($payable->totalCash - $payable->comissionCash);
        $remaningAmountDueFranchise   = ($netAmountDueFranchiseOnline - $payable->comissionCash);
        $getTotalOrders   = Order::where('did_pay','!=',3)->whereBetween('created_at', [$fromDate, $toDate])->where('payment_clear',1)->count();
        $getEmail = Order::where('did_pay','!=',3)->where('payable_id',$id)->with('franchise')->first();
        // Get Franchise Admin Details.
        $franchiseEmail = $getEmail->franchise->user->email;
        $emailContent = [
            'from_date' => $payable->from_date,
            'to_date' => $payable->to_date,
            'totalOrders' => $getTotalOrders,
            'totalOnline' => $payable->totalOnline,
            'remaining_after_gateWay' =>  $payable->totalOnline - $payable->gatewayFee,
            'comissionOnline' => $payable->comissionOnline,
            'netAmountDueFranchiseOnline' => $netAmountDueFranchiseOnline,
            'totalCash' => $payable->totalCash,
            'remaining_after_gateWay_in_cash' => $payable->totalCash,
            'comissionCash' => $payable->comissionCash,
            'netAmountDueFranchiseCash' => $netAmountDueFranchiseCash,
            'comissionCash' => $payable->comissionCash,
            'remaningAmountDueFranchise' => $remaningAmountDueFranchise,
        ];
       // return view('emails.invoice');
         Mail::to($franchiseEmail)->send(new SendInvoice($emailContent));
         return redirect()->back()->with('success','Invoice has been send successfully');

    }
}
