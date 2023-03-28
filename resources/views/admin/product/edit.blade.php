@extends('layouts.master')
@section('title', 'Product Edit')

@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .dispalyNone {
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
                        <a href="{{ route('admin.products') }}"> Product </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Product Edit</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.products.update') }}" method="post" enctype="multipart/form-data"
                    id="UpdateProductFrom">
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Edit Product</h3>
                            </div>

                            <div class="card-toolbar">
                                <input type="hidden" name="status" value="inactive">
                                <span class="switch switch-danger switch-icon switch-sm">
                                    <span class="font-weight-bold">Status</span> <label class="ml-2">
                                        <input type="checkbox" value="active"
                                            @if ($product->status == 'active') checked="checked" @endif name="status">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="card-body" id="ImagesContainer">

                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row mb-3" >
                                @foreach ($photos as $photo)
                                    <div class="col-md-2 col-xxl-2 col-lg-2  ">
                                        <div class="card  ">
                                            <div class="card-body p-0">
                                                <div class="overlay">
                                                    {{ $photo->url }}
                                                    <div class="overlay-wrapper rounded bg-light text-center"
                                                    style="height:100px;padding:10px;background-image: url({{ $photo->getUrl() }});background-size: contain;background-repeat:no-repeat;background-position: center center;
                                                }">

                                                    </div>
                                                    <div class="overlay-layer">
                                                        <button  type="button" class="btn font-weight-bolder btn-sm btn-danger deletePhoto"
                                                        data-id="{{ $photo->id }}" data-product="{{ $product->id }}">
                                                            <i class="flaticon2-cross"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">

                                <div class="col-lg-12 form-group mt-2">
                                    <label class="font-weight-bold">Product Photo<span
                                            class="text-danger"></span></label>
                                    <input type="file" class="form-control" name="photos[]" multiple id="productphoto">
                                </div>


                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Product Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" required="" placeholder="Enter Name here" class="form-control"
                                        name="name" value="{{ $product->name }}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Product Description</label>
                                    <textarea class="form-control" placeholder="Description" name="description">{{ $product->description }}</textarea>
                                </div>


                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label font-weight-bold">Sell on its own</label>
                                        <div class="col-9 col-form-label">
                                            <div class="radio-inline">
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="sell_on_its_own"
                                                        @if ($product->sell_on_its_own == 'yes') checked="checked" @endif
                                                        value="yes">
                                                    <span></span>Yes</label>
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="sell_on_its_own"
                                                        @if ($product->sell_on_its_own == 'no') checked="checked" @endif
                                                        value="no">
                                                    <span></span>No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 form-group " id="priceContainer">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="font-weight-bold"> Normal Price<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">

                                                <input type="number" class="form-control addRequired" name="price"  step="0.01" required
                                                    value="{{ $product->price }}">

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="font-weight-bold"> Sale Price</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control addRequired"  step="0.01" name="sale_price" value="{{ $product->sale_price }}">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="font-weight-bold"> VAT*</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control addRequired" name="vat"  readonly step="0.01" required
                                                    value="{{ $product->vat }}" min="0" max="100">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-lg-12 form-group " id="IDContainer">
                                    <label class="font-weight-bold">Select Categories * </label>
                                    <select class="form-control select2" id="categories" name="categories[]"
                                        multiple="multiple">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (in_array($category->id, $assign_categories)) selected="selected" @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group  " id="modifierContainer">
                                    <label class="font-weight-bold"> Modifier Groups * </label>
                                    <select class="form-control select2" id="kt_select_modifiers" name="modifiers[]"
                                        multiple="multiple">
                                        @foreach ($modifiers as $modifier)
                                            <option value="{{ $modifier->id }}"  @if (in_array($modifier->id, $assign_modifiers)) selected="selected" @endif>
                                                {{ $modifier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 form-group  " id="modifierContainer">
                                    <label class="font-weight-bold"> Extras </label>
                                    <select class="form-control select2" id="kt_select_extras" name="extras[]"
                                        multiple="multiple">
                                        @foreach ($extras as $extra)
                                            <option value="{{ $extra->id }}"  @if (in_array($extra->id, $assign_extras)) selected="selected" @endif>>
                                                {{ $extra->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('admin.products') }}"
                                        class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                    <button type="submit" class="btn btn-danger font-weight-bold btn-square"
                                        id="updateProduct"> Update Product
                                    </button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('page_js')


    <script>
        var avatar5 = new KTImageInput('kt_image_4');

        $('#categories').select2({
            placeholder: "Select a Category",
        });
        $('#kt_select_modifiers').select2({
            placeholder: "Select  Modifier",
        });
        $('#kt_select_extras').select2({
            placeholder: "Select  Extras",
        });
    </script>

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
        // @if ($product->sell_on_its_own == 'no')
        //     $('#IDContainer').css('display', 'none');
        //     $('#modifierContainer').css('display', 'none');
        //     $('#priceContainer').css('display','none');
        // @endif
        // $('input:radio[name="sell_on_its_own"]').change(function() {
        //     if ($(this).val() == 'yes') {
        //         $('#IDContainer').css('display', 'block');
        //         $('#modifierContainer').css('display', 'block');
        //         $('#priceContainer').css('display', 'block');
        //         $('.addRequired').prop('required', true);
        //     } else {
        //         $('#IDContainer').css('display', 'none');
        //         $('#modifierContainer').css('display', 'none');
        //         $('#priceContainer').css('display', 'none');
        //         $('.addRequired').prop('required', false);

        //     }
        // });
    </script>

    <script>
        $('#kt_dropzone_2').dropzone({
            url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
        $("#UpdateProductFrom").submit(function(e) {
                const myFile = document.getElementById('productphoto');
                if (myFile.files.length > 0) {
                    for (const i = 0; i <= myFile.files.length - 1; i++) {
                        const fsize = myFile.files.item(i).size;
                        const file = Math.round((fsize / 1024));
                        // The size of the file.
                        if (file >= 2048) {
                            toastr.error("File size must be less then 2 Mb", "Error");
                            event.preventDefault();
                        }else{
                            $("#updateProduct").attr("disabled", true);
                        }
                    }
                }
            // var fileUpload = document.getElementById("productphoto");
            // var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            // if (size  3000) {
            //     $('#photo').addClass('border-danger');
            //     toastr.error("File size must be less then 3 Mb", "Error");
            //     $("#updateProduct").attr("disabled", false);
            //     event.preventDefault();
            // } else {
            //     $("#updateProduct").attr("disabled", true);
            // }


        });
        $(".deletePhoto").click(function(e) {
            var id = $(this).data('id');
            var product = $(this).data('product');
            var url = '{{ route('admin.products.photo.delete') }}';
            $.ajax({
                url: url,
                data: {
                    id: id,
                    product:product,
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
