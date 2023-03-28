@extends('layouts.master')
@section('title', 'Promotion Create')
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
                        <a href="{{ route('admin.promotions') }}"> Promotion </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Update Create</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.promotions.update') }}" method="post" enctype="multipart/form-data"
                    id="updatePromotionForm">
                    @csrf
                    <input type="hidden" name="edit_id" value="{{ $promotion->id }}">
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Update Promotion</h3>
                            </div>
                            <input type="hidden" value="inactive" name="status">
                            <div class="card-toolbar">
                                <div class="card-toolbar">
                                    <span class="switch switch-danger switch-icon switch-sm">
                                        <span class="font-weight-bold">Status</span> <label class="ml-2">
                                            <input type="checkbox" value="active"
                                                @if ($promotion->status == 'active') checked="checked" @endif name="status">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Select Type *</label>
                                    <select class="form-control select2" id="promotionSelect" name="type">
                                        <option value="bogo" @if ($promotion->type == 'bogo') selected @endif> Bogo
                                        </option>
                                        <option value="discount" @if ($promotion->type == 'discount') selected @endif> Discount
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="row" id="bogoProducts">
                                        <div class="col-lg-6 mb-4" id="product">
                                            <label class="font-weight-bold"> Select Product *</label>
                                            <select class="form-control" name="buy_product_id">
                                                @foreach ($products as $selectProduct)
                                                    <option value="{{ $selectProduct->id }}"
                                                        @if ($promotion->buy_product_id == $selectProduct->id) selected @endif>
                                                        {{ $selectProduct->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 form-group" id="freeProduct">
                                            <label class="font-weight-bold">Select Free Product *</label>
                                            <select class="form-control" name="get_product_id">
                                                @foreach ($products as $freeProduct)
                                                    <option value="{{ $freeProduct->id }}"
                                                        @if ($promotion->get_product_id == $freeProduct->id) selected @endif>
                                                        {{ $freeProduct->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group" id="discountedProducts">
                                            <label class="font-weight-bold">Select Multiple Products</label>
                                            <select class="form-control select2" id="discountedMultipleProducts"
                                                name="products_on_discount[]" multiple>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        @if (in_array($product->id, $discountedProducts)) selected="selected" @endif>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 col-form-label pt-3" id="discountBtnContainer">
                                            <label class="font-weight-bold"> Discount Type </label>
                                            <div class="radio-inline">
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="discountType" value="percentage"
                                                        @if ($promotion->discount_type == 'percentage') checked @endif
                                                        onclick="showdiscount()">
                                                    <span></span> Discount % </label>
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="discountType" value="amount"
                                                        @if ($promotion->discount_type == 'amount') checked @endif
                                                        onclick="showdiscount()">
                                                    <span></span> Discount Amount</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group" id="discountPercentageContainer">
                                            <label class="font-weight-bold">Discount %</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="@if ($promotion->discount_type == 'percentage') {{ $promotion->amount }} @endif"
                                                    name="percentage">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group" id="discountAmountContainer">
                                            <label class="font-weight-bold">Discount Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                                <input type="text" class="form-control" name="amount"
                                                    value="@if ($promotion->discount_type == 'amount') {{ $promotion->amount }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group" id="franchiseDropdown">
                                    <label class="font-weight-bold">Select Franchise *</label>
                                    <select class="form-control select2" id="franchise_select" name="franchises[]"
                                        multiple="multiple">
                                        @foreach ($franchises as $franchise)
                                            <option value=" {{ $franchise->id }} "
                                                @if (in_array($franchise->id, $assignFranchises)) selected="selected" @endif>
                                                {{ $franchise->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group" id="allfranchises">
                                    <div class="form-group row">
                                        <div class="col-6 col-form-label pt-3">
                                            <label class="font-weight-bold"> All Franchises*</label>
                                            <div class="checkbox-list">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="on_all_franchises" value="1" id="CheckAllFranchises"
                                                        @if ($promotion->on_all_franchises == 1) checked @endif>
                                                    <span></span> All Franchises</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="font-weight-bold">Set Start Duration: *</label>
                                    <input type="date" class="form-control" name="start_date_time"
                                        value="{{ $promotion->start_date_time }}">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="font-weight-bold">Set End Duration: *</label>
                                    <input type="date" class="form-control" name="end_date_time"
                                        value="{{ $promotion->end_date_time }}">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="font-weight-bold">Promotion Photo: *</label> <br>
                                    <div class="image-input image-input-outline mt-2" id="kt_banner">
                                        <div class="image-input-wrapper"
                                            @if ($promotion->getFirstMediaUrl('promotions', 'thumb') != '') @php $path = $promotion->getFirstMediaUrl('promotions', 'thumb') @endphp
                                            @else @php $path = 'https://wtwp.com/wp-content/uploads/2015/06/placeholder-image.png' @endphp @endif
                                            style="background-image:url({{ $path }}); width:
                                            250px; height: 167px; max-width: 100%;">
                                        </div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Upload Banner">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" accept=".png, .jpg, .jpeg" name="promotion_photo"
                                                id="promotion_banner">
                                            <input type="hidden" name="profile_avatar_remove" value="0">
                                        </label>
                                        <span
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="cancel" data-toggle="tooltip" title=""
                                            data-original-title="Remove Banner">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <button  data-id="{{ $promotion->id }}"
                                        @if($promotion->isCanceled == 0)  data-value="inactive"   @else   data-value="active"   @endif
                                        type="button"  class="btn btn-info font-weight-bold btn-square cancelPromotion">
                                        @if($promotion->isCanceled == 1)
                                            Promotion Inactive
                                        @elseif($promotion->isCanceled == 0)
                                            Promotion activated
                                        @endif
                                    </button>
                                    <button type="submit" class="btn btn-warning font-weight-bold btn-square"
                                        id="updatePromotion"> Update
                                        Promotion </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    @if ($errors->any())

        @foreach ($errors->all() as $error)
            @php
                $myError = ucwords($error);
            @endphp
            <script>
                toastr.error('{{ $myError }}', "Error");
            </script>
        @endforeach
    @endif
    <script>
        $("#updatePromotionForm").submit(function(e) {
            $("#updatePromotion").attr("disabled", true);
        });


        $('#promotionSelect').select2({
            placeholder: "Select a Type",
        });

        $('#product_Select').select2({
            placeholder: "Select a Product",
        });

        $('#free_product_Select').select2({
            placeholder: "Select Free Product",
        });
        $('#franchise_select').select2({
            placeholder: "Select a Franchise",
        });

        var avatar5 = new KTImageInput('promotionImage');

        $('#discountedMultipleProducts').select2({
            placeholder: "Select a Product",
        });
        $("#discountBtnContainer").hide();
        $("#discountPercentageContainer").hide();
        $("#discountAmountContainer").hide();
        $('#discountedProducts').hide();
        $("#promotionSelect").on('change', function() {

            if ($(this).val() == 'discount') {
                $("#discountBtnContainer").show();
                $("#product").hide();
                $("#freeProduct").hide();
                $("#discountedProducts").show();
                $("#singleProduct").hide();
                // $("#allFranchises").hide('slow');
            } else if($(this).val() == 'bogo'){
                $("#bogoProducts").show();
                $("#discountBtnContainer").hide();
                $("#freeProductContainer").show();
                $("#multipleProductContainer").hide();
                $("#discountedProducts").hide();
                $("#franchiseDropdown").show();
                $("#allfranchises").show();
                $("#product").show();
                $("#freeProduct").show();
                $("#discountBtnContainer").hide();
                $("#discountPercentageContainer").hide();
                $("#discountAmountContainer").hide('slow');

                // $("#allFranchises").show('slow');
                // $("#discountContainer").hide('slow');
                // $("#discountAmountContainer").hide('slow');
            }
        });

        function showdiscount() {
            var val = $("input[type='radio']:checked").val();
            if (val == 'percentage') {
                $('#discountPercentageContainer').show();
                $('#discountAmountContainer').hide();
            } else {
                $('#discountPercentageContainer').hide();
                $('#discountAmountContainer').show();
            }

            if (val == 'amount') {
                $('#discountAmountContainer').show();
                $('#discountPercentageContainer').hide();
            } else {

                $('#discountAmountContainer').hide();
                $('#discountPercentageContainer').show();

            }
        }
        @if ($promotion->type == 'discount')
            $("#bogoProducts").hide();
            $("#discountedProducts").show();
            $("#discountBtnContainer").show();
        @endif

        @if ($promotion->discount_type == 'percentage')
            $('#discountPercentageContainer').show();
        @elseif($promotion->discount_type == 'amount')
            $('#discountAmountContainer').show();
        @endif
        var avatar5 = new KTImageInput('kt_banner');
        $("#updatePromotionForm").submit(function(e) {
            var fileUpload = document.getElementById("promotion_banner");
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            if (size > 5000) {
                $('#kt_banner').addClass('border-danger');
                toastr.error("File size must be less then 5 Mb", "Error");
                $("#updatePromotion").attr("disabled", false);
                event.preventDefault();
            } else {
                $("#updatePromotion").attr("disabled", true);
            }

            if($('#franchise_select').val() == '' && $('#CheckAllFranchises').is(':not(:checked)')){
                 toastr.error("Please select franchise");
                 $('.checkbox').addClass('border-danger');
                 $("#addPromotion").attr("disabled", false);
                 event.preventDefault();
            }


        });



        $(".cancelPromotion").click(function(e) {
            var id = $(this).data('id');
            var value = $(this).data('value');
            var url = '{{ route('admin.promotions.cancel') }}';
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    id: id,
                    value:value,
                },
                success: function(response) {
                    if(response.success == true){
                        toastr.success(response.message, "success");
                        location.reload();
                     }else{
                        toastr.error(response.message, "error");
                     }

                },

            });
        });
    </script>


@endsection
