jQuery(document).ready(function($) {

 //console.log(  (jQuery.base64.decode('MjEx') )   );
 

	var opts = {
		lines: 13, 
		length: 20, 
		width: 10, 
		radius: 30, 
		corners: 1, 
		rotate: 0, 
		direction: 1, 
		color: '#E8192C',
		speed: 1, 
		trail: 60,
		shadow: false,
		hwaccel: false,
		className: 'spinner',
		zIndex: 2e9, 
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent		
	};


 	jQuery("#ticket").inputmask("999999999999999999999999", {
            placeholder: " ",
            clearMaskOnLostFocus: true
    });



//Validar el registro de usuarios
	jQuery('body').on('submit','#form_cupon', function (e) {	

		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){

				//console.log(data);
				
				if(data.exito != true){
					//console.log(data);	
					spinner.stop();
					jQuery('#foo').css('display','none');
					
					jQuery('#msg_email').html(data.email);
					
					jQuery('#msg_coleccion_id_aviso').html(data.coleccion_id_aviso);					
					jQuery('#msg_coleccion_id_base').html(data.coleccion_id_base);					
									
					jQuery('#msg_general').html(data.general);
				

				}else{
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						jQuery('.contenedordecupones').hide();
						jQuery('.contenedorcupon2').css('display','block');
						//jQuery('.contcuponasd2').append('<img class="codigodebar" src="/barcode/'+data.codigobarra+'" height="300">');
						jQuery('.contcuponasd2').append('<img class="codigodebar" src="/barcode/'+data.codigobarra+'" height="150"><p style="text-align:center; font-size:20px;color:#000000" > <b>'+data.codigobarra.replace(/\.png$/, "")+'</b></p>');
						jQuery('.mostrars').css('display','block');
						
						jQuery('#descarga_cupon').children().remove();
						//jQuery('#descarga_cupon').append('<a href="/barcode/'+data.codigobarra+'" class="btndescarga1" download="'+data.codigobarra+'"><img src="/img/mecanica2/btnfacupo3.png"></a>');
						
						jQuery('#descarga_cupon').append('<a href="javascript:void(0);" onclick="generate();" class="btndescarga1" "><img src="/img/mecanica2/btnfacupo3.png"></a>');

						jQuery('#correo_cupon').children().remove();
						jQuery('#correo_cupon').append('<button style="display:none;" valor="'+data.codigobarra+'" class="envio_correo"><img src="/img/mecanica2/btnfacupo4.png"></button>');



				}
				
			} 
		});
		return false;
	});	
