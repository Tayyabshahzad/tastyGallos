<div class="modal fade bd-example-modal-lg" id="payFranchise" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="edit_product_form" method="post" action="javascript:;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Detail</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <b>
                                        Please confirm by typing <span id="totalToPay" class="text-danger"></span> in following text box to confirm if payment is made.
                                    </b>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="input-group ">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text"> <b>ZAR</b></span>
                                        </div>
                                        <input type="number" class="form-control"  id="confirm_total" step="any">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="submit" class="btn btn-danger font-weight-bold  btn-square"  id="confirmPaymentBtn" > Confirm </button>
                        &nbsp;
                        <button type="submit" class="btn btn-warning font-weight-bold  btn-square closeModal" data-dismiss="modal" aria-label="Close"> Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="invalidPayment" tabindex="-1" role="dialog"
aria-labelledby="exampleModalSizeXl" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Error! </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Amount you have entered did not match. Please reduce date range to fetch small amount.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-square " data-dismiss="modal">Close</button>

        </div>
    </div>
</div>
</div>
