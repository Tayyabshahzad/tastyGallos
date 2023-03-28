@extends('layouts.master')
@section('title', 'Franchise Create')

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
                            <a href="{{ route('admin.franchise') }}">  Franchise </a>
                        </li>
                        <li class="breadcrumb-item">
                            Create New
                        </li>
                    </ul>
                </div>
            </div>



            <form autocomplete="off" id="record_form">

            <div class="row">
                <div class="col-lg-5">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Franchise Info:</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <tr style="border-bottom: 1px dotted #ccc;">
                                            <td>Mon:</td>
                                            <td> <input type="time" class="form-control"  ></td>
                                            <td> <input type="time" class="form-control"  ></td>
                                            <td> <select class="form-control" name="param"  >
                                                    <option value="Open"> Open </option>
                                                    <option value="Close"> Close </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px dotted #ccc;">
                                            <td class="font-weight-bold">Tue:</td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td>
                                                <select class="form-control" name="param"  >
                                                    <option value="Open"> Open </option>
                                                    <option value="Close"> Close </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px dotted #ccc;">
                                            <td class="font-weight-bold">Wed:</td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td >
                                                <select class="form-control" name="param"  >
                                                    <option value="Open"> Open </option>
                                                    <option value="Close"> Close </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px dotted #ccc;">
                                            <td class="font-weight-bold">Thu:</td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td >
                                                <select class="form-control" name="param"  >
                                                    <option value="Open"> Open </option>
                                                    <option value="Close"> Close </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px dotted #ccc;">
                                            <td class="font-weight-bold">Fri:</td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td >
                                                <select class="form-control" name="param"  >
                                                    <option value="Open"> Open </option>
                                                    <option value="Close"> Close </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px dotted #ccc;">
                                            <td class="font-weight-bold">Sat:</td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td >
                                                <select class="form-control" name="param"  >
                                                    <option value="Open"> Open </option>
                                                    <option value="Close"> Close </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px dotted #ccc;">
                                            <td class="font-weight-bold">Sun:</td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td> <input type="time" class="form-control"  >  </td>
                                            <td  >
                                                <select class="form-control" name="param"  >
                                                    <option value="Open"> Open </option>
                                                    <option value="Close"> Close </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <b> Upload Banner (750x1000 px) <span class="text-danger">*</span> </b>
                                                <br>
                                                <div class="image-input image-input-empty image-input-outline mt-5" id="kt_image_5"
                                                style="background-image: url(https://reactnativecode.com/wp-content/uploads/2018/02/Default_Image_Thumbnail.png)">
                                                <div class="image-input-wrapper"></div>

                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change"
                                                    data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="profile_avatar_remove" />
                                                </label>

                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel"
                                                    data-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>

                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove"
                                                    data-toggle="tooltip" title="Remove avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Franchise Details:</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div  class="row">
                                        <div class="form-group col-lg-12" >
                                            <input type="text" class="form-control"  placeholder="Name "/>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div  class="row">
                                        <div class="form-group col-lg-12" >
                                            <input type="text" class="form-control"  placeholder="Telephone "/>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div  class="row">
                                        <div class="form-group col-lg-12" >
                                            <input type="text" class="form-control"  placeholder="VAT Number "/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div  class="row">
                                        <div class="form-group col-lg-12" >
                                            <input type="email" class="form-control"  placeholder="Contact Email "/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div  class="row">
                                        <div class="form-group col-lg-12" >
                                            <input type="text" class="form-control"  value="Franchise ID:12524 " disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div  class="row">
                                        <div class="form-group col-lg-12" >
                                            <input type="text" class="form-control"  placeholder="Address: Google Address "/>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group col-lg-6" >
                                    Standard Delivery <br/>Charge:
                                </div>
                                <div class="form-group col-lg-6" >
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ZAR</span>
                                        </div>
                                        <input type="text" class="form-control" value="50,00">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12" >
                                    <div class="form-group row">

                                        <div class="col-9 col-form-label">
                                            <div class="checkbox-inline">
                                                <label class="checkbox checkbox-danger">
                                                    <input type="checkbox" name="Checkboxes5" checked="checked"/>
                                                    <span></span>
                                                    Pickup
                                                </label>
                                                <label class="checkbox checkbox-danger">
                                                    <input type="checkbox" name="Checkboxes5"  />
                                                    <span></span>
                                                    Delivery
                                                </label>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12" >
                                    <textarea class="form-control" placeholder="About Franchise"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div  class="row">
                                        <div class="form-group col-lg-12" >
                                            <h3 class="card-label" style="font-size:15px;color:#000"> Delivery Time Estimate:</h3>
                                        </div>
                                    </div>
                                </div>








                            <div class="form-group col-lg-6" >
                                    <label> Busy Time </label>
                                    <select name="" id="" class="form-control">
                                        <option value=""> 15 Mins </option>
                                        <option value=""> 30 Mins </option>
                                        <option value=""> 45 Mins </option>
                                        <option value=""> 60 Mins </option>
                                        <option value=""> 75 Mins </option>
                                        <option value=""> 90 Mins </option>
                                    </select>

                            </div>
                            <div class="form-group col-lg-6" >
                                <label> Free Time </label>
                                <select name="" id="" class="form-control">
                                    <option value=""> 15 Mins </option>
                                    <option value=""> 30 Mins </option>
                                    <option value=""> 45 Mins </option>
                                    <option value=""> 60 Mins </option>
                                    <option value=""> 75 Mins </option>
                                    <option value=""> 90 Mins </option>
                                </select>
                            </div>

                            </div>

                        </div>


                    </div>
                </div>


                <div class="col-xl-3 col-lg-4 col-md-6">
                    <!--begin::Mixed Widget 19-->
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Franchise Admin:</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-content row">
                                        <div class="form-group col-lg-12" >
                                            <input type="text" class="form-control"  placeholder="Name"/>
                                        </div>

                                        <div class="form-group col-lg-12" >
                                            <input type="email" class="form-control"  placeholder="Email"/>
                                        </div>

                                        <div class="form-group col-lg-12" >
                                            <a  href="{{ route('admin.franchise') }}" class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                            <button type="reset" class="btn btn-danger btn-square"> Add Franchise </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </form>

    </div>
</div>
</div>


@endsection
@section('page_js')
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>

    <script src="{{ asset('design/assets/js/pages/crud/file-upload/image-input.js') }}"></script>
    <script>
        var avatar5 = new KTImageInput('kt_image_5');
    </script>

    <script>




    </script>


@endsection
