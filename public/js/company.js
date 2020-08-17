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

