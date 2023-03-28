<div class="modal fade bd-example-modal-lg" id="review_detail" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">


                <div class="modal-header">
                    <h5 class="modal-title">Review Details  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table  ">

                                    <tr>
                                        <th style="">Order Number </th>
                                        <td id="review_order_number"></td>
                                        <th style="">Customer</th>
                                        <td id="review_customer"></td>
                                    </tr>
                                    <tr>
                                        <th style=""> Status </th>
                                        <td id="review_order_status"></td>
                                        <th style="">Phone Number</th>
                                        <td id="review_phone"></td>
                                    </tr>
                                    <tr>
                                        <th style=""> Type </th>
                                        <td id="review_order_type"></td>
                                        <th style="">Address</th>
                                        <td id="review_address"></td>
                                    </tr>
                                    <tr>
                                        <th style="">Title </th>
                                        <td id="review_title"></td>
                                        <th style="">Comments</th>
                                        <td id="review_comments"></td>
                                    </tr>

                                    <tr>
                                        <th style="">Rating</th>
                                        <td id="review_rating" colspan="3"></td>
                                    </tr>

                                </table>

                                <table class="table table-head-custom table-checkable dataTable" id="">
                                    <tr class="thead-light">
                                        <th style=""> Name </th>
                                        <th style="">Qty </th>
                                        <th> Price <strong>(ZAR)</strong></th>
                                        <th> Items  </th>
                                    </tr>

                                    <tbody id="reviewOrderDetailTable">
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-right">
                                            <td colspan="4" style="font-weight:bold;"> Subtotal: <span id="review_subTotal"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="4" style="font-weight:bold;border-top:none;"> Extras: <span id="review_extrasTotal"></span> ZAR</td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="4" style="font-weight:bold;border-top:none;"> Total: <span id="review_total"></span> ZAR</td>
                                        </tr>
                                        {{-- <tr>
                                            <td colspan=""></td> <td colspan="">50,000</td>
                                        </tr>
                                        <tr>
                                            <td colspan=""></td> <td colspan="">50,000</td>
                                        </tr> --}}
                                                {{-- <span>Subtotal:<span id="order_ordertotal"></span> <br/>
                                                <span>Extras:<span id="order_ordertotal"></span> <br/>
                                                <span>Total:<span id="order_ordertotal"></span>
                                            </th> --}}

                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="submit" class="btn btn-danger font-weight-bold  btn-square  " data-dismiss="modal"
                            aria-label="Close"> Close</button>
                    </div>
                </div>
        </div>
    </div>
</div>
