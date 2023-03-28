<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
        <form id="addCategoryForm" method="post" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>


                <div class="card-toolbar">
                    <div class="card-toolbar">
                        <span class="switch switch-danger switch-icon switch-sm">
                            <span class="font-weight-bold">Status</span> <label class="ml-2">
                                <input type="checkbox" id="check_id"  value="1" checked name="status"  >
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>


            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-lg-12">
                    <div class="row">
                        <div class="form-group col-lg-12">

                            <label> Category ID:</label>
                            <input type="text" class="form-control" disabled value="1">
                        </div>
                    </div>
                </div> --}}
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label> Name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter category name" required id="category">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>

                    <button type="button" class="btn btn-warning font-weight-bold  btn-square" data-dismiss="modal" aria-label="Close"> Close</button>
                    <button type="button" class="btn btn-danger font-weight-bold  btn-square" id="addCategory"> Add Category</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
