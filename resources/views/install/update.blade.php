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

            @if(!$extensionSatisfied)
                <div class="box">
                    <p>Please make sure the PHP extensions listed below are installed.</p>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 100%;">Extensions</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($requirement->extensions() as $label => $satisfied)
                                @if(!$satisfied)
                                    <tr>
                                        <td>
                                            {{ $label }}
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-{{ $satisfied ? 'check' : 'times' }}" aria-hidden="true"></i>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

                @if(!$permissionSatisfied)
                    <div class="box">
                        <p>Please make sure you have set the correct permissions for the directories listed below. All these directories/files should be writable.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 100%;">Directories</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($requirement->directories() as $label => $satisfied)
                                    @if(!$satisfied)
                                        <tr>
                                            <td>{{ $label }}</td>
                                            <td class="text-center">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if($requirement->satisfied())
            <div class="card-header">
                <h3 class="mb-0">Update Available {{ $updateVersion }} 🔥</h3>
                <br>

                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
            <div class="card-body">

                <form action="{{route('update_app')}}" method="POST">
                    <div class="form-group">
                        <input autofocus="" class="form-control" name="password"
                               placeholder="Enter the Admin Password to continue" style="margin-top: 1.5rem"
                               type="password">
                    </div>
                    <button type="submit" class="btn btngradientnew btn-lg btn-block update-button">Update Now 🔥</button>
                    @csrf
                </form>
                {{--                <a href="{{route('insertdata')}}" class="btn btn-secondary btn-lg btn-block">Reset Seed Data</a>--}}
            </div>
        </div>


        <div class="box error-msg">
            <div class="text-danger">
                @if(Session::has('success'))
                    {{ Session::get('success') }}
                @endif
                @if($errors->any())
                    {{ implode('', $errors->all(':success')) }}
                @endif
            </div>
        </div>


        <div class="warning-msg hidden" style="margin-top: 1.5rem">
            <p class="text-danger">
                Update process can take upto 30 seconds.
            </p>
            <p class="text-danger">
                <strong>
                    DONOT
                </strong>
                close or reload this window.
            </p>
        </div>

        @else
            <div class="text-left" style="margin-top: 5rem;">
                <strong>Fix the above issues and reload the page to update MAX-QR to {{ $updateVersion }}</strong>
            </div>
        @endif

        <div class="update-messages">
            <div class="message-overlay">
            </div>
            <p class="text-success">
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Migrating new tables...
                </span>
            </p>
            <p class="text-success">
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Populating new settings...
                </span>
            </p>
            <p class="text-success">
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Setting API routes...
                </span>
            </p>
            <p class="text-success">
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Clearing junk files...
                </span>
            </p>

        </div>

    </div>





    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>

    <script>
        $(document).ready(function () {
            $(".update-button").on("click", function (e) {
                var button = $(e.currentTarget);
                button
                    .css("pointer-events", "none")
                    .data("loading-text", button.html())
                    .addClass("btn-loading")
                    .button("loading");
                $('.error-msg').remove();
                $('.warning-msg').removeClass("hidden");
                setTimeout(() => {
                    console.log("Exec timeout")
                    let startTime = Date.now();
                    let count = 30;
                    let buffer = 0
                    var msgShowInterval = setInterval(() => {
                        if (Date.now() - startTime > 8000) { // run only for 8 seconds
                            clearInterval(msgShowInterval);
                            return;
                        }
                        console.log("Exec interval")
                        $('.message-overlay').css({
                            'transform': 'translateY(' + count + 'px)',
                            'transition': '0.1s linear all'
                        });
                        buffer = buffer + 3
                        count = count + 30 + buffer;
                    }, 1500);
                }, 2000)
            });
            $(this).attr('disabled', 'disabled');
        });
    </script>
@endsection
