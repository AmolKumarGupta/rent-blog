<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<div class="container px-4">
    <div class="" id="menu">
        <div class="col-6 menu-item card mb-4">
            <div class="card-header c-grab fw-bold fs-5">Rooms & their renters</div>
            <div class="non-draggable card-body" data-rb-table="renterRoom" data-rb-call="after_renter_room"></div>
        </div>
        
    </div>
</div>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $( function () {
        $('#menu').sortable({
            cancel: '.non-draggable'
        });

        $('[data-rb-table]').each( function (i, ele) {
            renderTable(ele);
        })

    });

    function after_renter_room () {
        console.count()
    }
</script>
<?php echo $this->endSection('body'); ?>