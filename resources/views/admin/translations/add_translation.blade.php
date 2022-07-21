@extends("admin.adminlayout")

@section("admin_content")


    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card-body">
                        @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                            </div>
                        @endif
                        @if($errors->any()) @include('admin.admin_layout.form_error') @endif

                        <form class="form-horizontal" method="post" action="{{route('add_translations')}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Name </label>
                                        <input type="text" name="language_name" class="form-control"
                                               placeholder="Language Name" required>
                                    </div>
                                </div>

                                <div class="col-lg-3" style="margin-top: 20px;">
                                    <div class="form-group">

                                        <label class="form-control-label">Default : On/Off</label><br>
                                        <label class="custom-toggle">
                                            <input type="checkbox" name="is_default">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                  data-label-on="Yes"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="margin-top: 20px;">
                                    <div class="form-group">

                                        <label class="form-control-label">Enable : On/Off</label><br>
                                        <label class="custom-toggle">
                                            <input type="checkbox" checked name="is_active">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                  data-label-on="Yes"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>

{{--                            Payment Page Start--}}

                            <div class="card-header bg-gradient-gray-dark text-white">User Panel <b class="text-success">Payment Page</b></div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Payment Method </label>
                                                <input type="text" name="payment_method" class="form-control" value="Payment Method "
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Cash on Delivery</label>
                                                <input type="text" name="cash_on_delivery" class="form-control" value="Cash on Delivery"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">WE ACCEPT Master Card / Visa Card / Rupay</label>
                                                <input type="text" name="we_accept" class="form-control" value="WE ACCEPT Master Card / Visa Card / Rupay"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Email</label>
                                                <input type="text" name="email" class="form-control" value="Email"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Pay</label>
                                                <input type="text" name="pay" class="form-control" value="Pay"
                                                       required>
                                            </div>


{{--                                            ------****-----new-----****--------}}



                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">MercadoPago</label>
                                                <input type="text" name="MercadoPago" class="form-control" value="MercadoPago"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">PayStack</label>
                                                <input type="text" name="pay_stack" class="form-control" value="PayStack"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Phone Number/Order Id *</label>
                                                <input type="text" name="menu_phone_number_or_phone" class="form-control" value="Phone Number/Order Id *"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Room</label>
                                                <input type="text" name="cart_order_type_status_room" class="form-control" value="Room"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Room Number</label>
                                                <input type="text" name="room_number" class="form-control" value="Room Number"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Date of Birth</label>
                                                <input type="text" name="dob_customer" class="form-control" value="Date of Birth"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">AGE ERROR AGE IS UNDER 18</label>
                                                <input type="text" name="age_error_message" class="form-control" value="AGE ERROR AGE IS UNDER 18"
                                                       required>
                                            </div>




                                            {{--                                            ------****-----new-----****--------}}
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Cash </label>
                                                <input type="text" name="cash" class="form-control" value="Cash"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Cash Description</label>
                                                <input type="text" name="cash_description" class="form-control" value="Please keep exact change handy to help us serve you better"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Payment Processing...</label>
                                                <input type="text" name="processing_order" class="form-control" value="Payment Processing..."
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Continue</label>
                                                <input type="text" name="continue" class="form-control" value="Continue"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Select Language</label>
                                                <input type="text" name="select_language" class="form-control" value="Select Language"
                                                       required>
                                            </div>



                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Stripe</label>
                                                <input type="text" name="stripe" class="form-control" value="Stripe"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Stripe Online Payment</label>
                                                <input type="text" name="stripe_online_payment" class="form-control" value="Stripe Online Payment"
                                                       required>
                                            </div>



                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Razorpay</label>
                                                <input type="text" name="razorpay" class="form-control" value="Razorpay"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">PayPal</label>
                                                <input type="text" name="paypal" class="form-control" value="PayPal"
                                                       required>
                                            </div>



                                        </div>
                                    </div>

                                </div>

                            </div>



{{--                            Payment Page End--}}

