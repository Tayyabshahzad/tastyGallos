@extends('layouts.master')
@section('title', 'Dashboard')
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



            <div class="col-xl-6">
                <div class="card card-custom gutter-b" >
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class=" align-items-center justify-content-between ">
                            <div class="mr-2">
                                <select class="form-control select2 " id="franchise" name="franchise">
                                    <option value="0"> All Franchises </option>
                                    @foreach ($franchises as $franchise )
                                            <option value="{{ $franchise->id }}">   {{ $franchise->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-custom gutter-b wave wave-animate-slow wave-warning" >
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">My Commission  </h3>
                            </div>
                            <div class="font-weight-boldest font-size-h1 text-info" >  ZAR  <span id="adminCommison"> {{ $adminCommission }} </span></div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4">
                <div class="card card-custom gutter-b wave wave-animate-slow wave-primary"  style="height: 200px;">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Total Orders </h3>
                                <div class="text-muted font-size-lg mt-2">All Orders  </div>
                            </div>
                            <div class="font-weight-boldest font-size-h1 text-info totalOrders "> {{ $totalOrders }} </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-custom gutter-b wave wave-animate-slow wave-info" style="height: 200px;">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Total Customers </h3>
                                <div class="text-muted font-size-lg mt-2"> Number of Customers    </div>
                            </div>
                            <div class="font-weight-boldest font-size-h1 text-warning"> {{ $totalCustomers }} </div>
                        </div>

                    </div>
                    <!--end::Body-->
                </div>
            </div>



            <div class="col-xl-4">
                <div class="card card-custom gutter-b wave wave-animate-slow wave-danger" style="height: 200px;">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Total Products </h3>
                                <div class="text-muted font-size-lg mt-2"> All System Products </div>
                            </div>
                            <div class="font-weight-boldest font-size-h1 text-success"> {{ $totalProducts }} </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between flex-grow-1">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder"> Inactive Products </h3>
                                <div class="text-muted font-size-lg mt-2"> All Inactivated products </div>
                            </div>
                            <div class="font-weight-boldest font-size-h1 text-success" id="totalActiveProducts"> {{ $specialPrice }} </div>
                        </div>


                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-4" >
                <!--begin::Mixed Widget 14-->
                <div class="card card-custom card-stretch gutter-b wave wave-animate-slow wave-primary">

                    <div class="card-body d-flex flex-column">
                        <div class="flex-grow-1" style="position: relative;">
                            <div id="kt_mixed_widget_14_chart" style="height: 200px; min-height: 178.7px;">
                                <div id="apexchartszib8rtf4" class="apexcharts-canvas apexchartszib8rtf4 apexcharts-theme-light" style="width: 354.828px; height: 178.7px;">
                                        <svg id="SvgjsSvg1342" width="354.828" height="178.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                            <g id="SvgjsG1344" class="apexcharts-inner apexcharts-graphical" transform="translate(90.41399999999999, 0)">
                                                <defs id="SvgjsDefs1343">
                                                    <clipPath id="gridRectMaskzib8rtf4">
                                                        <rect id="SvgjsRect1346" width="182" height="200" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="gridRectMarkerMaskzib8rtf4">
                                                        <rect id="SvgjsRect1347" width="180" height="202" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                            <g id="SvgjsG1348" class="apexcharts-radialbar">
                                                <g id="SvgjsG1349">
                                                    <g id="SvgjsG1350" class="apexcharts-tracks">
                                                        <g id="SvgjsG1351" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                                            <path id="apexcharts-radialbarTrack-0" d="M 88 26.60792682926828 A 61.39207317073172 61.39207317073172 0 1 1 87.98928506193984 26.607927764323023" fill="none" fill-opacity="1" stroke="rgba(201,247,245,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.97439024390244" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 88 26.60792682926828 A 61.39207317073172 61.39207317073172 0 1 1 87.98928506193984 26.607927764323023"></path>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1353">
                                                        <g id="SvgjsG1357" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath1358" d="M 88 26.60792682926828 A 61.39207317073172 61.39207317073172 0 1 1 26.757474833957374 92.28249454023158" fill="none" fill-opacity="0.85" stroke="rgba(27,197,189,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.97439024390244" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="266" data:value="74" index="0" j="0" data:pathOrig="M 88 26.60792682926828 A 61.39207317073172 61.39207317073172 0 1 1 26.757474833957374 92.28249454023158"></path>
                                                        </g>
                                                        <circle id="SvgjsCircle1354" r="56.9048780487805" cx="88" cy="88" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                                                        <g id="SvgjsG1355" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;">
                                                            <text id="SvgjsText1356" font-family="Helvetica, Arial, sans-serif" x="88" y="100" text-anchor="middle" dominant-baseline="auto" font-size="30px" font-weight="700" fill="#5e6278" class="apexcharts-text apexcharts-datalabel-value franchise_earning" style="font-family: Helvetica, Arial, sans-serif;">
                                                                 {{ $franchise_earning -  $adminCommission }}  </text>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                            <line id="SvgjsLine1359" x1="0" y1="0" x2="176" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                            <line id="SvgjsLine1360" x1="0" y1="0" x2="176" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                        </g>
                                        <g id="SvgjsG1345" class="apexcharts-annotations"></g>
                                    </svg>
                                        <div class="apexcharts-legend"></div>
                                    </div>
                            </div>
                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 356px; height: 243px;"></div></div><div class="contract-trigger"></div></div></div>
                        <div class="pt-5">
                            <p class="text-center font-weight-normal font-size-lg pb-7"> Franchise Earning In<b> ZAR  <span class="franchise_earning"> {{ $franchise_earning -  $adminCommission }} </span>  </b> </p>

                        </div>
                    </div>


                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 14-->
            </div>
            <div class="col-lg-8">
                <!--begin::Advance Table Widget 4-->
                <div class="card card-custom card-stretch gutter-b    wave wave-primary card-stretch gutter-b wave-animate-slow">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Recent Orders</span>

                        </h3>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3 ">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th> <span class="text-dark-75">Order Number </span>  </th>
                                            <th> <span class="text-dark-75"> Type </span> </th>
                                            <th> <span class="text-dark-75"> Customer </span> </th>
                                            <th> <span class="text-dark-75"> Franchise </span> </th>
                                            <th> <span class="text-dark-75"> Order Date </span> </th>
                                            <th> <span class="text-dark-75"> Amount </span> </th>

                                        </tr>
                                    </thead>
                                    <tbody id="recentOrders">
                                        @foreach ($lastOrders as $lastOrder )
                                        <tr>
                                            <td> <span class="text-dark-75 font-weight-bolder d-block  "> <a href="#">  {{ $lastOrder->order_number }} </a></span> </td>
                                            <td>  <span class="text-dark-75 font-weight-bolder d-block "> {{ $lastOrder->type }} </span>  </td>
                                            <td>  <span class="text-dark-75 font-weight-bolder d-block ">  <a href="{{ route('admin.users.edit',$lastOrder->user->id )}}">   {{ $lastOrder->user->name }}  </a></span> </td>
                                            <td>  <span class="text-dark-75 font-weight-bolder d-block ">  <a href="{{ route('admin.franchises.edit',$lastOrder->franchise->id)}}"> {{$lastOrder->franchise->name}} </a> </span>  </td>
                                            <td>  <span class="text-dark-75 font-weight-bolder d-block ">
                                                {{ \Carbon\Carbon::parse( $lastOrder->created_at )->format('d-M-Y h:i A ') }}
                                                 </span> </td>
                                            <td> <span class="text-dark-75 font-weight-bolder d-block "> <sup>ZAR</sup>  {{ $lastOrder->grandTotal }} </span> </td>

                                        </tr>
                                        @endforeach

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

@endsection
@section('page_js')


    <script>

            $('#franchise').select2({
                     placeholder: "Select a Franchise"
            });

            $('#franchise').on('change',function(){
                    var franchsie = $('#franchise').val();

                $.ajax({
                url: "{{ route('admin.dashboard') }}",
                method: 'get',
                data: {
                    franchsie: franchsie,
                },
                success: function (data) {
                    $('#recentOrders').html('');
                    var RecentOrders = '';
                    $.each(data.lastOrders, function (key, order) {
                        RecentOrders +=
                            `<tr>
                                <td>  <span class="text-dark-75 font-weight-bolder d-block"> <a href="#"> ${order.order_number} </a>  </span> </td>
                                <td>  <span class="text-dark-75 font-weight-bolder d-block"> ${order.type}  </span> </td>
                                <td>  <span class="text-dark-75 font-weight-bolder d-block"> <a href="{{ route('admin.users.edit') }}/${order.user.id}"> ${order.user.name} </a>  </span>  </td>
                                <td>  <span class="text-dark-75 font-weight-bolder d-block"> <a href="{{ route('admin.franchises.edit') }}/${order.franchise.id}"> ${order.franchise.name} </a> </span> </td>
                                <td>  <span class="text-dark-75 font-weight-bolder d-block"> ${order.order_date} </span> </td>
                                <td>  <span class="text-dark-75 font-weight-bolder d-block"> <sup>ZAR</sup> ${order.total} </span> </td>
                            </tr>`;
                    });

                    $('#adminCommison').html(data.adminCommission);
                    $('.franchise_earning').html(data.franchise_earning - data.adminCommission);
                    $('.totalOrders').html(data.totalOrders);
                    $('#recentOrders').append(RecentOrders);
                    $('#totalActiveProducts').html(data.specialPrice);

                  //  $('#orderDetailTable').html(orderDtails);

                },
            });

            });


    </script>








@endsection
