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
                    <h4 class="mb-0">Install Now</h4>
                    <br>

                </div>

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
                        <tr>
                            <td>
                                {{ $label }}
                                @if($label == "PHP = 7.2.x" && !$satisfied)
                                    <br>
                                    <span class="text-danger"><b>PHP Version must be 7.2 (or 7.2.x)</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <i class="fa fa-{{ $satisfied ? 'check' : 'times' }}" aria-hidden="true"></i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="box">
                <p style="padding-left: 10px; color: red">Please make sure you have set the correct permissions for the directories listed below. All these directories/files should be writable.</p>

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
                            <tr>
                                <td>{{ $label }}</td>
                                <td class="text-center">
                                    <i class="fa fa-{{ $satisfied ? 'check' : 'times' }}" aria-hidden="true"></i>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="content-buttons clearfix" style="padding:20px">
                <a href="{{ $requirement->satisfied() ? url('install/dbsettings') : '#' }}" class="btn btngradientnew btn-lg btn-block update-button" {{ $requirement->satisfied() ? '' : 'disabled' }}>
                    Continue
                </a>
            </div>
            <br>
    </div>






@endsection
