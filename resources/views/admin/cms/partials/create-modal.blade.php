<div class="modal fade bd-example-modal-lg " id="addFaq" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalSizeXl" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="add_faq_form" method="post" action="javascript:;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <span class="switch switch-danger switch-icon switch-sm">
                                    <span class="font-weight-bold">Status</span> <label class="ml-2">
                                        <input type="checkbox" value="active" checked="checked" name="status" id="status">
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
                                        <label> Question<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter question" id="newQuestion"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label> Answer<span class="text-danger">*</span></label>
                                        <textarea class="form-control" placeholder="Enter answer" id="newAnswer"  required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-warning font-weight-bold  btn-square  "
                                data-dismiss="modal" aria-label="Close"> Close</button>
                                <button type="submit" class="btn btn-danger font-weight-bold  btn-square createFaq"  > Create
                                    FAQ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
