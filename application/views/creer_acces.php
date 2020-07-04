<?php $this->load->view("page_template/header"); 
	  echo form_open_multipart('/AccesController/import');
?>

<div id="body">
    <center>
	<card class="connexion mbot" title="Création des comptes pour les étudiants" >
		<div class="justify-content-md-center">
            <div class="col-md-4 form-group mb-2">
            	<label class="required" style="font-weight:bold">Classe</label>
            	<select name="classe_id">
            		<?php foreach($classeList as $classe): ?>
            			<option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
            		<?php endforeach;?>
            	</select><br><br>
            	
            	<label class="required" style="font-weight:bold">Fichier d'importation</label>
            	<input type="file" class="form-control" id="id" name="file" /><br><br>
               	
                <input class="btn btn-primary" type="submit" name="import" value="Importer" /><br><br>
			</div>
		</div>
            <p>Utilisez le fichier ci-dessous comme format pour importer les étudiants lors de la création d'une classe.</p>
            <a id="fichierImportation" href="/projetL3/uploads/modele_insertion/modele_importation.xlsx">
                <img height="100" alt="fichier d'importation" src="/projetL3/application/views/images/excel.jpg"/>
            </a>
    </card>
    </center>
</div>
	
<?php
echo form_close();
?>

<?php $this->load->view("page_template/footer");?> 

<script>
Vue.use(VueToast);
if("<?=$this->session->flashdata('import_success')?>" === "L'importation des élèves a été effectué."){
	Vue.$toast.success("<?=$this->session->flashdata('import_success');?>", {
	  position: 'top',
	  duration: 8000
	})
}	
else if("<?=$this->session->flashdata('import_success')?>" === "Veuillez sélectionner un fichier .xlsx" || "<?=$this->session->flashdata('import_success')?>" === "Veuillez vérifier la syntaxe du fichier d'importation." || "<?=$this->session->flashdata('import_success')?>" === "L'importation des élèves a échoué."){
    Vue.$toast.error("<?=$this->session->flashdata('import_success');?>", {
	  position: 'top', 
	  duration: 8000
	})
}

</script>
    
</body>
</html>

