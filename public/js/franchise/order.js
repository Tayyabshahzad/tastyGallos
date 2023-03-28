

function orderDetail(getOrderItemsURL) {
    $(document).on("click", ".orderDetail", function () {
        $('#orderDetailTable').html('');
        var ordernumber = $(this).data('ordernumber');
        var status = $(this).data('status');
        var user = $(this).data('user');
        var timeAgo = $(this).data('timeago');
        var phone = $(this).data('phone');
        var type = $(this).data('type');
        var address = $(this).data('address');
        var ordertotal = $(this).data('ordertotal');
        var orderid = $(this).data('orderid');
        var orderNote = $(this).data('note');
        $('#ordernumber').html(ordernumber);
        $('#orderStatus').html(status);
        $('#user').html(user);
        $('#timeago').html(timeAgo);
        $('#phonenumber').html(phone);
        $('#type').html(type);
        $('#orderaddress').html(address);
        $('#ordertotal').html(ordertotal);
        $('#order_note').html(orderNote);
        console.log(orderid);
        $.ajax({
            url: getOrderItemsURL,
            method: 'POST',
            data: {
                id: orderid,
            },
            success: function (data) {
                var orderDtails = '';
                $.each(data, function (key, value) {
                    orderDtails +=
                        '<tr>' +
                        '<td>' + value.product.name + '</td>' +
                        '<td>' + value.quantity + '</td>' +
                        '<td>' + value.price + '</td>' +
                        '</tr>';
                });
                $('#orderDetailTable').append(orderDtails);
                // $('#orderDetailTable').html(orderDtails);
                console.log(orderDtails);
            },
        });


    });

}

