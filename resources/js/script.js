$(document).ready(function () {
    if ($('#department').hasClass('department_event')) {
        let departmentId = $("#department option:selected").val();
        if (departmentId !== 0) {
            let positionId = $('#position').data('position-id');
            departmentAjax(departmentId, positionId);
        }
    }
});

$(document).on('blur change', '*[form="search"]', function () {
    if ($(this).val() !== '') {
        $('#search').submit();
    }
});

$(document).on('click', '.clean-input', function () {
    const name = $(this).data('name');
    $(`[name=${name}]`).val('');

    $('#search').submit();
});


$(document).on('change', '.department_event', function () {
    let departmentId = $(this).find('option:selected').val();
    departmentAjax(departmentId);
});

function departmentAjax(departmentId, positionId = 0) {
    $.ajax({
        url: '/position-list/',
        method: 'GET',
        dataType: 'JSON',
        data: {department_id: departmentId, position_id: positionId},
        success: function (response) {
            console.log(response);
            if (response.length > 0) {
                var option = '<option value="">Выбрать должность</option>';
                for (let i = 0; i < response.length; i++) {
                    var selected = '';
                    if (response[i].id == positionId) {
                        selected = 'selected';
                    }
                    option += '<option value="' + response[i].id + '" ' + selected + '>' + response[i].name + '</option>';
                }
            } else {
                var option = '<option value="" disabled>Нет должности</option>';
            }
            $('#position').html(option);
        }
    });
}
