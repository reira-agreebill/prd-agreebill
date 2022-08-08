@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")
    @include('restaurants.notification.expired_notification')
    @include('restaurants.notification.new_order_notification')
    @include('restaurants.notification.call_waiter_notification')
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
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-md-9" style="background-color: #eaeef7; border-radius: 25px">

                <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="p-3">{{$selected_language->data['store_pending_orders'] ?? 'Pending Orders'}}</h3>


                    <div class="row">


                        @php $i=1 @endphp
                        @foreach($orders as $pending)

                            <div class="col-md-3">

                                <div class="card">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <b>{{ $pending->customer_name }}</b>
                                            </div>

                                        </div>
                                        <div>
                <span class="h6 surtitle text-muted">
               {{$selected_language->data['store_orderid'] ?? 'Order Id'}}
                </span>
                                            <div class="h4">{{ $pending->order_unique_id }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col">

                <span class="h6 surtitle text-muted">
                 {{$selected_language->data['store_tableno'] ?? 'Room No'}}
                </span>
                                                <div class="h4">{{ $pending->table_no }}</div>

                                            </div>
                                            <div class="col">

                <span class="h6 surtitle text-muted">
                {{$selected_language->data['store_total'] ?? 'Total'}}
                </span>
                                                <div class="h4">{{ number_format($pending->total) }}</div>

                                            </div>
                                        </div>
                                        <div class="row">

                                            @if($pending->status == 1)
                                                <div class="col">
                                                    <a class="btn btn-success btn-sm text-white"
                                                       onclick="if(confirm('Are you sure you want to accept this Order ?')){ event.preventDefault();document.getElementById('accept_order{{$pending->id}}').submit();}"> {{$selected_language->data['store_accept'] ?? 'Accept'}}</a>
                                                </div>
                                                <div class="col">
                                                    <a id="reject-btn-{{$pending->order_unique_id}}" class="btn btn-outline-danger btn-sm"
                                                       onclick="if(confirm('Are you sure you want to reject this Order ?')){ event.preventDefault();document.getElementById('reject_order{{$pending->id}}').submit();}"> {{$selected_language->data['store_reject'] ?? 'Reject'}}</a>
                                                    @endif
                                                </div>



                                                <form

                                                    style="visibility: hidden" method="post"

                                                    action="{{route('store_admin.update_order_status',['id'=>$pending->id])}}"
                                                    id="accept_order-{{$pending->id}}">
                                                    @csrf
                                                    @method('patch')
                                                    <input style="visibility:hidden" name="status" type="hidden"
                                                           value="2">
                                                </form>
                                                @if($pending->status == 1)
                                                    <!-- The Modal -->
                                                    <div id="rejectModal-{{$pending->order_unique_id}}" class="modal">

                                                        <!-- Modal content -->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="h2-modal-header">Rejection note</h2>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post"
                                                                    action="{{route('store_admin.update_order_status',['id'=>$pending->id])}}"
                                                                    id="reject_order{{$pending->id}}">
                                                                    @csrf
                                                                    @method('patch')
                                                                    <label>Please provide information if this order is rejected<span style="color:red;">*</span></label>
                                                                    <textarea name="reject_reason" class="form-control" required></textarea>
                                                                    <input style="visibility:hidden" name="status" type="hidden" value="3">
                                                                    <br/>
                                                                    <button class="btn btn-danger btn-sm text-white" type="submit">
                                                                        {{$selected_language->data['store_orderstatus_rejectorder'] ?? 'Reject Order'}}
                                                                    </button>
                                                                    <button class="btn btn-danger btn-sm text-white close-{{$pending->id}}" type="cancel">
                                                                        {{$selected_language->data['store_orderstatus_rejectorder'] ?? 'Cancel'}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <script>
                                                    document.getElementById("reject-btn-{{$pending->order_unique_id}}").onclick = function() {
                                                        document.getElementById("rejectModal-{{$pending->order_unique_id}}").style.display = "block";
                                                    }
                                                    document.getElementsByClassName("close-{{$pending->id}}")[0].onclick = function() {
                                                        document.getElementById("rejectModal-{{$pending->order_unique_id}}").style.display = "none";
                                                    }
                                                    window.onclick = function(event) {
                                                    if (event.target == modal) {
                                                        document.getElementById("rejectModal-{{$pending->order_unique_id}}").style.display = "none";
                                                    }
                                                    }
                                                    </script>
                                                @endif
                                                <form style="visibility: hidden" method="post"
                                                      action="{{route('store_admin.update_order_status',['id'=>$pending->id])}}"
                                                      id="complete_order{{$pending->id}}">
                                                    @csrf
                                                    @method('patch')
                                                    <input style="visibility:hidden" name="status" type="hidden"
                                                           value="4">
                                                </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>


            </div>
            <div class="col-12 col-md-3">
                <p id="item-to-copy" hidden> {{route('view_store',[Auth::user()->view_id])}}</p>
                <div class="row">
                    <div class="col">
                        <input type="text" readonly value="{{route('view_store',[Auth::user()->view_id])}}"
                               class="form-control">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-dark"
                                onclick="copyToClipboard()">{{$selected_language->data['store_copy'] ?? 'Copy'}}</button>
                    </div>
                </div>
                <br>

                <div class="card" style="border-radius: 20px !important;">
                    <!-- Card header -->
                    <div class="card-header"
                         style="border-radius: 20px !important; background-image: linear-gradient(-60deg, #ff5858 0%, #f09819 100%);">
                        <!-- Title -->
                        <h5 class="h3 mb-0 text-white"><i
                                class="fas fa-chart-line"></i> {{$selected_language->data['store_quickstats'] ?? 'Quick Stats'}}
                        </h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="timeline timeline-one-side" data-timeline-content="axis"
                             data-timeline-axis-style="dashed">
                            <div class="timeline-block">
                  <span class="timeline-step badge-default">
                   <i class="fas fa-receipt"></i>
                  </span>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between pt-1">
                                        <div>
                                            <span
                                                class="text-dark text-sm font-weight-bold">{{$selected_language->data['store_total_orders'] ?? 'Total Orders'}}</span>
                                        </div>
                                        <div class="text-right">
                                            <strong class="text-dark">{{$order_count}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-block">
                  <span class="timeline-step badge-default">
                  <i class="fas fa-hamburger"></i>
                  </span>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between pt-1">
                                        <div>
                                            <span
                                                class="text-dark text-sm font-weight-bold">{{$selected_language->data['store_item_sold'] ?? 'Item Sold'}}</span>
                                        </div>
                                        <div class="text-right">
                                            <strong class="text-dark">{{$item_sold}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-block">
                  <span class="timeline-step badge-default">
                   <i class="fas fa-file-invoice-dollar"></i>
                  </span>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between pt-1">
                                        <div>
                                            <span
                                                class="text-dark text-sm font-weight-bold">{{$selected_language->data['store_total_earnings'] ?? 'Total Earnings'}}</span>
                                        </div>
                                        <div class="text-right">
                                            <strong
                                                class="text-dark">@include('layouts.render.currency',["amount"=>$earnings])</strong>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="timeline-block">
                  <span class="timeline-step badge-danger">
                  <i class="fas fa-clock"></i>
                  </span>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between pt-1">
                                        <div>
                                            <span
                                                class="text-danger text-sm font-weight-bold">{{$selected_language->data['store_plan_date'] ?? 'Contract End Date'}}</span>
                                        </div>
                                        <div class="text-right">
                                            <strong
                                                class="text-danger">{{date('d-m-Y',strtotime(auth()->user()->subscription_end_date))}}</strong>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>






    <script>

        function copyToClipboard() {
            const str = document.getElementById('item-to-copy').innerText;
            const el = document.createElement('textarea');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        }
    </script>


@endsection
