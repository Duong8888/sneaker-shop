$(document).ready(function () {
    const action = $('.loadTable');
    const url = action.attr('data-route');
    const urlMinicart = $('.mini_cart').attr('data-view-miniCart');


    function loadTable() {
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                if (data == "") {
                    action.empty();
                    action.append(`
                     <h1>khum có sản phẩm hihi</h1>
                    `)
                    console.log('haha');
                } else {
                    // console.log('mảng dữ liệu từ session')
                    // console.log(data.mycart.data);
                    // console.log('mảng dữ liệu color')
                    // console.log(data.color);
                    // console.log('mảng dữ liệu product')
                    // console.log(data.arrProduct);
                    // console.log('dduwwongf dẫn ảnh')
                    //
                    // console.log(data.arrProduct[0].images[0].url);
                    // console.log('giá sản phẩm')
                    // console.log(data.arrProduct[0].variations[0].price);
                    action.empty();
                    action.append(`
                    <table>
                                    <thead>
                                    <tr>
                                        <th class="product_remove">Xóa</th>
                                        <th class="product_thumb">Ảnh sản phẩm</th>
                                        <th class="product_name">Tên sản phẩm</th>
                                        <th class="product-price">Kích cỡ</th>
                                        <th class="product_name">Màu</th>
                                        <th class="product_name">Giá</th>
                                        <th class="product_quantity">Số lượng</th>
                                        <th class="product_total">Tổng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    ${data.mycart.data.map(item => `

                                        <tr>
                                            <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                            <td class="product_thumb"><a href="#"><img src="storage/${getPropertiesNameById(item.product_id, data.arrProduct, 'img')}" alt=""></a></td>
                                            <td class="product_name"><a href="#">${getPropertiesNameById(item.product_id, data.arrProduct, 'product_name')}</a></td>
                                            <td class="product_name"><a href="#">${getPropertiesNameById(item.size_id, data.size, 'size')}</a></td>
<td class="product_name"><a href="#">${getPropertiesNameById(item.color_id, data.color, 'color')}</a></td>
                                            <td class="product-price">${
                        formatCurrency(getPropertiesNameById(item.product_id, data.arrProduct, 'price'))
                    }
                                            </td>
                                            <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="${item.quantity}" type="number"></td>
                                            <td class="product_total">${
                        formatCurrency(getPropertiesNameById(item.product_id, data.arrProduct, 'price'))
                    }
                                            </td>
                                        </tr>
                                    `)}

                                    </tbody>
                    </table>
                `);
                }

                function formatCurrency(price) {
                    const formatter = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND',
                    });

                    return formatter.format(price);
                }


                function getPropertiesNameById(propertiesId, propertiesArray, propertiesName) {
                    // dùng hàm find để lấy ra obj hiện tại dựa trên hàm map ở trên và gán obj obj đó vào properties
                    const properties = propertiesArray.find(item => item.id == propertiesId);
                    // console.log(properties);
                    // và cuối cùng chỉ việc trả về tên thuộc tính theo id đã so sánh thôi :v
                    if (propertiesName === 'color') {
                        return properties ? properties.color_value : 'Unknown';
                    } else if (propertiesName === 'size') {
                        return properties ? properties.size_value : 'Unknown';
                    } else if (propertiesName === 'product_name') {
                        return properties ? properties.product_name : 'Unknown';
                    } else if (propertiesName === 'quantity') {
                        return properties ? properties.quantity : 'Unknown';
                    } else if (propertiesName === 'price') {
                        let cartSession = data.mycart.data;
                        if (properties) {
                            for (let i = 0; i < cartSession.length; i++) {
                                if (+cartSession[i].product_id === properties.id) {
                                    for (let j = 0; j < properties.variations.length; j++) {
                                        if (properties.variations[j].color_id === +cartSession[i].color_id && properties.variations[j].size_id === +cartSession[i].size_id) {
// console.log(properties.variations[j].price)
                                            return properties.variations[j].price;
                                        }
                                    }
                                }
                            }
                        }
                    } else if (propertiesName === 'img') {
                        let cartSession = data.mycart.data;
                        if (properties) {

                            for (let i = 0; i < cartSession.length; i++) {
                                // so sánh từng phần tử của data trên session với properties(obj product)
                                if (+cartSession[i].product_id === properties.id) {
                                    // console.log(properties.images[0].url);
                                    return properties.images[0].url;
                                }
                            }
                        }
                    }

                }
            },
            error: function () {
                console.log('error')
            }
        });
    }

    loadTable();

    $('.wrp_mini_cart').click(function () {
        loadMiniCart();
    });

    function loadMiniCart() {
        $.ajax({
            url: urlMinicart,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('.mini_cart_item').empty();
                $('.mini_cart_item').append(`
                   <div class="cart_close">
                        <div class="cart_text">
                            <h3>cart</h3>
                        </div>
                    </div>

            ${data.mycart.data.map(item => `
            <div class="cart_item">
                <div class="cart_img">
                    <a href="#"><img src="../storage/${getPropertiesNameById(item.product_id, data.arrProduct, 'img')}" alt="anh"></a>
                </div>
                <div class="cart_info">
                    <a href="#">${getPropertiesNameById(item.product_id, data.arrProduct, 'product_name')}</a>

                    <span class="quantity">${item.quantity}</span>
                    <span class="price_cart">${
                    formatCurrency(getPropertiesNameById(item.product_id, data.arrProduct, 'price'))
                }</span>

                </div>

            </div>
            `)}
<!--            <div class="mini_cart_table">-->
<!--                <div class="cart_total">-->
<!--                    <span>Sub total:</span>-->
<!--                    <span class="price">$138.00</span>-->
<!--                </div>-->

<!--            </div>-->
                `);


                // function totalPrice(){
//     let countPrice = 0;
                //     // đầu tiên phải lấy ra từng giá trị trong mảng sản phẩm trên session
                //     for (let i = 0; i < data.mycart.data.length; i++){
                //         // tiếp tục ta phải lặp ra từng obj product
                //         for (let j = 0; j < data.arrProduct.length; j++){
                //             // tại product thứ j ta so sánh id của nó với id của obj session thứ i
                //             if (+data.mycart.data[i].product_id === data.arrProduct[j].id){
                //                 // nếu nó bằng nhau tức là ta đã lấy ra được cái sản phẩm thứ j trong mảng product dựa theo id_product trên session
                //                 // bởi vì mỗi sản phẩm có nhiều biến thể <=> variations nó sẽ là 1 mảng chứa các biến thể của sản phẩm đó
                //                 // nên ta phải tiếp tục lặp ra để so sánh từng id_product trong biến thể với id_product trên sesssion thứ i
                //                 for (let o = 0; o < data.arrProduct[j].variations.length; o++){
                //                     if (+data.mycart.data[i].product_id === data.arrProduct[j].variations[o].product_id && +data.mycart.data[i].size_id === data.arrProduct[j].variations[o].size_id && +data.mycart.data[i].color_id === data.arrProduct[j].variations[o].color_id){
                //                         // và khi đã lấy đúng ra giá của sản phâm có biến thể thứ o thì ta cộng vào countPrice
                //                         // và tiếp tục vòng lặp cho đến khi nào hêt sản phẩm trên session thôi.... game là dễ :))
                //                         console.log(+data.mycart.data[i].quantity)
                //                         countPrice += +data.mycart.data[i].quantity * data.arrProduct[j].variations[o].price;
                //                     }
                //                 }
                //             }
                //         }
                //     }
                //     return countPrice;
                // }

                function formatCurrency(price) {
                    const formatter = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND',
                    });

                    return formatter.format(price);
                }

                function getPropertiesNameById(propertiesId, propertiesArray, propertiesName) {
                    // dùng hàm find để lấy ra obj hiện tại dựa trên hàm map ở trên và gán obj obj đó vào properties
                    const properties = propertiesArray.find(item => item.id == propertiesId);
                    // console.log(properties);
                    // và cuối cùng chỉ việc trả về tên thuộc tính theo id đã so sánh thôi :v
                    if (propertiesName === 'product_name') {
                        return properties ? properties.product_name : 'Unknown';
                    } else if (propertiesName === 'quantity') {
                        return properties ? properties.quantity : 'Unknown';
                    } else if (propertiesName === 'price') {
                        let cartSession = data.mycart.data;
                        if (properties) {
                            for (let i = 0; i < cartSession.length; i++) {
                                if (+cartSession[i].product_id === properties.id) {
                                    for (let j = 0; j < properties.variations.length; j++) {
                                        if (properties.variations[j].color_id === +cartSession[i].color_id && properties.variations[j].size_id === +cartSession[i].size_id) {
                                            // console.log(properties.variations[j].price)
                                            return properties.variations[j].price;
                                        }
                                    }
                                }
                            }
                        }
                    } else if (propertiesName === 'img') {
                        let cartSession = data.mycart.data;
                        if (properties) {

                            for (let i = 0; i < cartSession.length; i++) {
                                // so sánh từng phần tử của data trên session với properties(obj product)
                                if (+cartSession[i].product_id === properties.id) {
                                    console.log(properties.images[0].url);
                                    return properties.images[0].url;
                                }
                            }
                        }
                    }

                }
            },
            error: function () {
                console.log('lỗi mất rồi ^^')
            }
        });
    }
});
