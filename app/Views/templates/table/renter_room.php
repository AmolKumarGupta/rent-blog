<?php /** $tuid template unique id */ ?>
<table id="<?php echo $tuid; ?>" class="w-100 lh-lg">
    <thead class="rb-fw-500">
        <tr>
            <td>Room</td>
            <td class="text-center" colspan="2">Renter</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rooms as $r) { ?>
        <tr>
            <td class="text-capitalize">
                <?php echo $r['name']; ?>
            </td>
            <td>
            <?php 
                if ($r['renter_id']) {
                    echo '<div class="form-control select-border-none">'.$r['renter_name'].'</div>';
                }else {
                    echo form_dropdown('room_renter_map', $renterData, $r['renter_id'], "class='form-control select-border-none c-p' data-room-id='".$r['id']."' onchange='". $tuid ."_change(this)'");
                } 
            ?>
            </td>
            <td>
                <?php echo $r['renter_id'] ? '<i onclick="'. $tuid .'_click(this)" data-room-id="'.$r['id'].'" class="fa fa-trash text-danger c-p"></i>': ''; ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>