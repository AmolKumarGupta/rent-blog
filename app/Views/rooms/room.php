<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
    <div class="container-fluid">
        <div class="w-100">
            <h4 class="d-inline">This month, August</h4>
            <div class="d-inline float-end "><a href="#" class="text-grayish">view all</a></div>
        </div>
    </div>
    <hr class="mx-2"/>
    <div class="container-fluid">
        <h4>Previous month, July</h4>
    </div>
<?php echo $this->endSection('body'); ?>