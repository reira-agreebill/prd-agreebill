<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Auth::user()->store_name }}</title>

    <!-- ================= Favicon ================== -->
    <link rel="icon" type="image/png" href="{{asset('themes/default/images/all-img/agreebill-icon.png')}}">

    <link href={{asset('assets/css/lib/calendar2/pignose.calendar.min.css')}} rel="stylesheet"/>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href={{asset('new/vendor/nucleo/css/nucleo.css')}} type="text/css">
    <link rel="stylesheet" href={{asset('new/vendor/@fortawesome/fontawesome-free/css/all.min.css')}} type="text/css">
    <!--  CSS -->
    <link rel="stylesheet" href={{asset('new/css/argon.css?v=1.1.0')}} type="text/css">

    <!-- Page plugins -->
    <link rel="stylesheet" href={{asset('new/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}>
    <link rel="stylesheet" href={{asset('new/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}>
    <link rel="stylesheet" href={{asset('new/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}>

    <!-- Page plugins -->
    <link rel="stylesheet" href={{asset('new/vendor/select2/dist/css/select2.min.css')}}>
    <link rel="stylesheet" href={{asset('new/vendor/quill/dist/quill.core.css')}}>

    <link rel="stylesheet" href={{asset('new/css/chef.css')}} type="text/css">
    <link rel="stylesheet" href={{asset('new/css/toastr.min.css')}} type="text/css">

    <link rel="stylesheet" type="text/css" href={{asset('new/icofont/icofont.min.css')}}>

    <link rel="stylesheet" href={{asset('new/css/custom_store.css')}} type="text/css">





</head>
<body>
<script src="https://www.2checkout.com/static/checkout/javascript/direct.min.js"></script>

@include('restaurants.layouts.sidebar')



<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark border-bottom bg-white shadow">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Search form -->
                <div class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                    <div class="form-group mb-0">
                        <h1>{{$root_name}}</h1>
                    </div>
                    <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- Navbar links -->

                <ul class="navbar-nav">

                </ul>


                <ul class="navbar-nav align-items-center ml-md-auto">


                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
                    {{-- <li>
                        <form method="post" action="{{route("change_language")}}">
                            @csrf
                            <select class="form-control1" name="selected_language" data-width="fit"
                                    onchange="this.form.submit()">
                                @foreach($languages as $language)
                                    @if(Session::get('selected_language')!=NULL)
                                        <option
                                            {{Session::get('selected_language') == $language->id ?"selected": null}} value="{{$language->id}}">{{$language->language_name}}</option>

                                    @endif
                                    @if(Session::get('selected_language')==NULL)
                                        <option
                                            {{$language->is_default == 1 ?"selected": null}} value="{{$language->id}}">{{$language->language_name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </form>
                    </li> --}}
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src={{asset("assets/images/avatar/1.jpg")}}>
                  </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold" style="color: #000000;">{{ Auth::user()->store_name }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="header" style="margin-top: 10px;">

    </div>
    <!-- Page content -->


@yield("restaurantcontant")


<!-- Page content -->





<script src={{asset("new/vendor/jquery/dist/jquery.min.js")}}></script>
<script src={{asset("new/vendor/bootstrap/dist/js/bootstrap.bundle.min.js")}}></script>
<script src={{asset("new/vendor/js-cookie/js.cookie.js")}}></script>
<script src={{asset("new/vendor/jquery.scrollbar/jquery.scrollbar.min.js")}}></script>
<script src={{asset("new/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js")}}></script>
<script src={{asset("new/vendor/chart.js/dist/Chart.min.js")}}></script>
<script src={{asset("new/vendor/chart.js/dist/Chart.extension.js")}}></script>
<script src={{asset("new/vendor/jvectormap-next/jquery-jvectormap.min.js")}}></script>
<script src={{asset("new/js/vendor/jvectormap/jquery-jvectormap-world-mill.js")}}></script>
<script src={{asset("new/js/argon.js?v=1.1.0")}}></script>



<script src={{asset("new/vendor/select2/dist/js/select2.min.js")}}></script>
<script src={{asset("new/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}></script>
<script src={{asset("new/vendor/nouislider/distribute/nouislider.min.js")}}></script>
<script src={{asset("new/vendor/quill/dist/quill.min.js")}}></script>
<script src={{asset("new/vendor/dropzone/dist/min/dropzone.min.js")}}></script>
<script src={{asset("new/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js")}}></script>
<script src={{asset("assets/js/printthis.js")}}></script>

<script src={{asset("new/js/toastr.min.js")}}></script>
{!! Toastr::message() !!}


<script>
    $('#printButton').on('click',function(){
        $('#printThis').printThis();
    })
    //on single click, accpet order and disable button
    $('body').on("click", ".acceptOrderBtn", function(e) {
        $(this).addClass('pointer-none');
    });
    //on Single click donot cancel order
    $('body').on("click", ".cancelOrderBtn", function(e) {
        return false;
    });
    //cancel order on double click
    $('body').on("dblclick", ".cancelOrderBtn", function(e) {
        $(this).addClass('pointer-none');
        window.location = this.href;
        return false;
    });
</script>

    <script>
        $('#thermalprintButton').on('click',function(){
            $('#thermalprintThis').printThis();
        })

    </script>

<script>
    $('#modal-notification').modal('show')
</script>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe('{{$publishableKey ?? ''}}');
    var checkoutButton = document.getElementById('checkout-button');
    var rozorpaybutton = document.getElementsByClassName("razorpay-payment-button");
    function triggerStripePayment(id) {
        fetch('{{route('store_admin.subscription_complete_payment')}}'+"?plan_id="+id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token()}}",
            },
            body: JSON.stringify({plan_id:id})
        })
            .then(function(response) {
                return response.json();
            })
            .then(function(session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function(error) {
                console.log("err");
                alert('PAYMENT_ERROR #404');
                console.error('Error:', error);
            });
    }
</script>

</body>

</html>






