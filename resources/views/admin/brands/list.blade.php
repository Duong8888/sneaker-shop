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
                                <table id="product_admin"
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

                                    <tbody id="brandList" data-route="{{route('route.brands.index')}}">

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
{{--    <script>--}}
{{--        var jsonData = @json($data);--}}
{{--        console.log(jsonData); // Kiểm tra dữ liệu JSON trong console--}}
{{--    </script>--}}


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#product_admin');
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- plugin js -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/input-mask/jquery.inputmask.js') }}"></script>
    <!-- Init js-->
{{--    <script src="{{asset('assets/pages/create-project.init.js')}}"></script>--}}
    <script src="{{asset('assets/js/custom-brand.js')}}"></script>
<script src="{{asset('assets/js/toast.js')}}"></script>
@endsection
