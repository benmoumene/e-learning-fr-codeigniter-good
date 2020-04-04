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


<div class="card connexion" style="width: 60%;margin: 20px auto">
    <div class="card-body">
<?php
    		echo form_open_multipart('/CoursController/creer_cours');
    	?>
    	<center>
    		<h5 class="card-title mb-4">Créer un cours</h5>
        <div class="justify-content-md-center">
            <div class="col-md-4 form-group mb-2">
            	<label class="required" style="font-weight:bold">Nom du cours</label>
                <input type="text" id="nom_cours" name="nom_cours" placeholder="Nom du cours"/><br><br>
                <label style="font-weight:bold">Documents du cours</label>
            	<input type="file"  class="form-control" id="id" name="files[]" multiple="multiple"/><br>
            	<input class="btn btn-primary" type="submit" name="creer" value="Créer" /><br><br>
    		</div>
    	</div>
    	
    	 <p><?=$this->session->flashdata('cours_champ_required');?></p>  
    	<?php 
    	   echo $this->session->flashdata('import');
    	?>
    	</center>
    	
    	
    <?php
    echo form_close();
    ?>
    
</div>
</div>

</body>
</html>