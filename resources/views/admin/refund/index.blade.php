@extends('layouts.master')
@section('title', 'Refund List')
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
                        <span class="text-muted">Refunds</span>
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
                                <button href="#" class="btn btn-danger btn-square" id="refundExport"> Export To
                                    Excel</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row mt-5 input-daterange" style="width:100%; ">
                            <div class="col-lg-3">
                                <div class=" form-group">
                                    <label class="font-weight-bold">Select Franchise<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" name="franchise" id="franchise" required>
                                        <option value="0"> All Franchises </option>
                                        @foreach ($franchises as $franchise)
                                            <option value="{{ $franchise->id }}"> {{ $franchise->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3">
                                <div class=" form-group">
                                    <label class="font-weight-bold">Order Type<span class="text-danger">*</span></label>
                                    <select class="form-control" name="orderType" id="orderType" required>
                                        <option value="pickup"> Pick Up </option>
                                        <option value="delivery"> Delivery </option>
                                    </select>
                                </div>
                            </div> --}}
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
                                <button type="button" id="filter" class="btn btn-danger btn-square filter"> Filter
                                </button>
                                <button type="button" id="refresh" class="btn btn-warning btn-square filter"> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="refund_table">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th class="pl-7"> <span class="text-dark-75"> Order </span> </th>
                                            <th> Customer </th>
                                            <th> Franchise</th>
                                            <th> Bill Amount <strong>(ZAR)</strong></th>
                                            <th> Admin Commission <strong>(ZAR)</strong></th>
                                            <th> Franchise Amount <strong>(ZAR)</strong></th>
                                            <th> Date </th>
                                            <th> Status</th>
                                            <th> Action</th>
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
    @include('admin.refund.refund-detail-modal')
    @include('admin.refund.cancel-refund-modal')
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
        $('#refresh').hide();
        $('#franchise').select2({
            placeholder: "Select Franchise",
        });
        var DT_URL = '{!! route('admin.refunds') !!}';
        $(document).on("click", ".refundDetails", function() {
            $('.cancelReasonTh').hide();
            $('.cancelReason').val('');

            $('#orderDetailTable').html('');
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
            var refund_id = $(this).data('refund_id');
            $.ajax({
                url: '{!! route('admin.refunds.orderDetail') !!}',
                method: 'get',
                data: {
                    refund_id: refund_id,
                },
                success: function(data) {
                    if (data.refund.status == 'pending') {
                        $('.issue_refund').show();
                        $('#cancleRequestBtn').show();
                        $('#cancelReason').html('');
                    } else {
                        $('.issue_refund').hide();
                        $('#cancleRequestBtn').hide();
                    }
                    if (data.refund.status == 'canceled') {
                        // alert(data.refund.cancel_reason);
                        $('.cancelReason').val(data.refund.cancel_reason);
                        $('.cancelReasonTh').show();
                    } else {
                        $('#cancelReason').html(``);
                    }
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
                        <td style="width:5%"> ${key.vat}   X ${key.quantity} </td>
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
                            url: "{{ route('admin.franchise.order.extras') }}",
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
                            url: "{{ route('admin.franchise.orders.bogo.modifier') }}",
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
                    $('#dealList').html(dealList);
                    $('#extraList').html(extraList);
                    $('#modifierList').html(modifierList);
                    $('#bogoProduct').html(mybogoProduct);
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
                    $('#order_note').html(data.order.note);
                    $('#paymentMethod').html(data.order.payment_method);
                    $('#promotion_ul').html(promotion_ul);
                    $('#discount').html(data.order.discount);
                    $('#totalAfterDiscount').html(data.order.sub_total - data.order.discount);
                    $('#grandTotal').html(data.order.grandTotal);
                    $('#order_date').html(data.order.created_at);
                    $('#refund_status').html(data.refund.status);
                    $('#refund_reason').val(data.refund.reason);
                    $('#refund_id').val(data.refund.id);
                    $('#order_id').val(data.order.id);
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




        $(".issue_refund").on("click", function(e) {
            var refund_id = $('#refund_id').val();
            var order_id = $('#order_id').val();
            Swal.fire({
                title: "Are you sure to mark order as refund ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, refund it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    $(".issue_refund").prop('disabled', true);
                    $.ajax({
                        url: '{!! route('admin.refunds.issue') !!}',
                        method: 'get',
                        data: {
                            refund_id: refund_id,
                            order_id: order_id,
                        },
                        success: function(response) {
                            $('#orderDetailTable').html('');
                            $(".issue_refund").prop('disabled', false);
                            $('#refundDetails').modal('hide');
                            var table = $('#refund_table').DataTable();
                            table.ajax.reload(null, false);
                            if (response.success == true) {
                                toastr.success(response.message, "success");
                            } else {
                                toastr.error(response.message, "error");
                            }
                        },
                    });
                }else{
                    $(".issue_refund").prop('disabled', false);
                }
            });




        });
        $(".modalClose").on("click", function(e) {
            var table = $('#refund_table').DataTable();
            table.ajax.reload(null, false);
            $("#cancelRefundFrom")[0].reset();
            $("#cancel_refund_reason").removeClass('is-invalid');
            $('.issue_refund').prop('disabled', false);
            $('#cancleRequestBtn').prop('disabled', false);
        });
        $("#cancleRequestBtn").on("click", function(e) {
            var refund_id = $('#refund_id').val();
            $('#cancel_refund_id').val(refund_id);
            $('#refundDetails').modal('hide');
        });
        $(".refundCancelBtn").on("click", function(e) {
            var cancel_refund_id = $('#cancel_refund_id').val();
            var cancel_refund_reason = $('#cancel_refund_reason').val();
            if (cancel_refund_reason == '') {
                e.preventDefault();
                toastr.error('Please enter refund cancel reason', "Error");
                $("#cancel_refund_reason").addClass('is-invalid');
                return false;
            }
            if (cancel_refund_reason.length < 10) {
                e.preventDefault();
                toastr.error('Please enter at least 10 characters as reason', "Error");
                $("#cancel_refund_reason").addClass('is-invalid');
                return false;
            }
            $(".refundCancelBtn").prop('disabled', true);
            $.ajax({
                url: '{!! route('admin.refunds.cancel') !!}',
                method: 'get',
                data: {
                    cancel_refund_id: cancel_refund_id,
                    cancel_refund_reason: cancel_refund_reason,
                },
                success: function(response) {
                    $('#orderDetailTable').html('');
                    $(".refundCancelBtn").prop('disabled', false);
                    $('#cancleRequest').modal('hide');
                    $("#cancelRefundFrom")[0].reset();
                    var table = $('#refund_table').DataTable();
                    table.ajax.reload(null, false);
                    if (response.success == true) {
                        toastr.success(response.message, "success");
                    } else {
                        toastr.error(response.message, "error");
                    }
                },
            });
        });
        $('#filter').click(function() {
            $("#from_date").removeClass('is-invalid');
            $("#to_date").removeClass('is-invalid');
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var franchise = $('#franchise').val();
            var orderType = $('#orderType').val();
            if (from_date != '' && to_date != '') {
                if (to_date < from_date) {
                    toastr.error("To date couldn't be greater then from date", "Error");
                }
                $('#refresh').show();
                $('#refund_table').DataTable().ajax.url(DT_URL +
                        `?to_date=${to_date}&from_date=${from_date}&franchise=${franchise}&orderType=${orderType}`)
                    .draw();
            } else {
                toastr.error('Please select date to continue', "Error");
                $("#from_date").addClass('is-invalid');
                $("#to_date").addClass('is-invalid');

            }
        });
        $('#refund_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: DT_URL,
            dom: 'Bfrtip',
            buttons: [
                'excel',
            ],
            columns: [


                {

                    data: function(data) {
                        return data.order.order_number;
                    },
                    orderable: false,
                    searchable: false
                },
                // {
                //     data: function(data) {
                //         return data.franchise.name;
                //     },
                //     orderable: false,
                //     searchable: false
                // },
                {
                    data: 'user',
                    name: 'user.name'
                },
                {
                    data: 'franchise',
                    name: 'franchise.name'
                },


                {
                    data: function(data) {
                        return data.order.grandTotal;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function(data) {
                        return data.order.admin_commission;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function(data) {
                        var total = (data.order.grandTotal);
                        return (total - data.order.admin_commission);
                    },
                    orderable: false,
                    searchable: false
                },


                {
                    data: 'date',
                    name: 'date',
                    orderable: false,
                },
                {
                    data: function(data) {
                        return `<span class="text-dark-75 d-block text-warning" data-toggle="modal" data-target="">
                                        <button  class="btn btn-sm  ${data.refund_status} btn-square statusButtons" >
                                                ${data.status}
                                        </button>
                                </span>`;
                    },
                    name: 'status',
                },
                {
                    data: function(data) {
                        return `<span class="text-dark-75 d-block text-warning" data-toggle="modal" data-target="#refundDetails">
                                    <button class="btn btn-sm btn-icon btn-light-warning btn-square refundDetails" data-refund_id="${data.id}">
                                            <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                    </button>
                            </span>`;
                    },
                    orderable: false,
                    searchable: false
                },

            ]
        });
        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#refund_table').DataTable().ajax.url(DT_URL).draw();
            $('#refresh').hide();

        });
        $("#refundExport").click(function() {
            $("#refund_table_wrapper .buttons-excel ").click();
            return false;
        });
    </script>
@endsection
