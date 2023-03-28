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
                                        <th> VAT  </th>
                                        <th> Items  </th>
                                        <th> Extras  </th>
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


                                    <tr class="">
                                        <td colspan="2">
                                           <b>Deals</b>
                                           <ul id="dealList">
                                           </ul>
                                        </td>

                                        <td colspan="2">
                                            <b>Deal Products</b>
                                            <ul id="dealProducts">
                                            </ul>
                                         </td>

                                         <td colspan="2">
                                            <b>Deal Extras</b>
                                            <ul id="dealProductExtra">
                                            </ul>
                                         </td>

                                         <td colspan="2">
                                            <b>Deal Modifers</b>
                                            <ul id="dealProductModifiers">
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
                                            <td colspan="5" style="font-weight:bold;"> VAT: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Franchise VAT: </td>
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




<div class="modal fade bd-example-modal-lg" id="set_special_price" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSizeXl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Special Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form action="{{ route('admin.franchise.set.specialPrice')}}" method="post" id="addSpecialPrice">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                    <input type="hidden" name="franchise_id" id="special_price_franchise_id">
                                    <input type="hidden" name="product_id"   id="special_price_product_id">
                                    <label for="">
                                        Enter Price <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="specialPrice" id="specialPrice" required  class="form-control" placeholder="Enter product special price">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-danger font-weight-bold  btn-square  " data-dismiss="modal" aria-label="Close"> Close </button>
                        <button type="submit" class="btn btn-success font-weight-bold  btn-square" > Submit </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade bd-example-modal-lg" id="order_detail_for_review" tabindex="-1" role="dialog"
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table ">
                                <tr>
                                    <th style="">Order Number </th>
                                    <td id="R_order_number"></td>
                                    <th style="">Customer </th>
                                    <td id="R_order_user"></td>
                                </tr>
                                <tr>
                                    <th style="">Status </th>
                                    <td id="R_order_Status"></td>
                                    <th style="">Phone </th>
                                    <td id="R_order_phonenumber"></td>
                                </tr>
                                <tr>
                                    <th style="">Type </th>
                                    <td id="R_order_type"></td>
                                    <th style="">Address: </th>
                                    <td id="R_order_address"></td>
                                </tr>
                                <tr>
                                    <th style="" >Payment Method: </th> <td style="" id="R_paymentMethod"></td>
                                    <th style="" >Building: </th> <td style="" id="R_building"></td>
                                </tr>
                                <tr>
                                    <th style="">Order Note: </th>
                                    <td id="R_order_note"style="color:#ee2d41"></td>
                                    <th style="">Appartment / Floor: </th>
                                    <td id="R_appartment"style=""></td>
                                </tr>

                                <tr>
                                    <th style="" >Rating: </th>
                                    <td id="R_starts" colspan="4">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="">Comments: </th>
                                    <td id="R_comments" colspan="4"></td>
                                </tr>

                                <tr>

                                </tr>
                                <tr>
                                    <th style="" colspan="4"> Promotions: </th>
                                </tr>

                                <tr>
                                    <td style="" colspan="4">
                                            <ul id="R_promotion_ul">
                                            </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="R_order_note"colspan="4" style="color:#ee2d41"></td>
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
                                        <th> VAT  </th>
                                        <th> Items  </th>
                                        <th> Extras  </th>
                                    </tr>
                                </thead>

                                <tbody id="R_orderDetailTable">
                                </tbody>

                                <thead>
                                    <tr class="thead-light">
                                        <th colspan="7" class="text-center">
                                            Order Deals Products
                                        </th>
                                    </tr>


                                    <tr class="">
                                        <td colspan="2">
                                           <b>Deals</b>
                                           <ul id="R_dealList">
                                           </ul>
                                        </td>

                                        <td colspan="2">
                                            <b>Deal Products</b>
                                            <ul id="R_dealProducts">
                                            </ul>
                                         </td>

                                         <td colspan="2">
                                            <b>Deal Extras</b>
                                            <ul id="R_dealProductExtra">
                                            </ul>
                                         </td>

                                         <td colspan="2">
                                            <b>Deal Modifers</b>
                                            <ul id="R_dealProductModifiers">
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
                                <thead id="R_bogoProduct">
                                </thead>
                                <tfoot>
                                    <table align="right" >
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Sub Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_subTotal"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right discountTr">
                                            <td colspan="5" style="font-weight:bold;"> Discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_discount"></span></td>
                                        </tr>
                                        <tr class="text-right afterDiscountTr">
                                            <td colspan="5" style="font-weight:bold;"> Total after discount: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_totalAfterDiscount"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Items Extra: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_extrasTotal"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Extras: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_extras"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> TAX: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Franchise Tax: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_franchise_tax"></span> ZAR </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Delivery Charges: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_delivery_charges"></span> ZAR </td>
                                        </tr>

                                        <tr class="text-right">
                                            <td colspan="5" style="font-weight:bold;"> Grand Total: </td>
                                            <td colspan="5" style="font-weight:bold;"> <span id="R_grandTotal"></span> ZAR </td>
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
