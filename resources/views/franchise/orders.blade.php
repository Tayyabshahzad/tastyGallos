@extends('layouts.master')
@section('title', 'Orders')
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
                        <a href="{{ route('franchise.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Orders</span>
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
                            <span class="card-label font-weight-bolder text-dark">Orders</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">
                        <div class="row mb-10">
                            <div class="col-lg-3">
                                <div class="  form-group">
                                    <label class="font-weight-bold">Select Type: *</label>
                                    <select class="form-control" id="order_types">
                                        <option value="*"> All </option>
                                        <option value="pickUp"> PickUp </option>
                                        <option value="delivery"> Delivery </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">

                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="  form-group pt-8">
                                    <button class="btn btn-danger btn-square" id="orderExport"> Export to Excel </button>
                                </div>
                            </div>
                        </div>


                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="orders">
                                    <thead>
                                        <tr class="  text-uppercase">
                                            <th style="" class="pl-7">
                                                <span class="text-dark-75"> Order Number </span>
                                            </th>
                                            <th> Type</th>
                                            <th> Customer </th>
                                            <th> Bill Amount (ZAR) </th>
                                            <th> Status </th>
                                            <th> Time & Date </th>
                                            <th> Details </th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 4-->
            </div>
        </div>
    </div>

    @include('franchise.partials.orderDetail')
