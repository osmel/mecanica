<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'home/header' ); ?>
<?php $this->load->view( 'home/navbar' ); ?>

 <?php 
	 if ($this->session->userdata('session_participante') == true) { 
      	$retorno ="registro_ticket";
    } else {
        $retorno ="registro_usuario/<?php echo base64_encode(1); ?>";
    }


?>	
<style>

body{
	
	
            background-position: center center;
            background-image: url(img/mecanica1/backmeca1.jpg);
}
</style>

		<div class="container home">								
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1>PROMOCIONES VIGENTES</h1>
					<div class="row">
						<div class="col-lg-2 col-md-2">
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<!-- <a href="ingresar_usuario/<?php echo base64_encode(1); ?>" ><img src="<?php echo base_url()?>img/home/promo2g.jpg" class=""></a> -->

							<a href="refrescateyganacon7up" ><img src="<?php echo base_url()?>img/home/promo1ga.jpg" class=""></a>
							

						</div>
						  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<a href="<?php echo base_url()?>cupones" ><img src="<?php echo base_url()?>img/home/promo1g.jpg" class=""></a>	
						</div>  
						
					</div>
					
				</div>
			</div>







<?php $this->load->view( 'home/footer' ); ?>


</script>