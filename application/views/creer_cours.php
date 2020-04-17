<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- AFFICHER LE MENU -->
<?php $this->load->view("page_template/header"); ?>

<center>
<div id="body">
    <card title="Créer un cours" style="width: 60%;margin: 20px auto">
	<?php echo form_open_multipart('/CoursController/creer_cours'); ?>		
    <div class="justify-content-md-center">
        <div class="col-md-4 form-group mb-2">
        	<label class="required" style="font-weight:bold">Nom du cours</label>
            <input type="text" id="nom_cours" name="nom_cours" placeholder="Nom du cours"/><br><br>
           	
           	<div class="form-group">
              <label for="exampleFormControlTextarea1" style="font-weight:bold">Description du cours</label>
              <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="5" name="description"></textarea>
            </div>
           
            <label style="font-weight:bold">Documents du cours</label>
        	<input type="file"  class="form-control" id="id" name="files[]" multiple="multiple"/><br>
        	
        	<label class="required" style="font-weight:bold">Classes</label><br>
        	<select name="classes_ids[]" multiple="multiple">
        		<?php foreach($classeList as $classe): ?>
        			<option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
        		<?php endforeach;?>
        	</select><br><br>
        	
        	<input class="btn btn-primary" type="submit" name="creer" value="Créer" /><br><br>
		</div>
	</div>
    	
    <?php echo form_close();?>
	</card>
</div>
</center>

<?php $this->load->view("page_template/footer");?>
<script>
Vue.use(VueToast);
if("<?=$this->session->flashdata('import')?>" === "Le cours a été crée sans documents" || ("<?=$this->session->flashdata('import')?>".includes("Le cours a été crée avec ") && "<?=$this->session->flashdata('import')?>".includes(" documents associés"))){
	Vue.$toast.success("<?=$this->session->flashdata('import');?>", {
	  position: 'top',
	  duration: 8000
	})
}	
else if("<?=$this->session->flashdata('cours_champ_required')?>" === "Veuillez saisir les champs requis"){
	Vue.$toast.error("<?=$this->session->flashdata('cours_champ_required');?>", {
		  position: 'top', 
		  duration: 8000
		})
}
else if("<?=$this->session->flashdata('import')?>" === "Les documents doivent être de type pdf"){
    Vue.$toast.error("<?=$this->session->flashdata('import');?>", {
	  position: 'top', 
	  duration: 8000
	})
} 

</script>


</body>
</html>