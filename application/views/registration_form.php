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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div id="login">
<h2>Registro Usuario</h2>
<hr/>
<?php

echo form_open('user_authentication/new_user_registration');
?>

 <div class="form-group">
    <label for="username" class="control-label">Usuario:</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="usuario" required>
  </div>

<div class="form-group">
    <label for="password" class="control-label">Contraseña :</label>
      <input type="password" data-minlength="6" class="form-control" name="password" id="password" placeholder="Password" required/>
      <span class="help-block">Minimum of 6 characters</span>
      
      <input type="password" class="form-control" name="passconf" id="passconf" data-match="#password" data-match-error="Whoops, these don't match" placeholder="Confirmar contraseña" required/>
      <?php if(validation_errors())
          echo "  <div class='alert alert-danger'>";
          echo validation_errors();
          echo"</div>"
      ?>
  
<input type='hidden' name='token' value='<?=$token?>'/>
<?php
echo form_submit('submit', 'Guardar');
echo form_close();
?>
<a href="<?php echo base_url() ?> ">Si ya te encuentras registrado clic aqui</a>
</div>
</body>
</html>