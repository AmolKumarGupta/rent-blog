<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
    <div class="container-fluid">
        <div class="w-100">
            <h4 class="d-inline">This month, <?php echo $time->format('F Y'); ?></h4>
            <div class="d-inline float-end "><a href="<?php echo url_to('room.history', $id); ?>" class="text-grayish">view all</a></div>
        </div>
    </div>

    <hr class="mx-2"/>

    <div class="container-fluid">
        <div class="w-100">
            <h4>Previous month, <?php echo $preTime->format('F Y'); ?></h4>
        </div>
    </div>
<?php echo $this->endSection('body'); ?>