{{--                            User Panel Start--}}

                            <div class="card-header bg-gradient-gray-dark text-white">User Panel <b class="text-success">Cart Page</b></div>




                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Order Type</label>
                                                <input type="text" name="order_type" class="form-control" value="Order Type"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Delivery</label>
                                                <input type="text" name="cart_order_type_status_delivery" class="form-control" value="Delivery"
                                                       required>
                                            </div>

                                        </div>
                                    </div>

                                        </div>

                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Dining</label>
                                                <input type="text" name="cart_order_type_status_dining" class="form-control" value="Dining"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Address</label>
                                                <input type="text" name="address" class="form-control" value="Address"
                                                       required>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Takeaway</label>
                                                <input type="text" name="cart_order_type_status_takeaway" class="form-control" value="Takeaway"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Address : Required Field MSG</label>
                                                <input type="text" name="error_message_field_required" class="form-control" value="Required Field"
                                                       required>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>






                            <div class="card-header bg-gradient-gray-dark text-white">Home Page</div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Home</label>
                                                <input type="text" name="home" class="form-control" value="Home"
                                                       required>
                                            </div>



                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Service</label>
                                                <input type="text" name="service" class="form-control" value="Service"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Pricing</label>
                                                <input type="text" name="pricing" class="form-control" value="Pricing"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Privacy
                                                    Policy</label>
                                                <input type="text" name="privacy_policy" class="form-control"
                                                       value="Privacy Policy" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Login</label>
                                                <input type="text" name="login" class="form-control" value="Login"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Register</label>
                                                <input type="text" name="register" class="form-control" value="Register"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Home First
                                                    Tittle </label>
                                                <input type="text" name="home_first_title" class="form-control"
                                                       value="Re-open your restaurants" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Home First
                                                    Sub-Tittle</label>
                                                <textarea name="home_first_sub_title" class="form-control" rows="3"
                                                          required>With a contactless MAX-QR <b>MENU</b>.<br>Make your restaurant a safe place to eat or grab-and-go by deploying a touch-free QR Code menu.</textarea>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">How It Works? </label>
                                                <input type="text" name="how_it_works_1" class="form-control"
                                                       value="How It Works?" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Create Account to get started.</label>
                                                <input type="text" name="register_footer_subtitle" class="form-control"
                                                       value="Create Account to get started." required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Create Menu</label>
                                                <input type="text" name="create_menu" class="form-control"
                                                       value="Create Menu" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Create Menu (Subtitle)</label>
                                                <input type="text" name="create_menu_footer_subtitle" class="form-control"
                                                       value="Create your menu visible for your customers." required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Print QR Code</label>
                                                <input type="text" name="print_qr_code" class="form-control"
                                                       value="Print QR Code" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Print QR Code (Subtitle)</label>
                                                <input type="text" name="print_qr_code_footer_subtitle" class="form-control"
                                                       value="Put the printed tags on your tables." required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Receive Orders</label>
                                                <input type="text" name="receive_orders" class="form-control"
                                                       value="Receive Orders" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Receive Orders (Subtitle)</label>
                                                <input type="text" name="receive_orders_footer_subtitle" class="form-control"
                                                       value="When they order something, you get notified instantly!" required>
                                            </div>



                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Why Contactless Menu?</label>
                                                <input type="text" name="why_contactless_menu" class="form-control"
                                                       value="Why Contactless Menu?" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Safety First (heading)</label>
                                                <input type="text" name="safety_first" class="form-control"
                                                       value="Safety First" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Safety First (Sub-Tittle)</label>
                                                <textarea name="safety_first_sub_title" class="form-control" rows="3"
                                                          required>Limiting the use of physical menus and promoting touchless QR Code menus reduces the risk of virus transmission, and keeps your customers and employees safe.</textarea>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">No App Download Required (heading)</label>
                                                <input type="text" name="no_app_download_required" class="form-control"
                                                       value="No App Download Required" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">No App Download Required (Sub-Tittle)</label>
                                                <textarea name="no_app_download_required_sub_title" class="form-control" rows="2"
                                                          required>Your diners can scan the QR Code using their phone's camera</textarea>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Easy To Build & Update (heading)</label>
                                                <input type="text" name="easy_to_build_update" class="form-control"
                                                       value="Easy To Build & Update" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Easy To Build & Update (Sub-Tittle)</label>
                                                <textarea name="easy_to_build_update_sub_title" class="form-control" rows="3"
                                                          required>Create contactless menu QR Codes under 3 minutes. Later, upload & save a new menu to the same QR Code.</textarea>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Inspires The Confidence To Step Out (heading)</label>
                                                <input type="text" name="inspires_the_confidence" class="form-control"
                                                       value="Inspires The Confidence To Step Out" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Inspires The Confidence To Step Out (Sub-Tittle)</label>
                                                <textarea name="inspires_the_confidence_sub_title" class="form-control" rows="2"
                                                          required>Re-align your restaurant functioning with contactless at the core.</textarea>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Give us a Call (Footer)</label>
                                                <input type="text" name="give_us_call" class="form-control"
                                                       value="Give us a Call" required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Send us a Message (Footer)</label>
                                                <input type="text" name="send_us_message" class="form-control"
                                                       value="Send us a Message" required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Visit our Location (Footer)</label>
                                                <input type="text" name="visit_our_location" class="form-control"
                                                       value="Visit our Location" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Crafted with <i class="fa fa-heart text-danger"></i> by</label>
                                                <input type="text" name="crafted_with_love" class="form-control"
                                                       value="Crafted with <3 by " required>
                                            </div>






                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Benefits Of A Contactless Menu</label>
                                                <input type="text" name="benefits_contactless_menu" class="form-control" value="Benefits Of A Contactless Menu"
                                                       required>
                                            </div>

