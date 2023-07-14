@extends('admin.templatesAdmin.layoutAdmin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex align-items-center mb-3">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control border" id="dash-daterange">
                        <span class="input-group-text bg-blue border-blue text-white">
                                                    <i class="mdi mdi-calendar-range"></i>
                                                </span>
                    </div>
                    <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                        <!-- <i class="mdi mdi-autorenew"></i> -->
                        <i class="bi bi-arrow-repeat"></i>
                    </a>
                    <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                        <!-- <i class="mdi mdi-filter-variant"></i> -->
                        <i class="bi bi-filter"></i>
                    </a>
                </form>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<div class="row">
      <h1>HIHI XIN CHÀO CÁC BẠN</h1>
</div>
@endsection
@section('js')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>
@endsection
