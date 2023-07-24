$('document').ready(function () {
    var csrf_token = $('meta[name="csrf-token"]').attr('content')
    var dataTable;
    var actionDelete = 'product/delete/';
    var actionUpdate = 'product/edit/'
    var idUpdate;
    var methodAction = $('input[name="actionMethod"]');
    var formAdd = $('#form-add');

    // ajax load dữ liệu
    function loadTable() {
        var url = $('.table-main').attr('data-route');
        $.ajax({
            url: url,
            method: "GET",
            success: function (data) {
                if (dataTable) {
                    dataTable.destroy();
                }
                dataTable = $('#product__admin').DataTable({
                    'pagingType': 'numbers',
                    "data": data.products,
                    "columns": [
                        {"data": "id"},
                        {"data": "product_name"},
                        {"data": "description"},
                        {"data": "slug"},
                        {"data": "brand.name_brand"},
                        {"data": ''},
                    ],
                    "columnDefs": [
                        {
                            "targets": -1, // Cột cuối cùng (brand_id)
                            "data": null,
                            "render": function (data, type, row, meta) {
                                var productId = row.id; // Lấy ID của sản phẩm từ dữ liệu hàng (data)
                                return "" +
                                    `<button class='btn btn-blue btn-update' type='button' data-id='${productId}'>Cập nhật</button>  ` +
                                    `<button class='btn btn-danger btn-delete' data-id='${productId}'>Xóa</button>`;
                            }
                        }
                    ]
                });
                $(document).off('click', '.btn-delete');
                $(document).off('click', '.btn-update');
                $(document).on('click', '.btn-delete', function () {
                    if (confirm('Bạn có chắc chắn xóa không.')) {
                        deleteProduct($(this).data('id'));
                    }
                });
                $(document).on('click', '.btn-update', function (e) {
                    e.preventDefault();
                    showDetail($(this).data('id'));
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    loadTable();


    $('.select2').select2({
        tags: true,
        multiple: true,
    });

    let brand = $(".brand");
    brand.select2({
        minimumResultsForSearch: -1, // Ẩn ô tìm kiếm
        multiple: false,
    });

    let btnShowModal = $('.btn-show-modal');
    let btnCloseModal = $('.btn-cancel');
    let modal = $('.main-modal');
    let imageContainer = $('.selected-images');
    let table = $('#table-variable').slideUp();
    let btn = $('#variable').slideUp();

    modal.hide();

    function showModal(action = true) {
        if (action) {
            modal.show();
        } else {
            $(".select2").val(null).trigger("change");
            formAdd[0].reset();
            table.slideDown();
            btn.slideUp();
            modal.hide();
            imageContainer.html('');
            ShowErrors([], false);
            methodAction.val('');
        }
    }

    btnCloseModal.on('click', function () {
        showModal(false);
    });
    btnShowModal.on('click', showModal);


    // ajax thêm mới color và size cho sản phẩm
    let arrayColor = [];
    let arraySize = [];
    let color = $('select[name="color"]');
    let size = $('select[name="sizes"]');
    let tableMain = $('.main-tab');
    let btnTable = $('.btn-table').slideUp();
    let count = 0;
    let statusCheck = $('#statusCheck'); // kiểm tra tạo biến thể chưa
    statusCheck.slideUp();// ẩn ô input
    $(document).on('select2:selecting', '.select2', function (e) {
        var selectedOption = e.params.args.data;
        var url = $(this).data('route');
        btn.slideDown();
        $('#variable-box').slideDown();
        if (!selectedOption.hasOwnProperty('element')) {
            // Đây là một giá trị mới được nhập vào ô input
            var newValue = selectedOption.text;
            if (newValue !== null && newValue.trim() !== '') {
                // Thêm giá trị mới vào cơ sở dữ liệu hoặc xử lý theo yêu cầu
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: csrf_token,
                        value: newValue,
                    },
                    success: function (response) {
                        // gán giá trị value bằng với id của bạn gi vừa thêm vào
                        var newOption = new Option(newValue, response.id, true, true);
                        console.log(newOption);
                        if (response.name === 'color') {
                            var option = $('select[name="color"]').find('option[value="' + newValue + '"]').replaceWith(newOption);
                        } else if (response.name === 'size') {
                            var option = $('select[name="sizes"]').find('option[value="' + newValue + '"]').replaceWith(newOption);
                        }
                    },
                    error: function (error) {
                        // Xử lý lỗi (nếu cần)
                    }
                });
            }
        }
    });

    // Tạo ra biến thể
    let status = 0;
    btnCloseModal.add(btn).on('click', function () {
        if (status % 2 === 0 && $(this).attr('id') === 'variable') {
            statusCheck.prop('checked', true);
            count = 0;
            btnTable.slideDown();
            table.slideDown();
            btn.text(`Rollback`);
            // lấy ra mảng các thuộc tính được chọn để tiến hành tạo ra biến thể
            arrayColor = color.select2('data');
            arraySize = size.select2('data');
            $.each(arrayColor, function (index, color) {
                $.each(arraySize, function (index, size) {
                    count++;
                    tableMain.append(`
                <tr>
                   <th scope="row">${count}</th>
                   <td>
                       <input hidden name="color-variable-${count}" value="${color.id}" tabindex="0" type="text">
                       <input class="form-control" value="${color.text}" tabindex="0" type="text" readonly="readonly">
                   </td>

                   <td>
                       <input hidden name="size-variable-${count}" value="${size.id}"type="text">
                       <input class="form-control" value="${size.text}" tabindex="0" type="text" readonly="readonly">
                   </td>

                   <td>
                        <input class="form-control quantity-input default-value" name="quantity-variable-${count}" value="0" tabindex="0" type="number" min="0">
                   </td>
                   <td>
                        <input class="form-control price-input default-value"  name="price-variable-${count}" value="0" tabindex="0" type="number" min="0">
                   </td>
                </tr>
                `);
                    $('.default-value').on("focus", function () {
                        // Xóa số 0 khi người dùng trỏ chuột vào ô input
                        if ($(this).val() === "0") {
                            $(this).val("");
                        }
                        console.log('1');
                    });
                    $(".default-value").on("blur", function () {
                        // Kiểm tra nếu ô input trống
                        if ($(this).val() === "") {
                            $(this).val(0); // Đặt giá trị mặc định là 0
                        }
                    });
                })
            })

        } else {
            statusCheck.prop('checked', false);
            btn.text(`Tạo ra biến thể`);
            table.slideUp();
            btnTable.slideUp();
            tableMain.html('');
        }
        status++;
    });

    // nhập giá
    let btnPrice = $('#btn-price');
    let btnQuantity = $('#btn-quantity');
    btnPrice.on('click', addValue);
    btnQuantity.on('click', addValue);

    function addValue() {
        let id = $(this).attr('id');
        if (id === 'btn-price') {
            let value = prompt('Nhập giá chuẩn.');
            $.each($('.price-input'), function (index, item) {
                $(item).val(value)
            });
        } else {
            let value = prompt('Nhập số lượng.');
            $.each($('.quantity-input'), function (index, item) {
                $(item).val(value)
            });
        }
    }

// code hiển thị ảnh
    var fileInput = $('#product-image');
    fileInput.slideUp();
    fileInput.on('change', function () {
        var fileList = this.files;
        imageContainer.html('');
        for (var i = 0; i < fileList.length; i++) {
            var file = fileList[i];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                var img = `
                    <div class="item-image">
                        <img src="${e.target.result}" />
                    </div>
                `;
                imageContainer.append(img);
            }
        }
    });
    // ajax save dữ liệu
    formAdd.on('submit', function (e) {
        e.preventDefault();
        if (methodAction.val() === 'update') {
            updateProduct();
        } else {
            addProduct();
        }
    });

    function addProduct() {
        var action = formAdd.attr('data-route');
        var formData = new FormData(formAdd[0]); // Tạo đối tượng FormData từ biểu mẫu
        var countVariable = $('th[scope="row"]').length;
        formData.append('lengthFor', countVariable) // số lượng biến thể và cho vào đối tượng FormData để gửi đi
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            processData: false, // Set false để ngăn jQuery xử lý dữ liệu FormData
            contentType: false, // Set false để không thiết lập Header 'Content-Type'
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            success: function (response) {
                loadTable();
                console.log(response.message);
                toastr["success"]("Thêm mới thành công!");
                showModal(false);
            },
            error: function (error) {
                console.log(error.responseJSON.errors);
                ShowErrors(error.responseJSON.errors);
            }
        });
    }

    // xóa sản phẩm sử dụng ajax
    function deleteProduct(id) {
        $.ajax({
            url: actionDelete + id,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            success: function (data) {
                loadTable();
                toastr["success"]("Xóa thành công!");
                console.log(data.message);
            },

            error: function (error) {
                console.log(error)
            }
        })
    }


    // hiển thị message lỗi dữ liệu lỗi được gửi sang từ form request của laravel
    function ShowErrors(data, status = true) {
        var showErrorItem = $('.show-error');
        if (status) {
            $.each(showErrorItem, function (indexHtml, itemHtml) {
                $.each(data, function (index, item) {
                    if ($(itemHtml).attr('data-name') === index) {
                        $(itemHtml).text(item);
                    }
                });
            });
        } else {
            $.each(showErrorItem, function (indexHtml, itemHtml) {
                $(itemHtml).text('');
            });
        }
    }

    // ajax show dữ liệu khi bấm cập nhật
    function showDetail(id) {
        idUpdate = id;
        showModal(true)
        methodAction.val('update');
        $.ajax({
            url: actionUpdate + id,
            method: 'GET',
            data: {
                _token: csrf_token,
            },
            success: function (data) {
                console.log(data.data);
                showModal();
                showDataForm(data.data);
            },
            error: function (error) {
                console.log(error)
            }
        })
    }

    function showDataForm(data) {
        $('input[name="productName"]').val(data.product_name);
        $('textarea[name="description"]').val(data.description);
        $('select[name="brand"]').val(data.brand_id).trigger('change');
        var imgArray = data.images;
        var color = $('select[name="color"] option');
        var size = $('select[name="sizes"] option');
        var variationsArray = data.variations;
        var arraySize = [];
        var arrayColor = [];
        $.each(variationsArray, function (indexVariations, itemVariations) {
            arrayColor.push(itemVariations.color_id);
            arraySize.push(itemVariations.size_id);
        });
        arraySize = [...new Set(arraySize)];
        arrayColor = [...new Set(arrayColor)];
        $.each(arrayColor, function (indexColor, itemColor) {
            $.each(color, function (index, item) {
                if (itemColor == $(item).val()) {
                    $(item).prop('selected', true);
                    $(item).trigger('change');
                }
            });
        });
        $.each(arraySize, function (indexColor, itemSize) {
            $.each(size, function (index, item) {
                if (itemSize == $(item).val()) {
                    $(item).prop('selected', true);
                    $(item).trigger('change');
                }
            });
        });
        $.each(imgArray, function (index,item) {
            var img = `
                    <div class="item-image">
                        <img src="/storage/${item.url}" />
                    </div>
                `;
            imageContainer.append(img);
        });


        // table.slideDown();
        // btn.slideUp();

    }

    // ajax update sản phẩm
    function updateProduct() {
        var formData = new FormData(formAdd[0]); // Tạo đối tượng FormData từ biểu mẫu
        var countVariable = $('th[scope="row"]').length;
        formData.append('lengthFor', countVariable) // số lượng biến thể và cho vào đối tượng FormData để gửi đi
        $.ajax({
            url: actionUpdate + idUpdate,
            method: 'POST',
            data: formData,
            processData: false, // Set false để ngăn jQuery xử lý dữ liệu FormData
            contentType: false, // Set false để không thiết lập Header 'Content-Type'
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            success: function (response) {
                // loadTable();
                console.log(response.data);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});