{{--                                            code end--}}

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Safer To Use (Heading)</label>
                                                <input type="text" name="safer_to_use" class="form-control" value="Safer To Use"
                                                       required>
                                            </div>


{{--                                            code end--}}

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Safer To Use (Sub-Tittle)</label>
                                                <input type="text" name="safer_to_use_sub_title" class="form-control" value="Germ-free, greener, quicker and safer than the traditional menu."
                                                       required>
                                            </div>
{{--                                            code end--}}

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">COVID Compliant (Heading)</label>
                                                <input type="text" name="covid_compliant" class="form-control" value="COVID Compliant"
                                                       required>
                                            </div>
{{--                                            code end--}}
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">COVID Compliant (Sub-Tittle)</label>
                                                <textarea rows="2" name="covid_compliant_sub_title" class="form-control"
                                                          required>COVID compliance without single use paper menus or disinfectant.</textarea>
                                            </div>
{{--                                            code end--}}

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Easy To Update (Heading)</label>
                                                <input type="text" name="easy_to_update" class="form-control" value="Easy To Update"
                                                       required>
                                            </div>

{{--                                            code end--}}

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Easy To Update (Sub-Tittle)</label>
                                                <textarea name="easy_to_update_sub_title" class="form-control" required>Use the menu builder to instantly change your menu. No re-prints!</textarea>
                                            </div>
{{--                                            code end--}}
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">See A Demo Online Menu (Title)</label>
                                                <input type="text" name="see_a_demo_menu" class="form-control" value="See A Demo Online Menu"
                                                       required>
                                            </div>