@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#orders').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                ajax: '{!! route('franchise.orders') !!}',
            },
            dom: 'Bfrtip',
            buttons: [
                'excel',
            ],
            columns: [{
                    data: function(data) {
                        return data.order_number;
                    },
                    name: 'order_number',
                    orderable: true,
                },
                {
                    data: function(data) {
                        return data.type;
                    },
                    name: 'type',
                    orderable: true,
                },

                {
                    data: function(data) {
                        return `<a href='{{ route('admin.users.edit') }}/${data.user.id}'> ${data.user.name} </a>`;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function(data) {
                        return data.total;
                    },
                    name: 'total',
                    orderable: true,
                },

                {
                    data: function(data) {
                        return data.status;
                    },
                    name: 'status',
                    orderable: true,
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: function(data) {
                        return ` <button class="btn btn-sm btn-icon btn-light-warning btn-square orderDetail"
                                    data-toggle="modal" data-target="#order_detail"
                                    data-order_id="${data.id}">
                                        <i class="icon-1x text-dark-5 flaticon-eye"></i>
                                    </button>`;
                    },
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#product_franchise').select2({
            placeholder: "Select a Franchise",
        });
        $(document).on("click", ".orderDetail", function() {
            var changeStatus = $('.changeStatus').prop('disabled', false);
            $('#order_number').html('');
            $('#order_Status').html('');
            $('#order_type').html('');
            $('#order_address').html('');
            $('#order_user').html('');
            $('#order_phonenumber').html('');
            $('#order_orderaddress').html('');
            $('#orderDetailTable').append('');
            $('#orderDetailTable').html('');
            $('#subTotal').html('');
            $('#extrasTotal').html('');
            $('#order_note').html('');
            $('#promotion_ul').html('');
            $('#paymentMethod').html('');
            var order_id = $(this).data('order_id');
            $.ajax({
                url: "{{ route('franchise.order.detail') }}",
                method: 'get',
                data: {
                    id: order_id,
                },
                success: function(data) {
                    var sum = 0;
                    var orderProducts = '';
                    var promotionDetail = '';
                    var promotions = '';
                    var promotion_ul = '';
                    var subUl = '';
                    var extras = '';
                    if (data.promotions.length > 0) {
                        $.each(data.promotions, function(index, promotion) {
                            if (promotion.promotion.type == 'bogo') {
                                subUl =
                                    `<ul> <li> <strong> Buy Product: </strong>  ${promotion.promotion.buy_product.name} : <strong> Free Product </strong>  ${promotion.promotion.get_product.name}</li> </ul>`;
                            } else {
                                subUl =
                                    `<ul> <li> <strong> Type </strong>  ${promotion.promotion.discount_type}  -<strong> Value </strong>  ${promotion.promotion.amount}</li> </ul>`;
                            }

                            promotion_ul +=
                                `<li> <a href='{{ route('admin.promotions.edit') }}/${promotion.promotion.id}' target='_blank'>${promotion.promotion.type}</a> ${subUl} </li>`;

                        });
                    } else {
                        var promotion_ul = 'No Promotion';
                    }
                    $.each(data.order.order_extras, function(index, extraItem) {
                        extras += ` ${extraItem.extra.name} ,`;
                    });
                    $.each(data.orderProducts, function(index, key) {
                        var itemAlong = '';
                        $.each(key.items, function(index, item) {
                            sum += parseInt(item.price);
                            itemAlong +=
                                `<a href='{{ route('admin.products.edit') }}/${item.product.id}' class='text-info'> ${item.product.name} , </a>`;
                        });
                        orderProducts +=
                            `<tr>
                            <td> ${key.product.name} <small>  </small> </td>
                            <td> ${key.quantity} </td>
                            <td> ${key.price}   </td>
                            <td> ${key.discount}   </td>
                            <td> ${key.vat}   X ${key.quantity} </td>
                            <td> ${itemAlong}</td>
                            <td> ${extras}</td>
                            </tr>`;
                    });
                    var dealList = '';
                    var extraList = '';
                    var modifierList = '';
                    var dealChildList = '';
                    var mybogoProduct = '';
                    var mybogoModifier = '';
                    $.each(data.order.order_deals, function(index, deals) {
                        $.each(deals.deal.products, function(index, product) {
                            dealChildList += `<li> ${product.name} </li> `;
                        });
                        dealList += `<li style="width:111%">
                                ${deals.deal.title} x  ${deals.quantity}  - ${deals.deal.price} ZAR
                                <ul id=''>
                                    ${dealChildList}
                                </ul>
                            </li>`;
                    });
                    $.each(data.order.order_deals_extra, function(index, extras) {
                        extraList +=
                            `<li> ${extras.extra.name}   -  ${extras.price} ZAR </li> `;
                    });
                    $.each(data.order.order_deals_modifiers, function(index, modifiers) {
                        modifierList +=
                            `<li> ${modifiers.modifier.name} <ul><li> ${modifiers.item.name} - ${modifiers.item.price} ZAR</li></ul></li> `;
                    });
                    $.each(data.order.bogo_products, function(index, bogo_product) {
                        var freeExtraItems = '';
                        var freeExtraItems = '';
                        var extraItems = '';
                        var extraItemsFree = '';
                        var bogoPaidModifiersWithItems = '';
                        var bogoFreeModifiersWithItems = '';
                        var product_id = bogo_product.id;
                        var bogoProductId = bogo_product.product.id;
                        // Query for Bogo Extras
                        $.ajax({
                            url: "{{ route('franchise.orders.bogo.extras') }}",
                            method: 'post',
                            data: {
                                extra_id: product_id,
                            },
                            success: function(data) {
                                var productExtras = data.extra_products;
                                $.each(productExtras, function(index, itemExtras) {
                                    if (itemExtras.is_free == false) {
                                        extraItems += `<li>${itemExtras.extra.name} - ${itemExtras.extra.price} ZAR</li>`;
                                        $('#bogoPaidExtras').html(extraItems);
                                    } else if (itemExtras.is_free == true) {
                                        extraItemsFree += `<li> ${itemExtras.extra.name} - ${itemExtras.extra.price} ZAR </li>`;
                                        $('#bogoFreeExtras').html(`<ul>` +
                                            extraItemsFree + `</ul>`);
                                    }
                                });
                            }
                        });
                        // Query for Bogo Modifers
                        $.ajax({
                            url: "{{ route('franchise.orders.bogo.modifiers') }}",
                            method: 'post',
                            data: {
                                product_id: bogoProductId,
                                order_id: data.order.id,
                            },
                            success: function(data) {
                                $.each(data.bogoOrderModifiers, function(index, bogoOrderModifier) {
                                    if(bogoOrderModifier.is_free == true){
                                        bogoFreeModifiersWithItems+= `<li style='width:100%'> ${bogoOrderModifier.bogo_modifier.name}  ->  ${bogoOrderModifier.item.name}  - ${bogoOrderModifier.item.price} ZAR </li>`;
                                    }else if(bogoOrderModifier.is_free == false){
                                        bogoPaidModifiersWithItems+= `<li style='width:100%'> ${bogoOrderModifier.bogo_modifier.name}  ->  ${bogoOrderModifier.item.name}  - ${bogoOrderModifier.item.price} ZAR</li>`;
                                    }

                                });

                                $('#bogoPaidModifiersWithItems').html(bogoPaidModifiersWithItems);
                                $('#bogoFreeModifiersWithItems').html(bogoFreeModifiersWithItems);

                            }
                        });
                        mybogoProduct += ` <tr>
                            <td colspan="4"> ${bogo_product.product.name} - ${bogo_product.product.price} ZAR
                                <ul>
                                    <li>
                                        Extras
                                        <ul id="bogoPaidExtras"></ul>
                                    </li>
                                    <li>
                                        Modifiers
                                        <ul id="bogoPaidModifiersWithItems" style="width:100%"></ul>
                                    </li>
                                </ul>
                            </td>
                            <td colspan="5"> ${bogo_product.free_product.name}
                                <ul>
                                    <li>
                                        Extras
                                        <ul id="bogoFreeExtras"></ul>
                                    </li>
                                    <li>
                                        Modifiers
                                        <ul id="bogoFreeModifiersWithItems" style="width:100%"></ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>`;
                    });
                    $('#order_id').val(data.order.id);
                    $('#dealList').html(dealList);
                    $('#bogoProduct').html(mybogoProduct);
                    $('#extraList').html(extraList);
                    $('#modifierList').html(modifierList);
                    $('#order_number').html(data.order.order_number);
                    $('#order_Status').html(data.order.status);
                    $('#order_type').html(data.order.type);
                    $('#order_user').html(data.order.user.name);
                    $('#order_phonenumber').html(data.order.user.phone);
                    $('#order_orderaddress').html(data.order.user.address);
                    $('#orderDetailTable').append(orderProducts);
                    $('#orderDetailTable').html(orderProducts);
                    $('#subTotal').html(data.order.sub_total);
                    $('#extrasTotal').html(data.order.items_extra);
                    $('#extras').html(data.order.extras);
                    $('#tax').html(data.order.tax);
                    $('#order_note').html(data.order.note);
                    $('#paymentMethod').html(data.order.payment_method);
                    $('#promotion_ul').html(promotion_ul);
                    $('#discount').html(data.order.discount);
                    $('#totalAfterDiscount').html(data.order.sub_total - data.order.discount);
                    $('#delivery_charges').html(data.order.delivery_charges);
                    $('#grandTotal').html(data.order.grandTotal);
                    $('#franchise_tax').html(data.order.franchise_tax);
                    if (data.order.address != null) {
                        const orderAddress = JSON.parse(data.order.address);
                        $('#order_address').html(orderAddress.address);
                        $('#building').html(orderAddress.building_name);
                        $('#appartment').html(orderAddress.appartment_floor_number);
                    } else {
                        $('#order_address').html('');
                        $('#building').html('');
                        $('#appartment').html('');
                    }
                    if (data.order.status == 'refunded'){
                        $('.changeStatusDropDown').hide();
                        $('.refundButton').hide();
                        $('.changeStatus').hide();
                        $('.collectCashButton').hide();
                        $('.cancelOrderButton').hide();
                        return false;
                    }
                    if (data.order.status == 'pickup' || data.order.status == 'delivery') {
                        $('#order_status').val('dp');
                    } else if (data.order.status == 'delivered' || data.order.status ==
                        'collected') {
                        $('#order_status').val('dc');
                    } else {
                        $('#order_status').val(data.order.status);
                    }
                    if (data.order.status == 'cancelled') {
                        $('.changeStatusDropDown').hide();
                        $('.refundButton').hide();
                        $('.changeStatus').hide();
                        $('.collectCashButton').hide();
                        $('.cancelOrderButton').hide();
                        return false;
                    }else{
                        $('.changeStatusDropDown').show();
                        $('.refundButton').show();
                        $('.changeStatus').show();
                        $('.collectCashButton').show();
                        $('.cancelOrderButton').show();
                    }
                },
            });
        });

        $(document).on("click", ".cancelOrderButton", function() {
            var order_id = $('#order_id').val();
            $('.cancelOrderButton').prop('disabled', true);
            $.ajax({
                url: "{{ route('franchise.order.cancel') }}",
                method: 'get',
                data: {
                    id: order_id,
                },
                success: function(data) {
                    if (data.success == true) {
                        toastr.error(data.message, "Error");
                        $('.collectCashButton').prop('disabled', true);

                    } else {
                        $('.cancelOrderButton').prop('disabled', false);
                    }
                },
            });
        });

        function completeOrder() {
            var order_id = $('#order_id').val();
            Swal.fire({
                title: "Are you sure to mark order as complete?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, complete order!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    var url = '{{ route('franchise.order.status') }}';
                    status = 'collected'
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {
                            id: order_id,
                            status: status,
                        },
                        success: function(response) {

                            if (response.success == true) {
                                toastr.success('Order mark as collected', "success");
                                $('.collectCashButton').prop('disabled', true);
                                $('.cancelOrderButton').prop('disabled', true);
                            } else {
                                toastr.error('Error', "error");
                            }
                        }
                    });
                }
            });
        }

        $('#order_types').on('change', function() {
            var orderType = $('#order_types').val();
            var DT_AciveOrderURL = "{{ route('franchise.orders') }}";

            $.ajax({
                url: DT_AciveOrderURL,
                method: 'GET',
                data: {
                    orderType: orderType,
                },
            });
            $('#orders').DataTable().ajax.url(DT_AciveOrderURL + `?orderType=${orderType}`).draw();


            //   $('#orders').DataTable().ajax.url(DT_AciveOrderURL + `?orderType=${orderType}`).draw();
        });

        $(document).on("click", ".changeStatus", function() {
            var status = $('#order_status').val();
            var order_id = $('#order_id').val();
            var changeStatus = $('.changeStatus').prop('disabled', true);
            $.ajax({
                url: "{{ route('franchise.order.status') }}",
                method: 'get',
                data: {
                    id: order_id,
                    status: status,
                },
                success: function(data) {
                    if (data.success == false) {
                        toastr.error(data.message, "Error");
                    } else {
                        var DT_OrderURL = "{{ route('franchise.orders') }}";
                        $('#orders').DataTable().ajax.url(DT_OrderURL).draw();
                        $('#order_detail').modal('hide');
                        toastr.success(data.message, "Success");
                    }
                },
            });
        });
        $("#orderExport").click(function() {
            $("#orders_wrapper .buttons-excel ").click();
            return false;
        });
        $('#order_status').on('change', function() {
            $('.changeStatus').prop("disabled", false);
        });
    </script>
@endsection
