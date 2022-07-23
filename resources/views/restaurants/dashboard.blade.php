@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")
    @include('restaurants.notification.expired_notification')
    @include('restaurants.notification.new_order_notification')
    @include('restaurants.notification.call_waiter_notification')
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
                 {{$selected_language->data['store_tableno'] ?? 'Table No'}}
                </span>
                                                <div class="h4">{{ $pending->table_no }}</div>

                                            </div>
                                            <div class="col">

                <span class="h6 surtitle text-muted">
                {{$selected_language->data['store_total'] ?? 'Total'}}
                </span>
                                                <div class="h4">{{ $pending->total }}</div>

                                            </div>
                                        </div>
                                        <div class="row">

                                            @if($pending->status == 1)
                                                <div class="col">
                                                    <a class="btn btn-success btn-sm text-white"
                                                       onclick="if(confirm('Are you sure you want to accept this Order ?')){ event.preventDefault();document.getElementById('accept_order{{$pending->id}}').submit();}"> {{$selected_language->data['store_accept'] ?? 'Accept'}}</a>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-outline-danger btn-sm"
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
                                                <form style="visibility: hidden" method="post"
                                                      action="{{route('store_admin.update_order_status',['id'=>$pending->id])}}"
                                                      id="reject_order{{$pending->id}}">
                                                    @csrf
                                                    @method('patch')
                                                    <input style="visibility:hidden" name="status" type="hidden"
                                                           value="3">
                                                </form>
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
