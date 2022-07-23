<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-dark" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" >
               <h2 class="text-white agree-navbar">{{ Auth::user()->store_name }}</h2>
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line" style="background-color: #ffffff;"></i>
                        <i class="sidenav-toggler-line" style="background-color: #ffffff;"></i>
                        <i class="sidenav-toggler-line" style="background-color: #ffffff;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">




                    <li {{Route::currentRouteNamed('store_admin.dashboard')? 'class=nav-item active':null }}>
                        <a class="nav-link"   href="{{route('store_admin.dashboard')}}">
                            <i class="fas fa-th-large text-blue"></i>
                            <span class="nav-link-text"> {{$selected_language->data['store_dashboard'] ?? 'Dashboard'}}</span>
                        </a>
                    </li>




                    <li {{ Request::is("admin/store/orders*") ? 'class=nav-item active':null}} >
                        <a  class="nav-link"   href="{{route('store_admin.orders')}}">
                            <i class="fas fa-receipt text-green"></i>
                            <span class="nav-link-text"> {{$selected_language->data['store_orders'] ?? 'Orders'}}</span>
                        </a>
                    </li>

                    <li {{ Request::is("admin/store/orders/status*") ? 'class=nav-item active':null}} >
                        <a  class="nav-link"   href="{{route('store_admin.orderstatus')}}">
                            <i class="icofont-signal text-danger"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_orderstatus_screen'] ?? 'Orders Status Screen'}}</span>
                        </a>
                    </li>


                    <!-- <li {{ Request::is("admin/store/orders*") ? 'class=nav-item active':null}} >
                        <a  class="nav-link"   href="{{route('store_admin.waiter_calls')}}">
                            <i class="icofont-chef text-blue"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_waitercall'] ?? 'Waiter Call'}}</span>
                        </a>
                    </li>


                    <li {{ Request::is("store/expense") ? 'class=nav-item active':null}} >
                        <a  class="nav-link"   href="{{route('store_admin.store_expense')}}">
                            <i class="icofont-money text-danger"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_expense'] ?? 'Expense'}}</span>
                        </a>
                    </li> -->


                    <li {{Route::currentRouteNamed('store_admin.banner')? 'class=nav-item active':null }} >
                        <a  class="nav-link"   href="{{route('store_admin.banner')}}">
                            <i class="fas fa-images text-yellow"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_promo_banner'] ?? 'Promo Banner'}}</span>
                        </a>
                    </li>


                    <li {{Route::currentRouteNamed('store_admin.coupons')? 'class=nav-item active':null }} >
                        <a  class="nav-link"   href="{{route('store_admin.coupons')}}">
                            <i class="icofont-sale-discount text-green" style="font-size: 1.3rem"></i>
                            <span class="nav-link-text">Coupons</span>
                        </a>
                    </li>



                    <li {{Route::currentRouteNamed('admin/store/products')? 'class=nav-item active':null }} >
                        <a  class="nav-link"   href="{{route('store_admin.categories')}}">
                            <i class="icofont-fast-food text-orange" style="font-size: 1.3rem"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_inventory'] ?? 'Inventory'}}</span>
                        </a>
                    </li>





                    <li {{Route::currentRouteNamed('store_admin.all_tables')? 'class=nav-item active':null }} >
                        <a  class="nav-link"   href="{{route('store_admin.all_tables')}}">
                            <i class="icofont-hotel icofont-5x text-info" style="font-size: 1.3rem"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_tables'] ?? 'Room'}}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('download_qr',[Auth::user()->view_id])}}">
                            <i class="fas fa-qrcode text-green"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_printqr'] ?? 'Print Qr-Code'}}</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a  class="nav-link" href="{{route('store_admin.subscription_plans')}}">
                            <i class="icofont-paper text-flat-darker" style="font-size: 1.1rem"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_subscription_plans'] ?? 'Subscription Plans'}}</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('store_admin.customers')}}">
                            <i class="fas fa-users text-red"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_customers'] ?? 'Customers'}}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('store_admin.settings')}}">
                            <i class="icofont-tools-alt-2 text-blue" style="font-size: 1.2rem"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_settings'] ?? 'Settings'}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt text-pink"></i>
                            <span class="nav-link-text">{{$selected_language->data['store_logout'] ?? 'Logout'}}</span>
                        </a>
                    </li>
                    <form id="logout-form" action="{{route('store.logout')}}" method="POST" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </ul>




                </ul>
                <!-- Divider -->



            </div>
        </div>
    </div>
</nav>
