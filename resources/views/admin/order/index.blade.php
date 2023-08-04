@extends('admin.templatesAdmin.layoutAdmin')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Orders</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4">
                                <div class="text-lg-end">
                                    <button type="button" class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                            class="mdi mdi-basket me-1"></i> Add New Order
                                    </button>
                                    <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Payment Status</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th>Order Status</th>
                                    <th style="width: 125px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $value)
                                    <tr>
                                        <td>
                                            {{$value->id}}
                                        </td>
                                        <td>
                                            {{$value->created_at}}
                                        </td>
                                        <td>
                                            <h5><span class="badge bg-soft-success text-success"><i
                                                        class="mdi mdi-bitcoin"></i> {{$value->payment_status}}</span>
                                            </h5>
                                        </td>
                                        <td>
                                            {{number_format($value->total)}} NVD
                                        </td>
                                        <td>
                                            {{$value->payment_method}}
                                        </td>
                                        <td>
                                            @if($value->delivery_status == 1)
                                                <h5><span class="badge bg-warning">Chưa xác nhận</span></h5>
                                            @elseif($value->delivery_status == 2)
                                                <h5><span class="badge bg-info">Đang giao hàng</span></h5>
                                            @else
                                                <h5><span class="badge bg-success">Giao hàng thành công</span></h5>
                                            @endif

                                        </td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);"
                                                   class="table-action-btn dropdown-toggle arrow-none"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                   <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/General/Settings-2.svg--><svg
                                                           xmlns="http://www.w3.org/2000/svg"
                                                           xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                           height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                                fill="#8950fc"/>
                                                        </g>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item btn-update" href="{{route('order.show',$value->id)}}" data-id='${productId}'><i
                                                            class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Cập
                                                        nhật</a>
                                                    <a class="dropdown-item" href="{{route('order.show',$value->id)}}" data-id='${productId}'><i
                                                            class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Chi
                                                        tiết đơn hàng</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <ul class="pagination pagination-rounded justify-content-end my-2">
                            {{ $data->links() }}
                        </ul>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/js/custom-variations.js')}}"></script>
    <script src="{{asset('assets/js/toast.js')}}"></script>
@endsection
