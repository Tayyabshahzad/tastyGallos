@extends('layouts.master')
@section('title', 'Deal Create')
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
                        <a href="{{ route('admin.deals.index') }}"> Deals </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Deal Create</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.deals.store') }}" method="post" enctype="multipart/form-data"
                    id="addProductFrom">
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Create Deal</h3>
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


                                <div class="col-lg-12 form-group" id="">
                                    <label class="font-weight-bold">Select Categories * </label>
                                    <select class="form-control" id="categories" name="categories[]" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Title *</label>
                                    <input type="text" required="" placeholder="Enter Title here" class="form-control"
                                        name="title" value="{{ old('title') }}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold"> Description</label>
                                    <textarea class="form-control" placeholder="Description" name="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Deal Photos</label>
                                    <input type="file" class="form-control" name="photos[]" multiple id="dealPhoto">
                                </div>

                                <div class="col-lg-12 form-group" id="priceContainer">
                                    <label class="font-weight-bold">Price*</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control addRequired" name="price"
                                            step="0.01"required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ZAR</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 form-group" >
                                    <label class="font-weight-bold">Franchise*</label>
                                    <select class="form-control" id="kt_select2_3" name="franchises[]" required multiple>
                                        @foreach ($franchises as $franchise)
                                            <option value="{{ $franchise->id }}"> {{ $franchise->name }} </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-lg-12 form-group" id="IDContainer">
                                    <label class="font-weight-bold">Select Products * </label>
                                    <select class="form-control  prductChange" id="products" name="" required>
                                        <option value="" selected disabled>  Select Product </option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row" id="newRowContainer" style="padding-left:15px;">
                                </div>

                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('admin.deals.index') }}"
                                        class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                    <button type="submit" class="btn btn-danger font-weight-bold btn-square"
                                        id="addDeal"> Create Deal </button>
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
        $('#products').select2({
            placeholder: "Select Product",
        });
        $('#categories').select2({
            placeholder: "Select Categories",
        });

    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#addDeal").submit(function(e) {
            if (document.getElementById("dealPhoto").files.length > 0) {
                const myFile = document.getElementById('dealPhoto');
                if (myFile.files.length > 0) {
                    for (const i = 0; i <= myFile.files.length - 1; i++) {
                        const fsize = myFile.files.item(i).size;
                        const file = Math.round((fsize / 1024));
                        // The size of the file.
                        if (file >= 2048) {
                            toastr.error("File size must be less then 2 Mb", "Error");
                            $('#dealPhoto').addClass('border-danger');
                            event.preventDefault();
                        } else {
                            $("#addDeal").attr("disabled", true);
                        }
                    }
                }
            }
        });



        $(".prductChange").change(function() {
            // var arrList =
            var product_id = $(this).val();
            dealProductPrice = "{{ route('admin.deals.get.product.price') }}";
            var array_list = [];
            $.ajax({
                url: dealProductPrice,
                method: 'POST',
                data: {
                    id: product_id,
                },
                success: function(response) {

                    if (response.success == true) {

                        array_list.push(response.product.id);
                        $('#newRowContainer').append(`
                            <div class="col-lg-6" style="margin-bottom:1em">
                                <input type="text" class="form-control" name="product_name[]" id="" value="${response.product.name}">
                                <input type="hidden" class="form-control" name="product_id[]" id="" value="${response.product.id}">
                            </div>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name="product_quantity[]" id="" value="1">
                            </div>
                            <div class="col-lg-2">
                                -
                            </div>
                        `);

                    }

                    console.log(array_list);
                },
            });


            // alert($(this).val());
        });

            $('#kt_select2_3').select2({
                placeholder: "Select Franchise",
             });
    </script>
@endsection
