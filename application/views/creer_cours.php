<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="fr">
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
    
    
     <p><?=$this->session->flashdata('cours_champ_required');?></p>  
</div>

	


</body>
</html>