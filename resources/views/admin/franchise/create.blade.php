@extends('layouts.master')
@section('title', 'Franchise Create')
@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"   type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <style>
        .border-danger{
            border:1px solid rgb(240, 104, 104);
        }
        .radio>input:checked~span{
            background: #f64e60;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"   src="https://maps.google.com/maps/api/js?key=AIzaSyBK-wq4OsIg-Kftqkahw2-7y1yBSdfc9aM&libraries=places" ></script>
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
                                <a href="{{ route('admin.franchises') }}"> Franchise </a>
                            </li>
                            <li class="breadcrumb-item">
                                Create
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form autocomplete="off" id="addFranchiseForm" method="post" action="{{ route('admin.franchises.save') }}" enctype="multipart/form-data">
                    @csrf
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
                                                        <b>   Banner   <span class="text-danger">*</span> </b> <br>
                                                        <div class="image-input image-input-outline mt-2" id="kt_banner" >
                                                            <div class="image-input-wrapper" style="background-image: url( {{ asset('design/assets/media/placeholder.png') }} ); width: 250px; height: 167px; max-width: 100%;"></div>
                                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Upload Banner">
                                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                                <input type="file" accept=".png, .jpg, .jpeg" name="franchise_banner" id="bannerPhoto"  >
                                                                <input type="hidden" name="profile_avatar_remove" value="0">
                                                            </label>
                                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Remove Banner">
                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                            </span>
                                                        </div>


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <b>   Trading Hours   <span class="text-danger">*</span> </b> <br>
                                                    </td>
                                                </tr>

                                                <tr style="border-bottom: 1px dotted #ccc;">
                                                    <td style="width:70px;">Mon <span class="text-danger">*</span> </td>
                                                    <td>
                                                        <input type="hidden" class="form-control" value="monday"
                                                            name="day[]">
                                                        <input type="hidden" class="form-control" value="mon"
                                                            name="code[]">

                                                        <input type="text" class="form-control openTime franchise_time"
                                                            name="opening_time[]" required style="width:100px;" value="{{ old('opening_time.0')}}">
                                                    </td>
                                                    <td> <input type="text" class="form-control closeTime franchise_time" value="{{ old('closing_time.0')}}"
                                                            name="closing_time[]" required style="width:100px;">
                                                    </td>
                                                    <td> <select class="form-control timings" onchange="getCurrentStatus(this)" name="time_status[]"
                                                            required style="width:100px;">
                                                            <option value="open"> Open </option>
                                                            <option value="close"> Close </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr style="border-bottom: 1px dotted #ccc;">
                                                    <td class="font-weight-bold">Tue <span
                                                            class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="hidden" class="form-control" value="tuesday"
                                                            name="day[]">
                                                        <input type="hidden" class="form-control" value="tue"
                                                            name="code[]">
                                                        <input type="text" class="form-control franchise_time" name="opening_time[]"  value="{{ old('opening_time.1')}}"
                                                            required>
                                                    </td>
                                                    <td> <input type="text" class="form-control franchise_time" name="closing_time[]" value="{{ old('closing_time.1')}}"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <select class="form-control timings" onchange="getCurrentStatus(this)" name="time_status[]"
                                                            required>
                                                            <option value="open"> Open </option>
                                                            <option value="close"> Close </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr style="border-bottom: 1px dotted #ccc;">
                                                    <td class="font-weight-bold">Wed <span
                                                            class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="hidden" class="form-control" value="wednesday"
                                                            name="day[]">
                                                        <input type="hidden" class="form-control" value="wed"
                                                            name="code[]">
                                                        <input type="text" class="form-control franchise_time" name="opening_time[]"  value="{{ old('opening_time.2')}}"
                                                            required>
                                                    </td>
                                                    <td> <input type="text" class="form-control franchise_time" name="closing_time[]" value="{{ old('closing_time.2')}}"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <select class="form-control timings" onchange="getCurrentStatus(this)" name="time_status[]"
                                                            required>
                                                            <option value="open"> Open </option>
                                                            <option value="close"> Close </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr style="border-bottom: 1px dotted #ccc;">
                                                    <td class="font-weight-bold">Thu <span
                                                            class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="hidden" class="form-control" value="thursday"
                                                            name="day[]">
                                                        <input type="hidden" class="form-control" value="thu"
                                                            name="code[]">
                                                        <input type="text" class="form-control franchise_time" name="opening_time[]"  value="{{ old('opening_time.3')}}"
                                                            required>
                                                    </td>
                                                    <td> <input type="text" class="form-control franchise_time" name="closing_time[]" value="{{ old('closing_time.3')}}"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <select class="form-control timings" onchange="getCurrentStatus(this)" name="time_status[]"
                                                            required>
                                                            <option value="open"> Open </option>
                                                            <option value="close"> Close </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr style="border-bottom: 1px dotted #ccc;">
                                                    <td class="font-weight-bold">Fri <span
                                                            class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="hidden" class="form-control" value="friday"
                                                            name="day[]">
                                                        <input type="hidden" class="form-control" value="fri"
                                                            name="code[]">
                                                        <input type="text" class="form-control franchise_time" name="opening_time[]"  value="{{ old('opening_time.4')}}"
                                                            required>
                                                    </td>
                                                    <td> <input type="text" class="form-control franchise_time" name="closing_time[]" value="{{ old('closing_time.4')}}"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <select class="form-control timings" onchange="getCurrentStatus(this)" name="time_status[]"
                                                            required>
                                                            <option value="open"> Open </option>
                                                            <option value="close"> Close </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr style="border-bottom: 1px dotted #ccc;">
                                                    <td class="font-weight-bold">Sat <span
                                                            class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="hidden" class="form-control" value="saturday"
                                                            name="day[]">
                                                        <input type="hidden" class="form-control" value="sat"
                                                            name="code[]">
                                                        <input type="text" class="form-control franchise_time" name="opening_time[]"  value="{{ old('opening_time.4')}}"
                                                            required>
                                                    </td>
                                                    <td> <input type="text" class="form-control franchise_time" name="closing_time[]" value="{{ old('closing_time.5')}}"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <select class="form-control timings" onchange="getCurrentStatus(this)" name="time_status[]"
                                                            required>
                                                            <option value="open"> Open </option>
                                                            <option value="close"> Close </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr style="border-bottom: 1px dotted #ccc;">
                                                    <td class="font-weight-bold">Sun<span
                                                            class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="hidden" class="form-control" value="sunday"
                                                            name="day[]">
                                                        <input type="hidden" class="form-control" value="sun"
                                                            name="code[]">
                                                        <input type="text" class="form-control franchise_time" name="opening_time[]"  value="{{ old('opening_time.6')}}"
                                                            required>
                                                    </td>
                                                    <td> <input type="text" class="form-control franchise_time" name="closing_time[]" value="{{ old('closing_time.6')}}"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <select class="form-control timings" onchange="getCurrentStatus(this)" name="time_status[]"
                                                            required>
                                                            <option value="open"> Open </option>
                                                            <option value="close"> Close </option>
                                                        </select>
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
                                        <h3 class="card-label">Franchise Details</h3>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Name <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" placeholder="Enter franchise name"
                                                           name="franchise_name" required value="{{ old('franchise_name') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Phone <span class="text-danger">*</span> </label>
                                                    <input type="text"
                                                     class="form-control"
                                                     placeholder="Enter phone number"
                                                     name="franchise_phone"
                                                     id="" required
                                                     value="{{ old('franchise_phone') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> VAT Number <span class="text-danger">*</span> </label>
                                                    <input type="number" class="form-control" placeholder="VAT Number"
                                                        name="franchise_vat" required value="{{ old('franchise_vat') }}"   />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Contact Email <span class="text-danger">*</span> </label>
                                                    <input type="email" class="form-control" placeholder="Contact email "
                                                        name="contact_email" required value="{{ old('contact_email') }}" />
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
                                                    <label for=""> Address  <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Address: Google address "
                                                        name="franchise_address"
                                                        id="franchise_address"
                                                        value="{{ old('franchise_address') }}" required/>
                                                        <input type="hidden" id="loc_lat" name="lat" required>
                                                        <input type="hidden" id="loc_long" name="lng" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            Standard Delivery <br />Charge <span class="text-danger"> * </span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ZAR</span>
                                                </div>
                                                <input type="number" class="form-control" required
                                                    value="{{ old('delivery_charge') }}" name="delivery_charge"   id="deliveryCharge">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-9 col-form-label">
                                                    <label for=""> Select Delivery Type <span class="text-danger">*</span></label>
                                                    <input type="hidden" name="deliver_type_pickup" value="no" />
                                                    <input type="hidden" name="deliver_type_delivery" value="no" />
                                                    <div class="checkbox-inline mt-2">
                                                        <label class="checkbox checkbox-danger checkboxFileds">
                                                            <input type="checkbox" name="pickup" value="yes"  class="pickup_field" checked />
                                                            <span></span>
                                                            Pickup
                                                        </label>
                                                        <label class="checkbox checkbox-danger checkboxFileds">
                                                            <input type="checkbox" name="delivery" value="yes" class="delivery_field" />
                                                            <span></span>
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
                                                        <input type="radio" name="payment_method" value="paygate" required>
                                                        <span></span>Pay Gate</label>
                                                        <label class="radio">
                                                        <input type="radio" name="payment_method" value="cash">
                                                        <span></span>Cash</label>
                                                        <label class="radio">
                                                        <input type="radio" name="payment_method" value="both" checked="checked">
                                                        <span></span>Both</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for=""> About Franchise  </label>
                                            <textarea class="form-control" placeholder="About ..." name="about_franchise" >{{ old('about_franchise') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12  mb-2">
                                            <b>   Delivery Time Estimate <span class="text-danger">*</span> </b>
                                            <br>
                                            <input type="number" name="estimated_time" id="" required class="form-control" placeholder="Estimated Time" value="{{ old('estimated_time') }}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label> Busy Time </label>
                                            <select id="" class="form-control" name="busy_time" required>
                                                <option value="15"> 15 Mins </option>
                                                <option value="30"> 30 Mins </option>
                                                <option value="45"> 45 Mins </option>
                                                <option value="60"> 60 Mins </option>
                                                <option value="75"> 75 Mins </option>
                                                <option value="90"> 90 Mins </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label> Free Time </label>
                                            <select id="" class="form-control" name="free_time" required>
                                                <option value="15"> 15 Mins </option>
                                                <option value="30"> 30 Mins </option>
                                                <option value="45"> 45 Mins </option>
                                                <option value="60"> 60 Mins </option>
                                                <option value="75"> 75 Mins </option>
                                                <option value="90"> 90 Mins </option>
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
                                                    <label for=""> Admin Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Admin name"
                                                        name="admin_name" required value="{{ old('admin_name') }}" />
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Username <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Username"
                                                        name="username" required value="{{ old('username') }}" />
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Admin Email <span class="text-danger">*</span> </label>
                                                    <input type="email" class="form-control" placeholder="Admin email"
                                                        name="admin_email" required value="{{ old('admin_email') }}" />
                                                </div>
                                                <div class="form-group col-lg-12">

                                                    <button type="submit" class="btn btn-danger btn-square"
                                                        id="addFranchise"> Add Franchise </button>
                                                </div>
                                            </div>
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
    <script src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
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

    <script src="{{ asset('design/assets/js/pages/crud/file-upload/image-input.js') }}"></script>
    <script>
         $("#kt_inputmask_3").inputmask("mask", {
            "mask": "(+99) 999-999999"
        });
        var avatar5 = new KTImageInput('kt_banner');
        var config = {
            routes: {
                addFranchise: "{{ route('admin.franchises.save') }}"
            }
        };

    </script>
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK-wq4OsIg-Kftqkahw2-7y1yBSdfc9aM&libraries=places"></script> --}}
    <script>
        // function initialize() {
        //     var input = document.getElementById('franchise_address');
        //     var autocomplete = new google.maps.places.Autocomplete(input);
        //     //var lat = new google.maps.places.Autocomplete(input).location.lat();
        //     autocomplete = new google.maps.places.Autocomplete(input), {
        //         types: ['geocode'],
        //     });


        // }
        // google.maps.event.addDomListener(window, 'load', initialize);




// $(document).ready(function () {
//     var autocomplete;
//     autocomplete = new google.maps.places.Autocomplete((document.getElementById('franchise_address')), {
//         types: ['geocode'],
//     });

//     google.maps.event.addListener(autocomplete, 'place_changed', function () {
//         var near_place = autocomplete.getPlace();
//         document.getElementById('loc_lat').value = near_place.geometry.location.lat();
//         document.getElementById('loc_long').value = near_place.geometry.location.lng();

//     });
// });




    </script>

    <script>



        $('.franchise_time').timepicker({
            showMeridian: false
        });


        $("#addFranchiseForm").submit(function (e) {
            var lat = $('#loc_lat').val();
            var lng = $('#loc_long').val();

            if ($('.pickup_field').is(':not(:checked)') && $('.delivery_field').is(':not(:checked)')){
                $('.checkboxFileds').addClass('text-danger');
                toastr.error("Must select pick up or delivery field", "Error");
                return false;
            }
            if(lat == ''|| lng == '' ){
                toastr.error("Please use valid address", "Error");
                $("#addFranchise").attr("disabled", false);
                $('#franchise_address').addClass('border-danger');
                return false;
            }
            if( document.getElementById("bannerPhoto").files.length == 0 ){
                event.preventDefault();
                $('#kt_banner').addClass('border-danger');
                toastr.error("Please Upload Franchise Banner", "Error");
                console.log("no files selected");
            }else{
                var fileUpload = document.getElementById("bannerPhoto");
                var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                if(size>5000){
                    $('#kt_banner').addClass('border-danger');
                    toastr.error("File size must be less then 5 Mb", "Error");
                    $("#addFranchise").attr("disabled", false);
                    event.preventDefault();

                }else{
                    $("#addFranchise").attr("disabled", true);
                }
            }
        });


        // $(document).ready(function() {
        //     $('.timeStatus').change(function(){

        //       var status = this.value

        //         if(status == 'close'){
        //             $(this).closest('tr').find('input[type=time]').prop('required',false);
        //             $(this).closest('tr').find('input[type=time]').val('');
        //             $(this).closest('tr').find('span').removeClass('text-danger');
        //             $(this).closest('tr').find('span').html('');
        //         }else{
        //             $(this).closest('tr').find('input[type=time]').prop('required',true);
        //             $(this).closest('tr').find('span').addClass('text-danger');
        //             $(this).closest('tr').find('span').html('*');
        //         }

        //     });

        // });


        function getCurrentStatus(element){
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

    </script>


    <script>
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
