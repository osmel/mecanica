<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'home/header' ); ?>
<?php $this->load->view( 'home/navbar' ); ?>
 <style>
.navbar-brand{
	
}
body{
	
	background-image: none;
            background-position: center center;
            background-image: url(../img/home/fondoregistro.jpg);
}
</style>



 <?php 

	if (!isset($retorno)) {
      	$retorno ="tarjetas"; //registro_ticket
    }

 $attr = array('class' => 'form-horizontal', 'id'=>'form_reg_participantes','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('validar_registros', $attr);
?>		

<input type="hidden" id="mecanica" name="mecanica" value="<?php echo $mecanica ?>">

<div class="container registro">	
	<div class="col-md-6">

		<img class="sevenuphomr" src="<?php echo base_url(); ?>img/home/promo7up.png">
	</div>
	<div class="col-md-6">
		<h1>Registro</h1>

				<!-- <div class="panel-body">
					<div class="form-group">
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="NOMBRE(S)">
							<span class="help-block" style="color:white;" id="msg_nombre"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="APELLIDOS">
							<span class="help-block" style="color:white;" id="msg_apellidos"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<input type="email" class="form-control" id="email" name="email" placeholder="CORREO ELECTRÓNICO">
							<span class="help-block" style="color:white;" id="msg_email"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="celular" name="celular" placeholder="TÉLEFONO CELULAR">
							<span class="help-block" style="color:white;" id="msg_celular"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="password" class="form-control" id="pass_1" name="pass_1" placeholder="CONTRASEÑA">
							<span class="help-block" style="color:white;" id="msg_pass_1"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="password" class="form-control" id="pass_2" name="pass_2" placeholder="CONFIRMAR CONTRASEÑA">
							<span class="help-block" style="color:white;" id="msg_pass_2"> </span> 
						</div>
					</div>				 -->




	

					<div class="form-group">						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)">
							<span class="help-block" style="color:white;" id="msg_nombre"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
							<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
							<span class="help-block" style="color:white;" id="msg_apellidos"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
							<input type="email" class="form-control minuscula" id="email" name="email" placeholder="Correo Electrónico">
							<span class="help-block" style="color:white;" id="msg_email"> </span> 
						</div>
					</div>


					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="fecha_nac" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Fecha de Nacimiento:</label>
							<div class="fecha_nac">
							  <input type="hidden" id="fecha_nac"   class="form-control">
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span class="help-block" style="color:white;" id="msg_fecha_nac"> </span>
							</div>
						</div>
					</div>

					 <div class="form-group" style="display:none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="calle" value="calle" name="calle" placeholder="Calle" value="calle">
							<span class="help-block" style="color:white;" id="msg_calle"> </span> 
						</div>
					</div>		

					<div class="form-group" style="display:none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="numero" value="numero" name="numero" placeholder="NÚMERO" value="numero">
							<span class="help-block" style="color:white;" id="msg_numero"> </span> 
						</div>
					</div>	

					<div class="form-group" style="display:none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="colonia" value="colonia" name="colonia" placeholder="COLONIA" value="colonia">
							<span class="help-block" style="color:white;" id="msg_colonia"> </span> 
						</div>
					</div>	
					
					<div class="form-group" style="display:none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="municipio" value="municipio" name="municipio" placeholder="MUNICIPIO" value="municipio">
							<span class="help-block" style="color:white;" id="msg_municipio"> </span> 
						</div>
					</div>	
					 
						
					<div class="form-group" style="display:none;">					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="cp" value="codigo postal" name="cp" placeholder="CÓDIGO POSTAL" value="cp">
							<span class="help-block" style="color:white;" id="msg_cp"> </span> 
						</div>
					</div>

					<div class="form-group" style="display:none;">						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
							<select name="id_estado" id="id_estado" class="form-control">
									<?php foreach ( $estados as $estado ){ ?>
											<option value="<?php echo $estado->id; ?>" selected ><?php echo $estado->nombre; ?></option>	
									<?php } ?>
							</select>
							<input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="CIUDAD" value="ciudad">
							<span class="help-block" style="color:white;" id="msg_ciudad"> </span>							
						</div>
					</div>
						
					<div class="form-group" style="display:none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="celular" name="celular" placeholder="TÉLEFONO CELULAR" value="555555555523">
							<span class="help-block" style="color:white;" id="msg_celular"> </span> 
						</div>
					</div>


					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Télefono">
							<span class="help-block" style="color:white;" id="msg_telefono"> </span> 
						</div>
					</div>

					<div class="form-group" style="display:none;">
						 <label for="id_estado" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Estado:</label> 
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								 <select name="id_estado_compra" id="id_estado_compra" class="form-control"> 
									
										<?php foreach ( $estados as $estado ){ ?>
												<option value="<?php echo $estado->id; ?>" selected><?php echo $estado->nombre; ?></option>
										<?php } ?>
								</select>
								 <span class="help-block" style="color:white;" id="msg_id_estado_compra"> </span>							
						</div>
					</div>	

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="nick" name="nick" placeholder="Nombre de usuario">
							<span class="help-block" style="color:white;" id="msg_nick"> </span> 
						</div>
					</div>
			
					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="password" class="form-control" id="pass_1" name="pass_1" placeholder="Contraseña">
							<span class="help-block" style="color:white;" id="msg_pass_1"> </span> 
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="password" class="form-control" id="pass_2" name="pass_2" placeholder="Confirmar contraseña">
							<span class="help-block" style="color:white;" id="msg_pass_2"> </span> 
						</div>
					</div>				
			



	
					<div class="form-group">
						  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<input style="float:left;width:20px;" type="checkbox" id="coleccion_id_base" value="1"  name="coleccion_id_base" />
			              <label>
			              		Acepto <a class="linkaviso" style="cursor:pointer" data-toggle="modal" data-target="#bases">términos y condiciones</a>
			              </label>
			              <span class="help-block" id="msg_coleccion_id_base"> </span> 
			              </div>
			              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						  <input style="float:left;width:20px;" type="checkbox" id="coleccion_id_aviso" value="1"  name="coleccion_id_aviso" />
			              <label >
			              		Acepto <a class="linkaviso" style="cursor:pointer" data-toggle="modal" data-target="#aviso">el aviso de privacidad</a>
			              </label>     
			              <span class="help-block" id="msg_coleccion_id_aviso"> </span> 
			              </div>
			                          
			              

					</div>



					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<button type="submit" class="btn btn-info" value="REGISTRARME"/>
								<img src="<?php echo base_url(); ?>img/home/registrames.png"></button>
							</button>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center cerrarpe">
						<div class="login">
					        <button class="login" style="background-color: transparent;border: none;">
					        	<img src="<?php echo base_url(); ?>img/home/regisrarface.png">
					        </button>
					    </div>

						<input type="hidden" id="id_facebook" name="id_facebook" value="0">
					</div>



				</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
           <span class="help-block" style="color:white;" id="msg_general"> </span>
        </div>		
	</div>
</div>

<?php echo form_close(); ?>


<script src="/js/face2.js"></script>

<!--
<div class="modal fade bs-example-modal-lg" id="modalMessage_face" ventana="facebook" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
-->

<?php $this->load->view('home/footer'); ?>
