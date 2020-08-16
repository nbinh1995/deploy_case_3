function checkStatus() {
    if ($('#status').is(":checked")) {
        $('#salary_min').prop("disabled", true);
        $('#salary_max').prop("disabled", true);
    } else {
        $('#salary_min').prop("disabled", false);
        $('#salary_max').prop("disabled", false);
    }
}

// scroll functions
let previousScroll = 0;
$(window).scroll(function (e) {
    let currentScroll = $(window).scrollTop();
    if (currentScroll < 90) {
        $('.navbar').removeClass("menu-hide");
    } else {
        if (currentScroll > 0 && currentScroll < $(document).height() - $(window).height()) {
            if (currentScroll > previousScroll) {
                $('.navbar').addClass("menu-hide");
            } else {
                $('.navbar').removeClass("menu-hide");
            }
            previousScroll = currentScroll;
        }
    }
});

function apply(ele) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    url = $(ele).data('url');
    work_id = $(ele).data('work');
    profile_id = $(ele).data('profile');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            'work_id': work_id,
            'profile_id': profile_id
        },
        success: function (data) {
            if (data['code'] == '200') {
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["success"]("Ứng tuyển Thành Công!");
            } else {
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr["warning"]("Bạn chưa được admin cấp quyền!");
            }
        }
    });
}
let flag = true
function fullScreen() {
    if (flag) {
        document.documentElement.requestFullscreen();
        flag = false;
    } else {
        document.exitFullscreen();
        flag = true;
    }
}

$(document).on({
    ajaxStart: function () {
        $("#spinner").show();
    },
    ajaxStop: function () {
        $("#spinner").hide();
    },
    ajaxError: function () {
        $("#spinner").hide();
    }
});