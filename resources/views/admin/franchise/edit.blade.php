@extends('layouts.master')
@section('title', 'Franchise Edit')
@section('page_head')
    <link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"  type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"   src="https://maps.google.com/maps/api/js?key=AIzaSyBK-wq4OsIg-Kftqkahw2-7y1yBSdfc9aM&libraries=places" ></script>

    <style>
        .border-danger {
            border: 1px solid rgb(240, 104, 104);
        }

        .buttons-excel {
            display: none;
        }

        .image-input .image-input-wrapper {
            background-size: contain;
            width: 200px;
        }

        .ratingNumber {
            visibility: hidden;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            border-bottom: none !important;
        }
        .productStatus:hover{
            cursor: pointer;
        }
        .radio>input:checked~span{
            background: #f64e60;
        }
    </style>
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
                                <a href="{{ route('admin.franchises') }}" class="text-muted">Franchise</a>
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
                    <h4 class="mt-2 text-danger"> {{ $franchise->name }} </h4>
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
                                                style="background-image: url(@if ($franchise->getFirstMediaUrl('franchise_banner', 'thumb') != '') {{ $franchise->getFirstMediaUrl('franchise_banner', 'thumb') }}
                                                    @else
                                                    https://wtwp.com/wp-content/uploads/2015/06/placeholder-image.png @endif);">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            @for ($j = 1; $j <= round($avgRating); $j++)
                                                <i class="fa fa-star text-dark-30 font-size-sm text-warning"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="Overall Rating {{ round($avgRating) }}"></i>
                                            @endfor

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
                                                <span
                                                    class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Total
                                                    Orders </span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center py-lg-0 py-2">
                                                <div class="d-flex flex-column text-right">
                                                    <span class="text-dark-75 font-weight-bolder font-size-h4">
                                                        {{ $orderCount }} </span>
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
                                                <span href="#"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Total
                                                    Reviews </span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center py-lg-0 py-2">
                                                <div class="d-flex flex-column text-right">
                                                    <span class="text-dark-75 font-weight-bolder font-size-h4">
                                                        {{ $franchise->reviews->count() }} </span>
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
                                <div class="row pb-13">
                                    <div class="col-xl-4 col-lg-6 mb-8">
                                        <div class="card card-custom wave wave-primary mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon2-open-box text-primary font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-primary font-weight-bold font-size-h3 mb-2 d-inline-block">
                                                            {{ $orderCount }} </span>
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
                                                            class="text-success font-weight-bold font-size-h3 mb-2 d-inline-block">
                                                            ZAR {{ $todaySales }} </span>
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
                                                            class="text-warning font-weight-bold font-size-h3 mb-2 d-inline-block">
                                                            ZAR {{ $earningToday }} </span>
                                                        <div class="text-warning font-weight-bold">Earning Today</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xl-4 col-lg-4 mb-8">
                                        <div class="card card-custom wave wave-danger mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon-tool text-primary font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-primary font-weight-bold font-size-h3 mb-2 d-inline-block">
                                                            {{ $productCount }} </span>
                                                        <div class="text-primary font-weight-bold">Total Products</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-4 mb-8">
                                        <div class="card card-custom wave wave-danger mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon-tool text-primary font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-primary font-weight-bold font-size-h3 mb-2 d-inline-block">
                                                            {{ $inActiveProductCount }} </span>
                                                        <div class="text-primary font-weight-bold">Inactive Products</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 mb-8">
                                        <div class="card card-custom wave wave-info mb-8 mb-lg-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center p-5 justify-content-between">
                                                    <div class="mr-6">
                                                        <i class="flaticon-gift text-success font-size-h1"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <span
                                                            class="text-success font-weight-bold font-size-h3 mb-2 d-inline-block">
                                                            {{ $totalPromotions}}
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
                <form action="{{ route('admin.franchises.update') }}" method="post" enctype="multipart/form-data"
                    id="editFranchiseForm">
                    @csrf
                    <input type="hidden" name="edit_id" value="{{ $franchise->id }}">
                    <input type="hidden" name="user_id" value="{{ $franchise->user->id }}">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">Franchise Info</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td colspan="4">
                                                        <b> Banner <span class="text-danger">*</span> <br></b>
                                                        <div class="image-input image-input-outline mt-2" id="kt_image_5">
                                                            <div class="image-input-wrapper"
                                                                @if ($franchise->getFirstMediaUrl('franchise_banner', 'thumb') != '') @php $path = $franchise->getFirstMediaUrl('franchise_banner', 'thumb') @endphp
                                                                @else @php $path = 'https://wtwp.com/wp-content/uploads/2015/06/placeholder-image.png' @endphp @endif
                                                                style="background-image:url({{ $path }}); width:
                                                                        250px; height: 167px; max-width: 100%;">
                                                            </div>
                                                            <label
                                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                data-action="change" data-toggle="tooltip" title=""
                                                                data-original-title="Upload Banner">
                                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                                <input type="file" name="franchise_banner"
                                                                    id="bannerPhoto" accept=".png, .jpg, .jpeg">
                                                                <input type="hidden" name="profile_avatar_remove"
                                                                    value="0">
                                                            </label>
                                                            <span
                                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                data-action="cancel" data-toggle="tooltip" title=""
                                                                data-original-title="Remove Banner">
                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <b> Trading Hours <span class="text-danger">*</span> </b> <br>
                                                    </td>
                                                </tr>
                                                @foreach ($franchise->workingHours as $hours)
                                                    <input type="hidden" value="{{ $hours->id }}"
                                                        name="workingHourId[]">
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td style="padding-right:0!important;padding-left:2px!important">
                                                            {{ ucfirst($hours->code) }}:<span class="text-danger">
                                                                @if ($hours->status == 'open')
                                                                    *
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $hours->day }}" name="day[]">
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $hours->code }}" name="code[]">
                                                            <input type="text" class="form-control openTime franchise_time"
                                                                name="opening_time[]" style="width:100px;"
                                                                value="{{ $hours->opening_time }}"
                                                                @if ($hours->status == 'open') required @endif>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control closeTime franchise_time"
                                                                name="closing_time[]" style="width:100px;"
                                                                value="{{ $hours->closing_time }}"
                                                                @if ($hours->status == 'open') required @endif>
                                                        </td>
                                                        <td>
                                                            <select class="form-control timings " style="width:100px;"
                                                                onchange="getCurrentStatus(this)" name="time_status[]">
                                                                <option value="open"
                                                                    @if ($hours->status == 'open') selected @endif> Open
                                                                </option>
                                                                <option value="close"
                                                                    @if ($hours->status == 'close') selected @endif> Close
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
                                        <h3 class="card-label">Franchise Details</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        name="franchise_name" required
                                                        value="{{ $franchise->name }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Phone <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="franchise_phone"
                                                         required
                                                        value="{{ $franchise->contact_phone }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> VAT Number <span class="text-danger">*</span> </label>
                                                    <input type="number" class="form-control" placeholder="VAT Number"
                                                        name="franchise_vat" required value="{{ $franchise->vat }}"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Contact Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" class="form-control"
                                                        placeholder="Contact Email " name="contact_email" required
                                                        value="{{ $franchise->contact_email }}" />
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <input type="text" class="form-control" value="Franchise ID" valaue='1' disabled />
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Address <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Address: Google Address" name="franchise_address"
                                                        id="franchise_address" value="{{ $franchise->address }}"
                                                        required />
                                                    <input type="hidden" id="loc_lat" value="{{ $franchise->lat }}"
                                                        name="lat" required>
                                                    <input type="hidden" id="loc_long" value="{{ $franchise->lng }}"
                                                        name="lng" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            Standard Delivery <br />Charge: <span class="text-danger">*</span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ $franchise->delivery_charge }}" name="delivery_charge">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="deliver_type_pickup" value="no" />
                                                <input type="hidden" name="deliver_type_delivery" value="no" />
                                                <div class="col-9 col-form-label">
                                                    <label for=""> Select Delivery Type <span
                                                            class="text-danger">*</span> </label>
                                                    <div class="checkbox-inline mt-2">
                                                        <label class="checkbox checkbox-danger">
                                                            <input type="checkbox" class="pickupBox" name="pickup"
                                                                @if ($franchise->pickup == '1') checked="checked" @endif
                                                                value="yes" />
                                                            <span class="pickupContainer"></span>
                                                            Pickup
                                                        </label>
                                                        <label class="checkbox checkbox-danger">
                                                            <input type="checkbox" class="deliveryBox" name="delivery"
                                                                @if ($franchise->delivery == '1') checked="checked" @endif
                                                                value="yes" />
                                                            <span class="deliveryContainer"></span>
                                                            Delivery
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-12 col-form-label">
                                                    <label for=""> Select Payment Method <span class="text-danger">*</span></label>
                                                    <div class="radio-inline">
                                                        <label class="radio">
                                                        <input type="radio" name="payment_method" value="paygate" required @if($franchise->payment_method == 'paygate' ) checked="checked" @endif>
                                                        <span></span>Pay Gate</label>
                                                        <label class="radio">
                                                        <input type="radio" name="payment_method" value="cash" @if($franchise->payment_method == 'cash' ) checked="checked" @endif>
                                                        <span></span>Cash</label>
                                                        <label class="radio">
                                                        <input type="radio" name="payment_method" value="both"  @if($franchise->payment_method == 'both' ) checked="checked" @endif>
                                                        <span></span>Both</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for=""> About Franchise </label>
                                            <textarea class="form-control" placeholder="About ..." name="about_franchise">{{ $franchise->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 m-3">
                                            <b> Delivery Time Estimate </b>

                                            <input type="number" name="estimated_time" id="" required
                                                class="form-control" placeholder="Estimated Time"
                                                value="{{ $franchise->estimated_time }}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label> Busy Time </label>
                                            <select id="" class="form-control" name="busy_time" required>
                                                <option value="15" @if ($franchise->busy_time == '15') selected @endif>
                                                    15
                                                    Mins </option>
                                                <option value="30" @if ($franchise->busy_time == '30') selected @endif>
                                                    30
                                                    Mins </option>
                                                <option value="45" @if ($franchise->busy_time == '45') selected @endif>
                                                    45
                                                    Mins </option>
                                                <option value="60" @if ($franchise->busy_time == '60') selected @endif>
                                                    60
                                                    Mins </option>
                                                <option value="75" @if ($franchise->busy_time == '75') selected @endif>
                                                    75
                                                    Mins </option>
                                                <option value="90" @if ($franchise->busy_time == '90') selected @endif>
                                                    90
                                                    Mins </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label> Free Time </label>
                                            <select id="" class="form-control" name="free_time" required>
                                                <option value="15" @if ($franchise->free_time == '15') selected @endif>
                                                    15
                                                    Mins </option>
                                                <option value="30" @if ($franchise->free_time == '30') selected @endif>
                                                    30
                                                    Mins </option>
                                                <option value="45" @if ($franchise->free_time == '45') selected @endif>
                                                    45
                                                    Mins </option>
                                                <option value="60" @if ($franchise->free_time == '60') selected @endif>
                                                    60
                                                    Mins </option>
                                                <option value="75" @if ($franchise->free_time == '75') selected @endif>
                                                    75
                                                    Mins </option>
                                                <option value="90" @if ($franchise->free_time == '90') selected @endif>
                                                    90
                                                    Mins </option>
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
                                        <h3 class="card-label">Franchise Admin</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="tab-content row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Admin Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="admin_name" required
                                                        value="{{ $franchise->user->name }}" />
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Admin Email <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" disabled
                                                        value="{{ $franchise->user->email }}" />
                                                </div>

                                                <div class="form-group col-lg-12">
                                                    <label for=""> Username <span
                                                            class="text-danger">*</span></label>
                                                    <input type="username" class="form-control" disabled
                                                        value="{{ $franchise->user->username }}" />
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
                                            <input type="text" class="form-control" name="bank"
                                                value="{{ $franchise->bank }}"  placeholder="Enter bank name"  />
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label> Account Holder </label>
                                            <input type="text" class="form-control"
                                                value="{{ $franchise->account_holder }}" name="account_holder"  placeholder="Enter account holder name"  />
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label> Branch Code </label>
                                            <input type="text" class="form-control" name="branch" placeholder="Enter branch code"
                                                value="{{ $franchise->branch }}"   />
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label> Account Number </label>
                                            <input type="text" class="form-control" name="account_number" placeholder="Enter account number"
                                                value="{{ $franchise->account_number }}"   />
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <button type="submit" class="btn btn-danger btn-square"
                                                id="UpdateFranchise">
                                                Update Franchise
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="tab_3" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom mb-4">
                            <div class="card-header">
                                <div class="card-title row" style="width:70%">
                                    <div class="col-lg-3 p-5">
                                        <label for=""> <small style="color:#000"> From Date </small> </label>
                                        <input type="date" style="border-radius:0;" id="review_from_date"
                                            class="form-control" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for=""> <small style="color:#000"> To Date </small></label>
                                        <input type="date" style="border-radius:0;" id="review_to_date"
                                            class="form-control" />
                                    </div>
                                    <div class="col-lg-3 pt-8">
                                        <button type="button" class="btn btn-danger btn-square" id="review_filter">
                                            Filter
                                        </button>
                                        <button type="button" class="btn btn-warning btn-square"
                                            id="review_filter_reset">
                                            Reset </button>
                                    </div>
                                </div>
                                <div class="card-toolbar">
                                    <div class="card-toolbar">
                                        <button class="btn btn-danger btn-square" id="reviewExport"> Export to Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="table-responsive">
                                        <table class="table table-separate table-head-custom table-checkable"
                                            id="review-table">
                                            <thead>
                                                <tr class="text-left text-uppercase">
                                                    <th>#</th>
                                                    <th>Order Number</th>
                                                    <th>Type</th>
                                                    <th>Customer</th>
                                                    <th>Rating</th>
                                                    <th>Time & date</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Advance Table Widget 4-->
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_4" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom">
                            <div class="card-body">
                                <div class="example-preview">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab"
                                                href="#allActiveOrders">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-hourglass-1"></i>
                                                </span>
                                                <span class="nav-text">Active Orders </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Table"
                                                aria-controls="profile">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-layers-1"></i>
                                                </span>
                                                <span class="nav-text">All Orders </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-5" id="myTabContent">
                                        <div class="tab-pane fade active show" id="allActiveOrders" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="mr-2 mb-4 row col-lg-12">
                                                <select class="form-control select2 mt-4 " id="orderType"
                                                    style="width:30%;">
                                                    <option value="all"> All </option>
                                                    <option value="pickup"> PickUp </option>
                                                    <option value="delivery"> Delivery </option>
                                                </select>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-separate table-head-custom table-checkable"
                                                    id="activeOrder">
                                                    <thead>
                                                        <tr>
                                                            <th style="">Order Number </th>
                                                            <th style="">Type</th>
                                                            <th style="">Customer</th>
                                                            <th style="">BILL AMOUNT <strong>(ZAR)</strong></th>
                                                            <th style=""> Payment Method </th>
                                                            <th>Status</th>
                                                            <th style="">Time & date</th>
                                                            <th style="">Details</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="Table" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="card-header" style="padding: 0!important">
                                                <div class="card-title row" style="width:100%">
                                                    <div class="col-lg-3">
                                                        <label for=""> From Date </label>
                                                        <input type="date" style="border-radius:0;"
                                                            id="orders_from_date" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for=""> From Date </label>
                                                        <input type="date" style="border-radius:0;"
                                                            id="orders_to_date" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-3 pt-2">
                                                        <br>
                                                        <button type="button" class="btn btn-danger btn-square"
                                                            id="orders_filter">
                                                            Filter
                                                        </button>
                                                        <button type="button" class="btn btn-warning btn-square"
                                                            id="orders_filter_reset">
                                                            Reset
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-3 text-right pt-8">
                                                        <button type="button" class="btn btn-danger btn-square"
                                                            id="orderExport">
                                                            Export to Excel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive mt-10">
                                                <table
                                                    class="table table-separate table-head-custom table-checkable dataTable"
                                                    id="allordersTable">
                                                    <thead>
                                                        <tr>
                                                            <th style="">Order Number </th>
                                                            <th style="">Type</th>
                                                            <th style="">Customer</th>
                                                            <th style="">BILL AMOUNT <strong>(ZAR)</strong></th>
                                                            <th>Status</th>
                                                            <th style="">Time & date</th>
                                                            <th style="">Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom">
                            <div class="card-body">
                                <!--begin: Datatable-->
                                <div class="table-responsive">
                                    <table class="table   table-head-custom table-checkable dataTable" id="productsTable">
                                        <thead>
                                            <tr>
                                                <th>Name </th>
                                                <th>Category</th>
                                                <th>Normal Price <strong>(ZAR)</strong> </th>
                                                <th>Sale Price <strong>(ZAR)</strong> </th>
                                                <th>Sell its own </th>
                                                <th>Promotions / Discount</th>
                                                <th>Special Price <strong>(ZAR)</strong> </th>
                                                <th>Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td> {{ $product->name }} </td>
                                                    <td>
                                                        @foreach ($product->categories as $category)
                                                            <button class=" btn btn-outline-secondary btn-sm btn-square">
                                                                {{ $category->name }} </button>
                                                        @endforeach
                                                    </td>
                                                    <td> {{ $product->price }} </td>
                                                    <td> {{ $product->sale_price }} </td>
                                                    <td> {{ $product->sell_on_its_own }} </td>
                                                    <td>
                                                        @foreach ($product->promotions as $promotion)
                                                            @if ($promotion->type == 'bogo')
                                                                Bogo ,
                                                            @else
                                                                {{ $promotion->amount }}
                                                                @if ($promotion->discount_type == 'amount')
                                                                    ZAR
                                                                @else
                                                                    %
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($product->specialPrice->count() > 0)
                                                            @foreach ($product->specialPrice as $price)
                                                                <div class="input-group specialpriceContainer">
                                                                    <input type="number"
                                                                        class="form-control current_price"
                                                                        value="{{ $price->price }}">
                                                                    <div class="input-group-prepend updateButton updateSpecialPrice"
                                                                        data-product_id='{{ $price->id }}'>
                                                                        <span class="input-group-text  "
                                                                            style="cursor:pointer">
                                                                            Update
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <small style="cursor:pointer"
                                                                    class=" text-danger mt-2 removePrice"
                                                                    data-id="{{ $price->id }}">
                                                                    Remove Special Price
                                                                </small>
                                                            @endforeach
                                                        @else
                                                            <small style="cursor:pointer"
                                                                class=" text-danger mt-2 setprice" data-toggle="modal"
                                                                data-target="#set_special_price"
                                                                data-id_product="{{ $product->id }}">
                                                                Set Special Price
                                                            </small>
                                                        @endif

                                                    </td>
                                                    <td class="">

                                                        @if ($product->productStatus->count() > 0)
                                                            @foreach ($product->productStatus as $product_status)
                                                                @if ($product_status->status == 'active')
                                                                    <i class="text-success icon-1x text-dark-5 flaticon2-check-mark productStatus"
                                                                        data-product_id="{{ $product->id }}"
                                                                        data-status="{{ $product_status->status }}"></i>
                                                                @else
                                                                    <i class="text-danger icon-1x text-dark-5 flaticon2-cross productStatus"
                                                                        data-product_id="{{ $product->id }}"
                                                                        data-status="{{ $product_status->status }}"></i>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <i class="text-success icon-1x text-dark-5 flaticon2-check-mark productStatus"
                                                                data-product_id="{{ $product->id }}"
                                                                data-status="inactive"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_6" role="tabpanel">
                <form action="" method="post" enctype="multipart/form-data" id="updateSettingForm">
                    @csrf
                    <input type="hidden" id="franchiseId" value="{{ $franchise->id }}">
                    <input type="hidden" id="userId" value="{{ $franchise->user->id }}">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-custom mb-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">Franchise Admin Details</h3>
                                    </div>
                                    <div class="card-title text-right">
                                        <h3 class="card-label">
                                            <span class="switch switch-sm switch-danger switch-icon">
                                                <hr>
                                                <label class="ml-2">
                                                    <input type="checkbox" value="active" id="status"
                                                        @if ($franchise->status == 'active') checked="checked" @endif>
                                                    <span></span>
                                                </label>
                                            </span>

                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 text-left form-group">
                                            <input type="email" name="email" id="settingEmail" class="form-control"
                                                value="{{ $franchise->user->email }}">
                                        </div>
                                        <div class="col-lg-6 text-left form-group">
                                            <input type="password" class="form-control" placeholder="Password"
                                                id="password">
                                        </div>
                                        <div class="col-lg-6 text-left form-group">
                                            <input type="password" class="form-control" placeholder="Re-enter password"
                                                id="confirm_password">
                                        </div>
                                        <div class="col-lg-12 text-danger" id="passwordError" style="display: none">
                                            <small> Password & confirm password not matched </small>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            <a href="{{ route('admin.franchises') }}"
                                                class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                            <button type="button" class="btn btn-danger btn-square" id="updateSetting">
                                                Update </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.franchise.partials.review-detail-modal')
    @include('admin.franchise.partials.order-modal')
    @include('admin.franchise.partials.modifier-Items')
@endsection
@section('page_js')
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('design/assets/js/pages/crud/file-upload/image-input.js') }}"></script>

    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK-wq4OsIg-Kftqkahw2-7y1yBSdfc9aM&libraries=places"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"
        integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/franchise/main.js') }}"></script>
    <script src="{{ asset('js/franchise/order.js') }}"></script>
    <script src="{{ asset('js/franchise/product.js') }}"></script>
    <script src="{{ asset('js/franchise/review.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script>
        $('#passwordError').css('display:none');
        var url = "{{ route('admin.franchise.password.update') }}";
        var reviewURL = "{{ route('admin.franchise.user.detail.get') }}";
        var DT_ReviewURL = "{{ route('admin.franchise.review') }}";
        var DT_OrderURL = "{{ route('admin.franchise.orders.all') }}";
        var DT_AciveOrderURL = "{{ route('admin.franchise.active.orders') }}";
        var getAllOrderURL = "{{ route('admin.franchise.orders.all') }}";
        var getOrderItemsURL = "{{ route('admin.franchise.orders.detail') }}";
        var getFranchiseProducts = "{{ route('admin.franchise.products') }}";
        var orderFilterUrl = "{{ route('admin.franchise.order.filter') }}";
        var reviewFilterUrl = "{{ route('admin.franchise.review.filter') }}";
        var franchiseId = {{ $franchise->id }}
        settingUpdate(url);
        //allReviews(getReviewURL, franchiseId);
        //activeOrders(getAciveOrderURL, franchiseId);
        //allOrders(getAllOrderURL, franchiseId);
        //orderDetail(getOrderItemsURL);
        // $(document).ready(function() {
        //     var autocomplete;
        //     autocomplete = new google.maps.places.Autocomplete((document.getElementById('franchise_address')), {
        //         types: ['geocode'],
        //     });
        //     google.maps.event.addListener(autocomplete, 'place_changed', function() {
        //         var near_place = autocomplete.getPlace();
        //         document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        //         document.getElementById('loc_long').value = near_place.geometry.location.lng();
        //     });
        // });
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
        $("#productsTable").on("click", ".changeStatusButton", function(e) {
            $(this).closest('.specialpriceContainer').find('.specialPriceValue').css('display', 'block');
            $(this).closest('.specialpriceContainer').find('.input-group-prepend').css('display', 'block');
            $(this).css('display', 'none');
        });
        $("#productsTable").on("click", ".product_status", function(e) {
            var status = $(this).closest('.status').find('.product_status').val();
            var product_id = $(this).data('product_id');
            var franchise_id = $(this).data('franchise_id');
            if (status == 'active') {
                status = 'inactive';
            } else {
                status = 'active';
            }
            statusUrl = "{{ route('admin.franchise.product.status') }}";
            $.ajax({
                url: statusUrl,
                method: 'POST',
                data: {
                    status: status,
                    product_id: product_id,
                    franchise_id: franchise_id,
                },
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.message, "Success");
                    } else {
                        toastr.error(response.message, "Error");
                    }
                    console.log(response);
                },
            });
        });
        $(document).ready(function() {
            $('#review_filter_reset').hide();
            $('#orders_filter_reset').hide();;
            $('#review_filter').click(function() {
                var from_date = $('#review_from_date').val();
                var to_date = $('#review_to_date').val();
                if (from_date != '' && to_date != '') {
                    if (to_date < from_date) {
                        toastr.error("To date couldn't be greater then from date", "Error");
                        return false;
                    } else {
                        $('#review-table').DataTable().ajax.url(DT_ReviewURL +
                            `?review_from_date=${from_date}&review_to_date=${to_date}`).draw();
                    }
                    $('#review_from_date').removeClass('is-invalid');
                    $('#review_to_date').removeClass('is-invalid');
                    $('#review_filter_reset').show();
                } else {
                    $('#review_from_date').addClass('is-invalid')
                    $('#review_to_date').addClass('is-invalid')
                    toastr.error('Both dates are required', "Error");
                }
            });
            $('#review_filter_reset').click(function() {
                $('#review_from_date').val('');
                $('#review_to_date').val('');
                $('#review-table').DataTable().ajax.url(DT_ReviewURL).draw();
                //  allReviews(getReviewURL, franchiseId);
                $('#review_filter_reset').hide();
            });
            $('#orders_filter').click(function() {
                var from_date = $('#orders_from_date').val();
                var to_date = $('#orders_to_date').val();
                if (from_date != '' && to_date != '') {
                    if (to_date < from_date) {
                        toastr.error("To date couldn't be greater then from date", "Error");
                        return false;
                    } else {
                        $('#allordersTable').DataTable().ajax.url(DT_OrderURL +
                            `?order_from_date=${from_date}&order_to_date=${to_date}`).draw();
                    }
                    $('#orders_from_date').removeClass('is-invalid');
                    $('#orders_to_date').removeClass('is-invalid');
                    $('#orders_filter_reset').show();
                } else {
                    $('#orders_from_date').addClass('is-invalid')
                    $('#orders_to_date').addClass('is-invalid')
                    toastr.error('Both dates are required', "Error");
                }
            });
            $('#orders_filter_reset').click(function() {
                $('#orders_from_date').val('');
                $('#orders_to_date').val('');
                $('#allordersTable').DataTable().ajax.url(DT_OrderURL).draw();
                $('#orders_filter_reset').hide();
            });
        });
        $('#orderType').on('change', function() {
            var orderType = $('#orderType').val();
            $('#activeOrder').DataTable().ajax.url(DT_AciveOrderURL + `?orderType=${orderType}`).draw();
        });
        $(document).on("click", ".orderDetail", function() {
            $('#orderDetailTable').html('');
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
            $('#franchise_tax').html('');
            var dealProductsExtras = '';
            var order_id = $(this).data('order_id');
            $.ajax({
                url: "{{ route('admin.franchise.orders.detail') }}",
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
                    var dealProducts = '';
                    var dealProductExtras = '';
                    var dealProductModifiers = '';


                    $.each(data.order.order_deals, function(index, deal) {
                        dealList += `<li> ${deal.deal.title}</li>`
                    });

                    $.each(data.order.order_deal_product, function(index, dealProduct) {
                        // $.ajax({
                        //     url: "{{ route('admin.franchise.order.deal.extras') }}",
                        //     method: 'post',
                        //     data: {
                        //         order_deal_product_id: dealProduct.id,
                        //     },
                        //     success: function(extas_data) {
                        //             //dealProductsExtras += data.dealExtras.extra_id;
                        //             $.each(extas_data.dealExtras, function(my_index, extra) {
                        //                 dealProductsExtras +=  `<li> ${extra.price}</li>`;
                        //             });

                        //            // dealProducts += `<li>${dealProduct.id} -  ${dealProduct.product.name} <ul> <li> Extras <ul> ${dealProductsExtras}</ul> </li> </ul> </li>`;
                        //     }

                        // });

                        $.each(dealProduct.deal_extras, function(my_index, extra) {
                                        dealProductExtras += `<li> ${extra.extra.name} </li>`;
                        });
                        $.each(dealProduct.deal_modifiers, function(my_index, modifiers) {
                                     dealProductModifiers += `<li> ${modifiers.item.name} </li>`;
                        });
                        dealProducts += `<li>${dealProduct.product.name} </li>`;
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
                            url: "{{ route('admin.franchise.order.extras') }}",
                            method: 'get',
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
                            url: "{{ route('admin.franchise.orders.bogo.modifier') }}",
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
                            <td colspan="4" style="color:#000"> ${bogo_product.product.name} - ${bogo_product.product.price} ZAR X ${bogo_product.quantity}
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
                            <td colspan="5" style="color:#000"> ${bogo_product.free_product.name}
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
                    $('#dealList').html(dealList);
                    $('#dealProducts').html(dealProducts);
                    $('#dealProductExtra').html(dealProductExtras);
                    $('#dealProductModifiers').html(dealProductModifiers);
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
                    var taxVat =  parseInt(data.order.tax);
                    $('#tax').html(taxVat);
                    $('#order_note').html(data.order.note);
                    $('#paymentMethod').html(data.order.payment_method);
                    $('#promotion_ul').html(promotion_ul);
                    $('#discount').html(data.order.discount);
                    $('#totalAfterDiscount').html(data.order.sub_total - data.order.discount);
                    $('#delivery_charges').html(data.order.delivery_charges);
                    $('#grandTotal').html(data.order.grandTotal);
                    var franchise_Tax =  parseInt(data.order.franchise_tax);
                    $('#franchise_tax').html(franchise_Tax);
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
                },
            });
        });
        $('#review-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: DT_ReviewURL,
                data: {
                    franchiseId: franchiseId,
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'excel',
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return data.order.order_number;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return data.order.type;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return `<a href='{{ route('admin.users.edit') }}/${data.user.id}'> ${data.user.name} </a>`;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        var reviewStarts = '';
                        for (i = 1; i <= data.rating; i++) {
                            reviewStarts +=
                                ` <i class="flaticon-star text-warning" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Rating ${data.rating}" ></i>`;
                        }
                        return reviewStarts + `<span class='ratingNumber'>${data.rating}</span>`;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return ` <button class="btn btn-sm btn-icon btn-light-warning btn-square orderDetailReview"
                                    data-toggle="modal" data-target="#order_detail_for_review"
                                    data-order_id="${data.order.id}">
                                        <i class="icon-1x text-dark-5 flaticon-eye"></i>
                                </button>`;


                    },
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#allordersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: DT_OrderURL,
                data: {
                    franchiseId: franchiseId,
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'excel',
            ],
            columns: [

                {
                    data: function(data) {
                        return data.order_number;
                    },
                    name: 'order_number'
                },

                {
                    data: function(data) {
                        return data.type;
                    },
                    name: 'type'

                },

                {
                    data: function(data) {

                        return `<a href='{{ route('admin.users.edit') }}/${data.user.id}'> ${data.user.name} </a>`;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function(data) {
                        return (data.grandTotal);
                    },
                    name: 'grandTotal'
                },
                {
                    data: function(data) {
                        return data.status;
                    },
                    name: 'status'
                },

                {
                    data: 'time_ago',
                    name: 'time_ago',
                },
                {
                    data: function(data) {
                        return ` <button class="btn btn-sm btn-icon btn-light-warning btn-square orderDetail"
                                    data-toggle="modal" data-target="#order_detail"
                                    data-order_id="${data.id}" > &nbsp;
                                    <i class="icon-1x text-dark-5 flaticon-eye"></i>
                                </button>`;
                    },
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#activeOrder').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: DT_AciveOrderURL,
                data: {
                    franchiseId: franchiseId,
                }
            },
            columns: [

                {
                    data: function(data) {
                        return data.order_number;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function(data) {
                        return data.type;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function(data) {
                        return `<a href='{{ route('admin.users.edit') }}/${data.user.id}'> ${data.user.name} </a>`;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function(data) {
                        return (data.grandTotal);
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        if (data.payment_method == 'pay_gate') {
                            var method =
                                `<button class='btn btn-outline-primary btn-sm btn-square'> Pay Gate </button>`
                        } else {
                            var method =
                                `<button class='btn btn-outline-info btn-sm btn-square'> Cash </button>`
                        }
                        return method;
                    },
                    name: 'payment_method',
                },
                {
                    data: function(data) {

                        return data.status;

                    },
                    name: 'status'
                },
                {
                    data: 'time_ago',
                    name: 'time_ago',
                },

                {
                    data: function(data) {
                        return ` <button class="btn btn-sm btn-icon btn-light-warning btn-square orderDetail"
                                    data-toggle="modal" data-target="#order_detail"
                                    data-order_id="${data.id}">
                                        <i class="icon-1x text-dark-5 flaticon-eye"></i>
                                    </button>`;
                    },
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $("#editFranchiseForm").submit(function(e) {

            var lat = $('#loc_lat').val();
            var lng = $('#loc_long').val();
            if (lat == '' || lng == '') {
                toastr.error("Please use valid address", "Error");
                $("#addFranchise").attr("disabled", false);
                $('#franchise_address').addClass('border-danger');
                return false;
            }

            var fileUpload = document.getElementById("bannerPhoto");
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            if (size > 5000) {
                $('#kt_image_5').addClass('border-danger');
                toastr.error("File size must be less then 5 Mb", "Error");
                $("#UpdateFranchise").attr("disabled", false);
                event.preventDefault();

            } else {
                $("#UpdateFranchise").attr("disabled", true);
            }

        });
        $("#reviewExport").click(function() {
            $("#review-table_wrapper .buttons-excel ").click();
            return false;
        });
        $("#orderExport").click(function() {
            $("#allordersTable_wrapper .buttons-excel ").click();
            return false;
        });
        function getCurrentStatus(element) {
            var row = $(element).closest('tr');
            var currentStatus = $(row).find('.timings').val()
            if (currentStatus == 'close') {
                $(row).find('input[type=time]').prop('required', false);
                $(row).find('input[type=time]').val('');
                $(row).find('span').removeClass('text-danger');
                $(row).find('span').html('');
            } else {
                $(row).find('input[type=time]').prop('required', true);
                $(row).find('span').addClass('text-danger');
                $(row).find('span').html('*');
            }
        }
        $("#productsTable").on("click", ".setprice", function(e) {
            var product_id = $(this).data('id_product');
            var franchise_id = {!! $franchise->id !!};
            var franchise_id = $('#special_price_franchise_id').val(franchise_id);
            var product_id = $('#special_price_product_id').val(product_id);
        });
        //
        $("#addSpecialPrice").submit(function(e) {
            event.preventDefault();
            var special_price_franchise_id = $('#special_price_franchise_id').val();
            var special_price_product_id = $('#special_price_product_id').val();
            var specialPrice = $('#specialPrice').val();
            specialPriceUrl = "{{ route('admin.franchise.set.specialPrice') }}";

            $.ajax({
                url: specialPriceUrl,
                method: 'POST',
                data: {
                    product_id: special_price_product_id,
                    specialPrice: specialPrice,
                    franchise_id: special_price_franchise_id,
                },
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.message, "Success");
                        $('#set_special_price').modal('hide');
                        $("#productsTable").load(" #productsTable");

                    } else {
                        toastr.error(response.message, "Error");
                    }

                    console.log(response);
                },
            });
        });
        $(".updateSpecialPrice").click(function() {
            var product_id = $(this).data('product_id');
            var price = $('.current_price').val();
            updateSpecialPriceURL = "{{ route('admin.franchise.update.specialPrice') }}";
            $.ajax({
                url: updateSpecialPriceURL,
                method: 'POST',
                data: {
                    product_id: product_id,
                    price: price,
                },
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.message, "Success");
                        $('#set_special_price').modal('hide');
                        $("#productsTable").load(" #productsTable");

                    } else {
                        toastr.error(response.message, "Error");
                    }

                    console.log(response);
                },
            });
        });
        $("#productsTable").on("click", ".removePrice", function(e) {
            var product_id = $(this).data('id');
            removePrice = "{{ route('admin.franchise.product.removePrice') }}";
            Swal.fire({
                title: "Are you sure to delete ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: removePrice,
                        method: 'POST',
                        data: {
                            product_id: product_id,
                        },
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response.message, "Success");
                                $("#productsTable").load(" #productsTable");
                            } else {
                                toastr.error(response.message, "Error");
                            }
                            console.log(response);
                        }
                    });

                }
            });
        });
        $(document).ready(function () {
            $('#productsTable .productStatus').click(function() {
            var status = $(this).data('status');
            var product_id = $(this).data('product_id');
            var franchise_id = franchiseId;
            productStatusUrl = "{{ route('admin.franchise.product.status') }}";
            Swal.fire({
                title: "Are you sure to chnage status ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, change it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: productStatusUrl,
                        method: 'POST',
                        data: {
                            status: status,
                            product_id: product_id,
                            franchise_id: franchise_id,
                        },
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response.message, "Success");
                                setTimeout(function() {
                                    window.location.href = "{{ URL::current() }}";
                                 }, 1000);
                            } else {
                                toastr.error(response.message, "Error");
                            }

                        }
                    });
                }
            });
        });

        $('.franchise_time').timepicker({
            showMeridian: false
        });

        $(document).on("click", ".reviewDetails", function() {
            var orderid = $(this).data('orderid');
            var DT_URL = '{!! route('admin.franchise.review.detail') !!}';
            $.ajax({
                url: DT_URL,
                data: {
                    orderid: orderid,
                },
                success: function(data) {
                    var sum = 0;
                    var orderProducts = '';
                    $.each(data.orderProducts, function(index, key) {
                        var itemAlong = '';

                        $.each(key.items, function(index, item) {
                            itemTotal = item.price;
                            sum += parseInt(item.price);
                            itemAlong +=
                                `<a href='{{ route('admin.products.edit') }}/${item.product.id}' class='text-info'> ${item.product.name} | </a>`;
                        });
                        orderProducts +=
                            `<tr>
                                <td> ${key.product.name} <small>  </small> </td>
                                <td> ${key.quantity} </td>
                                <td> ${key.price}   </td>
                                <td> ${itemAlong}</td>
                            </tr>`;
                    });

                    var starts = '';
                    for (i = 1; i <= data.order.review.rating; i++) {
                        starts += "<i class='flaticon-star text-warning'></i>";
                    }

                    $('#review_order_number').html(data.order.order_number);
                    $('#review_order_status').html(data.order.status);
                    $('#review_order_type').html(data.order.type);
                    $('#review_customer').html(data.order.user.name);
                    $('#review_phone').html(data.order.user.phone);
                    $('#review_address').html(data.order.user.address);
                    $('#reviewOrderDetailTable').append(orderProducts);
                    $('#reviewOrderDetailTable').html(orderProducts);
                    $('#review_subTotal').html(data.order.total);
                    $('#review_extrasTotal').html(sum);
                    $('#review_total').html(data.order.total + sum);
                    $('#review_rating').html(starts);
                    $('#review_comments').html(data.order.review.comments);
                    $('#review_title').html(data.order.review.title);
                },


            });
        });


        $(document).on("click", ".orderDetailReview", function() {
            $('#R_orderDetailTable').html('');
            $('#R_order_number').html('');
            $('#R_order_Status').html('');
            $('#R_order_type').html('');
            $('#R_order_address').html('');
            $('#R_order_user').html('');
            $('#R_order_phonenumber').html('');
            $('#R_order_orderaddress').html('');
            $('#R_orderDetailTable').append('');
            $('#R_orderDetailTable').html('');
            $('#R_subTotal').html('');
            $('#R_extrasTotal').html('');
            $('#R_order_note').html('');
            $('#R_promotion_ul').html('');
            $('#R_paymentMethod').html('');
            $('#R_franchise_tax').html('');
            var dealProductsExtras = '';
            var order_id = $(this).data('order_id');
            $.ajax({
                url: "{{ route('admin.franchise.orders.detail') }}",
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
                    var dealProducts = '';
                    var dealProductExtras = '';
                    var dealProductModifiers = '';


                    $.each(data.order.order_deals, function(index, deal) {
                        dealList += `<li> ${deal.deal.title}</li>`
                    });

                    $.each(data.order.order_deal_product, function(index, dealProduct) {
                        // $.ajax({
                        //     url: "{{ route('admin.franchise.order.deal.extras') }}",
                        //     method: 'post',
                        //     data: {
                        //         order_deal_product_id: dealProduct.id,
                        //     },
                        //     success: function(extas_data) {
                        //             //dealProductsExtras += data.dealExtras.extra_id;
                        //             $.each(extas_data.dealExtras, function(my_index, extra) {
                        //                 dealProductsExtras +=  `<li> ${extra.price}</li>`;
                        //             });

                        //            // dealProducts += `<li>${dealProduct.id} -  ${dealProduct.product.name} <ul> <li> Extras <ul> ${dealProductsExtras}</ul> </li> </ul> </li>`;
                        //     }

                        // });

                        $.each(dealProduct.deal_extras, function(my_index, extra) {
                                        dealProductExtras += `<li> ${extra.extra.name} </li>`;
                        });
                        $.each(dealProduct.deal_modifiers, function(my_index, modifiers) {
                                     dealProductModifiers += `<li> ${modifiers.item.name} </li>`;
                        });
                        dealProducts += `<li>${dealProduct.product.name} </li>`;
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
                            url: "{{ route('admin.franchise.order.extras') }}",
                            method: 'get',
                            data: {
                                extra_id: product_id,
                            },
                            success: function(data) {
                                var productExtras = data.extra_products;
                                $.each(productExtras, function(index, itemExtras) {
                                    if (itemExtras.is_free == false) {
                                        extraItems += `<li>${itemExtras.extra.name} - ${itemExtras.extra.price} ZAR</li>`;
                                        $('#R_bogoPaidExtras').html(extraItems);
                                    } else if (itemExtras.is_free == true) {
                                        extraItemsFree += `<li> ${itemExtras.extra.name} - ${itemExtras.extra.price} ZAR </li>`;
                                        $('#R_bogoFreeExtras').html(`<ul>` +
                                            extraItemsFree + `</ul>`);
                                    }
                                });
                            }
                        });
                        // Query for Bogo Modifers
                        $.ajax({
                            url: "{{ route('admin.franchise.orders.bogo.modifier') }}",
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

                                $('#R_bogoPaidModifiersWithItems').html(bogoPaidModifiersWithItems);
                                $('#R_bogoFreeModifiersWithItems').html(bogoFreeModifiersWithItems);

                            }
                        });
                        mybogoProduct += ` <tr>
                            <td colspan="4" style="color:#000"> ${bogo_product.product.name} - ${bogo_product.product.price} ZAR X ${bogo_product.quantity}
                                <ul>
                                    <li>
                                        Extras
                                        <ul id="R_bogoPaidExtras"></ul>
                                    </li>
                                    <li>
                                        Modifiers
                                        <ul id="R_bogoPaidModifiersWithItems" style="width:100%"></ul>
                                    </li>
                                </ul>
                            </td>
                            <td colspan="5" style="color:#000"> ${bogo_product.free_product.name}
                                <ul>
                                    <li>
                                        Extras
                                        <ul id="R_bogoFreeExtras"></ul>
                                    </li>
                                    <li>
                                        Modifiers
                                        <ul id="R_bogoFreeModifiersWithItems" style="width:100%"></ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>`;
                    });
                    var starts = '';
                    for (i = 1; i <= data.order.review.rating; i++) {
                        starts += "<i class='flaticon-star text-warning'></i>";
                    }
                    $('#R_dealList').html(dealList);
                    $('#R_dealProducts').html(dealProducts);
                    $('#R_dealProductExtra').html(dealProductExtras);
                    $('#R_dealProductModifiers').html(dealProductModifiers);
                    $('#R_bogoProduct').html(mybogoProduct);
                    $('#R_extraList').html(extraList);
                    $('#R_modifierList').html(modifierList);
                    $('#R_order_number').html(data.order.order_number);
                    $('#R_order_Status').html(data.order.status);
                    $('#R_order_type').html(data.order.type);
                    $('#R_order_user').html(data.order.user.name);
                    $('#R_order_phonenumber').html(data.order.user.phone);
                    $('#R_order_orderaddress').html(data.order.user.address);
                    $('#R_orderDetailTable').append(orderProducts);
                    $('#R_orderDetailTable').html(orderProducts);
                    $('#R_subTotal').html(data.order.sub_total);
                    $('#R_extrasTotal').html(data.order.items_extra);
                    $('#R_extras').html(data.order.extras);
                    $('#R_tax').html(data.order.tax);
                    $('#R_order_note').html(data.order.note);
                    $('#R_paymentMethod').html(data.order.payment_method);
                    $('#R_promotion_ul').html(promotion_ul);
                    $('#R_discount').html(data.order.discount);
                    $('#R_totalAfterDiscount').html(data.order.sub_total - data.order.discount);
                    $('#R_delivery_charges').html(data.order.delivery_charges);
                    $('#R_grandTotal').html(data.order.grandTotal);
                    $('#R_franchise_tax').html(data.order.franchise_tax);
                    $('#R_comments').html(data.order.review.comments);
                    $('#R_starts').html(starts);
                    if (data.order.address != null) {
                        const orderAddress = JSON.parse(data.order.address);
                        $('#R_order_address').html(orderAddress.address);
                        $('#R_building').html(orderAddress.building_name);
                        $('#R_appartment').html(orderAddress.appartment_floor_number);
                    } else {
                        $('#R_order_address').html('');
                        $('#R_building').html('');
                        $('#R_appartment').html('');
                    }
                },
            });
        });






        });



        google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var input = document.getElementById('franchise_address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#loc_lat').val(place.geometry['location'].lat());
                $('#loc_long').val(place.geometry['location'].lng());

            });
        }


    </script>
@endsection
