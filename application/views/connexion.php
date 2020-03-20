<html>
<head>
	<title>Connexion</title>
<link
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
	crossorigin="anonymous">
</head>
<body>

	<!-- AFFICHER LE MENU -->
<?php $this->load->view("Menu"); ?>




<body>
	<style>
.nav-link {
	color: white;
}

.bg-light {
	background-color: rgb(51, 153, 255) !important;
}
</style>


	<div id="container">
    <?php
        echo form_open('/ConnexionController/connexion');
    ?>
    	<label>Email : <input type="email" id="email" name="email" /></label>
		<label>Mot de passe : <input type="password" id="mdp" name="mdp" /></label>

		<input type="submit" name="connexion" value="se connecter" /><br>
           
    <?php
        echo form_close();
        echo $this->session->flashdata('unable_to_connect');
    ?>
    
    
    
    <?php echo form_open('MotDePasseOublieController/index'); ?>
    	<a href="./motdepasseoublie">Mot de passe oublié? </a>
    <?php form_close();?>
</div>

</body>
</html>