<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
<!-- ----------------------------------------------------------------- -->
<div class="container">
    <div class="row">
        <?php
            $id=1;
            $arr = ['danger', 'primary', 'success'];
            foreach($arr as $i){
        ?>
        <div class="col-12 col-sm-6 col-xl-3 mb-3">
            <div class="card text-white bg-<?php echo $i; ?> mx-auto" style="max-width: 18rem;">
                <a href="<?php echo base_url('rooms/'.$id); ?>">
                    <div class="card-header text-white hover-underlined">Left-sided Room</div>
                </a>
                <div class="card-body">
                    <h5 class="card-title">Rented by Mr.Renter</h5>
                    <div class="card-text">
                        he has paid his rent.<br/>
                        This month bills: Rs 333<br/>
                        Units used: 52.6 kwh
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>

<!-- ----------------------------------------------------------------- -->
<?php echo $this->endSection(); ?>
