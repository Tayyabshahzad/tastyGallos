<div class="modal fade bd-example-modal-lg " id="editFaq" tabindex="-1" role="dialog"
aria-labelledby="exampleModalSizeXl" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <form id="edit_faq_form" method="post" action="javascript:;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit FAQ</h5>
                <div class="card-toolbar">
                    <div class="card-toolbar">
                        <input type="hidden" id="faqId">
                        <span class="switch switch-danger switch-icon switch-sm">
                            <span class="font-weight-bold">Status</span> <label class="ml-2">
                                <input type="checkbox" value="active" name="status" id="updateStatus">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group col-lg-12">

                                <label> Question</label>
                                <input type="text" class="form-control" placeholder="Enter question" id="question">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label> Answer</label>
                                <textarea class="form-control" placeholder="Enter answer" id="answer"  required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label> Position</label>
                                <input type="number" class="form-control" placeholder="Position" id="position">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="submit" class="btn btn-warning font-weight-bold  btn-square  "
                    data-dismiss="modal" aria-label="Close"> Close</button>
                    <button type="button" class="btn btn-danger font-weight-bold  btn-square updateFaq"> Update
                        FAQ</button>

                </div>
            </div>
        </form>
    </div>
</div>
</div>
