
@extends("admin.adminlayout")

@section("admin_content")

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="{{route('settings')}}" class="user-item">Site Settings</a>
                        <a href="{{route('account_settings')}}" class="user-item ">Account Settings</a>
                        <a href="{{route('paymentsettings')}}" class="user-item"> Payment Settings</a>
                        <a href="{{route('whatsapp')}}" class="user-item"> Whatsapp Notification Settings</a>
                        <a href="{{route('privacy_policy')}}" class="user-item">  Pages</a>
                        <a href="{{route('cache_settings')}}" class="user-item">  Cache Settings</a>
                        <a href="#" class="user-item active"> Custom Css</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card-title-2">
                        <h4>Custom Css</h4>
                    </div>
                    <div class="card-body">
                        @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                            </div>
                        @endif
                        @if($errors->any()) @include('admin.admin_layout.form_error') @endif


                            <form class="form-horizontal" method="post" action="{{route('update_customcss')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Below code will affect the styling for the Customer Application</label>
                                        <p>
                                            <b>example:</b> <small style="color: #98989b">.item-full-bottom-v2<br>
                                            { color:#000000 !important; }
                                            </small>
                                        </p>
                                        <textarea class="form-control" rows="15" wrap="off" autocapitalize="off" spellcheck="false" name="{{$customcss[17]->id}}">{{$customcss[17]->value}}</textarea>

                                    </div>
                                </div>




                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn">Save Settings</button>
                                </div>
                            </div>
                            </form>








                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
