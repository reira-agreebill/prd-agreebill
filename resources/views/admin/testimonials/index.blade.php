@extends("admin.adminlayout")

@section("admin_content")
    <div class="container-fluid">

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">

                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0">Testimonials List</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('add_testimonials')}}" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Add New Testimonials">
                            <span class="btn-inner--icon"><i class="fas fa-comment-alt"></i></span>
                            <span class="btn-inner--text">Add New Testimonials</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                <table class="table align-items-center table-flush text-center">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>

                    @php $i=1 @endphp
                    @foreach($testimonial as $data)

                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->designation}} </td>
                            <td>
                                <a onclick="if(confirm('Are you sure you want to delete this Testimonials?')){ event.preventDefault();document.getElementById('delete-form-{{$data->id}}').submit(); }"><b style="color: red">Delete</b></a>

                                <form method="post" action="{{route('delete_testimonials')}}"
                                      id="delete-form-{{$data->id}}" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" value="{{$data->id}}" name="id">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection
