<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'mecanica2/header' ); ?>
<?php $this->load->view( 'mecanica2/navbar' ); ?>
<style>
.navbar-brand{
	
}
body{
	
	background-image: none;
            background-position: center center;
            background-image: url(img/mecanica1/backmeca1.jpg);
}
</style>
 <?php 
	 if ($this->session->userdata('session_participante') == true) { 
      	$retorno ="registro_cupon";
    } else {
        $retorno ="registro_usuario/<?php echo base64_encode(1); ?>";
    }



?>	




		<div class="row home">	
			<div class="container">							
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-2 col-md-2 centralhome imagendecupon text-center">
							
						</div>
						<div class="col-lg-8 col-md-8 centralhome imagendecupon text-center">
							<img src="<?php echo base_url()?>img/mecanica2/lateralizquierdo.png" style="margin-bottom:50px;display:inline-block">

							<img src="<?php echo base_url()?>img/cerrarcupones.png">
						</div>
						
					</div>			
				</div>
			</div>



	<script src="<?php echo base_url(); ?>js/face4.js"></script>

<?php $this->load->view( 'mecanica2/footer' ); ?>
