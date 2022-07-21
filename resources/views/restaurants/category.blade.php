@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")

    <style>


        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #322A7D;
            color: #FFA101;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
        }


        .my-float {
            margin-top: 22px;
        }
    </style>




    <div class="container-fluid">

        <div class="card-body">
            <button class="btn"
                    style="background-color: #FFA101; opacity: 65%; color: #000000">{{$selected_language->data['store_category'] ?? 'Category'}}</button>
            <a class="btn btn-secondary"
               href="{{route('store_admin.products')}}">{{$selected_language->data['store_products'] ?? 'Products'}}</a>

            <a href="{{route('store_admin.addon_categories')}}"
               class="btn btn-secondary">{{$selected_language->data['store_addon_category'] ?? 'Addon Categories'}}</a>
            <a href="{{route('store_admin.addon')}}"
               class="btn btn-secondary">{{$selected_language->data['store_addons'] ?? 'Addons'}}</a>


        </div>

        <div class="alert alert-warning alert-dismissible fade show" style="margin-bottom: 15px;" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Delete Alert!</strong> Careful to delete category. auto delete all products in that category.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="row">


            @php $i=1 @endphp
            @foreach($category as $cat)


                <div class="col-md-3">

                    <div class="card shadow-lg" style="padding: 5px">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <!-- Avatar -->
                                <a href="#" class="avatar img-avatar-thumb">
                                    <img alt="Image placeholder"
                                         src="{{asset($cat->image_url !=NULL ? $cat->image_url:'themes/default/images/all-img/empty.png')}}">
                                </a>
                            </div>
                            <div class="col ml--2">
                                <h4 class="mb-0">
                                    {{$selected_language->data['store_category_name'] ?? 'Name'}}:
                                    <b>{{ $cat->name }}</b>
                                </h4>

                                {{--                                            <span class="badge badge-{{$cat->is_active == 1 ? "success":"danger"}}">{{$cat->is_active == 1 ? "ENABLED":"DISABLED"}}</span>--}}
                                <span class="badge badge-info">{{$cat->productinfos_count}} products</span>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('store_admin.update_category',$cat->id)}}"
                                   class="btn btn-sm btn-outline-primary"><b>{{$selected_language->data['store_edit'] ?? 'Edit'}}</b></a>
                                <a class="btn btn-sm btn-outline-danger"
                                   onclick="if(confirm('Are you sure you want to delete this category, auto delete all products in this category ?')){ event.preventDefault();document.getElementById('delete-form-{{$cat->id}}').submit(); }"
                                ><b>{{$selected_language->data['store_delete'] ?? 'Delete'}}</b></a>
                                <form method="post" action="{{route('store_admin.delete_category')}}"
                                      id="delete-form-{{$cat->id}}" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" value="{{$cat->id}}" name="id">
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>


    </div>


    </div>
    <a href="{{route('store_admin.addcategories')}}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>

@endsection
