
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
                        <a href="#" class="user-item active"> Pages</a>
                        <a href="{{route('cache_settings')}}" class="user-item">  Cache Settings</a>
                        <a href="{{route('customcss')}}" class="user-item">  Custom Css</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card-title-2">
                        <h4>Pages</h4>
                    </div>
                    <div class="card-body">
                        @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                            </div>
                        @endif
                        @if($errors->any()) @include('admin.admin_layout.form_error') @endif

                        <form class="form-horizontal" method="post" action="{{route('update_privacy_policy')}}" enctype="multipart/form-data">
                            {{csrf_field()}}



                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-title-2">
                                        <h4>Privacy Policy</h4>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" name="{{$privacy[9]->id}}">{{$privacy[9]->value}}</textarea>

                                    </div>
                                    <div class="card-title-2">
                                        <h4>About Us</h4>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" name="{{$privacy[14]->id}}">{{$privacy[14]->value}}</textarea>

                                    </div>
                                    <div class="card-title-2">
                                        <h4>Terms and Condition</h4>
                                    </div>

                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" name="{{$privacy[15]->id}}">{{$privacy[15]->value}}</textarea>

                                    </div>

                                    <div class="card-title-2">
                                        <h4>Refund & Cancellation</h4>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" name="{{$privacy[16]->id}}">{{$privacy[16]->value}}</textarea>

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


    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
