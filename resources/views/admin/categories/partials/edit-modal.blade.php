<div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <form id="edit_category_form" method="post" action="{{ route('admin.categories.update') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        @csrf
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <span class="switch switch-danger switch-icon switch-sm">
                                    <span class="font-weight-bold">Status</span> <label class="ml-2">
                                        <input type="checkbox" value="active" name="status" id="edit_status">
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
                                        <label> Category Name:</label>
                                        <input type="hidden" class="form-control" name="id" id="categoryid">
                                        <input type="text" class="form-control" name="name" id="categoryName">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-warning font-weight-bold  btn-square  "
                            data-dismiss="modal" aria-label="Close"> Close</button>

                            <button type="button" class="btn btn-danger font-weight-bold  btn-square" id="updateCategory"> Update
                                Category</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
