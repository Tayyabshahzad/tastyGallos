// $('#productsTable').DataTable({
    //     processing: true,
    //     serverSide: true,

    //     ajax: {
    //         url: getFranchiseProducts,
    //         data: {
    //             franchiseId: franchiseId,
    //         }
    //     },
    //     columns: [{
    //             data: function(data) {
    //                 return `<a href='{{ route('admin.products.edit') }}/${data.id}'> ${data.name} </a>`;
    //             },
    //             name: 'name',

    //         },
    //         {
    //             data: function(data) {
    //                 return data.categories;
    //             },
    //             orderable: false,
    //             searchable: false
    //         },
    //         {
    //             data: function(data) {
    //                 return data.price;
    //             },
    //             orderable: false,
    //             searchable: false
    //         },
    //         {
    //             data: function(data) {
    //                 return data.sale_price;
    //             },
    //             name: 'sale_price',
    //         },
    //         {
    //             data: function(data) {
    //                 return data.sell_on_its_own;
    //             },
    //             name: 'sell_on_its_own',
    //         },
    //         {
    //             data: function(data) {
    //                return data.discount;
    //             },

    //             orderable: false,
    //             searchable: false
    //         },
    //         {
    //             data: function(data) {


    //                 if (data.specialPrice == null) {
    //                     return `<div class="input-group specialpriceContainer"  >
//                                 <small  style="cursor:pointer" class=" text-danger mt-2 changeStatusButton" >
//                                      Set Special Price
//                                 </small>
//                                 <input type="number" class="form-control specialPriceValue" value="${data.specialPrice}" style="display:none;">
//                                 <div class="input-group-prepend updateButton" style="display:none;">
//                                     <span class="input-group-text setprice"
//                                         data-product_id='${data.id}'
//                                         data-franchise_id='${franchiseId}'
//                                         style="cursor:pointer">
//                                         Update
//                                     </span>
//                                 </div>
//                         </div>`;
    //                 } else {

    //                     return `<div class="input-group specialpriceContainer"  >
//                             <input type="number" class="form-control specialPriceValue" value="${data.specialPrice}">
//                             <div class="input-group-prepend">
//                                 <span class="input-group-text setprice"
//                                     data-product_id='${data.id}'
//                                     data-franchise_id='${franchiseId}'
//                                     style="cursor:pointer">
//                                     Update
//                                 </span>
//                             </div>
//                                 <small style="cursor:pointer" class='text-danger mt-2 removePrice' data-id="${data.id}"> Remove Special Price</small>
//                             </div>`;
    //                 }
    //             },
    //             orderable: false,
    //             searchable: false
    //         },
    //         {
    //             data: function(data) {

    //                 if (data.productStatus == 'active') {
    //                     return `<span class="switch switch-danger switch-icon switch-sm status">
//                                 <label class="ml-2">
//                                         <input type="checkbox" class="product_status"
//                                         value="active"
//                                         name="status" checked='checked'
//                                         data-product_id="${data.id}"
//                                         data-franchise_id='${franchiseId}'>
//                                         <span></span>
//                                 </label>
//                             </span>`;
    //                 } else {
    //                     return `<span class="switch switch-danger switch-icon switch-sm status">
//                                 <label class="ml-2">
//                                         <input type="checkbox" class="product_status"
//                                         value="active"
//                                         name="status"
//                                         data-product_id="${data.id}"
//                                         data-franchise_id='${franchiseId}'>
//                                         <span></span>
//                                 </label>
//                             </span>`;
    //                 }
    //             },
    //             name: 'productStatus',
    //             orderable: false,
    //             searchable: false
    //         },



    //     ]
    // });
