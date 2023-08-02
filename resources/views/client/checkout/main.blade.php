@extends('client.templates.layout')
@section('content')
    <div class="Checkout_section mt-32">
        <div class="container">
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Billing Details</h3>
                            <div class="row">

                                <div class="col-lg-12 mb-20">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" name="name" value="{{$data['name']}}">
                                </div>

                                <div class="col-12 mb-20">
                                    <label>Address <span>*</span></label>
                                    <input type="text" name="address" value="{{$data['address']}}">
                                </div>

                                <div class="col-lg-6 mb-20">
                                    <label>Phone<span>*</span></label>
                                    <input type="text">

                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label> Email Address <span>*</span></label>
                                    <input type="text" name="email" value="{{$data['email']}}">

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['myCart'] as $key => $value)
                                        <tr>
                                            <td> {{$value->Product->product_name}} <strong>
                                                    × {{$value->quantity}}</strong></td>
                                            <td> {{number_format($value->totalItem)}} VND</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Order Total</th>
                                        <td><strong>{{number_format($data['total_cart'])}} VND</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                        <div class="payment_method d-flex">
                            <div class="order_button mx-1">
                                <button type="submit">Thanh toán său</button>
                            </div>

                            <form action="{{route('checkout.payment.create')}}" method="POST">
                                @csrf
                                <input hidden type="number" name="total_amount" value="{{$data['total_cart']}}">
                                <div class="order_button">
                                    <button name="redirect" type="submit">Thanh toán VNPay</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
