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
                <h4 class="mb-0">App Configuration</h4>
                <br>

            </div>
            <div class="row container">
                <div class="col-lg-12 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <h3> </h3>
                        </div>
                        <div class="login-form">


                            <form method="POST" action="{{ url('install/postDatabase') }}" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="box">
                                    @if(Session::has('message'))
                                        <div style="padding: 10px; background-color: #F44336; margin-bottom: 1rem; border-radius: 0.275rem;">
                                            <p style="color: #fff"> {{ Session::get('message') }} </p>
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div style="padding: 10px; background-color: #F44336; margin-bottom: 1rem; border-radius: 0.275rem;">
                                            <p style="color: #fff"> {{ implode('', $errors->all(':message')) }} </p>
                                        </div>
                                    @endif

                                </div>
                                <div class="box">
                                    <p>Enter your database connection details.</p>
                                    <div class="configure-form">
                                        <div class="form-group {{ $errors->has('db.host') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="host">Host <span>*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('db.host') }}" name="db[host]" placeholder="Mostly 127.0.0.1 or localhost" id="host" class="form-control" autofocus /> {!!
                    $errors->first('db.host', ' <span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('db.port') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="port">Port <span>*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('db.port') }}" name="db[port]" placeholder="Mostly 3306" id="port" class="form-control" /> {!! $errors->first('db.port',
                    ' <span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('db.database') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="database">Database <span>*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('db.database') }}" name="db[database]" placeholder="Database name" id="database" class="form-control" autocomplete="off" />
                                                {!! $errors->first('db.database', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('db.username') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="db-username">DB Username <span>*</span></label
                                            >
                                            <div class="col-sm-12">
                                                <input autocomplete="new-user" type="text" value="{{ old('db.username') }}" name="db[username]" placeholder="Database username" id="db-username" class="form-control"autocomplete="off" />
                                                {!! $errors->first('db.username', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="db-password">DB Password</label>
                                            <div class="col-sm-12">
                                                <input autocomplete="new-password" type="text" value="{{ old('db.password') }}" name="db[password]" placeholder="Database password" id="db-password" class="form-control" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="box">
                                    <p>Enter credentials for the administrator.</p>
                                    <div class="configure-form">
                                        <div class="form-group {{ $errors->has('admin.name') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="admin-name">Full Name<span>*</span></label
                                            >
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('admin.name') }}" name="admin[name]" placeholder="Admin's full name" id="admin-name" class="form-control" />
                                                {!! $errors->first('admin.name', ' <span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('admin.email') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="admin-email">Email <span>*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('admin.email') }}" name="admin[email]" placeholder="Email address" id="admin-email" class="form-control" />                    {!! $errors->first('admin.email', ' <span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('admin.password') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="admin-password">Password <span>*</span></label
                                            >
                                            <div class="col-sm-12">
                                                <input type="password" value="{{ old('admin.password') }}" name="admin[password]" placeholder="Password" id="admin-password" class="form-control"/>
                                                {!! $errors->first('admin.password', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>


{{--                                Application Details--}}

                                <div class="box">
                                    <p>Enter Application Details</p>
                                    <div class="configure-form">
                                        <div class="form-group {{ $errors->has('appinfo.application_name') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="admin-name">Application Name<span>*</span></label
                                            >
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('appinfo.application_name') }}" name="appinfo[application_name]" placeholder="Application Name" id="appinfo-application_name" class="form-control" />
                                                {!! $errors->first('admin.name', ' <span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('appinfo.application_email') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="admin-application_email">Email <span>*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('appinfo.application_email') }}" name="appinfo[application_email]" placeholder="Email address" id="appinfo-application_email" class="form-control" />                    {!! $errors->first('admin.email', ' <span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>


                                        <div class="form-group {{ $errors->has('appinfo.currency_symbol') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="appinfo-currency_symbol">Currency Symbol<span>*</span></label
                                            >
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('appinfo.currency_symbol') }}" name="appinfo[currency_symbol]" placeholder="Currency Symbol" id="appinfo-currency_symbol" class="form-control"/>
                                                {!! $errors->first('appinfo.currency_symbol', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('appinfo.contact_no') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="appinfo-contact_no">Contact Number<span>*</span></label
                                            >
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('appinfo.contact_no') }}" name="appinfo[contact_no]" placeholder="Contact Number" id="appinfo-contact_no" class="form-control"/>
                                                {!! $errors->first('appinfo.contact_no', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('appinfo.Address') ? 'has-error': '' }}">
                                            <label class="control-label col-sm-3" for="appinfo-Address">Address<span>*</span></label
                                            >
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('appinfo.Address') }}" name="appinfo[Address]" placeholder="Address" id="appinfo-Address" class="form-control"/>
                                                {!! $errors->first('appinfo.Address', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <input type="hidden" value="no-logo.png" name="appinfo[application_logo]" id="appinfo-application_logo"/>
                                <input type="hidden" value="1" name="appinfo[theme_id]" id="appinfo-theme_id"/>
                                <input type="hidden" value="left" name="appinfo[currency_symbol_location]" id="appinfo-currency_symbol_location"/>


                                <div class="content-buttons clearfix">
                                    <button type="submit" class="btn btngradientnew btn-lg btn-block update-button">Next</button>
                                </div>
                            </form>


                            <br>

                        </div>
                    </div>
                </div>
            </div>




        </div>






@endsection
