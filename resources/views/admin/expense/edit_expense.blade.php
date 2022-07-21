@extends("admin.adminlayout")

@section("admin_content")


    <div class="container-fluid">
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Add Expense</h3>
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
            <!-- Card body -->
            <div class="card-body">
                <form method="post" action="{{route('update_expense',$id->id)}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Form groups used in grid -->
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Name</label>  <span class="text-danger">*</span>
                                <input type="text" name="name" value="{{$id->name}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Amount</label> <span class="text-danger">*</span>
                                <input type="text" name="amount" value="{{$id->amount}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Date</label> <span class="text-danger">*</span>
                                <input type="date" name="date" value="{{$id->date}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Notes</label>
                                <textarea class="form-control" name="note" rows="3">{{$id->note}}</textarea>
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
