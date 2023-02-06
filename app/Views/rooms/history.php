<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>

<?php loadStyles('datatable'); loadScripts('datatable'); ?>

<div class="container px-4 pt-3 pb-5">
    <button class="btn btn-primary float-end mb-3" data-mdb-toggle="modal" data-mdb-target="#addHistoryModal">Add Record</button>
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
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="addHistoryModal" tabindex="-1" aria-labelledby="addHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addHistoryModalLabel">Add Transaction</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addHistoryForm" onsubmit="return addHistory(this, event);">
                    <input type="hidden" name="room_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="renter_id" value="<?php echo $current_room_renter_id; ?>"> 
                    <input type="hidden" name="fake_room_rent" value="<?php echo $room_rent; ?>"> 
                    <input type="hidden" name="fake_electric_bill" value="">

                    <!-- Month & Year -->
                    <div class="form mb-4">
                        <label class="form-label" for="form-month">Month & Year</label>

                        <div class="row">
                            <div class="col-6">
                                <?php 
                                    echo form_dropdown("month", $list_of_months, $time->getMonth(), 'id="form-month" class="form-select"');
                                ?>
                            </div>

                            <div class="col-4">
                                <?php 
                                    $years = [];
                                    for ($i=2021; $i<=2025; $i++):
                                        $years[$i] = $i;
                                    endfor;

                                    echo form_dropdown("year", $years, $time->getYear(), 'id="form-year" class="form-select"');
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Type -->
                    <div class="form mb-4">
                        <label class="form-label" for="form-charge">Transaction Type</label>
                        <?php echo form_dropdown("charge_type_id", charge_type_options(), null, 'id="form-charge" class="form-select text-capitalize" onChange="checkUnits(this)"'); ?>
                    </div>

                    <div class="form d-flex gap-4" id="electricity_units"></div>

                    <!-- Payment -->
                    <div class="form mb-4">
                        <label class="form-label" for="form-price">Payment</label>
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="number" name="paid" class="form-control" min="0" max="<?php echo $room_rent; ?>">
                            </div>
                            <div class="col-sm-4 lead" data-elect-price> / <?php echo $room_rent; ?></div>
                        </div>
                    </div>

                    <div class="form mb-4">
                        <input type="date" class="form-control" name="created_at">
                    </div>

                    <!-- Submit button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-grayish" data-mdb-dismiss="modal">Discard</button>
                        <button id="trans-save-button" type="submit" class="btn btn-primary" >Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const historyUrl = "<?php echo url_to('save.history', $id); ?>";
    const ajaxUrl = '<?php echo url_to("ajax.rooms"); ?>?datatable=rooms&renter_id=<?php echo $id; ?>';
    const unitCheckUrl = '<?php echo url_to("units.check"); ?>';
    const unitSaveUrl = '<?php echo url_to("units.save"); ?>';
</script>
<script src="<?php echo asset('js/rooms/history.js'); ?>"></script>

<?php echo $this->endSection('body'); ?>