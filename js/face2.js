$(document).ready(function($) {



// Inicializa Facebook JS SDK
	window.fbAsyncInit = function() {
		FB.init({
			
		appId      : '1577659172343071',
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v3.0', // use graph api version 2.8
        app_secret: 'f60d230073b21fb0dbefb238e634285a',
		status  : true // Check for user login status right away
		});

		FB.getLoginStatus(function(response) {  //Cdo entra por vez primera checa el estado(Cuando inicializa) 
			console.log('getLoginStatus', response);  
					//**** Object {authResponse: Object, status: "connected"}
					//**** Object {authResponse: undefined, status: "unknown"}
			loginCheck(response); 
		});
	};

	// Check login status
	function statusCheck(response) 	{
		console.log('statusCheck', response.status); //*****connected o unknown
		if (response.status === 'connected') {
			$('.login').hide();  //oculta login
			getUser(); //tomar los datos del usuario
			$('.form').fadeIn(); //muestra post
		} else if (response.status === 'not_authorized') {
			//El usuario inició sesión en Facebook, pero no en nuestra aplicación.
		}
		else {
			// Usuario no conectado a Facebook.
		}
	}

	// Get login status
	function loginCheck()	{
		FB.getLoginStatus(function(response) {
			console.log('loginCheck', response); //***** Object {status: "connected", authResponse: Object}
												 //**** Object {status: "unknown", authResponse: null}
			statusCheck(response);
		});
	}

	// Aquí ejecutamos a Graph API después de iniciar sesión exitoso. 
	//Consultar statusChangeCallback () para cuando se realiza esta llamada.

	function getUser()	{
		FB.api('/me?fields=id,name,age_range,first_name,last_name,short_name, middle_name, name_format, email,link,gender,locale,timezone,updated_time,verified,friends,cover,picture', function(response) {
			console.log('getUser', response);
			$('#nombre').val(response.first_name);
			$('#apellidos').val(response.last_name);
			$('#email').val(response.email);
			$('#nick').val(response.short_name); //name

			$('#pass_1').val("facebook2018"); //name
			$('#pass_2').val("facebook2018"); //name

			$('#id_facebook').val(response.id); //name
			
			
			//location.reload();			
			
		});
	}
	$(function(){
		// Trigger login
		$('.login').on('click', 'button', function() {
		//$('body').on('click','button.login', function (e) {	
		
			FB.login(function(){
				loginCheck();
			}, {scope: 'public_profile,email'});
			
		});
		
	});
	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

  });	