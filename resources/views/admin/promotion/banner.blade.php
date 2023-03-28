@extends('layouts.master')
@section('title', 'Promotion Banner')
@section('page_head')
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
        <style>
            .border-danger{
                border:1px solid rgb(240, 104, 104);

            }
        </style>
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
                        <a href="{{ route('admin.promotions') }}"> Promotion </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Promotion Banner</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label"> All Banners</h3>
                        </div>

                        <div class="card-toolbar">
                            <a href="#" class="btn   btn-danger btn-square addNewButton" data-toggle="modal"
                            data-target="#addBanner"> Add New </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12  ">
                                <table class="table table-separate table-head-custom table-checkable" id="contactTable">
                                    <thead>
                                        <tr class="text-left text-uppercase">
                                            <th> #</th>
                                            <th> Title</th>
                                            <th> Status</th>
                                            <th> Action </th>

                                        </tr>
                                    </thead>
                                    @foreach ($banners as $banner )
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $banner->title }} </td>

                                        <td> {{ $banner->status }} </td>
                                        <td>  <button class="btn btn-sm btn-icon btn-light-danger btn-square orderDetail" onclick="deleteBanner({{ $banner->id }})">
                                                <i class="icon-1x text-dark-5 flaticon-delete"></i>
                                            </button> </td>
                                    </tr>
                                @endforeach
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade bd-example-modal-lg " id="addBanner" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalSizeXl" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="add_faq_form" method="post" action="{{ route('admin.promotions.banners.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label>  Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" required multiple>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label> Upload Photos<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="banner" required multiple>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-warning font-weight-bold  btn-square  "
                                data-dismiss="modal" aria-label="Close"> Close</button>
                                <button type="submit" class="btn btn-danger font-weight-bold  btn-square createFaq"> Add Banner </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@section('page_js')

    <script>

function deleteBanner(id) {
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
                var url = '{{ route('admin.promotions.banners.delete') }}';
                $.ajax({
                    url:url,
                    method:'GET',
                    data:{
                        id:id
                    },
                    success:function(response){

                        if(response.success == true){
                            toastr.success(response.message, "success");
                            location.reload();
                        }else{
                            toastr.error(response.message, "error");
                        }
                    }
                });

            }
        });
    }

    $('.addBannerButton').click(function(){
        $("#addBannerForm")[0].reset();
        $("#banner").removeClass('is-invalid');
    });


    </script>



@endsection
