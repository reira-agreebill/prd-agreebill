 <link href=”http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css” rel=”stylesheet”>
    <script src=”http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js”></script>
    <header class="rt-site-header home-four rt-fixed-top ">
        <div class="main-header rt-sticky">
            <nav class="navbar">
                <div class="rt-container">
                    <a href="{{route('home')}}" class="brand-logo"><img
                            src={{asset($account_info !=NULL ? $account_info->application_logo:'themes/default_home/images/logo/logo.png')}} alt=""
                            width="175px"></a>
                    <a href="{{route('home')}}" class="sticky-logo"><img
                            src={{asset($account_info !=NULL ? $account_info->application_logo:'themes/default_home/images/logo/logo.png')}} alt=""
                            width="175px"></a>
                    <div class="ml-auto d-flex align-items-center">
                        <div class="main-menu">
                            <ul>
                                <li><a href="{{route('home')}}">
                                        {{$selected_language->data['home'] ?? 'Home'}}
                                    </a>

                                </li>
                                <li>
                                    <a href="#how">
                                        {{$selected_language->data['how_it_works_1'] ?? 'How It Works'}}
                                    </a>
                                </li>
                                <li>
                                    <a href="#service">
                                        {{$selected_language->data['service'] ?? 'Service'}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('store_pricing')}}">
                                        {{$selected_language->data['pricing'] ?? 'Pricing'}}
                                    </a>
                                </li>

                                <li class="menu-item-has-children active"><a href="#">{{$selected_language->data['website_pages'] ?? 'Pages'}}</a>
                                    <ul class="sub-menu" style="display: none;">
                                        <li><a href="{{route('about')}}">{{$selected_language->data['about_us'] ?? 'About Us'}}</a></li>
                                        <li><a href="{{route('termsandcondition')}}">{{$selected_language->data['termsandcondition'] ?? 'Terms and Condition'}}</a></li>
                                        <li><a href="{{route('privacy')}}">{{$selected_language->data['privacy_policy'] ?? 'Privacy Policy'}}</a></li>
                                        <li><a href="{{route('refund')}}">{{$selected_language->data['refundandcancellation'] ?? 'Refund & Cancellation'}}</a></li>

                                    </ul>
                                </li>


                                <li>
                                    <a href="{{route('store.login')}}">
                                        {{$selected_language->data['login'] ?? 'Login'}}
                                    </a>
                                </li>

                                <li class="current-menu-item">
                                    <a href="{{route('store_register')}}">

                                        {{$selected_language->data['register'] ?? 'Register'}}
                                    </a>
                                </li>
                                {{-- <li class="current-menu-item">
                                    <form method="post" action="{{route("change_language")}}">
                                        @csrf
                                        <select class="form-control" name="selected_language" data-width="fit"
                                                onchange="this.form.submit()">
                                            @foreach($languages as $data)
                                                @if(Session::get('selected_language')!=NULL)
                                                    <option
                                                        {{Session::get('selected_language') == $data->id ?"selected": null}} value="{{$data->id}}">{{$data->language_name}}</option>

                                                @endif
                                                @if(Session::get('selected_language')==NULL)
                                                    <option
                                                        {{$data->is_default == 1 ?"selected": null}} value="{{$data->id}}">{{$data->language_name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </form>
                                </li> --}}
                            </ul>
                        </div><!-- end main menu -->


                        <div class="rt-nav-tolls d-flex align-items-center">


                            <div class="mobile-menu">
                                <div class="menu-click">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>
        </div><!-- /.bootom-header -->
    </header>

    <br>
    <br>
    <br>
    <br>
    <div class="inner-content container">
        <br>
        <br>
        <br>
        <h3>{{$selected_language->data['about_us'] ?? 'About Us'}}</h3>
        <br>
        <br>
        <br>
        <p class="container" id="summernote">

            {!!$about!!}

        </p>

    </div><!-- /.inner-content -->


    <script>
        $('.summernote').summernote({
            airMode: true
        });
    </script>

