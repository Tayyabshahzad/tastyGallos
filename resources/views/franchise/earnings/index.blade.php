@extends('layouts.master')
@section('title', 'Earnings')

@section('page_head')
<link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />


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
                        <span class="text-muted">Earnings</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Earnings</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 hideOnPrint">
                            <form method="post" action="" id="payable-filters" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
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
                        <div class="tab-content">
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="earnings_table">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th> #</th>
                                            <th> Date</th>
                                            <th> Date Range</th>
                                            <th> AMOUNT RECEIVED <strong>(ZAR)</strong> </th>
                                            <th> Details </th>
                                        </tr>
                                    </thead>
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
        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
              $('#earnings_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('franchise.earnings') !!}',
            columns: [
                { data: function(data){ return data.DT_RowIndex; }, orderable: false, searchable: false },
                { data: function(data){ return data.paydate},name:'paydate' },
                { data: function(data){ return data.dateRnage},name:'dateRnage' },
                { data: function(data){ return data.amountDueToFranchise},name:'amountDueToFranchise' },
                { data: function(data){ return `<a  href="{{ route('franchise.earnings.detail')}}/${data.id}" class="btn btn-sm btn-icon btn-light-warning btn-square refundDetails" data-refund_id="">
                                                            <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                                </a>` },orderable:false,searchable:false },
                // { data: function(data){ return data.from_date},name:'from_date' },
                // { data: function(data){ return data.amountDueToFranchise }, name:'amountDueToFranchise' },


            ]
        });
        $('#reset').hide();
        $("#filter").on('click', function(event) {
                event.preventDefault();
                $('#reset').show();
                var DT_URL = '{!! route('franchise.earnings') !!}';
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();
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
                    url: "{{ route('franchise.earnings') }}",
                    method: 'get',
                    data: {
                        fromDate: fromDate,
                        toDate: toDate,
                    },
                    success: function(data) {

                        $('#toDate').removeClass('is-invalid');
                        $('#fromDate').removeClass('is-invalid');
                        $('#earnings_table').DataTable().ajax.url(DT_URL+`?fromDate=${fromDate}&toDate=${toDate}`).draw();

                    },
                });

            });
            $('#reset').click(function() {
             var DT_URL = '{!! route('franchise.earnings') !!}';
            $('#fromDate').val('');
            $('#toDate').val('');
            $('#earnings_table').DataTable().ajax.url(DT_URL).draw();

            $('#reset').hide();
        });
        </script>
@endsection
