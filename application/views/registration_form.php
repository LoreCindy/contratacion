<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
header("location: http://localhost:8080/PContratacion/index.php/user_authentication/user_login_process");
}
?>
<head>
<title>Registration Form</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="main">
<div id="login">
<h2>Registro Usuario</h2>
<hr/>
<?php

echo form_open('user_authentication/new_user_registration');

echo form_label('Usuario: ');
echo"<br/>";
echo form_input('username');
echo form_error('username');


echo"<br/>";
echo"<br/>";
echo form_label('Contraseña : ');
echo"<br/>";
echo form_password('password');
echo form_error('password');
echo"<br/>";
echo"<br/>";
echo form_label('Confirmar contraseña: ');
echo"<br/>";
echo form_password('passconf');

echo form_error('passconf');
echo"<br/>";
echo"<br/>";
?>
<input type='hidden' name='token' value='<?=$token?>'/>
<?php
echo form_submit('submit', 'Guardar');
echo form_close();
?>
<a href="<?php echo base_url() ?> ">Si ya te encuentras registrado clic aqui</a>
</div>
</div>
</body>
</html>