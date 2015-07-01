<!DOCTYPE html>
<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
//$email = ($this->session->userdata['logged_in']['email']);
} else {
header("location: login");
}

?>
<head>
	<meta charset="utf-8" />
	<title>Administracion Proyectos - Sourcezilla</title>
        <button onclick="location.href='logout'">Logout</button>
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
<center><h1>Administración de Proyectos</h1></center>
    <div>
		<?php echo $output; ?>
       
       
    </div>
</body>
</html>

