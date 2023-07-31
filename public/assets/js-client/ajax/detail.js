$(document).ready(function () {

    let myCart = [];
    var url_detail = 'http://127.0.0.1:8000/product/detail/';
    const save_cart = 'http://127.0.0.1:8000/save-cart';

    $('.product_detail').click(function (e) {
        e.preventDefault();
        var productID = $(this).data('product-id'); // lấy giá trị của thuộc tính data-product-id
        detail(productID);
    });

    function detail(id) {
        console.log(url_detail + id)
        // debugger;
        $.ajax({
            url: url_detail + id,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data.mycart);
                let productDetail = data.product_detail; // đây là thông tin chi tiết
                $('.viewDetail_ajax').empty();
                $('.viewDetail_ajax').append(`
                    <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="modal_tab">
                                <div style="--swiper-navigation-color: black; --swiper-pagination-color: black" class="swiper mySwiper2">
                                    <div class="swiper-wrapper">
                                        ${productDetail.images.map(item => `
                                                            <div class="swiper-slide">
                                                                <img src="storage/${item.url}" />
                                                            </div>`
                )}
                                    </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                </div>
                                    <div thumbsSlider="" class="swiper mySwiper">
                                        <div class="swiper-wrapper">
                                            ${productDetail.images.map(item => `
                                            <div class="swiper-slide">
                                                <img src="storage/${item.url}" />
                                            </div>
                                            `)}
                                        </div>
                                    </div>
                            </div>
                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="modal_right">
                                <div class="modal_title mb-10">
                                    <h2 id="nameDetail_product">${productDetail.product_name}</h2>
                                </div>
                                <div class="modal_price mb-10">
                                    <span class="new_price">$64.99</span>
                                    <span class="old_price">$78.99</span>
                                </div>
                                <div class="modal_description mb-15">
                                    <p>${productDetail.description}</p>
                                </div>
                                <div class="variants_selects">
                                    <div class="variants_size">
                                        <h2>size</h2>
                                        <select id="variants_size" class="select_option">
                                               ${productDetail.variations.map(item => `
                                                    <option value="${item.size_id}">
                                                        ${item.size_id == 1 ? 'L' : ''}
                                                        ${item.size_id == 2 ? 'X' : ''}
                                                    </option>
                                               `).join('')}
                                        </select>
                                    </div>
                                    <div class="variants_color">
                                        <h2>color</h2>
                                        <select id="variants_color" class="select_option">
                                            ${productDetail.variations.map(item => `
                                                    <option value="${item.color_id}">
                                                        ${item.color_id == 1 ? 'Đỏ' : ''}
                                                        ${item.color_id == 2 ? 'Xanh' : ''}
                                                    </option>
                                               `).join('')}
                                        </select>
                                    </div>
                                    <div class="modal_add_to_cart">
                                        <form action="">
                                            <input id="variants_quantity" min="1" max="100" step="2" value="1" type="number">

<!--                                            button event-->
                                            <button type="button" id="add_to_cart">Thêm vào giỏ hàng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                var swiper = new Swiper(".mySwiper", {
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".mySwiper2", {
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper,
                    },
                });

                // console.log(myCart);
                // event
                $('#add_to_cart').click(function () {

                    let size = $("#variants_size").val();
                    let color = $("#variants_color").val();
                    let quantity = $("#variants_quantity").val();
                    let product_id = data.product_detail.id;
                    let newProduct = {
                        'product_id': product_id,
                        'color_id': color,
                        'size_id': size,
                        'quantity': quantity,
                    }
                    if (data.mycart.length == 0) {
                        myCart.push(newProduct);
                        saveCart(myCart);
                    } else {
                        if (data.mycart.data.length >= 1) {
                            let found = false;
                            let newItem = {};
                            let newMyCart;
                            // console.log('mảng hiện có');
                            // console.log(data.mycart.data); // log ra mảng hiện tại đang có
                            for (cartItem of data.mycart.data) {
                                if (cartItem.product_id == product_id && cartItem.size_id == size && cartItem.color_id == color) {
                                    cartItem['quantity'] = +cartItem.quantity + +quantity;
                                    newItem = cartItem; // gán item đã thay đổi quantity vào bieens new

                                    newMyCart = data.mycart.data.filter(item => cartItem.product_id !== newProduct.product_id); // xóa id bị trùng trên cart
                                    // console.log(newMyCart)


                                    found = true; // gán found bằng true
                                    break;
                                }
                            };

                            if (found){
                                // console.log('mảng đã sửa khi lặp')
                                // console.log(data.mycart.data)

                                // data.mycart.data.push(newItem);
                                saveCart(newMyCart)
                            }else {
                                data.mycart.data.push(newProduct);
                                saveCart(data.mycart.data)
                            }


                        }
                    }

                });
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    function saveCart(data) {

        $.ajax({
            url: save_cart,
            method: 'POST',
            data: {
                data,
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function (response) {
                console.log(response);
                toastr["success"]("Thêm giỏ hàng thành công!")
            },
            error: function (error) {
                console.log(error);
            }
        });


    }
});
