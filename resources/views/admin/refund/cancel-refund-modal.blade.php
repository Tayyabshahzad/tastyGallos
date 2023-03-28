<div class="modal fade" id="cancleRequest" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="cancelRefundFrom">
                    <div class="form-group">
                        <div class=" ">
                            <label for="refund_reason" class="text-dark-75 font-weight-bolder d-block ">Refund Reason </label>
                            <input type="hidden" value="" id="cancel_refund_id">
                            <textarea name="" class="form-control" id="cancel_refund_reason" placeholder="Enter refund reason"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning font-weight-bold  btn-square  modalClose" data-dismiss="modal"
                aria-label="Close"> Close</button>
            <button type="button" class="btn btn-danger font-weight-bold  btn-square refundCancelBtn"  aria-label="Close"> Cancel Refund</button>
            </div>
        </div>
    </div>
</div>
