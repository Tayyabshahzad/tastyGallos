@extends('layouts.master')
@section('title', 'Promotions')
@section('page_head')
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
                        <span class="text-muted">Promotions</span>
                    </li>

                </ul>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Promotions</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <a href="{{ route('admin.promotions.create') }}" class="btn btn-danger btn-square"> Add
                                    Promotion </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="promotions">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th style="" class="pl-7"> <span class="text-dark-75"> # </span>
                                            </th>
                                            <th style=""> Type</th>
                                            <th style=""> Promotion Duration </th>
                                            <th style=""> Status </th>
                                            <th style=""> Action</th>
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
            $('#promotions').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.promotions') !!}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: function(data) {
                            var type = data.type;
                            return type.toUpperCase();
                        },
                        orderable: false,
                        searchable: false
                    },

                    {
                        data:'statEnd',name:'statEnd',
                        orderable: false,
                        searchable: false
                    },
                    {
                         data:function(data){
                            var btn = '';
                            if(data.promotionStatus == 4){
                                btn = `<span class='btn btn-outline-danger btn-square  btn-sm'> Canceled</span>`;
                            }else{
                                if(data.promotionStatus == 1){
                                    btn = `<span class='btn btn-outline-primary btn-square  btn-sm'> Scheduled </span>`;
                                }else if(data.promotionStatus == 2){
                                    btn = `<span class='btn btn-outline-success btn-square  btn-sm'> Completed </span>`;
                                 }else if(data.promotionStatus == 3){
                                    btn = `<span class='btn btn-outline-info btn-square  btn-sm'> Pending</span>`;
                                }
                            }

                             return btn;
                         },

                        orderable: false,
                        searchable: false

                    },

                    {
                        data: function(data) {
                            var viewBtn = '';
                            if(data.promotionStatus == 2){
                                  viewBtn = ` <a href="{{ route('admin.promotions.view') }}/${data.id}" class="btn btn-sm btn-icon btn-light-primary btn-square" >
                                                        <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                                 </a>`;
                            }else{
                                viewBtn =  `
                                    <a href="{{ route('admin.promotions.edit') }}/${data.id}" class="btn btn-sm btn-icon btn-light-warning btn-square">
                                        <i class=" icon-1x text-dark-5 flaticon-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-icon btn-light-danger btn-square" onclick="deletePromotion(${data.id})">
                                        <i class=" icon-1x text-dark-5 flaticon-delete"></i>
                                    </button> `;
                            }

                            return viewBtn;


                        },
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        });



        // $(".viewPromotion").click(function(e) {
        //     var id = $(this).data('id');
        //     alert(id);
        //     $.ajax({
        //         url: url,
        //         method: 'POST',
        //         data: {
        //             status: status,
        //             name: name
        //         },
        //         success: function(response) {
        //             $("#addCategory").attr("disabled", false);
        //             var table = $('#category-table').DataTable();
        //             table.ajax.reload(null, false);
        //             if (response.success == true) {
        //                 $('#add_category_modal').modal('hide');
        //                 $("#category").removeClass('is-invalid');
        //                 $("#addCategoryForm")[0].reset();
        //                 toastr.success(response.message, "success");
        //             } else {

        //                 $("#category").addClass('is-invalid');
        //                 toastr.error(response.message, "error");
        //             }
        //             console.log(response.success);
        //         },

        //     });
        // });

        $("#promotions").on("click", ".viewPromotion", function(e) {
            var id = $(this).data('id');
            url = "{{ route('admin.promotions.view') }}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    id:id,
                },
                success: function(response) {
                    if (response.success == true) {

                    } else {
                        toastr.error(response.message, "Error");
                    }

                },
            });
        });

        function deletePromotion(id) {
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
                    var url = '{{ route('admin.promotions.delete') }}';
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var table = $('#promotions').DataTable();
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

        function canclePromotion(id) {
            Swal.fire({
                title: "Are you sure to deactivate ?",
                text: "This action will deactivate your promotion!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    var url = '{{ route('admin.promotions.inactive') }}';
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var table = $('#promotions').DataTable();
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
    </script>

@endsection
