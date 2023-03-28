@extends('layouts.master')
@section('title', 'CMS')

@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />


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
                                Create New
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">FAQ's</h3>
                                </div>
                                <div class="card-title">
                                    <a href="" class="btn btn-danger  btn-square" data-toggle="modal"
                                        data-target="#addFaq">ADD FAQ</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table" id="faqs-table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Question </th>
                                            <th> Answer </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label"> Homepage Banner</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <form id="contentForm" method="post" action="{{ route('admin.option.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="image-input image-input-outline mt-2" id="kt_image_5">
                                                    <div class="image-input-wrapper"
                                                        style="background-image: url({{ $banner }}); width: 250px; height: 167px; max-width: 100%;">
                                                    </div>
                                                    <label
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change" data-toggle="tooltip" title=""
                                                        data-original-title="Upload Banner">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="logo" accept=".png, .jpg, .jpeg"
                                                            id="image">
                                                        <input type="hidden" name="profile_avatar_remove123" value="0">
                                                    </label>
                                                    <span
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel" data-toggle="tooltip" title=""
                                                        data-original-title="Remove Banner">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Login Screen Content</label>
                                                <input type="hidden" name="id" id="id"
                                                    value="@if ($option != null) {{ $option->id }} @endif">
                                                <textarea class="form-control" placeholder="Login Screen Content" name="value" id="value" style="height:200px">{{ $option->option_value }}</textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-danger btn-square mb-10 updateSetting"
                                                    @if ($option == '' or $option == null) disabled @endif> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.cms.partials.create-modal')
    @include('admin.cms.partials.edit-modal')
@endsection
@section('page_js')
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var avatar5 = new KTImageInput('kt_image_5');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $('#faqs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.cms') !!}',
                columns: [{
                        data: function(data) {
                            return data.DT_RowIndex;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: function(data) {
                            String.prototype.trimEllip = function(length) {
                                return this.length > length ? this.substring(0, length) +
                                    "..." : this;
                            }
                            return data.question.trimEllip(30);
                        },
                        name: 'question'
                    },
                    {
                        data: function(data) {
                            String.prototype.trimEllip = function(length) {
                                return this.length > length ? this.substring(0, length) +
                                    "..." : this;
                            }
                            return data.answer.trimEllip(30);
                        },
                        name: 'answer'
                    },
                    {
                        data: function(data) {
                            if (data.status == 'active') {
                                return ` <i class="icon-1x text-dark-5 flaticon2-check-mark text-success"></i>`;
                            } else {
                                return ` <i class=" icon-1x text-dark-5 flaticon2-cross text-danger"></i>`;
                            }

                        },
                        searchable: false,
                    },
                    {
                        data: function(data) {
                            return `
                        <span class="text-dark-75  d-block text-warning">
                            <button type="button" class="btn btn-sm btn-icon btn-light-warning btn-square recordEdit"
                                data-toggle="modal" data-target="#editFaq" data-id="${data.id}"
                                data-question="${data.question}" data-answer="${data.answer}" data-position="${data.position}" data-status="${data.status}" >
                                <i class=" icon-1x text-dark-5 flaticon-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-light-danger btn-square" onclick='deleteFaq(${data.id})'  >
                                 <i class=" icon-1x text-dark-5 flaticon-delete"></i>
                            </button>
                        </span>

                        `;
                        },
                        searchable: false,
                        orderable: false
                    },
                ]
            });
        });

        function deleteFaq(id) {
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
                    var url = '{{ route('admin.faq.delete') }}';
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var table = $('#faqs-table').DataTable();
                            table.ajax.reload(null, false);
                            if (response.success == true) {
                                toastr.success(response.message, "success");
                            } else {
                                toastr.error(response.message, "error");
                            }
                        }
                    });
                }
            });
        }
        $(document).on("click", ".recordEdit", function() {
            var id = $(this).data('id');
            var question = $(this).data('question');
            var answer = $(this).data('answer');
            var position = $(this).data('position');
            var status = $(this).data('status');

            $('#faqId').val(id);
            $('#question').val(question);
            $('#answer').val(answer);
            $('#position').val(position);

            if (status == 'active') {
                $('#updateStatus').prop('checked', true);
            } else {
                $('#updateStatus').prop('checked', false);
            }
        });
        $(".updateFaq").click(function(e) {
            e.preventDefault();
            $('.updateFaq').attr('disabled', true);
            var id = $("#faqId").val();
            var question = $("#question").val();
            var answer = $("#answer").val();
            var position = $("#position").val();
            if ($('#updateStatus').is(":checked")) {
                status = "active";
            } else {
                status = "inactive";
            }
            var url = '{{ route('admin.faq.update') }}';
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id: id,
                    question: question,
                    answer: answer,
                    position: position,
                    status: status,
                },
                success: function(response) {
                    $('.updateFaq').attr('disabled', false);
                    var table = $('#faqs-table').DataTable();
                    table.ajax.reload(null, false);
                    if (response.success == true) {
                        $('#editFaq').modal('hide');
                        $("#edit_faq_form")[0].reset();
                        toastr.success(response.message, "success");
                    } else {
                        $("#question").addClass('is-invalid');
                        $("#answer").addClass('is-invalid');
                        $("#position").addClass('is-invalid');
                        toastr.error(response.message, "error");
                    }
                    console.log(response.success);
                },
            });
        });
        $(".createFaq").click(function(e) {
            e.preventDefault();
            $('.createFaq').attr('disabled', true);
            var question = $("#newQuestion").val();
            var answer = $("#newAnswer").val();
            var position = $("#newPosition").val();
            if (question == '') {
                $("#newQuestion").addClass('is-invalid');
            } else {
                $("#newQuestion").removeClass('is-invalid');
            }

            if (answer == '') {
                $("#newAnswer").addClass('is-invalid');
                e.preventDefault();
            } else {
                $("#newAnswer").removeClass('is-invalid');
            }
            if ($('#status').is(":checked")) {
                status = "active";
            } else {
                status = "inactive";
            }
            var url = '{{ route('admin.faq.store') }}';
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    question: question,
                    answer: answer,
                    position: position,
                    status: status,
                },
                success: function(response) {
                    $('.createFaq').attr('disabled', false);
                    var table = $('#faqs-table').DataTable();
                    table.ajax.reload(null, false);
                    if (response.success == true) {
                        $('#addFaq').modal('hide');
                        $("#add_faq_form")[0].reset();
                        toastr.success(response.message, "success");
                    } else {
                        $("#question").addClass('is-invalid');
                        $("#answer").addClass('is-invalid');
                        $("#position").addClass('is-invalid');
                        toastr.error(response.message, "error");
                    }
                    console.log(response.success);
                },
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#contentForm').submit(function(e) {

            var fileUpload = document.getElementById("image");
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            if (size > 5000) {
                $('#image').addClass('border-danger');
                toastr.error("File size must be less then 5 Mb", "Error");
                $(".updateSetting").attr("disabled", false);
                e.preventDefault();
            } else {
                $(".updateSetting").attr("disabled", true);


            }

        });
    </script>



@endsection
