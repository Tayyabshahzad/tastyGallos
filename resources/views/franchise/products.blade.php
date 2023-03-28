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
                        <a href="{{ route('franchise.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Products</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Advance Table Widget 4-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Products</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="products">
                                    <thead>


                                        <tr>
                                            <th>Name </th>
                                            <th>Normal Price <strong>(ZAR)</strong> </th>
                                            <th>Sale Price <strong>(ZAR)</strong> </th>
                                            <th>Sell its own </th>
                                            <th>Special Price <strong>(ZAR)</strong> </th>
                                            <th>Status   </th>
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
@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
          var getFranchiseProducts = "{{ route('franchise.products') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#products').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: getFranchiseProducts,
                data: {
                    franchiseId:3,
                }
            },
            columns: [{
                    data: function(data) {
                        return `<a href='{{ route('admin.products.edit') }}/${data.id}'> ${data.name} </a>`;
                    },
                    name: 'name'

                },

                {
                    data: function(data) {
                        return data.price;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function(data) {
                        return data.sale_price;
                    },
                    name: 'sale_price'
                },
                {
                    data: function(data) {
                        return data.sell_on_its_own;
                    },
                    name: 'sell_on_its_own'
                },
                {
                    data: function(data) {
                        if (data.specialPrice == null) {
                                return '-';
                        } else {
                            return data.specialPrice;

                        }

                    },
                    name: 'specialPrice',
                },
                {
                    data: function(data) {
                        return data.status;
                    },
                    name: 'status'
                },





            ]
        });

    </script>

@endsection
