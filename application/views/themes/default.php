<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
//$email = ($this->session->userdata['logged_in']['email']);
} else {
header("location: proyecto");
}
?>
<html lang="en">
	<head>
                     
          <title><?php echo $title; ?></title>
		<meta name="resource-type" content="document" />
		<meta name="robots" content="all, index, follow"/>
	<meta name="googlebot" content="all, index, follow" />
	<?php
	/** -- Copy from here -- */
        
	if(!empty($meta))
	foreach($meta as $name=>$content){
		echo "\n\t\t";
		?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
			 }
	echo "\n";

	if(!empty($canonical))
	{
		echo "\n\t\t";
		?><link rel="canonical" href="<?php echo $canonical?>" /><?php

	}
	echo "\n\t";
     
	foreach($css as $file){
	 	echo "\n\t\t";
		?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	} echo "\n\t";

	foreach($js as $file){
			echo "\n\t\t";
			?><script src="<?php echo $file; ?>"></script><?php
	} echo "\n\t";

	/** -- to here -- */
?>

    <!-- Le styles -->
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap-dropdown.js" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/general.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/custom.css" rel="stylesheet">
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/gober.png" type="image/x-icon"/>
    <meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png"/>
    <link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />
    <style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
                background-color: #A1C9A4;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #0B0B0B;
		background-color: transparent;
		font-weight: normal;
                font-size: 17;
             
	}

	h1 {
		color: #090909;
		background-color: transparent;
		border-bottom: 1px solid #0C0C0C;
		font-size: 20px;
		font-weight: normal;
		margin: 0 0 16px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #6EEE7D;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
                
                
                
                
            
	}

	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #1F2120;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container{
		margin: 10px;
		border: 1px solid #6EEE7D;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
        
        
        
      
     

#column-left {
    background-color: #EBE9EA;
    border: 1px solid #D2D2D2;
    border-radius: 8px 8px 8px 8px;
    float: left;
    position: fixed;
    min-height: 225px;
    margin-bottom: 10px;
    margin-right: 10px;
    overflow: hidden;
    text-align: center;
    width: 200px;
}

#central {
  
    border-radius: 8px 8px 8px 8px;
    float: top;
    margin-top: 10px;
   
    
}
	</style>

</head>

  <body>

   <div id="central">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
            <br>
          <img src="<?php echo base_url(); ?>assets/themes/default/images/gober.png" style="float:left;margin-top:5px;z-index:5" alt="logo"/>
          <a class="brand" href="<?php echo site_url('welcome'); ?>">&nbsp;&nbsp;Contratación</a>
          <div style="height: 0px;" class="nav-collapse collapse">
            <ul class="nav">
            
                <li><a href="<?php echo site_url('proyectos'); ?>">Proyecto</a></li>
                <li><a href="<?php echo site_url('formato_lista'); ?>">Formato Lista</a></li>
                <li><a href="<?php echo site_url('revision'); ?>">Revision</a></li>
                <li><a href="<?php echo site_url('documento'); ?>">Documento</a></li>
                <li><a href="<?php echo site_url('fecha'); ?>">Fecha</a></li>
                <li><a href="<?php echo site_url('garantia'); ?>">Garantia</a></li>

            </ul>
           <DIV ALIGN=right><b id="logout"><a href="<?php echo site_url('user_authentication/logout')?>"><font color="White" size="3"> Cerrar Sesión</font></a></b></li></DIV>
          </div><!--/.nav-collapse -->
        </div>
          <?php
          echo "  <DIV ALIGN=right>Bienvenid@ <b id='welcome'><i>" . $username . "</i> !</b>";
          ?>
        </div>
      </div>
    </div>

    <div class="container">
    <?php if($this->load->get_section('text_header') != '') { ?>
    	<h1><?php echo $this->load->get_section('text_header');?></h1>
    <?php }?>
     
    <div class="row">
                <?php echo $output;?>
		<?php echo $this->load->get_section('sidebar'); ?>
    </div>
      <hr/>

      <footer>
      	<div class="row">
	        <div class="span6 b10">
                     Copyright &copy; <a target="black" href="" >C&C</a> | <a target="_blank" href="http://www.web-and-development.com">www.web-and-development.com</a>
                    </div>
        </div>
      </footer>

    </div> <!-- /container -->
   
</body></html>
