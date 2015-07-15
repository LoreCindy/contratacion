<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

header("location: http://localhost:8080/PContratacion/index.php/example");
}
?>
<head>
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>
<body>
<?php
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}
?>


    <div id="main"></div>
<div id="login">
    
    <div class="login-img">
        
    </div>

<hr/>
 
<?php echo form_open('user_authentication/user_login_process'); ?>
<?php if (isset($error_message))
 {
echo "<div class='alert alert-danger'>";
echo $error_message;
echo "</div>";
}

if (isset($message_display)) {
echo "<div class='alert alert-success'>";
echo $message_display;
echo "</div>";
}


?>

<label>Usuario:</label>
<input type="text" name="username" id="name" placeholder="usuario" required/><br /><br />

<label>Password :</label>
<input type="password" name="password" id="password" placeholder="**********" required/><br/><br />
<input type="hidden" name="token" value="<?=$token?>" />
<input type="submit" value=" Entrar" name="submit"/><br />

<?php echo form_close(); ?>
 <a href="<?php echo site_url('user_authentication/user_registration_show'); ?>">Registrarse ahora</a>

</div>

</body>
</html>
