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
                            <div class="col-sm-6">
                                <table
                                       class="admin table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                       style="width: 1180px;">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>ID</th>
                                        <th>Color</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-main">
                                    @foreach($data as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->color_value}}</td>
                                            <td>
                                                <button class='btn btn-blue btn-update' data-id='1'>Cập nhật</button>
                                                <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{route('color.delete',['id' => $value->id])}}"><button class='btn btn-danger btn-delete-1'>Xóa</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table
                                    class="admin table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                    style="width: 1180px;">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>ID</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-main">
                                    @foreach($size as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->size_value}}</td>
                                            <td>
                                                <button class='btn btn-blue btn-update' data-id='2'>Cập nhật</button>
                                                <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{route('size.delete',['id' => $value->id])}}"><button class='btn btn-danger btn-delete-1'>Xóa</button></a>
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

    <!-- plugin js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{asset('assets/pages/create-project.init.js')}}"></script>

    <script src="{{asset('assets/js/custom-product.js')}}"></script>
    <script src="{{asset('assets/js/toast.js')}}"></script>
    <script>
        dataTable = $('.admin').DataTable({
            'pagingType': 'numbers',
        });
    </script>

@endsection
