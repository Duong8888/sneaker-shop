@extends('admin.templatesAdmin.layoutAdmin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <p class="page-title">Order Detail</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body row">
                        @if(session('message'))
                            <div class="alert alert-success">{{session('message')}}</div>
                        @endif
                        <p class="header-title mb-3">Đơn hàng của {{$user[0]->name}}</p>

                        <div class="col-lg-4">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="table-light">
                                <tr class="text-center">
                                    <th colspan="2">Thông tin khách hàng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Người nhận</th>
                                    <td>{{$user[0]->name}}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>{{$user[0]->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{$user[0]->address}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive col-lg-8">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Product name</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                    <tr>
                                        <th scope="row">{{$value['product']}}</th>
                                        <td><img src="{{asset('storage/'.$value['image'])}}" alt="product-img"
                                                 height="40">
                                        </td>
                                        <td>{{$value['quantity']}}</td>
                                        <td>{{$value['price']}} VND</td>
                                        <td>{{$value['total']}} VND</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row" colspan="4" class="text-end">Total :</th>
                                    <td>
                                        <div class="fw-bold">{{number_format($total)}} VND</div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <form method="POST" action="{{route('order.update',$id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mt-4">
                                <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                    <li class="nav-item" role="presentation" onclick="checkInput(1)">
                                        <a href="" data-bs-toggle="tab" aria-expanded="false"
                                           class="nav-link @if($order[0]->delivery_status == 1) active @endif m-0"
                                           aria-selected="false" role="tab" tabindex="-1">
                                            Chờ xác nhận
                                        </a>
                                    </li>
                                    <input @if($order[0]->delivery_status == 1) checked @endif hidden id="1" value="1"
                                           type="radio" name="status">
                                    <li class="nav-item" role="presentation" onclick="checkInput(2)">
                                        <a href="" data-bs-toggle="tab" aria-expanded="true"
                                           class="nav-link @if($order[0]->delivery_status == 2) active @endif"
                                           aria-selected="false" role="tab" tabindex="-1">
                                            Đang giao hàng
                                        </a>
                                    </li>
                                    <input @if($order[0]->delivery_status == 2) checked @endif id="2" hidden value="2"
                                           type="radio" name="status">
                                    <li class="nav-item" role="presentation" onclick="checkInput(3)">
                                        <a href="" data-bs-toggle="tab" aria-expanded="false"
                                           class="nav-link @if($order[0]->delivery_status == 3) active @endif m-0"
                                           aria-selected="true" role="tab">
                                            Giao hàng thành công
                                        </a>
                                    </li>
                                    <input @if($order[0]->delivery_status == 3) checked @endif id="3" value="3" hidden
                                           type="radio" name="status">
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-10"></div>
                                <div class="col-2">
                                    <button class="btn btn-outline-primary w-100 mt-2">Lưu trạng thái</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/js/custom-variations.js')}}"></script>
    <script src="{{asset('assets/js/toast.js')}}"></script>
    <script>
        function checkInput(inputId) {
            const inputElement = document.getElementById(inputId);
            if (inputElement) {
                inputElement.checked = true;
            }
        }
    </script>
@endsection
