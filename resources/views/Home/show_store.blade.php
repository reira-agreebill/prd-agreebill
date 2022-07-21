
@extends('Home.home_layout.app')
@section('home_content')




    <div id="root">



    </div>

    <script>
        $('.btn').on('click', function(e) {
            e.preventDefault();
            $(this).off("click").attr('href', "javascript: void(0);");
            //add .off() if you don't want to trigger any event associated with this link
        });
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
{{--    <script crossorigin src="https://sdk.mercadopago.com/js/v2"></script>--}}
@endsection
