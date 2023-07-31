{{--@if ( Session::has('error') )--}}

{{--    <div class="alert alert-danger alert-dismissible" role="alert">--}}

{{--        <strong>{{ Session::get('error') }}</strong>--}}

{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}


{{--    </div>--}}

{{--@endif--}}

<div class="col-12">
    <h1>sdfbwelfghew;atiuyewgh;ewou</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="m-2 d-flex justify-content-end"><i data-bs-dismiss="modal" class="bi bi-x-lg font-22"></i></div>
                <form action="{{route('route.brands.add')}}" method="POST" id="image-form"
                      class=" d-flex justify-content-between flex-wrap h-100" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label">Tên thương hiệu</label>
                            <input type="text" class="form-control" name="name_brand">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group text-center">
                            <div class="col-md-9 col-sm-8">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="file" name="files[]" accept="image/*"
                                               class="form-control-file @error('image') is-invalid @enderror"
                                               id="cmt_truoc" style="display: none" multiple>
                                        <label for="cmt_truoc" class="font-48">Click để chọn ảnh</label>
                                        <br>
                                        <img id="mat_truoc_preview"
                                             src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                                             alt="your image"
                                             style="max-width: 200px; height:100px; margin-bottom: 10px;"
                                             class="img-fluid"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mt-3 col-xl-12">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1">
                                <i class="bi bi-check-circle"></i> Create
                            </button>
                            <a href="">
                                <button type="button" class="btn btn-light waves-effect waves-light m-1"
                                        data-bs-dismiss="modal">
                                    <i class="bi bi-x"></i> Cancel
                                </button>
                            </a>
                        </div>
                    </div>
                </form>


            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>



