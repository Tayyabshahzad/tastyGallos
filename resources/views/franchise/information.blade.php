@extends('layouts.master')
@section('title', 'Information')
@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"type="text/css" />
    <link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"   src="https://maps.google.com/maps/api/js?key=AIzaSyBK-wq4OsIg-Kftqkahw2-7y1yBSdfc9aM&libraries=places" ></script>
@endsection
@section('content')
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-12">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('franchise.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Information</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('franchise.information.update') }}" method="post" enctype="multipart/form-data" id="editFranchiseForm">
                    @csrf
                    <input type="hidden" name="edit_id" value="{{ $franchise->id }}">
                    <input type="hidden" name="user_id" value="{{ $franchise->user->id }}">
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
                                                @foreach ($franchise->workingHours as $hours)
                                                    <input type="hidden" value="{{ $hours->id }}" name="workingHourId[]">
                                                    <tr style="border-bottom: 1px dotted #ccc;">
                                                        <td style="padding-right:0!important;padding-left:2px!important">
                                                            {{ ucfirst($hours->code) }}: <span
                                                                class="text-danger"></span>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $hours->day }}" name="day[]">
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $hours->code }}" name="code[]">
                                                            <input type="text" class="form-control openTime franchise_time" style="width: 100px"
                                                                name="opening_time[]" value="{{ $hours->opening_time }}">
                                                        </td>
                                                        <td> <input type="text" class="form-control closeTime franchise_time"style="width: 100px"
                                                                name="closing_time[]" value="{{ $hours->closing_time }}">
                                                        </td>
                                                        <td> <select class="form-control timeStatus" name="time_status[]" style="width: 100px">
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
                                                <tr>
                                                    <td colspan="4">
                                                        <b> Upload Banner (750x1000 px) <span  class="text-danger">*</span>
                                                        </b>
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
                                                                    accept=".png, .jpg, .jpeg">
                                                                <input type="hidden" name="profile_avatar_remove" value="0">
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
                                                    <label for=""> Name <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        name="franchise_name" required value="{{ $franchise->name }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Phone <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" name="franchise_phone"
                                                        id="" required
                                                        value="{{ $franchise->contact_phone }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> VAT <span class="text-danger">*</span> </label>
                                                    <input type="number" class="form-control" placeholder="VAT Number"
                                                        name="franchise_vat" required value="{{ $franchise->vat }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Contact Email <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" class="form-control" placeholder="Contact Email "
                                                        name="contact_email" required
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
                                                    <label for=""> Address s</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Address: Google Address" name="franchise_address"
                                                        id="franchise_address" value="{{ $franchise->address }}" />
                                                    <input type="hidden" id="loc_lat" value="{{ $franchise->lat }}"
                                                        name="lat">
                                                    <input type="hidden" id="loc_long" value="{{ $franchise->lng }}"
                                                        name="lng">
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
                                                    value="{{ $franchise->delivery_charge }}" name="delivery_charge"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="deliver_type_pickup" value="no" />
                                                <input type="hidden" name="deliver_type_delivery" value="no" />
                                                <div class="col-9 col-form-label">
                                                    <label for=""> Select Delivery Type <span
                                                            class="text-danger">*</span>
                                                    </label>
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
                                            <label for=""> About Franchise </label>
                                            <textarea class="form-control" placeholder="About ..." name="about_franchise"
                                                required>{{ $franchise->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 m-3">
                                            <b> Delivery Time Estimate </b>
                                            <br>
                                            <input type="text" class="form-control" required name="estimated_time" value="{{ $franchise->estimated_time }}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label> Busy Time </label>
                                            <select id="" class="form-control" name="busy_time" required>
                                                <option value="15" @if ($franchise->busy_time == '15') selected @endif> 15
                                                    Mins </option>
                                                <option value="30" @if ($franchise->busy_time == '30') selected @endif> 30
                                                    Mins </option>
                                                <option value="45" @if ($franchise->busy_time == '45') selected @endif> 45
                                                    Mins </option>
                                                <option value="60" @if ($franchise->busy_time == '60') selected @endif> 60
                                                    Mins </option>
                                                <option value="75" @if ($franchise->busy_time == '75') selected @endif> 75
                                                    Mins </option>
                                                <option value="90" @if ($franchise->busy_time == '90') selected @endif> 90
                                                    Mins </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label> Free Time </label>
                                            <select id="" class="form-control" name="free_time" required>
                                                <option value="15" @if ($franchise->free_time == '15') selected @endif> 15
                                                    Mins </option>
                                                <option value="30" @if ($franchise->free_time == '30') selected @endif> 30
                                                    Mins </option>
                                                <option value="45" @if ($franchise->free_time == '45') selected @endif> 45
                                                    Mins </option>
                                                <option value="60" @if ($franchise->free_time == '60') selected @endif> 60
                                                    Mins </option>
                                                <option value="75" @if ($franchise->free_time == '75') selected @endif> 75
                                                    Mins </option>
                                                <option value="90" @if ($franchise->free_time == '90') selected @endif> 90
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
                                        <h3 class="card-label">Franchise Admin:</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="tab-content row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Admin Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="admin_name" required
                                                        value="{{ $franchise->user->name }}" />
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Admin Email <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" disabled
                                                        value="{{ $franchise->user->email }}" />
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
                                            <input type="text" class="form-control" name="bank"   value="{{ $franchise->bank }}"  required placeholder="Bank name"/>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label> Account Holder </label>
                                            <input type="text" class="form-control"  name="account_holder"   value="{{ $franchise->account_holder }}" placeholder="Account Holder Name" required/>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label> Branch Code </label>
                                            <input type="text" class="form-control" name="branch" value="{{ $franchise->branch }}" required placeholder="Branch Code" />
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label> Account Number </label>
                                            <input type="text" class="form-control"  name="account_number" value="{{ $franchise->account_number }}" required placeholder="Enter account number" />
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <button type="submit" class="btn btn-danger btn-square" id="UpdateFranchise">
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
        </div>
    </div>
@endsection
@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK-wq4OsIg-Kftqkahw2-7y1yBSdfc9aM&libraries=places"></script>
    <script>
        var avatar5 = new KTImageInput('kt_image_5');

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
        $("#kt_inputmask_3").inputmask("mask", {
            "mask": "(+99) 999-999999999"
        });
        $("#editFranchiseForm").submit(function(e) {
            if ($(".deliveryBox").prop('checked') || $(".pickupBox").prop('checked')) {
                $("#UpdateFranchise").attr("disabled", true);
            } else {
                $(".pickupContainer").css('border-color', 'red');
                $(".deliveryContainer").css('border-color', 'red');
                toastr.error('Delivery type must be selected', "Error");
                e.preventDefault();
                return false;
            }
        });
        $(document).ready(function() {
            $('.timeStatus').change(function() {
                var status = $('.timeStatus').val();
                if (status == 'close') {
                    $(this).closest('tr').find('input[type=time]').prop('required', false);
                    $(this).closest('tr').find('input[type=time]').val('');
                    $(this).closest('tr').find('span').removeClass('text-danger');
                    $(this).closest('tr').find('span').html('');
                } else {
                    $(this).closest('tr').find('input[type=time]').prop('required', true);
                    $(this).closest('tr').find('span').addClass('text-danger');
                    $(this).closest('tr').find('span').html('*');
                }
            });
        });

        $('.franchise_time').timepicker({
            showMeridian: false
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
