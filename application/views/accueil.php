<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Site UX</title>
</head>


<nav class="navbar navbar-expand-sm bg-light justify-content-center">
  <ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" href="#">Accueil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php/schema">Génération base de données</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php/acces">Donner accès</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php/email">Contact</a>
  </li>
</ul>
</nav>

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
		<p>Sur ce site vous trouverez toutes les ressources nécessaires. Les cours seront disponibles sur ce site, vous pourrez égalemment déposer des documents...</p>
		<ul>
		<?php foreach($data as $row) : ?>
			<li><?=$row['message']?></li>
		<?php endforeach;?>
		</ul>
	</div>

	<p class="footer">Ce site est réservé à partager des ressources pour le cours UX</p>
</div>




</body>
</html>