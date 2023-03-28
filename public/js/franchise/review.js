function allReviews(getReviewURL, franchiseId) {

       $('#review-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: getReviewURL,
                data: {
                    franchiseId: franchiseId,
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return data.order.order_number;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return data.order.type;
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
                        var reviewStarts = '';
                        for (i = 1; i <= data.rating; i++) {
                            reviewStarts += ` <i class="flaticon-star text-warning" title="Rating ${data.rating}"></i>`;
                        }
                        return reviewStarts;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: false
                },
                {
                    data: function (data) {
                        return ` <button class="btn btn-sm btn-icon btn-light-warning btn-square reviewDetails"
                                    data-toggle="modal" data-target="#review_detail"
                                    data-ordernumber="${data.order.order_number}"
                                    data-customer="${data.user.name}"
                                    data-rating="${data.rating}"
                                    data-comment="${data.comments}"
                                    data-phone="${data.user.phone}"
                                    data-address="${data.user.address}"
                                    >
                                        <i class="icon-1x text-dark-5 flaticon-eye"></i>
                                </button>`;
                    },
                    orderable: false,
                    searchable: false
                },
            ]
        });

}

function reviewFilter(from_date = '', to_date = '' ,reviewFilterUrl) {
    $('#review-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:reviewFilterUrl,
            data: {
                review_from_date: from_date,
                review_to_date: to_date,
                franchiseId: franchiseId,
            }
        },
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: function (data) {
                return `data.order.order_number`;
            },
            orderable: false,
            searchable: false
        },
        {
            data: function (data) {
                return console.log(data);
            },
            orderable: false,
            searchable: false
        },
        {
            data: function (data) {
                return `data.user.name`;
            },
            orderable: false,
            searchable: false
        },
        {
            data: function (data) {
                var reviewStarts = '';
                for (i = 1; i <= data.rating; i++) {
                    reviewStarts += ` <i class="flaticon-star text-warning" title="Rating ${data.rating}"></i>`;
                }
                return reviewStarts;
            },
            orderable: false,
            searchable: false
        },
        {
            data: 'created_at',
            name: 'created_at',
            orderable: false,
            searchable: false
        },
        {
            data: function (data) {
                return ` <button class="btn btn-sm btn-icon btn-light-warning btn-square reviewDetails"
                            data-toggle="modal" data-target="#review_detail"
                            data-ordernumber="data.order.order_number"
                            data-customer="data.user.name"
                            data-rating="data.rating"
                            data-comment="data.comments"
                            data-phone="data.user.phone"
                            data-address="data.user.address"
                            >
                                <i class="icon-1x text-dark-5 flaticon-eye"></i>
                        </button>`;
            },
            orderable: false,
            searchable: false
        },
    ]
    });
}
