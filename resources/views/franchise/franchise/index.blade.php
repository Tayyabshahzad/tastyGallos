@extends('layouts.master')
@section('title', 'Franchise')

@section('page_head')
<link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />


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
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Franchises</span>

                        </h3>

                        <h3 class="card-title align-items-start flex-column">

                            <a href="{{ route('admin.franchise.create')}}" class="btn   btn-danger btn-square"> Add Franchise </a>

                        </h3>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">

                        <div class="tab-content">
                            <!--begin::Table-->


                            <div class="table-responsive">
                                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th style="" class="pl-7">
                                                <span class="text-dark-75"> Franchise ID </span>
                                            </th>
                                            <th style="">Franchise</th>
                                            <th style="">Email</th>
                                            <th style="">Telephone</th>
                                            <th style="">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                 <span class="    d-block">
                                                        <i class=" icon text-success   flaticon2-check-mark" style="font-size: 10px"></i>&nbsp; 11349
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block "> Deve RWP  </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  devrwp@gmail.com </span>

                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block "> +923339794881 </span>
                                            </td>
                                            <td>

                                                <span class="text-dark-75  d-block text-warning">
                                                    <a href='{{ route('admin.franchise.edit') }}' class="btn btn-sm btn-icon btn-light-warning btn-square">
                                                        <i class=" icon-1x text-dark-5 flaticon-edit"></i>
                                                   </a>
                                                </span>
                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="text-info">
                                                <span class="text-dark-75  d-block">
                                                    <i class=" icon text-danger   flaticon2-cross" style="font-size: 10px"></i>&nbsp; 11349
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75   d-block "> Deve RWP  </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75   d-block ">  devrwp@gmail.com </span>

                                            </td>
                                            <td>
                                                <span class="text-dark-75   d-block "> +923339794881 </span>
                                            </td>
                                            <td>

                                                <span class="text-dark-75   d-block text-warning">
                                                    <a href='{{ route('admin.franchise.edit') }}' class="btn btn-sm btn-icon btn-light-warning btn-square">
                                                        <i class=" icon-1x text-dark-5 flaticon-edit"></i>
                                                   </a>
                                                </span>
                                            </td>

                                        </tr>










                                    </tbody>
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

    <div class="modal fade" id="reminder" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form id="edit_product_form" method="post" action="javascript:;">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="  col-lg-12">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <a href="#" class="btn btn-icon btn-light-warning btn-circle btn-sm mr-2">
                                            <i class="flaticon-alert"></i>
                                        </a>   Franchise Information is missing!
                                    </h5>
                                    <p>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">

                                Below fields are missing
                                <hr>
                                <ol>
                                    <li>
                                        Bank Name
                                    </li>
                                    <li>
                                        Account Holder
                                    </li>
                                    <li>
                                        Account Number
                                    </li>
                                </ol>




                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>

                        <button type="submit" class="btn btn-danger font-weight-bold  btn-square  "   data-dismiss="modal" aria-label="Close"> Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('page_js')
        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

        <script>
             var table = $('#kt_datatable').DataTable();

             $(window).on('load', function() {
                 $('#reminder').modal('show');
    });

        </script>



@endsection
