<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Site UX</title>
</head>


<nav class="navbar navbar-expand-sm bg-light justify-content-center">
  <ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" href="<?= "/projetL3/index.php";?>">Accueil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/cours">Creer un cours</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/acces">Donner acces</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/email">Contact</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/connexion">Connexion</a>
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
    <?php
    		echo form_open_multipart('/CoursController/creer_cours');
    	?>
    	<h4>nom du cours</h4><br>
        	<input type="text" id="nom_cours" name="nom_cours" />
            
            
		<h4>Documents du cours</h4><br>
    	<input type="file" id="id" name="files[]" multiple="multiple"/><br><br>
    	<input type="submit" name="creer" value="creer le cours" /><br><br>
    <?php
    echo form_close();
    ?>
    
    
    
</div>




</body>
</html>