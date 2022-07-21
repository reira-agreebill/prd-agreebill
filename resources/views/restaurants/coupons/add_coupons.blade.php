@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")


    <div class="container-fluid">
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
            <!-- Card body -->
            <div class="card-body">
                <form  method="post" action="{{route('store_admin.create_coupons')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Form groups used in grid -->
                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Coupon Name</label>  <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control" placeholder="Coupon Name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Coupon Description</label> <span class="text-danger">*</span>
                                <input type="text" name="description" placeholder="Coupon Description" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Coupon Code</label> <span class="text-danger">*</span>
                                <input type="text" name="code" placeholder="Coupon Code" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Dicsount Type</label> <span class="text-danger">*</span>
                                <select name="discount_type" class="form-control" required>
                                    <option value="AMOUNT">Fixed Amount Discount</option>
                                    <option value="PERCENTAGE">Percentage Discount</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Coupon Discount</label> <span class="text-danger">*</span>
                                <input type="number" name="discount" placeholder="Coupon Discount" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="exampleFormControlSelect1">Is Active?</label>
                                <div class="col-auto">
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="is_active" checked="">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                    </label>
                                </div>
                            </div>
                        </div>





                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>



        </div>

@endsection
