@extends("admin.adminlayout")

@section("admin_content")

    <style>
        .orders-not-found {
            height: calc(100vh - 266px);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
    <div class="container-fluid">

        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6 text-right">
                <a href="{{route('add_expense')}}" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Add Expense">
                    <span class="btn-inner--icon"><i class="fas fa-comment-alt"></i></span>
                    <span class="btn-inner--text">Add Expense</span>
                </a>
            </div>
        </div>
        <br>


        <div class="card">
            @if($expenses->count() > 0)




                <table class="table">
                    <thead class="bg-dark text-white">
                    <tr>

                        <th scope="col">To</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->date}}</td>
                            <td class="table-actions">
                                <a href="{{route('edit_expense',$data->id)}}" class="table-action" data-toggle="tooltip" data-original-title="Edit">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                <a onclick="if(confirm('Are you sure you want to delete this Expense?')){ event.preventDefault();document.getElementById('delete-form-{{$data->id}}').submit(); }" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>




                                <form method="post" action="{{route('delete_expense')}}"
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



            @else
                <div class="orders-not-found"><img src="{{asset('img/no-orders-illustrations.svg')}}" style="border: none" alt="No orders"><h4 class="section-text-3 my8">No Expense Data found.</h4></div>
            @endif
        </div>



    </div>



@endsection