// A $( document ).ready() block.
jQuery( document ).ready(function() {
  jQuery(".login").click(function() {
  jQuery(".correosa").css('display','none');
});
});


	jQuery('body').on('click','button.envio_correo', function (e) {	
		 

 					 jQuery.ajax({ //guardar en la cookie el conteo
                            url : '/7up/enviando_correo_cupon',
                            data : { 
                            	   codigo: jQuery(this).attr('valor').replace(/\.png$/, ""),
                                   url_imagen: jQuery(this).attr('valor'),
                                email: jQuery('#email').val(),
                                
                            },
                            type : 'POST',
                            dataType : 'json',
                            success : function(data) {  
                            	//alert( '  Imagen a enviar: '+jQuery(this).attr('valor')+'  al correo: '+jQuery('#email').val() );
                            	console.log(data);
                                return false;

                            }

                    }); 

 			jQuery('.enviocuponc').append('<span class="enviocu">Cupón enviado exitosamente a tu correo.</span>');		 
	});	

    //Validar el registro de usuarios
	jQuery('body').on('submit','#form_reg_participantes', function (e) {	

		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){

				//console.log(data);
				
				if(data.exito != true){
					//console.log(data);	
					spinner.stop();
					jQuery('#foo').css('display','none');
					
					jQuery('#msg_nombre').html(data.nombre);
					jQuery('#msg_apellidos').html(data.apellidos);
					jQuery('#msg_email').html(data.email);
					jQuery('#msg_fecha_nac').html(data.fecha_nac);	

					jQuery('#msg_calle').html(data.calle);
					jQuery('#msg_numero').html(data.numero);
					jQuery('#msg_colonia').html(data.colonia);
					jQuery('#msg_municipio').html(data.municipio);
					jQuery('#msg_cp').html(data.cp);	

					jQuery('#msg_id_estado').html(data.id_estado);
					jQuery('#msg_celular').html(data.celular);					
					jQuery('#msg_telefono').html(data.telefono);
 				    //jQuery('#msg_id_estado_compra').html(data.id_estado_compra);  
 				    jQuery('#msg_ciudad').html(data.ciudad);  
					jQuery('#msg_nick').html(data.nick);
					
					
					jQuery('#msg_pass_1').html(data.pass_1);
					jQuery('#msg_pass_2').html(data.pass_2);					

					
					
					jQuery('#msg_coleccion_id_aviso').html(data.coleccion_id_aviso);					
					jQuery('#msg_coleccion_id_base').html(data.coleccion_id_base);					
									
					jQuery('#msg_general').html(data.general);
				

				}else{
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						//ya no redirecciona directo a registro ticket
						//alert('/'+data.redireccion);
						window.location.href = '/7up/'+data.redireccion;    //$catalogo;						

						/*		
						//new ok 
						var url = "/proc_modal_facebook";
						//alert(url);
						jQuery('#modalMessage_face').modal({
							  show:'true',
							remote:url,
						}); 	
						*/								        	
						


				}
				
			} 
		});
		return false;
	});	

		//sino comparte en facebook entonces redirige directamente al ticket sin guardar redes
	   jQuery("body").on('hide.bs.modal','#modalMessage_face',function(e){    
                window.location.href = '/7up/registro_ticket';                           
       }); 





 //logueo y recuperar contraseña
	jQuery("#form_logueo_participante").submit(function(e){
		jQuery('#foo').css('display','block');

		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				
				if(data.exito != true){
					spinner.stop();
					jQuery('#foo').css('display','none');

		
					jQuery('#msg_nick').html(data.nick);
					jQuery('#msg_contrasena').html(data.contrasena);
  				    jQuery('#msg_general').html(data.general);
				

					
				}else{
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/7up/'+data.redireccion;    //$catalogo;				
				}
			} 
		});
		return false;
	});

            //cuando se oculta la ventana modal de felicidades se redirige al 
            jQuery("body").on('hide.bs.modal','#modalMessage3',function(e){    
                $catalogo = jQuery(this).attr('direccion'); //e.target.name;
                //alert($catalogo);
                window.location.href = '/7up/'+$catalogo;                           
                //window.location.href = '/';
            }); 

            /*
            jQuery('body').on('click','.btn_respuesta', function (e) {  

                
                  e.preventDefault();
                    jQuery.ajax({ //guardar en la cookie el conteo
                            url : '/7up/respuesta_juego',
                            data : { 
                                   figura: $(this).attr('fig'),
                                respuesta: $(this).attr('resp'),
                                
                            },
                            type : 'POST',
                            dataType : 'json',
                            success : function(data) {  
                                  localStorage.setItem('virada',  0 );

                                  //redireccionar a record
                                  //window.location.href = '/7up/'+data.redireccion;        

                                    //levantar la modal de felicidades
                                    var url = "/proc_modal_felicidades";  
                                    jQuery('#modalMessage3').modal({
                                        show:'true',
                                        remote:url,
                                    });
                                  return false;

                            }

                    }); 
                    
            });
            */

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/*
http://josex2r.github.io/jQuery-SlotMachine/
https://nnattawat.github.io/flip/
https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/
*/
var hash_url = window.location.pathname;

	





		////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
	
        jQuery('.icheck1').each(function() {
            var checkboxClass = jQuery(this).attr('data-checkbox') ? jQuery(this).attr('data-checkbox') : 'icheckbox_minimal-grey';
            var radioClass = jQuery(this).attr('data-radio') ? jQuery(this).attr('data-radio') : 'iradio_minimal-grey';

            if (checkboxClass.indexOf('_line') > -1 || radioClass.indexOf('_line') > -1) {
                jQuery(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass,
                    insert: '<div class="icheck_line-icon"></div>' + jQuery(this).attr("data-label")
                });
            } else {
                jQuery(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass
                });
            }
        });

	
	jQuery(".navigacion").change(function()	{
	    document.location.href = jQuery(this).val();
	});

   	var target = document.getElementById('foo');


		jQuery("#fecha_nac").dateDropdowns({
					submitFieldName: 'fecha_nac', //Especificar el "atributo name" para el campo que esta oculto
					submitFormat: "dd-mm-yyyy", //Especificar el formato que la fecha tendra para enviar
					displayFormat:"dmy", //orden en que deben ser prestados los campos desplegables. "dia, mes, año"
					//initialDayMonthYearValues:['Día', 'Mes', 'Año'],
					yearLabel: 'Año', //Identifica el menú desplegable "Año"
					monthLabel: 'Mes', //Identifica el menú desplegable "Mes"
					dayLabel: 'Día', //Identifica el menú desplegable "Día"
					monthLongValues: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					monthShortValues: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
					daySuffixes: false,  //que no tengan sufijo
					minAge:18, //edad minima
					maxAge:150, //edad maxima

				});

  


	jQuery('.input-group.date.compra').datepicker({
		//startView: 2,
		
		format: "mm/dd/yy",
		startDate: "07/15/2018", //"-2d"
		endDate: "+0d", 
	    language: "es",
	    autoclose: true,
	    todayHighlight: true

	});



	//registro de ticket, mecanica1
	jQuery('body').on('submit','#form_tickets', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					
					jQuery('#msg_ticket').html(data.ticket);
					jQuery('#msg_compra').html(data.compra);
					jQuery('#msg_monto').html(data.monto);

					jQuery('#msg_ciudad').html(data.ciudad);
					jQuery('#msg_tienda').html(data.tienda);
					jQuery('#msg_sku').html(data.sku);

  				    jQuery('#msg_general').html(data.general);
				}else{


						spinner.stop();
						jQuery('#foo').css('display','none');
						
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/7up/'+$catalogo;				
						

				}
			} 
		});
		return false;
	});	


    jQuery('body').on('submit','#form_participantes_mecanica2', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#msg_ticket').html(data.ticket);
					jQuery('#msg_compra').html(data.compra);
  				    jQuery('#msg_general').html(data.general);
				}else{
						spinner.stop();
						jQuery('#foo').css('display','none');

						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/7up/'+$catalogo;				
						

				}
			} 
		});
		return false;
	});	

