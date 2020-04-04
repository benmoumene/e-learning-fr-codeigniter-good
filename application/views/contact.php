<?php $this->load->view("header"); 
      echo form_open('/EmailController/send_mail');
?>
	<!--Section: Contact v.2-->
	<section class="mb-4">

	    <!--Section heading-->
	    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
	    <!--Section description-->
	    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
	        a matter of hours to help you.</p>

	    <div class="row justify-content-md-center">

	        <!--Grid column-->
	        <div class="col-md-9 mb-md-0 mb-5">
	            <?php
					
					echo form_open('/EmailController/send_mail');
				?>

	                <!--Grid row-->
	                <div class="row">

	                    <!--Grid column-->
	                    <div class="col-md-6">
	                        <div class="md-form mb-2">
	                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom (*)">
	                        </div>
	                    </div>
	                    <!--Grid column-->

	                    <!--Grid column-->
	                    <div class="col-md-6">
	                        <div class="md-form mb-4">
	                            <input type="text" id="email" name="email" class="form-control" placeholder="Votre email (*)">
	                        </div>
	                    </div>
	                    <!--Grid column-->

	                </div>
	                <!--Grid row-->
	                <!--Grid row-->
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="md-form mb-4">
	                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Titre (*)">
	                        </div>
	                    </div>
	                </div>
	                <!--Grid row-->

	                <!--Grid row-->
	                <div class="row">

	                    <!--Grid column-->
	                    <div class="col-md-12">

	                        <div class="md-form mb-4">
	                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" placeholder="Votre message (*)"></textarea>
	                        </div>

	                    </div>
	                </div>
	                <!--Grid row-->

	            <center>
		            <div>
		                <input class="btn btn-primary" type = "submit" value = "SEND MAIL">
		            </div>
	            </center>
	            <div class="status"></div>
	        </div>
	        <!--Grid column-->
	    </div>

	</section>
	<!--Section: Contact v.2-->
<?php
echo form_close();
echo $this->session->flashdata('email_sent');
?>
</body>
</html>

