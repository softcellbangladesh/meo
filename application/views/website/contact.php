<div class="section news-page">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h3>Address:</h3>
				<p><i class="fa fa-map-marker" aria-hidden="true"></i> Suite-1B, House-58, Road-7A, Block-H, Banani.<br>Dhaka 1213, Bangladesh.<p>
				<p><i class="fa fa-phone" aria-hidden="true"></i> Phone: +88 02 9887717</p>
				<p><i class="fa fa-envelope" aria-hidden="true"></i> Email: info@softcellbd.net</p>
				<p><i class="fa fa-globe" aria-hidden="true"></i> Web: www.softcellbd.net</p>
				<h3>Business Hour:</h3>
				<p><i class="fa fa-clock-o" aria-hidden="true"></i> Saturdays&nbsp;to Thursday – 9:00 am to 6:00 pm<br>Closed on Fridays, and Public Holidays</p>
			</div>

			<div class="col-md-8">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.8225417630233!2d90.40654371440874!3d23.789332793206054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c70b7432c3ab%3A0x23ca9c16b1a65e1b!2sSoftecell+Solution+Ltd!5e0!3m2!1sen!2sbd!4v1512649323205" class="contact-map" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 contact-margin-top">
				<form name="contactForm" ng-submit="contactSubmit(contact)" class="well form-horizontal" role="form">
					<fieldset>

						<!-- Form Name -->
						<h3 class="contact-title text-center">Contact Us Now!</h3>

						<!-- Text input-->

						<div class="form-group">
							<!-- <label class="col-md-4 control-label">Name *</label>   -->
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="name" placeholder="Name" class="form-control" ng-model="contact.name" type="text" required>									
								</div>
								<span class="label label-danger" ng-if="contact.name.$invalid && contact.name.$dirty">Required</span>
							</div>

							<!-- <label class="col-md-4 control-label">E-Mail *</label>  --> 
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input name="email" placeholder="E-Mail Address" class="form-control" ng-model="contact.email"  type="email" required>									
								</div>
								<span class="label label-danger" ng-if="contact.email.$invalid && contact.email.$dirty">Required</span>
							</div>
						</div>

						<!-- Text input-->
						<!-- <div class="form-group">
							
						</div> -->


						<!-- Text input-->

						<div class="form-group">
							<!-- <label class="col-md-4 control-label">Phone #</label>   -->
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
									<input name="phone" placeholder="Cell Number" class="form-control" ng-model="contact.phone" type="text">
								</div>
							</div>

							<!-- <label class="col-md-4 control-label">Address</label> -->  
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
									<input name="address" placeholder="Address" class="form-control" ng-model="contact.address" type="text">
								</div>
								<span class="label label-danger" ng-if="contact.message.$invalid && contact.message.$dirty">Required</span>
							</div>
						</div>

						<!-- Text input-->

						<!-- <div class="form-group">
							
						</div> -->

						
						<!-- Text area -->

						<div class="form-group">
							<!-- <label class="col-md-4 control-label">Message</label> -->
							<div class="col-md-12 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
									<textarea class="form-control" name="message" placeholder="Your Message" ng-model="contact.message" required></textarea>									
								</div>
							</div>
						</div>

						<!-- Success message -->
						<div class="alert alert-success hide_message alert-dismissable" role="alert" id="contact_success_message">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

						<!-- Success message -->
						<div class="alert alert-danger hide_message alert-dismissable" role="alert" id="contact_danger_message">
    					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							Sending Error <i class="glyphicon glyphicon-warning-sign"></i> Please try again later or you can direct email us to info@softcellbd.net</div>

						<!-- Button -->
						<div class="form-group">
							<!-- <label class="col-md-4 control-label"></label> -->
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary" ng-disabled="contactForm.$invalid || contactForm.$pristine">Send <span class="glyphicon glyphicon-send"></span></button>
							</div>
						</div>

					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
</div>