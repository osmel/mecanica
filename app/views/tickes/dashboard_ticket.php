<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php  $this->load->view( 'mecanica1/header' ); ?>
<?php $this->load->view( 'mecanica1/navbar' ); ?>
<?php 

	if (!isset($retorno)) {
      	$retorno ="tarjetas";
    }

  


 $attr = array('class' => 'form-horizontal', 'id'=>'form_tickets','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_tickets', $attr);
?>		

<input type="hidden" id="id_par" name="id_par" value="<?php echo $this->session->userdata('id_participante'); ?>">

<div class="container">

	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				<!-- <h3 class="text-center"><strong><?php echo $this->session->userdata('c2'); ?></strong></h3> -->
				<img src="<?php echo base_url()?>img/mecanica1/registro.png" class"titularimagen">
			</div>
	
		
		<div class="formulario">
			
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 transparenciaformularios registrof" style="">	

					<div class="form-group">						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="compra" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label fechadecompra">Cadena donde se hizo la compra:</label>
								<select name="id_cadena" id="id_cadena" class="form-control">
									
										<?php foreach ( $cadenas as $cadena ){ ?>
												<option value="<?php echo $cadena->id; ?>"><?php echo $cadena->nombre; ?></option>
												
										<?php  } ?>
								</select>
								 <span class="help-block" style="color:white;" id="msg_id_cadena"> </span>							
						</div>
					</div>


					<div class="form-group" style="display:none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input name="ciudad" id="ciudad" type="text" class="form-control"  value="ciudad" placeholder="Ciudad">
							<span class="help-block" id="msg_ciudad"> </span> 
						</div>
					</div>
					
					<div class="form-group"  style="margin-bottom:0px">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="ticket" name="ticket" placeholder="Número de Ticket" value="<?php echo $this->session->userdata('num_ticket_participante') ?>">
							 <span class="help-block" id="msg_ticket"> </span> 
						</div>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="margin-bottom:15px">
						<a class="ver-ticket">Ver ejemplo de ticket</a>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="compra" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label fechadecompra">Fecha de compra</label>
							<div class="input-group date compra col-lg-12 col-md-12 col-sm-12 col-xs-12">
							  <input id="compra" name="compra" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> 
							</div>							
								<span class="help-block" id="msg_compra"> </span>
							
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="monto" placeholder="Monto de la Compra" name="monto">
							<span class="help-block" id="msg_monto"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input name="tienda" id="tienda" type="text" class="form-control"  placeholder="Número o Nombre de Sucursal">
							<span class="help-block" id="msg_tienda"> </span> 
						</div>
					</div>


					<div class="form-group" style="display:none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input id="sku" name="sku" type="text" class="form-control" value="sku" placeholder="SKU" >
							<span class="help-block" id="msg_sku"> </span> 
						</div>
					</div>


					<div class="form-group">						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="compra" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label fechadecompra">Producto comprado:</label>
								<select name="id_producto" id="id_producto" class="form-control">
									
										<?php foreach ( $productos as $producto ){ ?>
												<option value="<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></option>
												
										<?php  } ?>
								</select>
								 <span class="help-block" style="color:white;" id="msg_id_producto"> </span>							
						</div>
					</div>

					<div class="form-group">						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="compra" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label fechadecompra">Presentación del producto:</label>
								<select name="id_litraje" id="id_litraje" class="form-control">
									
										<?php foreach ( $litrajes as $litraje ){ ?>
												<option value="<?php echo $litraje->id; ?>"><?php echo $litraje->nombre; ?></option>
												
										<?php  } ?>
								</select>
								 <span class="help-block" style="color:white;" id="msg_id_litraje"> </span>							
						</div>
					</div>



		<!-- -->	<div class="form-group">
					

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							           <span class="help-block" style="color:white;" id="msg_general"> </span>
							        </div>
					</div>

			</div>
				
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top: -12px;">
						<button type="submit" class="btn btn-info ingresar"/>
								<img src="<?php echo base_url()?>img/mecanica1/registrar.png">
						</button>
			</div>	
		
		</div>
		
	</div>
</div> 
<?php echo form_close(); ?>
<?php $this->load->view('mecanica1/footer'); ?>

<div class="modal fade bs-example-modal-lg" id="modalMessage" ventana="redi_ticket" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content modal-instrucciones"></div>
    </div>
</div>

<div class="ventana-ejemplos">
	<div class="close">
		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	</div>
	<div class="img-ticket" style="height:88%;text-align:center;    padding: 45px;">		
		<div class="text-center"><img src="<?php echo base_url()?>img/ticket1.jpg" style="max-height: 320px;    margin: 0px auto;"></div>
		<div class="text-center"><img src="<?php echo base_url()?>img/ticket2.jpg" style="max-height: 320px;    margin: 0px auto;"></div>
		<div class="text-center"><img src="<?php echo base_url()?>img/ticket3.jpg" style="max-height: 320px;    margin: 0px auto;"></div>
	</div>

	<div class="text-center" style="color:#fff">
		*Imágen de referencia
	</div>
	<div class="text-center exp">
		<span>Producto comprado </span> <span>Fecha de Compra</span>  <span>Número de Ticket</span> <span>Número de Tienda</span> <span>Monto de la compra</span>  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		  // Add smooth scrolling to all links
		  $("nav a").on('click', function(event) {
		  	
		    // Make sure this.hash has a value before overriding default behavior
		    if (this.hash !== "") {
		      // Prevent default anchor click behavior
		      event.preventDefault();

		      // Store hash
		      var hash = this.hash;

		      // Using jQuery's animate() method to add smooth page scroll
		      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		      $('html, body').animate({
		        scrollTop: $(hash).offset().top //-80
		      }, 800, function(){
		   
		        // Add hash (#) to URL when done scrolling (default click behavior)
		        window.location.hash = hash;
		      });

		    } // End if


		  });

		// alto = $('.navbar').outerHeight();
		
		// $('body').css('margin-top', alto);
		  
	});

	function cerrar(){	
	$('.ventana-ejemplos').css({'opacity':0});
	setTimeout(function(){
		$('.ventana-ejemplos').css({'z-index':'-100'});	
	},1000);
	
	}


	$('.img-ticket').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});


	
	function abrir() {
		$('.ventana-ejemplos').css({'z-index':'2000'});
		$('.ventana-ejemplos').css({'opacity':1});
	}

	$('a.ver-ticket').click(function() {
		abrir();
	});

	$('.ventana-ejemplos .close').click(function() {
		cerrar();
	});
</script>

