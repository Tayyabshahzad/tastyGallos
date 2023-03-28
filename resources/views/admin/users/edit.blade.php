@extends('layouts.master')
@section('title', 'Edit User')
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
                                <a href="{{ route('admin.users') }}"> Users </a>
                            </li>

                            <li class="breadcrumb-item">
                                Edit
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="updateSettingForm">
                    <div class="row">
                        <input type="hidden" name="userId" id="userId" value="{{ $user->id }}">
                        <div class="col-lg-4">
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">User Information</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 text-center mb-4">
                                            <div class="image-input image-input-outline mt-2" id="kt_image_5">
                                                @if ($user->getFirstMediaUrl('profile_photo', 'thumb') != '')
                                                    @php $path = $user->getFirstMediaUrl('profile_photo', 'thumb') @endphp
                                                @else
                                                    @php $path = 'https://wtwp.com/wp-content/uploads/2015/06/placeholder-image.png' @endphp
                                                @endif


                                                <div class="image-input-wrapper"
                                                    style="background-image: url('{{ $path }}'); width: 250px; height: 167px; max-width: 100%;">
                                                </div>
                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Upload Banner">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="profile_photo" accept=".png, .jpg, .jpeg"
                                                        id="photoChnage">
                                                    <input type="hidden" name="profile_avatar_remove" value="0">
                                                </label>
                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title=""
                                                    data-original-title="Remove Banner">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <br>
                                            <small class="text-danger" id="fileSizeError"> Please select image less then
                                                5 MB</small>
                                        </div>
                                        <div class="col-lg-12" style="padding: 0 30px" id="details">
                                            <div class="py-9">
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <span class="font-weight-bold mr-2">First Name:</span>
                                                    <a href="#" class="text-muted text-hover-primary"> {{ $user->name }}
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <span class="font-weight-bold mr-2">Last Name:</span>
                                                    <a href="#" class="text-muted text-hover-primary">
                                                        {{ $user->last_name }} </a>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <span class="font-weight-bold mr-2">Email:</span>
                                                    <a href="#" class="text-muted text-hover-primary"> {{ $user->email }}
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <span class="font-weight-bold mr-2">Phone:</span>
                                                    <span class="text-muted"> {{ $user->phone }} </span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <span class="font-weight-bold mr-2">Role:</span>
                                                    <span class="text-muted">
                                                        {{ ucfirst($user->roles->pluck('name')->implode(',')) }} </span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">Profile Settings</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="card-toolbar">
                                            <input type="hidden" name="status" class="status" value="inactive">
                                            <span class="switch switch-danger switch-icon switch-sm">
                                                <span class="font-weight-bold">Status</span> <label class="ml-2">
                                                    <input type="checkbox" value="active"
                                                        @if ($user->status == 'active') checked="checked" @endif
                                                        name="status" class="status">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="flex-row-fluid ml-lg-8">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3">First Name</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text"
                                                            value="{{ $user->name }}" id="name" name="name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3">Last Name</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text"
                                                            value="{{ $user->last_name }}" id="last_name"
                                                            name="last_name" placeholder="Enter your last name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3">Email Address</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="email" disabled
                                                            value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3  ">Phone</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <input class="form-control" type="number"
                                                                value="{{ $user->phone }}" id="phone" name="phone"
                                                                placeholder="Enter contact number">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3  ">Password</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <input class="form-control" type="password" id="password"
                                                                name="password" placeholder="Enter your password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3  ">Confirm Password</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <input class="form-control" type="password"
                                                                id="password-confirm" name="password-confirm"
                                                                placeholder="Re enter password">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-danger btn-square" id="updateUser">
                                            Update</button>
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
        $('#fileSizeError').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(e) {
            $('#updateSettingForm').on('submit', (function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var password = formData.get('password');
                var passwordConfirm = formData.get('password-confirm');
                if (password != passwordConfirm) {
                    $('#password').addClass('is-invalid');
                    $('#password-confirm').addClass('is-invalid');
                    toastr.error('Password & confirm password must match', "Error");
                    e.preventDefault();
                    return false
                }
                if (password != '') {
                    if (password.length < 5) {
                        $('#password').addClass('is-invalid');
                        $('#password-confirm').addClass('is-invalid');
                        toastr.error('Please enter at least 5 character as password', "Error");
                        return false
                    }
                }


                var url = '{{ route('admin.user.update') }}';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        toastr.success(response.message, "Success");
                        $("#details").load(" #details");
                        $('#password').removeClass('is-invalid');
                        $('#password-confirm').removeClass('is-invalid');

                    },
                    error: function(data) {
                        toastr.error(response.message, "Error");

                    }
                });
            }));

            $("#ImageBrowse").on("change", function() {
                $("#imageUploadForm").submit();
            });
        });
        var avatar5 = new KTImageInput('userimage');
        var avatar4 = new KTImageInput('kt_image_4');

        $(document).on("change", "#photoChnage", function(event) {
            var filesize = this.files[0].size;
            var allowSize = 10 * 1024 * 1024;
            if (filesize > allowSize) {
                event.preventDefault()
                $('#file').css('border', "1px solid red");
                $('#file').css('color', "red");
                $('#fileSizeError').show();
            } else {
                $('#file').css('border', "0px solid blue");
                $('#file').css('color', "#000");
                $('#fileSizeError').hide();
            }

        });
        // $("#updateUser").click(function(e) {

        //     var password = $("#password").val();
        //     var name = $("#name").val();
        //     var last_name = $("#last_name").val();
        //     var phone = $("#phone").val();
        //     var address = $("#address").val();
        //     var userId = $("#userId").val();
        //     if (name == '') {
        //         $("#name").addClass('is-invalid');
        //         toastr.error("Name field is required", "Error");
        //         e.preventDefault();
        //         return false;
        //     }
        //     if (phone == '') {
        //         $("#phone").addClass('is-invalid');
        //         toastr.error("Phone number is required", "Error");
        //         e.preventDefault();
        //         return false;
        //     }
        //     if (address == '') {
        //         $("#address").addClass('is-invalid');
        //         toastr.error("Address is required", "Error");
        //         e.preventDefault();
        //         return false;
        //     }
        //     var formData = new FormData(this);

        //     var url = '{{ route('admin.user.update') }}';
        //     $.ajax({
        //         type: 'POST',
        //         url: url,
        //         data: {
        //             first_name: name,
        //             userId: userId,
        //             password: password,
        //             last_name: last_name,
        //             phone: phone,
        //             address: address
        //         },
        //         dataType: "json",

        //         success: (response) => {
        //             if (response.success == true) {
        //                 toastr.success(response.message, "Success");
        //             } else {
        //                 toastr.error(response.message, "Error");
        //             }
        //         },
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
@endsection