jQuery("body").on('hide.bs.modal','#modalMessage[ventana="redi_ticket"]',function(e){	
	

						var transaccion = jQuery('#transaccion').val();

						//dashboard_ticket
						if (transaccion<100) {
							$catalogo = "record/"+jQuery('#id_par').val();
						} else {
							$catalogo = jQuery(this).attr('valor'); //e.target.name;
						}
						window.location.href = '/7up/'+$catalogo;						    


});








	

	//new ok si oculta la modal del facebook, o la ignora, entonces va directo al registro de ticket

	jQuery("body").on('hide.bs.modal','#modalMessage[ventana="facebook"]',function(e){	
		$catalogo = jQuery(this).attr('valor'); //e.target.name;
		window.location.href = '/7up/'+$catalogo;						    
	});	



 
 	









//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////predictivo localizador//////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//q += '&idproveedor='+encodeURIComponent(jQuery('.buscar_localizador.tt-input').attr("idproveedor"));

var consulta_localizador = new Bloodhound({
	   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nombre'),
	   queryTokenizer: Bloodhound.tokenizers.whitespace,

	  remote: {
	        url: '/buscador?key=%QUERY',
	        replace: function () {
	            var q = '/buscador?key='+encodeURIComponent(jQuery('.buscar_localizador').typeahead("val"));
					q += '&nombre='+encodeURIComponent(jQuery('.buscar_localizador.tt-input').attr("name"));
	            return  q;
	        }
	    },   
	});

	


	consulta_localizador.initialize();
	jQuery('.buscar_localizador').typeahead(
		{
			  hint: true,
		  highlight: true,
		  minLength: 1
		},
		{
		   name: 'buscar_localizador',
		   displayKey: 'domicilio', //  para cdo se utilice .typeahead("val")  devuelva el domicilio
		   source: consulta_localizador.ttAdapter(),
		   templates: {
				    suggestion: function (data) {  
						return '<p><strong>' + data.domicilio +  data.estado+ '</strong></p>';
						 //+'<div style="background-color:'+ '#'+data.hexadecimal_color + ';display:block;width:15px;height:15px;margin:0 auto;"></div>';
			  		 }
		}
	});

	jQuery('.buscar_localizador').on('typeahead:selected', function (e, datum,otro) {
	    //console.log(datum.key);
	    datos_marker(datum.lat, datum.lng, 'marker_'+datum.key);
	    //datos_marker(<?php echo $marker_sidebar->lat; ?>,<?php echo $marker_sidebar->lng; ?>,marker_<?php echo $marker_sidebar->id; ?>)
	});	

	jQuery('.buscar_localizador').on('typeahead:closed', function (e) {
		//	console.log(  jQuery(this)  );
		//console.log (  jQuery('.buscar_localizador.tt-input').typeahead("val")  ) ;
	});			

