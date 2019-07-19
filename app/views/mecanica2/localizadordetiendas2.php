<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'mecanica2/header' ); ?>
<?php echo $map['js']; ?>	
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


 $attr = array('class' => 'form-horizontal', 'id'=>'form_registrar_ticket','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_registrar_ticket', $attr);
?>	

		<div class="row home">	
			<div class="container">							
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-5 col-md-5 centralhome imagendecupon text-center">
							<img src="<?php echo base_url()?>img/mecanica2/localizador.png" class="separador">
							<img src="<?php echo base_url()?>img/mecanica2/usarubi.png" class="separador">
							<div class="form-group">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="text" class="form-control" id="" name="" placeholder="CIUDAD O MUNICIPIO">
									<span class="help-block" style="color:white;" id="msg_calle"> </span> 
								</div>
							</div>	
							<div class="form-group">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="text" class="form-control" id="" name="" placeholder="COLONIA">
									<span class="help-block" style="color:white;" id="msg_calle"> </span> 
								</div>
							</div>	
							<img src="<?php echo base_url()?>img/mecanica2/buscarti.png" class="separador">
							
						</div>
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 centralhome">

							<?php echo $map['html']; ?>
						</div>	

						
					</div>			
				</div>
			</div>



<?php echo form_close(); ?>

<script type="text/javascript">

function tickets(){
$(".slider").slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
  		autoplaySpeed: 5500
      
      });
ya=1;
}

$(document).ready(function() {
	tickets();
});

</script>
<?php $this->load->view( 'mecanica2/footer' ); ?>
</script>