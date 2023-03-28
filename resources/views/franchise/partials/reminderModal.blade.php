<div class="modal fade" id="reminder" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl" aria-hidden="true">
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

                                <ul>
                                    @if($franchise)
                                            @if($franchise->bank == null)
                                            <li>
                                                <a href="{{ route('franchise.information')}}"> Bank Name </a>
                                            </li>
                                            @endif
                                    @endif
                                   @if($franchise && $franchise->account_holder == null)
                                    <li>
                                        <a href="{{ route('franchise.information')}}">  Account Holder </a>
                                    </li>
                                    @endif
                                    @if($franchise && $franchise->branch == null)
                                    <li>
                                        <a href="{{ route('franchise.information')}}">  Branch </a>
                                    </li>
                                    @endif
                                    @if($franchise && $franchise->account_number == null)
                                    <li>
                                        <a href="{{ route('franchise.information')}}"> Account Number </a>
                                    </li>
                                    @endif
                                </ul>
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
