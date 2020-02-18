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
	<h1>Bienvenu sur le site pour le cours UX!</h1>

	<div id="body">
		<p>Sur ce site vous trouverez toutes les ressources necessaires. Les cours seront disponibles sur ce site, vous pourrez egalemment deposer des documents...</p>
		
	</div>

	<p class="footer">Ce site est reserve au partage des ressources pour le cours UX</p>
</div>


</body>
</html>