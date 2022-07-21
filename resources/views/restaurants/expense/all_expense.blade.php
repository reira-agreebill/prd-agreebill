@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")


    <div class="container-fluid">

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">

                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0">Expense List
                        </h3>

                    </div>

                    <div class="col-6 text-right">
                        <a href="{{route('store_admin.store_expense_add')}}" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Add Expense">
                            <span class="btn-inner--text">Add Expense</span>
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
                        <th scope="col">To</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expense as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->date}}</td>
                            <td class="table-actions">
                                <a href="{{route('store_admin.store_expense_edit',$data->id)}}" class="table-action" data-toggle="tooltip" data-original-title="Edit">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                <a onclick="if(confirm('Are you sure you want to delete this Expense?')){ event.preventDefault();document.getElementById('delete-form-{{$data->id}}').submit(); }" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>




                                <form method="post" action="{{route('store_admin.store_expense_delete')}}"
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
