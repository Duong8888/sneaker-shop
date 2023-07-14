@extends('admin.templatesAdmin.layoutAdmin')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
{{--                    <form action="" class="row">--}}
                        <div class="col-xl-6">
                            {{-- Tên sản phẩm --}}
                            <div class="mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control">
                            </div>

                            {{-- Mô tả sản phẩm --}}
                            <div class="mb-3">
                                <label for="project-overview" class="form-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>

                            {{-- kích cỡ và màu sắc --}}
                            <div class="mb-3">
                                <label class="form-label">Màu sắc sản phẩm</label> <br>
                                <label for="color1" class="form-check form-check-inline">
                                    <input type="checkbox" name="colors[]" value="red" id="color1"/> Đỏ
                                </label>

                                <label for="color2" class="form-check form-check-inline">
                                    <input type="checkbox" name="colors[]" value="blue" id="color2"/> Xanh dương
                                </label>

                                <label for="color3" class="form-check form-check-inline">
                                    <input type="checkbox" name="colors[]" value="green" id="color3"/> Xanh lá
                                </label>

                                <label for="color4" class="form-check form-check-inline">
                                    <input type="checkbox" name="colors[]" value="yellow" id="color4"/> Vàng
                                </label>

                                <label for="color5" class="form-check form-check-inline">
                                    <input type="checkbox" name="colors[]" value="orange" id="color5"/> Cam
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kích cỡ sản phẩm</label> <br>
                                <label for="size1" class="form-check form-check-inline">
                                    <input type="checkbox" name="sizes[]" value="S" id="size1"/> S
                                </label>

                                <label for="size2" class="form-check form-check-inline">
                                    <input type="checkbox" name="sizes[]" value="M" id="size2"/> M
                                </label>

                                <label for="size3" class="form-check form-check-inline">
                                    <input type="checkbox" name="sizes[]" value="L" id="size3"/> L
                                </label>

                                <label for="size4" class="form-check form-check-inline">
                                    <input type="checkbox" name="sizes[]" value="XL" id="size4"/> XL
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="mb-3">
                                        <label class="form-label">Ngày nhập</label>
                                        <input type="hidden" class="form-control flatpickr-input" data-toggle="flatpicker"
                                               placeholder="October 9, 2019">
                                        <input class="form-control flatpickr-input input" placeholder="October 9, 2019"
                                               tabindex="0" type="text" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="my-3 mt-xl-0">
                                <label for="projectname" class="mb-0 form-label">Avatar</label>

                                <form action="https://coderthemes.com/" method="post" class="dropzone dz-clickable"
                                      id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                                      data-upload-preview-template="#uploadPreviewTemplate">

                                    <div class="dz-message needsclick">
                                        <i class="bi bi-cloud-upload font-22"></i>
                                        <h4>Thả tập tin ở đây hoặc bấm vào để tải tệp lên.</h4>
                                    </div>
                                </form>

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
                                                    <a href="#" class="btn btn-link btn-lg text-muted" data-dz-remove="">
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

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-success waves-effect waves-light m-1">
                                    <i class="bi bi-check-circle"></i> Create
                                </button>
                                <a href="{{route('route_product_list')}}">
                                    <button type="button" class="btn btn-light waves-effect waves-light m-1">
                                        <i class="bi bi-x"></i> Cancel
                                    </button>
                                </a>
                            </div>
                        </div>
{{--                    </form>--}}

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