{{--                                            code end--}}

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">See A Demo Online Menu (Point 1)</label>
                                                <textarea name="see_a_demo_menu_point1" class="form-control"
                                                          required>Use the phone camera or QR Application to scan the code.</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">See A Demo Online Menu (Point 2)</label>
                                                <textarea name="see_a_demo_menu_point2" class="form-control"
                                                          required>Scroll around the menu and make your order.</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">See A Demo Online Menu (Point 3)</label>
                                                <textarea name="see_a_demo_menu_point3" class="form-control"
                                                          required>Your order is instantly received, and it’s coming!</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-header bg-gradient-gray-dark text-white">Customer Side</div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Call the waiter</label>
                                                <input type="text" name="call_the_waiter" class="form-control" value="Call the waiter"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Search for Products...</label>
                                                <input type="text" name="search_products" class="form-control" value="Search for Products..."
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Categories</label>
                                                <input type="text" name="menu_categories" class="form-control" value="Categories"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promos for you</label>
                                                <input type="text" name="menu_promo" class="form-control" value="Promos for you"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Recommend for you</label>
                                                <input type="text" name="menu_recommend" class="form-control" value="Recommend for you"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">CUSTOM</label>
                                                <input type="text" name="menu_custom" class="form-control" value="CUSTOM"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Name</label>
                                                <input type="text" name="menu_name" class="form-control" value="Name"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Phone Number</label>
                                                <input type="text" name="menu_phone_number" class="form-control" value="Phone Number"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Comment</label>
                                                <input type="text" name="menu_comment" class="form-control" value="Comment"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Select Your Table</label>
                                                <input type="text" name="select_your_table" class="form-control" value="Select Your Table"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Enter Your Table Code</label>
                                                <input type="text" name="enter_your_table_code" class="form-control" value="Enter Your Table Code"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Table Code Error Message</label>
                                                <input type="text" name="table_code_error_message" class="form-control" value="INVALID TABLE CODE/PLEASE ENTER A VALID CODE"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Subtotal</label>
                                                <input type="text" name="menu_subtotal" class="form-control" value="Subtotal"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Service Charge</label>
                                                <input type="text" name="menu_service_charge" class="form-control" value="Service Charge"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Tax</label>
                                                <input type="text" name="menu_tax" class="form-control" value="Tax"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Total Cost</label>
                                                <input type="text" name="menu_total_cost" class="form-control" value="Total Cost"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Confirm your order.</label>
                                                <input type="text" name="menu_confirm_order" class="form-control" value="Confirm your order."
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Menu</label>
                                                <input type="text" name="menu" class="form-control" value="Menu"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Cart</label>
                                                <input type="text" name="cart" class="form-control" value="Cart"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">My Order</label>
                                                <input type="text" name="my_order" class="form-control" value="My Order"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Customizable</label>
                                                <input type="text" name="customizable" class="form-control" value="CUSTOMIZABLE"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Available</label>
                                                <input type="text" name="available" class="form-control" value="AVAILABLE"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Not Available</label>
                                                <input type="text" name="not_available" class="form-control" value="NOT AVAILABLE"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Recommended</label>
                                                <input type="text" name="recommended" class="form-control" value="RECOMMENDED"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Close</label>
                                                <input type="text" name="menu_close" class="form-control" value="Close"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Save Changes</label>
                                                <input type="text" name="menu_save_changes" class="form-control" value="Save Changes"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Add to Cart</label>
                                                <input type="text" name="menu_add_to_cart" class="form-control" value="Add to Cart"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Item Add To Cart Message</label>
                                                <input type="text" name="item_add_to_cart" class="form-control" value="Item Added To Cart"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">REC</label>
                                                <input type="text" name="menu_rec" class="form-control" value="REC"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Order Placed Successfully.</label>
                                                <input type="text" name="menu_order_successmsg" class="form-control" value="Order Placed Successfully."
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Check Order Status</label>
                                                <input type="text" name="menu_check_orderstatus" class="form-control" value="Check Order Status"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Your Cart is empty.</label>
                                                <input type="text" name="menu_cart_empty" class="form-control" value="Your Cart is empty."
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Back to Menu</label>
                                                <input type="text" name="back_to_menu" class="form-control" value="Back to Menu"
                                                       required>
                                            </div>







                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">MRP</label>
                                                <input type="text" name="menu_mrp" class="form-control" value="MRP"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Cooking Time</label>
                                                <input type="text" name="cooking_time" class="form-control" value="Cooking Time"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Minute</label>
                                                <input type="text" name="cooking_time_unit" class="form-control" value="Cooking Time"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Product Details</label>
                                                <input type="text" name="menu_product_details" class="form-control" value="Product Details"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Maybe You Like this.</label>
                                                <input type="text" name="menu_maybe_you_likethis" class="form-control" value="Maybe You Like this."
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Category Item Text</label>
                                                <input type="text" name="menu_category_items" class="form-control" value="Items"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Customization</label>
                                                <input type="text" name="menu_customizations_text" class="form-control" value="Customization"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Search Order</label>
                                                <input type="text" name="menu_search_order" class="form-control" value="Search Order"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Current Order</label>
                                                <input type="text" name="menu_current_order" class="form-control" value="Current Order"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Completed Order</label>
                                                <input type="text" name="menu_completed_order" class="form-control" value="Completed Order"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Order ID</label>
                                                <input type="text" name="menu_order_id" class="form-control" value="Order ID"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Store</label>
                                                <input type="text" name="menu_store" class="form-control" value="Store"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Bill Amount</label>
                                                <input type="text" name="menu_bill_amount" class="form-control" value="Bill Amount"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Call the Waiter</label>
                                                <input type="text" name="call_the_waiter" class="form-control" value="Call the Waiter"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Call Now</label>
                                                <input type="text" name="call_the_waite_now" class="form-control" value="Call Now"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Calling Waiter Message</label>
                                                <input type="text" name="calling_waiter_msg" class="form-control" value="calling waiter ...."
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Oder Status Text: Pending</label>
                                                <input type="text" name="order_status_pending" class="form-control" value="Pending"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Oder Status Text: Accepted</label>
                                                <input type="text" name="order_status_accepted" class="form-control" value="Accepted"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Oder Status Text: Ready to Serve</label>
                                                <input type="text" name="order_status_ready" class="form-control" value="Ready to Serve"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Oder Status Text: Completed</label>
                                                <input type="text" name="order_status_completed" class="form-control" value="Completed"
                                                       required>
                                            </div>






                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-header bg-gradient-gray-dark text-white">Store Side</div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Dashboard</label>
                                                <input type="text" name="store_dashboard" class="form-control" value="Dashboard"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders</label>
                                                <input type="text" name="store_orders" class="form-control" value="Orders"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Waiter Call</label>
                                                <input type="text" name="store_waitercall" class="form-control" value="Waiter Call"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status Screen</label>
                                                <input type="text" name="store_orderstatus_screen" class="form-control" value="Orders Status Screen"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promo Banner</label>
                                                <input type="text" name="store_promo_banner" class="form-control" value="Promo Banner"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Inventory</label>
                                                <input type="text" name="store_inventory" class="form-control" value="Inventory"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Tables</label>
                                                <input type="text" name="store_tables" class="form-control" value="Tables"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Print Qr-Code</label>
                                                <input type="text" name="store_printqr" class="form-control" value="Print Qr-Code"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Subscription Plans</label>
                                                <input type="text" name="store_subscription_plans" class="form-control" value="Subscription Plans"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Customers</label>
                                                <input type="text" name="store_customers" class="form-control" value="Customers"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Settings</label>
                                                <input type="text" name="store_settings" class="form-control" value="Settings"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Logout</label>
                                                <input type="text" name="store_logout" class="form-control" value="Logout"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Enable Whatsapp Notification</label>
                                                <input type="text" name="store_whatsapp_notification" class="form-control" value="Enable Whatsapp Notification"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Quick Stats</label>
                                                <input type="text" name="store_quickstats" class="form-control" value="Quick Stats"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">TOTAL ORDERS</label>
                                                <input type="text" name="store_total_orders" class="form-control" value="TOTAL ORDERS"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Item Sold</label>
                                                <input type="text" name="store_item_sold" class="form-control" value="Item Sold"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Total Earnings</label>
                                                <input type="text" name="store_total_earnings" class="form-control" value="Total Earnings"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Plan end date</label>
                                                <input type="text" name="store_plan_date" class="form-control" value="Plan end date"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Copy your menu link to share with your customers</label>
                                                <input type="text" name="store_copy_text" class="form-control" value="Copy your menu link to share with your customers"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Copy</label>
                                                <input type="text" name="store_copy" class="form-control" value="Copy"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Pending Orders</label>
                                                <input type="text" name="store_pending_orders" class="form-control" value="Pending Orders"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">ORDER ID</label>
                                                <input type="text" name="store_orderid" class="form-control" value="ORDER ID"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">TABLE NO</label>
                                                <input type="text" name="store_tableno" class="form-control" value="TABLE NO"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Total</label>
                                                <input type="text" name="store_total" class="form-control" value="Total"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Accept</label>
                                                <input type="text" name="store_accept" class="form-control" value="Accept"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Reject</label>
                                                <input type="text" name="store_reject" class="form-control" value="Reject"
                                                       required>
                                            </div>






                                        </div>
                                    </div>
                                </div>


