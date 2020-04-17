<?php
$user = '';
$menuItems = ["connexion","publications", "enseignant", "contact"];

if (!is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = 'admin';
    $menuItems = ["compte", "cours", "acces","publications", "enseignant", "enseignements","deconnexion"];  
}
else if(!is_null(get_cookie('ux_e1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && !is_null(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
    $user = "etudiant";
    $menuItems = ["compte", "publications", "enseignant", "enseignements", "contact", "deconnexion"];
}

$_SESSION['user'] = $user;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/projetL3/application/views/style/custom.css">
    <title>Site UX</title>
</head>

<body>
<!-- AFFICHER LE MENU -->
	<menu class="navbar navbar-expand-lg navbar-light">
    	<?php foreach($menuItems as $n): ?>
    		<menu-item nom="<?=$n?>"></menu-item>
    	<?php endforeach;?>
    </menu> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<script src="/projetL3/application/views/page_template/components_vuejs/menu_components.js"></script>
