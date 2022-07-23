@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")



    <div class="container-fluid">

    <style>

        /* The Modal (background) */
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 36px;
            border: 1px solid #888;
            width: 72%;
            left: 10%;
        }

        /* The Close Button */
        .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
        
        .modal-header {
        padding: 2px 16px;
        background-color: #f5365c;
        color: white;
        }
        .h2-modal-header{
        color: white;
        }
        .modal-body {padding: 2px 16px;}
    </style>


        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0"> {{$selected_language->data['store_all_orders'] ?? 'All Orders'}}

                            <span class="badge badge-md badge-circle badge-floating badge-info border-white"> {{$orders_count}}</span>
                        </h3>
                    </div>

                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-basic">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>{{$selected_language->data['store_total'] ?? 'Total'}}</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Order Type</th>
                        <th>Order Placed At</th>
                        <th>{{$selected_language->data['store_tableno'] ?? 'Table No'}}</th>
                        <th>Action</th>
                        <th>View Order</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1 @endphp

                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $i++}}</td>

                            <td>{{ $order->order_unique_id }}</td>

                            <td>
                                @include('layouts.render.currency',["amount"=>$order->total])
                            </td>
                            <td><span class="badge" style="background-color: #3d027b; color: #ffffff">{{ $order->payment_type }}</span></td>

                            <td>
                                {{--                                        @php print_r($order->status) @endphp--}}
                                @if($order->status == 1)
                                    <span class="badge badge-info"> {{$selected_language->data['store_orderstatus_placed'] ?? 'Order Placed'}}</span>
                                @endif

                                @if($order->status == 2)
                                    <span class="badge badge-warning"> {{$selected_language->data['store_orderstatus_processing'] ?? 'Processing'}}</span>
                                @endif
                                @if($order->status == 5)
                                    <span class="badge badge-default">{{$selected_language->data['store_orderstatus_ready'] ?? 'Ready'}}</span>
                                @endif

                                @if($order->status == 3)
                                    <span class="badge badge-danger">{{$selected_language->data['store_orderstatus_rejected'] ?? 'Rejected'}}</span>
                                @endif

                                @if($order->status == 4)
                                    <span class="badge badge-success">{{$selected_language->data['store_orderstatus_ordercompleted'] ?? 'Order Completed'}}</span>
                                @endif


                            </td>

                            <td>
                                @if($order->order_type == 1)
                                    <span class="badge bg-dark text-yellow">Dining</span>
                                @endif

                                    @if($order->order_type == 2)
                                        <span class="badge bg-dark text-success">Takeaway</span>
                                    @endif

                                    @if($order->order_type == 3)
                                        <span class="badge bg-dark text-danger">Delivery</span>
                                    @endif
                            </td>
                            <td>
                                {{$order->created_at->diffForHumans()}}
                            </td>
                            <td> <span class="badge badge-primary"> {{$order->table_no}}</span></td>
                            <td>
                                @if($order->status == 1)
                                    <a class="btn btn-primary btn-sm text-white"
                                       onclick="if(confirm('Are you sure you want to accept this Order ?')){ event.preventDefault();document.getElementById('accept_order{{$order->id}}').submit();}">{{$selected_language->data['store_orderstatus_acceptorder'] ?? 'Accept Order'}}</a>
                                    <a id="reject-btn-{{$order->order_unique_id}}" class="btn btn-danger btn-sm text-white"
                                       >{{$selected_language->data['store_orderstatus_rejectorder'] ?? 'Reject Order'}}</a>
                                @endif


