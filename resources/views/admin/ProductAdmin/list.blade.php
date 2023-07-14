@extends('admin.templatesAdmin.layoutAdmin')
@section('link')
    <!-- third party css -->
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- third party css end -->
@endsection
@section('content')
    <style>

    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Data Table</h4>

                    <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                        <div class="row">
                            <div class="col-sm-12">
                                <table id="product__admin"
                                       class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                       style="width: 1180px;">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>description</th>
                                        <th>slug</th>
                                        <th>brand_id</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $value)
                                        <tr class="odd">
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->product_name}}</td>
                                            <td>{{$value->description}}</td>
                                            <td>{{$value->slug}}</td>
                                            <td>{{$value->brand_id}}</td>
                                            <td>
                                                <form action="" method="get" style="display: none">
                                                    @csrf
                                                </form>
                                                <button class="btn btn-danger">Delete</button>

                                                <a href="{{route('route_product_edit',['id' => $value->id])}}">
                                                    <button class="btn btn-primary">Update</button>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#product__admin');
    </script>
@endsection
