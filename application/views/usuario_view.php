<html>
    
    <head>
    
        <meta charset="utf-8"/>
        <title></title>
        
    </head>
    
    <body>
   <h1> Iniciar sesión </h1>

<form>
    <label for="usuario">Usuario </label>
    <input type="text" name="user"/><br/>
    
    <label for="contraseña">Contraseña</label>
    <input type="password" name="pass"/><br/>
    
    <input type="submit" value="Entrar" name="submit"/>
    <a href="<?php echo site_url('registro_usuario'); ?>">Registrame</a>
    

</form>
    </body>
</html>

