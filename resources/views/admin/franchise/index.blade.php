@extends('layouts.master')
@section('title', 'Franchise')
@section('page_head')
<link href="{{ asset('design/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"   type="text/css" />
<style>
        table tr td {
            text-transform: lowercase;
        }
        table td:nth-child(2){
        text-transform: capitalize!important;
    }
</style>
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
                        <span class="text-muted">Franchise</span>
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
                            <h3 class="card-label">Franchises</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <a href="{{ route('admin.franchises.create')}}" class="btn btn-danger btn-square"   > Add Franchise </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-toolbar form-group">
                            <select name=""   class="form-control" style="width:13%;" id="franchiseStatus">
                                <option value="all"> All </option>
                                <option value="active"> Active </option>
                                <option value="inactive"> In Active </option>
                            </select>
                        </div>
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="franchises-table">
                                    <thead>
                                        <tr class="text-left ">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact #</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
    <form action="{{ route('admin.franchises.delete')}}" method="post" id="deletefrom">@csrf <input type="hidden" id="user_id" name="delete_id"/> </form>
@endsection
@section('page_js')
<script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>
    $('#franchiseStatus').on('change', function() {
        var DT_URL = '{{ route('admin.franchises') }}';
        var status =  this.value;
        $.ajax({
                url:DT_URL,
                data:{
                status:status,
            },
            success:function(response){
                $('#franchises-table').DataTable().ajax.url(DT_URL+`?status=${status}`).draw();
            },

        });
    });
    $(function() {
        $('#franchises-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.franchises') !!}',

            columns: [
                { data: function(data){ return data.DT_RowIndex; }, orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'userEmail', name: 'userEmail', orderable: false, searchable: false,uppercase:true },
                { data: 'contact_phone', name: 'contact_phone' },
                { data: function(data){
                    if(data.status == 'active'){
                        status = "<i class='text-success icon-1x text-dark-5 flaticon2-check-mark'></i>";
                    }else{
                        status = "<i class='text-danger icon-1x text-dark-5 flaticon2-cross'></i>";
                    }
                    return status;

                 }, name: 'status' },
                { data: function(data){
                    return   `<a href='{{route('admin.franchises.edit')}}/${data.id}' class='btn btn-sm btn-icon btn-light-warning btn-square'>
                                        <i class='icon-1x text-dark-5 flaticon-edit'></i>
                              </a>
                              <button  onclick='deleteCat(${data.id})'  class='btn btn-sm btn-icon btn-light-danger btn-square'>
                                    <i class='icon-1x text-dark-5 flaticon-delete'></i>
                              </button>`;
                }, name: 'action', orderable: false, searchable: false}

            ]
        });
    });
    function deleteCat(id) {
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

                $('#user_id').val(id);
                $('#deletefrom').submit();


            }
        });
    }

</script>
@endsection
