$('document').ready(function () {
    var csrf_token = $('meta[name="csrf-token"]').attr('content')
    $('#product__admin').DataTable({
        "pagingType": "numbers", // Loại phân trang
    });
    $('.select2').select2({
        tags: true,
        multiple: true,
    });

    $(".brand").select2({
        minimumResultsForSearch: -1, // Ẩn ô tìm kiếm
    });

    // sử lý tạo ra các biến thể

    $('select[name="size"]').on('change', function () {
        console.log($('select[name="size"]').val());
    });

// ajax thêm mới color và size cho sản phẩm
    let arrayColor = [];
    let arraySize = [];
    $(document).on('select2:selecting','.select2', function (e) {
        var selectedOption = e.params.args.data;
        var url = $(this).data('route');
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
                        if(response.name === 'color'){
                            var option = $('select[name="color"]').find('option').last().val(response.id);
                        }else if(response.name=== 'size'){
                            var option = $('select[name="sizes"]').find('option').last().val(response.id);
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
    $('#variable').on('click', function () {
        // lấy ra mảng các thuộc tính được chọn để tiến hành tạo ra biến thể
        arrayColor = $('select[name="color"]').val();
        arraySize = $('select[name="sizes"]').val();
    });
});
