<?php $this->load->view("header"); 
	  echo form_open_multipart('/ExcelController/import');
?>
	<div class="card connexion" style="width: 60%;margin: 20px auto">
    	<div class="card-body">
        	<center>
            		<h5 class="card-title mb-4">Création des comptes pour les étudiants</h5>
                <div class="justify-content-md-center">
                    <div class="col-md-4 form-group mb-2">
                    	<label class="required" style="font-weight:bold">Fichier d'importation</label>
                    	<input type="file" class="form-control" id="id" name="file" /><br><br>
                       	
                        <input class="btn btn-primary" type="submit" name="import" value="Importer" /><br><br>
        			</div>
        		</div>
        	</center>
        </div>
        <center>
        	<p>Le fichier d'importation est un fichier excel(.xslx), le modèle est disponible dans la rubrique compte</p>
    	</center>
    </div>
	
	
	<p><?=$this->session->flashdata('import_success');?></p>
<?php
echo form_close();
?>

      
</body>
</html>

