<style>

    .expense-bg-color{
        color: #ef7d7d;

    }

    .blink_me {
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% { opacity: 0; }
    }
</style>
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-dark" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" >
                <h2 class="text-white">{{ __('chef.adminpanel') }}
                </h2>
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block active" data-action="sidenav-unpin" data-target="#sidenav-main">
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


                    <li class="nav-item">
                        <a @if($root=="dashboard") class="nav-link active" @endif  class="nav-link"   href={{route('dashboard')}}>
                            <i class="fab fa-delicious text-blue"></i>
                            <span class="nav-link-text">{{ __('chef.dashboard') }}</span>
                        </a>
                    </li>




                    <li class="nav-item">
                        <a @if($root=="store") class="nav-link active" @endif class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-store text-orange"></i>
                            <span class="nav-link-text">{{ __('chef.store') }}</span>
                        </a>
                        <div class="collapse" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('add_store')}}" class="nav-link">{{ __('chef.addstore') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('all_stores')}}" class="nav-link">{{ __('chef.allstore') }}</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a @if($root=="Transactions") class="nav-link active" @endif class="nav-link" href="{{route('transactions')}}">
                            <i class="fas fa-money-check-alt text-success"></i>
                            <span class="nav-link-text">Transactions</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a @if($root=="Expense") class="nav-link active" @endif class="nav-link" href="{{route('expense')}}">
                            <i class="fas fa-calculator text-white"></i>
                            <span class="nav-link-text">Expense</span>&nbsp; &nbsp;
{{--                            <span class="badge badge-sm badge-white text-danger blink_me">new</span>--}}
                        </a>
                    </li>


                    <li class="nav-item">
                        <a @if($root=="Customers") class="nav-link active" @endif  class="nav-link"   href={{route('customers')}}>
                            <i class="fas fa-user-tag text-pink"></i>
                            <span class="nav-link-text">Customers</span>&nbsp; &nbsp;
{{--                            <span class="badge badge-sm badge-white text-danger blink_me">new</span>--}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a @if($root=="Testimonials") class="nav-link active" @endif  class="nav-link"   href={{route('testimonials')}}>
                            <i class="fas fa-comment-alt" style="color: #f600ff"></i>
                            <span class="nav-link-text">Testimonials</span>&nbsp; &nbsp;

                        </a>
                    </li>



                    <li class="nav-item">
                        <a @if($root=="Subscription") class="nav-link active" @endif  class="nav-link"   href={{route('all_subscription')}}>
                            <i class="fas fa-receipt text-yellow"></i>
                            <span class="nav-link-text">{{ __('chef.subscriptions') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a @if($root=="translations") class="nav-link active" @endif class="nav-link" href="{{route('translations')}}">
                            <i class="fas fa-language text-green"></i>
                            <span class="nav-link-text">Translations</span>
                        </a>
                    </li>

                
                    <li class="nav-item">
                        <a @if($root=="settings") class="nav-link active" @endif class="nav-link" href="{{route('settings')}}">
                            <i class="ni ni-settings-gear-65 text-blue"></i>
                            <span class="nav-link-text">{{ __('chef.settings') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @if($root=="logout") class="nav-link active" @endif class="nav-link">
                        <i class="fas fa-sign-out-alt text-pink"></i>
                        <span class="nav-link-text">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    </li>





                </ul>
                <!-- Divider -->



            </div>
        </div>
    </div>
</nav>
