@extends('layouts.master')
@section('title', 'Products')

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
                        <span class="text-muted">Products</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Products</h3>
                        </div>
                        <div class="card-title text-right">
                            <h3 class="card-label"></h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-danger btn-square"> Add
                                    Product </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="productTable">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th class="pl-7">
                                                <span class="text-dark-75"> # </span>
                                            </th>
                                            <th> Name</th>
                                            <th> Categories</th>
                                            <th> Normal Price <strong>(ZAR)</strong></th>
                                            <th> Sale Price <strong>(ZAR)</strong></th>
                                            <th> Sell on its own </th>
                                            <th> Status </th>
                                            <th> Action</th>
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
    $('#productTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.products') !!}',
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data:'categories',
                    name:'categories',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'sale_price',
                    name: 'sale_price'
                },
                {
                    data: 'sell_on_its_own',
                    name: 'sell_on_its_own'
                },
                { data: function(data){
                    if(data.status == 'active'){
                        status = "<i class='text-success icon-1x text-dark-5 flaticon2-check-mark'></i>";
                    }else{
                        status = "<i class='text-danger icon-1x text-dark-5 flaticon2-cross'></i>";
                    }
                    return status;

                 }, name: 'status' },
                {
                    data: function(data) {
                        return `<a href="{{ route('admin.products.edit') }}/${data.id}" class="btn btn-sm btn-icon btn-light-warning btn-square" onclick="deleteModifier(4)">
                                                    <i class="icon-1x text-dark-5 flaticon-edit"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-icon btn-light-danger btn-square" onclick="deleteProduct(${data.id})">
                                                    <i class="icon-1x text-dark-5 flaticon-delete"></i>
                                                    </button>
                                                    `;
                    },
                    orderable: false,
                    searchable: false
                },
            ]
        });

    function deleteProduct(id) {
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
                var url = '{{ route('admin.products.delete') }}';
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var table = $('#productTable').DataTable();
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
