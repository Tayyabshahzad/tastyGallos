<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('design/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('design/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('design/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('design/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('design/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('design/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('design/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('design/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('design/assets/media/banners/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />



    <style>
        .paginate_button.page-item.active a {
            background-color: #f64e60 !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item:hover:not(.disabled)>.page-link {
            background-color: #f64e60 !important;
        }

        .checkbox>input:checked~span {
            background-color: #f64e60;
        }

        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading .menu-icon.svg-icon svg g [fill],
        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link .menu-icon.svg-icon svg g [fill] {
            fill: #f64e60 !important
        }

        .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-heading .menu-icon.svg-icon svg g [fill],
        .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-link .menu-icon.svg-icon svg g [fill] {
            fill: #f64e60 !important;
        }

        .image-input-wrapper {
            background-position: center center !important;
        }

        table tr td {
            text-transform: capitalize;
        }

        .ki-close:hover {
            color: #f64e60 !important;
        }

        button {
            text-transform: capitalize !important;
        }

        .orderNumber {
            cursor: pointer;
        }
        .text-black{
            color: #000000!important;
        }

    </style>
    @section('page_head')
    @show
    <title> @yield('title') | Tasty Gallos </title>
</head>

<body id="kt_body"
    class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <a href=" ">
            <img width="40" alt="Logo" src="{{ asset('design/assets/media/banners/Logochhwhite.png') }}" />
        </a>
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    <a href="" class="brand-logo text-center">
                        <img width="90" alt="Logo"
                            src="{{ asset('design/assets/media/banners/Logochhwhite.png') }}" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1" id="svgIcon"
                                style="display: block">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                        </span>
                    </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->
                @include('layouts.aside-menu')
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <!--begin::Header-->
                    <div id="kt_header" class="header header-fixed">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <!--begin::Header Menu Wrapper-->
                            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <!--begin::Header Menu-->
                                <div id="kt_header_menu"
                                    class="header-menu header-menu-mobile header-menu-layout-default">
                                    <!--begin::Header Nav-->
                                    <ul class="menu-nav">

                                    </ul>
                                    <!--end::Header Nav-->
                                </div>
                                <!--end::Header Menu-->
                            </div>
                            <!--end::Header Menu Wrapper-->
                            <!--begin::Topbar-->
                            <div class="topbar">
                                <!--begin::Search-->

                                <!--end::Search-->
                                <!--begin::Notifications-->
                                <div class="dropdown">
                                    <!--begin::Toggle-->
                                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px"
                                        aria-expanded="false">
                                        <div id="notificationContainer"
                                            class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1  pulse-primary">
                                            <span class="svg-icon svg-icon-xl svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                            fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="pulse-ring"></span>
                                        </div>
                                    </div>
                                    <!--end::Toggle-->
                                    <!--begin::Dropdown-->
                                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg"
                                        style="">
                                        <form>
                                            <!--begin::Header-->
                                            <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top"
                                                style="background-image: url({{ asset('design/assets/media/misc/bg-1.jpg') }}">
                                                <!--begin::Title-->
                                                <h4 class="d-flex flex-center rounded-top">
                                                    <span class="text-white">Orders Notifications</span>
                                                    <span
                                                        class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">
                                                        {{ Auth::user()->unreadnotifications->count() }}
                                                        new</span>
                                                </h4>
                                                <!--end::Title-->
                                                <!--begin::Tabs-->
                                                <ul class=" nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8"
                                                    role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" data-toggle="tab"
                                                            href="#topbar_notifications_notifications">Orders</a>
                                                    </li>

                                                </ul>
                                                <!--end::Tabs-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Content-->
                                            <div class="tab-content">
                                                <!--begin::Tabpane-->
                                                <div class="tab-pane active show p-8"
                                                    id="topbar_notifications_notifications" role="tabpanel">
                                                    <!--begin::Scroll-->
                                                    <div class="scroll pr-7 mr-n7 ps ordersContainer" data-scroll="true"
                                                        ata-height="300" data-mobile-height="200"
                                                        style="height: 300px; overflow: hidden;">
                                                        @foreach (Auth::user()->unreadnotifications as $notification)
                                                            <div class="d-flex align-items-center mb-6">
                                                                <div class="symbol symbol-40 symbol-light-primary mr-5">
                                                                    <span class="symbol-label">
                                                                        <span
                                                                            class="svg-icon svg-icon-lg svg-icon-primary">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                width="24px" height="24px"
                                                                                viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1"
                                                                                    fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24"
                                                                                        height="24" />
                                                                                    <path
                                                                                        d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z"
                                                                                        fill="#000000" opacity="0.3" />
                                                                                    <path
                                                                                        d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z"
                                                                                        fill="#000000" />
                                                                                </g>
                                                                            </svg>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                <div class="d-flex flex-column font-weight-bold">

                                                                    <span
                                                                        class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                        #{{ $notification->data['order_number'] }}&nbsp;&nbsp;
                                                                        <b class="orderNumber text-danger text-dark-5 updateOrderNotification"
                                                                            title="Decline Order Request?"
                                                                            data-id='{{ $notification->data['order_id'] }}'
                                                                            data-notification='{{ $notification->id }}'
                                                                            data-value='decline'>
                                                                            Decline
                                                                        </b>
                                                                        &nbsp; - &nbsp;
                                                                        <b class="orderNumber text-success text-dark-5 updateOrderNotification"
                                                                            title="Approve Order Request?"
                                                                            data-id='{{ $notification->data['order_id'] }}'
                                                                            data-notification='{{ $notification->id }}'
                                                                            data-value='approve'>
                                                                            Approve
                                                                        </b>

                                                                    </span>
                                                                    <span
                                                                        class="text-muted">{{ $notification->data['franchise'] }}
                                                                        Franchise got new order</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                            <!--end::Content-->
                                        </form>
                                    </div>
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Notifications-->
                                <!--begin::Quick Actions-->
                                <div class="dropdown">
                                    <!--begin::Toggle-->
                                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px"
                                        aria-expanded="false">
                                        <strong> {{ Auth::user()->name }} &nbsp;</strong>
                                        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                            <span class="svg-icon svg-icon-xl svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                @if (Auth::user()->getFirstMediaUrl('profile_photo', 'thumb') != '')
                                                    <img class="h-20px w-20px rounded-sm"
                                                        src="{{ Auth::user()->getFirstMediaUrl('profile_photo', 'thumb') }}"
                                                        alt="{{ Auth::user()->name }} Photo">
                                                @else
                                                    <img class="h-20px w-20px rounded-sm"
                                                        src="{{ asset('design/assets/media/dummy.png' . Auth::user()->photo) }}"
                                                        alt="{{ Auth::user()->name }} Photo">
                                                @endif
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Toggle-->
                                    <!--begin::Dropdown-->
                                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-sm"
                                        style="">
                                        <!--begin:Header-->
                                        <ul class="navi navi-hover py-4">
                                            <li class="navi-item">
                                                    @hasrole('admin')
                                                        <a href="{{ route('admin.settings') }}" class="navi-link">
                                                    @endrole
                                                    @hasrole('franchise')
                                                        <a href="{{ route('franchise.profile') }}"
                                                            class="navi-link">
                                                        @endrole
                                                        <span class="symbol symbol-20 mr-3">
                                                            <span
                                                                class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">
                                                                <i class="fa fa-user"></i>
                                                            </span>
                                                        </span>
                                                        <span class="navi-text">Profile</span>
                                                    </a>
                                            </li>
                                            <li class="navi-item">
                                                <a class="navi-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                    <span class="symbol symbol-20 mr-3">
                                                        <span
                                                            class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">
                                                            <i class="fas fa-power-off"></i>
                                                        </span>
                                                    </span>
                                                    <span class="navi-text" id="logout-btn">Logout</span>
                                                    <form id="logout-form" action="{{ route('logout') }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                    <!--end::Dropdown-->
                                </div>



                                <!--end::User-->
                            </div>
                            <!--end::Topbar-->
                        </div>

                        <!--end::Container-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Section-->
                        @section('content')
                        @show
                        <!--end::Section-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        @role('admin')
                            @php
                                $src = route('admin.dashboard');
                            @endphp
                        @else
                            @php
                                $src = route('franchise.dashboard');
                            @endphp
                        @endrole

                        <div
                            class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                Made by
                                <a href="https://tastygallos.com/" class="text-dark-75 text-hover-primary"> Tasty
                                    Gallos SA </a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Nav-->
                            <div class="nav nav-dark">
                                &copy; All rights reserved by&nbsp;
                                <a class="text-dark-75 text-hover-primary" href="{{ $src }}">Tasty Gallos</a>
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path
                            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                            fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>
        <form id="logout_form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <script>
            var KTAppSettings = {
                "breakpoints": {
                    "sm": 576,
                    "md": 768,
                    "lg": 992,
                    "xl": 1200,
                    "xxl": 1400
                },
                "colors": {
                    "theme": {
                        "base": {
                            "white": "#ffffff",
                            "primary": "#3699FF",
                            "secondary": "#E5EAEE",
                            "success": "#1BC5BD",
                            "info": "#8950FC",
                            "warning": "#FFA800",
                            "danger": "#F64E60",
                            "light": "#E4E6EF",
                            "dark": "#181C32"
                        },
                        "light": {
                            "white": "#ffffff",
                            "primary": "#E1F0FF",
                            "secondary": "#EBEDF3",
                            "success": "#C9F7F5",
                            "info": "#EEE5FF",
                            "warning": "#FFF4DE",
                            "danger": "#FFE2E5",
                            "light": "#F3F6F9",
                            "dark": "#D6D6E0"
                        },
                        "inverse": {
                            "white": "#ffffff",
                            "primary": "#ffffff",
                            "secondary": "#3F4254",
                            "success": "#ffffff",
                            "info": "#ffffff",
                            "warning": "#ffffff",
                            "danger": "#ffffff",
                            "light": "#464E5F",
                            "dark": "#ffffff"
                        }
                    },
                    "gray": {
                        "gray-100": "#F3F6F9",
                        "gray-200": "#EBEDF3",
                        "gray-300": "#E4E6EF",
                        "gray-400": "#D1D3E0",
                        "gray-500": "#B5B5C3",
                        "gray-600": "#7E8299",
                        "gray-700": "#5E6278",
                        "gray-800": "#3F4254",
                        "gray-900": "#181C32"
                    }
                },
                "font-family": "Poppins"
            };
        </script>
        <script src="{{ asset('design/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('design/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
        <script src="{{ asset('design/assets/js/scripts.bundle.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>


        @if (Session::has('success') or Session::has('error'))
            <script>
                @if (Session::has('success'))
                    toastr.success("{{ Session::get('success') }}", "Success");
                @endif
                @if (Session::has('error'))
                    toastr.error("{{ Session::get('error') }}", "Error");
                @endif
            </script>
        @endif

        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}", "Error");
            </script>
        @endforeach
        @php
        $userID = Auth::user()->id;
    @endphp
        {{-- <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
        @php
            $userID = Auth::user()->id;
        @endphp
        <script>
            var AuthUserID = {{ $userID }};
            var firebaseConfig = {
                apiKey: "AIzaSyDwj3nPjSTAxdO96FABpwhGWVjlQxvIGjU",
                databaseURL: 'https://notificationrepo.firebaseio.com',
                authDomain: "notificationrepo.firebaseapp.com",
                projectId: "notificationrepo",
                storageBucket: "notificationrepo.appspot.com",
                messagingSenderId: "208655285787",
                appId: "1:208655285787:web:33d5812aa325a6cfdbc2be",
                measurementId: "G-TJFJWJMVEN"
            };
            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();

            function startFCM() {

                messaging
                    .requestPermission()
                    .then(function() {
                        return messaging.getToken()
                    })
                    .then(function(response) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('store.token') }}',
                            type: 'POST',
                            data: {
                                token: response
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                alert('Token stored.');
                            },
                            error: function(error) {
                                alert(error);
                            },
                        });
                    }).catch(function(error) {
                        alert(error);
                    });
            }
            messaging.onMessage(function(payload) {
                console.log(payload);
                if (payload.data.user_id == AuthUserID) {
                    $('#notificationContainer').addClass('pulse');
                    $('.ordersContainer').append(`
                    <div class="d-flex align-items-center mb-6">
                        <div class="symbol symbol-40 symbol-light-primary mr-5">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z" fill="#000000" opacity="0.3"/>
                                            <path d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                        </div>
                        <div class="d-flex flex-column font-weight-bold">
                            <span  class="text-dark text-hover-primary mb-1 font-size-lg">
                                #${payload.notification.title} &nbsp;&nbsp;
                                <b   class="orderNumber text-danger text-dark-5 updateOrderNotification" title="Decline Order Request?"
                                        data-id='${payload.notification.body}' data-value='decline' data-notification='${payload.notification.body}'>
                                        Decline
                                </b>
                                &nbsp; - &nbsp;
                                <b  class="orderNumber text-success text-dark-5 updateOrderNotification" title="Approve Order Request?"
                                        data-id='${payload.notification.body}' data-value='approve' data-notification='${payload.notification.body}'>
                                    Approve
                                </b>
                            </span>
                            <span class="text-muted">${payload.notification.icon} Franchise got new  order</span>
                        </div>
                    </div>
                `);
                }
            });
        </script>
        @if (Auth::user()->order_notification == null)
            <script>
                startFCM()
            </script>
        @endif --}}
        <script>
            $('.ordersContainer').on('click', '.updateOrderNotification', function() {
                var order_id = $(this).data('id');
                var value = $(this).data('value');
                var notification = $(this).data('notification');
                notificationUrl = "{{ route('notification.mark') }}";
                $.ajax({
                    url: notificationUrl,
                    method: 'GET',
                    data: {
                        order_id: order_id,
                        value: value,
                        notification: notification,
                    },
                    success: function(response) {
                        if (response.success == true) {
                            toastr.success(response.message, "Success");
                            $(".ordersContainer").load(" .updateOrderNotification");
                        } else {
                            toastr.error(response.message, "Error");
                        }
                        console.log(response);
                    },
                });
            });
        </script>

        {{-- <script> startFCM()</script> --}}
        @section('page_js')

        @show
        <!--End Custom JS-->
</body>

</html>
