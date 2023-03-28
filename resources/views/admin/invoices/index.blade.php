@extends('layouts.master')
@section('title', 'Invoices')
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
                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Invoices</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Invoices</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                    </div>
                    <div class="card-header">
                        {{-- <div class="card-title mb-4" style="width:100%">
                            <div class="col-lg-2">
                                <label for=""> <small style="color:#000"> From Date<span class="text-danger">*</span> </small> </label>
                                <input type="date" style="border-radius:0;" id="from_date" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label for=""> <small style="color:#000"> To Date<span class="text-danger">*</span> </small> </label>
                                <input type="date" style="border-radius:0;" id="to_date" class="form-control">
                            </div>
                            <div class="col-lg-2 pt-8">

                                <button type="button" class="btn btn-danger btn-square mt-1" id="filter"> Filter </button>
                                <button type="button" class="btn btn-warning btn-square" id="reset" style="display: none;"> Reset </button>
                            </div>

                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="productTable">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th> #</th>
                                            <th> Date</th>
                                            <th> Date Range</th>
                                            <th> AMOUNT RECEIVED <strong>(ZAR)</strong> </th>
                                            <th> Details </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payables as $payable )
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($payable->created_at)->startOfDay()->format('d-m-Y') }}

                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($payable->from_date)->startOfDay()->format('d-m-Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($payable->to_date)->startOfDay()->format('d-m-Y') }}

                                                    </td>
                                                    <td>
                                                        {{ $payable->amountDueToFranchise }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.invoice.detail',$payable->id)}}" class="btn btn-sm btn-icon btn-light-warning btn-square" onclick="deleteModifier(4)">
                                                            <i class="icon-1x text-dark-5 flaticon-eye"></i>
                                                            </a>
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
