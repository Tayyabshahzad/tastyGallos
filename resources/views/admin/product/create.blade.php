@extends('layouts.master')
@section('title', 'Product Create')
@section('page_head')

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
                        <span class="text-muted">Product Create</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data"   id="addProductFrom"   >
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Create Product</h3>
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
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Product Name *</label>
                                    <input type="text" required="" placeholder="Enter Name here" class="form-control"  name="name" value="{{ old('name') }}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Product Description</label>
                                    <textarea class="form-control" placeholder="Description" name="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Product Photos</label>
                                    <input type="file" class="form-control" name="photos[]" multiple  id="productPhoto">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label font-weight-bold">Sell on its own</label>
                                        <div class="col-9 col-form-label">
                                            <div class="radio-inline">
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="sell_on_its_own" value="yes" checked>
                                                    <span></span>Yes</label>
                                                <label class="radio radio-danger">
                                                    <input type="radio" name="sell_on_its_own" value="no">
                                                    <span></span>No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group" id="priceContainer">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="font-weight-bold">Price*</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control addRequired" name="price"  step="0.01"required >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="font-weight-bold"> Sale Price</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control addRequired" name="sale_price" step="0.01">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="font-weight-bold"> VAT*</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control addRequired"  readonly name="vat"  value="15" required     step="0.01" min="0" max="100" value="0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group" id="IDContainer">
                                    <label class="font-weight-bold">Select Categories * </label>
                                    <select class="form-control select2" id="categories" name="categories[]"
                                        multiple="multiple">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-5" id="modifierContainer">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Modifier Groups * </label>
                                        <select class="form-control select2" id="kt_select_modifiers" name="modifiers[]"
                                            multiple="multiple">
                                            @foreach ($modifiers as $modifier)
                                                <option value="{{ $modifier->id }}"> {{ $modifier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('admin.products') }}"
                                        class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                    <button type="submit" class="btn btn-danger font-weight-bold btn-square"
                                        id="addProduct"> Create Product
                                    </button>
                                </div>
                            </div>
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
        var avatar5 = new KTImageInput('kt_image_4');
        $('#categories').select2({
            placeholder: "Select  Category",
        });
        $('#kt_select_modifiers').select2({
            placeholder: "Select  Modifier",
        });
        // $('input:radio[name="sell_on_its_own"]').change(function() {
        //     if ($(this).val() == 'yes') {
        //         $('#IDContainer').css('display', 'block');
        //         $('#modifierContainer').css('display', 'block');
        //         $('#priceContainer').css('display', 'block');
        //         $('.addRequired').prop('required',true);

        //     } else {
        //         $('#IDContainer').css('display', 'none');
        //         $('#modifierContainer').css('display', 'none');
        //         $('#priceContainer').css('display', 'none');
        //         $('.addRequired').prop('required',false);
        //         $('.addRequired').val(0);
        //     }
        // });
    </script>

    <script>





        $("#addProductFrom").submit(function(e) {

            if (document.getElementById("productPhoto").files.length > 0) {

                const myFile = document.getElementById('productPhoto');
                if (myFile.files.length > 0) {
                for (const i = 0; i <= myFile.files.length - 1; i++) {
                    const fsize = myFile.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 2048) {
                        toastr.error("File size must be less then 2 Mb", "Error");
                        $('#productPhoto').addClass('border-danger');
                        event.preventDefault();
                    }else{
                        $("#addProduct").attr("disabled", true);
                    }
                }
            }



                // var fileUpload = document.getElementById("productPhoto");
                // var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                // if (size > 3000) {
                //     $('#photo').addClass('border-danger');
                //     toastr.error("File size must be less then 3 Mb", "Error");
                //     $("#addProduct").attr("disabled", false);
                //     event.preventDefault();

                // } else {
                //     $("#addProduct").attr("disabled", true);
                // }
            }
        });
    </script>
@endsection
