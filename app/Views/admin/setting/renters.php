<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
<style>
    [data-rating]:after {
        content: '\2B50';
    }
</style>

<div class="px-4 text-end">
    <?php if( $get===null ){ ?>
        <a href="<?php echo url_to("setting_renters");?>?all" class="text-black-50">
            view all
        </a>
    <?php }else{ ?>
        <a href="<?php echo url_to("setting_renters");?>" class="text-black-50">
            view active
        </a>
    <?php } ?>
</div>

<div class="container px-4 table-responsive">
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Renter name</th>
            <th scope="col" class="text-center">Ratings</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Action</th>            
        </tr>
    </thead>
    <tbody id="renter-table" >
        <?php foreach($renters as $renter) { ?>
            <tr data-id="<?php echo $renter['id']; ?>">
                <td><?php echo esc($renter['id']); ?></td>
                <td class="text-capitalize" data-name="<?php echo esc($renter['id']); ?>"><?php echo esc($renter['name']); ?></td>

                <td class="text-center" data-rating><?php echo esc($renter['rating']); ?></td>

                <td class="text-center" data-status="<?php echo $renter['status']; ?>">
                    <?php
                        if( $renter['status']=='y' ){
                            echo '<span class="badge badge-success">Active</span>';
                        }else{
                            echo '<span class="badge badge-danger">In-active</span>';
                        }
                    ?>
                </td>
                <td>
                    <div class="d-flex justify-content-center" style="gap:1rem;">
                        <a href="<?php echo url_to('renter_info', $renter['id']); ?>" class="fa fa-eye" role="button"></a>
                        
                        <div class="fa fa-pen text-success editRenter" data-id="<?php echo $renter['id']; ?>" role="button" data-mdb-toggle="modal" data-mdb-target="#editRenterModal"></div>

                        <div class="fa fa-trash deleteRenter text-danger" role="button" data-mdb-toggle="modal" data-mdb-target="#deleteRenterModal" data-id="<?php echo $renter['id']; ?>"></div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
    <button class="btn btn-primary m-2" data-mdb-toggle="modal" data-mdb-target="#addRenterModal" >Add</button>
</div>

<!-- Modal -->
<div class="modal fade" id="editRenterModal" tabindex="-1" aria-labelledby="editRenterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Renter</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editRenterForm">
                <input type="hidden" name="id" value="" />

                <div class="form mb-4">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" name="name" value="" id="name" class="form-control" pattern="[a-zA-Z\s.]+" title="only characters" required />
                </div>
                <div class="form mb-4">
                    <label class="form-label" for="rating">Rating</label>
                    <input type="number" name="rating" value="" id="rating" class="form-control" min="0" max="10" />
                </div>
                <div class="form mb-4">
                    <label class="form-label" for="status">Status</label>
                    <?php echo form_dropdown('status', ["y"=> "Active", "n"=> "In-Active"], null, 'class="form-select"'); ?>
                </div>                

                <div class="modal-footer">
                    <button type="button" class="btn btn-grayish" data-mdb-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addRenterModal" tabindex="-1" aria-labelledby="addRenterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addRenterModalLabel">Add Renter</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addRenterForm">
                <div class="form mb-4">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" name="name" value="" placeholder="Enter renter name" id="name" class="form-control" pattern="[a-zA-Z\s.]+" title="only characters" required />
                </div>

                <div class="form mb-4">
                    <label class="form-label" for="name">Room</label>
                    <?php echo form_dropdown('room', $room_options, null, 'class="form-select"'); ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-grayish" data-mdb-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteRenterModal" tabindex="-1" aria-labelledby="deleteRenterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRenterModalLabel">Delete Renter</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    Do you really want to delete renter ?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grayish" data-mdb-dismiss="modal">Discard</button>
                <button type="button" data-delete="" class="btn btn-danger">Yes, Delete it</button>
            </div>
        </div>
    </div>
</div>

<script>
    $( function() {
        function setData(name, id, value){
            $(`[data-${name}=${id}]`).text(value);
        }

        function setRowData (name, id, value) {
            $(`tr[data-id=${ id }] [data-${ name }]`).text(value);
        }

        function insertRenter({id, name='', rating='0'}){
            temp_url = '<?php echo url_to('renter_info', '0'); ?>';
            url = temp_url.replace('0', id);

            if( id==null || id==undefined ){
                return;
            }

            html = `<tr data-id="${id}">
                <td>
                    ${ id }
                </td>
                <td class="text-capitalize" data-name="${id}">${name}</td>
                <td class="text-center" data-rating>${rating}</td>
                <td class="text-center"><span class="badge badge-success">Active</span></td>
                <td>
                    <div class="d-flex justify-content-center" style="gap:1rem;">
                        <a href="${url}" class="fa fa-eye" role="button"></a>
                        <div class="fa fa-pen text-success  editRenter" data-id="${id}" role="button" data-mdb-toggle="modal" data-mdb-target="#editRenterModal"></div>
                        <div class="fa fa-trash deleteRenter text-danger" role="button" data-mdb-toggle="modal" data-mdb-target="#deleteRenterModal" data-id="${id}"></div>
                    </div>
                </td>
            </tr>`;

            $('#renter-table').append(html);
            handleEdit();
            handleDelete();

        }

        handleEdit();
        function handleEdit() {
            $('.editRenter').each( function(){
                $(this).click( function(){
                    id = $(this).data('id');
                    $('#editRenterForm [name=id]').val(id);

                    name = $(`[data-name=${ id }]`).text();
                    if( name!='' ){
                        $('#editRenterForm [name=name]').val( name.trim() );
                    }
                    rating= $(`tr[data-id=${id}] [data-rating]`).text();
                    $('#editRenterForm [name=rating]').val( rating.trim() );

                    status= $(`tr[data-id=${id}] [data-status]`).data('status');
                    $('#editRenterForm [name=status]').val( status.trim() );
                });
            });
        }

        handleDelete();
        function handleDelete(){
            $('.deleteRenter').each( function(){

                $(this).click( function(){
                    id = $(this).data('id');
                    
                    // dom = document.querySelector('[data-delete]');
                    // dom.dataset.delete = id;
                    $('[data-delete]').data('delete', id);
                });
            })
        }

        $('#editRenterForm').submit( function(e){
            e.preventDefault();
            formData = $(this).serialize();

            $.ajax({
                url: '<?php echo url_to('update_renter'); ?>',
                type: 'post',
                data: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
                },
                success: function(res){
                    if(res){
                        if( res.status == 200 ){
                            data = res.data;
                            setData('name', data.id, data.name );
                            setRowData('rating', data.id, data.rating);
                            status_ele = $(`tr[data-id=${ data.id }] [data-status]`);
                            status_ele.data('status', data.status);
                            if (data.status=='y') {
                                status_ele.find('span').text('Active');
                                status_ele.find('span').addClass('badge-success');
                                status_ele.find('span').removeClass('badge-danger');
                            }else {
                                status_ele.find('span').text('In-active');
                                status_ele.find('span').addClass('badge-danger');
                                status_ele.find('span').removeClass('badge-success');
                            }
                            $('#editRenterForm [data-mdb-dismiss]').trigger('click');
                        }
                    }
                },
                error: function(xhr){
                    console.warn(xhr);
                    $('#editRenterForm [data-mdb-dismiss]').trigger('click');
                }
            });
        });

        $('#addRenterForm').submit( function(e) {
            e.preventDefault();
            fd = $(this).serialize();
            
            $.ajax({
                url: '<?php echo url_to('create_renter'); ?>',
                type: 'post',
                data: fd,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
                },
                success: function(res){
                    if(res){
                        if( res.status == 200 ){
                            data = res.data;
                            insertRenter(data);
                            $('#addRenterForm [data-mdb-dismiss]').trigger('click');
                        }
                    }
                },
                error: function(xhr){
                    console.warn(xhr);
                    $('#addRenterForm [data-mdb-dismiss]').trigger('click');
                }
            });
        });

        $('[data-delete]').click( function(){
            id = $(this).data('delete');
            fd = new FormData();
            fd.append("id", id);
            $.ajax({
                url: '<?php echo url_to('delete_renter'); ?>',
                type: "post",
                data: new URLSearchParams(fd).toString(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
                },
                success: function(res){
                    if( res ){
                        if( res.status==200 ){
                            $(`tr[data-id=${id}]`).remove();
                            $('#deleteRenterModal [data-mdb-dismiss]').trigger('click');
                        }
                    }
                },
                error: function(xhr){
                    console.warn(xhr);
                    $('#deleteRenterModal [data-mdb-dismiss]').trigger('click');
                }
            })
            $(this).data('delete', '');
        });

    });
</script>

<?php echo $this->endSection('body'); ?>
