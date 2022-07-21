
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
                        <a href="#" class="user-item active"> Cache Settings</a>
                        <a href="{{route('customcss')}}" class="user-item">  Custom Css</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card-title-2">
                        <h4>Cache Settings</h4>
                    </div>
                    <div class="card-body">
                        @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                            </div>
                        @endif
                        @if($errors->any()) @include('admin.admin_layout.form_error') @endif



                                <table class="table align-items-left table-flush table-hover">

                                    <tbody>

                                    <tr>
                                        <td class="table-user">
                                            <b>Force Clear Cache</b>
                                        </td>
                                        <td>
                                            <a href="{{route('view_cache')}}" class="btn btn-primary btn-sm">Force Clear Cache</a>
                                        </td>
                                    </tr>






                                    </tbody>
                                </table>
                                <hr>







                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
