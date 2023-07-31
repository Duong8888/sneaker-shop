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
                                    @foreach($data['my_cart'] as $key => $value)
                                        <tr>
                                            <td> {{$value->Product->product_name}} <strong> × {{$value->quantity}}</strong></td>
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
                            <div class="payment_method">
                                <div class="panel-default">
                                    <input id="payment" name="check_method" type="radio" data-target="createp_account">
                                    <label for="payment" data-bs-toggle="collapse" href="#method"
                                           aria-controls="method">Create an account?</label>

                                    <div id="method" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State
                                                / County, Store Postcode.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-default">
                                    <input id="payment_defult" name="check_method" type="radio"
                                           data-target="createp_account">
                                    <label for="payment_defult" data-bs-toggle="collapse" href="#collapsedefult"
                                           aria-controls="collapsedefult">PayPal <img
                                            src="{{asset('assets/images/icon/papyel.png')}}"
                                            alt=""></label>

                                    <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                PayPal account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="order_button">
                                    <button type="submit">Proceed to PayPal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
