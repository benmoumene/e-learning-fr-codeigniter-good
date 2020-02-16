<html>
<head>    
    <title> Donner accès à des élèves </title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light justify-content-center">
  <ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" href="../index.php">Accueil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../index.php/cours">Creer un cours</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../index.php/acces">Donner acces</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../index.php/email">Contact</a>
  </li>
</ul>
</nav>
<body>
	<style>
	
	.nav-link{
		color : white;
	}
	.bg-light {
		background-color: rgb(51, 153, 255)!important;
	}
</style>


	<?php
		echo form_open_multipart('/ExcelController/import');
	?>
	<input type="file" id="id" name="file" /><br><br>
    <input type="submit" name="import" value="importer" />
<?php
echo form_close();
?>
</body>
</html>

