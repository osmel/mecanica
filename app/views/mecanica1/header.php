<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $this->session->userdata('c2'); ?></title>
	<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/slick.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/slick-theme.css">
    <?php echo link_tag('css/reset.css'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/bootstrap-3.3.1/dist/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	
      <meta property="og:url" content="https://www.todosganan2019.com/" />
	<meta property="fb:app_id" content="282773972567738" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Gana con 7uP" />	
	<meta property="og:image" content="https://www.todosganan2019.com/img_facebook.jpg"  /> 
	<meta property="og:image:alt" content="imagea"/>
	<meta property="og:description" content="Gana con 7uP"/>

	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/mecanica1.css">
	<?php echo link_tag('js/assets/global/plugins/icheck/skins/all.css'); ?>
	<?php echo link_tag('js/juego/style_jugar.css'); ?>

<!--End of Zendesk Chat Script-->
</head>
<body >
	<div class="container-fluid">
		<div id="foo"></div>
		
		<div class="row" id="wrapper1">
			<div class="alert" id="messages"></div>

    <!-- Inicia Formulario -->
