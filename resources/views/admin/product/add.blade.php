<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="fullWidthModalLabel">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <form action="{{route('product.test')}}" method="post"
                              class="dropzone dz-clickable d-flex justify-content-between flex-wrap"
                              id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                              data-upload-preview-template="#uploadPreviewTemplate" enctype="multipart/form-data">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Thương hiệu</label> <br>
                                        <select class="brand">
                                        <option value="one"></option>
                                        @foreach($brand as $value)
                                            <option value="{{$value->id}}">{{$value->name_brand}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Mô tả sản phẩm --}}
                                <div class="mb-3">
                                    <label for="project-overview" class="form-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" rows="5"></textarea>
                                </div>


                                {{-- kích cỡ và màu sắc --}}
                                <div class="mb-3">
                                    <label class="form-label">Màu sắc sản phẩm</label> <br>
                                    <select class="form-control select2" data-route="{{route('color.add')}}" name="color" multiple="multiple">
                                        @foreach($color as $value)
                                            <option value="{{$value->id}}">{{$value->color_value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kích cỡ sản phẩm</label> <br>
                                    <select class="form-control select2" data-route="{{route('size.add')}}" name="sizes" multiple="multiple">
                                        @foreach($size as $value)
                                            <option value="{{$value->id}}">{{$value->size_value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 p-4">
                                <div class="my-3 mt-xl-0">
                                    <div class="row">
                                        <button type="button" class="btn btn-outline-success" id="variable">Tạo ra biến thể</button>
                                        <div class="col-12 d-flex justify-content-between flex-column">
                                            <!-- Date View -->
                                            <table class="table mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Mằu</th>
                                                    <th>Size</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td><input class="form-control"
                                                               tabindex="0" type="text" readonly="readonly"></td>
                                                    <td><input class="form-control"
                                                               tabindex="0" type="text" readonly="readonly"></td>
                                                    <td><input class="form-control"
                                                               tabindex="0" type="number" min="0"></td>
                                                    <td><input class="form-control"
                                                               tabindex="0" type="number" min="0"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="dz-message needsclick">
                                        <i class="bi bi-cloud-upload font-22"></i>
                                        <p class="font-15">Thả tập tin ở đây hoặc bấm vào để tải tệp lên.</p>
                                    </div>


                                    <!-- Preview -->
                                    <div class="dropzone-previews mt-3" id="file-previews"></div>

                                    <!-- mẫu xem trước tập tin -->
                                    <div class="d-none" id="uploadPreviewTemplate">
                                        <div class="card mt-1 mb-0 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <img data-dz-thumbnail="" src="#"
                                                             class="avatar-sm rounded bg-light"
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
                                    <button type="button" class="btn btn-success waves-effect waves-light m-1">
                                        <i class="bi bi-check-circle"></i> Create
                                    </button>

                                    <button type="button" data-bs-dismiss="modal"
                                            class="btn btn-light waves-effect waves-light m-1">
                                        <i class="bi bi-x"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
