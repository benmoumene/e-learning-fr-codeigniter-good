<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Site UX</title>
</head>

<!-- AFFICHER LE MENU -->
<?php $this->load->view("Menu"); ?>

<body>
	<style>
	
	.nav-link{
		color : white;
	}
	.bg-light {
		background-color: rgb(51, 153, 255)!important;
	}
</style>


<div id="container">
	<h1>Mon compte</h1>

	<div id="body">
		<?php echo form_open('/CompteController/hasChange');?>
		
		<label>Email : <input type="email" name="email">
		</label>
		<br>
		<input type="submit" name="modifier" value="modifier" /><br>
		
		<?php echo form_close();?>
	</div>
</div>

</body>
</html>