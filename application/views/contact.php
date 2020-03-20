<html>
<head>
<title>Contact</title>
<link
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
	crossorigin="anonymous">
</head>
<body>

	<!-- AFFICHER LE MENU -->
<?php $this->load->view("Menu"); ?>




<body>
	<style>
.nav-link {
	color: white;
}

.bg-light {
	background-color: rgb(51, 153, 255) !important;
}
</style>


	<?php
echo form_open('/EmailController/send_mail');
?>
	<!--Section: Contact v.2-->
	<section class="mb-4">

		<!--Section heading-->
		<h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
		<!--Section description-->
		<p class="text-center w-responsive mx-auto mb-5">Do you have any
			questions? Please do not hesitate to contact us directly. Our team
			will come back to you within a matter of hours to help you.</p>

		<div class="row">

			<!--Grid column-->
			<div class="col-md-9 mb-md-0 mb-5">
	            <?php

            echo form_open('/EmailController/send_mail');
            ?>

	                <!--Grid row-->
				<div class="row">

					<!--Grid column-->
					<div class="col-md-6">
						<div class="md-form mb-0">
							<input type="text" id="name" name="name" class="form-control"> <label
								for="name" class="">Your name</label>
						</div>
					</div>
					<!--Grid column-->

					<!--Grid column-->
					<div class="col-md-6">
						<div class="md-form mb-0">
							<input type="text" id="email" name="email" class="form-control">
							<label for="email" class="">Your email</label>
						</div>
					</div>
					<!--Grid column-->

				</div>
				<!--Grid row-->

				<!--Grid row-->
				<div class="row">
					<div class="col-md-12">
						<div class="md-form mb-0">
							<input type="text" id="subject" name="subject"
								class="form-control"> <label for="subject" class="">Subject</label>
						</div>
					</div>
				</div>
				<!--Grid row-->

				<!--Grid row-->
				<div class="row">

					<!--Grid column-->
					<div class="col-md-12">

						<div class="md-form">
							<textarea type="text" id="message" name="message" rows="2"
								class="form-control md-textarea"></textarea>
							<label for="message">Your message</label>
						</div>

					</div>
				</div>
				<!--Grid row-->

				<div class="text-center text-md-left">
					<input type="submit" value="SEND MAIL">
				</div>
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

