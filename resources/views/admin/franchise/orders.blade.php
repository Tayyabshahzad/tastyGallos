@extends('layouts.franchise.master')
@section('title', 'Orders')

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
                        <span class="text-muted">Orders</span>
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
                            <span class="card-label font-weight-bolder text-dark">Orders</span>
                        </h3>


                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">
                        <div class="row mb-10">
                            <div class="col-lg-3">
                                <div class="  form-group">
                                    <label class="font-weight-bold">Select Type: *</label>
                                    <select class="form-control select2" id="product_franchise" name="param" >
                                        <option value="*" > All </option>
                                        <option value="AK" > PickUp </option>
                                        <option value="HI" > Delivery </option>
                                        <option value="HI" > Refunded </option>
                                        <option value="HI" > Delivered </option>
                                   </select>
                                </div>
                            </div>



                            <div class="col-lg-3">
                                <div class="  form-group pt-8">
                                    <button   class="btn btn-danger btn-square"> Filter  </button>
                                </div>
                            </div>


                            <div class="col-lg-6 text-right">
                                <div class="  form-group pt-8">
                                    <button   class="btn btn-danger btn-square"> Active Orders  </button>
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
                                            <th style=""> Type</th>
                                            <th style=""> Customer </th>

                                            <th>  Order Value </th>
                                            <th>  Time Ago </th>
                                            <th> Status </th>
                                            <th> Details </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                 <span class=" d-block">
                                                       # 1249
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  Delivery </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  Jhon </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  ZAR 30,000 </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  10 Min Ago </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block "> Delivered </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75   d-block text-warning"  data-toggle="modal" data-target="#orderDetail">
                                                    <a href='#' class="btn btn-sm btn-icon btn-light-warning btn-square"  >
                                                        <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                                   </a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <span class=" d-block">
                                                       # 1249
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  Delivery </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  Jhon </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  ZAR 30,000 </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block ">  10 Min Ago </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75  d-block "> Refunded </span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75   d-block text-warning"  data-toggle="modal" data-target="#orderDetail">
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

    <div class="modal fade" id="orderDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="edit_product_form" method="post" action="javascript:;">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <b class="font-weight-bold"> Order Number:</b>
                                    #11024
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="font-weight-bold"> Order Time:</label>
                                   10 mins Ago
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="font-weight-bold"> Customer:</label>
                                    Catherine Deneuve
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="font-weight-bold"> Customer Contact:</label>
                                    +92333646885
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="font-weight-bold"> Type:</label>
                                    Delivery
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="font-weight-bold"> Address:</label>
                                    House 304-B Amna Street ISB
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
                                        <tbody>
                                            <tr> <td> Gallo Burger </td><td> 2 </td><td> ZAR 30,000 </td> </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="row p-3">

                        <div class="col-lg-12 text-right">
                              <button type="submit" class="btn btn-danger font-weight-bold  btn-square"   data-dismiss="modal" aria-label="Close"> Close </button> </div>
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
