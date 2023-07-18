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
                        <form method="post" action="{{route('product.test')}}"
                              id="form-add"
                              class="dz-clickable d-flex justify-content-between flex-wrap"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="product-name" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control">
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
                                    <textarea class="form-control" name="description" rows="5"></textarea>
                                </div>


                                {{-- kích cỡ và màu sắc --}}
                                <div class="mb-3">
                                    <label class="form-label">Màu sắc sản phẩm</label> <br>
                                    <select class="form-control select2" data-route="{{route('color.add')}}"
                                            name="color" multiple="multiple">
                                        @foreach($color as $value)
                                            <option value="{{$value->id}}">{{$value->color_value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kích cỡ sản phẩm</label> <br>
                                    <select class="form-control select2" data-route="{{route('size.add')}}" name="sizes"
                                            multiple="multiple">
                                        @foreach($size as $value)
                                            <option value="{{$value->id}}">{{$value->size_value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 p-4">
                                <div class="my-3 mt-xl-0">
                                    <div class="row">
                                        <button type="button" class="btn btn-outline-success mb-2" id="variable">Tạo ra biến
                                            thể
                                        </button>
                                        <div class="col-12 d-flex justify-content-between flex-column p-0 custom-table">
                                            <!-- Date View -->
                                            <table class="table mb-0" id="table-variable">
                                                <div class="mt-2 btn-table w-100">
                                                    <div class="w-100 d-flex justify-content-between">
                                                        <div class="mb-3 col-6">
                                                            <button style="padding-right: 10px" type="button" id="btn-quantity"
                                                                    class="btn btn-success w-100">Đặt số lương
                                                            </button>
                                                        </div>
                                                        <div style="padding-left: 10px"  class="mb-3 col-6">
                                                            <button type="button" id="btn-price"
                                                                    class="btn btn-success w-100">Đặt giá chuẩn
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Mằu</th>
                                                    <th>Size</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                </tr>
                                                </thead>
                                                <tbody class="main-tab">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row text-center">
                                        <input type="file" name="files[]" id="product-image" multiple/>
                                        <label for="product-image" style="font-size: 20px">Tải ảnh lên <i class="bi bi-cloud-upload font-22"></i></label>
                                    </div>
                                    <div class="selected-images">

                                    </div>

                                    <!-- Preview -->

                                    <!-- mẫu xem trước tập tin -->

                                    <!-- end mẫu xem trước tập tin -->
                                </div>

                            </div>
                            <!-- end row -->

                            <div class="row mt-3 col-xl-12">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-1">
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
