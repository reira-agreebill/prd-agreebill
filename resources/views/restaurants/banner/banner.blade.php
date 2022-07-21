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


    <div class="container-fluid">

        <div class="row">





            @foreach($banner as $ban)

                <div class="col-md-3">

                <div class="card">
                    <img class="card-img-top" src="{{asset($ban->photo_url)}}" alt="{{$ban->name}}">
                    <div class="card-body" style="padding-left: 15px; padding-top: 15px; padding-bottom: 0px">
                        <h5 class="card-title"><b>{{$ban->name}}</b></h5>
                    </div>
                    <div class="card-body" style="padding:15px">
                        <a href="{{route('store_admin.banneredit',$ban->id)}}" class="card-link"><b>{{$selected_language->data['store_edit'] ?? 'Edit'}}</b></a>
                        <a class="card-link" onclick="if(confirm('Are you sure you want to delete this item?')){ event.preventDefault();document.getElementById('delete-form-{{$ban->id}}').submit(); }"><b style="color: red">{{$selected_language->data['store_delete'] ?? 'Delete'}}</b></a>

                        <form method="post" action="{{route('store_admin.delete_slider')}}"
                              id="delete-form-{{$ban->id}}" style="display: none">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" value="{{$ban->id}}" name="id">
                        </form>
                    </div>
                </div>
                </div>




            @endforeach
        </div>

    </div>

    <a href="{{route('store_admin.addbanner')}}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>


@endsection