{{--                                Orders Translations--}}

                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">All Orders</label>
                                                <input type="text" name="store_all_orders" class="form-control" value="All Orders"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Order Placed</label>
                                                <input type="text" name="store_orderstatus_placed" class="form-control" value="Order Placed"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Processing</label>
                                                <input type="text" name="store_orderstatus_processing" class="form-control" value="Processing"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Ready</label>
                                                <input type="text" name="store_orderstatus_ready" class="form-control" value="Ready"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Rejected</label>
                                                <input type="text" name="store_orderstatus_rejected" class="form-control" value="Rejected"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Order Completed</label>
                                                <input type="text" name="store_orderstatus_ordercompleted" class="form-control" value="Order Completed"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Accept Order</label>
                                                <input type="text" name="store_orderstatus_acceptorder" class="form-control" value="Accept Order"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Reject Order</label>
                                                <input type="text" name="store_orderstatus_rejectorder" class="form-control" value="Reject Order"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Ready to Serve</label>
                                                <input type="text" name="store_orderstatus_readytoserve" class="form-control" value="Ready to Serve"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Orders Status: Complete</label>
                                                <input type="text" name="store_orderstatus_complete" class="form-control" value="Complete"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">View Order</label>
                                                <input type="text" name="store_view_order" class="form-control" value="View Order"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Customer Details</label>
                                                <input type="text" name="store_customer_details" class="form-control" value="Customer Details"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Customer Name</label>
                                                <input type="text" name="store_customer_name" class="form-control" value="Customer Name"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Phone No</label>
                                                <input type="text" name="store_phone_no" class="form-control" value="Phone No"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Order Details</label>
                                                <input type="text" name="store_order_details" class="form-control" value="Order Details"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Placed</label>
                                                <input type="text" name="store_order_placed" class="form-control" value="Placed"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Customer Note</label>
                                                <input type="text" name="store_customernote" class="form-control" value="Customer Note"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Print</label>
                                                <input type="text" name="store_order_print" class="form-control" value="Print"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Comment.</label>
                                                <input type="text" name="store_waiter_comment" class="form-control" value="Comment."
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">New Order</label>
                                                <input type="text" name="store_status_neworder" class="form-control" value="New Order"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Edit</label>
                                                <input type="text" name="store_edit" class="form-control" value="Edit"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Delete</label>
                                                <input type="text" name="store_delete" class="form-control" value="Delete"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promo Banners: Name</label>
                                                <input type="text" name="store_banner_name" class="form-control" value="Name"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promo Banners: Edit Promo Banner</label>
                                                <input type="text" name="store_promo_editbanner" class="form-control" value="Edit Promo Banner"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promo Banners: Banner Image</label>
                                                <input type="text" name="store_promo_bannerimage" class="form-control" value="Banner Image"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promo Banners: Banner Name</label>
                                                <input type="text" name="store_promo_bannername" class="form-control" value="Banner Name"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promo Banners: Visibility</label>
                                                <input type="text" name="store_promo_bannervisibility" class="form-control" value="Visibility"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Promo Banners: Add Promo Banner</label>
                                                <input type="text" name="store_promo_add" class="form-control" value="Add Promo Banner"
                                                       required>
                                            </div>








                                        </div>
                                    </div>
                                </div>


