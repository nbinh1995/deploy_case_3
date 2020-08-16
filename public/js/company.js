var company = company || {};

company.showErrors = function (errors) {
    if (errors['logo'] != null) {
        $('#err-logo').text(errors['logo'][0]);
    }
    if (errors['cover_photo'] != null) {
        $('#err-photo').text(errors['cover_photo'][0]);
    }
    if (errors['c_name'] != null) {
        $('#err-name').text(errors['c_name'][0]);
    }
    if (errors['address'] != null) {
        $('#err-address').text(errors['address'][0]);
    }
    if (errors['phone'] != null) {
        $('#err-phone').text(errors['phone'][0]);
    }
    if (errors['website'] != null) {
        $('#err-website').text(errors['website'][0]);
    }
    if (errors['description'] != null) {
        $('#err-desc').text(errors['description'][0]);
    }
}

company.update = function (ele) {
    let data = new FormData(ele);
    let url = $(ele).attr('action');
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data['code'] == 200) {
                $('#updateModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#image-company').html(data['image_company']);
                $('#menu1').html(data['info_company']);
                $('#job_company').html(data['job_company']);
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Cập Nhật Thông Tin Thành Công!");
            }
            if (data['code'] == 422) {
                company.showErrors(data['errors'])
            }
        }
    });
}

company.uploadLogo = function (element) {
    let img = element.files[0];
    let reader = new FileReader();
    reader.onloadend = function () {
        $("#imgLogo").attr("src", reader.result);
    }
    reader.readAsDataURL(img);
}

company.uploadCover = function (element) {
    let img = element.files[0];
    let reader = new FileReader();
    reader.onloadend = function () {
        $("#imgCover").attr("src", reader.result);
    }

    reader.readAsDataURL(img);
}
let path = location.origin;

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


