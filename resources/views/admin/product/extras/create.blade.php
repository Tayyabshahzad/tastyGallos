@extends('layouts.master')
@section('title', 'Extras Create')
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
                        <a href="{{ route('admin.extras') }}"> Extras </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Extras Create</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.extras.store') }}" method="post" enctype="multipart/form-data"   id="addProductFrom">
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Create Extras</h3>
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
                                    <label class="font-weight-bold">Name *</label>
                                    <input type="text" required="" placeholder="Enter extras name" class="form-control"   name="name" value="{{ old('name') }}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Price *</label>
                                    <input type="number"  min="0" max="2000" step="0.01" required="" placeholder="Enter extras price" class="form-control" name="price" value="{{ old('price') }}">

                                </div>

                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('admin.extras') }}"
                                        class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                    <button type="submit" class="btn btn-danger font-weight-bo  ld btn-square"
                                        id="addProduct"> Create Extras
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
        $('input:radio[name="sell_on_its_own"]').change(function() {
            if ($(this).val() == 'yes') {
                $('#IDContainer').css('display', 'block');
                $('#modifierContainer').css('display', 'block');
                $('#priceContainer').css('display', 'block');
                $('.addRequired').prop('required',true);

            } else {
                $('#IDContainer').css('display', 'none');
                $('#modifierContainer').css('display', 'none');
                $('#priceContainer').css('display', 'none');
                $('.addRequired').prop('required',false);
                $('.addRequired').val(0);
            }
        });
    </script>

    <script>


        $("#addProductFrom").submit(function(e) {
            if (document.getElementById("photo").files.length == 0) {
                event.preventDefault();
                $('#photo').addClass('border-danger');
                toastr.error("Please Upload Product", "Error");
                console.log("no files selected");
            } else {
                var fileUpload = document.getElementById("photo");
                var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                if (size > 5000) {
                    $('#photo').addClass('border-danger');
                    toastr.error("File size must be less then 5 Mb", "Error");
                    $("#addProduct").attr("disabled", false);
                    event.preventDefault();

                } else {
                    $("#addProduct").attr("disabled", true);
                }
            }
        });
    </script>
@endsection
