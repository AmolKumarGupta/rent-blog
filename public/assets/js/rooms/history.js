$(function() {
    // $('#history').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: 'scripts/server_processing.php',
    // });
    $('#history').DataTable();
});

function addHistory(ele, e) {
    e.preventDefault();
    data = $(ele).serialize();

    post(
        historyUrl,
        data,
        (res) => {
            
        },
        (xhr) => {
            alert_float("danger", "Something went wrong");
        }
    );

    return false;
}