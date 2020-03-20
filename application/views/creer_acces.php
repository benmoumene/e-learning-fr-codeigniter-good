<html>
<head>
<meta charset="UTF-8" />
<title>Donner accès aux élèves</title>
<link
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
	crossorigin="anonymous">
</head>
<body>

	<!-- AFFICHER LE MENU -->
<?php $this->load->view("Menu"); ?>

	<style>
.nav-link {
	color: white;
}

.bg-light {
	background-color: rgb(51, 153, 255) !important;
}
</style>


	<?php
echo form_open_multipart('/ExcelController/import');
?>
	<input type="file" id="id" name="file" />
	<br>
	<br>
	<input type="submit" name="import" value="importer" />
<?php
echo form_close();
?>

    <p><?=$this->session->flashdata('import_success');?></p>
</body>
</html>

