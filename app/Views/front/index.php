<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
<!-- ----------------------------------------------------------------- -->
<div class="container">
    <div class="row">
        <?php
            $arr = ['danger', 'primary', 'success', 'warning'];
            foreach ($rooms as $key=>$r) {
        ?>
        <div class="col-12 col-sm-6 col-xl-3 mb-3">
            <div class="card text-white bg-<?php echo $arr[$key]; ?> mx-auto" style="max-width: 18rem;">
                <a href="<?php echo base_url('rooms/'.$r['id']); ?>">
                    <div class="card-header text-white hover-underlined text-capitalize">
                        <?php echo esc($r['name']); ?>
                    </div>
                </a>
                <div class="card-body">
                    <?php if ($r['renter_id']) { ?>
                        <h5 class="card-title">Rented by <?php echo esc($r['renter_name']); ?></h5>
                        <div class="card-text">
                            he has paid his rent.<br/>
                            This month bills: Rs 333<br/>
                            Units used: 52.6 kwh
                        </div>
                    <?php }else { ?>
                        <h5 class="card-title">Not on rent</h5>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>

<!-- ----------------------------------------------------------------- -->
<?php echo $this->endSection(); ?>
