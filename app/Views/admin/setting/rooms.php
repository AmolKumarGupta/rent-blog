<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
<div class="container px-4 table-responsive">
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Room name</th>
            <th scope="col">Renter name</th>
            <th scope="col">Price</th>
            <th scope="col" class="text-center">Action</th>            
        </tr>
    </thead>
    <tbody>
        <?php foreach($rooms as $i){ ?>
        <tr data-id="<?php echo esc($i['id']); ?>">
            <th scope="row"><?php echo esc($i['id']); ?></th>
            <td class="text-capitalize"><?php echo ($i['name']); ?></td>
            <td class="text-capitalize"><?php echo esc($i['renter_name']); ?></td>
            <td>Rs <?php echo esc($i['price']); ?></td>
            <td class="text-center">
                <div class="d-flex justify-content-center" style="gap:1rem;">
                    <div class="fa fa-pen" role="button" data-edit-id="<?php echo esc($i['id']); ?>" data-edit-name="<?php echo ($i['name']); ?>" data-edit-price="<?php echo esc($i['price']); ?>" data-mdb-toggle="modal" data-mdb-target="#editInfoModal"></div>
                    <div class="fa fa-trash" data-delete="<?php echo esc($i['id']); ?>" role="button"></div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <button data-add class="btn btn-primary m-2">Add</button>
</div>

<!-- Modal -->
<div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Room</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="<?php echo url_to('update_room'); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="" />
                <!-- Name input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example1">Name</label>
                    <input type="text" name="name" value="" id="form4Example1" class="form-control" pattern="[a-zA-Z\s.]+" title="only characters" required />
                </div>

                <!-- Price input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example2">Price (Rs)</label>
                    <input type="number" name="price" value="" id="form4Example2" class="form-control" required/>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    $('[data-add]').click(function(){
        Swal.fire({
            title: 'Name your room',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            showLoaderOnConfirm: true,
            preConfirm: (roomName) => {
                if( roomName == '' ){
                    Swal.showValidationMessage(`Name can't be empty`);
                    return;
                }

                return fetch(`<?php echo url_to("create_room"); ?>?name=${roomName}`,{
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`)
                    });
            },
            allowOutsideClick: () => !Swal.isLoading(),
            backdrop: true

        }).then((result) => {
            if (result.isConfirmed) {
                if( result.value.status == 200 ){
                    console.log(result.value.data);

                    let {id, name} = result.value.data;
                    _html = `
                    <tr data-id="${id}">
                        <th scope="row">${id}</th>
                        <td class="text-capitalize">${name}</td>
                        <td class="text-capitalize">none</td>
                        <td>Rs 1500</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center" style="gap:1rem;">
                                <div class="fa fa-pen" role="button" data-edit-id="${id}" data-edit-name="${name}" data-edit-price="1500" data-mdb-toggle="modal" data-mdb-target="#editInfoModal"></div>
                                <div class="fa fa-trash" data-delete="${id}" role="button"></div>
                            </div>
                        </td>
                    </tr>`;
                    $('tbody').append(_html);
                    handleEvent();
                }
            }
        })
    });

    handleEvent();
    function handleEvent(){
        /* deleting room */
        $('[data-delete]').each( function(){
            $(this).click( function(){
                _id = this.dataset.delete;
                $.ajax({
                    url: `<?php echo url_to('delete_room'); ?>`,
                    method: 'POST',
                    datatype: 'json',
                    data: {"id": _id},
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
                    },
                    success: function(res){
                        if( res ){
                            if(res.status == 200){
                                $(`[data-id=${_id}]`).remove();
                            }
                        }
                    },
                    error: function(err){
                        console.log(err.statusText);
                    }
                })
            })
        });/* ends */

        /* populate edit form */
        $('[data-edit-id]').each( function(){
            $(this).click( function(){
                _id = this.dataset.editId;
                _name = this.dataset.editName;
                _price = this.dataset.editPrice;

                $('[name=id]').val(_id);
                $('[name=name]').val(_name);
                $('[name=price]').val(Number(_price));
            });
        });
        /* populate edit form ends */
    }
</script>
<?php echo $this->endSection('body'); ?>
