
@extends("admin.adminlayout")

@section("admin_content")

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="{{route('settings')}}" class="user-item">Site Settings</a>
                        <a href="{{route('account_settings')}}" class="user-item ">Account Settings</a>
                        <a href="#" class="user-item active"> Payment Settings</a>
                        <a href="{{route('whatsapp')}}" class="user-item"> Whatsapp Notification Settings</a>
                        <a href="{{route('privacy_policy')}}" class="user-item">  Pages</a>
                        <a href="{{route('cache_settings')}}" class="user-item">  Cache Settings</a>
                        <a href="{{route('customcss')}}" class="user-item">  Custom Css</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card-title-2">
                        <h4>Payment Settings</h4>
                    </div>
                    <div class="card-body">
                        @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                            </div>
                        @endif
                        @if($errors->any()) @include('admin.admin_layout.form_error') @endif

                        <form class="form-horizontal" method="post" action="{{route('update_payment_settings')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                          <table class="table align-items-left table-flush table-hover">

                              <tbody>

                              <tr>
                                  <td class="table-user">
                                      <b style="color: red">Subscription Page Force Redirect</b>
                                  </td>
                                  <td>
                                      <label class="custom-toggle custom-toggle-danger">
                                          <input type="checkbox" name="{{$settings[22]->id}}" {{$settings[22]->value ==1 ? "checked":NULL}} >
                                          <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                      </label>
                                  </td>
                              </tr>



                              <tr>
                                  <td class="table-user">
                                      <b>Cash</b>
                                  </td>

                                  <td>
                                      <label class="custom-toggle">
                                          <input type="checkbox" checked="" disabled>
                                          <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                      </label>
                                  </td>
                              </tr>


                              <tr>
                                  <td class="table-user">
                                      <b>Paypal</b>
                                  </td>
                                  <td>
                                      <label class="custom-toggle">
                                          <input type="checkbox" name="{{$settings[18]->id}}" {{$settings[18]->value ==1 ? "checked":NULL}} >
                                          <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                      </label>
                                  </td>
                              </tr>

                              <tr>
                                  <td class="table-user">
                                      <b>Stripe</b>
                                  </td>
                                  <td>
                                      <label class="custom-toggle">
                                          <input type="checkbox" name="{{$settings[0]->id}}" {{$settings[0]->value ==1 ? "checked":NULL}} >
                                          <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                      </label>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="table-user">
                                      <b>Razorpay</b>
                                  </td>
                                  <td>
                                      <label class="custom-toggle">
                                          <input type="checkbox" name="{{$settings[11]->id}}" {{$settings[11]->value ==1 ? "checked":NULL}} >
                                          <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                      </label>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Currency:</label>
                                        <select name="{{$settings[1]->id}}" value="{{$settings[1]->value ?? ''}}"
                                                class="form-control">
                                            <option value="">Select Currency</option>
                                            @foreach(config('global.currency') as $key => $currency)
                                                <option
                                                    {{($settings[1]->value ?? '') == $currency ? "selected":null}} value="{{$currency}}"> {{$key}}</option>
                                            @endforeach

                                        </select>


{{--                                        <input type="text"  value="{{$settings[1]->value}}" name="{{$settings[1]->id}}"  class="form-control" placeholder="Stripe Public Key">--}}
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h2 class="text-indigo"> Paypal:</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Paypal Environment :</label>
                                        <select class="form-control" name="{{$settings[19]->id}}">
                                            <option {{($settings[19]->value ?? '') == "sandbox" ? "selected":"" }} value="sandbox">Test mode</option>
                                            <option {{($settings[19]->value ?? '') == "production" ? "selected":"" }}  value="production">Live mode</option>

                                        </select>

                                        </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Paypal Client ID:</label>
                                        <input type="text"  value="{{$settings[20]->value}}" name="{{$settings[20]->id}}" class="form-control" placeholder="Paypal Client ID">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Paypal Secret Key:</label>
                                        <input type="text" value="{{$settings[21]->value}}" name="{{$settings[21]->id}}"  class="form-control" placeholder="Paypal Secret Key">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <h2 class="text-indigo"> Stripe:</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Stripe Public Key:</label>
                                        <input type="text"  value="{{$settings[2]->value}}" name="{{$settings[2]->id}}" class="form-control" placeholder="Stripe Public Key">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Stripe Secret Key:</label>
                                        <input type="text" value="{{$settings[3]->value}}" name="{{$settings[3]->id}}"  class="form-control" placeholder="Stripe Secret Key">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h2 class="text-indigo">Razorpay:</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Razorpay Key Id</label>
                                        <input type="text"  value="{{$settings[12]->value}}" name="{{$settings[12]->id}}" class="form-control" placeholder="Razorpay Key Id">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Razor pay Key Secret</label>
                                        <input type="text" value="{{$settings[13]->value}}" name="{{$settings[13]->id}}"  class="form-control" placeholder="Razorpay Key Secret">
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