{{--                                Store Category--}}


                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Inventory: Category</label>
                                                <input type="text" name="store_category" class="form-control" value="Category"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Inventory: Products</label>
                                                <input type="text" name="store_products" class="form-control" value="Products"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Inventory: Addon Categories</label>
                                                <input type="text" name="store_addon_category" class="form-control" value="Addon Categories"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Inventory: Addons</label>
                                                <input type="text" name="store_addons" class="form-control" value="Addons"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Category: Status</label>
                                                <input type="text" name="store_category_status" class="form-control" value="Status"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Category: Name</label>
                                                <input type="text" name="store_category_name" class="form-control" value="Name"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Category: Add Category</label>
                                                <input type="text" name="store_category_addheading" class="form-control" value="Add Category"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Category: Image</label>
                                                <input type="text" name="store_category_image" class="form-control" value="Image"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Category: Is Enabled</label>
                                                <input type="text" name="store_category_isenabled" class="form-control" value="Is Enabled"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Category: Edit Category</label>
                                                <input type="text" name="store_category_editheading" class="form-control" value="Edit Category"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Products: All</label>
                                                <input type="text" name="store_products_all" class="form-control" value="All"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Products: Non-Veg</label>
                                                <input type="text" name="store_products_nonveg" class="form-control" value="Non-Veg"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Products: Veg</label>
                                                <input type="text" name="store_products_veg" class="form-control" value="Veg"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Products: Disabled</label>
                                                <input type="text" name="store_products_disabled" class="form-control" value="Disabled"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Products: Price</label>
                                                <input type="text" name="store_products_price" class="form-control" value="Price"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Products: Recommended</label>
                                                <input type="text" name="store_products_recommended" class="form-control" value="Recommended"
                                                       required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-header bg-gradient-gray-dark text-white">New</div>

                            <div class="row">




                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Pages</label>
                                                <input type="text" name="website_pages" class="form-control" value="Pages"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> About Us</label>
                                                <input type="text" name="about_us" class="form-control" value="About Us"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Terms and Condition</label>
                                                <input type="text" name="termsandcondition" class="form-control" value="Terms and Condition"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Refund & Cancellation</label>
                                                <input type="text" name="refundandcancellation" class="form-control" value="Refund & Cancellation"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">Customer App:</b> Your Order Number Is</label>
                                                <input type="text" name="your_order_number_is" class="form-control" value="Your Order Number Is"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">Customer App:</b> Send Order On Whatsapp</label>
                                                <input type="text" name="send_order_whatsapp" class="form-control" value="Send Order On Whatsapp"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">Pricing:</b> Choose The Best Plan For Your Business</label>
                                                <input type="text" name="pricing_head_title" class="form-control" value="Choose The Best Plan For Your Business"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">Pricing:</b> Start</label>
                                                <input type="text" name="pricing_start_button" class="form-control" value="Start"
                                                       required>
                                            </div>




                                        </div>
                                    </div>



                                </div>

