@extends('client.templates.layout')
@section('content')
    <div class="shopping_cart_area mt-32">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Quantity</th>
                                        <th class="product_total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $value)
                                        <tr>
                                            {{--                                        <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>--}}
                                            <td class="product_thumb">
                                                <img class="image-order" src="{{asset('storage/'.$value['image'])}}" alt="">
                                            </td>
                                            <td class="product_name">
                                                <a href="#">{{$value['product']}}</a>
                                            </td>
                                            <td class="product-price">{{$value['price']}} VND</td>
                                            <td class="product_quantity">
                                                {{$value['quantity']}}
                                            </td>
                                            <td class="product_total">{{$value['total']}} VND</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <button type="submit">update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
