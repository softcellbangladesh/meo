<?php
$request = $this->user_model->get_table_data('request', array('curent_status' => 'Started'));
?>
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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Owner Name</th>
                                <th>Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
<?
$doc_total = 0;
foreach ($request as $re) {
    
    $doc_total = $this->user_model->count_where('owner_provide_doc', array('request_request_id' => $re['request_id']));

    $doc_submited = $this->user_model->count_where('owner_provide_doc', array('status' => '1', 'request_request_id' => $re['request_id']));

    $owner_name = $this->user_model->get_name('land_owner', array('land_owner_id' => $re['land_owner_land_owner_id']), 'land_owner_name');
    echo '  <tr>';
    echo'<td>' . $owner_name .'</td>';
    echo'<td>' . $doc_submited . '/' . $doc_total . '</td>';
    echo'<td><a class="btn-primary btn-sm" href="' . base_url() .'admin/startedrequestedit/' . $re['request_id'] . '">View/Update</a></td>';
    echo '<tr>';
}
?>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var request;

// Bind to the submit event of our form
    $("#statusForm").submit(function (event) {

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
        var serializedData = $form.serialize();

        console.log(serializedData);

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        //Call Loader before ajax send
        loader(2000);
        // Fire off the request to /form.php
        request = $.ajax({
            url: "<?php echo base_url(); ?>admin/change_status",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            // Log a message to the console
            console.log('response:' + response);
            //console.log('textStatus:'+textStatus);
            //console.log('jqXHR:'+jqXHR);
            var obj = jQuery.parseJSON(response);
            // if(obj.success){            
            //     $('.verify-code').show();
            // }
            if (obj.message.title != '') {
                tostAlert(response);
                // window.setTimeout(function() {
                //      window.location.reload(true);
                //  }, 2000);
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
            $('#nid').prop("readonly", true);
        });

    });

</script>