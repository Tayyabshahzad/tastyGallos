@extends('layouts.master')
@section('title', 'Sales')
@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .buttons-excel {
            display: none;
        }
    </style>
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
                        <span class="text-muted">Sales</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Sales</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button class="btn btn-danger btn-square" id="exportSale"> Export To Excel</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="card-title " style="width:100%">
                            <div class="col-lg-2 ">
                                <label for=""> <small style="color:#000"> Select Franchise<span
                                            class="text-danger">*</span> </small> </label>
                                <select class="form-control franchise" style="border-radius: 0;" name="franchise"
                                    id=" " required>
                                    <option value="0">Select Franchise </option>
                                    @foreach ($franchises as $franchise)
                                        <option value="{{ $franchise->id }}"> {{ $franchise->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for=""> <small style="color:#000"> Select Status<span
                                            class="text-danger">*</span> </small> </label>
                                <select class="form-control orderStatus" required style="border-radius: 0">
                                    <option value="0">Select Status</option>
                                    <option value="delivered"> Delivered </option>
                                    <option value="pending-delivery"> Pending Delivery</option>
                                    <option value="collected"> Collected</option>
                                    {{-- <option value="delivered">   Delivered / Collected</option>
                                    <option value="undelivered"> Un Delivered </option> --}}

                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for=""> <small style="color:#000"> From Date<span
                                            class="text-danger">*</span> </small> </label>
                                <input type="date" style="border-radius:0;" id="from_date" class="form-control" />
                            </div>
                            <div class="col-lg-2">
                                <label for=""> <small style="color:#000"> To Date<span class="text-danger">*</span>
                                    </small> </label>
                                <input type="date" style="border-radius:0;" id="to_date" class="form-control" />
                            </div>
                            <div class="col-lg-2 pt-8">

                                <button type="button" class="btn btn-danger btn-square" id="filter"> Filter </button>
                                <button type="button" class="btn btn-warning btn-square" id="reset"> Reset </button>
                            </div>
                            <div class="col-lg-2 pt-8">
                                <button type="button" class="btn   btn-outline-warning btn-square"> Total ZAR <span
                                        id="total"></span> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="sales_table">
                                    <thead>

                                        <tr class="text-left text-uppercase">
                                            <th> </th>
                                            <th> Order </th>
                                            <th> Type </th>
                                            <th> Franchise </th>
                                            <th> Customer </th>
                                            <th> Status </th>
                                            <th> Bill Amount <strong>(ZAR)</strong></th>
                                            <th> Admin Commission <strong>(ZAR)</strong></th>
                                            <th> Net Payment Due to Franchise <strong> (Inc VAT) (ZAR) </strong> </span>
                                            </th>
                                            <th> Date Time</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.sales.manual-adjustment-modal')
@endsection
@section('page_js')
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var DT_URL = '{!! route('admin.sales') !!}';
        var Sale_Total_URL = '{!! route('admin.sales.getTotal') !!}';
        $('#reset').hide();
        $('#filter').click(function() {
            $("#from_date").removeClass('is-invalid');
            $("#to_date").removeClass('is-invalid');
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var franchise = $('.franchise').val();
            var orderStatus = $('.orderStatus').val();
            if (from_date != '' && to_date != '') {
                if (to_date < from_date) {
                    toastr.error("To date couldn't be greater then from date", "Error");
                }
                $('#reset').show();
                $.ajax({
                    url: Sale_Total_URL,
                    method: 'POST',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        franchise: franchise,
                        orderStatus: orderStatus,
                    },
                    success: function(response) {
                        $('#total').html(response);
                    },
                });
                $('#sales_table').DataTable().ajax.url(DT_URL +
                    `?from_date=${from_date}&to_date=${to_date}&franchise=${franchise}&orderStatus=${orderStatus}`
                ).draw();

            } else {
                toastr.error('Please select date to continue', "success");
                $("#from_date").addClass('is-invalid');
                $("#to_date").addClass('is-invalid');
            }
        });
        $('#reset').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            // $('#orderType option[value=0]').attr('selected','selected');
            $("#orderType ").val("0").change();
            $("#franchise").val("0").change();
            $('#sales_table').DataTable().ajax.url(DT_URL).draw();
            genrateTotal();
            $('#reset').hide();
        });
        $('#franchise').select2({
            placeholder: "Select a Franchise",
        });
        $('#orderType').select2({
            placeholder: "Select Order Type",
        });
        $('#sales_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: DT_URL,
            dom: 'Bfrtip',
            buttons: [
                'excel',
            ],
            columns: [{
                    data: function(data) {
                        if(data.status == 'refunded'){
                            var disableBtn = 'disabled';
                            var title = 'The order has been marked as manual refund';
                        }else{
                            var disableBtn = '';
                            var title = '';
                        }
                        return `<button class="btn btn-light-warning btn-sm btn-square" title='${title}' ${disableBtn} onclick='manulRefund(${data.id})'>  Manual Adjustment </button>`;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'order_number',
                    name: 'order_number',

                },
                {

                    data: 'type',
                    name: 'type',
                },
                {
                    data: function(data) {
                        return `<a href='{{ route('admin.franchises.edit') }}/${data.franchise.id}'> ${data.franchise.name} </a>`;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return `<a href='{{ route('admin.users.edit') }}/${data.user.id}'> ${data.user.name} </a>`;

                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data:'grandTotal',
                    name:'grandTotal',

                },
                {
                    data: function(data){
                       return adminCommission = data.admin_commission.toFixed(2);
                    },
                    name: 'admin_commission'
                },
                {
                    data: function(data) {
                        var payment_due_franchise = (data.grandTotal - data.admin_commission);
                        return payment_due_franchise.toFixed(2);
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: false
                },
            ],
        });
        genrateTotal();

        function genrateTotal() {
            $.ajax({
                type: 'post',
                url: '{{ route('admin.sales.getTotal') }}',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#total').html(response);
                },
            });
        }

        $("#exportSale").click(function() {
            $("#sales_table_wrapper .buttons-excel ").click();
            return false;
        });

        function manulRefund(id) {
            Swal.fire({
                title: "Are you sure to refund order manually?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, refund it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {

                    $.ajax({
                        url: '{{ route('admin.manual.refund.submit') }}',
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response.message, "Success");
                                $('#set_special_price').modal('hide');
                                $("#productsTable").load(" #productsTable");
                                $('#sales_table').DataTable().ajax.url(DT_URL).draw();
                                genrateTotal();

                            } else {
                                toastr.error(response.message, "Error");
                            }

                            console.log(response);
                        },
                    });


                }
            });
        }
    </script>
@endsection
