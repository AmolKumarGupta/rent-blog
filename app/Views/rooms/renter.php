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
            <div class="mb-1 fs-4" ><?php echo $data['name']; ?></div>
            <div class="">Members: <div class="d-inline"><?php echo $data['members']; ?></div> </div>
            <div class="">Phone no.: <div class="d-inline"><?php echo $data['phone']; ?></div> </div>
            <div class="">Occupation: <div class="d-inline"><?php echo $data['job']; ?></div> </div>
        </div>
        <div class="col-12 ps-4">
            Note:
            <div><?php echo $data['note']; ?></div>
        </div>
    </div>

    <!-- Modal -->
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

                <!-- Members input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example2">Members</label>
                    <input type="number" name="members" value="<?php echo $data['members']; ?>" id="form4Example2" class="form-control" data-parsley-type="digits" required/>
                </div>

                <!-- Members input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example2">Phone No.</label>
                    <input type="tel" name="phone" value="<?php echo $data['phone']; ?>" id="form4Example2" class="form-control" data-parsley-type="digits" minlength="10" maxlength="10" required/>
                </div>

                <!-- Note input -->
                <div class="form mb-4">
                    <label class="form-label" for="form4Example3">Notes</label>
                    <textarea name="note" class="form-control" id="form4Example3" rows="4" required ><?php echo $data['note']; ?></textarea>
                </div>

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

    /* submiting form */
    $('#formEditInfo').submit(function(e){
        e.preventDefault();
        const form = document.querySelector('#formEditInfo');
        const fd = new FormData(form);
        const data = Object.fromEntries(fd.entries());
        console.table(data);

        $('[type=submit]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        setTimeout(() => {
            $('[type=submit]').text('Save changes');
        }, 5000);
    });
    /* submiting form */
</script>

<?php echo $this->endSection('body'); ?>