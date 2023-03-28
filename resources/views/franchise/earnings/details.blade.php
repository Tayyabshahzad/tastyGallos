@extends('layouts.master')
@section('title', 'Earnings')
@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-12">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                    <li class="breadcrumb-item">
                        <a href="{{ route('franchise.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('franchise.earnings') }}"> Earnings </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Detail</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <form autocomplete="off" id="record_form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom card-stretch gutter-b">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <div class="  form-group">
                                                    <label class="font-weight-bold">
                                                        Earning Detail From
                                                        {{ \Carbon\Carbon::parse($payable->from_date)->startOfDay()->format('d-M-Y') }}
                                                        To
                                                        {{ \Carbon\Carbon::parse($payable->to_date)->startOfDay()->format('d-M-Y') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="  form-group">
                                                    <label class="font-weight-bold"> Total Order: {{ $getTotalOrders }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <table class="table table-separate table-head-custom table-checkable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th colspan="4">
                                                                Online Orders
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Total Amount </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->totalOnline }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Gateway Fee </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->gatewayFee }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Remaining </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->totalOnline - $payable->gatewayFee }}">
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Admin Commission <small> (Online Orders) </small>
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->comissionOnline }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Net Amount Due To Franchise </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $netAmountDueFranchiseOnline }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6">
                                                <table class="table table-separate table-head-custom table-checkable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th colspan="4">
                                                                Cash on Collection Orders
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Total Amount </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->totalCash }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            {{-- <td class="pt-5">
                                                                <b> Gateway Fee </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="0">
                                                                </div>
                                                            </td> --}}
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Remaining </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->totalCash }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Admin Commission <small> (COC) </small> </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->comissionCash }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Net Amount Due To Franchise </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $netAmountDueFranchiseCash }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-12">
                                                <table class="table table-separate table-head-custom table-checkable">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">
                                                                Summary of Payable earnings
                                                                {{ \Carbon\Carbon::parse($payable->from_date)->startOfDay()->format('d-M-Y') }}
                                                                to
                                                                {{ \Carbon\Carbon::parse($payable->to_date)->startOfDay()->format('d-M-Y') }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Total amount due to franchise (online order) </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $netAmountDueFranchiseOnline }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Franchise owing admin comission (cash on collection
                                                                    orders) </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $payable->comissionCash }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-5">
                                                                <b> Remaining amount due to franchise </b>
                                                            </td>
                                                            <td>
                                                                <div class="input-group " style="width:140px">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b>ZAR </b> </span>
                                                                    </div>
                                                                    <input type="text" disabled class="form-control"
                                                                        value="{{ $remaningAmountDueFranchise }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <a href="{{ route('franchise.earnings') }}" type="button"
                                                                    class="btn btn-square btn-danger">
                                                                    Back
                                                                </a>
                                                                <button type="button" class="btn btn-square  btn-info  " onclick="window.print();">Print Invoice</button>
                                                                {{-- <a href="{{ route('franchise.earnings.email', $payable->id) }}"  type="button" class="btn btn-square btn-primary">
                                                                    Email
                                                                </a> --}}

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var table = $('#kt_datatable').DataTable();

        $('#product_franchise').select2({
            placeholder: "Select a Franchise",
        });
    </script>
@endsection
