@extends('layouts.master')
@section('title', 'Refund')
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
                        <a href="{{ route('franchise.refunds') }}"> Refunds </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Refund Create</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Advance Table Widget 4-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Refund Request</span>
                        </h3>
                    </div>
                    <div class="card-header border-0 py-5">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Search Order Number" id="search"  >
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <table class="table">
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="row"  id="orderDetailContainer">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold"> Order Number:</label>
                                             #<span id="order_number"></span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold"> Order Date:</label>
                                            <span id="order_date"></span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold"> Customer:</label>
                                            <span id="customer"></span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold"> Phone#:</label>
                                            <span id="phone"></span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label class="font-weight-bold"> Address:</label>
                                            <span id="address"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th> Name </th>
                                                        <th> Qty </th>
                                                        <th> Price </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="orderDetail">
                                                </tbody>
                                                <tfoot>
                                                    <form action="{{ route('franchise.refunds.request.save') }}" method="post"  enctype="multipart/form-data">
                                                        @csrf
                                                    <tr>
                                                        <input type="hidden" name="order_id"  id="order_id">
                                                        <input type="hidden" name="franchise_id" id="franchise_id">
                                                        <input type="hidden" name="user_id" id="user_id">
                                                        <td colspan="3" class="font-weight-bold">
                                                            <textarea  class="form-control"  name="reason" required placeholder="Enter Refund Reason"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="font-weight-bold">
                                                            <button class="btn btn-danger btn-square" type="submit"> Request Refund </button>
                                                            <a href="{{ route('franchise.refunds') }}" class="btn btn-warning btn-square"> Cancel </a>
                                                        </td>
                                                    </tr>
                                                    </form>
                                                </tfoot>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 4-->
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        $('#orderDetailContainer').hide();
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        var table = $('#kt_datatable').DataTable();
        $('#product_franchise').select2({
            placeholder: "Select a Franchise",
        });
        $('#search').on('keyup', function() {
            var value = $(this).val();
            var franchise = "{{ $franchise}}";
            var details = '';
            $.ajax({
                type: 'get',
                url: '{{ route('franchise.refunds.search') }}',
                data: {
                    'search': value,
                    'franchise_id':franchise ,
                },
                success: function(data) {
                    $('#orderDetailContainer').hide('slow');
                    var orderDetails = '';
                    if(data.orders != ''){
                        $.each(data.orders, function(index, order) {
                            orderDetails +=
                                `<tr>
                                    <td> ${order.order_number}   </td>
                                    <td class='text-right'>  <button  class="btn btn-sm btn-info btn-square" onclick="orderDetails(${order.id})"> Select </button>   </td>
                                </tr>`;
                        });
                    }else{
                        orderDetails +=
                                `<tr>
                                    <td colspan='2' class='text-center text-danger'> No record found  </td>
                                </tr>`;

                    }
                    $('#tableBody').html(orderDetails);

                }
            });
        })


        function orderDetails(id){
                $.ajax({
                type: 'get',
                url: '{{ route('franchise.refunds.order.details') }}',
                data: {
                    'id': id,

                },
                success: function(data) {
                    if(data.success == true){
                        $('#orderDetailContainer').show('slow');
                        $('#search').val(data.order.order_number);
                        $('#tableBody').html('');
                        $('#order_number').html(data.order.order_number);
                        $('#order_date').html(data.order.order_date);
                        $('#customer').html(data.order.user.name);
                        $('#phone').html(data.order.user.phone);
                        $('#address').html(data.order.user.address);
                        var orderData = '';

                        $('#order_id').val(data.order.id);
                        $('#franchise_id').val(data.order.franchise_id);
                        $('#user_id').val(data.order.user_id);

                        $.each(data.products, function(index, product) {

                                orderData +=`<tr>
                                                <td> ${product.product.name}   </td>
                                                <td> ${product.quantity}   </td>
                                                <td> ${product.price}   </td>
                                             </tr>`;
                        });
                        $('#orderDetail').html(orderData);

                    }
                }

            });
        }
    </script>


@endsection
