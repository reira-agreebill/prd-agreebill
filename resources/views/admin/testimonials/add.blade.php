@extends("admin.adminlayout")

@section("admin_content")


    <div class="container-fluid">
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Add Testimonials</h3>
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
            <!-- Card body -->
            <div class="card-body">
                <form  method="post" action="{{route('create_testimonials')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Form groups used in grid -->
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Name</label>  <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Designation</label> <span class="text-danger">*</span>
                                <input type="text" name="designation" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Comment</label> <span class="text-danger">*</span>
                              <textarea class="form-control" name="comment" rows="3"></textarea>
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
