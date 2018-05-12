<?php
	
	$do	= $this->user_model->get_unique_data('land_owner','dohs');
	$dohs_options='<option value="">Please select a DOHS</option>';	  

	foreach($do as $d){ 
		$dohs_options.='<option value="'.$d['dohs'].'">'.$d['dohs'].'</option>';
	}

	$ro	= $this->user_model->get_unique_data('land_owner','road_no');
	$road_options='<option value="">Please select a Road</option>';	  

	foreach($ro as $r){ 
		$road_options.='<option value="'.$r['road_no'].'">'.$r['road_no'].'</option>';
	}

	$pl	= $this->user_model->get_unique_data('land_owner','plot_no');
	$plot_options='<option value="">Please select a Plot</option>';	  

	foreach($pl as $p){ 
		$plot_options.='<option value="'.$p['plot_no'].'">'.$p['plot_no'].'</option>';
	}

	$fl	= $this->user_model->get_unique_data('land_owner','floor_no');
	$floor_options='<option value="">Please select a Floor</option>';	  

	foreach($fl as $f){ 
		$floor_options.='<option value="'.$f['floor_no'].'">'.$f['floor_no'].'</option>';
	}

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
			                <li class="active"><a href="<?php echo base_url(); ?>request">Add Flat</a></li>
			                <li><a href="<?php echo base_url(); ?>buyer">Add Buyer</a></li>
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
					<h3 class="text-center form-title">আবেদন</h3>
					<form name="rquestForm" class="form-horizontal" id="rquestForm" role="form" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="dohs" class="col-4">DOHS *</label>
				            <div class="col-8">
							    <select name="dohs" id="dohs" class="form-control" required="true">
											<?php echo $dohs_options;?>
								</select>
				            </div>
						</div>

				        <div class="form-group row">
				            <label for="road_no" class="col-4">Road *</label>
				            <div class="col-8">
				                <select name="road_no" id="road_no" class="form-control" required="true">
											<?php echo $road_options;?>
								</select>
				            </div>
				        </div>

				        <div class="form-group row">
				            <label for="plot_no" class="col-4">Plot *</label>
				            <div class="col-8">
				            	<select name="plot_no" id="plot_no" class="form-control" required="true">
											<?php echo $plot_options;?>
								</select>
				            </div>
				        </div>


				        <div class="form-group row">
				            <label for="floor_no" class="col-4">Floor</label>
				            <div class="col-8">
				                <select name="floor_no" id="floor_no" class="form-control">
											<?php echo $floor_options;?>
								</select>
				            </div>
				        </div>

						<div class="form-group row">
							<label for="flat_no" class="col-4">Flat</label>
				            <div class="col-8">
							<input type="text" class="form-control" name="flat_no" id="flat_no" placeholder="Flat No">
				            </div>
						</div>

				        <div class="form-group row">
				            <div class="col-4">
				                
				            </div>
				            <div class="col-8">
						        <button type="submit" class="btn btn-primary">Request</button>
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
$("#rquestForm").submit(function(event){

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
        url: "<?php echo base_url();?>request/request",
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
        // if(obj.success){            
        //     $('.verify-code').show();
        // }
        if(obj.message.title!=''){
        	tostAlert(response);
        }

        // if(obj.message.login){
        //     window.setTimeout(function() {
        //         window.location.reload(true);
        //     }, 2000);
        // }        
        
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