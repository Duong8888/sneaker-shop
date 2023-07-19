@extends('admin.templatesAdmin.layoutAdmin')
@section('link')
    <!-- third party css -->
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/css/css-product.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    <style>

    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Full width modal content -->
                    <div id="full-width-modal" class="modal fade" tabindex="-1" aria-labelledby="fullWidthModalLabel"
                         style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            @include('admin.product.add')
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <div class="button-list">
                        <!-- Full width modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#full-width-modal">Thêm mới sản phẩm
                        </button>
                    </div>
                </div> <!-- end card-body -->
                <div class="card-body">

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
                                    <tbody  class="table-main" data-route="{{route('product.list')}}">
                                    {{--         load ajax                          --}}
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

    <!-- plugin js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{asset('assets/pages/create-project.init.js')}}"></script>

    <script src="{{asset('assets/js/custom-product.js')}}"></script>
    <script src="{{asset('assets/js/toast.js')}}"></script>

@endsection
