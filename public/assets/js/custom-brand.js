
$(document).ready(function (){
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    // hiện ảnh khi sửa
    function readURL(input, selector) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $(selector).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#cmt_truoc").change(function () {
        readURL(this, '#mat_truoc_preview');
    });
    //------------------------------------------------

    // loadAll
    function loadAll(){
        // gửi yêu cầu ajax để lấy danh sách san phẩm
        $.ajax({
            url: '/brands/list',
            method: 'GET',
            dataType: 'json',
            beforeSend: function(xhr) {
                // Thiết lập tiêu đề X-CSRF-TOKEN với giá trị token CSRF
                xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);
            },
            success: function (data){
                console.log(data);
                // sử dụng empty() để làm sạch dữ liệu cũ trong id=(brandList) trước khi hiển thị dữ liệu mới
                $('#brandList').empty();
                $.each(data,function (index, item){
                    $('#brandList').append(`
                        <tr class="odd">
                            <td>${item.id}</td>
                            <td>${item.name_brand}</td>
                            <td>
                                <img src="/storage/${item.image}" width="100" height="100" style="border-radius: 50%" alt="">
                            </td>
                            <td>${item.slug}</td>
                            <td>

                                <button class="btn btn-danger delete_brand" data-id="${item.id}">Delete</button>
                                <button class="btn btn-primary update_brand" data-id="${item.id}">Update</button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function (){
                console.log('error')
            }
        });
    }
    loadAll();


    // ---------------------------------------------------
    $(document).on('click', '.delete_brand', function () {
        if (confirm('Bạn có chắc chắn xóa không.')) {
            Delete($(this).data('id'));
        }
    });




    // --------------------------------------------------------
    // chỉ chuyển hướng đến view update thôi vì logic dùng php mất rồi :))))
    $(document).on('click','.update_brand',function (){
        let brandID = $(this).data("id");
        window.location.href = "/brands/edit/" + brandID;
    })
    // --------------------------------------------------------
    // delete
    function Delete(id){
        // gửi yêu cầu xóa sản phẩm bằng ajax
        $.ajax({
            url: '/brands/delete/' + id,
            type: 'DELETE',
            dataType: 'json',
            // sử dụng hàm beforeSend của jQuery để thiết lập tiêu đề của yêu cầu.
            beforeSend: function(xhr) {
                // Thiết lập tiêu đề X-CSRF-TOKEN với giá trị token CSRF
                xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);
            },
            success: function (data) {
                $('tr[data-id="' + id + '"]').remove();
                loadAll();
                toastr["success"]("Dữ liệu đã được đưa vào thùng rác! bạn có thể khôi phục tại đó!")
            },
            error: function (){
                console.log('Có lỗi sảy ra');
            }
        });
    }
});
