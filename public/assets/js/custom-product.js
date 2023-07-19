$('document').ready(function () {
    var csrf_token = $('meta[name="csrf-token"]').attr('content')
    var dataTable;
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
                        { "data": "id" },
                        { "data": "product_name" },
                        { "data": "description" },
                        { "data": "slug" },
                        { "data": "brand_id" },
                        { "data": '' },
                    ],
                    "columnDefs": [
                        {
                            "targets": -1, // Cột cuối cùng (brand_id)
                            "data": null,
                            "defaultContent": "" +
                                "<button class='btn btn-blue btn-update'>Cập nhật</button>  " +
                                "   <button class='btn btn-danger btn-delete'>Xóa</button>"
                        }
                    ]
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

    $(".brand").select2({
        minimumResultsForSearch: -1, // Ẩn ô tìm kiếm
    });

// ajax thêm mới color và size cho sản phẩm
    let arrayColor = [];
    let arraySize = [];
    let btn = $('#variable').slideUp();
    let table = $('#table-variable').slideUp();
    let tableMain = $('.main-tab');
    let btnTable = $('.btn-table').slideUp();
    let count = 0;
    $(document).on('select2:selecting', '.select2', function (e) {
        var selectedOption = e.params.args.data;
        var url = $(this).data('route');
        $('#variable').slideDown();
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
                            var option = $('select[name="color"]').find('option[value="'+newValue+'"]').replaceWith(newOption);
                        } else if (response.name === 'size') {
                            var option = $('select[name="sizes"]').find('option[value="'+newValue+'"]').replaceWith(newOption);
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
    btn.on('click', function () {
        if (status % 2 === 0) {
            count = 0;
            btnTable.slideDown();
            table.slideDown();
            btn.text(`Rollback`);
            // lấy ra mảng các thuộc tính được chọn để tiến hành tạo ra biến thể
            arrayColor = $('select[name="color"]').val();
            arraySize = $('select[name="sizes"]').val();
            console.log(arrayColor)
            console.log(arraySize)
            $.each(arrayColor, function (index, color) {
                $.each(arraySize, function (index, size) {
                    count++;
                    tableMain.append(`
                <tr>
                   <th scope="row">${count}</th>
                   <td><input class="form-control" name="color-variable-${count}" value="${color}" tabindex="0" type="text" readonly="readonly"></td>
                   <td><input class="form-control" name="size-variable-${count}" value="${size}" tabindex="0" type="text" readonly="readonly"></td>
                   <td><input class="form-control quantity-input" name="quantity-variable-${count}" value="" tabindex="0" type="number" min="0"></td>
                   <td><input class="form-control price-input" name="price-variable-${count}" value="" tabindex="0" type="number" min="0"></td>
                </tr>
                `);
                })
            })
        } else {
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
        var imageContainer = $('.selected-images');
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

    $('#form-add').on('submit', function (e) {
        e.preventDefault();
        var action = $(this).attr('data-route');
        var formData = new FormData($('#form-add')[0]); // Tạo đối tượng FormData từ biểu mẫu
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
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    // Tùy chỉnh giao diện nút bằng CSS
});
