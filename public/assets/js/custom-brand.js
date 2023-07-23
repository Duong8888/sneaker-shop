
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

    $('.delete_brand').click(function (){
        let brandID = $(this).data("id");
        console.log(brandID);

        // gửi yêu cầu xóa sản phẩm bằng ajax
        $.ajax({
            url: '/brands/delete/' + brandID,
            type: 'DELETE',
            dataType: 'json',
            // sử dụng hàm beforeSend của jQuery để thiết lập tiêu đề của yêu cầu.
            beforeSend: function(xhr) {
                // Thiết lập tiêu đề X-CSRF-TOKEN với giá trị token CSRF
                xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);
            },
            success: function (data) {
                $('tr[data-id="' + brandID + '"]').remove();
                console.log(data);
            }
        });
    })
});
