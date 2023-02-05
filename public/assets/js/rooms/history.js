let addHistoryModal = undefined;

$(function() {
    addHistoryModal = new mdb.Modal(document.getElementById('addHistoryModal'));
    
    $('#history').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        order: [[5, 'desc']],
    });
});

function addHistory(ele, e) {
    e.preventDefault();
    data = $(ele).serialize();

    post(
        historyUrl,
        data,
        (res) => {
            addHistoryModal.hide();
            $('#history').DataTable().ajax.reload();
        },
        (xhr) => {
            if (xhr.responseJSON) {
                let arr = Object.values(xhr.responseJSON);
                alert_float("danger", arr[0]);
                return ;
            }

            alert_float("danger", "Something went wrong");
        }
    );

    return false;
}

function checkUnits(that) {
    let fd = new FormData(document.getElementById('addHistoryForm'));
    let submitBtn = document.querySelector('#trans-save-button');

    if (that.value != 2) {
        submitBtn.disabled = false;
        document.querySelector('#electricity_units').innerHTML = "";
        return true;
    }
    submitBtn.disabled = true;
    
    let data = {
        room_id: fd.get('room_id'),
        renter_id: fd.get('renter_id'),
        year: fd.get('year'),
        month: fd.get('month'),
    };

    post(
        unitCheckUrl,
        data,
        (res)=> {
            if (res.unit == null) {
                alert_float("info", "Electricity Units are not Added, Please add here.");

                let html = `
                    <input type="number" class="form-control mb-4" placeholder="Units in kwh">
                    <button type="button" class="btn btn-primary mb-4" onClick="setUnits()">Set</button>
                `;
                document.querySelector('#electricity_units').innerHTML = html;

            }else {
                $("#addHistoryForm [name=fake_electric_bill]").val(res.price);
                $("[data-elect-price]").text(` / ${res.price}`);
                document.querySelector('#electricity_units').innerHTML = "";
                document.querySelector('#trans-save-button').disabled = false;
            }
        },
        (xhr) => {
            submitBtn.disabled = false;
            alert_float("danger", "Something went wrong while fetching data.");
        }
    );
}

function setUnits() {
    let fd = new FormData(document.getElementById('addHistoryForm'));
    let unit = document.querySelector('#electricity_units>input').value;

    let data = {
        room_id: fd.get('room_id'),
        renter_id: fd.get('renter_id'),
        year: fd.get('year'),
        month: fd.get('month'),
        overall_units: unit
    };

    post(
        unitSaveUrl,
        data,
        (res) => {
            $("#addHistoryForm [name=fake_electric_bill]").val(res.price);
            $("[data-elect-price]").text(` / ${res.price}`);
            document.querySelector('#electricity_units').innerHTML = "";
            document.querySelector('#trans-save-button').disabled = false;
        },
        (xhr) => {
            alert_float("danger", "Something went wrong.");
        }
    );
}