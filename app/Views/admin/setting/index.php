<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<div class="container px-4">
    <div class="" id="menu">
        <div class="col-6 menu-item card mb-4">
            <div class="card-header c-grab fw-bold fs-5">Rooms & their renters</div>
            <div class="non-draggable card-body" data-rb-table="renterRoom" data-rb-call=""></div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="renterRemoveModal" tabindex="-1" aria-labelledby="renterRemoveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renterRemoveModalLabel">Confirm</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                Do you really want to empty the room ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-grayish" data-mdb-dismiss="modal">No, I changed my mind</button>
                <button type="button" class="btn btn-primary" onclick="renterRemoveModalYes(this)" >Yes, Sure</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    let renterRemoveModal = undefined;
    $( function () {
        renterRemoveModal = new mdb.Modal(document.getElementById('renterRemoveModal'));

        $('#menu').sortable({
            cancel: '.non-draggable'
        });

        $('[data-rb-table]').each( function (i, ele) {
            renderTable(ele);
        })

    });

    // function after_renter_room () {
    //     console.count()
    // }

    function table_renter_room_change(ele) {
        const roomId = $(ele).data('roomId');
        const renterId = $(ele).val();
        console.log({roomId, renterId});

        post(
            '<?php echo url_to('change.room'); ?>',
            {room: roomId, renter: renterId},
            (res) => {
                if (res.status==200) {
                    ele = $('[data-rb-table=renterRoom]')[0];
                    renderTable(ele);
                }
            }
        );
    }

    function table_renter_room_click(ele) {
        let roomId = $(ele).data('roomId');
        renterRemoveModal.myRoomId = roomId;
        renterRemoveModal.show();
    }

    function renterRemoveModalYes() {
        let roomId = renterRemoveModal.myRoomId;

        post(
            '<?php echo url_to('change.room'); ?>',
            {room: roomId, renter: 0},
            (res) => {
                if (res.status==200) {
                    ele = $('[data-rb-table=renterRoom]')[0];
                    renderTable(ele);
                    renterRemoveModal.hide();
                }
            }
        );

        renterRemoveModal.myRoomId = undefined;
    }
</script>
<?php echo $this->endSection('body'); ?>