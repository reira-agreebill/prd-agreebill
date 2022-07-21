@extends("admin.adminlayout")

@section("admin_content")

    <div class="container-fluid">

        <div class="card">

        <table class="table">
            <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Module Id</th>
                <th scope="col">Version</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <form  method="post" action="/admin/dashboard/modules/install" enctype="multipart/form-data">
                {{csrf_field()}}
            {!! $TH1PMsg !!}

            </form>

            <form  method="post" action="/admin/dashboard/modules/install" enctype="multipart/form-data">
            {{csrf_field()}}
            {!! $M2PDMsg !!}
            </form>

            </tbody>
        </table>

        </div>






    </div>



@endsection
