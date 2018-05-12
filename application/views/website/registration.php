<div class="body-content">
    <div class="section login-page">
       <div class="container">
          <div class="row">

<!-- <div class="btn-group" role="group" aria-label="..." ng-click="facebookRegistration()">
<button type="button" class="btn" style="background-color: #4864b3; color: #ffffff;"> <i class="fa fa-facebook"></i> | Login With Facebook </button>
</div> -->
<div class="offset-3 col-6">
    <h3 class="text-center form-title">নিবন্ধন</h3>
	<form name="registrationForm" class="form-horizontal" id="registrationForm" role="form" method="post" enctype="multipart/form-data">
		<div class="form-group row">
                    <label for="" class="col-4 asterisk">Full Name </label>
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
            <label for="" class="col-4 asterisk">Nid/Birth Certificate No </label>
            <div class="col-8">
                <span id="errorNid"></span>
                <input id="nid" type="text" class="form-control" name="user_nid" placeholder="Nid/Birth Certificate No" onblur="check_nid(this.value)" required>
                <span class="small">*Birth certificate no is only applicable for non-resident bangladesi</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-4 asterisk">Date of birth </label>
            <div class="col-8">
                <input type="date" class="form-control" name="user_dob" placeholder="Date of birth" required>
            </div>
        </div>

		<div class="form-group row">
			<label for="" class="col-4 asterisk">Email</label>
            <div class="col-8">
			<input type="email" class="form-control" name="user_email" placeholder="Email" email-available required>
            </div>
		</div>

		<div class="form-group row">
			<label for="" class="col-4 asterisk">Mobile No </label>
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
		        <button type="submit" class="btn btn-primary">Register</button>
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
$("#registrationForm").submit(function(event){

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
        url: "<?php echo base_url();?>welcome/create_user",
        type: "post",
        //data: serializedData,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async:false,
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //console.log('response:'+response);
        //console.log('textStatus:'+textStatus);
        //console.log('jqXHR:'+jqXHR);

        tostAlert(response);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
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

function check_nid(nid){

    $.post("<?php echo base_url();?>/welcome/check_nid", {nid: nid} , function(data)
            {           
               
               if (data != '' || data != undefined || data != null) 
               {
               if (data >= 1){
                  $('#errorNid').html('<font color="red">This Nid already exist!</font>');                 
                  $('#nid').val('');
               }
               else
                   $('#errorNid').html('');                  
                  
               }
            });
}

</script>