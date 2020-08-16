var user = user || {};

let path = location.origin;

user.showCompanies = function () {
    let url = $('#users-companies').data('url');
    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success: function (data) {

            let table = $('#users-companies').DataTable();
            table
                .clear()
                .draw();
            $.each(data.companies, function (i, v) {
                table.row.add([
                    `${i + 1}`,
                    `<img src="${v.logo}" alt="" style="width:45px">`,
                    `${v.c_name ?? '...Chưa Cập Nhật...'}`,
                    `${v.address ?? '...Chưa Cập Nhật...'}`,
                    `${v.phone ?? '...Chưa Cập Nhật...'}`,
                    `${v.website ?? '...Chưa Cập Nhật...'}`,
                    `${v.hot == 0 ? 'Binh thuong' : 'Hot'}`,
                    `<button class="btn btn-primary" onclick="user.hotCompany(${v.id})">isHot</button>
                    <button class="btn btn-danger" onclick="user.destroyCompanies(${v.id})">Xóa</button>`
                ]).draw();
            });
        }
    });
}

user.showCandidates = function () {
    let url = $('#users-candidates').data('url');
    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success: function (data) {
            let table = $('#users-candidates').DataTable();
            table
                .clear()
                .draw();
            $.each(data.candidates, function (i, v) {
                table.row.add([
                    `${i + 1}`,
                    `<img src="${v.avatar ?? 'http://placehold.it/150x150'}" alt="" style="width:45px">`,
                    `${v.name ?? '...Chưa Cập Nhật...'}`,
                    `${v.gender ?? '...Chưa Cập Nhật...'}`,
                    `${v.birth ?? '...Chưa Cập Nhật...'}`,
                    `${v.address ?? '...Chưa Cập Nhật...'}`,
                    `<button class="btn btn-danger" onclick="user.destroyCandidates(${v.id})">Xóa</button>`
                ]).draw();
            });
        }
    });
}

user.hotCompany = function (id) {
    let token = $("meta[name='csrf-token']").attr("content");
    let url = path + `/dashboard/${id}/users_companies`;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            '_token': token,
            '_method': 'PATCH'
        },
        success: function (data) {
            if (data['code'] == 200) {
                user.showCompanies();
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Thao tac Thành Công!");
            }
        }
    });
}

user.destroyCompanies = function (id) {
    let token = $("meta[name='csrf-token']").attr("content")
    let url = path + `/dashboard/${id}/users_companies`
    bootbox.confirm({
        message: "Bạn có chắc chắn?",
        buttons: {
            confirm: {
                label: 'Có',
                className: 'btn-success'
            },
            cancel: {
                label: 'Không',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        '_token': token
                    },
                    success: function (data) {
                        if (data['code'] == 200) {
                            user.showCompanies();
                            toastr.options = { "positionClass": "toast-bottom-right" };
                            toastr["success"]("Xóa Thành Công!");
                        }
                    }
                });
            }
        }
    });
}

user.destroyCandidates = function (id) {
    let token = $("meta[name='csrf-token']").attr("content");
    let url = path + `/dashboard/${id}/users_candidates`;
    bootbox.confirm({
        message: "Bạn có chắc chắn?",
        buttons: {
            confirm: {
                label: 'Có',
                className: 'btn-success'
            },
            cancel: {
                label: 'Không',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        '_token': token
                    },
                    success: function (data) {
                        if (data['code'] == 200) {
                            user.showCandidates();
                            toastr.options = { "positionClass": "toast-bottom-right" };
                            toastr["success"]("Xóa Thành Công!");
                        }
                    }
                });
            }
        }
    });
}

user.init = function () {
    user.showCompanies();
    user.showCandidates();

}

$(document).ready(function () {
    user.init();
});


