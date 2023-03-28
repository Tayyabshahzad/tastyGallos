<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Tasty Gallos | Pay Gate Redirect</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        body {
                background-image: url('{{asset('design/assets/media/logos/loader.gif')}}');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center center;
                background-size:80%;
        }
    </style>
</head>
<body class="text-center"   >
    <form action="https://secure.paygate.co.za/payweb3/process.trans" method="POST" id="payment" style="visibility: hidden">
        <input type="hidden" name="PAY_REQUEST_ID" value="{{ $PAY_REQUEST_ID }}">
        <input type="hidden" name="CHECKSUM" value="{{ $CHECKSUM }}">
    </form>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#payment").submit();
        });
    </script>
</body>
</html>
