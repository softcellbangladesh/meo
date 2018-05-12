<div class="body-content">

<div class="section login-page">
	<div class="container">
		<div class="row">
			

			<div class="offset-3 col-6">
                <h3 class="text-center form-title">লগইন</h3>
				<form name="loginForm" class="form-horizontal" id="loginForm" role="form">
					<div class="form-group row">
                        <label for="" class="col-4 asterisk">Nid/Birth Certificate No </label>
                        <div class="col-8">
                            <span id="errorNid"></span>
                            <input id="nid" type="text" class="form-control" name="user_nid" placeholder="Nid/Birth Certificate No" required>
                            <span class="small asterisk-before"> Birth certificate no is only applicable for non-resident bangladesi</span>
                        </div>
                    </div>
                    <div class="verify-code">
                    <div class="form-group row">
                        <label for="" class="col-4 asterisk">Verification Code </label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="user_verification" placeholder="Verification Code">
                        </div>
                    </div>
                    </div>
					<!-- <div class="form-group">
						<a class="pull-left" href="<?php //echo base_url() ?>/login/forgotpassword" title="Forgot Password">Forgot Password ? </a>
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</div> -->
                    <div class="form-group row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
          
				</form>
                <div class="col-12">
                    * আপনার প্রথম আবেদন জন্য নিবন্ধন করুন ।
				    <a href="<?php echo base_url(); ?>registration"> এখানে ক্লিক করুন</a>
                </div>
			</div>
		</div>
	</div>
</div>

</div>

<script>

var request;

// Bind to the submit event of our form
$("#loginForm").submit(function(event){

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
        url: "<?php echo base_url();?>login/varify",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log('response:'+response);
        //console.log('textStatus:'+textStatus);
        //console.log('jqXHR:'+jqXHR);
        var obj = jQuery.parseJSON(response);
        if(obj.success){            
            $('.verify-code').show();
        }
        if(obj.message.title!=''){
           tostAlert(response);
        }

        if(obj.message.login){
            window.setTimeout(function() {
                window.location.reload(true);
            }, 2000);
        }        
        
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
        $('#nid').prop("readonly", true);
    });

});
</script>