$('.input-daterange').datepicker({
    todayBtn: 'linked',
    format: 'yyyy-mm-dd',
    autoclose: true
});

function getRefund(url) {

    $(function () {
        $('#refund_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [

                {
                    data: function (data) {
                        return data.order.order_number;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return data.franchise.name;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return data.user.name;
                    },
                    orderable: false,
                    searchable: false
                },

                {
                    data: function (data) {
                        return data.order.admin_commission;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return (data.order.total - data.order.admin_commission);
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'time_ago',
                    name: 'time_ago',
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return `<span class="text-dark-75 d-block text-warning" data-toggle="modal" data-target="">
                                        <button  class="btn btn-sm  ${data.refund_status} btn-square statusButtons" >
                                                ${data.status}
                                        </button>
                                </span>`;
                    },
                    name: 'refund_status',
                },
                {
                    data: function (data) {
                        return `<span class="text-dark-75 d-block text-warning" data-toggle="modal" data-target="#refundDetails">
                                    <button class="btn btn-sm btn-icon btn-light-warning btn-square refundDetails"
                                            data-order_number="${data.order.order_number}" data-refund_status="${data.status}" data-customer_name="${data.user.name}"
                                            data-order_date="${data.time_ago}" data-customer_phone="${data.user.phone}" data-order_type="${data.order.type}"
                                            data-customer_address="${data.user.address}" data-order_id="${data.order.id}" data-ordertotal="${data.order.total}"
                                            data-reason="${data.reason}" data-refund_id="${data.id}">
                                            <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                    </button>
                            </span>`;
                    },
                    orderable: false,
                    searchable: false
                },

            ]
        });
    });


}



function filter_data(from_date = '', to_date = '', franchise = '', orderType = '' , filterUrl) {
    $('#refund_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: filterUrl,
            data: {
                from_date: from_date,
                to_date: to_date,
                franchise: franchise,
                orderType: orderType
            }
        },
        columns: [

            {
                data: function (data) {
                    return data.order.order_number;
                },
                orderable: false,
                searchable: false
            },
            {
                data: function (data) {
                    return data.franchise.name;
                },
                orderable: false,
                searchable: false
            },
            {
                data: function (data) {
                    return data.user.name;
                },
                orderable: false,
                searchable: false
            },

            {
                data: function (data) {
                    return data.order.admin_commission;
                },
                orderable: false,
                searchable: false
            },
            {
                data: function (data) {
                    return (data.order.total - data.order.admin_commission);
                },
                orderable: false,
                searchable: false
            },
            {
                data: 'time_ago',
                name: 'time_ago',
                orderable: false,
                searchable: false
            },
            {
                data: function (data) {
                    return `<span class="text-dark-75 d-block text-warning" data-toggle="modal" data-target="">
                                    <button  class="btn btn-sm  ${data.refund_status} btn-square statusButtons" >
                                            ${data.status}
                                    </button>
                            </span>`;
                },
                name: 'refund_status',
            },
            {
                data: function (data) {
                    return `<span class="text-dark-75 d-block text-warning" data-toggle="modal" data-target="#refundDetails">
                                <button class="btn btn-sm btn-icon btn-light-warning btn-square refundDetails"
                                        data-order_number="${data.order.order_number}" data-refund_status="${data.status}" data-customer_name="${data.user.name}"
                                        data-order_date="${data.time_ago}" data-customer_phone="${data.user.phone}" data-order_type="${data.order.type}"
                                        data-customer_address="${data.user.address}" data-order_id="${data.order.id}" data-ordertotal="${data.order.total}"
                                        data-reason="${data.reason}" data-refund_id="${data.id}">
                                        <i class=" icon-1x text-dark-5 flaticon-eye"></i>
                                </button>
                        </span>`;
                },
                orderable: false,
                searchable: false
            },

        ]
    });
}
