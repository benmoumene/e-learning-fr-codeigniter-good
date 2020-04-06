<?php $this->load->view("page_template/header"); ?>

<div class="card connexion" style="width: 60%;margin: 20px auto">
    <div class="card-body">
        
    	<?php
        echo form_open('/ConnexionController/connexion');
    	?>    

    <center>
    	  <h5 class="card-title">Se connecter</h5>
          <div class="justify-content-md-center">
            <div class="col-md-4 form-group mb-2">
              <input type="email" name="email" class="form-control" placeholder="Email (*)">
              <br>
              <input type="password" name="mdp" class="form-control" placeholder="Mot de passe (*)">
            </div>
            <?php echo form_open('MotDePasseOublieController/index'); ?>
                <a href="./motdepasseoublie">Mot de passe oubliée? </a>
            <?php form_close();?>
          </div>
          <br>
           <input class="btn btn-primary col-md-2 col-sm-2" type="submit" name="connexion" value="Connexion" />
    </center>  

    <?php
    echo form_close();
    echo $this->session->flashdata('unable_to_connect');
    ?>
    
</div>
</div>

<?php $this->load->view("page_template/footer");?>

</body>
</html>