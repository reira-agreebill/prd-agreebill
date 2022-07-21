@extends("admin.adminlayout")

@section("admin_content")


    <div class="container-fluid">



        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card admin-card1">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.stores') }}</h5>

                            </div>
                            <div class="col-auto">
                                <span class="h2 font-weight-bold mb-0 text-white">{{$store_count}}</span>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card admin-card2">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.products') }}</h5>


                            </div>
                            <div class="col-auto">
                                <span class="h2 font-weight-bold mb-0 text-white">{{$product_count}}</span>


                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card admin-card3">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.earnings') }}</h5>


                            </div>
                            <div class="col-auto">
                                <span class="h2 font-weight-bold mb-0 text-white">@include('layouts.render.currency',["amount"=>$earnings])</span>


                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6">
                <div class="card admin-card4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.pendingstores') }}</h5>


                            </div>
                            <div class="col-auto">
                                <span class="h2 font-weight-bold mb-0 text-white">{{$pending_stores }}</span>


                            </div>

                        </div>

                    </div>
                </div>
            </div>





        </div>

        <div class="row">
            <div class="col-xl-6">
                <!-- Members list group card -->
                <div class="">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">New Registrations</h5>
                    </div>
                   <br>
                        <ul class="list-group list-group-flush list my--3" >

                            @foreach($new_stores as $data)


                                <div class="intro-y">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="">
                                            <img alt="Store" src="{{asset(($data->logo_url !=NULL) && ($data->logo_url != "NaN") ? $data->logo_url :'assets/images/store.jpg')}}" width="65px" height="65px" style="border-radius: 10px;border: none;">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{$data->store_name}}</div>
                                            <div class="text-gray-600 text-xs mt-0.5">{{$data->email}} / {{$data->phone}}</div>
                                        </div>
                                        <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">{{date('d-m-Y',strtotime($data->subscription_end_date))}}</div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>

                </div>
            </div>

            <div class="col-xl-6">
                <!-- Members list group card -->
                <div class="">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Expired Stores</h5>
                    </div>
                    <br>
                    <ul class="list-group list-group-flush list my--3" >

                        @foreach($expired_stores as $data)


                            <div class="intro-y">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    <div class="">
                                        <img alt="Store" src="{{asset(($data->logo_url !=NULL) && ($data->logo_url != "NaN") ? $data->logo_url :'assets/images/store.jpg')}}" width="65px" height="65px" style="border-radius: 10px;border: none;">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{$data->store_name}}</div>
                                        <div class="text-gray-600 text-xs mt-0.5">{{$data->email}} / {{$data->phone}}</div>
                                    </div>
                                    <div class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">{{date('d-m-Y',strtotime($data->subscription_end_date))}}</div>
                                </div>
                            </div>
                        @endforeach
                    </ul>

                </div>
            </div>









        </div>



    </div>

@endsection
