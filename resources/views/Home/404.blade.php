@extends('Home.home_layout.app')

@section('home_content')


    <div class="vh-100 location location-page">
        <div class="d-flex align-items-center justify-content-center vh-100 flex-column">
            <img src="{{asset('images/404.png')}}" class="img-fluid mx-auto" alt="Responsive image">
            <div class="px-4 text-center mt-4">
                <h5 class="text-dark">Please check your subscription details</h5>

                <a href="#" class="btn btn-lg btn-danger btn-block my-4"><i class="feather-navigation"></i> Restaurant Under Maintenance</a>

            </div>
        </div>
    </div>
@endsection