{{--                                END--}}


                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> WHAT OUR CUSTOMERS SAY</label>
                                                <input type="text" name="website_testimonial_head1" class="form-control" value="WHAT OUR CUSTOMERS SAY"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Client’s Feedback Latest Reviews From My Clients</label>
                                                <input type="text" name="website_testimonial_head2" class="form-control" value="Client’s Feedback Latest Reviews From My Clients"
                                                       required>
                                            </div>

{{--                                            Pro Theme--}}

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> WHAT WE DO</label>
                                                <input type="text" name="website_pro_whatwedo" class="form-control" value="WHAT WE DO"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> WHY CHOOSE US</label>
                                                <input type="text" name="website_pro_whychooseus" class="form-control" value="WHY CHOOSE US"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> Get to the
                                                    best outcome.</label>
                                                <input type="text" name="website_pro_gettotheheading" class="form-control" value="Get to the best outcome."
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> Sample Text</label>
                                                <input type="text" name="website_pro_gettothesubheading" class="form-control" value="Sample Text"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b>  Digitalize your store</label>
                                                <input type="text" name="website_pro_why_tag1" class="form-control" value="Digitalize your store"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> Safer to use</label>
                                                <input type="text" name="website_pro_why_tag2" class="form-control" value="Safer to use"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> Easy to manage</label>
                                                <input type="text" name="website_pro_why_tag3" class="form-control" value="Easy to manage"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> Covid Compliance</label>
                                                <input type="text" name="website_pro_why_tag4" class="form-control" value="Covid Compliance"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> Working Process</label>
                                                <input type="text" name="website_pro_working_process" class="form-control" value="Working Process"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB: Pro Theme</b> TESTIMONIAL</label>
                                                <input type="text" name="website_pro_testimonial" class="form-control" value="TESTIMONIAL"
                                                       required>
                                            </div>





                                        </div>
                                    </div>



                                </div>


                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Join free for 7days</label>
                                                <input type="text" name="website_pro_trail_heading" class="form-control" value="Join free for 7days"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Description text for Trail.</label>
                                                <input type="text" name="website_pro_trail_description" class="form-control" value="Join free for 7days"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Our Clients</label>
                                                <input type="text" name="website_pro_our_clients" class="form-control" value="Our Clients"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Our Partners</label>
                                                <input type="text" name="website_pro_our_partners" class="form-control" value="Our Partners"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> View More</label>
                                                <input type="text" name="website_pro_view_more" class="form-control" value="View More"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Footer Logo Sub-Heading</label>
                                                <input type="text" name="website_pro_footer_subheading" class="form-control" value="Tosser amongst jolly good do one no biggie hunky."
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Footer Quick Links</label>
                                                <input type="text" name="website_pro_footer_quicklinks" class="form-control" value="Quick Links"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB:</b> Menu - Partner Stores</label>
                                                <input type="text" name="website_pro_footer_menu_partnersstore" class="form-control" value="Partner Stores"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB (Partner Stores):</b> Choose Your Favourite Cuisine
                                                </label>
                                                <input type="text" name="website_pro_partner_head1" class="form-control" value="Choose Your Favourite Cuisine"
                                                       required>
                                            </div>







                                        </div>
                                    </div>



                                </div>




                            </div>




