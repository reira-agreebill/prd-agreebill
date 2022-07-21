@extends("admin.adminlayout")

@section("admin_content")


    <div class="container-fluid">
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Update Store Url</h3>
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
            <!-- Card body -->
            <div class="card-body">
                <form method="post" action="{{route('save_url',$id->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Store Url</label>
                                <input type="text" value="{{$id->view_id}}"  name="view_id" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn" >

                    </div>
                </form>
            </div>


        </div>






@endsection
