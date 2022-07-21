@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")


    <div class="container-fluid">

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">

                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0">Coupons List
                        </h3>

                    </div>

                    <div class="col-6 text-right">
                        <a href="{{route('store_admin.add_coupons')}}" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Add Coupons">
                            <span class="btn-inner--text">Add Coupons</span>
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
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Type</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Status</th>
                        <th scope="col"><i class="icofont-circled-down"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td><span class="badge" style="background-color: #0a0a0a;color: yellow"><b>{{$data->code}}</b></span></td>
                            <td><span class="badge badge-info"><b>{{$data->discount_type}}</b></span></td>
                            <td><b> @include('layouts.render.currency',["amount"=>$data->discount]) </b></td>
                            <td>

                                @if($data->is_active == 1)
                                    <span class="badge badge-success">Active</span>
                                @endif

                                    @if($data->is_active == 0)
                                        <span class="badge badge-danger">InActive</span>
                                    @endif


                            </td>
                            <td class="table-actions">
                                <a onclick="if(confirm('Are you sure you want to delete this Expense?')){ event.preventDefault();document.getElementById('delete-form-{{$data->id}}').submit(); }" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>




                                <form method="post" action="{{route('store_admin.delete_coupons')}}"
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
