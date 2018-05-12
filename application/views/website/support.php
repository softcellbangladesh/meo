<div class="section service-page">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				
				<h4>OUR SUPPORT TEAM IS AVILABLE ON</h4>
				
				<p>Business Hour:<br>
				Saturdays to Thursday – 9:00 am to 6:00 pm <br>
				Closed on Fridays and Public Holidays.</p>

				<p>Email us # support@softcellbd.net<br>
				Call us # +88 02 9887717</p>


			</div>

			<div class="col-md-6">
				<div ng-if="!user.data.logged_in">
				<h4>Login for create a support ticket.</h4>
				<a href="#" title="Login">Click here</a>
			    </div>
			    <!-- <form role="form" accept-charset="utf-8">
			    	
			    </form> -->
			    <div ng-if="!!user.data.logged_in">We are updating our support application , thanks for being with us.</div>
			</div>
		</div>
	</div>
</div>