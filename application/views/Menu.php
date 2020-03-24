<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$user = '';
if (!is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = 'admin';
}
else if(!is_null(get_cookie('ux_e1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = "etudiant";
}

$menuItems = array('accueil');
if($user === ''){
    //utilisateur lamba 
    array_push($menuItems, 'contact', 'connexion');
} else if($user === 'etudiant'){
    //etudiant
    array_push($menuItems, 'contact', 'deconnexion', 'ELEVE CONNECTE','compte');
} else if($user === 'admin'){
    //enseignat
    array_push($menuItems, 'cours', 'acces','deconnexion', 'ADMIN CONNECTE', 'compte');
}
?>

<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-expand-sm bg-light justify-content-center">
	<ul class="nav">
    	<?php foreach($menuItems as $item): ?>
    		<menu-item nom="<?=$item?>"></menu-item>
    	<?php endforeach;?>
	</ul>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<script src="/projetL3/application/views/menu.js"></script>