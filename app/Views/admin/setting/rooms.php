<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
<div class="container px-4 table-responsive">
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Room name</th>
            <th scope="col" class="text-center">Action</th>            
        </tr>
    </thead>
    <tbody>
        <?php foreach([1,2,3] as $i){ ?>
        <tr>
            <th scope="row">1</th>
            <td>Sit</td>
            <td class="text-center">
                <span class="fa fa-pen"></span>
                <span class="px-4"></span>
                <span class="fa fa-trash"></span>
            </td>
        </tr>
        <?php } ?>        
    </tbody>
    </table>
</div>
<?php echo $this->endSection('body'); ?>
