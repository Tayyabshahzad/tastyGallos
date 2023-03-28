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
                        <span class="text-muted">Promotion Details</span>
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
                                <h3 class="card-label">  Promotion Details</h3>
                            </div>
                            <input type="hidden" name="status" value="inactive">
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <table class="table">
                                    <tr>
                                        <th colspan="2">
                                            <img src="{{ $promotion->getFirstMediaUrl('promotions', 'thumb') }}"
                                                 alt="" class="img-thumbnail mw-120 w-120px" >
                                        </th>
                                    </tr>
                                    <tr>
                                        <th> Status </th>
                                        <th>  {{ ucfirst($promotion->status) }} </th>
                                    </tr>
                                    <tr>
                                        <th> Type </th>
                                        <th>  {{ ucfirst($promotion->type) }}  </th>
                                    </tr>
                                    @if($promotion->type == 'discount')
                                    <tr>
                                        <th>  Discount Type </th>
                                        <th>   {{ ucfirst($promotion->discount_type) }}  </th>
                                    </tr>

                                    <tr>
                                        <th>  Discount on Products</th>
                                        <th>    @foreach($promotion->products as $product)
                                                    <button class="btn btn-outline-secondary btn-sm" type="button" disabled> {{ $product->name }} </button>
                                                @endforeach
                                         </th>
                                    </tr>

                                    <tr>
                                        <th>  Discount Amount </th>
                                        <th>  {{ ucfirst($promotion->amount) }} </th>
                                    </tr>
                                    @endif
                                    @if($promotion->type != 'discount')
                                    <tr>
                                        <th> Selected Product </th>
                                        <th> {{ $promotion->buyProduct->name }} </th>
                                    </tr>
                                    @endif
                                    @if($promotion->type != 'discount')
                                    <tr>
                                        <th> Free Product </th>
                                        <th>  {{ $promotion->getProduct->name }} </th>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th> Franchises </th>
                                        <th> @if($promotion->on_all_franchises == 1)
                                                For All Franchises
                                                @else
                                                     @foreach($promotion->franchises as $fracnhise)

                                                           <button class="btn btn-outline-secondary btn-sm" type="button" disabled>  {{ $fracnhise->name }}</button>
                                                     @endforeach

                                                @endif
                                         </th>
                                    </tr>
                                    <tr>
                                        <th> Duration  </th>
                                        <th>  {{ $promotion->start_date_time }}  &rArr;  {{ $promotion->end_date_time }} </th>
                                    </tr>
                                </table>
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('admin.promotions') }}"
                                        class="btn btn-warning font-weight-bold btn-square"> Back </a>

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

            } else {
                $("#product").show();
                $("#freeProduct").show();
                $("#discountBtnContainer").hide('slow');
                $("#freeProductContainer").show('slow');
                $("#multipleProductContainer").hide();
                $("#discountedProducts").hide();
                $("#discountedMultipleProducts").prop('required',false);
                $("#franchiseDropdown").show('slow');
                $("#allfranchises").show('slow');
                // $("#allFranchises").show('slow');
                // $("#discountContainer").hide('slow');
                // $("#discountAmountContainer").hide('slow');
            }


        });

        function showdiscount() {
            var val = $("input[type='radio']:checked").val();
            if (val == 'percentage') {
                $('#discountPercentageContainer').show('slow');
                $('#discountAmountContainer').hide();
            } else {
                $('#discountPercentageContainer').hide('slow');
                $('#discountAmountContainer').show();
            }

            if (val == 'amount') {
                $('#discountAmountContainer').show('slow');
                $('#discountPercentageContainer').hide();
            } else {

                $('#discountAmountContainer').hide('slow');
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
        });






    </script>



@endsection
