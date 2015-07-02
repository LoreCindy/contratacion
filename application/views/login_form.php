<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

header("location: http://localhost:8080/PContratacion/index.php/example");
}
?>
<head>
<title>Login Form</title>
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}
?>
<?php
if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}
?>
<div id="main">
<div id="login">
<h2>Inicio de Sesión</h2>
<hr/>
<?php echo form_open('user_authentication/user_login_process'); ?>
<?php
echo "<div class='error_msg'>";
if (isset($error_message)) {
echo $error_message;
}
echo validation_errors();
echo "</div>";
?>
<label>Usuario:</label>
<input type="text" name="username" id="name" placeholder="usuario"/><br /><br />
<label>Password :</label>
<input type="password" name="password" id="password" placeholder="**********"/><br/><br />
<input type="submit" value=" Entrar" name="submit"/><br />




<?php echo form_close(); ?>
</div>
    <a href="<?php echo site_url('registro_usuario'); ?>">Registrarme</a>
</div>
</body>
</html>
