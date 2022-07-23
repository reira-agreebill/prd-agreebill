@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")


    <div class="container-fluid">


        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill"
                       href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fas fa-cogs mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Site Settings</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill"
                       href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fas fa-mobile mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">App Settings</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill"
                       href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <i class="fas fa-dollar-sign mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Payment Settings</span></a>

                </div>
            </div>


            <div class="col-md-9">

                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
            @endif
            @if($errors->any()) @include('admin.admin_layout.form_error') @endif


            <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel"
                         aria-labelledby="v-pills-home-tab">


                        <form class="form-horizontal" method="post"
                              action="{{route('store_admin.update_store_settings')}}" enctype="multipart/form-data">
                            {{csrf_field()}}


                            <h4 class="font-italic mb-4">Site Settings</h4>


                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Store Name</label>
                                        <input type="text" name="store_name" class="form-control"
                                               value="{{$store->store_name}}" placeholder="Store Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{$store->email}}" placeholder="Email address" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">New Password</label>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="New Password">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name"> Phone
                                            Number<small>(with country code:Eg:+91)</small></label>
                                        <input type="text" class="form-control" value="{{$store->phone}}"
                                               placeholder="Phone Number(with country code:Eg:+91)" name="phone"
                                               required/>
                                    </div>
                                </div>

                            </div>

                            <div class="row">


                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Subscription end
                                            date</label>
                                        <input type="text" class="form-control"
                                               value="{{$store->subscription_end_date}}" readonly disabled/>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label text-danger">Store Logo (358px X
                                            358px)</label>
                                        <input type="file" name="logo_url"
                                               class="form-control ui-autocomplete-input"
                                               placeholder="Application Logo ()" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Store
                                            Currency</label>
                                        <input type="text" name="currency_symbol" class="form-control"
                                               value="{{$store->currency_symbol ?? ''}}"/>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Store Service
                                            Charge</label>
                                        <input type="text" name="service_charge" class="form-control"
                                               value="{{$store->service_charge ?? ''}}"/>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Store
                                            Tax(%)</label>
                                        <input type="text" name="tax" class="form-control"
                                               value="{{$store->tax ?? ''}}"/>
                                    </div>
                                </div>


                            </div>

                            <div class="row">


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Address</label>
                                        <textarea rows="4" name="address" class="form-control"
                                                  required>{{$store->address}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">description</label>
                                        <textarea rows="4" name="description" class="form-control"
                                                  required>{{$store->description}}</textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group" style="margin-top: 15px; padding: 10px;">
                                <div class="col-sm-offset-2 col-sm-12">
                                    <button type="submit"
                                            class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn"
                                            style="float: right">Update
                                    </button>
                                </div>
                            </div>


                    </div>


                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel"
                         aria-labelledby="v-pills-profile-tab">

                        <h4 class="font-italic mb-4">App Settings <span class="text-danger"> (Enable/Desable)</span>
                        </h4>


                        <div class="row">


                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Accept order</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->is_accept_order? "checked":null}} name="is_accept_order">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Search Section</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->search_enable? "checked":null}} name="search_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Language Section</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->language_enable? "checked":null}} name="language_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Call Waiter Button</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->is_call_waiter_enable? "checked":null}} name="is_call_waiter_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">

                                    <label class="form-control-label">Send Order to Whatsapp</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->whatsappbutton_enable	? "checked":null}} name="whatsappbutton_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Table</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->table_enable	? "checked":null}} name="table_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Dining</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->dining_enable	? "checked":null}} name="dining_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Delivery</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->delivery_enable	? "checked":null}} name="delivery_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Takeaway</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->takeaway_enable	? "checked":null}} name="takeaway_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">

                                    <label class="form-control-label">Room</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->is_room_delivery_enable	? "checked":null}} name="is_room_delivery_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <div class="form-group">

                                    <label class="form-control-label">Room Delivery DOB Validation</label><br>
                                    <label class="custom-toggle">
                                        <input type="checkbox"
                                               {{$store->is_room_delivery_dob_enable	? "checked":null}} name="is_room_delivery_dob_enable">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                              data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>


                        </div>
                        <div class="form-group" style="margin-top: 15px; padding: 10px;">
                            <div class="col-sm-offset-2 col-sm-12">
                                <button type="submit"
                                        class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn"
                                        style="float: right">Update
                                </button>
                            </div>
                        </div>

                        </form>


                    </div>


                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel"
                         aria-labelledby="v-pills-messages-tab">
                        <h4 class="font-italic mb-4">Payment Settings</h4>
                        <form method="post" id="payment-settings"
                              action="{{route('store_admin.update_store_payment_settings')}}">
                            {{csrf_field()}}

                            <table class="table align-items-left table-flush table-hover">

                                <tbody>
                                <tr>
                                    <td class="table-user">
                                        <b>Cash</b>
                                    </td>

                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings->IsCodEnabled ?? '' == 1 ? "checked":false}} name="IsCodEnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off"
                                                  data-label-on="On"></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-user">
                                        <b>Debit / QR </b>
                                    </td>

                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings->IsQREnabled ?? '' == 1 ? "checked":false}} name="IsQREnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off"
                                                  data-label-on="On"></span>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="table-user">
                                        <b>Paypal</b>
                                    </td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings->IsPaypalEnabled ?? '' == 1 ? "checked":false}} name="IsPaypalEnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off"
                                                  data-label-on="On"></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-user">
                                        <b>Stripe</b>
                                    </td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings->IsStripeEnabled ?? '' == 1 ? "checked":false}} name="IsStripeEnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off"
                                                  data-label-on="On"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-user">
                                        <b>Razorpay</b>
                                    </td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings['IsRazorpayEnabled'] ?? '' == 1  ? "checked":false}} name="IsRazorpayEnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off"
                                                  data-label-on="On"></span>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="table-user">
                                        <b>PayStack</b>
                                    </td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings['IsPayStackEnabled'] ?? '' == 1  ? "checked":false}} name="IsPayStackEnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off"
                                                  data-label-on="On"></span>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="table-user">
                                        <b>MercadoPago</b>
                                    </td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings['IsMercadoPagoEnabled'] ?? '' == 1  ? "checked":false}} name="IsMercadoPagoEnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off"
                                                  data-label-on="On"></span>
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
                                        <select name="StoreCurrency" value="{{$store_settings['StoreCurrency'] ?? ''}}"
                                                class="form-control">
                                            <option value="">Select Currency</option>
                                            @foreach(config('global.currency') as $key => $currency)
                                                <option
                                                    {{($store_settings['StoreCurrency'] ?? '') == $currency ? "selected":null}} value="{{$currency}}"> {{$key}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h2 class="text-indigo"> Paypal:</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Paypal Environment :</label>
                                        <select class="form-control" value="{{$store_settings['PaypalMode'] ?? ''}}"
                                                name="PaypalMode">
                                            <option
                                                value="sandbox" {{($store_settings['PaypalMode'] ?? '') == 'sandbox' ? "selected":NULL}}>
                                                Test mode
                                            </option>
                                            <option
                                                value="production" {{($store_settings['PaypalMode'] ?? '') == 'production' ? "selected":NULL}}>
                                                Live mode
                                            </option>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Paypal Client ID:</label>
                                        <input type="text" name="PaypalKeyId"
                                               value="{{$store_settings->PaypalKeyId ?? ''}}" class="form-control"
                                               placeholder="Paypal Client ID">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Paypal Secret Key:</label>
                                        <input type="text" name="PaypalKeySecret"
                                               value="{{$store_settings->PaypalKeySecret ?? ''}}" class="form-control"
                                               placeholder="Paypal Secret Key">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <h2 class="text-indigo"> Stripe:</h2>
                                    <hr>


                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Stripe Public
                                            Key:</label>
                                        <input type="text" value="{{$store_settings->StripePublishableKey ?? ''}}"
                                               name="StripePublishableKey" class="form-control"
                                               placeholder="Stripe Public Key">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Stripe Secret Key:</label>
                                        <input type="text" name="StripeSecretKey"
                                               value="{{$store_settings->StripeSecretKey ?? ''}}" class="form-control"
                                               placeholder="Stripe Secret Key">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <label class="form-control-label">Show Stripe Postal Code: </label><br>
                                        <label class="custom-toggle">
                                            <input type="checkbox"
                                                   {{$store_settings->IsStripeZipEnabled ?? '' ? "checked":null}} name="IsStripeZipEnabled">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                  data-label-on="Yes"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h2 class="text-indigo">Razorpay:</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Razorpay Key Id</label>
                                        <input type="text" name="RazorpayKeyId"
                                               value="{{$store_settings->RazorpayKeyId ?? ''}}" class="form-control"
                                               placeholder="Razorpay Key Id">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Razorpay Key Secret</label>
                                        <input type="text" name="RazorpayKeySecret"
                                               value="{{$store_settings->RazorpayKeySecret ?? ''}}" class="form-control"
                                               placeholder="Razorpay Key Secret">
                                    </div>
                                </div>

                                {{-----------------------------}}

                                <div class="col-lg-12">
                                    <h2 class="text-indigo">PayStack:</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">PayStack Key Id</label>
                                        <input type="text" name="PayStackPublishableKey"
                                               value="{{$store_settings->PayStackPublishableKey ?? ''}}"
                                               class="form-control" placeholder="PayStack Key Id">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">PayStack Key Secret</label>
                                        <input type="text" name="PayStackSecretKey"
                                               value="{{$store_settings->PayStackSecretKey ?? ''}}" class="form-control"
                                               placeholder="PayStack Key Secret">
                                    </div>
                                </div>


                            </div>




{{--                            ------------------------}}


                            <div class="col-lg-12">
                                <h2 class="text-indigo">MercadoPago:</h2>
                                <hr>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">MercadoPago Secret</label>
                                    <input type="text" name="MercadoPagoKeySecret"
                                           value="{{$store_settings->MercadoPagoKeySecret ?? ''}}"
                                           class="form-control" placeholder="MercadoPago Secret">
                                </div>
                            </div>








                    <div class="form-group" style="margin-top: 15px; padding: 10px;">
                                <div class="col-sm-offset-2 col-sm-12">
                                    <button type="submit"

                                            class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn"
                                            style="float: right">Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>


        </div>
    </div>


    </div>





@endsection
