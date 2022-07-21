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
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush text-center">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center">Sl.</th>
                        <th class="text-center">Store Name</th>
                        <th class="text-center">Subscription Name / Price</th>
                        <th class="text-center">Subscription Days</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Payment Gateway</th>

                    </tr>
                    </thead>
                    <tbody>



                    @php $i=1 @endphp
                    @foreach($transactions as $value)
                        <tr>

                            <td>
                                <span class="text-muted">{{ $i++}}</span>
                            </td>

                            <td>
                                @foreach($value->store($value->store_id) as $data)
                                    {{$data->store_name }}
                                @endforeach
                            </td>

                            <td>
                                <span class="text-muted">{{ $value->subscription_name}} / {{ $value->subscription_price}}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $value->subscription_days}}</span>
                            </td>

                            <td>
                                <span
                                    class="badge badge-{{$value->payment_status == 'paid' ? "success":"danger"}}">{{$value->payment_status == 'unpaid' ? "UnPaid":"Paid"}}</span>
                            </td>

                            <td>
                                <span class="text-dark"><strong>{{ $value->gateway_name}}</strong></span>
                            </td>

                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection
