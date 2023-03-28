$(document).ready(function(){

    $("#addFranchise").click(function(e){

            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var openTime = $(".openTime").val();
            var closeTime = $(".closeTime").val();

            $.ajax({
                url: config.routes.addFranchise,
                type:'get',
                data: {_token:_token, openTime:openTime, closeTime:closeTime},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });


    });


    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }


});
