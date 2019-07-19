<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php  $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>
<?php 

	if (!isset($retorno)) {
      	$retorno ="tarjetas";
    }

  


 $attr = array('class' => 'form-horizontal', 'id'=>'form_participantes_mecanica2','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_tickets_mecanica2', $attr);
?>		

<input type="hidden" id="id_par" name="id_par" value="<?php echo $this->session->userdata('id_participante'); ?>">

<div class="container mecanica">

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<!-- <h3 class="text-center"><strong><?php echo $this->session->userdata('c2'); ?></strong></h3> -->
				<h2 class="text-center">Registro de ticket</h2>
			</div>
		</div>
		
		<div class="row">
			
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 transparenciaformularios registrof" style="float:none;margin:0px auto;padding: 32px 100px;">	
					
					<div class="form-group">						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<select name="id_estado" id="id_estado" class="form-control">
									<option value="" disabled selected>Elige donde compraste tu 7UP</option>
										<?php foreach ( $estados as $estado ){ ?>
												<option value="<?php echo $estado->id; ?>"><?php echo $estado->nombre; ?></option>
												
										<?php } ?>
								</select>
								 <span class="help-block" style="color:white;" id="msg_id_estado"> </span>							
						</div>
					</div>
					
					<div class="form-group"  style="margin-bottom:0px">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="ticket" name="ticket" placeholder="Número de Ticket" value="<?php echo $this->session->userdata('num_ticket_participante') ?>">
							 <span class="help-block" style="color:white;" id="msg_ticket"> </span> 
						</div>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="margin-bottom:15px">
						<a class="ver-ticket">Ver ejemplo de ticket</a>
					</div>

					<div class="form-group">
						<label for="compra" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Fecha de compra</label>
						<div class="input-group date compra col-lg-12 col-md-12 col-sm-12 col-xs-12">
						  <input id="compra" name="compra" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> 
						</div>
						<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-9 col-xs-offset-3">
							<span class="help-block" style="color:white;" id="msg_compra"> </span>
						</div>
					</div>
					
					

					

					

		<div class="col-lg-6 col-lg-offset-4 col-md-6 col-md-offset-4 col-sm-12 col-xs-12">
           <span class="help-block" style="color:white;" id="msg_general"> </span>
        </div>
					
					
					

				</div>
				
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top: -12px;">
						<button type="submit" class="btn btn-info ingresar" value="REGISTRARME"/>
								REGISTRAR
						</button>
					</div>	
		
		</div>
		
	</div>
</div> 
<?php echo form_close(); ?>
<?php $this->load->view('footer'); ?>

