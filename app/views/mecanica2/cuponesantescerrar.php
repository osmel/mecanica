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



 $attr = array('class' => 'form-horizontal', 'id'=>'form_cupon','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_correo_cupon', $attr);
?>	




		<div class="row home">	
			<div class="container">							
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-7 col-md-7 centralhome imagendecupon text-center">
							<img src="<?php echo base_url()?>img/mecanica2/lateralizquierdo.png">
						</div>
						<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 centralhome">

							<!-- ESTE ES EL CUADRO QUE SALE CUANDO ENTRAS PARA PODER OBTENER; DESPUES DESAPARECE Y SALE EL QUE ESTA ABAJO-->
							<div class="contenedordecupones" >
								
								<!-- <img src="<?php echo base_url()?>img/fb_login.png"> -->
								
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center cerrarpe" style="display:none;">
									<div class="login">
								        <button style="background-color: transparent;border: none;    margin-top: 32px;">
								        	<img src="<?php echo base_url(); ?>img/home/regisrarface.png"></button>
								    </div>

									<input type="hidden" id="id_facebook" name="id_facebook" value="0">
								</div>

								<img src="<?php echo base_url()?>img/mecanica2/separador.png" class="separador"  style="display:none;">

								<div class="form-group correosa" style="display:none;">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<input type="text" class="form-control" id="email" name="email" value="test@test.com" placeholder="Ingresar con correo electrónico">
										<span class="help-block" style="color:white;" id="msg_email"> </span> 
									</div>
								</div>		
		

									<div style="display:none;">
											<input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="CONTRASEÑA">
											<input type="text" class="form-control" id="nick" name="nick" placeholder="USUARIO"> 
									</div>

								<div class="form-group avisos"  style="display:none;">     

						               
										<label class="contenedor">Acepto <a class="linkaviso" style="cursor:pointer" data-toggle="modal" data-target="#aviso">el aviso de privacidad</a>
										   <input style="width:20px;" type="checkbox" id="coleccion_id_aviso" value="1" checked name="coleccion_id_aviso" />
										  <span class="checkmark"></span>
										   <span class="help-block" id="msg_coleccion_id_aviso"> </span>
										</label>
 								
										 <label class="contenedor">Acepto <a class="linkaviso" style="cursor:pointer" data-toggle="modal" data-target="#bases">términos y condiciones</a>
										  <input style="width:20px;" type="checkbox" id="coleccion_id_base" value="1" checked name="coleccion_id_base" />
										  <span class="checkmark"></span>
										  <span class="help-block" id="msg_coleccion_id_base"> </span> 
										</label>


								</div>

 								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						           <span class="help-block" style="color:white;" id="msg_general"> </span>

						        </div>


								<button class="text-center btncupon">
									<img class="botonbutton" src="<?php echo base_url()?>img/mecanica2/boton.png">
									 <span style="display: inline-block;text-transform: uppercase;font-size: 19px;color: #ffffff;    margin-top: 30px;">*Al dar click en "Ver Cupón" aceptas Bases, Terminos y condiciones.</span>
								</button>

						</div>	

						<!-- ESTE ES EL CUPON OCULTO QUE SE MUESTRA AL ENTRAR CON FACEBOOK O CORREO -->
						<div class="contenedorcupon2" id="contenedorcupon2">
							<img src="<?php echo base_url()?>img/mecanica2/cupon1a.jpg">
								<div class="contcuponasd2">
							
								</div>
							<img src="<?php echo base_url()?>img/mecanica2/cupon1b.jpg">
						</div>
						<!-- FIN DEL CUPON -->
						<div class="col-sm-12 col-md-12">
						<div class="enviocuponc">
							
						</div>
						</div>
						<div class="col-sm-12 col-md-12 text-center">

							<div id="descarga_cupon">
							</div>
						</div>
						<div class="col-sm-6 col-md-6">
							

							 <button onclick="myFacebookLogin()" style="background-color: transparent; border: none; margin: 0 auto; display: block;"><img class="mostrars" src="<?php echo base_url()?>img/mecanica2/btnfacupo.png"></button>
						</div>
						<div class="col-sm-6 col-md-6">
							<!-- <div id="correo_cupon">
							</div> -->

							

							<a href="<?php echo base_url(); ?>localizador" class="mostrars"><img src="<?php echo base_url()?>img/mecanica2/btnfacupo2.png"></a>
						</div>
					</div>			
				</div>
			</div>



<?php echo form_close(); ?>

	<script src="<?php echo base_url(); ?>js/face4.js"></script>

<?php $this->load->view( 'mecanica2/footer' ); ?>
