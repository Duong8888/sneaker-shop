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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery -->

@endsection
@section('content')
    @if ( Session::has('success') )

        <div class="alert alert-success alert-dismissible" role="alert">

            <strong>{{ Session::get('success') }}</strong>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>


        </div>

    @endif
    <style>

    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-full-width h-100" role="document">
                        <div class="modal-content">
                            @include('admin.brands.add')
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3 add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Thêm Thương hiệu
                    </button>

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
                                        <th>images</th>
                                        <th>slug</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $value)
                                        <tr class="odd">
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->name_brand}}</td>
                                            <td>
                                                <img src="{{''.Storage::url($value->image)}}" width="100" height="100" style="border-radius: 50%" alt="">
                                            </td>
                                            <td>{{$value->slug}}</td>
                                            <td>
{{--                                                <a href="{{route('route.brands.delete',['id' => $value->id])}}" class="btn btn-danger">Delete</a>--}}
                                                <button class="btn btn-danger delete_brand" data-id="{{$value->id}}">Delete</button>
                                                <a href="{{route('route.brands.edit',['id' => $value->id])}}">
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


    <script>

    </script>
    <script>
        new DataTable('#product__admin');
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- plugin js -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/input-mask/jquery.inputmask.js') }}"></script>
    <!-- Init js-->
{{--    <script src="{{asset('assets/pages/create-project.init.js')}}"></script>--}}
    <script src="{{asset('assets/js/custom-brand.js')}}"></script>
@endsection