{{--                                @if($order->status == 2)--}}
{{--                                    <a class="btn btn-outline-success btn-sm"--}}
{{--                                       onclick="document.getElementById('complete_order{{$order->id}}').submit();">Complete--}}
{{--                                        Order</a>--}}
{{--                                @endif--}}


                                    @if($order->status == 2)
                                        <a class="btn btn-outline-success btn-sm"
                                           onclick="document.getElementById('ready_to_serve{{$order->id}}').submit();">{{$selected_language->data['store_orderstatus_readytoserve'] ?? 'Ready to Serve'}}</a>
                                    @endif
                                    @if($order->status == 5)
                                        <a class="btn btn-outline-success btn-sm"
                                           onclick="document.getElementById('complete_order{{$order->id}}').submit();">{{$selected_language->data['store_orderstatus_complete'] ?? 'Complete'}}</a>
                                    @endif


                                @if($order->status == 3)
                                    <a class="btn btn-danger btn-sm text-white">{{$selected_language->data['store_orderstatus_rejected'] ?? 'Rejected'}}</a>
                                @endif

                                @if($order->status == 4)
                                    <a class="btn btn-success btn-sm text-white">{{$selected_language->data['order_status_completed'] ?? 'Completed'}}</a>
                                        @if($order->payment_status == 1)
                                    <a class="btn btn-dark btn-sm text-success" onclick="document.getElementById('marks_as_paid{{$order->id}}').submit();"><i class="fas fa-check-circle"></i> Mark As Paid</a>
                                        @endif

                                        @if($order->payment_status == 2)
                                            <a class="btn btn-dark btn-sm text-yellow"><i class="fas fa-check-double"></i> Paid</a>
                                        @endif


                                @endif


                                    <form style="visibility: hidden" method="post"
                                          action="{{route('store_admin.update_payment_status',['id'=>$order->id])}}"
                                          id="marks_as_paid{{$order->id}}">
                                        @csrf
                                        @method('patch')
                                        <input style="visibility:hidden" name="payment_status" type="hidden" value="2">
                                    </form>

                                <form style="visibility: hidden" method="post"
                                      action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                      id="accept_order{{$order->id}}">
                                    @csrf
                                    @method('patch')
                                    <input style="visibility:hidden" name="status" type="hidden" value="2">
                                </form>
                                
                                @if($order->status == 1)
                                <!-- The Modal -->
                                <div id="rejectModal-{{$order->order_unique_id}}" class="modal">

                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="h2-modal-header">Rejection note</h2>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post"
                                                action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                                id="reject_order{{$order->id}}">
                                                @csrf
                                                @method('patch')
                                                <label>Please provide information if this order is rejected<span style="color:red;">*</span></label>
                                                <textarea name="reject_reason" class="form-control" required></textarea>
                                                <input style="visibility:hidden" name="status" type="hidden" value="3">
                                                <br/>
                                                <button class="btn btn-danger btn-sm text-white" type="submit">
                                                    {{$selected_language->data['store_orderstatus_rejectorder'] ?? 'Reject Order'}}
                                                </button>
                                                <button class="btn btn-danger btn-sm text-white close-{{$order->id}}" type="cancel">
                                                    {{$selected_language->data['store_orderstatus_rejectorder'] ?? 'Cancel'}}
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <script>
                                document.getElementById("reject-btn-{{$order->order_unique_id}}").onclick = function() {
                                    document.getElementById("rejectModal-{{$order->order_unique_id}}").style.display = "block";
                                }
                                document.getElementsByClassName("close-{{$order->id}}")[0].onclick = function() {
                                    document.getElementById("rejectModal-{{$order->order_unique_id}}").style.display = "none";
                                }
                                window.onclick = function(event) {
                                if (event.target == modal) {
                                    document.getElementById("rejectModal-{{$order->order_unique_id}}").style.display = "none";
                                }
                                }
                                </script>
                                @endif
                                    <form style="visibility: hidden" method="post"
                                          action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                          id="ready_to_serve{{$order->id}}">
                                        @csrf
                                        @method('patch')
                                        <input style="visibility:hidden" name="status" type="hidden" value="5">
                                    </form>


                                <form style="visibility: hidden" method="post"
                                      action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                      id="complete_order{{$order->id}}">
                                    @csrf
                                    @method('patch')
                                    <input style="visibility:hidden" name="status" type="hidden" value="4">
                                </form>

                            </td>

                            <td style="text-align: center">
                                    <span>
                                    <a class="btn btn-default btn-sm"
                                       href="{{route('store_admin.view_order',$order->id)}}">
                                    <i class="icofont-eye-alt"></i>
                                    </a>

                                        <!-- <a class="btn btn-danger btn-sm text-white"
                                           onclick="if(confirm('Are you sure you want to delete this Order ?')){ event.preventDefault();document.getElementById('delete-form-{{$order->id}}').submit(); }">
                                      <i class="icofont-delete-alt"></i>
                                    </a> -->

                                        <form method="post" action="{{route('store_admin.order_delete')}}"
                                              id="delete-form-{{$order->id}}" style="display: none">
                                                @csrf
                                            @method('DELETE')
                                                <input type="hidden" value="{{$order->id}}" name="id">
                                            </form>
                                        </span>

                            </td>


                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>




    </div>






@endsection
