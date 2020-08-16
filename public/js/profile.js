var profile = profile || {};

profile.showErrors = function (errors) {
    if (errors['avatar'] != null) {
        $('#err-avatar').text(errors['avatar'][0]);
    }
    if (errors['name'] != null) {
        $('#err-full-name').text(errors['name'][0]);
    }
    if (errors['gender'] != null) {
        $('#err-gender').text(errors['gender'][0]);
    }
    if (errors['birth'] != null) {
        $('#err-birth').text(errors['birth'][0]);
    }
    if (errors['address'] != null) {
        $('#err-address').text(errors['address'][0]);
    }
    if (errors['bio'] != null) {
        $('#err-bio').text(errors['bio'][0]);
    }
    if (errors['exp'] != null) {
        $('#err-exp').text(errors['exp'][0]);
    }
    if (errors['resume'] != null) {
        $('#err-resume').text(errors['resume'][0]);
    }
    if (errors['cover_letter'] != null) {
        $('#err-cover-letter').text(errors['cover_letter'][0]);
    }
}

profile.update = function (ele) {
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
                $('#profileModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#info-profile').html(data['info_profile']);
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Cập Nhật Thông Tin Thành Công!");
            }
            if (data['code'] == 422) {
                profile.showErrors(data['errors'])
            }
        }
    });
}

profile.uploadAvatar = function (element) {
    let img = element.files[0];
    let reader = new FileReader();
    reader.onloadend = function () {
        $("#imgAvatar").attr("src", reader.result);
    }
    reader.readAsDataURL(img);
}

