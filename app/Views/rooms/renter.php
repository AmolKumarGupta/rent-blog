<?php echo $this->extend('layouts/main'); ?>
<?php echo $this->section('body'); ?>
<style>
    input.parsley-success,
    select.parsley-success,
    textarea.parsley-success {
    color: #468847;
    background-color: #DFF0D8;
    border: 1px solid #D6E9C6;
    }

    input.parsley-error,
    select.parsley-error,
    textarea.parsley-error {
    color: #B94A48;
    background-color: #F2DEDE;
    border: 1px solid #EED3D7;
    }

    .parsley-errors-list {
    margin: 2px 0 3px;
    padding: 0;
    list-style-type: none;
    font-size: 0.9em;
    line-height: 0.9em;
    opacity: 0;
    color: #B94A48;

    transition: all .3s ease-in;
    -o-transition: all .3s ease-in;
    -moz-transition: all .3s ease-in;
    -webkit-transition: all .3s ease-in;
    }

    .parsley-errors-list.filled {
    opacity: 1;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
<div class="my-4 mx-1 mx-md-4 row">
    <div class="col-12 mb-3"><h4 class="h4 d-inline">Personal Info </h4><span><i class="fa fa-pen fa-pull-right" role="button" data-mdb-toggle="modal" data-mdb-target="#editInfoModal"></i></span></div><hr/>
    <div class="col-md-6 ps-4">
        <div class="d-flex gap-3 align-items-center">
            <div class="fs-4" data-name>
                <?php echo $data['name']; ?>
            </div>
            <?php
            if( $data['status']=='y' ){
                echo '<span class="badge badge-success">Active</span>';
            }else{
                echo '<span class="badge badge-danger">In-active</span>';
            }
            ?>
        </div>
        
        <div class="">Rating: <span class="text-warning "><div class="d-inline" data-rating><?php echo $data['rating']; ?></div> star</span></div>
        <div class="">Members: <div class="d-inline" data-member-count><?php echo 0; ?></div> </div>
        <div class="">Phone no.: <div class="d-inline" data-phone_no><?php echo $data['phone_no'] ? $data['phone_no'] : "<i>Unknown</i>"; ?></div> </div>
        <div class="">Occupation: <div class="d-inline" data-occupation><?php echo $data['occupation'] ? $data['occupation'] : "<i>Unknown</i>"; ?></div> </div>
    </div>
    <div class="col-12 ps-4">
        Note:
        <div data-note ><?php echo $data['note'] ? $data['note'] : "<i>Note something important</i>"; ?></div>
    </div>
</div>

<!-- Edit profile Modal -->
<div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formEditInfo">
                <!-- Name input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example1">Name</label>
                    <input type="text" name="name" value="<?php echo $data['name']; ?>" id="form4Example1" class="form-control" pattern="[a-zA-Z\s.]+" required />
                </div>

                <div class="form mb-4">
                    <label class="form-label" for="form4Example21">Rating</label>
                    <input type="number" name="rating" value="<?php echo $data['rating']; ?>" id="form4Example21" class="form-control" min="0" max="10"/>
                </div>

                <!-- phone input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example3">Phone No.</label>
                    <input type="tel" name="phone_no" value="<?php echo $data['phone_no']; ?>" id="form4Example3" class="form-control" data-parsley-type="digits" minlength="10" maxlength="10"/>
                </div>

                <div class="form mb-4">
                    <label class="form-label" for="form4Example4">Occupation</label>
                    <input type="text" name="occupation" value="<?php echo $data['occupation']; ?>" id="form4Example4" class="form-control" />
                </div>

                <!-- Note input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example5">Notes</label>
                    <textarea name="note" class="form-control" id="form4Example5" rows="4"><?php echo $data['note']; ?></textarea>
                </div>

                <div data-err="edit-profile" class="alert-danger p-2 rounded d-none">Something went wrong, Try again.</div>

                <!-- Submit button -->
                <!-- <button type="submit" class="btn btn-primary mb-4">Send</button> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-grayish" data-mdb-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary" data-btn-save >Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
    $('#formEditInfo').parsley();

    /* function */
    function changeText (data, text) {
        $(`[data-${ data }]`).text(text);
    }

    function changeProfileData (data) {
        tmp = Object.entries(data);
        tmp.forEach( ([data, text]) => {
            if (data == 'id') {
                return;
            }

            if ((data=='phone_no' || data=='occupation') && text=="") {
                text = 'Unknown';
            }
            if ((data=='note') && text=="") {
                text = 'Note something important';
            }
            changeText(data, text);
        });
    }
    /* function */

    /* submiting form */
    $('#formEditInfo').submit(function(e){
        e.preventDefault();
        $('[type=submit]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        $('[data-err="edit-profile"]').addClass('d-none');

        const form = document.querySelector('#formEditInfo');
        const fd = new FormData(form);
        // console.log(fd);
        
        $.ajax({
            url: '<?php echo url_to('renter.info.update', $data['id']); ?>',
            type: 'post',
            data: fd,
            processData: false,
            contentType: false,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
            },
            success: function(res){
                if(res){
                    if( res.status == 200 ){
                        changeProfileData(res.data);
                        $('[data-mdb-dismiss="modal"]').trigger('click')
                    }
                }
            },
            error: function(xhr){
                $('[data-err="edit-profile"]').removeClass('d-none');
            }
        }).done( () => {
            $('[type=submit]').text('Save changes');
        });
    });
    /* submiting form */
</script>

<?php echo $this->endSection('body'); ?>