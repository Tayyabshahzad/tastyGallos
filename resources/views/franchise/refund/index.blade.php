@extends('layouts.master')
@section('title', 'All Refunds')
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
                        <span class="text-muted">Refund</span>
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
                            <h3 class="card-label">Refunds</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <a href="{{ route('franchise.refunds.create') }}" class="btn btn-danger btn-square"
                                    id="refundExport"> Refund Order </a>

                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-header">
                        <div class="row mt-5 input-daterange" style="width:100%; ">
                            <div class="col-lg-2">
                                <div class="  form-group">
                                    <label class="font-weight-bold">From Date<span class="text-danger">*</span></label>
                                    <input type="date" name="from_date" id="from_date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="  form-group">
                                    <label class="font-weight-bold">To Date<span class="text-danger">*</span></label>
                                    <input type="date" name="to_date" id="to_date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2 form-group pt-8">
                                <button type="button" id="filter" class="btn btn-danger btn-square filter"> Filter </button>
                                <button type="button" id="refresh" class="btn btn-warning btn-square filter"> Reset </button>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="refund_table">
                                    <thead>
                                        <tr class="  text-uppercase">
                                            <th>#</th>
                                            <th style="" class="pl-7"> <span class="text-dark-75"> Order Number
                                                </span> </th>
                                            <th> Date</th>
                                            <th> Customer </th>
                                            <th> Bill Amount (ZAR) </th>
                                            <th> Status </th>
                                            <th> Action </th>
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
    @include('franchise.refund.partials.refund-detail-model')
@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $('#refund_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('franchise.refunds') !!}',
            columns: [{
                    data: function(data) {
                        return data.DT_RowIndex;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return data.orderNumber
                    },
                    name: 'order_id'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: function(data) {
                        return data.user
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return data.totalAmount
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return data.status;
                    },
                    name: 'status'
                },
                {
                    data: function(data) {
                        if (data.status == 'canceled' || data.status == 'refunded') {
                            return `<button class='btn btn-sm btn-icon btn-light-warning btn-square orderDetail' data-toggle="modal"
                            data-target="#refund_order_detail"
                            data-order_id="${data.order.id}"
                            data-refund="${data.id}"> <i class='icon-1x text-dark-5 flaticon-eye'></i></button>
                            `;
                        }


                        else {
                            return `
                            <button class='btn btn-sm btn-icon btn-light-warning btn-square orderDetail' data-toggle="modal"
                            data-target="#refund_order_detail"
                            data-order_id="${data.order.id}"
                            data-refund="${data.id}"> <i class='icon-1x text-dark-5 flaticon-eye'></i></button>


                          `;
                          // This is Refund Delete Button and we disable it
                        //   <button  class="btn btn-sm btn-icon btn-light-danger btn-square" onclick="deleteRequest(${data.id})">
                        //                     <i class="icon-1x text-dark-5 flaticon-delete"></i>
                        //     </button>
                        }

                    },
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });


        function deleteRequest(id) {
            Swal.fire({
                title: "Are you sure to delete ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    var url = '{{ route('franchise.refund.delete') }}';
                    $.ajax({
                        url: url,
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var table = $('#refund_table').DataTable();
                            table.ajax.reload(null, false);
                            if (response.success == true) {
                                toastr.success(response.message, "success");
                            } else {
                                toastr.error(response.message, "error");
                            }
                        }
                    });
                }

            });
        }
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("click", ".orderDetail", function() {

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
            var refund = $(this).data('refund');
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
                                        extraItems +=
                                            `<li>${itemExtras.extra.name} - ${itemExtras.extra.price} ZAR</li>`;
                                        $('#bogoPaidExtras').html(
                                            extraItems);
                                    } else if (itemExtras.is_free == true) {
                                        extraItemsFree +=
                                            `<li> ${itemExtras.extra.name} - ${itemExtras.extra.price} ZAR </li>`;
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
                                $.each(data.bogoOrderModifiers, function(index,
                                    bogoOrderModifier) {
                                    if (bogoOrderModifier.is_free == true) {
                                        bogoFreeModifiersWithItems +=
                                            `<li style='width:100%'> ${bogoOrderModifier.bogo_modifier.name}  ->  ${bogoOrderModifier.item.name}  - ${bogoOrderModifier.item.price} ZAR </li>`;
                                    } else if (bogoOrderModifier.is_free ==
                                        false) {
                                        bogoPaidModifiersWithItems +=
                                            `<li style='width:100%'> ${bogoOrderModifier.bogo_modifier.name}  ->  ${bogoOrderModifier.item.name}  - ${bogoOrderModifier.item.price} ZAR</li>`;
                                    }

                                });

                                $('#bogoPaidModifiersWithItems').html(
                                    bogoPaidModifiersWithItems);
                                $('#bogoFreeModifiersWithItems').html(
                                    bogoFreeModifiersWithItems);

                            }
                        });
                        mybogoProduct += ` <tr>
                            <td colspan="4" style="color:#000"> ${bogo_product.product.name} - ${bogo_product.product.price} ZAR
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
                            <td colspan="5" style="color:#000"> ${bogo_product.free_product.name}
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
                    $('.cancelReasonTh').hide();
                    $.ajax({
                        url: "{{ route('franchise.refund.detail') }}",
                        method: 'get',
                        data: {
                            id: order_id,
                            refund: refund,
                        },
                        success: function(data) {
                            $('#refund_status').html(data.refund.status);
                            $('#refund_reason').html(data.refund.reason);
                            if(data.refund.status == 'canceled'){
                                $('.cancelReasonTh').show();
                                $('.cancelReason').html(data.refund.cancel_reason);
                            }

                        },
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

                },
            });
        });
    </script>
@endsection
