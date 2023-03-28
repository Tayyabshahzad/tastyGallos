@extends('layouts.master')
@section('title', 'Payables')
@section('page_head')
    <style>
        @media print {
            .payableContainer {
                margin-top: -52%!important;
            }

            .hideOnPrint{
                visibility: hidden;
            }
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-6 hideOnPrint">
                    <div class="col-lg-12">
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                Payables
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row payableContainer">
                    <div class="col-lg-12">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header hideOnPrint">
                                <div class="card-title">
                                    <h3 class="card-label"> Payables</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 hideOnPrint">
                                        <form method="post" action="" id="payable-filters" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="  form-group">
                                                        <label class="font-weight-bold">Select Franchise<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control select2" id="franchise" name="franchise"
                                                            required>
                                                            @foreach ($franchises as $franchise)
                                                                <option value="{{ $franchise->id }}">
                                                                    {{ $franchise->name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">From<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="fromDate"
                                                            id="fromDate" required value="{{ old('fromDate') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">To<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="toDate" id="toDate"
                                                            required value="{{ old('toDate') }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-6  ">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold pb-5"> </label> <br>
                                                        <button class="btn btn-danger btn-square" type="button" id="filter">
                                                            Filter </button>
                                                        <button class="btn btn-warning btn-square" type="button" id="reset">
                                                            Reset </button>

                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row norecord">
                                    <div class="col-lg-12 text-center">
                                        <p class="text-danger">
                                            Payables are not found for selected date, Please try different date ranges
                                        </p>
                                    </div>
                                </div>
                                <div class="row summerybox">
                                    <div class="col-lg-12">
                                        <div class="  form-group">
                                            <label class="font-weight-bold"> Total Orders: <span
                                                    id="orderCount"></span></label>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control onineTotal" disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control" value="0" disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                id="afterSubGateWayFeeOnline" disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control onlineCommission" id=""
                                                                disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control netPayFranchiseOnline"
                                                                disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control cashTotal" disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control" value="00" disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                id="afterSubGateWayFeeCash" disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control cashCommission" disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                id="netPayFranchiseCash" disabled>
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
                                                        Summary of Earnings from <span class="getFromDate"></span> to
                                                        <span class="getToDate"></span>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control netPayFranchiseOnline"
                                                                disabled>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-5">
                                                        <b> Franchise owing admin comission (cash on collection orders) </b>
                                                    </td>
                                                    <td>
                                                        <div class="input-group " style="width:140px">
                                                            <div class="input-group-prepend ">
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text" class="form-control cashCommission"
                                                                disabled>
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
                                                                <span class="input-group-text"> <b>ZAR</b></span>
                                                            </div>
                                                            <input type="text"
                                                                class="form-control remainingFranchiseAmount" disabled>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-center hideOnPrint">

                                                        <button type="button"
                                                            class="btn btn-square btn-danger payfranchise"
                                                            data-toggle="modal" data-target="#payFranchise">
                                                            Pay Franchise
                                                        </button>
                                                    </td>

                                                    <input type="hidden" id="currentFromDate">
                                                    <input type="hidden" id="currentToDate">
                                                    <input type="hidden" id="franchiseId">
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

    </div>
    @include('admin.payable.confirm-payment-modal')
    @include('admin.payable.success-payment-modal')
@endsection
@section('page_js')
    <script>
        $(document).ready(function() {

            $('#payFranchise .closeModal').on('click',function(){
                $('.payfranchise').prop('disabled', false);
            });
            $('.summerybox').hide();
            $('.norecord').hide();
            $('#reset').hide();
            $('#reset').on('click', function() {
                $('#reset').hide();
                $('.summerybox').hide();
                $('.norecord').hide();
                $('#toDate').val('');
                $('#fromDate').val('');
            });

            $("#filter").on('click', function(event) {
                event.preventDefault();
                $('.payfranchise').prop('disabled', false);
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();
                var franchise = $('#franchise').val();
                if (fromDate == '') {
                    $('#fromDate').addClass('is-invalid');
                    toastr.error('Enter from date', "Error");
                    return false;
                }
                if (toDate == '') {
                    $('#toDate').addClass('is-invalid');
                    toastr.error('Enter to date', "Error");
                    return false;
                }
                if (toDate < fromDate) {
                    $('#toDate').addClass('is-invalid');
                    $('#fromDate').addClass('is-invalid');
                    toastr.error('To date must be less then from date', "Error");
                    return false;
                }

                $.ajax({
                    url: "{{ route('admin.payables') }}",
                    method: 'get',
                    data: {
                        fromDate: fromDate,
                        toDate: toDate,
                        franchise: franchise,
                    },
                    success: function(data) {
                        $('#toDate').removeClass('is-invalid');
                        $('#fromDate').removeClass('is-invalid');
                        if (data.getTotalOrders < 1) {
                            $('.norecord').show();
                            $('.summerybox').hide();
                        } else {
                            $('#reset').show();
                            $('.summerybox').show();
                            $('.norecord').hide();
                            $('#orderCount').html(data.getTotalOrders);
                            $('.onineTotal').val(data.onlineTotal);
                            $('.cashTotal').val(data.orderCashTotal);
                            $('#afterSubGateWayFeeOnline').val(data.onlineTotal);
                            $('.onlineCommission').val(data.commissionOnline);
                            var netToFranchise = (data.onlineTotal - data.commissionOnline);
                            $('.netPayFranchiseOnline').val(netToFranchise);
                            $('#afterSubGateWayFeeCash').val(data.orderCashTotal);
                            $('.cashCommission').val(data.commissionCash);
                            $('#netPayFranchiseCash').val(data.orderCashTotal - data
                                .commissionCash);
                            $('.getFromDate').html(data.dateFrom);
                            $('.getToDate').html(data.dateTo);
                            $('#currentFromDate').val(data.dateFrom);
                            $('#currentToDate').val(data.dateTo);
                            $('#franchiseId').val(data.franchise);
                            var remainingFranchiseAmount = (netToFranchise - data.commissionCash);
                            $('.remainingFranchiseAmount').val(remainingFranchiseAmount.toFixed(2));
                        }

                    },
                });

            });
            $(".payfranchise").click(function(event) {
                var dateFrom = $('#currentFromDate').val();
                var dateTo = $('#currentToDate').val();
                var franchiseId = $('#franchiseId').val();
                var totalAmount = $('.remainingFranchiseAmount').val();
                $('#payFranchise').modal('show');
                $('#totalToPay').html(totalAmount);
                $('.payfranchise').prop('disabled', true);
                return false;
            });


            $("#confirmPaymentBtn").click(function(event) {
                var total = $('.remainingFranchiseAmount').val();
                if ($('#confirm_total').val() == '') {
                    $('#confirm_total').addClass('is-invalid');
                    toastr.error('Please enter specfic amount', "Error");
                    event.preventDefault();
                    return false;
                } else {
                    $('#confirm_total').removeClass('is-invalid');
                }

                if ($('#confirm_total').val() != total) {
                    $('#payFranchise .closeModal').click();
                    toastr.error(
                        'Amount you have entered did not match. Please reduce date range to fetch small amount',
                        "Error");
                    $('#invalidPayment').modal().show();
                    $('#amount').html(total);
                    $('#confirm_total').val('');
                    $('.payfranchise').prop('disabled', false);
                } else {

                    var dateFrom = $('#currentFromDate').val();
                    var dateTo = $('#currentToDate').val();
                    var franchiseId = $('#franchiseId').val();
                    var amountDueToFranchise = $('.remainingFranchiseAmount').val();
                    var onineTotal = $('.onineTotal').val();
                    var cashTotal = $('.cashTotal').val();
                    var onlineCommission = $('.onlineCommission').val();
                    var cashCommission = $('.cashCommission').val();

                    $.ajax({
                        url: "{{ route('admin.payables.pay') }}",
                        method: 'get',
                        data: {

                            franchiseId: franchiseId,
                            onineTotal: onineTotal,
                            cashTotal: cashTotal,
                            gatewayFee: 0,
                            onlineCommission: onlineCommission,
                            cashCommission: cashCommission,
                            amountDueToFranchise: amountDueToFranchise,
                            dateFrom: dateFrom,
                            dateTo: dateTo,

                        },
                        success: function(data) {
                            if (data.error == true) {
                                $('.payfranchise').prop('disabled', false);
                                toastr.error(data.message, "Error");
                                $('#payFranchise').modal('hide');
                                $('#invalidPayment').modal('show');
                            } else {
                                var payableid = data.payableId;
                                $(".sendEmailBtn").attr("href","invoice/email/"+payableid);
                                $('#payamentSuccess').modal('show');
                                $('#payFranchise').modal('hide');
                                $('.payfranchise').prop('disabled', true);
                                toastr.success(data.message, "Success");
                            }

                        },
                    });
                }





            });

            // $(".payfranchise").click(function(event) {
            //     var  total = $('.remainingFranchiseAmount').val();
            //     $('#totalToPay').html(total);
            //     $("#confirmPaymentBtn").click(function() {
            //         if ($('#confirm_total').val() == '') {
            //             $('#confirm_total').addClass('is-invalid');
            //             toastr.error('Please enter specfic amount', "Error");
            //             event.preventDefault();
            //             return false;
            //         }
            //         if ($('#confirm_total').val() == total) {
            //             $('#payFranchise .closeModal').click();
            //             $('#payamentSuccess').modal().show();
            //             $('#amount').html(total);

            //             var dateFrom  =  $('#currentFromDate').val();
            //             var dateTo    =  $('#currentToDate').val();

            //             alert(dateFrom);
            //             $.ajax({
            //                 url: "{{ route('admin.payables.pay') }}",
            //                 method: 'get',
            //                 data: {
            //                     dateFrom: dateFrom,
            //                     dateTo: dateTo,
            //                     franchise: franchise,
            //                 },
            //                 success: function(data) {
            //                     console.log(data);
            //                 },
            //             });

            //         } else {
            //             toastr.error(
            //                 'Amount you have entered did not match. Please reduce date range to fetch small amount',
            //                 "Error");
            //             return false;
            //         }



            //     });
            // });



            $('#franchise').select2({
                placeholder: "Select a Franchise",
            });
            $('.printData').click(function() {
                 $('#payamentSuccess').modal('hide');
                 window.print();
            });
            $('.successCloseModal').click(function() {
                 $('#reset').click();
            });

        });
    </script>


@endsection
