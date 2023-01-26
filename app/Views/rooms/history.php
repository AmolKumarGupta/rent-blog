<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>

<?php loadStyles('datatable'); loadScripts('datatable'); ?>

<div class="container px-4 pt-3 pb-5">
    <button class="btn btn-primary float-end mb-3" >Add Record</button>
    <table id="history" class="display table">
        <thead>
            <tr>
                <th>Month</th>
                <th>Renter name</th>
                <th>Type</th>
                <th>Charges paid</th>
                <th>Total charges</th>
                <th>Paid at</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script>
    $(function() {
        // $('#history').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: 'scripts/server_processing.php',
        // });
        $('#history').DataTable();
    });
</script>

<?php echo $this->endSection('body'); ?>