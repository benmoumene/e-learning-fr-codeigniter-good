<?php $this->load->view("page_template/header"); 
?>

<div id="body" class="mbot">
    <card title="<?=($_SESSION['user'] === "admin") ? "Mes classes" : "" ?>">
    	
    	<div class="list-group mt-4">
    	                
        <div class="classesList">
        
        </div>
        <?php echo form_open("/ClassesController/createClasse");?>


        <center>
        <h5 class="mt-4">Créer une nouvelle classe</h5>
    	<div class="col-md-4 form-group mb-2">
              <label class="required" style="font-weight:bold">Nom de la classe</label>
              <input type="text" name="class_name" class="form-control" placeholder="L3 MIAGE APP">
      		  <input class="btn btn-primary mt-2" type="submit" value="Créer" /><br><br>
		</div>
        </center>

		<?php echo form_close();?>	   
    </card>
</div>

</div>
<script src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>



<?php $this->load->view("page_template/footer");?>
</body>
</html>