var company = company || {};

company.showCompanies = function () {
    let url = $('#companies-noact').data('url');
    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            let table = $('#companies-noact').DataTable();
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
                    `<button class="btn btn-danger" onclick="company.active(${v.id})">Active</button>`
                ]).draw();
            });
        }
    });
}

company.active = function (id) {
    let path = location.origin;
    let token = $("meta[name='csrf-token']").attr("content");
    let url = path + `/dashboard/${id}/companies_noAct`;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            '_token': token,
            '_method': 'PATCH'
        },
        success: function (data) {
            if (data['code'] == 200) {
                company.showCompanies();
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Thao tac Thành Công!");
            }
        }
    });
}

company.init = function () {
    company.showCompanies();

}

$(document).ready(function () {
    company.init();
});


