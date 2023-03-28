$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var avatar5 = new KTImageInput('kt_image_5');
$('#orderType').select2({
    placeholder: "Select a Type"
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('select .timeStatus').change(function () {

        var selectedCountry = $(this).children("option:selected").val();

     //   var status = $(this).val();
        alert(selectedCountry);
        // if (status == 'close') {
        //     $(this).closest('tr').find('input[type=time]').prop('required', false);
        //     $(this).closest('tr').find('input[type=time]').val('');
        //     $(this).closest('tr').find('span').removeClass('text-danger');
        //     $(this).closest('tr').find('span').html('');
        // } else {
        //     $(this).closest('tr').find('input[type=time]').prop('required', true);
        //     $(this).closest('tr').find('span').addClass('text-danger');
        //     $(this).closest('tr').find('span').html('*');
        // }
    });
});
$("#kt_inputmask_3").inputmask("mask", {
    "mask": "(+99) 999-999999999"
});
$("#editFranchiseForm").submit(function (e) {
    if ($(".deliveryBox").prop('checked') || $(".pickupBox").prop('checked')) {
        $("#UpdateFranchise").attr("disabled", true);
    } else {
        $(".pickupContainer").css('border-color', 'red');
        $(".deliveryContainer").css('border-color', 'red');
        toastr.error('Delivery type must be selected', "Error");
        e.preventDefault();
        return false;
    }
});
/// Edit Franchise
function settingUpdate(url) {
   ;
    $("#updateSetting").click(function (e) {

        e.preventDefault();
        var email = $('#settingEmail').val();
        if(email == ''){
            toastr.error('Email is required', "Error");
            $("#emailAddress").addClass('is-invalid');
            e.preventDefault();
        }
        var password = $("#password").val();
        var password_confirmation = $("#confirm_password").val();
        var userId = $('#userId').val();
        var franchiseId = $('#franchiseId').val();

        if (password != password_confirmation) {
            $("#password").addClass('is-invalid');
            $("#confirm_password").addClass('is-invalid');
            $('#passwordError').css('display', 'block');
        } else {
            $("#password").removeClass('is-invalid');
            $("#confirm_password").removeClass('is-invalid');
            $('#passwordError').css('display', 'none');
        }
        if ($('#status').is(":checked")) {
            status = "active";
        } else {
            status = "inactive";
        }
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id: userId,
                password: password,
                password_confirmation: password_confirmation,
                status: status,
                franchiseId: franchiseId,
                email: email,
            },
            success: function (response) {
                if (response.success == true) {
                    toastr.success(response.message, "success");
                    $("#updateSettingForm input[id='password']").val('');
                    $("#updateSettingForm input[id='confirm_password']").val('');
                } else {
                    toastr.error(response.message, "Error");
                }
                console.log(response);
            },
        });

    });
}
function reviewDetails(reviewURL) {
    $(document).on("click", ".reviewDetails", function () {
        var orderNumber = $(this).data('ordernumber');
        var customer = $(this).data('customer');
        var rating = $(this).data('rating');
        var comment = $(this).data('comment');
        var user = $(this).data('user');
        var starts = '';
        for (i = 1; i <= rating; i++) {
            starts += "<i class='flaticon-star text-warning' title='112'></i>";
        }
        $('#orderNumber').html(orderNumber);
        $('#customer').html(customer);
        $('#rating').html(starts);
        $('#comment').val(comment);
        $('#phone').html('197998');
        $('#address').html('Islabad');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: reviewURL,
            method: 'POST',
            data: {
                user: user,
            },
            success: function (success) {
                $('#phone').html(success.user.phone);
                $('#address').html(success.user.address);
                console.log(success.user.phone);
            },

        });

    });
}
