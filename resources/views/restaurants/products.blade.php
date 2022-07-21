@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")

    <style>


        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#322A7D;
            color:#FFA101;
            border-radius:50px;
            text-align:center;
            box-shadow: 2px 2px 3px #999;
        }


        .my-float{
            margin-top:22px;
        }
    </style>

    <style>
        .main {margin: 0 auto; min-width: 320px; max-width: 100%;text-align:center;}
        .content { color: black; text-align:left;}
        .content > div {display: none; padding: 20px 25px 5px;}

        .radio input {display: none;}
        .radio label {display: inline-block; padding: 8px 25px; font-weight: 600; background: #dbdcde; text-align: center;border-radius: 10px;}
        .radio label:hover {color: #000000; cursor: pointer;}
        .radio input:checked + label {background: #bce8b3; color: #000;}

        #tab1:checked ~ .content #content1,
        #tab2:checked ~ .content #content2,
        #tab3:checked ~ .content #content3,
        #tab4:checked ~ .content #content4,
        #tab5:checked ~ .content #content5,
        #tab6:checked ~ .content #content6,
        #tab7:checked ~ .content #content7
        {
            display: block;
        }

        @media screen and (max-width: 400px) { label {padding: 15px 10px;} }

    </style>


    <div class="container-fluid">


        <table width="32%">
            <tr>
                <td style="padding-right: 10px">
                    <input type="text" id="Search" onkeyup="myFunction()" placeholder="Search.." title="Type in a name" class="form-control">
                </td>
            </tr>
        </table>
        <br>


        <div class="flex-row">

            <div class="main radio">
                <div style="float:left;">
                <a class="btn btn-secondary" href="{{route('store_admin.categories')}}">{{$selected_language->data['store_category'] ?? 'Category'}}</a>
                <button class="btn" style="background-color: #FFA101; opacity: 65%; color: #000000">{{$selected_language->data['store_products'] ?? 'Products'}}</button>
                <a href="{{route('store_admin.addon_categories')}}" class="btn btn-secondary">{{$selected_language->data['store_addon_category'] ?? 'Addon Categories'}}</a>
                <a href="{{route('store_admin.addon')}}" class="btn btn-secondary">{{$selected_language->data['store_addons'] ?? 'Addons'}}</a>
                </div>

                <input id="tab1" type="radio" name="tabs" checked="">
                <label for="tab1">{{$selected_language->data['store_products_all'] ?? 'All'}}</label>

                <input id="tab2" type="radio" name="tabs">
                <label for="tab2">{{$selected_language->data['store_products_nonveg'] ?? 'Non-Veg'}}</label>

                <input id="tab3" type="radio" name="tabs">
                <label for="tab3">{{$selected_language->data['store_products_veg'] ?? 'Veg'}}</label>

                <input id="tab4" type="radio" name="tabs">
                <label for="tab4">{{$selected_language->data['store_products_disabled'] ?? 'Disabled'}}</label>


                <div class="content">


                    <div class="row" id="content1">


                        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">


                                @php $i=1 @endphp
                                @foreach($products as $pro)


                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 target">
                                        <div class="strip">
                                            <figure>

                                                <span
                                                    class="ribbon {{$pro->is_active == 1 ? "green":"red"}}">{{$pro->is_active == 1 ? "Enabled":"Desabled"}}</span>


                                                <img src="{{asset($pro->image_url !=NULL ? $pro->image_url:'themes/default/images/all-img/empty.png')}}" data-src="{{asset($pro->image_url !=NULL ? $pro->image_url:'themes/default/images/all-img/empty.png')}}" class="img-fluid lazy loaded" alt="" data-was-processed="true">

                                                <a href="#" class="strip_info">

                                                    <div
                                                        class="badge-v2-{{$pro->is_veg == 1 ? "veg":"nonveg"}}">{{$pro->is_veg == 1 ? "Veg":"Non-Veg"}}</div>


                                                    <div class="item_title">
                                                        <h3>{{ $pro->name }}</h3>
                                                        <small>{{$selected_language->data['store_products_price'] ?? 'Price'}}: <b> @include('layouts.render.currency',["amount"=>$pro->price])</b></small>
                                                    </div>
                                                </a>
                                            </figure>
                                            <ul>
                                                <li><span class="take yes"><a href="{{route('store_admin.update_products',$pro->id)}}" class="btn btn-sm btn-primary" style="color: #ffffff"><b>{{$selected_language->data['store_edit'] ?? 'Edit'}}</b></a></span>
                                                    <span class="deliv yes"><a class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete this item?')){ event.preventDefault();document.getElementById('delete-form-{{$pro->id}}').submit(); }"><b style="color: #ffffff">{{$selected_language->data['store_delete'] ?? 'Delete'}}</b></a>
                                                        <form method="post" action="{{route('store_admin.delete_product')}}"
                                                              id="delete-form-{{$pro->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" value="{{$pro->id}}" name="id">
                                                        </form></span></li>
                                                <li>
                                                    <div class="score"><strong><span
                                                                class="badge badge-{{$pro->is_recommended == 1 ? "success":"danger"}}">{{$pro->is_recommended == 1 ? "Recommended":"Not Recommended"}}</span></strong></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                    </div>

                    <div class="row" id="content2">

                        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">


                                @php $i=1 @endphp
                                @foreach($productsnonveg as $nonveg)

                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 target">
                                        <div class="strip">
                                            <figure>

                                                <span
                                                    class="ribbon {{$nonveg->is_active == 1 ? "green":"red"}}">{{$nonveg->is_active == 1 ? "Enabled":"Desabled"}}</span>


                                                <img src="{{asset($nonveg->image_url !=NULL ? $nonveg->image_url:'themes/default/images/all-img/empty.png')}}" data-src="{{asset($nonveg->image_url !=NULL ? $nonveg->image_url:'themes/default/images/all-img/empty.png')}}" class="img-fluid lazy loaded" alt="" data-was-processed="true">

                                                <a href="#" class="strip_info">

                                                    <div
                                                        class="badge-v2-{{$nonveg->is_veg == 1 ? "veg":"nonveg"}}">{{$nonveg->is_veg == 1 ? "Veg":"Non-Veg"}}</div>


                                                    <div class="item_title">
                                                        <h3>{{ $nonveg->name }}</h3>
                                                        <small>{{$selected_language->data['store_products_price'] ?? 'Price'}}: <b> @include('layouts.render.currency',["amount"=>$nonveg->price])</b></small>
                                                    </div>
                                                </a>
                                            </figure>
                                            <ul>
                                                <li><span class="take yes"><a href="{{route('store_admin.update_products',$nonveg->id)}}" class="btn btn-sm btn-primary" style="color: #ffffff"><b>{{$selected_language->data['store_edit'] ?? 'Edit'}}</b></a></span>
                                                    <span class="deliv yes"><a class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete this item?')){ event.preventDefault();document.getElementById('delete-form-{{$nonveg->id}}').submit(); }"><b style="color: #ffffff">{{$selected_language->data['store_delete'] ?? 'Delete'}}</b></a>
                                                        <form method="post" action="{{route('store_admin.delete_product')}}"
                                                              id="delete-form-{{$nonveg->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" value="{{$nonveg->id}}" name="id">
                                                        </form></span></li>
                                                <li>
                                                    <div class="score"><strong><span
                                                                class="badge badge-{{$nonveg->is_recommended == 1 ? "success":"danger"}}">{{$nonveg->is_recommended == 1 ? "Recommended":"Not Recommended"}}</span></strong></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>

                    <div class="row" id="content3">

                        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">


                                @php $i=1 @endphp
                                @foreach($productsveg as $veg)

                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 target">
                                        <div class="strip">
                                            <figure>

                                                <span
                                                    class="ribbon {{$veg->is_active == 1 ? "green":"red"}}">{{$veg->is_active == 1 ? "Enabled":"Desabled"}}</span>


                                                <img src="{{asset($veg->image_url !=NULL ? $veg->image_url:'themes/default/images/all-img/empty.png')}}" data-src="{{asset($veg->image_url !=NULL ? $veg->image_url:'themes/default/images/all-img/empty.png')}}" class="img-fluid lazy loaded" alt="" data-was-processed="true">

                                                <a href="#" class="strip_info">

                                                    <div
                                                        class="badge-v2-{{$veg->is_veg == 1 ? "veg":"nonveg"}}">{{$veg->is_veg == 1 ? "Veg":"Non-Veg"}}</div>


                                                    <div class="item_title">
                                                        <h3>{{ $veg->name }}</h3>
                                                        <small>{{$selected_language->data['store_products_price'] ?? 'Price'}}: <b> @include('layouts.render.currency',["amount"=>$veg->price])</b></small>
                                                    </div>
                                                </a>
                                            </figure>
                                            <ul>
                                                <li><span class="take yes"><a href="{{route('store_admin.update_products',$veg->id)}}" class="btn btn-sm btn-primary" style="color: #ffffff"><b>{{$selected_language->data['store_edit'] ?? 'Edit'}}</b></a></span>
                                                    <span class="deliv yes"><a class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete this item?')){ event.preventDefault();document.getElementById('delete-form-{{$veg->id}}').submit(); }"><b style="color: #ffffff">{{$selected_language->data['store_delete'] ?? 'Delete'}}</b></a>
                                                        <form method="post" action="{{route('store_admin.delete_product')}}"
                                                              id="delete-form-{{$veg->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" value="{{$veg->id}}" name="id">
                                                        </form></span></li>
                                                <li>
                                                    <div class="score"><strong><span
                                                                class="badge badge-{{$veg->is_recommended == 1 ? "success":"danger"}}">{{$veg->is_recommended == 1 ? "Recommended":"Not Recommended"}}</span></strong></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>


                    </div>

                    <div class="row" id="content4">

                        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">


                                @php $i=1 @endphp
                                @foreach($productsdisabled as $prodesabled)

                                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 target">
                                        <div class="strip">
                                            <figure>

                                                <span
                                                    class="ribbon {{$prodesabled->is_active == 1 ? "green":"red"}}">{{$prodesabled->is_active == 1 ? "Enabled":"Desabled"}}</span>


                                                <img src="{{asset($prodesabled->image_url !=NULL ? $prodesabled->image_url:'themes/default/images/all-img/empty.png')}}" data-src="{{asset($prodesabled->image_url !=NULL ? $prodesabled->image_url:'themes/default/images/all-img/empty.png')}}" class="img-fluid lazy loaded" alt="" data-was-processed="true">

                                                <a href="#" class="strip_info">

                                                    <div
                                                        class="badge-v2-{{$prodesabled->is_veg == 1 ? "veg":"nonveg"}}">{{$prodesabled->is_veg == 1 ? "Veg":"Non-Veg"}}</div>


                                                    <div class="item_title">
                                                        <h3>{{ $prodesabled->name }}</h3>
                                                        <small>{{$selected_language->data['store_products_price'] ?? 'Price'}}: <b> @include('layouts.render.currency',["amount"=>$prodesabled->price])</b></small>
                                                    </div>
                                                </a>
                                            </figure>
                                            <ul>
                                                <li><span class="take yes"><a href="{{route('store_admin.update_products',$prodesabled->id)}}" class="btn btn-sm btn-primary" style="color: #ffffff"><b>{{$selected_language->data['store_edit'] ?? 'Edit'}}</b></a></span>
                                                    <span class="deliv yes"><a class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete this item?')){ event.preventDefault();document.getElementById('delete-form-{{$prodesabled->id}}').submit(); }"><b style="color: #ffffff">{{$selected_language->data['store_delete'] ?? 'Delete'}}</b></a>
                                                        <form method="post" action="{{route('store_admin.delete_product')}}"
                                                              id="delete-form-{{$prodesabled->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" value="{{$prodesabled->id}}" name="id">
                                                        </form></span></li>
                                                <li>
                                                    <div class="score"><strong><span
                                                                class="badge badge-{{$prodesabled->is_recommended == 1 ? "success":"danger"}}">{{$prodesabled->is_recommended == 1 ? "Recommended":"Not Recommended"}}</span></strong></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>








                </div>

            </div>
        </div>







        <a href="{{route('store_admin.addproducts')}}" class="float">
            <i class="fa fa-plus my-float"></i>
        </a>

    </div>

    <script>

            // Set home as default active page content
            var activeContent = document.getElementById('tutorials');
            activeContent.style.display = 'block';

            // Add active class to home button
            var activeButton = document.getElementById('active-button');
            activeButton.classList.add('active');

            // Show or hide page content on click event
            function openContent(event, contentId){
            var i;

            // Loop through and hide page content
            var contentPage = document.getElementsByClassName('content-page');
            for (i = 0; i < contentPage.length; i++){
            contentPage[i].style.display = 'none';
        }

            // Loop through content buttons and replace the active class to empty
            contentButton = document.getElementsByClassName('content-button');
            for (i = 0; i < contentButton.length; i++){
            contentButton[i].className = contentButton[i].className.replace('active', '');
        }

            // Loop through HTML id's to show the element
            // with an active class during and event

            document.getElementById(contentId).style.display = 'block';
            event.currentTarget.className += ' active';
        }
    </script>


    <script>

        function myFunction() {
            var input = document.getElementById("Search");
            var filter = input.value.toLowerCase();
            var nodes = document.getElementsByClassName('target');

            for (i = 0; i < nodes.length; i++) {
                if (nodes[i].innerText.toLowerCase().includes(filter)) {
                    nodes[i].style.display = "block";
                } else {
                    nodes[i].style.display = "none";
                }
            }
        }
    </script>


@endsection
