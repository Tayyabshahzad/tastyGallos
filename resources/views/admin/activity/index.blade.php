@extends('layouts.master')
@section('title', 'CMS')

@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />


@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-6">
                    <div class="col-lg-12">
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                               Activities
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">FAQ's</h3>
                                </div>
                                <div class="card-title">
                                    <a href="" class="btn btn-danger  btn-square" data-toggle="modal"
                                        data-target="#addFaq">ADD FAQ</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table" id="faqs-table">
                                    <thead>
                                        <tr>
                                            <th>  # </th>
                                            <th> Question </th>
                                            <th> Answer </th>
                                            <th> Status </th>
                                            <th> Action </th>
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




@endsection
