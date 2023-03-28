@extends('layouts.franchise.master')
@section('title', 'All Refunds')

@section('page_head')
<link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />


@endsection


@section('content')


    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-12">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                    <li class="breadcrumb-item">
                        <a href="{{ route('franchise-dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>


                    <li class="breadcrumb-item">
                        <span class="text-muted">Refund</span>
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
                            <span class="card-label font-weight-bolder text-dark">Refunds</span>
                        </h3>


                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <div class="  form-group pt-8">
                                    <a  href="{{ route('franchise-refund-new')}}" class="btn btn-danger btn-square"> Refund Order  </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <!--begin::Table-->


                            <div class="table-responsive">
                                <table class=" table    table-bordered table-checkable" id="kt_datatable">
                                    <thead>
                                        <tr class="  text-uppercase">
                                            <th style="" class="pl-7">
                                                <span class="text-dark-75"> Order #  </span>
                                            </th>
                                            <th style=""> Date</th>
                                            <th style=""> Customer </th>


                                            <th> Refund Amount </th>
                                            <th style=""> Status</th>
                                            <th style=""> Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                 <span class=" d-block">
                                                        <i class=" icon text-success   flaticon2-check-mark" style="font-size: 10px"></i>&nbsp; R 1249
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  12-02-2021 </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  Jhon </span>

                                            </td>

                                            <td>
                                                <span class="text-dark-75  d-block ">  ZAR 30,000 </span>

                                            </td>

                                            <td>
                                                <span class="text-dark-75  d-block ">  Refunded </span>

                                            </td>


                                            <td>
                                                <span class="text-dark-75   d-block text-warning"  data-toggle="modal" data-target="#refund_modal">
                                                    <a href='#' class="btn btn-sm btn-icon btn-light-warning btn-square"  >
                                                        <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                                   </a>
                                                </span>

                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                 <span class=" d-block">
                                                        <i class=" icon text-success   flaticon2-check-mark" style="font-size: 10px"></i>&nbsp; R 1249
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  12-02-2021 </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  Jhon </span>

                                            </td>

                                            <td>
                                                <span class="text-dark-75  d-block ">  ZAR 30,000 </span>

                                            </td>

                                            <td>
                                                <span class="text-dark-75  d-block ">  Requested </span>

                                            </td>




                                            <td>
                                                <span class="text-dark-75   d-block text-warning"  data-toggle="modal" data-target="#refund_modal">
                                                    <a href='#' class="btn btn-sm btn-icon btn-light-warning btn-square"  >
                                                        <i class=" icon-1x text-dark-5 flaticon-eye"></i>
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


<div class="modal fade" id="refund_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form id="edit_product_form" method="post" action="javascript:;">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="font-weight-bold"> Order Number:</label>
                                    #11024
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="font-weight-bold"> Order Date:</label>
                                    12-02-2022
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr> <th> Name </th><th> Qty </th><th> Price </th> </tr>
                                        </thead>
                                        <tbody  >
                                            <tr> <td> Gallo Burger </td><td> 2 </td><td> ZAR 30,000 </td> </tr>
                                            <tr> <td colspan="3" class="font-weight-bold">Reason to Refund: </td>  </tr>
                                            <tr> <td colspan="3" class="font-weight-bold"><textarea name="" class="form-control"  > </textarea></td>  </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="submit" class="btn btn-primary font-weight-bold  btn-square">   Refund Requested</button>

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

             $('#product_franchise').select2({
                    placeholder: "Select a Franchise",
            });
        </script>


@endsection
