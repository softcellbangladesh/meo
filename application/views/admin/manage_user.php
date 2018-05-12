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
                            <li class="active"><a href="<?php echo base_url(); ?>admin">Manage User</a></li>
                            <li><!-- Link with dropdown items -->
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Manage Request</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li><a href="<?php echo base_url(); ?>admin/startedrequest"> Srarted Request</a></li>
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
                    <? foreach($land_owner as  $lo){ ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Info Type</th>
                                <th>Info Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><? echo $lo['land_owner_name'];?></td>
                            </tr>
                            <tr>
                                <td>Rank</td>
                                <td><? echo $lo['rank'];?></td>
                            </tr>
                            <tr>
                                <td>Defence Id</td>
                                <td><? echo $lo['defence_id'];?></td>
                            </tr>
                            <tr>
                                <td>Nid/Birth Certificate No</td>
                                <td><? echo $lo['nid'];?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><? echo $lo['email'];?></td>
                            </tr>
                            <tr>
                                <td>DOHS</td>
                                <td><? echo $lo['dohs'];?></td>
                            </tr>
                            <tr>
                                <td>Road</td>
                                <td><? echo $lo['road_no'];?></td>
                            </tr>
                            <tr>
                                <td>Plot</td>
                                <td><? echo $lo['plot_no'];?></td>
                            </tr>
                            <tr>
                                <td>Floor</td>
                                <td><? echo $lo['floor_no'];?></td>
                            </tr>
                            <tr>
                                <td>Flat</td>
                                <td><? echo $lo['flat_no'];?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <? if($lo['is_active']==0){
                                    echo "Inactive";}
                                    else if($lo['is_active']==1){
                                    echo "Active";}
                                    else if($lo['is_active']==2){
                                    echo "Reg. Wrong";}
                                    else if($lo['is_active']==3){
                                    echo "Land Wrong";}
                                    else if($lo['is_active']==4){
                                    echo "Complete";
                                    }
                                    ?>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <form name="statusForm" class="form-inline" id="statusForm" role="form">
                        <div class="form-group">
                            <label for="is_active">Status: </label>
                            <select class="form-control" name="is_active" id="is_active" required="true">
                                <option value="">Select Status</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                                <option value="2">Reg. Wrong</option>
                                <option value="3">Land Wrong</option>
                                <option value="4">Complete</option>
                            </select>
                            <input hidden="true" name="land_owner_id" value="<? echo $lo['land_owner_id'];?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Change Status</button>							
                    </form>
                    <?}?>
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