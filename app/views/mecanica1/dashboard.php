<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'mecanica1/header' ); ?>
<?php $this->load->view( 'mecanica1/navbar' ); ?>
<style>

body{
	
	
            background-position: center center;
            background-image: url(img/mecanica1/backhome.jpg);
}
@media screen and (max-width: 1023px){
	body{
		background-position: left center !important;
		background-attachment: initial !important;
	}
}
@media screen and (max-width: 600px){
	.centralhome {
    padding: 36px 29px;
}
footer{
	position: relative;
   margin-top: 210px;
}
footer span,footer p,footer .vigencia{
	    text-shadow: 1px 1px #000000;
	    font-size: 14px !important;
}
.btnasa{
	width: 86% !important;
}
}

</style>

<div class="container home">								
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-3 col-md-3">
							
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<a href="ingresar_usuario/<?php echo base64_encode(1); ?>" ><img src="<?php echo base_url()?>img/mecanica1/central.png" class="centralhome"></a>
						</div>	
						<div class="col-lg-3 col-md-3">
							
						</div>
						<div class="col-lg-12 col-md-12">
							
						</div>
						<div class="col-lg-2 col-md-2">
							
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 text-center">
							<a href="ingresar_usuario/<?php echo base64_encode(1); ?>" ><img class="btnasa" src="<?php echo base_url()?>img/mecanica1/btn-registrar.png"></a>
						</div>									
				</div>
			</div>



<?php $this->load->view( 'mecanica1/footer' ); ?>