{{--                            FAQ START--}}

                            @if($account_info->theme_id == 'TH1P')




                            <div class="card-header bg-gradient-gray-dark text-white">Frequently Asked Questions</div>

                            <div class="row">




                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Faq's</label>
                                                <input type="text" name="website_pro_faq" class="form-control" value="Faq's"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Frequently Asked Questions</label>
                                                <input type="text" name="website_pro_faq_head" class="form-control" value="Frequently Asked Questions"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q1 Heading</label>
                                                <input type="text" name="website_pro_faq_q1headig" class="form-control" value="How to contact with Customer Service?"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q1 Description</label>
                                                <input type="text" name="website_pro_faq_q1description" class="form-control" value="Easy peasy owt to do with me cras I don't want no agro what a load of rubbish starkers absolutely bladdered, old tinkety tonk old fruit so I said the full monty."
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q2 Heading</label>
                                                <input type="text" name="website_pro_faq_q2headig" class="form-control" value="How delete my account?"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q2 Description</label>
                                                <input type="text" name="website_pro_faq_q2description" class="form-control" value="Easy peasy owt to do with me cras I "
                                                       required>
                                            </div>

                                            ------------------

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q3 Heading</label>
                                                <input type="text" name="website_pro_faq_q3headig" class="form-control" value="Where is the edit optioon on dashboard?"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q3 Description</label>
                                                <input type="text" name="website_pro_faq_q3description" class="form-control" value="Easy"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q4 Heading</label>
                                                <input type="text" name="website_pro_faq_q4headig" class="form-control" value="How"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username"><b style="color: red">SAAS WEB Pro Theme:</b> Q4 Description</label>
                                                <input type="text" name="website_pro_faq_q4description" class="form-control" value="Easy"
                                                       required>
                                            </div>






                                        </div>
                                    </div>



                                </div>


                            </div>

                            @endif
{{--                            FAQ Ends--}}


                            <br>








                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit"
                                            class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn">
                                        Save
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>





@endsection
