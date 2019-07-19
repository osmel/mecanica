<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $this->session->userdata('c2'); ?></title>
	<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>-->
    
      <meta property="og:url" content="https://www.ganacon7up.com/" />
	<meta property="fb:app_id" content="1577659172343071" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Gana con 7uP" />	
	<meta property="og:image" content="https://www.ganacon7up.com/img_facebook.jpg"  /> 
	<meta property="og:image:alt" content="imagea"/>
	<meta property="og:description" content="Gana con 7uP"/>

    <?php echo link_tag('css/reset.css'); ?>
    <?php echo link_tag('css/estilo.css'); ?>

	<link rel="stylesheet" href="<?php echo base_url(); ?>js/bootstrap-3.3.1/dist/css/bootstrap.min.css">
	<?php echo link_tag('css/sistema.css'); ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>

	<!-- link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/slick.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/slick-theme.css"> -->
  	


 	<!-- componente fecha simple -->
     <?php echo link_tag('css/bootstrap-datepicker.css'); ?>    

		<!-- Estilos del juego-->		
		<?php echo link_tag('js/juego/style_jugar.css'); ?>
		<?php //echo link_tag('js/juego/jquery.slotmachine.css'); ?>


		<?php echo link_tag('js/assets/global/plugins/icheck/skins/all.css'); ?>
		



	
</head>
<body >
	<div class="container-fluid">
		<div id="foo"></div>
		
		<div class="row" id="wrapper1">
			<div class="alert" id="messages"></div>

    <!-- Inicia Formulario -->
