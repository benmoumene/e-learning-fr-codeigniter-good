<?php $this->load->view("header"); ?>

<div class="card connexion" style="width: 60%;margin: 20px auto">
    <div class="card-body">
        
	<?php
        echo form_open('/MotDePasseOublieController/send_password');
    	?>
    <center>	
    	<div col-md-4 form-group mb-2>
    		<h5 class="card-title">Mot de passe oublié ?</h5>
    		<input type="email" class="form-control" style="width: 30%;" id="email" name="email" placeholder="Email (*)"/><br>
    	 	<input class="btn btn-primary" type="submit" name="connexion" value="Envoyer mot de passe" /><br><br>
    		<span style="color:red;"><?= $this->session->flashdata('envoie_mdp');?></span>
    	</div>
	</center>
	<?php echo  form_close();?>
	</div>
</div>

</body>
</html>