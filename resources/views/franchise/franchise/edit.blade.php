@extends('layouts.master')
@section('title', 'Franchise Edit')
@section('page_head')
    <link href="{{ asset('design/assets/css/pages/wiZARd/wiZARd-3.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                                <a href="{{ route('admin.franchise') }}" class="text-muted">Franchise</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="text-muted">Edit</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom mb-6">
            <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">

                        <li class="nav-item mr-3">
                            <a class="nav-link active" data-toggle="tab" href="#tab_1">
                                <span class="nav-text font-size-lg">Overview</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#tab_2">
                                <span class="nav-text font-size-lg">Information</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#tab_3">
                                <span class="nav-text font-size-lg">Reviews</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#tab_4">
                                <span class="nav-text font-size-lg">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#tab_5">
                                <span class="nav-text font-size-lg">Products</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#tab_6">
                                <span class="nav-text font-size-lg">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-toolbar">
                    <h4 class="mt-2 text-danger"> RWP 1</h4>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane show active" id="tab_1" role="tabpanel">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <div class="image-input image-input-outline" id="kt_image_1">
                                            <div class="image-input-wrapper"
                                                style="background-image: url('https://ih1.redbubble.net/image.410638526.9271/fposter,small,wall_texture,product,750x1000.jpg');">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            4.1
                                            <i class="fa fa-star text-warning font-size-sm"></i>
                                            <i class="fa fa-star text-warning font-size-sm"></i>
                                            <i class="fa fa-star text-warning font-size-sm"></i>
                                            <i class="fa fa-star text-warning font-size-sm"></i>
                                            <i class="fa fa-star text-dark-30 font-size-sm"></i>
                                            (28 Reviews)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card card-custom gutter-b wave wave-animate-slow wave-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-wrap align-items-center mb-10">


                                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                                <a href="#"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Current
                                                    Orders </a>
                                                <span class="text-muted font-weight-bold font-size-sm my-1">Ongoing
                                                    Orders</span>

                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center py-lg-0 py-2">
                                                <div class="d-flex flex-column text-right">
                                                    <span class="text-dark-75 font-weight-bolder font-size-h4">24,900</span>
                                                    <span class="text-muted font-size-sm font-weight-bolder">orders</span>
                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card card-custom gutter-b wave wave-animate-slow wave-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-wrap align-items-center mb-10">


                                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                                <a href="#"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Total
                                                    Reviews </a>
                                                <span class="text-muted font-weight-bold font-size-sm my-1"> Recorded
                                                    reviews till date</span>

                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center py-lg-0 py-2">
                                                <div class="d-flex flex-column text-right">
                                                    <span class="text-dark-75 font-weight-bolder font-size-h4">24,900</span>
                                                    <span class="text-muted font-size-sm font-weight-bolder">orders</span>
                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>








                    </div>

                    <div class="col-lg-8">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <h3 class="card-title"> Quick Stats: </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 mb-8">
                                        <div class="card card-custom wave wave-primary mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon2-open-box text-primary font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-primary font-weight-bold font-size-h3 mb-2 d-inline-block">3</span>
                                                        <div class="text-primary font-weight-bold">Current Orders</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 mb-8">
                                        <div class="card card-custom wave wave-success mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon-diagram text-success font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-success font-weight-bold font-size-h3 mb-2 d-inline-block">ZAR 203,00</span>
                                                        <div class="text-success font-weight-bold">Sales Today </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 mb-8">
                                        <div class="card card-custom wave wave-warning mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon-car text-warning font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-warning font-weight-bold font-size-h3 mb-2 d-inline-block">ZAR 10334</span>
                                                        <div class="text-warning font-weight-bold">Earning Today</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row mt-10">
                                    <div class="col-xl-6 col-lg-6 mb-8">
                                        <div class="card card-custom wave wave-danger mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon-tool text-primary font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-primary font-weight-bold font-size-h3 mb-2 d-inline-block">3</span>
                                                        <div class="text-primary font-weight-bold">Total Products</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 mb-8">
                                        <div class="card card-custom wave wave-info mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon-gift text-success font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-success font-weight-bold font-size-h3 mb-2 d-inline-block">2
                                                        </span>
                                                        <div class="text-success font-weight-bold">Running Promotions
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card card-custom guuter-b">

                                <div class="card-body  ">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="tab-pane" id="tab_2" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Franchise Info:</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-12">

                                                <table class="table table-borderless">
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td>Mon:</td>
                                                        <td> <input type="time" class="form-control"></td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td>
                                                            <select class="form-control" name="param">
                                                                <option value="Open"> Open </option>
                                                                <option value="Close"> Close </option>
                                                            </select>
                                                        </td>



                                                    </tr>
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td class="font-weight-bold">Tue:</td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td>
                                                            <select class="form-control" name="param">
                                                                <option value="Open"> Open </option>
                                                                <option value="Close"> Close </option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td class="font-weight-bold">Wed:</td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td>
                                                            <select class="form-control" name="param">
                                                                <option value="Open"> Open </option>
                                                                <option value="Close"> Close </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td class="font-weight-bold">Thu:</td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td>
                                                            <select class="form-control" name="param">
                                                                <option value="Open"> Open </option>
                                                                <option value="Close"> Close </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td class="font-weight-bold">Fri:</td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td>
                                                            <select class="form-control" name="param">
                                                                <option value="Open"> Open </option>
                                                                <option value="Close"> Close </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td class="font-weight-bold">Sat:</td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td  >
                                                            <select class="form-control" name="param">
                                                                <option value="Open"> Open </option>
                                                                <option value="Close"> Close </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td class="font-weight-bold">Sun:</td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td> <input type="time" class="form-control"> </td>
                                                        <td  >
                                                            <select class="form-control" name="param">
                                                                <option value="Open"> Open </option>
                                                                <option value="Close"> Close </option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">
                                                            <b> Upload Banner (750x1000 px) <span
                                                                    class="text-danger">*</span> </b>
                                                            <br>
                                                            <div class="image-input image-input-empty image-input-outline mt-5"
                                                                id="kt_image_5"
                                                                style="background-image: url(https://reactnativecode.com/wp-content/uploads/2018/02/Default_Image_Thumbnail.png)">
                                                                <div class="image-input-wrapper"></div>

                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-danger btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="Change avatar">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="profile_avatar"
                                                                        accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="profile_avatar_remove" />
                                                                </label>

                                                                <span
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-danger btn-shadow"
                                                                    data-action="cancel" data-toggle="tooltip"
                                                                    title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                </span>

                                                                <span
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-danger btn-shadow"
                                                                    data-action="remove" data-toggle="tooltip"
                                                                    title="Remove avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Franchise Details:</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <input type="text" class="form-control" placeholder="Name "  value="RWP 1"/>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <input type="text" class="form-control"
                                                            placeholder="Telephone " />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <input type="text" class="form-control"
                                                            placeholder="VAT Number " />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <input type="email" class="form-control"
                                                            placeholder="Contact Email " />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <input type="text" class="form-control"
                                                            value="Franchise ID:12524 " disabled />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <input type="text" class="form-control"
                                                            placeholder="Address: Google Address " />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                Standard Delivery <br />Charge:
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">ZAR</span>
                                                    </div>
                                                    <input type="text" class="form-control" value="50,00">
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-12" >
                                                <div class="form-group row">

                                                    <div class="col-9 col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox checkbox-danger">
                                                                <input type="checkbox" name="Checkboxes5" checked="checked"/>
                                                                <span></span>
                                                                Pickup
                                                            </label>
                                                            <label class="checkbox checkbox-danger">
                                                                <input type="checkbox" name="Checkboxes5"  />
                                                                <span></span>
                                                                Delivery
                                                            </label>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <textarea class="form-control" placeholder="About Franchise"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <h3 class="card-label" style="font-size:15px;color:#000">
                                                            Delivery Time Estimate:</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6" >
                                                <label> Busy Time </label>
                                                <select name="" id="" class="form-control">
                                                    <option value="" > 15 Mins </option>
                                                    <option value="" selected> 30 Mins </option>
                                                    <option value=""> 45 Mins </option>
                                                    <option value=""> 60 Mins </option>
                                                    <option value=""> 75 Mins </option>
                                                    <option value=""> 90 Mins </option>
                                                </select>

                                        </div>
                                        <div class="form-group col-lg-6" >
                                            <label> Free Time </label>
                                            <select name="" id="" class="form-control">
                                                <option value=""> 15 Mins </option>
                                                <option value=""> 30 Mins </option>
                                                <option value="" selected> 45 Mins </option>
                                                <option value=""> 60 Mins </option>
                                                <option value=""> 75 Mins </option>
                                                <option value=""> 90 Mins </option>
                                            </select>
                                        </div>
                                        </div>

                                    </div>


                                </div>
                            </div>


                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <!--begin::Mixed Widget 19-->
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Franchise Admin:</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="tab-content row">
                                                    <div class="form-group col-lg-12">
                                                        <input type="text" class="form-control" placeholder="Name" />
                                                    </div>

                                                    <div class="form-group col-lg-12">
                                                        <input type="email" class="form-control" placeholder="Email" />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <h3 class="card-label" style="font-size:15px;color:#000">
                                                            Bank Details:</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label> Bank Name </label>
                                                <input type="text" class="form-control"   value="HBL" disabled/>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label> Account Holder </label>
                                                <input type="text" class="form-control"   value="John" disabled/>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label> Branch Code  </label>
                                                <input type="text" class="form-control"   value="5555" disabled/>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label> Account Number </label>
                                                <input type="text" class="form-control"  value="0000000000000000" disabled/>
                                            </div>

                                            <div class="form-group col-lg-12">

                                                    <a  href="{{ route('admin.franchise') }}" class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                                    <button type="reset" class="btn btn-danger btn-square"> Update
                                                        Franchise </button>
                                            </div>
                                        </div>


                                    </div>



                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab_3" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-toolbar pt-2 row">
                                    <div class="col-lg-6">
                                        <label for=""> To :</label>
                                        <input type="date" class="form-control">
                                    </div>


                                    <div class="col-lg-6">
                                        <label for=""> From :</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>


                                <div class="card-toolbar">
                                    <button data-toggle="modal" data-target="#add_product_modal"
                                        class="btn btn-danger btn-square"> Excel</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--begin: Datatable-->
                                <div class="table-responsive">
                                    <table class="table table-separate table-head-custom table-checkable dataTable">
                                        <thead>
                                            <tr>
                                                <th style=""> Order Number </th>
                                                <th style="">Type</th>
                                                <th style="">Customer</th>
                                                <th style="">Rating</th>
                                                <th style="">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>

                                                <td> # 11349 </td>
                                                <td> Delivery </td>
                                                <td> devrwp </td>
                                                <td>
                                                    <i class="flaticon-star text-warning"></i>
                                                    <i class="flaticon-star text-warning"></i>
                                                    <i class="flaticon-star text-warning"></i>
                                                    <i class="flaticon-star text-warning"></i>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block text-warning">
                                                        <a href='#' data-toggle="modal" data-target="#edit_product_modal">
                                                            <i class=" icon-1x text-warning flaticon-eye"></i> </a>
                                                    </span>
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--end: Datatable-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_4" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom">

                            <div class="card-body">

                                <!--begin: Datatable-->

                                <!--end: Datatable-->

                                <div class="example-preview">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-hourglass-1"></i>
                                                </span>
                                                <span class="nav-text">Active Orders </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                                aria-controls="profile">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-layers-1"></i>
                                                </span>
                                                <span class="nav-text">All Orders </span>
                                            </a>
                                        </li>


                                    </ul>
                                    <div class="tab-content mt-5" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">

                                            <div class="mr-2 row col-lg-12">
                                                <select class="form-control select2 " id="orderstatus" name="param"
                                                    style="width:30%;">
                                                    <option value="*"> All </option>
                                                    <option value="Rwp"> PickUp </option>
                                                    <option value="ISB"> Delivery </option>

                                                </select>
                                            </div>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-separate table-head-custom table-checkable dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th style="">Order Number </th>
                                                            <th style="">Type</th>
                                                            <th style="">Customer</th>
                                                            <th style="">Price</th>
                                                            <th style="">Time Ago</th>
                                                            <th style="">Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>

                                                            <td> # 11349 </td>
                                                            <td> Delivery </td>
                                                            <td> devrwp </td>
                                                            <td> ZAR 3000 </td>
                                                            <td> 20 mins </td>
                                                            <td>
                                                                <span
                                                                    class="text-dark-75 font-weight-bolder d-block text-warning">
                                                                    <a href='#' data-toggle="modal"
                                                                        data-target="#activeOrderDetails"> <i
                                                                            class=" icon-1x text-warning flaticon-eye"></i>
                                                                    </a>
                                                                </span>
                                                            </td>

                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>
                                                        To
                                                    </label>
                                                    <input type="date" class="form-control" />
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>
                                                        From
                                                    </label>
                                                    <input type="date" class="form-control" />
                                                </div>

                                                <div class="col-lg-6 pt-8 text-right">
                                                    <div class="card-toolbar">
                                                        <button data-toggle="modal" data-target="#add_product_modal"
                                                            class="btn btn-danger btn-square"> Export to Excel</button>
                                                    </div>

                                                </div>




                                            </div>


                                            <div class="table-responsive mt-10">
                                                <table
                                                    class="table table-separate table-head-custom table-checkable dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th style="">Order Number </th>
                                                            <th style="">Type</th>
                                                            <th style="">Customer</th>
                                                            <th style="">Price</th>
                                                            <th style="">Time Ago</th>
                                                            <th style="">Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>

                                                            <td> # 11349 </td>
                                                            <td> Delivery </td>
                                                            <td> devrwp </td>
                                                            <td> ZAR 3000 </td>
                                                            <td> 20 mins </td>
                                                            <td>
                                                                <span
                                                                    class="text-dark-75 font-weight-bolder d-block text-warning">
                                                                    <a href='#' data-toggle="modal"
                                                                        data-target="#completeOrderDetails"> <i
                                                                            class=" icon-1x text-warning flaticon-eye"></i>
                                                                    </a>
                                                                </span>
                                                            </td>

                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_5" role="tabpanel">
                {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom">
                        <div class="card-body">
                            <div class="d-flex">
                                <span class="switch switch-danger switch-icon">
                                    <span class="font-weight-bold">Supplier Status:</span>
                                    <label class="ml-2">
                                        <input type="checkbox" value="active" checked="checked" name="status" />
                                        <span></span>
                                    </label>
                                </span>
                                <span class="text-danger mt-2 status_text ml-1 font-weight-bold font-italic">Active</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div> --}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom">

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <div class="table-responsive">
                                    <table class="table table-separate table-head-custom table-checkable dataTable">
                                        <thead>
                                            <tr>
                                                <th style=""> Product ID </th>
                                                <th style=""> Name </th>
                                                <th style="">Category</th>
                                                <th style="">Noraml Price</th>
                                                <th style="">Sale Price</th>
                                                <th style="">Buy one Get one Product </th>
                                                <th style="">Special Price</th>
                                                <th style="">Status </th>
                                                <th style="">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>

                                                <td> P1349 </td>
                                                <td> Chicken Gallo Burger </td>
                                                <td> Burger </td>
                                                <td> 30,000 </td>
                                                <td> 30,000 </td>
                                                <td> Chips</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">ZAR</span>
                                                        </div>
                                                        <input type="text" class="form-control" value="3.000,00">
                                                    </div>


                                                <td>
                                                    <span class="switch switch-sm  switch-warning switch-icon">

                                                        <label class="ml-2">
                                                            <input type="checkbox" value="active" checked="checked"
                                                                name="status">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="reset" class="btn btn-danger btn-square"> Update
                                                    </button>
                                                </td>

                                            </tr>





                                            <tr class="bg-light-danger">

                                                <td> P1347 </td>
                                                <td> Beef Gallo Burger </td>
                                                <td> Burger </td>
                                                <td> 30,000 </td>
                                                <td> 30,000 </td>
                                                <td> Onion Rings</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">ZAR</span>
                                                        </div>
                                                        <input type="text" class="form-control" value="3.000,00">
                                                    </div>

                                                </td>
                                                <td>
                                                    <span class="switch switch-sm switch-warning switch-icon">

                                                        <label class="ml-2">
                                                            <input type="checkbox" value="active" checked="checked"
                                                                name="status">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </td>
                                                <td>

                                                    <button type="reset" class="btn btn-danger btn-square"> Update
                                                    </button>
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--end: Datatable-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab_6" role="tabpanel">
                <div class="row">




                    <div class="col-lg-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 text-left">
                                        <p class="font-weight-bolder" style="border-bottom: 1px dotted #333">Franchise
                                            Admin Details:</p>
                                    </div>
                                    <div class="col-lg-12 text-left form-group">
                                        <input type="email" class="form-control" disabled value="admin@gmail.com">
                                    </div>
                                    <div class="col-lg-6 text-left form-group">
                                        <input type="text" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="col-lg-6 text-left form-group">
                                        <input type="text" class="form-control" placeholder="Re-enter Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 text-left">
                                        <p class="font-weight-bolder" style="border-bottom: 1px dotted #333">Franchise
                                            Info:</p>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <span class="switch switch-sm switch-warning switch-icon">
                                            <label> Franchise Status: </label>
                                            <hr>
                                            <label class="ml-2">
                                                <input type="checkbox" value="active" checked="checked" name="status">
                                                <span></span>
                                            </label>
                                        </span>


                                    </div>


                                    <div class="col-lg-12 text-right mt-17">

                                        <a  href="{{ route('admin.franchise') }}" class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                        <button type="reset" class="btn btn-danger btn-square"> Update </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>




    <div class="modal fade bd-example-modal-lg" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="edit_product_form" method="post" action="javascript:;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Order Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">

                                <div class="table-responsive">
                                    <table class="table table-separate table-head-custom table-checkable dataTable">

                                        <tr>
                                            <th style="">Order Number: </th>
                                            <td> # 11349 </td>
                                        </tr>
                                        <tr>
                                            <th style="">Customer:</th>
                                            <td> Ali </td>
                                        </tr>
                                        <tr>
                                            <th style="">Phone Number:</th>
                                            <td>   1111 </td>
                                        </tr>
                                        <tr>
                                            <th style="">Rating:</th>
                                            <td> <i class="flaticon-star text-warning"></i>
                                                <i class="flaticon-star text-warning"></i>
                                                <i class="flaticon-star text-muted"></i>
                                                <i class="flaticon-star text-muted"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="">Review:</th>
                                            <td> <textarea name="" placeholder="Review By Ali" disabled
                                                    class="form-control"></textarea></td>

                                        </tr>



                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>




    <div class="modal fade bd-example-modal-lg" id="activeOrderDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details <small class="text-success">(Active)</small></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <tr>
                                            <th style="">Order Number: </th>
                                            <td> # 11349 </td>
                                            <th style="">Status: </th>
                                            <td> Progress </td>
                                        </tr>
                                        <tr>
                                            <th style="">Customer:</th>
                                            <td> Ali </td>
                                            <th style="">Time Ago: </th>
                                            <td> 10 mins </td>
                                        </tr>
                                        <tr>
                                            <th style="">Type:</th>
                                            <td > Delivery </td>
                                            <th style="">Customer#:</th>
                                            <td > 333978811 </td>

                                        </tr>

                                        <tr>
                                            <th style="">Address:</th>
                                            <td > SN 333 Street2 ISB </td>



                                        </tr>




                                    </table>
                                    <table class="table   table-head-custom table-checkable dataTable ">
                                        <tr class="thead-light">
                                            <th style=""> Name: </th>
                                            <th style="">Qty </th>
                                            <th> Price </th>
                                        </tr>

                                        <tr>
                                            <td style="">
                                                Gallo Burger: <br />
                                                <small>Tasty Sauc, Lemon Herb , Coke Can</small>
                                            </td>
                                            <td style="">3</td>
                                            <td> ZAR 3000 </td>
                                        </tr>





                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div>

                            <button type="submit" class="btn btn-danger font-weight-bold  btn-square  " data-dismiss="modal" aria-label="Close"> Close</button>
                        </div>
                    </div>


            </div>
        </div>
    </div>



    <div class="modal fade bd-example-modal-lg" id="completeOrderDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <tr>
                                            <th style="">Order Number: </th>
                                            <td> # 11349 </td>
                                            <th style="">Status: </th>
                                            <td> Delivered </td>
                                        </tr>
                                        <tr>
                                            <th style="">Customer:</th>
                                            <td> Ali </td>
                                            <th style="">Time Ago: </th>
                                            <td> 10 mins </td>
                                        </tr>
                                        <tr>
                                            <th style="">Type:</th>
                                            <td > Delivery </td>
                                            <th style="">Customer#:</th>
                                            <td > 333978811 </td>

                                        </tr>

                                        <tr>
                                            <th style="">Address:</th>
                                            <td > SN 333 Street2 ISB </td>
                                            <th style="">Review:</th>

                                            <td >
                                                <i class="flaticon-star text-warning"></i>
                                                <i class="flaticon-star text-warning"></i>
                                                <i class="flaticon-star text-warning"></i>
                                                <i class="flaticon-star text-muted"></i>
                                                <i class="flaticon-star text-muted"></i>
                                            </td>
                                        </tr>





                                    </table>
                                    <table class="table   table-head-custom table-checkable dataTable ">
                                        <tr class="thead-light">
                                            <th style=""> Name: </th>
                                            <th style="">Qty </th>
                                            <th> Price </th>
                                        </tr>

                                        <tr>
                                            <td style="">
                                                Gallo Burger: <br />
                                                <small>Tasty Sauc, Lemon Herb , Coke Can</small>
                                            </td>
                                            <td style="">3</td>
                                            <td> ZAR 3000 </td>
                                        </tr>





                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div>

                            <button type="submit" class="btn btn-danger font-weight-bold  btn-square  " data-dismiss="modal" aria-label="Close"> Close</button>
                        </div>
                    </div>


            </div>
        </div>
    </div>

@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>


    <script src="{{ asset('design/assets/js/pages/custom/wiZARd/wiZARd-3.js') }}"></script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        var table = $('#kt_datatable').DataTable();
    </script>

    <script src="{{ asset('design/assets/js/pages/crud/file-upload/image-input.js') }}"></script>
    <script>
        var avatar5 = new KTImageInput('kt_image_5');
    </script>

    <script>
        $('#orderstatus').select2({
            placeholder: "Select a Type"
        });
    </script>

@endsection
