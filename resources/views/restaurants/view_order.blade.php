@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")

    <style>

        .ticket * {
            font-size: 18px;
            font-family: 'Times New Roman';
        }


       .tickettd.description,
        th.description {
            width: 180px;
            max-width: 180px;
        }

       .ticket td.quantity,
        th.quantity {
            width: 60px;
            max-width: 60px;
            word-break: break-all;
        }

       .ticket td.price,
        th.price {
            width: 90px;
            max-width: 90px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 310px;
            max-width: 310px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }


        }
    </style>


    <div class="container-fluid">

        <div class="card-header border-0">
            <div class="row">
                <div class="col-6">

                    @if($order->status == 1)
                        <a class="btn btn-primary btn-sm text-white btn-icon"
                           onclick="document.getElementById('accept_order{{$order->id}}').submit();"><span class="btn-inner--icon"><i class="fas fa-check-circle"></i></span><span
                                class="btn-inner--text">{{$selected_language->data['store_orderstatus_acceptorder'] ?? 'Accept Order'}}</span></a>
                        <a class="btn btn-danger btn-sm text-white btn-icon"
                           onclick="document.getElementById('reject_order{{$order->id}}').submit();"><span class="btn-inner--icon"><i class="fas fa-times-circle"></i></span><span
                                class="btn-inner--text">{{$selected_language->data['store_orderstatus_rejectorder'] ?? 'Reject Order'}}</span></a>
                    @endif




                    <form style="visibility: hidden" method="post"
                          action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                          id="accept_order{{$order->id}}">
                        @csrf
                        @method('patch')
                        <input style="visibility:hidden" name="status" type="hidden" value="2">
                    </form>
                    <form style="visibility: hidden" method="post"
                          action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                          id="reject_order{{$order->id}}">
                        @csrf
                        @method('patch')
                        <input style="visibility:hidden" name="status" type="hidden" value="3">
                    </form>

                </div>
                <div class="col-6 text-right">

                     <span class="btn btn-sm status-btn-ordertype btn-round btn-icon">
                         {{$order->order_type == 1 ? "Dining":NULL}}
                         {{$order->order_type == 2 ? "Takeaway":NULL}}
                         {{$order->order_type == 3 ? "Delivery":NULL}}



                     </span>

                     <span class="btn btn-sm status-btn-order btn-round btn-icon">
                                        {{$order->status == 1 ? "Order Placed":NULL}}
                         {{$order->status == 2 ? "Order Accepted":NULL}}
                         {{$order->status == 5 ? "Ready to Serve":NULL}}
                         {{$order->status == 3 ? "Order Rejected":NULL}}
                         {{$order->status == 4 ? "Order Completed":NULL}}


                                    </span>


                    <a href="javascript:void(0)" id="printButton" class="btn btn-sm red-btn-order btn-round btn-icon">
                        <span class="btn-inner--icon"><i class="fas fa-print"></i></span>
                        <span
                            class="btn-inner--text">{{$selected_language->data['store_order_print'] ?? 'Print'}}</span>
                    </a>

                    <a href="javascript:void(0)" id="thermalprintButton"
                       class="btn btn-sm red-btn-order btn-round btn-icon">
                        <span class="btn-inner--icon"><i class="fas fa-receipt"></i></span>
                        <span
                            class="btn-inner--text">Print Thermal</span>
                    </a>


                </div>
            </div>
        </div>
        <br>




        <div class="row">
            <div class="col-xl-9 col-lg-10" id="printThis">
                <div class="box_order_view">
                    <div class="head">
                        <div class="title">
                            <h3>Normal Receipt Preview</h3>
                        </div>
                    </div>
                    <div class="main">
                        {{--                        <div class="form-group"> </div>--}}

                        <div class="row">
                            <div class="col-8">
                                <h3 class="font-weight-bold">{{$selected_language->data['store_customer_details'] ?? 'Customer Details'}}</h3>
                                <div class="font-weight-550 order-bottom-1">
                                    <b>{{$selected_language->data['store_customer_name'] ?? 'Customer Name'}}
                                        :</b> {{$order->customer_name}}</div>

                                <div class="font-weight-550 order-bottom-1">
                                    <b>{{$selected_language->data['store_phone_no'] ?? 'Phone No'}}
                                        :</b> {{$order->customer_phone}}</div>

                                <div class="font-weight-550 order-bottom-1">

                                    @if($order->order_type == 3)
                                        <b>  Address
                                            :</b> {{$order->address}}
                                    @endif
                                </div>
                            </div>


                            <div class="col-4 float-right-order">
                                <h3 class="font-weight-bold">{{$selected_language->data['store_order_details'] ?? 'Order Details'}}</h3>
                                <div class="font-weight-550 order-bottom-1">
                                    <b> {{$selected_language->data['store_orderid'] ?? 'Order Id'}}
                                        :</b> {{$order->order_unique_id}}</div>
                                <div class="font-weight-550 order-bottom-1">
                                    <b> {{$selected_language->data['store_order_placed'] ?? 'Placed'}}
                                        :</b> {{$order->created_at->diffForHumans()}}</div>
                                <div class="font-weight-550 order-bottom-1">

                                    @if($order->order_type == 1)
                                        <b>  {{$selected_language->data['store_tableno'] ?? 'Room No'}}
                                            :</b> {{$order->table_no}}
                                    @endif


                                  </div>


                            </div>
                        </div>

                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Item Price</th>
                                    <th>Qty</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderDetails as $order_data)
                                    {{--                                {{}}--}}
                                    @foreach($order_data['order_details'] as $key => $data)
                                        <tr>
                                            <th scope="row">{{ $key +1 }}</th>

                                            <td><b>{{$data['name']}}</b><br>


                                                @foreach($data['order_details_extra_addon'] as $key => $exra)


                                                    <span class="badge badge-primary">{{$key+1}}</span>
                                                    Name:  <strong>{{$exra['addon_name']}} ( {{$exra['addon_price']}}
                                                        )</strong>
                                                    x
                                                    <strong> {{$exra['addon_count']}}</strong> =
                                                    <strong>  {{$account_info!=NULL?$account_info->currency_symbol:"₹"}}{{$exra['addon_count'] * $exra['addon_price']}}</strong>
                                                    <br>


                                                @endforeach


                                            </td>
                                            <td>{{$data['price']}}</td>
                                            <td>{{$data['quantity']}}</td>
                                            <td class="color-primary"> {{$data['quantity'] * $data['price']}}</td>


                                        </tr>

                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-6">
                            <span>
                                <small class="text-muted">{{$selected_language->data['store_customernote'] ?? 'Customer Note'}}:</small><br>
                                 <b>{{$order->comments}}</b><br>


                            </span>
                        </div>

                        <div class="col-4 float-right">

                            <ul class="clearfix">
                                <li>
                                    Subtotal<span>@include('layouts.render.currency',["amount"=>$order->sub_total])</span>
                                </li>
                                <li>{{$selected_language->data['menu_service_charge'] ?? 'Service Charge'}}
                                    <span>@include('layouts.render.currency',["amount"=>$order->store_charge])</span>
                                </li>
                                <li>{{$selected_language->data['menu_tax'] ?? 'Tax'}}
                                    <span>@include('layouts.render.currency',["amount"=>$order->tax])</span></li>
                                <li class="total">{{$selected_language->data['store_total'] ?? 'Total'}}
                                    <span>@include('layouts.render.currency',["amount"=>$order->total])</span></li>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>

            {{--            End Normal Bill Preview--}}

            <div class="col-xl-3 col-lg-4">
                <div class="box_order_view">
                    <div class="head">
                        <div class="title">
                            <h3>Thermal Receipt Preview</h3>
                        </div>
                    </div>
                    <div class="main" id="thermalprintThis">

                        <div class="ticket">

                            <p style="width: 300px; text-align: center">
                                <strong style="font-size: 22px; font-weight: bold">{{ Auth::user()->store_name }}</strong><br>
                                phone: {{ Auth::user()->phone }}
                                <br>Email: {{ Auth::user()->email }}
                                <br> {{ Auth::user()->address }}
                            </p>

                            <p style="width: 300px;">
                                <span>{{$order->customer_name}} - ({{$order->customer_phone}})
                                    <br>ID: {{$order->order_unique_id}}<br>Placed: {{$order->created_at->diffForHumans()}}</span>
                            </p>

                            <p style="width: 300px;font-size: 22px; font-weight: bold; text-align: center">Cash Receipt</p>

                            <table>
                                <thead>
                                <tr style="border-bottom: 0.1em solid #999898">
                                    <th style="width: 50px;">Qty</th>
                                    <th style="width: 170px;">Description</th>
                                    <th style="width: 65px;">Amount</th>
                                </tr>

                                </thead>
                                <tbody>

                                @foreach($orderDetails as $order_data)
                                    @foreach($order_data['order_details'] as $key => $data)
                                        <tr style="border-bottom: 0.1em solid #999898">
                                            <td class="thermal-head-titile">{{$data['quantity']}}</td>
                                            <td><b>{{$data['name']}}</b><br>


                                                @foreach($data['order_details_extra_addon'] as $key => $exra)


                                                    <span>{{$key+1}}</span>.
                                                    {{$exra['addon_name']}} ( {{$exra['addon_price']}})
                                                    x
                                                    {{$exra['addon_count']}} =
                                                    {{$account_info!=NULL?$account_info->currency_symbol:"₹"}}{{$exra['addon_count'] * $exra['addon_price']}}
                                                    <br>


                                                @endforeach


                                            </td>

{{--                                            <td class="thermal-head-titile">{{$data['price']}}</td>--}}
                                            <td class="thermal-head-titile"> {{$data['quantity'] * $data['price']}}</td>


                                        </tr>


                                    @endforeach
                                @endforeach


                                </tbody>
                            </table>

                            <br>

                            <div class="clearfix px-3" style="width: 300px;">

                                Subtotal<span class="float-right">@include('layouts.render.currency',["amount"=>$order->sub_total])</span><br>

                                {{$selected_language->data['menu_service_charge'] ?? 'Service Charge'}}
                                <span class="float-right">@include('layouts.render.currency',["amount"=>$order->store_charge])</span><br>

                                {{$selected_language->data['menu_tax'] ?? 'Tax'}}
                                <span class="float-right">@include('layouts.render.currency',["amount"=>$order->tax])</span><br>
                                <div class="total-order">{{$selected_language->data['store_total'] ?? 'Total'}}
                                    <span class="float-right">@include('layouts.render.currency',["amount"=>$order->total])</span></div>
                            </div>


                            <div class="px-3" style="width: 300px; text-align: center">
                                <hr>
                                Thank you !
                            </div>

                        </div>




                    </div>
                </div>

            </div>


        </div>

    </div>








@endsection
