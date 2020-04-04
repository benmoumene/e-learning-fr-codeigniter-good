<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user = '';
$menuItems = ["connexion","publications", "enseignant", "contact"];

if (!is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = 'admin';
    $menuItems = ["deconnexion","cours", "acces","publications", "enseignant", "enseignements", "compte"];  
}
else if(!is_null(get_cookie('ux_e1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = "etudiant";
    $menuItems = ["deconnexion","publications", "enseignant", "enseignements", "contact", "compte"];
}
?>
<link rel="stylesheet" type="text/css" href="/projetL3/application/views/style/custom.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <div class="row" style="width: 100%;">
    <div class="col-12">
        <div class="row">
          <div class="col-2">
            <a class="navbar-brand" href="/projetL3/index.php/"><div id="logo-site"></div></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          </div>
        <div class="col-10" id="account">
            <div class="col-12">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style="width: 100%;">
					<?php foreach($menuItems as $n): ?>
						<menu-item nom="<?=$n?>"></menu-item>
					<?php endforeach;?>
                </ul>
              </div>
            </div>
        </div>
      </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<script src="/projetL3/application/views/custom_components.js"></script>