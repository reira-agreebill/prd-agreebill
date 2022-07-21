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
                <a href="{{route('uploaded_modules')}}" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Uploaded Modules">
                    <span class="btn-inner--icon"><i class="fas fa-comment-alt"></i></span>
                    <span class="btn-inner--text">Uploaded Modules</span>
                </a>
            </div>
        </div>
        <br>

        <div class="card">
            @if($modules->count() > 0)




                    <table class="table">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Module Id</th>
                            <th scope="col">Version</th>
                            <th scope="col">Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modules as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->module_id}}</td>
                            <td>{{$data->version}}</td>
                            <td>
                                @if($data->category == 1)

                                  SaaS Theme
                                   @endif

                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>



            @else
                <div class="orders-not-found"><img src="{{asset('img/no-orders-illustrations.svg')}}" style="border: none" alt="No orders"><h4 class="section-text-3 my8">You don't have any Modules</h4></div>
            @endif
        </div>



    </div>



@endsection
