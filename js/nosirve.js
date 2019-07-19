if  (hash_url=="/juegos222") { //registro ticket
		var started =0;
			jQuery.ajax({
				        url : '/num_conteo',
				        data : { 
				        	//started: started,
				        },
				        type : 'POST',
				        dataType : 'json',
				        success : function(data) {	

				        	started = data.num;
						        	if (data.tiempo != "0:00") { //es la primera vez que entra es decir es igual a 0:10
						        		localStorage.setItem('miTiempo',  data.tiempo_comienzo );
						        	} 
				        			var timer2 = localStorage.getItem('miTiempo');	

									var interval = setInterval(function() {
										  var timer = timer2.split(':');
										  //by parsing integer, I avoid all extra string processing
										  var minutes = parseInt(timer[0], 10);
										  var seconds = parseInt(timer[1], 10);
										  --seconds;
										  minutes = (seconds < 0) ? --minutes : minutes;
										  if (minutes < 0) clearInterval(interval);
										  seconds = (seconds < 0) ? 59 : seconds;
										  seconds = (seconds < 10) ? '0' + seconds : seconds;
										  //minutes = (minutes < 10) ?  minutes : minutes;
										  if (localStorage.getItem('miTiempo').substring(0, 1) !="-"){
											  $('.countdown').html(minutes + ':' + seconds);
										  } else {
										  	  $('.countdown').html('0:00');
										  }	
										  timer2 = minutes + ':' + seconds;
										  localStorage.setItem('miTiempo', minutes + ':' + seconds);

										  if (localStorage.getItem('miTiempo').substring(0, 1) =="-"){
										  	  $('.countdown').html('0:00');
										  }	
										  

										  	if (localStorage.getItem('miTiempo') =="0:00"){ //si llego al final entonces parar las 3 barajas
													machine4.stop();
													machine5.stop();
													machine6.stop();
													started=0;

													jQuery.ajax({ //guardar en la cookie el conteo
													        url : '/num_conteo',
													        data : { 
													        	started: started,
													        },
													        type : 'POST',
													        dataType : 'json',
													        success : function(data) {	

													        	started = data.num;

												        	    var url = "/proc_modal_juego/"+jQuery.base64.encode(minutes + ':' + seconds)+'/'+jQuery.base64.encode(1);
																jQuery('#modalMessage').modal({
																	  show:'true',
																	remote:url,
																}); 									        	
													        }
													});	
											}
									}, 1000)  //fin del tiempo interval
								
								
								//cuando se oculta la ventana modal de juego redirige al 
								jQuery("body").on('hide.bs.modal','#modalMessage[ventana="juegos"]',function(e){	
									$catalogo = jQuery(this).attr('valor'); //e.target.name;
									window.location.href = '/'+$catalogo;						    
								});	


								var machine4 = $("#casino1").slotMachine({
									active	: (started == 3) ? 0 : Math.trunc(parseInt( jQuery.base64.decode(jQuery("#cripto").val())   )/100  ) ,
									delay	: 1000,
									randomize: function(index){
										return  isNaN(jQuery.base64.decode(jQuery("#cripto").val()) ) ? 0 : Math.trunc(parseInt( jQuery.base64.decode(jQuery("#cripto").val())   )/100  ) -1; 
									} 

								});

								var machine5 = $("#casino2").slotMachine({
									active	: (started >= 2) ? 1 : Math.trunc( (parseInt( jQuery.base64.decode(jQuery("#cripto").val())   ) % 100  ) /10 ),
									delay	: 1000,
									randomize: function(index){
										return  isNaN(jQuery.base64.decode(jQuery("#cripto").val()) ) ? 1 : Math.trunc( (parseInt( jQuery.base64.decode(jQuery("#cripto").val())   ) % 100  ) /10 ) -1; 
									} 

									 
								});

								machine6 = $("#casino3").slotMachine({
									active	: (started >= 1) ? 2 : Math.trunc( (parseInt( jQuery.base64.decode(jQuery("#cripto").val())   ) % 100  ) % 10 ),
									delay	: 1000,
									randomize: function(index){
										return  isNaN(jQuery.base64.decode(jQuery("#cripto").val()) ) ? 2 : Math.trunc( (parseInt( jQuery.base64.decode(jQuery("#cripto").val())   ) % 100  ) % 10 ) -1 ; 
									} 

								});

								switch (parseInt(started) ){
									case 3:
										machine4.shuffle();
										machine5.shuffle();
										machine6.shuffle();
										break;
									case 2:
										machine5.shuffle();
										machine6.shuffle();
										break;
									case 1:
										machine6.shuffle();
										break;
								}

								$("#botonParar").click(function(){
									switch (parseInt(started) ){
										case 3:
											machine4.stop();
											break;
										case 2:
											machine5.stop();
											break;
										case 1:
											machine6.stop();
											break;
									}
									started--;



									jQuery.ajax({ //guardar en la cookie el conteo
									        url : '/num_conteo',
									        data : { 
									        	started: started,
									        },
									        type : 'POST',
									        dataType : 'json',
									        success : function(data) {	

									        	started = data.num;

									        		if (started==0){
										        		var url = "/proc_modal_juego/"+jQuery.base64.encode(localStorage.getItem('miTiempo'))+'/'+jQuery.base64.encode(1);
															jQuery('#modalMessage').modal({
																  show:'true',
																remote:url,
															}); 									        	
													}
									        	
									        }
									});	

								});  //fin de boton parar
				        	
				        } //fin del success
			});	 // fin jQuery.ajax
	}  //fin de registro de ticket