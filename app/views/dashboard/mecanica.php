<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'mecanica1/header' ); ?>
<?php $this->load->view( 'mecanica1/navbar' ); ?>


 <!-- contenido-->


<div class="col-md-12 text-center" style="margin-top:30px;margin-bottom:20px">
	<img src="<?php echo base_url()?>img/mecanica1/titganar.png" class="titularimagen">
</div> 
<div class="container mecanica">
	
		<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2 class="text-center">Como participar</h2>
		</div> -->
		
		<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<img src="<?php echo base_url().$this->session->userdata('c24'); ?>" class="img-responsive img-center">
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<img src="<?php echo base_url().$this->session->userdata('c25'); ?>" class="img-responsive img-center">
		</div> -->		
		<div class="col-lg-1 col-md-1 text-center">
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
			<img src="<?php echo base_url()?>img/mecanica1/laterlamecanica.png">
		</div>	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
			<img src="<?php echo base_url()?>img/mecanica1/lateralmecanica2.png">
		</div>	
	
		
	
</div>



<?php $this->load->view( 'mecanica1/footer' ); ?>