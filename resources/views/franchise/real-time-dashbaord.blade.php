@extends('layouts.master')
@section('title', 'Franchise Dashboard')
@section('page_head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .my-element {
            display: inline-block;
            margin: 0 0.5rem;
            animation: pulse;
            /* referring directly to the animation's @keyframe declaration */
            animation-duration: 2s;
            /* don't forget to set a duration! */
            animation-iteration-count: 3000000;
        }
    </style>
@endsection
@section('content')
    <div id="app"></div>
    <div class="container">
        <div class="row">




            <div class="col-lg-12">
                <div class="row mb-6">
                    <div class="col-lg-12">
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                Dashboard
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header row">


                                <div class="col-lg-4">

                                </div>
                                <div class="col-lg-4 text-right pt-8">
                                    <a href="{{ route('franchise.orders') }}" class="btn btn-danger btn-square"> All
                                        Orders </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <h4>
                                        Franchise open for orders
                                    </h4>
                                </div>
                                <div class="row temperoryOrders" style="min-height:500px">

                                    @foreach ($orders as $order)
                                        <div class="col-lg-4 mt-5 mb-5">
                                            <div class="form-group col-lg-12 my-element ">
                                                <div class="card card-custom orderDetail"
                                                    style="height: 200px;background-color:#EE2D41;color:#fff;cursor:pointer"
                                                    data-toggle="modal" data-target="#order_detail_real_time"
                                                    data-id='{{ $order->id }}'>
                                                    <!--begin::Body-->
                                                    <div class="card-body d-flex flex-column">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between flex-grow-1">
                                                            <div class="mr-2">
                                                                <h3 class="font-weight-bolder">Type:
                                                                    {{ ucfirst($order->type) }}</h3> <br>
                                                                <h3 class="font-weight-bolder">Order
                                                                    {{ $loop->iteration }}</h3>
                                                                <div class="  font-size-lg mt-2">
                                                                    #{{ $order->order_number }} </div>
                                                            </div>
                                                            <div class="font-weight-boldest font-size-h1  ">
                                                                <div class="mr-2">
                                                                    <h3 class="font-weight-bolder">Time </h3>
                                                                    <div class="  font-size-lg mt-2">
                                                                        @php
                                                                            $creatdAt = \Carbon\Carbon::parse($order->created_at)->format('d-m-Y h:i A');
                                                                            echo $creatdAt;
                                                                        @endphp

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between flex-grow-1">
                                                            <div class="mr-2">
                                                                <h3 class="font-weight-bolder">
                                                                    {{ $order->order_products_count + $order->bogo_products_count + $order->order_deal_product_count }}
                                                                    <div class="  font-size-lg mt-2">Items Order </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach



                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @include('franchise.partials.orderDetail')


