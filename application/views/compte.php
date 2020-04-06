<?php $this->load->view("page_template/header"); ?>
<div class="card" style="width: 60%;margin: 20px auto">
    <div class="card-body">
		<?php echo form_open('/CompteController/hasChange');?>
		<center>
    	<h5 class="card-title">Mon compte</h5>
    		<div class="justify-content-md-center">
                <div class="col-md-4 form-group mb-2">
            		<label style="font-weight:bold">Email</label> 
            		<input type="email" class="form-control"name="email"><br>
            		<input class="btn btn-primary" type="submit" name="modifier" value="Modifier" /><br><br>
    			</div>
    		</div>
		</center>
		
		<?php if($_SESSION['user'] == 'admin'): ?>
    		<a id="fichierImportation" href="/projetL3/uploads/modele_insertion/modele_importation.xlsx">
    			<img height="100" alt="fichier d'importation" src="/projetL3/application/views/images/excel.jpg"/>
    		</a>
		<?php endif;?>
		
		<?php echo form_close();?>
</div>
</div>

</body>

<?php $this->load->view("page_template/footer");?>
</html>