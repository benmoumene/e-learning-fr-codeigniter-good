<?php $this->load->view("header"); ?>
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
		<?php echo form_close();?>
</div>

</body>
</html>