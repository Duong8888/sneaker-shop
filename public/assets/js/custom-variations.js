$(document).ready(function () {
    let modal = $('.modal.fade.show');
    let btnCancel = $('.btn-cancel');
    let btnAdd = $('.btn-show-modal');
    let form = $('.form.add-color');
    let tableColor = $('.table-data');
    let actionAdd = form.data('route');
    let actionTable = tableColor.data('route');
    let actionDelete = actionTable+"/delete/";
    let actionUpdate = actionTable+"/edit/";
    let idUpdate;
    let methodAction = $('input[name="actionMethod"]');
    let _token = $('meta[name="csrf-token"]').attr('content')
    modal.css({
        'display': 'block',
        'background': 'rgba(0,0,0,0.5)'
    });
    modal.hide();

    function showModal(status = true) {
        if (status) {
            modal.show();
        } else {
            modal.hide();
            methodAction.val('');
            ShowErrors([], false);
        }
    }

    btnAdd.on('click', showModal);
    btnCancel.on('click', function () {
        showModal(false);
    });

    function loadTable() {
        $.ajax({
            url: actionTable,
            method: "GET",
            success: function (response) {
                console.log(response.data);
                tableColor.html('');
                $.each(response.data, function (index, value) {
                    tableColor.append(`
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${Object.values(value)[1]}</td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                   <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                   <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/General/Settings-2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#8950fc"/>
                                                        </g>
                                                        </svg>
                                                    </span>
                                                   </a>
                                                   <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item btn-update" href="#" data-id='${value.id}'><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Cập nhật</a>
                                                        <a class="dropdown-item btn-delete" href="#" data-id='${value.id}'><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Xóa</a>
                                                  </div>
                                            </div>
                                        </td>
                                    </tr>
                    `);
                });
                $('.btn-delete').on('click', function () {
                    if (confirm('Bạn có chắc chắn xóa không.')) {
                        deleteItem($(this).data('id'));
                    }
                });
                $('.btn-update').on('click', function () {
                    showFormData($(this).data('id'));
                });
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    loadTable();

    // add new color
    form.on('submit', function (e) {
        e.preventDefault();
        if (methodAction.val() === 'update') {
            updateData();
        } else {
            addData();
        }
    });

    function addData() {
        var data = $('input[name="data"]').val();
        console.log(actionAdd);
        $.ajax({
            url: actionAdd,
            method: "POST",
            data: {
                'data': data,
                '_token': _token,
            },
            success: function (response) {
                showModal(false);
                loadTable();
                $('input[name="data"]').val('');
                toastr["success"](response.message);
                console.log(response);
            },
            error: function (error) {
                ShowErrors(error.responseJSON.errors);
            }
        });
    }

    function deleteItem(id) {
        $.ajax({
            url: actionDelete + id,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': _token
            },
            success: function (response) {
                loadTable();
                toastr["success"](response.message);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function showFormData(id) {
        idUpdate = id;
        methodAction.val('update');
        $.ajax({
            url: actionUpdate + id,
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': _token
            },
            success: function (response) {
                showModal(true);
                $('input[name="data"]').val(Object.values(response.data)[1]);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function updateData() {
        var data = $('input[name="data"]').val();
        $.ajax({
            url: actionUpdate + idUpdate,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data: {
                'data': data,
                '_token': _token,
            },
            success: function (response) {
                loadTable();
                showModal(false);
                toastr["success"](response.message);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


    function ShowErrors(data, action = true) {
        if (action) {
            $('.show-error').html(data.data);
        } else {
            $('.show-error').html('');
        }
    }
});
