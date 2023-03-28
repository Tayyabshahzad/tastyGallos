@extends('layouts.master')
@section('title', 'Settings')
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
                                Settings
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="updateSettingForm">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">Account Settings</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 text-center mb-4">
                                            <div class="image-input image-input-outline mt-2" id="kt_image_5">
                                                <div class="image-input-wrapper"
                                                    style="background-image: url(@if ($user->getFirstMediaUrl('profile_photo', 'thumb') != '') {{ $user->getFirstMediaUrl('profile_photo', 'thumb') }}
                                                    @else
                                                    {{ asset('design/assets/media/placeholder.png') }} @endif);width: 250px; height: 167px; max-width: 100%;">
                                                </div>
                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Upload Banner">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="profile_photo" accept=".png, .jpg, .jpeg">
                                                    <input type="hidden" name="profile_avatar_remove" value="0">
                                                </label>
                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title=""
                                                    data-original-title="Remove Banner">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Name </label>
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        value="{{ $user->name }}" name="user_name" required id="name">
                                                </div>

                                                <div class="form-group col-lg-12">
                                                    <label for=""> Email </label>
                                                    <input type="email" class="form-control" value="{{ $user->email }}"
                                                        name="user_email" id="email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Password </label>
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        name="password" id="password">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Re-enter Password </label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Re-enter password" name="password_confirmation"
                                                        id="confirm_password">
                                                </div>
                                                <div class="col-lg-12 text-danger" id="passwordError" style="display: none">
                                                    <small> Password & confirm password not matched </small>
                                                </div>

                                                <div class="col-lg-12 text-danger" id="nameError" style="display: none">
                                                    <small> Name field is required </small>
                                                </div>
                                                <div class="col-lg-12 text-danger" id="emailError" style="display: none">
                                                    <small> Email field is required </small>
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
                                        <h3 class="card-label">Paygate Settings</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <input type="hidden" value="{{ $paygate_id->id }}" name="paygate_id"   class="paygate_id" required>
                                                <input type="hidden" value="{{ $reference_id->id }}" name="reference_id"   class="reference_id" required>
                                                <input type="hidden" value="{{ $commission->id }}" name="commission_id" class="commissionId" required>
                                                <input type="hidden" value="{{ $cms_firebase_server_key->id }}" name="cms_firebase_server_key_id" class="cms_firebase_server_key" required>
                                                <input type="hidden" value="{{ $app_firebase_server_key->id }}" name="app_firebase_server_key_id" class="app_firebase_server_key" required>

                                                <input type="hidden" value="{{ $firebase_api_key->id }}" name="firebase_api_key_id" class="app_firebase_server_key" required>
                                                <input type="hidden" value="{{ $database_url->id }}" name="database_url_id" class="app_firebase_server_key" required>
                                                <input type="hidden" value="{{ $auth_domain->id }}" name="auth_domain_id" class="app_firebase_server_key" required>
                                                <input type="hidden" value="{{ $project_id->id }}" name="project_id" class="app_firebase_server_key" required>
                                                <input type="hidden" value="{{ $storage_bucket->id }}" name="storage_bucket_id" class="app_firebase_server_key" required>
                                                <input type="hidden" value="{{ $messaging_sender_id->id }}" name="messaging_sender_id" class="app_firebase_server_key" required>
                                                <input type="hidden" value="{{ $app_id->id }}" name="app_id" class="app_firebase_server_key" required>
                                                <input type="hidden" value="{{ $measurement_id->id }}" name="measurement_id" class="app_firebase_server_key" required>

                                                <div class="form-group col-lg-12">

                                                    <h3 class="card-label" style="font-size:15px;color:#000"> CMS Settings</h3> <hr>
                                                    <label for=""> Paygate ID </label>
                                                    <input type="text" class="form-control" placeholder="PAYGATE ID:" name="paygate_id_value" value="{{ $paygate_id->option_value }}" id="paygate_id_value" required>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Reference </label>
                                                    <input type="text" class="form-control" placeholder="REFERENCE Key:" name="reference_id_value" value="{{ $reference_id->option_value }}" id="reference_id-value" required>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label for=""> Firebase Server Key </label>
                                                    <input type="text" class="form-control" placeholder="Firebase Server Key: "  name="cms_firebase_server_key_value" value="{{ $cms_firebase_server_key->option_value }}" id="cms_firebase_server_key_value"  required>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <h3 class="card-label" style="font-size:15px;color:#000"> APP Settings</h3> <hr>
                                                    <label for=""> Firebase Server Key  </label>
                                                    <input type="text" class="form-control"  placeholder="Firebase Server Key: "   name="app_firebase_server_key_value" value="{{ $app_firebase_server_key->option_value }}" id="app_firebase_server_key_value"  required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <h3 class="card-label" style="font-size:15px;color:#000">
                                                        Real-Time Dashbaord Page Settings</h3> <hr>
                                                        <div class="form-group ">
                                                            <label for=""> Firebase Api Key </label>
                                                            <input type="text" class="form-control"
                                                            placeholder="Firebase Api Key"
                                                            name="firebase_api_key_value"
                                                            value="{{ $firebase_api_key->option_value }}"
                                                            id="firebase_api_key_value" required>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for=""> Database URL</label>
                                                            <input type="text" class="form-control"
                                                            placeholder="Database URL" name="database_url_value"
                                                            value="{{ $database_url->option_value }}"
                                                            id="database_url_value" required>
                                                        </div>


                                                        <div class="form-group ">
                                                            <label for=""> Auth Domain </label>
                                                            <input type="text" class="form-control"
                                                            placeholder="Auth Domain" name="auth_domain_value"
                                                            value="{{ $auth_domain->option_value }}"
                                                            id="auth_domain_value" required>
                                                        </div>


                                                        <div class="form-group ">
                                                            <label for=""> Project Id </label>
                                                            <input type="text" class="form-control"
                                                            placeholder="Project Id:" name="project_id_value"
                                                            value="{{ $project_id->option_value }}"
                                                            id="project_id_value" required>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for=""> Storage Bucket </label>
                                                            <input type="text" class="form-control"
                                                            placeholder="Storage Bucket:" name="storage_bucket_value"
                                                            value="{{ $storage_bucket->option_value }}"
                                                            id="storage_bucket_value" required>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for=""> Messaging Sender Id </label>
                                                            <input type="text" class="form-control"
                                                            placeholder="Messaging Sender Id:"name="messaging_sender_id_value"
                                                            value="{{ $messaging_sender_id->option_value }}" id="messaging_sender_id_value" required>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for=""> App Id </label>
                                                            <input type="text" class="form-control"
                                                            placeholder="App Id" name="app_id_value"
                                                            value="{{ $app_id->option_value }}" id="app_id_value" required>
                                                        </div>


                                                        <div class="form-group ">
                                                            <label for=""> Measurement Id </label>
                                                            <input type="text" class="form-control"
                                                             placeholder="Measurement Id:" name="measurement_id_value"
                                                             value="{{ $measurement_id->option_value }}" id="measurement_id_value" required>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <h3 class="card-label" style="font-size:15px;color:#000">
                                                        Commision Settings</h3> <hr>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control"
                                                            value="{{ $commission->option_value }}"
                                                            name="commission_value" id="commissionId_value" min="0"
                                                            min="100" required>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-danger" id="paygate_id"
                                                    style="display: none">
                                                    <small> Paygate Id is required </small>
                                                </div>
                                                <div class="col-lg-12 text-danger" id="reference_id"
                                                    style="display: none">
                                                    <small> Reference Id is required </small>
                                                </div>
                                                <div class="col-lg-12 text-danger" id="commission_error"
                                                    style="display: none">
                                                    <small> Commission field is required </small>
                                                </div>
                                                <div class="col-lg-12 text-danger" id="commission_limit_error"
                                                    style="display: none">
                                                    <small> Commission must be less then or equal to 100 </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </form>

            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-square"> Cancel</a>
                <button type="submit" class="btn btn-danger btn-square"> Update</button>
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

        $("#updateSettingForm").submit(function(e) {
            e.preventDefault();
            var password = $("#password").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var password_confirmation = $("#confirm_password").val();
            var commission = $('.commissionId').val();

            var paygate_id = $('.paygate_id').val();
            var reference_id = $('.reference_id').val();
            var cms_firebase_server_key = $('.cms_firebase_server_key').val();
            var app_firebase_server_key = $('.app_firebase_server_key').val();
            var commissionId_value = $('.commissionId_value').val();

            if (paygate_id == '') {
                $("#merchantID_value").addClass('is-invalid');
                $('#paygate_id').css('display', 'block');
                e.preventDefault();
                return false;
            }
            if (reference_id == '') {
                $("#merchantKey_value").addClass('is-invalid');
                $('#merchantKey_error').css('display', 'block');
                e.preventDefault();
                return false;
            }

            if (cms_firebase_server_key == '') {
                $("#merchantKey_value").addClass('is-invalid');
                $('#merchantKey_error').css('display', 'block');
                e.preventDefault();
                return false;
            }

            if (app_firebase_server_key == '') {
                $("#merchantKey_value").addClass('is-invalid');
                $('#merchantKey_error').css('display', 'block');
                e.preventDefault();
                return false;
            }


            if (commissionId_value == '') {
                $("#commissionId_value").addClass('is-invalid');
                $('#commission_error').css('display', 'block');
                e.preventDefault();
                return false;
            }
            if (name == '') {
                $("#name").addClass('is-invalid');
                $('#nameError').css('display', 'block');
                e.preventDefault();
                return false;
            }
            if (email == '') {
                $("#email").addClass('is-invalid');
                $('#emailError').css('display', 'block');
                e.preventDefault();
                return false;
            }
            if (password != password_confirmation) {
                $("#password").addClass('is-invalid');
                $("#confirm_password").addClass('is-invalid');
                $('#passwordError').css('display', 'block');
                e.preventDefault();
                return false;
            }
            if (commissionId_value > 100) {
                $("#commissionId_value").addClass('is-invalid');
                $('#commission_limit_error').css('display', 'block');
                e.preventDefault();
                return false;
            }
            var url = '{{ route('admin.settings.update') }}';
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.payfast.update') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response.success == true) {
                        $("#updateSettingForm input[id='password']").val('');
                        $("#updateSettingForm input[id='confirm_password']").val('');
                        $("#name").removeClass('is-invalid');
                        $("#password").removeClass('is-invalid');
                        $("#confirm_password").removeClass('is-invalid');
                        $("#commissionId_value").removeClass('is-invalid');
                        $("#nameError").css('display', 'none');
                        $("#emailError").css('display', 'none');
                        $('#passwordError').css('display', 'none');
                        $('#paygate_id').css('display', 'none');
                        $('#reference_id').css('display', 'none');
                        $('#commission_error').css('display', 'none');
                        $('#commission_limit_error').css('display', 'none');
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
