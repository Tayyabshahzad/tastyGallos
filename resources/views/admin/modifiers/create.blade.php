@extends('layouts.master')
@section('title', 'Modifiers Create')
@section('page_css')
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
                        <a href="{{ route('admin.modifiers') }}"> Modifiers </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">  Create</span>
                    </li>

                </ul>
            </div>
        </div>
        <form action="{{ route('admin.modifiers.store')}}" method="post" enctype="multipart/form-data" id="addModifierFrom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Create Modifiers</h3>
                            </div>
                            <div class="card-toolbar">
                            <div class="card-toolbar">
                                <input type="hidden" value="inactive" name="status">
                                <span class="switch switch-danger switch-icon switch-sm" >
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
                                @csrf
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Modifers Name*</label>
                                    <input type="text" required placeholder="Enter Name here" class="form-control" name="name" value="{{old('name')}}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Select Item*</label>
                                    <select class="form-control select2" id="kt_select2_3" multiple="multiple"  name="items[]" required>
                                        @foreach ($items as $item )
                                            <option value="{{ $item->id }}"  >   {{ $item->name }} &nbsp;&nbsp;&nbsp; &rArr; {{ $item->final_price }} ZAR </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group ticket_price_group">
                                    <div class="row">
                                        <div class="col-lg-12 mb-5 ">
                                            <label class="font-weight-bold">Rules *</label>
                                            <p class="font-weight-bold"> Set rules to control how customer select items in the modifier group </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 ">
                                            <p>What’s the minimum number of options a customer must select </p>
                                        </div>
                                        <div class="col-lg-2 text-left mb-5">
                                            <input type="number" required   class="form-control" name="select_min_options" value="{{old('select_min_options')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 ">
                                            <p>What’s the maximum number of options a customer can select </p>
                                        </div>

                                        <div class="col-lg-2 text-left mb-5">
                                            <input type="number" required   class="form-control" name="select_max_options"  value="{{old('select_max_options')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p>How many times can customers select any  single option </p>
                                        </div>
                                        <div class="col-lg-2 text-left">
                                            <input type="number" required   class="form-control"  name="option_selected_times" value="{{old('option_selected_times')}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p>Should choose quantity ?</p>
                                        </div>
                                        <div class="col-lg-2 text-left">
                                            <div class="col-2 col-form-label">
                                                <div class="checkbox-inline">
                                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                    <input type="checkbox" name="choose_quantity" value="yes" >
                                                    <span></span></label>

                                                </div>

                                            </div>

                                        </div>
                                    </div>



                                </div>
                                <div class="col-lg-12 text-right">
                                    <a  href="{{ route('admin.modifiers') }}" class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                    <button type="submit" class="btn btn-danger font-weight-bold btn-square" id="createModifier"> Add Modifier </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@section('page_js')

            @if ($errors->any())

            @foreach ($errors->all() as $error)
            @php
                    $myError = ucwords($error);
            @endphp
            <script>
                toastr.error('{{$myError}}', "Error");
            </script>
            @endforeach
            @endif


        <script>

             $('#kt_select2_3').select2({
                placeholder: "Select Item",
             });



             $("#addModifierFrom").submit(function (e) {
                    $("#createModifier").attr("disabled", true);
            });




        </script>

@endsection
