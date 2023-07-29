$(document).ready(function (){

    $('.product_detail').click(function (e){
        e.preventDefault();
        var productID = $(this).data('product-id'); // lấy giá trị của thuộc tính data-product-id
        detail(productID);
    });
    function detail(id){
        var url_detail = 'http://127.0.0.1:8000/product/detail/';
        // var url_detail = "{{ route('route.detail') }}";
        console.log(url_detail+id)
        // debugger;
        $.ajax({
            url: url_detail + id,
            method: 'GET',
            dataType: 'json',
            success: function (data){
                console.log(data);

                $('.viewDetail_ajax').append(`
                    <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="modal_tab">
                                <div style="--swiper-navigation-color: black; --swiper-pagination-color: black" class="swiper mySwiper2">
                                    <div class="swiper-wrapper">
                                        ${data.images.map(item => `<div class="swiper-slide"><img src="storage/${item.url}" /></div>`)}
                                    </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                </div>
                                    <div thumbsSlider="" class="swiper mySwiper">
                                        <div class="swiper-wrapper">
                                            ${data.images.map(item => `
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
                                    <h2>${data.product_name}</h2>
                                </div>
                                <div class="modal_price mb-10">
                                    <span class="new_price">$64.99</span>
                                    <span class="old_price">$78.99</span>
                                </div>
                                <div class="modal_description mb-15">
                                    <p>${data.description}</p>
                                </div>
                                <div class="variants_selects">
                                    <div class="variants_size">
                                        <h2>size</h2>
                                        <select class="select_option">
                                               ${data.variations.map(item => `
                                                    <option value="${item.size_id}">
                                                        ${item.size_id == 1 ? 'L' : ''}
                                                        ${item.size_id == 2 ? 'X' : ''}
                                                    </option>
                                               `).join('')}
                                        </select>
                                    </div>
                                    <div class="variants_color">
                                        <h2>color</h2>
                                        <select class="select_option">
                                            ${data.variations.map(item => `
                                                    <option value="${item.color_id}">
                                                        ${item.color_id == 1 ? 'Đỏ' : ''}
                                                        ${item.color_id == 2 ? 'Xanh' : ''}
                                                    </option>
                                               `).join('')}
                                        </select>
                                    </div>
                                    <div class="modal_add_to_cart">
                                        <form action="#">
                                            <input min="1" max="100" step="2" value="1" type="number">
                                            <button type="submit">add to cart</button>
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
            },
            error: function (error){
                console.log('lỗi');
            }
        })
    }



});
