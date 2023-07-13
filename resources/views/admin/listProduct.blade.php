@extends('admin.templatesAdmin.layoutAdmin')
@section('content')
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
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd">
                                        <td>id</td>
                                        <td>name</td>

                                        <td>
                                            <button class="btn btn-danger">Delete</button>
                                            <button class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>
                                    {{--                                    @foreach($data as $value)--}}
                                    {{--                                        <tr class="odd">--}}
                                    {{--                                            <td>{{$value->id}}</td>--}}
                                    {{--                                            <td>{{$value->name}}</td>--}}

                                    {{--                                            <td>--}}
                                    {{--                                                <button class="btn btn-danger">Delete</button>--}}
                                    {{--                                                <button class="btn btn-primary">Update</button>--}}
                                    {{--                                            </td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                    @endforeach--}}


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
    new DataTable('#product__admin');
@endsection
