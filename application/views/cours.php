<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$coursSelectionne = null;
if (isset($_GET['cours'])) {
    $coursSelectionne = $this->CoursDAO->getCoursById($_GET['cours']);
}
?>
<!-- AFFICHER LE MENU -->
<?php $this->load->view("page_template/header"); ?>

<center>
<div id="body" class="d-flex mt-2 mb-4 row">
	<card class="cours"
		title="<?=($_SESSION["user"] === "admin") ? "Les cours de l'enseignante" : "Mes cours" ?>">
		<div class="list-group mb-2">
			<?php if($_SESSION['user'] === 'admin'): ?>
			<list-item
    			lien="/projetL3/index.php/cours"
    			titre="Créer un cours" description=""
    			class="coursIntitule">
			</list-item>
			<?php endif;?>
			
            <?php foreach ($coursList as $cours): ?>
            <list-item
    			lien="/projetL3/index.php/cours?cours=<?=$cours['id']?>"
    			titre="<?=$cours['intitule']?>" description=""
    			class="coursIntitule">
			</list-item>	
            <?php endforeach;?>
		</div>
	</card>

    <card class = "cours btn-creercours" title="<?=(empty($_GET['cours']) && $_SESSION['user'] === 'admin') ? 'Créer un cours' : '' ?>">
	<div class="justify-content-md-center" >
        <?php if(empty($_GET["cours"]) && $_SESSION['user'] === 'admin'): ?>
		<?=form_open_multipart('/CoursController/creer_cours');?>

        <div class="row">
            <div class="col-md-6 form-group mb-2">
                <label class="required" style="font-weight:bold">Nom du cours</label>
                <input class="form-control" type="text" id="nom_cours" name="nom_cours" placeholder="Nom du cours"/><br><br>
            </div>
            <div class="col-md-6 form-group mb-2">
                <label for="exampleFormControlTextarea1" style="font-weight:bold">Description du cours</label>
                <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="5" name="description"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-2">
                <label style="font-weight:bold" class="required">Documents du cours</label>
                <input type="file"  class="form-control" id="id" name="files[]" multiple="multiple"/><br>
            </div>

            <div class="col-md-6 form-group mb-2">
                <label class="required" style="font-weight:bold">Classes</label><br>
                <select class="form-control" name="classes_ids[]" multiple="multiple">
                    <?php foreach($classeList as $classe): ?>
                        <option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
                    <?php endforeach;?>
                </select><br><br>
            </div>
        </div>


        	<input class="btn btn-primary" type="submit" name="creer" value="Créer" /><br><br>

		<?php echo form_close();?>	
		<?php endif;?>
        
        	
        	
        	<?php if(!empty($coursSelectionne)): ?>
			<p><?=$coursSelectionne['description']?></p>
			<?php if($_SESSION['user'] === 'admin'): ?>
    			
    			<?=form_open_multipart('/CoursController/addDocuments');?>
        			<br>
        			<input type="text" name="cours_id" value="<?=$_GET['cours']?>" hidden/>
        			<label style="font-weight:bold">Ajouter des documents</label>
            		<input type="file"  class="form-control" id="id" name="files[]" multiple="multiple"/><br>
            		
            		<input class="btn btn-primary" type="submit" name="add_documents" value="Ajouter" /><br><br>
    			<?php echo form_close();?>
    			
    			<?=form_open_multipart('/CoursController/modifyClasses');?>
    				<input type="text" name="cours_id" value="<?=$_GET['cours']?>" hidden/>
    				<label class="required" style="font-weight:bold">Classes</label><br>
                    <select class="form-control" name="classes_ids[]" multiple="multiple">
                        <?php foreach($classeList as $classe): ?>
                            <option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
                        <?php endforeach;?>
                    </select><br>
                    <input class="btn btn-primary" type="submit" name="modifyClasses" value="Modifier les classes" />
    			<?php echo form_close();?>
			<?php endif;?>
			
			<hr>
			<h4>Documents du cours</h4>
		<?php endif;?>

        <div class="documents mbot">
            <?php foreach($documents as $document):?>
                <?php if(isset($_GET['cours']) && $document['cours_id'] == $_GET['cours']): ?>
                    <div class="row">

                        <list-item lien="<?=$document["path"]?>"
                                   titre="<?=$document["nom"]?>" description=""
                                   class="ml-4 mr-4 col-md-6 col-sm-2 documentsCours<?=$document['cours_id']?>" target="_blank"></list-item>
                        <?php if($_SESSION['user'] === 'admin'): ?>
                        <?php echo form_open('/CoursController/removeDocument')?>
                        <input type="text" name="document_id" value="<?=$document["id"]?>" hidden>

                        <td><button class="btn btn-danger " title="Supprimer le fichier" onclick="return confirm('Etes vous sur de vouloir supprimer ce fichier?')"><i class="fa fa-trash" style="font-size:30px;"></i></button>
                        <?php endif;?>
                    </div>

                    <?php echo form_close();?>
                <?php endif;?>
            <?php endforeach;?>

            <?php if($_SESSION['user'] === 'admin' && isset($_GET['cours'])): ?>
                <?php echo form_open('/CoursController/removeCours');?>
                    <input type="text" value="<?=$_GET['cours']?>" name="cours_id" hidden/>
                    <hr>
                    <button class="mt-4 btn btn-danger deleteCours" title="Supprimer le cours" onclick="return confirm('Etes vous sur de vouloir supprimer ce cours?')">Supprimer le cours <i class="fa fa-trash" style="font-size:30px;"></i></button>
                <?php echo form_close();?>
            <?php endif;?>

        </div>
	</div>
    
	</card>
</div>
</center>

<?php $this->load->view("page_template/footer");?>
<script>
Vue.use(VueToast);
if(("<?=$this->session->flashdata('import')?>".includes("Le cours a été crée avec ") && "<?=$this->session->flashdata('import')?>".includes(" documents associés"))){
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

<script
	src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>

</body>
</html>