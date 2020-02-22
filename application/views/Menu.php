<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="navbar navbar-expand-sm bg-light justify-content-center">
<ul class="nav">
<li class="nav-item">
<a class="nav-link active" href="/projetL3/index.php">Accueil</a>
</li>

<?php if (!is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))) : ?>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/cours">Creer un cours</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/acces">Donner acces</a>
  </li>
  <?php endif;?>
  
  <?php if (is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))) : ?>
  <li class="nav-item">
    <a class="nav-link" href="/projetL3/index.php/email">Contact</a>
  </li>
  <?php endif;?>
  
  <?php if (is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))) : ?>
      <li class="nav-item">
        <a class="nav-link" href="/projetL3/index.php/connexion">Connexion</a>
      </li>
  <?php endif;?>
  <?php if (!is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))) : ?>
      <li class="nav-item">
        <a class="nav-link" href="/projetL3/index.php/deconnexion">Se deconnecter</a>
      </li>
      <li class="nav-item">
        ADMIN CONNECTE
      </li>
  <?php endif;?>
</ul>
</nav>