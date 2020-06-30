<?php $this->load->view("page_template/header"); ?>

<div id="body" class="mbot">
    <card title="<?=($_SESSION['user'] === "admin") ? "Mes classes" : "" ?>" style="width: 60%;margin: 20px auto">
    	
    	<div class="list-group mt-4">
    	                
    	  <?php foreach($classeList as $classe) :?>
          	
          	<list-item lien="" titre="<?=$classe->getNom()?>" description=""></list-item>
          	<?php if(sizeof($eleveList[$classe->getId()]) > 0) : ?>
                <?php foreach($eleveList[$classe->getId()] as $eleve) : ?>
                    <?php echo form_open("/ClassesController/removeEleve");?>
                    <div class="table-responsive">
          			<table class="table table-bordered table-dark">
                     <thead>
                        <tr>
                          <td><?=$eleve->getPrenom()?></td>
                          <td><?=$eleve->getNom()?></td>
                          <td><?=$eleve->getEmail()?></td>
                          <input type="text" name="eleve_id" value="<?=$eleve->getId()?>" hidden>
                          <td><button class="btn btn-danger col-md-6 col-sm-2" onclick="return confirm('Etes vous sur de vouloir supprimer cet etudiant?')"><i class="fa fa-trash" style="font-size:30px;"></i></button>
 						  </td>
                        </tr>
                      </thead>
                    </table>
                    </div>
               	<?php echo form_close();?>	
               	<?php endforeach;?>
               	
            <?php endif;?>
            <?php echo form_open("/ClassesController/removeClasse");?>
               	<button class="btn btn-danger mt-2 col-md-4 col-sm-2" onclick="return confirm('Etes vous sur de vouloir supprimer cette classe?')"><i class="fa fa-trash" style="font-size:30px;"></i> Supprimer la classe</button>
 				<input type="text" name="classe_id" value="<?=$classe->getId()?>" hidden>
                <hr>
            <?php echo form_close();?>
          <?php endforeach;?>
        
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