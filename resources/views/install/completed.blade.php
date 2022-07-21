@extends('install.layout.app')
@section('home_content')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .main-col {
            display: none !important;
        }
        .hidden {
            display: none !important;
        }
        .update-messages {
            margin-top: 3rem;
        }
        .message-overlay {
            position: absolute;
            height: 17rem;
            width: 100%;
            background-color: #fafafa;
            transform: translateY(0px);
            transition: 0.1s linear all;
        }

        .btngradientnew {
            background-size: 100%;
            background-image: -webkit-linear-gradient(right, #f3723b, #e54750);
            background-image: linear-gradient(to right, #f3723b, #e54750);
            position: relative;
            z-index: 1;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            color: #ffffff;

        }
    </style>



    <div class="container">

        <div class="card" style="margin-top: 50px;">



            <div class="card-header">
                <h4 class="mb-0">Installation Successful</h4>
                <br>

            </div>


            <br>
            <br>
            <br>
            <div class="visit-wrapper text-center clearfix">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="visit text-center">

                            <a href="{{ substr(url("/"), 0, strrpos(url("/"), '/')) }}" class="btn btngradientnew" target="_blank">Home Page</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="visit text-center">

                            {{-- later change it to route to admin dashboard --}}
                            <a href="{{ route('login') }}" class="btn btngradientnew" target="_blank">Admin Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>
            <br>




        </div>






@endsection
