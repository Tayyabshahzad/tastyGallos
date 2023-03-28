@extends('layouts.franchise.master')
@section('title', 'Refund')

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
                            <span class="card-label font-weight-bolder text-dark">Refund Request</span>
                        </h3>
                    </div>


                    <div class="card-header border-0 py-5">
                        <div class="form-group col-lg-6">
                            <div class="input-group">

                                <input type="text" class="form-control" value="" placeholder="Search Order Number">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" > <i class="flaticon-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">


                        <div class="tab-content">
                            <!--begin::Table-->


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


                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold"> Customer:</label>
                                            Jhons
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold"> Phone#:</label>
                                            3052524
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label class="font-weight-bold"> Address:</label>
                                            House 304 B Street 2
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
                                                    <tr> <td colspan="3" class="font-weight-bold"><textarea name="" class="form-control" placeholder="Write Here" > </textarea></td>  </tr>

                                                    <tr>
                                                        <td colspan="3" class="font-weight-bold">   <a href="{{ route('franchise-refund')}}" class="btn btn-warning btn-square"> Cancel </a> <button class="btn btn-danger btn-square"> Request Refund </button>  </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

        <script>
             var table = $('#kt_datatable').DataTable();

             $('#product_franchise').select2({
                    placeholder: "Select a Franchise",
            });
        </script>


@endsection
