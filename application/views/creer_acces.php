<html>
<head>    
    <title> Donner accès à des élèves </title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<?php
		echo form_open_multipart('/ExcelController/import');
	?>
	<input type="file" id="id" name="file" /><br><br>
    <input type="submit" name="import" value="Import" />
<?php
echo form_close();
?>
</body>
</html>

