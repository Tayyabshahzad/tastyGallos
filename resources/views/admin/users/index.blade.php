@extends('layouts.master')
@section('title', 'Users')
@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
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
                        <span class="text-muted">Users</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Users</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="userTable">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th> #</th>
                                            <th> Name</th>
                                            <th> Email </th>
                                            <th> Role </th>
                                            <th> Status</th>
                                            <th> Action</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        $('#refresh').hide();
        $('#franchise').select2({
            placeholder: "Select Franchise",
        });
        var DT_URL = '{!! route('admin.users') !!}';
        $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: DT_URL,
            columns: [
                { data: function(data){ return data.DT_RowIndex; }, orderable: false, searchable: false },
                { data: function(data){
                        var last='';
                        if(data.last_name == null){
                            last='';
                        }else{
                            last= data.last_name;
                        }
                        return data.name +' '+ last },
                        name:'name',
                },
                { data:'email',name:'email' },
                { data:'role',name:'role', orderable: false,  searchable: false },
                { data: function(data){
                    if(data.status == 'active'){
                            var color = 'text-success';
                    }else{
                            var color = 'text-danger';
                    }

                    return  `<span class='${color}'> ${data.status} </span>`;

                }, orderable: false,  searchable: false },

                { data: function (data) {
                        return `<span class="text-dark-75 d-block text-warning">
                                    <a  href="{{ route('admin.users.edit') }}/${data.id}" class="btn btn-sm btn-icon btn-light-warning btn-square">
                                            <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                    </a>

                                </span>
                                `;
                    },
                    orderable: false,
                    searchable: false
                },

            ]
        });


    function deleteUser(id) {
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
                var url = '{{ route('admin.user.delete') }}';
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        id:id
                    },
                    success:function(response){
                        var table = $('#userTable').DataTable();
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

    <script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK-wq4OsIg-Kftqkahw2-7y1yBSdfc9aM&libraries=places"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"
    integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
