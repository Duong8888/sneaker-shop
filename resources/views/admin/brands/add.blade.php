@extends('admin.templatesAdmin.layoutAdmin')
@section('content')
    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible" role="alert">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>

    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form action="{{route('route.brands.add')}}" method="post"
                          class="dropzone dz-clickable d-flex justify-content-between flex-wrap"
                          id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                          data-upload-preview-template="#uploadPreviewTemplate" enctype="multipart/form-data">
                        <div class="col-xl-6">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Tên thương hiệu</label>
                                <input type="text" class="form-control" name="name_brand">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">slug</label>
                                {{--                                <input type="text" class="form-control" name="slug" value="">--}}
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="mb-3">
                                        <label class="form-label">Ngày nhập</label>
                                        <input type="hidden" class="form-control flatpickr-input"
                                               data-toggle="flatpicker" placeholder="October 9, 2019" name="created_at">
                                        {{--                                        <input class="form-control flatpickr-input input" placeholder="October 9, 2019" tabindex="0" type="date" readonly="readonly">--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="my-3 mt-xl-0">
                                <label for="projectname" class="mb-0 form-label">Avatar</label>

                                <div class="dz-message needsclick">
                                    <i class="bi bi-cloud-upload font-22"></i>
                                    <h4>Thả tập tin ở đây hoặc bấm vào để tải tệp lên.</h4>
                                </div>

                                <input type="hidden" name="uploaded_files" id="uploadedFiles">

                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                                <!-- mẫu xem trước tập tin -->
                                <div class="d-none" id="uploadPreviewTemplate">
                                    <div class="card mt-1 mb-0 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img data-dz-thumbnail="" src="#" class="avatar-sm rounded bg-light"
                                                         alt="">
                                                </div>
                                                <div class="col ps-0">
                                                    <a href="javascript:void(0);" class="text-muted fw-bold"
                                                       data-dz-name=""></a>
                                                    <p class="mb-0" data-dz-size=""></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="#" class="btn btn-link btn-lg text-muted"
                                                       data-dz-remove="">
                                                        <i class="bi bi-x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end mẫu xem trước tập tin -->
                            </div>

                        </div>
                        <!-- end row -->

                        <div class="row mt-3 col-xl-12">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success waves-effect waves-light m-1">
                                    <i class="bi bi-check-circle"></i> Create
                                </button>
                                <a href="{{route('route.brands.list')}}">
                                    <button type="button" class="btn btn-light waves-effect waves-light m-1">
                                        <i class="bi bi-x"></i> Cancel
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
        @endsection
        @section('js')
            <!-- plugin js -->
            <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
            <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
            <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

            <!-- Init js-->
            <script src="{{asset('assets/pages/create-project.init.js')}}"></script>
        @endsection
