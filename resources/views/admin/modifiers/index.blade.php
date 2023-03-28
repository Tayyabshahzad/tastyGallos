@extends('layouts.master')
@section('title', 'Modifiers')
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
                        <span class="text-muted">Modifiers</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Modifiers</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <a href="{{ route('admin.modifiers.create')}}" class="btn btn-danger btn-square"   > Add Modifier </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="modifiers_table">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th> <span class="text-dark-75"> # </span> </th>
                                            <th style="">Modifier Name</th>
                                            <th style="">Min Options</th>
                                            <th style="">Max Options</th>
                                            <th style="">Option Selected Times</th>
                                            <th style=""> Items </th>
                                            <th>Status</th>
                                            <th style="">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
<script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('#modifiers_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.modifiers') !!}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: function(data){
                                return data.name;
                            },
                            name:'name'},
                    { data: 'select_min_options', name: 'select_min_options' },
                    { data: 'select_max_options', name: 'select_max_options' },
                    { data: 'option_selected_times', name: 'option_selected_times'},
                    { data: function(data){
                        return data.product;
                    },orderable: false, searchable: false},
                    { data: function(data){
                        if(data.status == 'active'){
                            var status = "<i class='icon-1x text-dark-5 flaticon2-check-mark text-success'></i>";
                        }else{
                            var status = "<i class='icon-1x text-dark-5 flaticon2-cross text-danger'></i>";
                        }
                        return status;

                    }, name: 'status'},
                    { data: function(data){

                             return `
                                    <a href="{{ route('admin.modifiers.edit')}}/${data.id}" class="btn btn-sm btn-icon btn-light-warning btn-square">
                                            <i class="icon-1x text-dark-5 flaticon-edit"></i>
                                    </a>

                                    <button  class="btn btn-sm btn-icon btn-light-danger btn-square" onclick="deleteModifier(${data.id})">
                                            <i class="icon-1x te    xt-dark-5 flaticon-delete"></i>
                                    </button>`;

                    },orderable: false, searchable: false },

                ]
            });
        });


        function deleteModifier(id) {
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


                var url = '{{ route('admin.modifiers.delete') }}';
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        id:id
                    },
                    success:function(response){
                        var table = $('#modifiers_table').DataTable();
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
