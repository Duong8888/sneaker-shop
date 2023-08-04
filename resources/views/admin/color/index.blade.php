@extends('admin.templatesAdmin.layoutAdmin')
@section('content')
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
                        <button type="button" class="btn btn-primary btn-show-modal">Thêm mới mằu</button>
                    </div>
                </div> <!-- end card-body -->
                <div class="card-body">
                    <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                            <table
                                class="admin table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Color</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-data" data-route="{{route('color.list')}}">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
        @include('admin.color.add')
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/js/custom-variations.js')}}"></script>
    <script src="{{asset('assets/js/toast.js')}}"></script>
@endsection
