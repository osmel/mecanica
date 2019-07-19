<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'home/header' ); ?>
<?php $this->load->view( 'home/navbar' ); ?>

<style>
.navbar-brand{
	display: none;
}
.slick-prev:before{

  content: "\f053";
  font-family: "Font Awesome 5 free";
  font-size: 41px;
  font-weight: bold;
}
.slick-next:before{

  content: "\f054";
  font-family: "Font Awesome 5 free";
  font-size: 41px;
   font-weight: bold;
}
.slick-next {
    right: 16px !important;
}
</style>
 <?php 
	 if ($this->session->userdata('session_participante') == true) { 
      	$retorno ="registro_ticket";
    } else {
        $retorno ="registro_usuario/<?php echo base64_encode(1); ?>";
    }


 $attr = array('class' => 'form-horizontal', 'id'=>'form_registrar_ticket','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_registrar_ticket', $attr);
?>	

		<div class="row home">								
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

							<?php if ($this->session->userdata('session_participante') == true) { ?>
									<img src="<?php echo base_url()?>img/home/participa1.png"  class="homederecho">
									
				             <?php }else{ ?>
				             			<img src="<?php echo base_url()?>img/home/participa1.png"   class="homederecho2 homedercehoprimer">
										<a href="<?php echo base_url(); ?>registro_usuario/<?php echo base64_encode(1); ?>" class=""><img src="<?php echo base_url()?>img/home/participa2.png"   class="homederecho2 "></a> 
	
				             <?php } ?> 

							
						</div>
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
							<div class="slider">
								
								<div><a href="refrescateyganacon7up" ><img src="<?php echo base_url()?>img/home/promo1ga.jpg" class=""></a></div>
								<div><a href="ingresar_usuario/<?php echo base64_encode(1); ?>" ><img src="<?php echo base_url()?>img/home/promo2g.jpg" class=""></a></div>
								 <div><a href="<?php echo base_url()?>cupones" ><img src="<?php echo base_url()?>img/home/promo1g.jpg" class=""></a></div> 
								</div>
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
<script>
  window.FontAwesomeConfig = {
    searchPseudoElements: true
  }
</script>
<?php $this->load->view( 'home/footer' ); ?>


</script>