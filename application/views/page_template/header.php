<?php
$user = '';
$menuItems = ["connexion","publications", "enseignant", "contact"];

if (!is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = 'admin';
    $menuItems = ["compte", "cours", "acces","publications", "enseignant", "quiz", "classes", "deconnexion"];
}
else if(!is_null(get_cookie('ux_e1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = "etudiant";
    $menuItems = ["compte", "cours", "publications", "enseignant", "quiz", "contact", "deconnexion"];
}

$_SESSION['user'] = $user;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/projetL3/application/views/style/custom.css">
    <title>Site UX</title>








    <title>Site UX</title>
</head>

<body>
<!-- AFFICHER LE MENU -->
	<menu class="navbar  navbar-default navbar-light navbar-expand-lg mx-auto sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/projetL3/index.php/" style="font-style:abedia; color:#5799D7">SITE DE L'ENSEIGNANTE</a>
            <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" ></span>
            </button>
            <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
                <ul class="navbar-nav mt-2" style="width: 100%;">
                    <?php foreach($menuItems as $n): ?>
                        <menu-item nom="<?=$n?>"></menu-item>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </menu>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<script src="/projetL3/application/views/page_template/components_vuejs/menu_components.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.21.1/bootstrap-vue.min.js"></script>


