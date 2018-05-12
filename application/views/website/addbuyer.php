<!-- <?php
$do = $this->user_model->get_unique_data('land_owner', 'dohs');
$dohs_options = '<option value="">Please select a DOHS</option>';

foreach ($do as $d) {
    $dohs_options.='<option value="' . $d['dohs'] . '">' . $d['dohs'] . '</option>';
}

$ro = $this->user_model->get_unique_data('land_owner', 'road_no');
$road_options = '<option value="">Please select a Road</option>';

foreach ($ro as $r) {
    $road_options.='<option value="' . $r['road_no'] . '">' . $r['road_no'] . '</option>';
}

$pl = $this->user_model->get_unique_data('land_owner', 'plot_no');
$plot_options = '<option value="">Please select a Plot</option>';

foreach ($pl as $p) {
    $plot_options.='<option value="' . $p['plot_no'] . '">' . $p['plot_no'] . '</option>';
}

$fl = $this->user_model->get_unique_data('land_owner', 'floor_no');
$floor_options = '<option value="">Please select a Floor</option>';

foreach ($fl as $f) {
    $floor_options.='<option value="' . $f['floor_no'] . '">' . $f['floor_no'] . '</option>';
}
?> -->

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
                            <li><a href="<?php echo base_url(); ?>request">Add Flat</a></li>
                            <li class="active"><a href="<?php echo base_url(); ?>buyer">Add Buyer</a></li>                
                            <li class="active"><a href="<?php echo base_url(); ?>primarydoc">Add Primary Document</a></li>
                            <li><a href="<?php echo base_url(); ?>document">Add document</a></li>
                            <li><!-- Link with dropdown items -->
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Request Status</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li><a href="#"> All Request</a></li>
                                    <li><a href="#"> Ongoing Request</a></li>
                                    <li><a href="#"> Success Request</a></li>
                                    <li><a href="#"> Failed Request</a></li>
                                </ul>
                            </li>			                
                            <li><a href="#">Message</a></li>
                        </ul>
                    </nav>       
                </div>
                <div class="offset-2 col-md-5">
                    <h3 class="text-center form-title">ক্রেতা</h3>
                    <form name="buyerForm" class="form-horizontal" id="buyerForm" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="" class="col-4">Full Name *</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="user_name" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-4">Rank</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="user_rank" placeholder="Rank">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-4">Service No</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="user_service_no" placeholder="Service No">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-4">Nid/Birth Certificate No *</label>
                            <div class="col-8">
                                <span id="errorNid"></span>
                                <input id="nid" type="text" class="form-control" name="user_nid" placeholder="Nid/Birth Certificate No" required>
                                <span class="small">*Birth certificate no is only applicable for non-resident bangladesi</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-4">Date of birth *</label>
                            <div class="col-8">
                                <input type="date" class="form-control" name="user_dob" placeholder="Date of birth" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-4">Email *</label>
                            <div class="col-8">
                                <input type="email" class="form-control" name="user_email" placeholder="Email" email-available required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-4">Mobile No *</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="user_phone" placeholder="Phone" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-4">Picture</label>
                            <div class="col-8">
                                <input id="file" type="file" class="form-control-file" name="user_picture" placeholder="Picture">
                            </div>
                        </div>


                        <!-- <div class="form-group row">
                                <label for="" class="col-4">Password *</label>
                        <div class="col-8">
                                <input type="password" class="form-control" name="user_password" placeholder="Password" minlength="4" required>
                        </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-4">

                            </div>
                            <div class="col-8">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var request;

// Bind to the submit event of our form
    $("#buyerForm").submit(function (event) {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        // Abort any pending request
        if (request) {
            request.abort();
        }

        // // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");
        //var $inputs = $(this).find("input, select, button, textarea");

        // Serialize the data in the form
        //var serializedData = $form.serialize();

        //console.log(serializedData);

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        //Call Loader before ajax send
        loader(3000);
        // Fire off the request to /form.php
        request = $.ajax({
            url: "<?php echo base_url(); ?>request/add_buyer",
            type: "post",
            //data: serializedData,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            // Log a message to the console
            //console.log('response:'+response);
            //console.log('textStatus:'+textStatus);
            //console.log('jqXHR:'+jqXHR);

            tostAlert(response);
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