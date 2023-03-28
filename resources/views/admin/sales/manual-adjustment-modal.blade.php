<div class="modal fade bd-example-modal-lg" id="manual_refund" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table ">
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
                                <tr class="thead-light">
                                    <th style=""> Name </th>
                                    <th style="">Qty </th>
                                    <th> Price <strong>(ZAR)</strong></th>
                                    <th> Discount <strong>(ZAR)</strong></th>
                                    <th> VAT  </th>
                                    <th> Items  </th>
                                    <th> Extras  </th>
                                </tr>
                                <tbody id="orderDetailTable">
                                </tbody>
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
                                            <td colspan="5" style="font-weight:bold;"> TAX: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Franchise Tax: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="franchise_tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Delivery Charges: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="delivery_charges"></span> ZAR </td>
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
                <div>
                    <button type="submit" class="btn btn-danger font-weight-bold  btn-square  " data-dismiss="modal"
                        aria-label="Close"> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
