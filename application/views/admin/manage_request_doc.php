<div class="body-content">
    <div class="section history-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <nav id="sidebar">            
                        <!-- Sidebar Links -->
                        <ul class="list-unstyled components">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">My Profile</a></li>
                            <li><a href="<?php echo base_url(); ?>admin">Manage User</a></li>
                            <li class="active"><!-- Link with dropdown items -->
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Manage Request</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li class="active"><a href="<?php echo base_url(); ?>admin/startedrequest"> Srarted Request</a></li>
                                    <li><a href="#"> Froward Request</a></li>
                                    <li><a href="#"> Success Request</a></li>
                                    <li><a href="#"> Failed Request</a></li>
                                </ul>
                            </li>			                
                            <li><a href="#">Message</a></li>
                        </ul>
                    </nav>       
                </div>
                <div class="col-md-9">
                    <form name="docForm" class="" id="docForm" role="form">

                        <? 
                        //$doc_total = 0;
                        foreach($doc_submited as  $ds){ 
                        //print_r($doc_submited);

                        $doc_name = $this->user_model->get_name('document_list', array('document_list_id'=>$ds['document_id']),'document_name');

                        $doc_total = $this->user_model->count_where('owner_provide_doc', array('request_request_id'=>$ds['request_request_id']));

                        $doc_submited = $this->user_model->count_where('owner_provide_doc', array('status'=>'1', 'request_request_id'=>$ds['request_request_id']));

                        $status = $ds['status'];

                        if($status==1){
                        $s = 'checked';
                        }else{
                        $s = '';
                        }
                        echo'<div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input class="form-check-input is_checked" name="owner_pro_doc_id[]" type="checkbox" value="'.$ds['owner_provide_doc_id'].'"'.$s.'>'.$doc_name.'
                        </label>
                        </div>';
                        } ?>
                        <button type="submit" class="btn btn-primary">Document Accepted</button>
                    </form>
                    <? if($doc_total == $doc_submited){ ?>
                    <form name="forwardForm" class="" id="forwardForm" role="form">

                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input is_checked" name="owner_pro_doc_id[]" type="checkbox" value=""> Forward to DMLC
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var request;

// Bind to the submit event of our form
    $("#docForm").submit(function (event) {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }

        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var serializedData = $('.is_checked:checked').serialize();

        console.log(serializedData);

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        //Call Loader before ajax send
        loader(2000);
        //Fire off the request to /form.php
        request = $.ajax({
            url: "<?php  echo base_url(); ?>    admin/change_doc_status",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            // Log a message to the console
            //console.log('response:'+response);
            //console.log('textStatus:'+textStatus);
            //console.log('jqXHR:'+jqXHR);
            var obj = jQuery.parseJSON(response);
            // if(obj.success){            
            //     $('.verify-code').show();
            // }
            if (obj.message.title != '') {
                tostAlert(response);
                window.setTimeout(function () {
                    window.location.reload(true);
                }, 1000);
            }

            // if(obj.message.login){
            //     window.setTimeout(function() {
            //         window.location.reload(true);
            //     }, 2000);
            // }        

        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                    );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    });

</script>