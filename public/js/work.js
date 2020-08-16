var work = work || {};

work.showErrors = function (errors) {
    if (errors['category_id'] != null) {
        $('#err-category-id').text(errors['category_id'][0]);
    }
    if (errors['type'] != null) {
        $('#err-type').text(errors['type'][0]);
    }
    if (errors['last_date'] != null) {
        $('#err-last-date').text(errors['last_date'][0]);
    }
    if (errors['title'] != null) {
        $('#err-title').text(errors['title'][0]);
    }
    if (errors['position'] != null) {
        $('#err-position').text(errors['position'][0]);
    }
    if (errors['description'] != null) {
        $('#err-desc-job').text(errors['description'][0]);
    }
    if (errors['benefit'] != null) {
        $('#err-benefit').text(errors['benefit'][0]);
    }
    if (errors['require'] != null) {
        $('#err-require').text(errors['require'][0]);
    }
    if (errors['salary_min'] != null) {
        $('#err-salary-min').text(errors['salary_min'][0]);
    }
    if (errors['salary_max'] != null) {
        $('#err-salary-max').text(errors['salary_max'][0]);
    }
    if (errors['contact_name'] != null) {
        $('#err-contact-name').text(errors['contact_name'][0]);
    }
    if (errors['contact_phone'] != null) {
        $('#err-contact-phone').text(errors['contact_phone'][0]);
    }
    if (errors['contact_email'] != null) {
        $('#err-contact-email').text(errors['contact_email'][0]);
    }
}
work.reset = function () {
    $('#WorksModal').find("select[name='category_id']").val('');
    $('#WorksModal').find("select[name='type']").val('');
    $('#WorksModal').find("input[name='last_date']").val('');
    $('#WorksModal').find("input[name='title']").val('');
    $('#WorksModal').find("input[name='position']").val('');
    $('#WorksModal').find("textarea[name='description']").text('');
    $('#WorksModal').find("textarea[name='benefit']").text('');
    $('#WorksModal').find("textarea[name='require']").text('');
    $('#WorksModal').find("input[name='salary_min']").val('');
    $('#WorksModal').find("input[name='salary_max']").val('');
    $('#WorksModal').find("input[name='status']").val('');
    $('#WorksModal').find("input[name='contact_name']").val('');
    $('#WorksModal').find("input[name='contact_phone']").val('');
    $('#WorksModal').find("input[name='contact_email']").val('');
}

work.create = function (ele) {
    let urln = $(ele).data('urln');
    let active = $(ele).data('urln');
    if (active == 'ACTIVE') {
        this.reset();
        $('#WorksModal').find('form').attr('action', urln);
        $('#WorksModal').find('h5').text('Đăng Tuyển Dụng');
        $('#WorksModal').find("input[name='_method']").prop("disabled", true)
        $('#WorksModal').modal('show');
    } else {
        toastr.options = { "positionClass": "toast-bottom-right" };
        toastr["warning"]("Bạn chưa được admin cấp quyền!");
    }
}

work.store = function (ele) {
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
                $('#WorksModal').modal('hide');
                $('#count_work').text(data['count']);
                $('#job_company').html(data['job_company']);
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Thêm Việc Làm Thành Công!");
            }
            if (data['code'] == 422) {
                work.showErrors(data['errors'])
            }
        }
    });
}

work.edit = function (ele) {
    let url = $(ele).data('url');
    let urln = $(ele).data('urln');
    this.reset();
    $('#WorksModal').find('form').attr('action', urln);
    $('#WorksModal').find('h5').text('Chỉnh Sửa Tuyển Dụng');
    $('#WorksModal').find("input[name='_method']").prop("disabled", false)
    $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
            if (data.code == 200) {
                console.log(data.work);

                $('#WorksModal').find("select[name='category_id']").val(data.work.category_id);
                $('#WorksModal').find("select[name='type']").val(data.work.type);
                $('#WorksModal').find("input[name='last_date']").val(data.work.last_date);
                $('#WorksModal').find("input[name='title']").val(data.work.title);
                $('#WorksModal').find("input[name='position']").val(data.work.position);
                $('#WorksModal').find("textarea[name='description']").text(data.work.description);
                $('#WorksModal').find("textarea[name='benefit']").text(data.work.benefit);
                $('#WorksModal').find("textarea[name='require']").text(data.work.require);
                if (data.work.status) {
                    $('#WorksModal').find("input[name='status']").prop("checked", true);
                } else {
                    $('#WorksModal').find("input[name='salary_min']").val(data.work.salary_min);
                    $('#WorksModal').find("input[name='salary_max']").val(data.work.salary_max);
                    $('#WorksModal').find("input[name='status']").prop("checked", false);
                }
                checkStatus();
                $('#WorksModal').find("input[name='contact_name']").val(data.work.contact_name);
                $('#WorksModal').find("input[name='contact_phone']").val(data.work.contact_phone);
                $('#WorksModal').find("input[name='contact_email']").val(data.work.contact_email);
                $('#WorksModal').modal('show');
            }
            if (data.code == 422) {
                work.showErrors(data['errors'])
            }
        }
    });
}

work.update = function (ele) {
    let data = new FormData(ele);
    let url = $(ele).attr('action');
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data['code'] == 200) {
                $('#WorksModal').modal('hide');
                $('#job_company').html(data['job_company']);
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Chỉnh Sửa Việc Làm Thành Công!");
            }
            if (data['code'] == 422) {
                work.showErrors(data['errors'])
            }
        }
    });
}

work.save = function (ele) {
    console.log($(ele).find("input[name='_method']").is(":disabled"));
    if ($(ele).find("input[name='_method']").is(":disabled")) {
        this.store(ele);
    } else {
        this.update(ele);
    }
}

work.destroy = function (ele) {
    let data = new FormData(ele);
    let url = $(ele).attr('action');
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
                    type: 'POST',
                    url: url,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data['code'] == 200) {
                            $('#count_work').text(data['count']);
                            $('#job_company').html(data['job_company']);
                            toastr.options = { "positionClass": "toast-bottom-right" };
                            toastr["success"]("Xóa Thành Công!");
                        }
                    }
                });
            }
        }
    });
}

var job = job || {};

let path = location.origin;

job.showJob = function () {
    let url = $('#jobs').data('url');
    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success: function (data) {
            let table = $('#jobs').DataTable();
            table
                .clear()
                .draw();
            $.each(data.jobs, function (i, v) {
                table.row.add([
                    `${i + 1}`,
                    `${v.title ?? '...Chưa Cập Nhật...'}`,
                    `${v.last_date ?? '...Chưa Cập Nhật...'}`,
                    `${v.hot == 0 ? 'Binh Thuong' : 'Hot'}`,
                    `<button class="btn btn-primary" onclick="job.hot(${v.id})">is Hot</button>`
                ]).draw();
            });
        }
    });
}

job.hot = function (id) {
    let token = $("meta[name='csrf-token']").attr("content");
    let url = path + `/dashboard/${id}/jobs_api`;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            '_token': token,
            '_method': 'PATCH'
        },
        success: function (data) {
            if (data['code'] == 200) {
                job.showJob();
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Thao tac Thành Công!");
            }
        }
    });
}

job.init = function () {
    job.showJob();

}

$(document).ready(function () {
    job.init();
});