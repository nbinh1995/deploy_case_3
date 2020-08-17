var job = job || {};

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
    let path = window.location.origin;
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