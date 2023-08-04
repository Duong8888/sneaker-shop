@extends('client.templates.layout')
@section('banner')
    @include('client.templates.banner')
@endsection

@section('content')

    <!--product area start-->
    <section class="product_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span> <strong>Ưu đãi</strong>đặc biệt</span></h2>
                    </div>
                    <div class="product_carousel product_column4 owl-carousel">
                        @foreach($data_products as $v)
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="">{{$v->product_name}}</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    @if(count($v->images) > 1)
                                        <a class="primary_img" href="{{route('route.viewDetail',$v->id)}}"><img src="storage/{{$v->images[0]->url}}" alt=""></a>
                                        <a class="secondary_img" href="{{route('route.viewDetail',$v->id)}}"><img src="storage/{{$v->images[1]->url}}"
                                                                              alt=""></a>
                                    @else
                                        <a class="primary_img" href="{{route('route.viewDetail',$v->id)}}"><img src="storage/{{$v->images[0]->url}}" alt=""></a>
                                    @endif

                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button">
                                                <a data-bs-toggle="modal" data-bs-target="#modal_box"
                                                   title="quick view" class="product_detail productDetail_route"
                                                   data-product-id="{{$v->id}}">
                                                    <span class="lnr lnr-magnifier"></span>
                                                </a>
                                            </li>
                                            <li class="wishlist">
                                                <a href="" title="Add to Wishlist">
                                                    <span class="lnr lnr-heart"></span>
                                                </a>
                                            </li>
                                            <li class="compare">
                                                <a href="" title="compare">
                                                    <span class="lnr lnr-sync"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">

                                        <div class="price_box">
                                        <span class="regular_price">
                                            @if(count($v->variations) >= 2)
                                                @php
                                                    $min = null;
                                                    $max = null;
                                                    foreach ($v->variations as $variation){
                                                        if ($min === null || $variation->price < $min){
                                                            $min = $variation->price;
                                                        }
                                                        if ($max === null || $variation->price > $max){
                                                            $max = $variation->price;
                                                        }
                                                    }
                                                @endphp
                                                {{number_format($min)}} - {{number_format($max)}}
                                            @else
                                                {{number_format($v->variations[0]->price)}}
                                            @endif
                                        đ</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                    <div class="quantity_progress">
                                        <p class="product_sold">Sold: <span>199</span></p>
                                        <p class="product_available">Số lượng:
                                            <span>{{$v->variations[0]->quantity}}</span></p>
                                    </div>
                                    <div class="bar_percent">

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--product area end-->

    <!--featured categories area start-->
    <section class="featured_categories featured_c_four  mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span> <strong>Thương hiệu</strong>đặc trưng</span></h2>
                    </div>
                    <!--brand area start-->
                    <div class="brand_area mb-42">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="brand_container owl-carousel">
                                        @foreach($data_brands as $v)
                                        <div class="single_brand">
                                            <a href="#"><img src="storage/{{$v->image}}" alt=""></a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--brand area end-->
                </div>
            </div>
        </div>
    </section>
    <!--featured categories area end-->

    <!--product area start-->
    <section class="product_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span> <strong>Sản phẩm</strong>của chúng tôi</span></h2>
                    </div>
                    <div class="product_carousel product_column5 owl-carousel">
                        @foreach($data_products as $v)
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">{{$v->product_name}}</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    @if(count($v->images) > 1)
                                        <a class="primary_img" href="{{route('route.viewDetail',$v->slug)}}"><img src="storage/{{$v->images[0]->url}}" alt=""></a>
                                        <a class="secondary_img" href="{{route('route.viewDetail',$v->slug)}}"><img src="storage/{{$v->images[1]->url}}"
                                                                              alt=""></a>
                                    @else
                                        <a class="primary_img" href="{{route('route.viewDetail',$v->slug)}}"><img src="storage/{{$v->images[0]->url}}" alt=""></a>
                                    @endif
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"
                                                                        class="product_detail productDetail_route"
                                                                        data-product-id="{{$v->id}}">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                        <span class="">
                                            @if(count($v->variations) >= 2)
                                                @php
                                                    $min = null;
                                                    $max = null;
                                                    foreach ($v->variations as $variation){
                                                        if ($min === null || $variation->price < $min){
                                                            $min = $variation->price;
                                                        }
                                                        if ($max === null || $variation->price > $max){
                                                            $max = $variation->price;
                                                        }
                                                    }
                                                @endphp
                                                {{number_format($min)}} - {{number_format($max)}}
                                            @else
                                                {{number_format($v->variations[0]->price)}}
                                            @endif
                                        đ</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--product area end-->

    <!--banner area start-->
    <section class="banner_area banner_static mb-50 d-flex align-items-center"
             data-bgimg="https://as2.ftcdn.net/v2/jpg/03/98/40/63/1000_F_398406350_TM01RxiN6Owk32GEgNLQQJ6LDag7PWOi.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_text">
                        <h2>Automotive Led</h2>
                        <h1>Headlight Kits</h1>
                        <p>HVC brings you only the best quality headlight kits</p>
                        <a href="#" class="bg-dark text-white">Discover Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--banner area end-->

    <!--product area start-->
    <section class="product_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span>Bán <strong>chạy nhất</strong></span></h2>
                    </div>
                    <div class="product_carousel product_column5 owl-carousel">
                        @foreach($data_products as $v)
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">{{$v->product_name}}</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    @if(count($v->images) > 1)
                                        <a class="primary_img" href="{{route('route.viewDetail',$v->id)}}"><img src="storage/{{$v->images[0]->url}}" alt=""></a>
                                        <a class="secondary_img" href="{{route('route.viewDetail',$v->id)}}"><img src="storage/{{$v->images[1]->url}}"
                                                                              alt=""></a>
                                    @else
                                        <a class="primary_img" href="{{route('route.viewDetail',$v->id)}}"><img src="storage/{{$v->images[0]->url}}" alt=""></a>
                                    @endif
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"
                                                                        class="product_detail productDetail_route"
                                                                        data-product-id="{{$v->id}}">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                        <span class="">
                                            @if(count($v->variations) >= 2)
                                                @php
                                                    $min = null;
                                                    $max = null;
                                                    foreach ($v->variations as $variation){
                                                        if ($min === null || $variation->price < $min){
                                                            $min = $variation->price;
                                                        }
                                                        if ($max === null || $variation->price > $max){
                                                            $max = $variation->price;
                                                        }
                                                    }
                                                @endphp
                                                {{number_format($min)}} - {{number_format($max)}}
                                            @else
                                                {{number_format($v->variations[0]->price)}}
                                            @endif
                                        đ</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{--                        <div class="single_product">--}}
                        {{--                            <div class="product_name">--}}
                        {{--                                <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>--}}
                        {{--                                <p class="manufacture_product"><a href="#">Accessories</a></p>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="product_thumb">--}}
                        {{--                                <a class="primary_img" href="product-details.html"><img--}}
                        {{--                                        src="{{asset('ui-client/assets/img/product/product2.jpg')}}" alt=""></a>--}}
                        {{--                                <a class="secondary_img" href="product-details.html"><img--}}
                        {{--                                        src="{{asset ('ui-client/assets/img/product/product3.jpg')}}" alt=""></a>--}}
                        {{--                                <div class="label_product">--}}
                        {{--                                    <span class="label_sale">-57%</span>--}}
                        {{--                                </div>--}}

                        {{--                                <div class="action_links">--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"--}}
                        {{--                                                                    data-bs-target="#modal_box" title="quick view">--}}
                        {{--                                                <span class="lnr lnr-magnifier"></span></a></li>--}}
                        {{--                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span--}}
                        {{--                                                    class="lnr lnr-heart"></span></a></li>--}}
                        {{--                                        <li class="compare"><a href="compare.html" title="compare"><span--}}
                        {{--                                                    class="lnr lnr-sync"></span></a></li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="product_content">--}}
                        {{--                                <div class="product_ratings">--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li><a href="#"><i class="ion-star"></i></a></li>--}}
                        {{--                                        <li><a href="#"><i class="ion-star"></i></a></li>--}}
                        {{--                                        <li><a href="#"><i class="ion-star"></i></a></li>--}}
                        {{--                                        <li><a href="#"><i class="ion-star"></i></a></li>--}}
                        {{--                                        <li><a href="#"><i class="ion-star"></i></a></li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="product_footer d-flex align-items-center">--}}
                        {{--                                    <div class="price_box">--}}
                        {{--                                        <span class="current_price">$140.00</span>--}}
                        {{--                                        <span class="old_price">$320.00</span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="add_to_cart">--}}
                        {{--                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--product area end-->


@endsection
@section('script-page')

    <script src="{{asset('assets/js-client/ajax/detail.js')}}"></script>
@endsection
