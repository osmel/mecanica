<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'home/header' ); ?>
<?php $this->load->view( 'mecanica1/navbar' ); ?>
 
 <?php 

	if (!isset($retorno)) {
      	$retorno ="tarjetas";
    }
 ?>   

	<div class="container ingresar">

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

		<img class="sevenuphomr" src="<?php echo base_url(); ?>img/home/promo7up.png">
	</div>
		
	
		
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 transparenciaformularios loginsi">				
				<h2 class="text-center">Entrar a mi cuenta</h2>
				<div class="formulario-fondos">

					<?php
 					 $attr = array( 'id' => 'form_logueo_participante','name'=>$retorno, 'class' => 'form-horizontal', 'method' => 'POST', 'autocomplete' => 'off', 'role' => 'form' );
					 echo form_open('validar_login_participante', $attr);
					?>
					<input type="hidden" id="mecanica" name="mecanica" value="<?php echo $mecanica ?>">
						 <!--<div class="form-group">
							
							
								<hr>
								<input type="email" class="form-control" id="email" name="email" placeholder="CORREO ELECTRÓNICO">
								<span class="help-block" style="color:white;" id="msg_email"> </span> 
						
						</div>-->
						 <div class="form-group">
							
							
								<hr>
								<!--<input type="email" class="form-control" id="email" name="email" placeholder="CORREO ELECTRÓNICO"> -->
								<input type="text" class="form-control" id="nick" name="nick" placeholder="USUARIO"> 
								<span class="help-block" style="color:white;" id="msg_nick"> </span> 
						
						</div>
					
						<div class="form-group">
							
								<input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="CONTRASEÑA">
								<span class="help-block" style="color:white;" id="msg_contrasena"> </span> 
								
								
<hr>
							
						</div>
						<div class="form-group">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					           <span class="help-block" style="color:white;" id="msg_general"> </span>
					        </div>		
				         </div>					
						<div class="form-group">

							
							
							<div class="col-md-6 col-xs-6 text-center">
								<a href="<?php echo base_url(); ?>registro_usuario/<?php echo base64_encode(1); ?>" class="ingresar">REGISTRAR</a>
							</div>
							<div class="col-md-6 col-xs-6 text-center">								
								<button type="submit" class="ingresar">INGRESAR</button>
							</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center cerrarpe">
									<div class="login">
								        <button style="background-color: transparent;border: none;    margin-top: 32px;">
								        	<img src="<?php echo base_url(); ?>img/home/regisrarface.png" style="    max-width: 100%;"></button>
								    </div>

									<input type="hidden" id="id_facebook" name="id_facebook" value="0">
								</div>



						<!-- 	<div class="col-md-12 text-center" style="margin-top:20px;">
								<a href="<?php echo base_url(); ?>recuperar_participante">¿Olvidaste tu contraseña?</a>
							</div> -->
						</div>
					<?php echo form_close(); ?>
				</div>
		
			
		</div>
	</div>
	<script src="<?php echo base_url(); ?>js/face3.js"></script>
<?php $this->load->view( 'home/footer' ); ?>