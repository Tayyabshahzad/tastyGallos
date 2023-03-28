@extends('layouts.master')
@section('title', 'Franchise Dashboard')
@section('content')
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
                                    <div class="pt-5 pb-5">

                                            <a href="{{ route('franchise.dashboard.realTime')}}"> Order Monitoring </a>

                                        {{-- <form action="{{ route('franchise.order.filter')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <label for=""> <b> Search by Color </b> </label> <br />
                                                <select class="form-control" name="color" style="width:300px"  required>
                                                    <option value="" selected disabled  >  Select Color </option>
                                                    <option value="red"> Red </option>
                                                    <option value="orange"> Orange </option>
                                                </select> <br>
                                                <button  class="btn btn-danger btn-square" type="submit"> Search </button>
                                             </form> --}}
                                    </div>
                                </div>

                                <div class="col-lg-4 text-right pt-8">
                                    <a href="{{ route('franchise.orders') }}" class="btn btn-danger btn-square"> All
                                        Orders </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" style="min-height:500px">

                                    <div class="col-lg-12">
                                        <div class="row">
                                            @foreach ($orders as $order)
                                                @php
                                                    $currentTime = \Carbon\Carbon::now()->format('d-m-Y h:i');
                                                    $red = \Carbon\Carbon::parse($order->danger)->format('d-m-Y h:i');
                                                    if ($currentTime > $red) {
                                                        $color = '#EE2D41';
                                                    } else {
                                                        $color = '#f4ad21';
                                                    }
                                                    // $yellow = \Carbon\Carbon::parse($order->created_at)->startOfDay()->addMinutes(30)->format('d-m-Y h:i');
                                                    // $orange = \Carbon\Carbon::parse($order->created_at)->startOfDay()->addMinutes(30)->format('d-m-Y h:i');
                                                @endphp
                                                <div class="form-group col-lg-4">
                                                    <div class="card card-custom orderDetail"
                                                        style="height: 200px;background-color:{{ $color }};color:#fff;cursor:pointer"
                                                        data-toggle="modal" data-target="#order_detail"
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
                                                                            <br>
                                                                            Color Change Time <br>
                                                                            @php
                                                                                $red = \Carbon\Carbon::parse($order->danger)->format('d-m-Y h:i A');
                                                                                echo $red;
                                                                            @endphp
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between flex-grow-1">
                                                                <div class="mr-2">
                                                                    <h3 class="font-weight-bolder">
                                                                        {{ ($order->order_products_count + $order->bogo_products_count +  $order->order_deal_product_count)  }} </h3>
                                                                    <div class="  font-size-lg mt-2">Items Order </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                </div>
                                            @endforeach

                                            {{-- <div class="form-group col-lg-4">
                                                    <div class="card card-custom "
                                                        style="height: 200px;background-color: #fd9e2a" data-toggle="modal"
                                                        data-target="#orderDetail">
                                                        <!--begin::Body-->
                                                        <div class="card-body d-flex flex-column">
                                                            <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                                                <div class="mr-2">
                                                                    <h3 class="font-weight-bolder">Order 2</h3>
                                                                    <div class="  font-size-lg mt-2">#1233 </div>
                                                                </div>
                                                                <div class="font-weight-boldest font-size-h1  ">
                                                                    <div class="mr-2">
                                                                        <h3 class="font-weight-bolder">Time </h3>
                                                                        <div class="  font-size-lg mt-2"> 00:30 </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                                                <div class="mr-2">
                                                                    <h3 class="font-weight-bolder">3 </h3>
                                                                    <div class="  font-size-lg mt-2">Items Order </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="card card-custom "
                                                        style="height: 200px;background-color: #f8f867" data-toggle="modal"
                                                        data-target="#orderDetailCOD">
                                                        <!--begin::Body-->
                                                        <div class="card-body d-flex flex-column">
                                                            <div  class="d-flex align-items-center justify-content-between flex-grow-1">
                                                                <div class="mr-2">
                                                                    <h3 class="font-weight-bolder">Order1 </h3>
                                                                    <div class="  font-size-lg mt-2">#1233 </div>
                                                                </div>
                                                                <div class="font-weight-boldest font-size-h1  ">
                                                                    <div class="mr-2">
                                                                        <h3 class="font-weight-bolder">Time </h3>
                                                                        <div class="  font-size-lg mt-2"> 00:30 </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between flex-grow-1">
                                                                <div class="mr-2">
                                                                    <h3 class="font-weight-bolder">3 </h3>
                                                                    <div class="  font-size-lg mt-2">Items Order </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('franchise.partials.reminderModal')
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

        $(document).ready(function() {
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
                    }else{
                        $('.changeStatusDropDown').show();
                        $('.refundButton').show();
                        $('.changeStatus').show();
                        $('.collectCashButton').show();
                        $('.cancelOrderButton').show();
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

        });
        @if (!$missingDetailsCounter > 0)
            $(window).on('load', function() {
                $('#reminder').modal('show');
            });
        @endif
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


        $('#order_status').on('change', function() {
                $('.changeStatus').prop("disabled", false);
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
                        location.reload();
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



@endsection
