const url = location.href.replace(location.search, '');

function alert_float(color, msg) {
    $('body').append(`<div class="alert alert-${color} w-fit min-w-25 alert-float">${msg}</div>`);
    setTimeout(() => {
        $('.alert-float').remove();
    }, 3000);
}

function renderTable(ele) {
    let table = $(ele).data('rbTable');
    let cb = $(ele).data('rbCall');
    
    post(
        url + `/ajax?table=${table}`,
        {},
        (res) => {
            $(ele).html(res);
            cb ? window[cb]() : null;
        }
    );
}