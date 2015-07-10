<html>

<head>
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<style>
    
div{
    
    background-color: #FAF1F1;
}

body{
    background-image:url("assets/fondo.jpg");
     background-color: #8195F5
}

</style>
</head>
<body>
<div id="profile">
<?php
//echo "Hello <b id='welcome'><i>" . $username . "</i> !</b>";
echo "<br/>";
echo "<br/>";
echo "Welcome to Admin Page";
echo "<br/>";
echo "<br/>";
//echo "Your Username is " . $username;
echo "<br/>";
//echo "Your Email is " . $email;
echo "<br/>";
?>
<b id="logout"><a href="logout">Logout</a></b>
</div>
<br/>
</body>
</html>