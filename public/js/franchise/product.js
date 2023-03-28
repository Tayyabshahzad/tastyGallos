
function products(getFranchiseProduct,franchiseId) {
    $(function() {
        $('#productsTable').DataTable({
            processing: true,
            serverSide: true,
            method:'POST',
            ajax: getFranchiseProduct,
            columns: [
                {
                    data: function (data) {
                        return `<a href='{{ route("admin.products.edit")}}/${data.id}'> ${data.name} </a>`;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data:function(data){
                            return data.categories;
                    },orderable:false,searchable:false
                },
                {
                    data: function (data) {
                        return data.price;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return data.sale_price;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return data.sell_on_its_own;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data:function (data) {
                        return data.promotions;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data:function(data){
                        if(data.specialPrice == ''){

                            return `<div class="input-group specialpriceContainer"  >
                                        <small  style="cursor:pointer" class=" text-danger mt-2 changeStatusButton" >
                                             Set Special Price
                                        </small>
                                        <input type="number" class="form-control specialPriceValue" value="${data.specialPrice}" style="display:none;">
                                        <div class="input-group-prepend updateButton" style="display:none;">
                                            <span class="input-group-text setprice"
                                                data-product_id='${data.id}'
                                                data-franchise_id='${franchiseId}'
                                                style="cursor:pointer">
                                                Update
                                            </span>

                                        </div>
                                </div>`;
                        }else{
                            return `<div class="input-group specialpriceContainer"  >
                                    <input type="number" class="form-control specialPriceValue" value="${data.specialPrice}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text setprice"
                                            data-product_id='${data.id}'
                                            data-franchise_id='${franchiseId}'
                                            style="cursor:pointer">
                                            Update
                                        </span>
                                    </div>
                                        <small style="cursor:pointer" class='text-danger mt-2 removePrice' data-id="${data.id}"> Remove Special Price</small>
                                    </div>`;
                        }

                    },name:'specialPrice',
                },
                {
                    data: function (data) {
                            if(data.status == 'active'){
                                var chk = "checked";
                            }else{
                                var chk = "";
                            }
                            return `<span class="switch switch-danger switch-icon switch-sm status">
                                        <label class="ml-2">
                                                <input type="checkbox" class="product_status"
                                                value="${data.status}"
                                                name="status" `+chk+`
                                                data-product_id="${data.id}"
                                                data-franchise_id='${franchiseId}'>
                                                <span></span>
                                        </label>
                                    </span>`;
                    },name:'status',
                    orderable: false,
                    searchable: false
                },



            ]
        });
    });





}
