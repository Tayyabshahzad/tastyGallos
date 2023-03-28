@extends('layouts.master')
@section('title', 'Categories')
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
                        <span class="text-muted">Categories</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Advance Table Widget 4-->
                <div class="card card-custom mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Categories</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <a href="#" class="btn   btn-danger btn-square addCategoryButton" data-toggle="modal"
                                data-target="#add_category_modal"> Add Category </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="category-table">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th style="">#</th>
                                            <th style="">Name</th>
                                            <th style="">Products</th>
                                            <th style="">Status</th>
                                            <th style="">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 4-->
            </div>
        </div>
    </div>
    @include('admin.categories.partials.create-modal')
    @include('admin.categories.partials.edit-modal')
   <form action="{{ route('admin.categories.delete') }}" method="post" id="deletefrom">@csrf <input type="hidden" id="user_id" name="delete_id"/> </form>
@endsection
@section('page_js')
<script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
    $(function() {
        $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.categories') !!}',
            columns: [
                { data: function(data){ return data.DT_RowIndex; }, orderable: false, searchable: false },
                { data: 'name', name: 'name',orderable: true},
                { data: function(data){ return data.products_count },orderable: false, searchable: false},
                { data: function(data){
                        if(data.status == 'active'){
                                status = "<i class='text-success icon-1x text-dark-5 flaticon2-check-mark'></i>";
                        }else{
                                status = "<i class='text-danger icon-1x text-dark-5 flaticon2-cross'></i>";
                            };

                        return status;
                },orderable: false, searchable: false},
                { data: function(data){
                    return `<button class='btn btn-sm btn-icon btn-light-warning btn-square categoryEdit'
                                data-toggle='modal' data-target='#edit_category_modal'
                                data-id='${data.id}' data-name='${data.name}'  data-status='${data.status}'>
                                    <i class='icon-1x text-dark-5 flaticon-edit'></i>
                            </button>
                            <button type="button" class='btn btn-sm btn-icon btn-light-danger btn-square' onclick='deleteCategory(${data.id})' >
                                    <i class='icon-1x text-dark-5 flaticon-delete'></i>
                            </button>
                            `;
                },orderable: false, searchable: false },
            ]
        });
    });

    $(document).on("click", ".categoryEdit", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var status = $(this).data('status');
        $('#categoryName').val(name);
        $('#categoryid').val(id);
        if (status == 'active') {
            $('#edit_status').prop('checked', true);
        } else {
            $('#edit_status').prop('checked', false);
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.addCategoryButton').click(function(){
        $("#addCategoryForm")[0].reset();
        $("#category").removeClass('is-invalid');
    });

    $("#addCategory").click(function(e){

        var name = $("#category").val();
        var url = '{{ route('admin.categories.store') }}';
        $("#category").removeClass('is-invalid');

        if ($('#check_id').is(":checked")){
            status = "active";
        }else{
            status = "inactive";
        }

        if(name == ''){
            e.preventDefault();
            $("#category").addClass('is-invalid');
            toastr.error('Enter Category Name', "Error");
            $("#addCategory").attr("disabled", false);
        }
        $.ajax({
            url:url,
            method:'POST',
            data:{
                status:status,
                name:name
            },
            success:function(response){
                $("#addCategory").attr("disabled", false);
                var table = $('#category-table').DataTable();
                table.ajax.reload( null, false );
                if(response.success == true){
                    $('#add_category_modal').modal('hide');
                    $("#category").removeClass('is-invalid');
                    $("#addCategoryForm")[0].reset();
                    toastr.success(response.message, "success");
                }else{

                    $("#category").addClass('is-invalid');
                    toastr.error(response.message, "error");
                }
                console.log(response.success);
            },

        });
    });

    $("#updateCategory").click(function(e){
        var name = $("#categoryName").val();
        var id   = $("#categoryid").val();
        $("#updateCategory").attr("disabled", true);
        if(name == ''){
            e.preventDefault();
            $("#categoryName").addClass('is-invalid');
        }
        if ($('#edit_status').is(":checked")){
            status = "active";
        }else{
            status = "inactive";
        }
        var url = '{{ route('admin.categories.update') }}';
        $.ajax({
                url:url,
                method:'POST',
                data:{
                id:id,
                status:status,
                name:name
            },
            success:function(response){
                $("#updateCategory").attr("disabled", false);
                var table = $('#category-table').DataTable();
                table.ajax.reload( null, false );
            if(response.success == true){
                $('#edit_category_modal').modal('hide');
                $("#edit_category_form")[0].reset();
                toastr.success(response.message, "success");
            }else{
                $("#categoryName").addClass('is-invalid');
                toastr.error(response.message, "error");
            }
                console.log(response.success);
            },

        });
    });


    function deleteCategory(id) {
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
                var url = '{{ route('admin.categories.delete') }}';
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        id:id
                    },
                    success:function(response){
                        var table = $('#category-table').DataTable();
                        table.ajax.reload( null, false );
                        if(response.success == true){
                            toastr.success(response.message, "success");
                        }else{
                            toastr.error(response.message, "error");
                        }
                    }
                });

            }
        });
    }
    </script>

@endsection
