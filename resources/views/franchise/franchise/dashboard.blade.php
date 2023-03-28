@extends('layouts.franchise.master')
@section('title', 'Franchise Dashboard')
@section('content')


    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-12">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">



            <div class="col-xl-12">
                <div class="card-body d-flex flex-column">
                    <div class="  text-right flex-grow-1">

                        <a  href="{{ route('franchise-orders')}}" class="btn btn-danger btn-square"> All Orders </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">


            <div class="col-xl-4">
                <div class="card card-custom     bg-light-warning"  style="height: 200px;" data-toggle="modal" data-target="#orderDetail" >
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Order </h3>
                                <div class="text-muted font-size-lg mt-2">#1233  </div>
                            </div>


                            <div class="font-weight-boldest font-size-h1  ">

                                <div class="mr-2">
                                    <h3 class="font-weight-bolder">Time </h3>
                                    <div class="text-muted font-size-lg mt-2"> 00:30  </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">3 </h3>
                                <div class="text-muted font-size-lg mt-2">Items Order  </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Body-->
                </div>
            </div>


            <div class="col-xl-4">
                <div class="card card-custom     bg-light-danger"  style="height: 200px;" data-toggle="modal" data-target="#orderDetail" >
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Order </h3>
                                <div class="text-muted font-size-lg mt-2">#1233  </div>
                            </div>


                            <div class="font-weight-boldest font-size-h1  ">

                                <div class="mr-2">
                                    <h3 class="font-weight-bolder">Time </h3>
                                    <div class="text-muted font-size-lg mt-2"> 00:30  </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">3 </h3>
                                <div class="text-muted font-size-lg mt-2">Items Order  </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Body-->
                </div>
            </div>



            <div class="col-xl-4">
                <div class="card card-custom bg-light-primary"  style="height: 200px;" data-toggle="modal" data-target="#orderDetail" >
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Order </h3>
                                <div class="text-muted font-size-lg mt-2">#1233  </div>
                            </div>


                            <div class="font-weight-boldest font-size-h1  ">

                                <div class="mr-2">
                                    <h3 class="font-weight-bolder">Time </h3>
                                    <div class="text-muted font-size-lg mt-2"> 00:30  </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">3 </h3>
                                <div class="text-muted font-size-lg mt-2">Items Order  </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Body-->
                </div>
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
                        <div class="col-lg-6 text-left">   <button type="submit" class="btn btn-danger font-weight-bold  btn-square "> Complete Order</button> </div>
                        <div class="col-lg-6 text-right">  <button type="submit" class="btn btn-warning font-weight-bold  btn-square  "   data-dismiss="modal" aria-label="Close"> Refund</button> </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('page_js')


    <script>

            $('#kt_select2_1').select2({
                     placeholder: "Select a Franchise"
            });


    </script>


@endsection
