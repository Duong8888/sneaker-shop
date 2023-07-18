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
                    <form action="{{route('route.brands.add')}}" method="POST" id="image-form"
                          class=" d-flex justify-content-between flex-wrap" enctype="multipart/form-data">
                        @csrf
                        <div class="col-xl-6">


                            <div class="mb-3">
                                <label class="form-label">Tên thương hiệu</label>
                                <input type="text" class="form-control" name="name_brand">
                            </div>
{{--                            <div class="mb-3">--}}
{{--                                <label class="form-label">slug</label>--}}
{{--                                <input type="text" class="form-control" name="slug" value="">--}}
{{--                            </div>--}}

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

                        <div class="col-xl-6" >
                            <div class="form-group">
                                <label class="col-md-3 col-sm-4 control-label">Ảnh CMND/CCCD</label>
                                <div class="col-md-9 col-sm-8">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <img id="mat_truoc_preview" src="" alt="your image"
                                                 style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                            <input type="file" name="image" accept="image/*"
                                                   class="form-control-file @error('image') is-invalid @enderror" id="cmt_truoc">
                                            <label for="cmt_truoc">Mặt trước</label><br/>
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

            <script>
                $(function(){
                    function readURL(input, selector) {
                        if (input.files && input.files[0]) {
                            let reader = new FileReader();

                            reader.onload = function (e) {
                                $(selector).attr('src', e.target.result);
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $("#cmt_truoc").change(function () {
                        readURL(this, '#mat_truoc_preview');
                    });
                });
            </script>
            <!-- plugin js -->
            <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/libs/input-mask/jquery.inputmask.js') }}"></script>



            <!-- Init js-->
            <script src="{{asset('assets/pages/create-project.init.js')}}"></script>
        @endsection
