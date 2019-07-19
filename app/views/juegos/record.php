<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'mecanica1/header' ); ?>
<?php $this->load->view( 'mecanica1/navbar' ); 


?>



<div class="container intro">

	<div class="row">
		<div class="col-md-12 text-center" style="margin-top:30px;margin-bottom:20px">
			<img src="<?php echo base_url()?>img/mecanica1/titmarcador.png" class="titularimagen">
		</div>
	</div>	
	<div class="row">
		<div class="col-md-12 text-center" style="margin-top:30px;margin-bottom:20px">
			<div class="contenombremar text-center">
				<?php echo $this->session->userdata('nick_participante') ?>
			</div>
		</div>
	</div>
	<div class="container marcador">
		<div class="col-md-5 col-sm-12 text-right izquierdamar">
			<div class="col-md-6 text-right texta"><span>TICKETS REGISTRADOS</span></div><div class="col-md-6 totals text-center"><span><?php echo isset($cantida_ticket) ? $cantida_ticket : 0; ?></span></div>
			<div class="col-md-6 text-right texta"><span>PUNTOS TOTALES</span></div><div class="col-md-6 totals text-center"><span><?php echo isset($total) ? $total : 0; ?></span></div>	
			<div class="col-md-12 text-center texta"><span><a href="<?php echo base_url(); ?>ingresar_usuario/<?php echo $this->session->userdata('mecanica'); ?>"><img src="<?php echo base_url()?>img/registrar.png" style="margin-top:20px;width: 70%; text-align: center;"></a></span></div>	 
		</div>
		<div class="col-md-2 col-sm-12 text-center">
			<img class="botella" style="
    max-width: 100%;
" src="<?php echo base_url()?>img/mecanica1/7up.png">
		</div>
		<div class="col-md-5 col-sm-12 text-left derechamar">					
			

			<div class="col-md-6 totals text-center"><span>

					<?php echo isset($puntos_semana1) ?  $puntos_semana1 : 0 ; ?>
			</span></div><div class="col-md-6 texta"><span>SEMANA 1 </span></div>

			<div class="col-md-6 totals text-center"><span>
					<?php echo isset($puntos_semana2) ?  $puntos_semana2 : 0 ; ?>
			</span></div><div class="col-md-6 texta"><span>SEMANA 2</span></div>

			<div class="col-md-6 totals text-center"><span>
				    <?php echo isset($puntos_semana3) ?  $puntos_semana3 : 0 ; ?>
			</span></div><div class="col-md-6 texta"><span>SEMANA 3</span></div>

			<div class="col-md-6 totals text-center"><span>
					<?php echo isset($puntos_semana4) ?  $puntos_semana4 : 0 ; ?>
			</span></div><div class="col-md-6 texta"><span>SEMANA 4</span></div>

			<div class="col-md-6 totals text-center"><span>
					<?php echo isset($puntos_semana5) ?  $puntos_semana5 : 0 ; ?>
			</span></div><div class="col-md-6 texta"><span>SEMANA 5</span></div>

			<div class="col-md-6 totals text-center"><span>
					<?php echo isset($puntos_semana6) ?  $puntos_semana6 : 0 ; ?>
			</span></div><div class="col-md-6 texta"><span>SEMANA 6</span></div>

			<div class="col-md-6 totals text-center"><span>
					<?php echo isset($puntos_semana7) ?  $puntos_semana7 : 0 ; ?>
			</span></div><div class="col-md-6 texta"><span>SEMANA 7</span></div>

		</div>
	</div>




</div>


<?php $this->load->view( 'mecanica1/footer' ); ?>