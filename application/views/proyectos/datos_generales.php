<!DOCTYPE html>
<html>
    <head>
    <br>
    <br>
    <meta charset="utf-8" />
	<title>Administracion Datos Generales- Sourcezilla</title>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
<center><h1>Administración de Datos Generales</h1></center>
    <div>
		<?php echo $output; ?>
                 <a href="<?php echo base_url();?>index.php/formato_legalizacion" class="btn btn-info" role="button">formato legalizacion</a>
                
                          
    </div>
</body>
</html>