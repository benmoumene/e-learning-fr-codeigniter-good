<?php $this->load->view("page_template/header"); ?>

<center>
    <div id="body">
        <card class="connexion" title="Se connecter" >
        	<?php
            echo form_open('/ConnexionController/connexion');
        	?>    
          <div class="justify-content-md-center">
            <div class="col-md-4 form-group mb-2">
              <input type="email" name="email" class="form-control" placeholder="Email (*)">
              <br>
              <input type="password" name="password" class="form-control" placeholder="Mot de passe (*)">
            </div>
            <?php echo form_open('MotDePasseOublieController/index'); ?>
                <a href="./motdepasseoublie">Mot de passe oubliée? </a>
            <?php form_close();?>
          </div>
          <br>
           <input class="btn btn-primary col-md-2 col-sm-2" type="submit" name="connexion" value="Connexion" />
        
            <?php
            echo form_close();
            ?>
        </card>
    </div>
</center>

<?php $this->load->view("page_template/footer");?>

<script>
Vue.use(VueToast);
Vue.$toast.error('<?=$_SESSION['unable_to_connect']?>', {
	  position: 'top',
	  duration: 8000	  
})
</script>
</body>
</html>