{{-- <div class="modal fade bd-example-modal-lg" id="refundDetails" data-backdrop="static"  tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Refund Detail</h5>
                <button type="button" id="cancleRequestBtn" class="btn-sm btn btn-danger font-weight-bold btn-square"  data-toggle="modal" data-target="#cancleRequest">
                    Reject Refund
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table ">
                                <input type="hidden"   id="refund_id">
                                <input type="hidden"   id="order_id">

                                <tr>
                                    <th style="">Order Number: </th>
                                    <td id="order_number"></td>
                                    <th style="">Customer: </th>
                                    <td id="customer_name"></td>
                                </tr>

                                <tr>
                                    <th style="">Order Status: </th>
                                    <td id="order_status"></td>
                                    <th style="">Phone: </th>
                                    <td id="customer_phone"></td>
                                </tr>

                                <tr>
                                    <th style="">Type: </th>
                                    <td id="order_type"></td>
                                    <th style="">Address: </th>
                                    <td id="customer_address"></td>
                                </tr>

                                <tr>
                                    <th style="">Date: </th>
                                    <td id="order_date"  ></td>
                                    <th style="">Refund Status: </th>
                                    <td id="refund_status"  ></td>
                                </tr>



                            </table>
                            <table class="table table-head-custom table-checkable dataTable" id="">
                                <tr class="thead-light">
                                    <th style=""> Name </th>
                                    <th style=""> Qty </th>
                                    <th class=""> Price (ZAR)</th>
                                    <th class=""> Items</th>
                                </tr>
                                <tbody id="orderDetails">
                                </tbody>

                                <tfoot>
                                    <tr class="text-right">
                                        <td colspan="4" style="font-weight:bold;"> Subtotal: <span id="subTotal"></span> ZAR </td>
                                    </tr>
                                    <tr class="text-right">
                                        <td colspan="4" style="font-weight:bold;border-top:none;"> Extras: <span id="extrasTotal"></span> ZAR</td>
                                    </tr>
                                    <tr class="text-right">
                                        <td colspan="4" style="font-weight:bold;border-top:none;"> Total: <span id="total"></span> ZAR</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" style="border-top:none;">
                                           <label  for="">Refund reason </label>
                                          <textarea   disabled  class="form-control" id="refund_reason" ></textarea>
                                        </th>
                                    </tr>
                                    <tr id="cancelReason"></tr>

                                </tfoot>



                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-warning font-weight-bold  btn-square modalClose " data-dismiss="modal"
                        aria-label="Close"> Close</button>
                    <button type="button" class="btn btn-danger font-weight-bold  btn-square issue_refund"
                    aria-label="Close"> Approve Refund</button>
                </div>
            </div>
        </div>
    </div>
</div> --}}



<div class="modal fade bd-example-modal-lg" id="refundDetails" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Refund Detail</h5>
                <button type="button" id="cancleRequestBtn" class="btn-sm btn btn-danger font-weight-bold btn-square"  data-toggle="modal" data-target="#cancleRequest">
                    Reject Refund
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table ">
                                <input type="hidden"   id="refund_id">
                                <input type="hidden"   id="order_id">
                                <tr>
                                    <th style="">Date: </th>
                                    <td id="order_date"  ></td>
                                    <th style="">Refund Status: </th>
                                    <td id="refund_status"  ></td>
                                </tr>
                                <tr>
                                    <th style="">Order Number </th>
                                    <td id="order_number"></td>
                                    <th style="">Customer </th>
                                    <td id="order_user"></td>
                                </tr>
                                <tr>
                                    <th style="">Status </th>
                                    <td id="order_Status"></td>
                                    <th style="">Phone </th>
                                    <td id="order_phonenumber"></td>
                                </tr>
                                <tr>
                                    <th style="">Type </th>
                                    <td id="order_type"></td>
                                    <th style="">Address: </th>
                                    <td id="order_address"></td>
                                </tr>
                                <tr>
                                    <th style="" >Payment Method: </th> <td style="" id="paymentMethod"></td>
                                    <th style="" >Building: </th> <td style="" id="building"></td>
                                </tr>
                                <tr>
                                    <th style="">Order Note: </th>
                                    <td id="order_note"style="color:#ee2d41"></td>
                                    <th style="">Appartment / Floor: </th>
                                    <td id="appartment"style=""></td>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <th style="" colspan="4"> Promotions: </th>
                                </tr>
                                <tr>
                                    <td style="" colspan="4">
                                            <ul id="promotion_ul">

                                            </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="order_note"colspan="4" style="color:#ee2d41"></td>
                                </tr>
                            </table>
                            <table class="table table-head-custom table-checkable dataTable" id="">

                               <thead>
                                    <tr class="thead-light">
                                        <th colspan="7" class="text-center">
                                            Order products
                                        </th>
                                    </tr>
                                    <tr class="thead-light">
                                        <th style=""> Name </th>
                                        <th style="">Qty </th>
                                        <th> Price <strong>(ZAR)</strong></th>
                                        <th> Discount <strong>(ZAR)</strong></th>
                                        <th> VAT </th>
                                        <th> Items  </th>
                                        <th> Extras  </th>
                                    </tr>
                               </thead>
                                <tbody id="orderDetailTable">
                                </tbody>
                                <thead>
                                    <tr class="thead-light">
                                        <th style="" colspan="7" class="text-center"> ORDER DEALS PRODUCTS </th>
                                    </tr>
                                    <tr class="thead-light">
                                        <td colspan="3">
                                           <b>Deals</b> <hr>
                                           <ul id="dealList">
                                           </ul>
                                        </td>
                                        <td colspan="2">
                                           <b>Extras</b> <hr>
                                           <ul id="extraList">
                                           </ul>
                                        </td>
                                        <td colspan="2">
                                           <b>Modifier</b> <hr>
                                           <ul id="modifierList">
                                           </ul>
                                        </td>
                                   </tr>
                                </thead>

                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="7" class="text-center">
                                            Bogo Products
                                        </th>
                                    </tr>
                                    <tr class="thead-light">
                                        <th style="" colspan="5"> Get Product </th>
                                        <th style="" colspan="5"> Free Product </th>
                                    </tr>
                                </thead>
                                <thead id="bogoProduct">
                                </thead>
                                <thead>
                                    <tr>
                                        <th colspan="7" style="border-top:none;">
                                            <label for=""> Refund Reason</label>
                                          <textarea   disabled  class="form-control" id="refund_reason" style="border-radius: 0" ></textarea>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="cancelReasonTh" style="">
                                            <label for=""> Cancel Reason </label>
                                            <textarea name="" class="form-control cancelReason"  style="border-radius: 0" disabled></textarea>
                                        </th>
                                    </tr>

                                </thead>
                                <tfoot>
                                    <table align="right" >
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Sub Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="subTotal"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right discountTr">
                                            <td colspan="5" style="font-weight:bold;"> Discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="discount"></span></td>
                                        </tr>
                                        <tr class="text-right afterDiscountTr">
                                            <td colspan="5" style="font-weight:bold;"> Total after discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="totalAfterDiscount"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Items Extra: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="extrasTotal"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Extras: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="extras"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Grand Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="grandTotal"></span> ZAR </td>
                                        </tr>

                                    </table>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-warning font-weight-bold  btn-square modalClose " data-dismiss="modal"
                            aria-label="Close"> Close</button>
                        <button type="button" class="btn btn-danger font-weight-bold  btn-square issue_refund"  aria-label="Close"> Approve Refund</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


