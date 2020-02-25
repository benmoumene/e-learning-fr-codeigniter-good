<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$user = '';
if (!is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = 'admin';
}
else if(!is_null(get_cookie('ux_e1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = "etudiant";
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-expand-sm bg-light justify-content-center">
<ul class="nav">
<li class="nav-item">
<a class="nav-link active" href="/projetL3/index.php">Accueil</a>
</li>

<?php if($user == 'admin') : ?>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/cours">Creer un cours</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/acces">Donner acces</a>
  </li>
<?php endif;?>
  
<?php if ($user == '' || $user == 'etudiant') : ?>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/email">Contact</a>
  </li>
<?php endif;?>
  
<?php if ($user == '') : ?>
      <li class="nav-item">
        <a class="nav-link" href="/projetL3/index.php/connexion">Connexion</a>
      </li>
<?php endif;?>
<?php if ($user == 'admin' || $user == 'etudiant') : ?>
      <li class="nav-item">
        <a class="nav-link" href="/projetL3/index.php/deconnexion">Se deconnecter</a>
      </li>
<?php endif;?>
  <?php if($user == 'admin') :?>
      <li class="nav-item">
        ADMIN CONNECTE
      </li>
  <?php endif;?>  
  <?php if($user == 'etudiant') :?>
      <li class="nav-item">
        ELEVE CONNECTE
      </li>
  <?php endif;?>  
 
  <?php if($user == 'etudiant' || $user == 'admin'): ?>
 	<li style="margin-left: 30px;">
 		<a class="nav-link" href="/projetL3/index.php/compte"><i class="nav-item fa fa-user-circle-o" style="font-size:34px"></i></a>
 	</li> 
  <?php endif;?>
  
</ul>
</nav>