@extends("admin.adminlayout")

@section("admin_content")

    <div class="container-fluid">

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0">All Translation</h3>
                    </div>
                    <div class="col-6 text-right">
                        <button onclick="event.preventDefault(); document.getElementById('add_new').submit();" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Add New Language">
                            <span class="btn-inner--icon"><i class="fas fa-receipt"></i></span>
                            <span class="btn-inner--text">Add New Language</span>
                        </button>
                        <form action="{{route('add_translations')}}" method="get" id="add_new"></form>
                    </div>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush text-center">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Language Name</th>

                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>



                    @php $i=1 @endphp
                    @foreach($data as $value)
                        <tr>

                            <td>
                                <span class="text-muted">{{ $i++}}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $value->language_name}}</span>
                            </td>

                            <td>
                                <span
                                    class="badge badge-{{$value->is_active == 1 ? "success":"danger"}}">{{$value->is_active == 1 ? "Active":"Inactive"}}</span>


                            </td>
                            <td>
                                                                <a href="{{route('update_translation',['id'=>$value->id])}}"   data-toggle="tooltip" data-original-title="Edit ">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>&nbsp; &nbsp; &nbsp;

                                <a onclick="if(confirm('Are you sure you want to delete this Translation?')){ event.preventDefault();document.getElementById('delete-form-{{$value->id}}').submit(); }"><i class="fas fa-trash text-danger"></i></a>

                                <form method="post" action="{{route('delete_translation')}}"
                                      id="delete-form-{{$value->id}}" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" value="{{$value->id}}" name="id">
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