////////////////cp

var consulta_cp = new Bloodhound({
	   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nombre'),
	   queryTokenizer: Bloodhound.tokenizers.whitespace,

	  remote: {
	        url: '/buscador?key=%QUERY',
	        replace: function () {
	            var q = '/buscador?key='+encodeURIComponent(jQuery('.buscar_cp').typeahead("val"));
					q += '&nombre='+encodeURIComponent(jQuery('.buscar_cp.tt-input').attr("name"));
	            return  q;
	        }
	    },   
	});

	


	consulta_cp.initialize();
	jQuery('.buscar_cp').typeahead(
		{
			  hint: true,
		  highlight: true,
		  minLength: 1
		},
		{
		   name: 'buscar_cp',
		   displayKey: 'cp', //  para cdo se utilice .typeahead("val")  devuelva el domicilio
		   source: consulta_cp.ttAdapter(),
		   templates: {
				    suggestion: function (data) {  
						return '<p><strong>' + data.cp + '</strong></p>';
			  		 }
		}
	});

	jQuery('.buscar_cp').on('typeahead:selected', function (e, datum,otro) {
	    //console.log(datum.key);
	    datos_marker(datum.lat, datum.lng, 'marker_'+datum.key);
	});	

	jQuery('.buscar_cp').on('typeahead:closed', function (e) {
		//	console.log(  jQuery(this)  );
		//console.log (  jQuery('.buscar_cp.tt-input').typeahead("val")  ) ;
	});		



	jQuery('body').on('click','button.miposicion', function (e) {	
		window.location.href = '/miposicion'


		//jQuery('#descarga_cupon').append('<a href="/barcode/'+data.codigobarra+'" class="btndescarga1" download="'+data.codigobarra+'"><img src="/img/mecanica2/btnfacupo3.png"></a>');
						
		 /*
		 jQuery.post( "/localizador", function( data ) {
			  //jQuery( ".result" ).html( data );
			});

		window.open('impresion_etiquetas/'+jQuery.base64.encode(codigo), '_blank');
							 return false;
		*/
	});	

/////////////////////

	function datos_marker(lat, lng, marker) {
		console.log(marker);
     	var mi_marker = new google.maps.LatLng(lat, lng);
     	map.panTo(mi_marker);
     	google.maps.event.trigger( eval(marker), 'click');
    }


/*	
	let selecciono1 = null;
	jQuery('.buscar_localizador').on('typeahead:selected', function (e, datum,otro) {
	    selecciono1 = jQuery('.buscar_localizador.tt-input').typeahead("val");
	    jQuery('.buscar_localizador.tt-input').attr("identificador_vendedor",datum.key);		
	});	

	jQuery('.buscar_localizador').on('typeahead:closed', function (e) {
		
		if (!selecciono1 || selecciono1 != jQuery('.buscar_localizador.tt-input').typeahead("val")) {
       	 selecciono1 = null;
       	 jQuery('.buscar_localizador.tt-input').typeahead("val",'');
    	} 

    	if (jQuery('.buscar_localizador.tt-input').typeahead("val")=='' ) {  //caso q quiten valor
    		jQuery('.buscar_localizador.tt-input').attr("identificador_vendedor",'0');		
    	}

    	//var oTable =jQuery('#tabla_historico_salida').dataTable();
		//oTable._fnAjaxUpdate(); 

	});	
*/




});	