@extends('layouts.master')
@section('title', 'Franchise Settings')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="row mb-6">
                    <div class="col-lg-12">
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                            <li class="breadcrumb-item">
                                <a href="{{ route('franchise.dashboard') }}"><i class="fa fa-home"></i></a>
                            </li>

                            <li class="breadcrumb-item">
                                Settings
                            </li>
                        </ul>
                    </div>
                </div>
                <form   method="post" enctype="multipart/form-data" id="updateSettingForm">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Account Settings</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 text-left mb-4">
                                                    <div class="image-input image-input-outline mt-2" id="kt_image_5">
                                                        <div class="image-input-wrapper"
                                                    style="background-image: url(@if ($user->getFirstMediaUrl('profile_photo', 'thumb') != '') {{ $user->getFirstMediaUrl('profile_photo', 'thumb') }}
                                                    @else
                                                    {{ asset('design/assets/media/placeholder.png') }}


                                                    @endif);width: 250px; height: 167px; max-width: 100%;">
                                                    </div>
                                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Upload Banner">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="profile_photo" accept=".png, .jpg, .jpeg">
                                                            <input type="hidden" name="profile_avatar_remove" value="0">
                                                        </label>
                                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Remove Banner">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="form-group col-lg-12">
                                                            <label for=""> Name </label>
                                                            <input type="text" class="form-control" placeholder="Name"  value="{{ $user->name }}" name="user_name" required id="name">
                                                        </div>

                                                        <div class="form-group col-lg-12">
                                                            <label for=""> Email </label>
                                                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="form-group col-lg-12">
                                                            <label for=""> Password </label>
                                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                                        </div>
                                                        <div class="form-group col-lg-12">
                                                            <label for=""> Re-enter Password </label>
                                                            <input type="password" class="form-control"  placeholder="Re-enter password" name="password_confirmation" id="confirm_password">
                                                        </div>
                                                        <div class="col-lg-12 text-danger" id="passwordError"   style="display: none" >
                                                            <small> Password & confirm password not matched </small>
                                                        </div>

                                                        <div class="col-lg-12 text-danger" id="nameError"   style="display: none" >
                                                            <small> Name field is required </small>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="card-footer text-right">
                                                    <a  href="{{ route('franchise.dashboard') }}" class="btn btn-warning btn-square" > Cancel</a>
                                                    <button type="submit" class="btn btn-danger btn-square" > Update</button>
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


    <script>
        var avatar5 = new KTImageInput('kt_image_5');
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#passwordError').css('display:none');
        $('.session_messages').delay(1000).fadeOut('slow');
        var avatar5 = new KTImageInput('userimage');
        var avatar4 = new KTImageInput('kt_image_4');

        $(document).on("change", "#photoChnage", function(event) {
            var filesize = this.files[0].size;
            var allowSize = 10 * 1024 * 1024;
            if (filesize > allowSize) {
                event.preventDefault()
                $('#submitBtn').prop('disabled', true);
                $('#file').css('border', "1px solid red");
                $('#file').css('color', "red");
                $('#fileSizeError').css('display', "block");
            } else {
                $('#file').css('border', "0px solid blue");
                $('#file').css('color', "#000");
                $('#fileSizeError').css('display', "none");
                $('#submitBtn').prop('disabled', false);
            }

        });
        $(document).ready(function() {
            $("input").focus(function() {
                $('#submitBtn').prop('disabled', false);
            });
        });

        $("#updateSettingForm").submit(function(e){
            e.preventDefault();
            var password = $("#password").val();
            var name = $("#name").val();
            var password_confirmation   = $("#confirm_password").val();


        if(name ==''){
            $("#name").addClass('is-invalid');
            $('#nameError').css('display','block');
            e.preventDefault();
            return false;
        }

        if(password != password_confirmation){
            $("#password").addClass('is-invalid');
            $("#confirm_password").addClass('is-invalid');
            $('#passwordError').css('display','block');
            e.preventDefault();
            return false;
        }


        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: '{{ route('franchise.profile.update') }}',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.success == true) {
                    $("#updateSettingForm input[id='password']").val('');
                    $("#updateSettingForm input[id='confirm_password']").val('');
                    $("#name").removeClass('is-invalid');
                    $("#password").removeClass('is-invalid');
                    $("#confirm_password").removeClass('is-invalid');
                    $("#nameError").css('display','none');
                    $('#passwordError').css('display','none');
                    toastr.success(response.message, "Success");
                } else {
                    toastr.error(response.message, "Error");
                }
            },
        });

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


@endsection
