@extends('layouts.master')
@section('title', 'Promotion Create')
@section('page_head')
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
        <style>
            .border-danger{
                border:1px solid rgb(240, 104, 104);

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
                        <a href="{{ route('admin.promotions') }}"> Promotion </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Promotion Create</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.promotions.store') }}" method="post" enctype="multipart/form-data" id="addPromotionForm">@csrf
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Create Promotion</h3>
                            </div>
                            <input type="hidden" name="status" value="inactive">
                            <div class="card-toolbar">
                                <div class="card-toolbar">
                                    <span class="switch switch-danger switch-icon switch-sm">
                                        <span class="font-weight-bold">Status</span> <label class="ml-2">
                                            <input type="checkbox" value="active" checked="checked" name="status">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Select Type <span class="text-danger">*</span> </label>
                                    <select class="form-control select2" id="promotionSelect" name="type" required>
                                        <option value="bogo" selected> Bogo </option>
                                        <option value="discount"> Discount </option>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="row">
                                        <div class="col-lg-6 mb-4" id="product">
                                            <label class="font-weight-bold"> Select Product  </label>
                                            <select class="form-control" name="buy_product_id" required>
                                                @foreach($products as $selectProduct)
                                                    <option value="{{ $selectProduct->id }}"> {{ $selectProduct->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 form-group" id="freeProduct">
                                            <label class="font-weight-bold">Select Free Product  </label>
                                            <select class="form-control" name="get_product_id" required>
                                                @foreach($products as $freeProduct)
                                                    <option value="{{ $freeProduct->id }}"> {{ $freeProduct->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12 form-group" id="discountedProducts">
                                            <label class="font-weight-bold">Select Multiple Products <span class="text-danger"> * </span>  </label>
                                            <select class="form-control select2" id="discountedMultipleProducts"  name="products_on_discount[]" multiple>
                                                @foreach($products as $discountedProduct)
                                                    <option value="{{ $discountedProduct->id }}"> {{ $discountedProduct->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 col-form-label pt-3" id="discountBtnContainer">
                                            <label class="font-weight-bold"> Discount Type  </label>
                                            <div class="radio-inline">
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="discountType" value="percentage"
                                                        onclick="showdiscount()">
                                                    <span></span> Discount % </label>
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="discountType" value="amount"
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
                                                <input type="number" class="form-control" name="percentage"  placeholder="Enter discount percentage">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group" id="discountAmountContainer">
                                            <label class="font-weight-bold">Discount Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                                <input type="number" class="form-control" name="amount" placeholder="Enter discount amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group" id="franchiseDropdown">
                                    <label class="font-weight-bold">Select Franchise  <span class="text-danger">*</span> </label>
                                    <select class="form-control select2" id="franchise_select" name="franchises[]"  multiple="multiple" style="border:1px solid red" >
                                         @foreach($franchises as $franchise)
                                            <option value=" {{ $franchise->id }} "> {{ $franchise->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group" id="allfranchises">
                                    <div class="form-group row">
                                        <div class="col-6 col-form-label pt-3">
                                            <label class="font-weight-bold"> All Franchises <span class="text-danger">*</span> </label>
                                            <div class="checkbox-list">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="franchiseBtn" value="1" id="CheckAllFranchises">
                                                    <span></span> All Franchises</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="font-weight-bold">Set Start Duration:  <span class="text-danger">*</span> </label>
                                    <input type="date" class="form-control" name="start_date_time" required value="{{ old('start_date_time')}}">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="font-weight-bold">Set End Duration:  <span class="text-danger">*</span> </label>
                                    <input type="date" class="form-control" name="end_date_time" required value="{{ old('end_date_time')}}">
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label class="font-weight-bold">Promotion Photo:  <span class="text-danger">*</span> </label> <br>
                                    <div class="image-input image-input-outline mt-2" id="kt_banner" >
                                        <div class="image-input-wrapper"  style="background-image:url({{ asset('design/assets/media/placeholder.png') }}); width:
                                        250px; height: 167px; max-width: 100%;">
                                    </div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Upload Banner">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" accept=".png, .jpg, .jpeg" name="promotion_photo" id="promotion_banner"  >
                                            <input type="hidden" name="profile_avatar_remove" value="0">
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Remove Banner">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('admin.promotions') }}"
                                        class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                    <button type="submit" class="btn btn-danger font-weight-bold btn-square" id="addPromotion"> Create
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

    <script>



        var table = $('#kt_datatable').DataTable();
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
    </script>

    <script>
        $("#discountBtnContainer").hide();
        $("#discountPercentageContainer").hide();
        $("#discountAmountContainer").hide();
        $('#discountedProducts').hide();
        $("#promotionSelect").on('change', function() {

            if ($(this).val() == 'discount') {
                $("#discountBtnContainer").show('slow');
                $("#product").hide();
                $("#freeProduct").hide();
                $("#discountedProducts").show();
                $("#discountedMultipleProducts").prop('required',true);
                $("#singleProduct").hide();

                // $("#allFranchises").hide('slow');

            } else if($(this).val() == 'bogo') {
                $("#product").show();
                $("#freeProduct").show();
                $("#discountBtnContainer").hide('slow');
                $("#freeProductContainer").show('slow');
                $("#multipleProductContainer").hide();
                $("#discountedProducts").hide();
                $("#discountedMultipleProducts").prop('required',false);
                $("#franchiseDropdown").show('slow');
                $("#allfranchises").show('slow');
                $("#discountPercentageContainer").hide();
                $("#discountAmountContainer").hide('slow');
                // $("#allFranchises").show('slow');
                // $("#discountContainer").hide('slow');

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

        var avatar5 = new KTImageInput('kt_banner');

        $("#addPromotionForm").submit(function (e) {



            if( document.getElementById("promotion_banner").files.length == 0 ){
                event.preventDefault();
                $('#kt_banner').addClass('border-danger');
                toastr.error("Please upload promotion banner", "Error");
                console.log("no files selected");

            }else{
                var fileUpload = document.getElementById("promotion_banner");
                var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                if(size>5000){
                    $('#kt_banner').addClass('border-danger');
                    toastr.error("File size must be less then 5 Mb", "Error");
                    $("#addPromotion").attr("disabled", false);
                    event.preventDefault();
                }else{
                    $("#addPromotion").attr("disabled", true);
                }
            }

            if($('#franchise_select').val() == '' && $('#CheckAllFranchises').is(':not(:checked)')){
                 toastr.error("Please select franchise");
                 $('.checkbox').addClass('border-danger');
                 $("#addPromotion").attr("disabled", false);
                 event.preventDefault();
            }
        });






    </script>


{{-- <script>
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#franchise_select').prop('disabled',true);
            }
            else if($(this).prop("checked") == false){
                $('#franchise_select').prop('disabled',false);
            }
        });
    });
</script> --}}



    @if($errors->any())
        @foreach ($errors->all() as $error)
        @php
                $myError = ucwords($error);
        @endphp
        <script>
            toastr.error('{{$myError}}', "Error");
        </script>
        @endforeach
    @endif


@endsection