@endsection
@section('page_js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#ordeNumbers').select2({
            placeholder: "Search By Order Number"
        });
        $('#colors').select2({
            placeholder: "Search By Color"
        });

        $(document).on("click", ".orderDetail", function() {
            var changeStatus = $('.changeStatus').prop('disabled', false);
            $('#realTime_order_number').html('');
            $('#realTime_order_Status').html('');
            $('#realTime_order_type').html('');
            $('#realTime_order_address').html('');
            $('#realTime_order_user').html('');
            $('#realTime_order_phonenumber').html('');
            $('#realTime_order_orderaddress').html('');
            $('#realTime_realTime_orderDetailTable').append('');
            $('#realTime_realTime_orderDetailTable').html('');
            $('#realTime_subTotal').html('');
            $('#realTime_extrasTotal').html('');
            $('#realTime_order_note').html('');
            $('#realTime_promotion_ul').html('');
            $('#realTime_paymentMethod').html('');
            var order_id = $(this).data('id');
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

                    $('#realTime_order_id').val(data.order.id);
                    $('#realTime_dealList').html(dealList);
                    $('#realTime_bogoProduct').html(mybogoProduct);
                    $('#realTime_extraList').html(extraList);
                    $('#realTime_modifierList').html(modifierList);
                    $('#realTime_order_number').html(data.order.order_number);
                    $('#realTime_order_Status').html(data.order.status);
                    $('#realTime_order_type').html(data.order.type);
                    $('#realTime_order_user').html(data.order.user.name);
                    $('#realTime_order_phonenumber').html(data.order.user.phone);
                    $('#realTime_order_orderaddress').html(data.order.user.address);
                    $('#realTime_orderDetailTable').append(orderProducts);
                    $('#realTime_orderDetailTable').html(orderProducts);
                    $('#realTime_subTotal').html(data.order.sub_total);
                    $('#realTime_extrasTotal').html(data.order.items_extra);
                    $('#realTime_extras').html(data.order.extras);
                    var ordertax = parseInt(data.order.tax);
                    $('#realTime_tax').html(ordertax);
                    $('#realTime_order_note').html(data.order.note);
                    $('#realTime_paymentMethod').html(data.order.payment_method);
                    $('#realTime_promotion_ul').html(promotion_ul);
                    $('#realTime_discount').html(data.order.discount);
                    $('#realTime_totalAfterDiscount').html(data.order.sub_total - data.order.discount);
                    $('#realTime_delivery_charges').html(data.order.delivery_charges);
                    $('#realTime_grandTotal').html(data.order.grandTotal);
                    var franchiseTax = parseInt(data.order.franchise_tax);

                    $('#realTime_franchise_tax').html(franchiseTax);
                    if (data.order.address != null) {
                        const orderAddress = JSON.parse(data.order.address);
                        $('#realTime_order_address').html(orderAddress.address);
                        $('#realTime_building').html(orderAddress.building_name);
                        $('#realTime_appartment').html(orderAddress.appartment_floor_number);
                    } else {
                        $('#realTime_order_address').html('');
                        $('#realTime_building').html('');
                        $('#realTime_appartment').html('');
                    }
                    if (data.order.status == 'refunded') {
                        $('.changeStatusDropDown').hide();
                        $('.refundButton').hide();
                        $('.changeStatus').hide();
                        $('.collectCashButton').hide();
                        $('.cancelOrderButton').hide();
                        return false;
                    }
                    if (data.order.status == 'pickup' || data.order.status == 'delivery') {
                        $('#realTime_order_status').val('dp');
                    } else if (data.order.status == 'delivered' || data.order.status ==
                        'collected') {
                        $('#realTime_order_status').val('dc');
                    } else {
                        $('#realTime_order_status').val(data.order.status);
                    }
                    if (data.order.status == 'cancelled') {
                        $('.changeStatusDropDown').hide();
                        $('.refundButton').hide();
                        $('.changeStatus').hide();
                        $('.collectCashButton').hide();
                        $('.cancelOrderButton').hide();
                        return false;
                    }
                },
            });
        });
    </script>

    <script>
        $('.q_orderNumber').on('change', function() {
            var DT_URL = '{{ route('franchise.dashboard') }}';
            var orderNumber = this.value;
            $.ajax({
                url: DT_URL,
                data: {
                    orderNumber: orderNumber,
                },
                success: function(response) {
                    if (response.success == true) {

                    }
                },

            });
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
                            } else {
                                toastr.error('Error', "error");
                            }
                        }
                    });
                }
            });
        }
    </script>



    <script src="{{ asset('js/app.js') }}"></script>
    @php
    $userID = Auth::user()->id;
    @endphp

    <script>
        $('#order_detail_real_time').on('click', '.changeOrderState', function(e) {
            var realTime_order_id = $('#realTime_order_id').val();
            var value = $(this).data('value');
            var changeStateUrl = '{{ route('franchise.order.change.state') }}';
            if (value == 'reject') {
                confirmReject(realTime_order_id);
                //  preventDefault(e);
                return false;
            }
            $.ajax({
                url: changeStateUrl,
                method: 'get',
                data: {
                    realTime_order_id: realTime_order_id,
                    value: value,
                },
                success: function(response) {
                    if (response.success == true) {
                        $("#order_detail_real_time").modal('hide');
                        toastr.success(response.message, "Success");
                        location.reload();
                    } else {
                        toastr.error(response.message, "Error");
                    }

                },
            });
        });

        function confirmReject(realTime_order_id) {
            $('#reason_error_message').css('display', 'none');
            $('#reject_order_reason').removeClass('border-danger');
            $('#reject_order_reason').val('');
            Swal.fire({
                title: "Are you sure to reject this order ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, reject it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    $('#order_detail_real_time').modal('hide');
                    $('#order_reject_reason_modal').modal('show');
                    $('#reject_order_id').val(realTime_order_id);
                    return false;
                }
            });
        }

        $('.rejectOrderWithReason').on('click', function(e) {

            var order_id = $('#reject_order_id').val();
            var reason = $('#reject_order_reason').val();
            if (order_id.length === 0) {
                e.preventDefault();
            }
            if (reason.length === 0) {
                $('#reason_error_message').show();
                $('#reject_order_reason').addClass('border-danger');
                e.preventDefault();
            }
            var url = '{{ route('franchise.order.change.state') }}';
            $.ajax({
                url: url,
                method: 'get',
                data: {
                    order_id: order_id,
                    reason: reason,
                    value: 'reject',
                },
                success: function(response) {
                    if (response.success == true) {
                        $("#order_detail_real_time").modal('hide');
                        toastr.success(response.message, "Success");
                        $(".temperoryOrders").load(" .temperoryOrders");
                        location.reload();
                    } else {
                        toastr.error(response.message, "Error");
                    }
                }
            });
        });
    </script>

    <script>
        console.log({{ Auth::user()->id }})
        Echo.private(`order_notification.{{ Auth::user()->id }}`)
            .listen('OrderNotificationEvent', (e) => {
                console.log('notification');
                var audio = new Audio('https://mp3-ringtone.com/uploads/files/aurora.mp3');
                audio.play();
                audio.loop = true;
                $('.temperoryOrders').append(`
    <div class="col-lg-4 mt-5 mb-5">
    <div class="form-group col-lg-12 my-element">
    <div class="card card-custom orderDetail"
        style="height: 200px;background-color:#EE2D41;color:#fff;cursor:pointer"
        data-toggle="modal" data-target="#order_detail_real_time"   data-id='${e.order_details.order_id}'>
        <!--begin::Body-->
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center justify-content-between flex-grow-1">
                <div class="mr-2">
                    <h3 class="font-weight-bolder">Type: ${e.order_details.type} </h3> <br>
                    <h3 class="font-weight-bolder">Order #  -  </h3>
                    <div class="font-size-lg mt-2">  # ${e.order_details.order_number} </div>
                </div>
                <div class="font-weight-boldest font-size-h1  ">
                    <div class="mr-2">
                        <h3 class="font-weight-bolder">Time </h3>
                        <div class="  font-size-lg mt-2">
                            ${e.orderTime}
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="d-flex align-items-center justify-content-between flex-grow-1">
                <div class="mr-2">
                    <h3 class="font-weight-bolder">  ${e.totalProductInOrder} </h3>
                    <div class="font-size-lg mt-2">Items Order </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
</div>
</div>

`);
            });
    </script>
@endsection
