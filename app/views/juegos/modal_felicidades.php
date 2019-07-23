<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
 // 	if (!isset($retorno)) {
 //      	$retorno ="registro_ticket";
 //    }
 // $hidden = array('nada'=>'nada'); 

 ?>
<!-- 	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>		
	</div>
	<div class="modal-body">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<span class="titular1">
        		 <img src="<?php echo base_url()?>img/felicidades.png" style="width:100%">
        	</span>
        	<span class="ganastext">
        		¡GANASTE <?php echo $total; ?> PUNTOS!
        		  
        	</span>
		</div>
	</div>
	<div class="modal-footer">
		<div class="cont">
			<button type="button" class="close continuar ingresar" data-dismiss="modal" aria-label="Close">
				
					CONTINUAR
				
			</button>
		</div>
	</div>

 -->

 <?php
 $cantidad_puntos="1";

 ?>
<style>
.modal-backdrop{
	        background-color: #29b33f !important;
}
.modal-dialog{
	background-color: transparent !important;
    border: 0px !important;
    box-shadow: none !important;
}
</style>




	<div class="modal-header felicidadesmodal">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body felicidadessi">
				<img src="<?php echo base_url()?>img/mecanica1/felicidades.png" style="width:100%">
				<span class="ganastext">
        			¡GANASTE <?php echo $total; ?> PUNTOS!        		  
        		</span>

				<?php if  (($total_facebook>=1) ) { ?>
					<fieldset style="display:none;">
				<?php } ?>

				<?php if  (($total_facebook==false) ) { ?>
				
						 <button onclick="myFacebookLogin()" style="background-color: transparent; border: none; margin: 0 auto; display: block;">
							<img src="<?php echo base_url()?>img/compartir.png" class="img-responsive" style="margin:3px auto">
						</button> 
						<span class="felic">*al compartir obtendrás el doble de puntos extra</span>		
				<?php } ?>						
				
				<?php if  (($total_facebook>=1) ) { ?>
					</fieldset>	
				<?php } ?>						


		<div class="alert" id="messagesModal"></div>
	</div>




	<div class="modal-footer">
		
	</div>

<style>
.modal-content{
	background-color: transparent !important;
}
</style>

<!--
	<input type="hidden" id="juego" name="juego" value="<?php echo $juego; ?>">
	<input type="hidden" id="redes" name="redes" value="<?php echo $redes; ?>">
	<input type="hidden" id="tiempo" name="tiempo" value="<?php echo $tiempo; ?>">
	<input type="hidden" id="total_puntos" name="total_puntos" value="<?php echo $total_puntos; ?>">

-->


<script type="text/javascript">

var $cantidad_puntos="1";
   

/*   window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '282773972567738',
		    cookie     : true,  // enable cookies to allow the server to access 
	                            // the session
	        xfbml      : true,  // parse social plugins on this page
	        version    : 'v3.0', // use graph api version 2.8
	        app_secret: '75a4b599e0e978256fd3f9221a0a033f',
			status  : true // Check for user login status right away
	    }),*/
   window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '282773972567738',
	      cookie     : false, 
	      status     : true,
	      version    : 'v2.8' // use graph api version 2.8
	    });


	    FB.getLoginStatus(function(response) {
			
		    if (response.status === 'connected') {  //cuando esta conectado
			    var uid = response.authResponse.userID;
			    var accessToken = response.authResponse.accessToken;
		     		
				FB.ui({
				      method: 'feed',
				      name: 'Refréscate y gana con 7UP',
				      link: 'https://www.todosganan2019.com/',
				      picture: 'https://www.todosganan2019.com/img_facebook.jpg',
				      caption: 'Participa y podrías ganar muchos premios',
				      description: 'Refréscate y Gana con 7up'
				    },
				    function(response) {
						if (response !=null) { 	
					        // El usuario publico en el muro
							console.log('El usuario publico en el muro');
							window.location.href = '/registrar_facebook/'+($cantidad_puntos);
					      } else {
					        // El usuario cancelo y no publico nada
							console.log('El usuario cancelo y no publico nada');
							window.location.href = '/registrar_facebook/'+($cantidad_puntos);
					      }
				     }
			    );

			    FB.api('/me', function(response) {
			       $("#response").html("Bienvenido "+ response.name +", has iniciado sesión en facebook");
			    });

     		} else if (response.status === 'not_authorized') { //cuando esta conectado pero no por la app
				FB.ui({
					      method: 'feed',
					      name: 'Refréscate y Gana con 7up',
					      link: 'https://www.todosganan2019.com/',
					      picture: 'https://www.todosganan2019.com/img_facebook.jpg',
					      caption: 'Participa y podrías ganar muchos premios',
					      description: 'Refréscate y Gana con 7up'
				       },
				       function(response) {
							if (response !=null) { 	
						        // El usuario publico en el muro
								console.log('El usuario publico en el muro');
								window.location.href = '/registrar_facebook/'+($cantidad_puntos);
						    } else {
						        // El usuario cancelo y no publico nada
								console.log('El usuario cancelo y no publico nada');
								window.location.href = '/registrar_facebook/'+($cantidad_puntos);
						    }
					    }
				);
			} else {
     			$("#response").html("No hay sesión iniciada en facebook");
				FB.ui({
					      method: 'feed',
					      name: 'Refréscate y Gana con 7up',
					      link: 'https://www.todosganan2019.com/',
					      picture: 'https://www.todosganan2019.com/img_facebook.jpg',
					      caption: 'Participa y podrías ganar muchos premios',
					      description: 'Refréscate y Gana con 7up'
				      },
				      function(response) {
							if (response !=null) { 	
						        // El usuario publico en el muro
								console.log('El usuario publico en el muro');
								window.location.href = '/registrar_facebook/'+($cantidad_puntos);
						      } else {
						        // El usuario cancelo y no publico nada
								console.log('El usuario cancelo y no publico nada');
								window.location.href = '/registrar_facebook/'+($cantidad_puntos);
						      }
				       }
				);
    		}

     	}); //fin de FB.getLoginStatus(function(response) {
    } //fin de window.fbAsyncInit = function() {
 
    	
   function myFacebookLogin() {  
   	  //console.log('a');
		     (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/es_LA/all.js";
		     fjs.parentNode.insertBefore(js, fjs);
		      }(document, 'script', 'facebook-jssdk'));
		     
	}     

  </script>


