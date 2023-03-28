{{-- <div class="modal fade bd-example-modal-lg" id="order_detail" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table ">
                                <input type="hidden" id="order_id">
                                <tr>
                                    <th style="">Order Number </th>
                                    <td id="order_ordernumber"></td>
                                    <th style="">Customer </th>
                                    <td id="order_user"></td>
                                </tr>
                                <tr>
                                    <th style="">Status </th>
                                    <td id="order_orderStatus"></td>
                                    <th style="">Phone </th>
                                    <td id="order_phonenumber"></td>
                                </tr>
                                <tr>
                                    <th style="">Type </th>
                                    <td id="order_type"></td>
                                    <th style="">Address: </th>
                                    <td id="order_orderaddress"></td>
                                </tr>
                                <tr>
                                    <th style="" colspan="4">Order Note </th>
                                </tr>
                                <tr>
                                    <td id="order_note"colspan="4" style="color:#ee2d41"></td>
                                </tr>
                            </table>
                            <table class="table table-head-custom table-checkable dataTable" id="">
                                <tr class="thead-light">
                                    <th style=""> Name </th>
                                    <th style="">Qty </th>
                                    <th> Price </th>
                                    <th> Items  </th>
                                </tr>

                                <tbody id="orderDetailTable">
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

                                        <tr class="text-left changeStatusDropDown">
                                            <td colspan="4" style="font-weight:bold;">
                                                <label for=""> Change Status</label> <br>
                                                 <select name="" id="order_status" class="form-control changeStatusDropDown">
                                                        <option value="order">
                                                            Order
                                                        </option>
                                                        <option value="preparation">
                                                            Preparation
                                                        </option>
                                                        <option value="dp">
                                                            Delivery / PickUp
                                                        </option>
                                                        <option value="dc">
                                                            Delivered / Collected
                                                        </option>
                                                        <option value="cancelled">
                                                            Cancelled
                                                        </option>


                                                 </select>
                                             </td>
                                        </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>


                    <a href="{{ route('franchise.refunds.create')}}" class="btn btn-danger font-weight-bold  btn-square refundButton"> Refund</a>
                    <button type="button" class="btn btn-warning font-weight-bold  btn-square changeStatus"> Change Status</button>


                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="modal fade bd-example-modal-lg" id="order_detail" tabindex="-1" role="dialog"
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
                                <input type="hidden" id="order_id">
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
                                    <th style="">Payment Method: </th>
                                    <td style="" id="paymentMethod"></td>
                                    <th style="">Building: </th>
                                    <td style="" id="building"></td>
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
                                    <th> Items </th>
                                    <th> Extras </th>
                                </tr>
                                <tbody id="orderDetailTable">
                                </tbody>
                                <tfoot>
                                    <table align="right">
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Sub Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="subTotal"></span>
                                                ZAR </td>
                                        </tr>
                                        <tr class="text-right discountTr">
                                            <td colspan="5" style="font-weight:bold;"> Discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="discount"></span>
                                            </td>
                                        </tr>
                                        <tr class="text-right afterDiscountTr">
                                            <td colspan="5" style="font-weight:bold;"> Total after discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="totalAfterDiscount"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Items Extra: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="extrasTotal"></span>
                                                ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Extras: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="extras"></span>
                                                ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Grand Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="grandTotal"></span>
                                                ZAR </td>
                                        </tr>

                                    </table>

                                    <tr class="text-left changeStatusDropDown">
                                        <td colspan="4" style="font-weight:bold;">
                                            <label for=""> Change Status</label> <br>
                                            <select name="" id="order_status"
                                                class="form-control changeStatusDropDown">
                                                <option value="order">
                                                    Order
                                                </option>
                                                <option value="preparation">
                                                    Preparation
                                                </option>
                                                <option value="dp">
                                                    Delivery / PickUp
                                                </option>
                                                <option value="dc">
                                                    Delivered / Collected
                                                </option>
                                                <option value="cancelled">
                                                    Cancelled
                                                </option>


                                            </select>
                                        </td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <a href="{{ route('franchise.refunds.create') }}"
                        class="btn btn-danger font-weight-bold  btn-square refundButton"> Refund</a>
                    <button type="button" class="btn btn-warning font-weight-bold  btn-square changeStatus"> Change
                        Status</button>

                </div>
            </div>
        </div>
    </div>
</div> --}}
{{--
<div class="modal fade bd-example-modal-lg" id="order_detail_real_time" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details <small>Real Time</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table ">
                                <input type="hidden" id="realTime_order_id">
                                <tr>
                                    <th style="">Order Number </th>
                                    <td id="realTime_order_number"></td>
                                    <th style="">Customer </th>
                                    <td id="realTime_order_user"></td>
                                </tr>
                                <tr>
                                    <th style="">Status </th>
                                    <td id="realTime_order_Status"></td>
                                    <th style="">Phone </th>
                                    <td id="realTime_order_phonenumber"></td>
                                </tr>
                                <tr>
                                    <th style="">Type </th>
                                    <td id="realTime_order_type"></td>
                                    <th style="">Address: </th>
                                    <td id="realTime_order_address"></td>
                                </tr>
                                <tr>
                                    <th style="">Payment Method: </th>
                                    <td style="" id="realTime_paymentMethod"></td>
                                    <th style="">Building: </th>
                                    <td style="" id="realTime_building"></td>
                                </tr>
                                <tr>
                                    <th style="">Order Note: </th>
                                    <td id="realTime_order_note"style="color:#ee2d41"></td>
                                    <th style="">Appartment / Floor: </th>
                                    <td id="realTime_appartment"style=""></td>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <th style="" colspan="4"> Promotions: </th>
                                </tr>
                                <tr>
                                    <td style="" colspan="4">
                                        <ul id="realTime_promotion_ul">
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="realTime_order_note"colspan="4" style="color:#ee2d41"></td>
                                </tr>
                            </table>
                            <table class="table table-head-custom table-checkable dataTable" id="realTime_">
                                <tr class="thead-light">
                                    <th style=""> Name </th>
                                    <th style="">Qty </th>
                                    <th> Price <strong>(ZAR)</strong></th>
                                    <th> Discount <strong>(ZAR)</strong></th>
                                    <th> Items </th>
                                    <th> Extras </th>
                                </tr>
                                <tbody id="realTime_orderDetailTable">
                                </tbody>
                                <tfoot>
                                    <table align="right">
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Sub Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_subTotal"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right discountTr">
                                            <td colspan="5" style="font-weight:bold;"> Discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_discount"></span></td>
                                        </tr>
                                        <tr class="text-right afterDiscountTr">
                                            <td colspan="5" style="font-weight:bold;"> Total after discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_totalAfterDiscount"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Items Extra: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_extrasTotal"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Extras: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_extras"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Grand Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_grandTotal"></span> ZAR </td>
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
                    <button type="button" class="btn btn-success font-weight-bold  btn-square changeOrderState"
                        data-value='accept'> Accept </button>
                    <button type="button" class="btn btn-danger font-weight-bold  btn-square changeOrderState"
                        data-value='reject'> Reject</button>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade bd-example-modal-md" id="order_detail_real_time" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details (Real Time)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="realTime_order_id">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table ">
                                <tr>
                                    <th style="">Order Number </th>
                                    <td id="realTime_order_number"></td>
                                    <th style="">Customer </th>
                                    <td id="realTime_order_user"></td>
                                </tr>
                                <tr>
                                    <th style="">Status </th>
                                    <td id="realTime_order_Status"></td>
                                    <th style="">Phone </th>
                                    <td id="realTime_order_phonenumber"></td>
                                </tr>
                                <tr>
                                    <th style="">Type </th>
                                    <td id="realTime_order_type"></td>
                                    <th style="">Address: </th>
                                    <td id="realTime_order_address"></td>
                                </tr>
                                <tr>
                                    <th style="">Payment Method: </th>
                                    <td style="" id="realTime_paymentMethod"></td>
                                    <th style="">Building: </th>
                                    <td style="" id="realTime_building"></td>
                                </tr>
                                <tr>
                                    <th style="">Order Note: </th>
                                    <td id="realTime_order_note"style="color:#ee2d41"></td>
                                    <th style="">Appartment / Floor: </th>
                                    <td id="realTime_appartment"style=""></td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <th style="" colspan="4"> Promotions: </th>
                                </tr>

                                <tr>
                                    <td style="" colspan="4">
                                        <ul id="realTime_promotion_ul">
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="realTime_order_note"colspan="4" style="color:#ee2d41"></td>
                                </tr>
                            </table>
                            <table class="table table-head-custom table-checkable dataTable text-black"
                                id="">
                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="7" class="text-center text-black">
                                            Order products
                                        </th>
                                    </tr>
                                    <tr class="thead-light">
                                        <th style=""> Name </th>
                                        <th style="">Qty </th>
                                        <th> Price <strong>(ZAR)</strong></th>
                                        <th> Discount <strong>(ZAR)</strong></th>
                                        <th> VAT </th>
                                        <th> Items </th>
                                        <th> Extras </th>
                                    </tr>
                                </thead>

                                <tbody id="realTime_orderDetailTable">
                                </tbody>

                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="7" class="text-center">
                                            Order Deals Products
                                        </th>
                                    </tr>
                                    <tr class="text-black">
                                        <td colspan="2">
                                            <b>Deals</b>
                                            <ul id="realTime_dealList">
                                            </ul>
                                        </td>
                                        <td colspan="2">
                                            <b>Extras</b>
                                            <ul id="realTime_extraList">
                                            </ul>
                                        </td>
                                        <td colspan="2">
                                            <b>Modifier</b>
                                            <ul id="realTime_modifierList">
                                            </ul>
                                        </td>
                                    </tr>
                                </thead>

                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="8" class="text-center">
                                            Bogo Products
                                        </th>
                                    </tr>
                                    <tr class="thead-light">
                                        <th style="" colspan="5"> Get Product </th>
                                        <th style="" colspan="5"> Free Product </th>
                                    </tr>
                                </thead>
                                <thead id="realTime_bogoProduct">
                                </thead>

                                <tfoot>
                                    <table align="right">
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Sub Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_subTotal"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right discountTr">
                                            <td colspan="5" style="font-weight:bold;"> Discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_discount"></span></td>
                                        </tr>
                                        <tr class="text-right afterDiscountTr">
                                            <td colspan="5" style="font-weight:bold;"> Total after discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_totalAfterDiscount"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Items Extra: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_extrasTotal"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Extras: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_extras"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> VAT: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Franchise VAT: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_franchise_tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Delivery Charges: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_delivery_charges"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Grand Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="realTime_grandTotal"></span> ZAR </td>
                                        </tr>
                                    </table>

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
                    <button type="button" class="btn btn-success font-weight-bold  btn-square changeOrderState"
                        data-value='accept'> Accept </button>
                    <button type="button" class="btn btn-danger font-weight-bold  btn-square changeOrderState"
                        data-value='reject'> Reject</button>

                        <button type="button" class="btn btn-info font-weight-bold  btn-square  " onclick="window.print()"> Print</button>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade bd-example-modal-lg" id="order_detail" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="order_id">
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
                                    <th style="">Payment Method: </th>
                                    <td style="" id="paymentMethod"></td>
                                    <th style="">Building: </th>
                                    <td style="" id="building"></td>
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
                            <table class="table table-head-custom table-checkable dataTable text-black"
                                id="">
                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="7" class="text-center text-black">
                                            Order products
                                        </th>
                                    </tr>
                                    <tr class="thead-light">
                                        <th style=""> Name </th>
                                        <th style="">Qty </th>
                                        <th> Price <strong>(ZAR)</strong></th>
                                        <th> Discount <strong>(ZAR)</strong></th>
                                        <th> VAT </th>
                                        <th> Items </th>
                                        <th> Extras </th>
                                    </tr>
                                </thead>

                                <tbody id="orderDetailTable">
                                </tbody>

                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="7" class="text-center">
                                            Order Deals Products
                                        </th>
                                    </tr>
                                    <tr class="text-black">
                                        <td colspan="2">
                                            <b>Deals</b>
                                            <ul id="dealList">
                                            </ul>
                                        </td>
                                        <td colspan="2">
                                            <b>Extras</b>
                                            <ul id="extraList">
                                            </ul>
                                        </td>
                                        <td colspan="2">
                                            <b>Modifier</b>
                                            <ul id="modifierList">
                                            </ul>
                                        </td>
                                    </tr>
                                </thead>

                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="8" class="text-center">
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
                                    <tr class=" changeStatusDropDown">
                                        <td colspan="7" style="font-weight:bold;">
                                            <label for="" class="text-black"> Change Status</label> <br>
                                            <select name="" id="order_status"  class="form-control changeStatusDropDown" style="border-radius: 0">
                                                <option value="order">
                                                    Order
                                                </option>
                                                <option value="preparation">
                                                    Preparation
                                                </option>
                                                <option value="dp">
                                                    Delivery / PickUp
                                                </option>
                                                <option value="dc">
                                                    Delivered / Collected
                                                </option>
                                                <option value="cancelled">
                                                    Cancelled
                                                </option>


                                            </select>
                                        </td>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <table align="right">
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Sub Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="subTotal"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right discountTr">
                                            <td colspan="5" style="font-weight:bold;"> Discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="discount"></span></td>
                                        </tr>
                                        <tr class="text-right afterDiscountTr">
                                            <td colspan="5" style="font-weight:bold;"> Total after discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="totalAfterDiscount"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Items Extra: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="extrasTotal"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Extras: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="extras"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> VAT: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Franchise VAT: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="franchise_tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Delivery Charges: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="delivery_charges"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Grand Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span
                                                    id="grandTotal"></span> ZAR </td>
                                        </tr>
                                    </table>

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
                    <a href="{{ route('franchise.refunds.create') }}"
                        class="btn btn-danger font-weight-bold  btn-square refundButton"> Refund</a>
                    <button type="button" class="btn btn-warning font-weight-bold  btn-square changeStatus"> Change
                        Status</button>

                        <button type="button" class="btn btn-info font-weight-bold  btn-square  " onclick="window.print()"> Print</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="order_reject_reason_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <input type="hidden" id="order_id">
                <div class="row">
                    <div class="col-lg-12">
                            <label for=""> Enter Order Reject Reason <span class="text-danger">*</span></label>
                            <input type="hidden"  id="reject_order_id" />
                            <textarea   id="reject_order_reason" cols="10" rows="2" placeholder="Enter Reject Reason" class="form-control"></textarea>
                            <small class="text-danger" id="reason_error_message" style="display: none">Order reason is required</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-danger font-weight-bold  btn-square rejectOrderWithReason"> Reject Order</button>
                    <button type="button" class="btn btn-info font-weight-bold  btn-square" data-dismiss="modal" aria-label="Close">  Close </button>
                </div>
            </div>
        </div>
    </div>
</div>
