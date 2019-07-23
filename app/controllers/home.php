<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){ 
		parent::__construct();
		$this->load->model('admin/modelo', 'modelo'); 
		$this->load->model('registros', 'modelo_registro'); 
		$this->load->model('admin/catalogo', 'catalogo');  
		$this->load->library(array('email')); 
	}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////ticket/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


   function registro_ticket($mecanica){

   	    $data['mecanica'] = 1; //(int)base64_decode($mecanica);
   	    //$data['estados']   = $this->modelo_registro->listado_estados();
   	    $data['cadenas']   = $this->modelo_registro->listado_cadenas();
   	    $data['productos']   = $this->modelo_registro->listado_productos();
   	    $data['litrajes']   = $this->modelo_registro->listado_litrajes();


   	    $this->session->set_userdata('mecanica',$mecanica );

  		if($this->session->userdata('session_participante') === TRUE ){

  			//print_r(10);die;

  			if ($this->session->userdata('num_ticket_participante')) {
  					redirect('/tarjetas');
  			} else {

										switch ($data['mecanica']) {
											case 0:
													redirect('/vigentes');
												break;
											case 1:
													$this->load->view( 'tickes/dashboard_ticket',$data);
												break;
											case 2:
													$this->load->view( 'tickes/dashboard_ticket2',$data);
												break;
											
											default:
												 redirect('/vigentes');
												break;
										}

  				
  			}
		  			
		}
		else { 
			
		  redirect('');
		}	
	}



function validar_tickets(){
		if ($this->session->userdata('session_participante') != TRUE) {
			redirect('');
		} else {
			$mis_errores=array(
				    "ciudad" => '',
				    "ticket" => '',
				    "compra" => '',
				    "tienda" => '',
				    "sku" => '',
				    "monto" => '',
				    'general'=> '',
			);

			$this->form_validation->set_rules( 'ciudad', 'Ciudad', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'ticket', 'Núm de ticket', 'trim|required|min_length[17]|max_length[24]|xss_clean');	
			$this->form_validation->set_rules( 'compra', 'Fecha de compra', 'trim|required|callback_valid_fecha[compra]|xss_clean');
			$this->form_validation->set_rules( 'tienda', 'Tienda', 'trim|required|min_length[1]|max_length[100]|xss_clean');	
			$this->form_validation->set_rules( 'sku', 'SKU', 'trim|required|min_length[1]|max_length[100]|xss_clean');	
			$this->form_validation->set_rules( 'monto', 'Monto de la compra', 'trim|required|numeric|min_length[1]|xss_clean');				
		
			$ticket['monto']				    = $this->input->post('monto');
			

	
			//todos los datos  y  la transaccion sea menor al monto
			if ( ($this->form_validation->run() === TRUE)  ) {

				$validacion_tickets =true;
				if ($validacion_tickets){ //validacion de la tarjeta
					$ticket['ticket']			=	$this->input->post('ticket');
					
					$ticket 				= 	$this->security->xss_clean($ticket);  
					$ticket_check = $this->modelo_registro->check_tickets_existente($ticket);


					//si no existe ticket
					if ( $ticket_check != FALSE ){		
						
						$ticket['id_cadena']   			= $this->input->post( 'id_cadena' );	
						$ticket['id_producto']   			= $this->input->post( 'id_producto' );	
						$ticket['id_litraje']   			= $this->input->post( 'id_litraje' );	

						$ticket['ciudad']   			= $this->input->post( 'ciudad' );
						$ticket['compra']   			= $this->input->post( 'compra' );
						$ticket['tienda']   			= $this->input->post( 'tienda' );
						$ticket['sku']	   				= $this->input->post( 'sku' );
						
						$numeros = range(1, 4);
						shuffle($numeros);
						$cripto ='';
						foreach ($numeros as $numero) {
						    $cripto = $cripto.$numero;
						}
						//el orden de las cartas
						
						$ticket['puntos'] = base64_encode($cripto);
						
						$this->session->set_userdata('cripto', $ticket['puntos'] );


						$segmento = mt_rand(1, 8); //$this->session->userdata('cantimagen')
						$ticket['puntos'] = base64_encode($segmento);
						$this->session->set_userdata('cripto_ruleta', $ticket['puntos'] );


						//la pregunta que va a salir
						$datos = $this->modelo_registro->listado_preguntas();
						foreach ($datos as $row) {
							$misdatos[]=$row->id;
						}	
						shuffle($misdatos);
						$this->session->set_userdata('pregunta', $misdatos[0] );
						//echo $misdatos[0];
						
						//$this->session->set_userdata('tarjeta_participante', $ticket_check['tarjeta']);
						//$this->session->set_userdata('juego_participante', $ticket_check['juego']);

						/*
						if (($uno==$dos) and ($dos==$tres)) { //si las 3 son iguales

							$ticket['total'] =  ((  $this->session->userdata("ip".$uno) ) !=0) ? (  $this->session->userdata("ip".$uno) ) : 25 ;	
						} else {
							$ticket['total'] = 25;	
						}
						
						*/
						

						$ticket 						= $this->security->xss_clean( $ticket );
						$guardar 						= $this->modelo_registro->anadir_tickets( $ticket );



						
						if ( $guardar !== FALSE ){  

									
									//$dato['email']   			    = $ticket['email'];   			
									//$dato['contrasena']				= $ticket['contrasena'];				

									/* 
									//envio de correo para notificar alta en usuarios del sistema
									$desde = $this->session->userdata('c1');
									$esp_nuevo = $ticket['email'];
									$this->email->from($desde, $this->session->userdata('c2'));
									$this->email->to( $esp_nuevo );
									$this->email->subject('Has sido dado de alta en '.$this->session->userdata('c2'));
									$this->email->message( $this->load->view('admin/correos/alta_usuario', $dato, TRUE ) );

										 
									if ($this->email->send()) {	
										echo TRUE;
									} else {
										echo '<span class="error"><b>E01</b> - El nuevo usuario no pudo ser agregado</span>';
									}
									*/

									//$this->session->set_userdata('session_participante', TRUE);
									//$this->session->set_userdata('nombre_participante', $ticket['nombre'].' '.$ticket['apellidos']);
									//$this->session->set_userdata('email_participante', $ticket['email']);
									//$this->session->set_userdata('id_participante', $login_element->id);


									
									//indicar numero de ticket registrado															
									
									$this->session->set_userdata('num_ticket_participante', $ticket['ticket']);
									

									//indicar que ya registro su ticket						
									$this->session->set_userdata('registro_ticket', true );
									
									//cuando entra 3 posibilidades de barajear
									//$this->session->set_userdata('numImage', 3 );
									
									
									//tiempo comienzo
									//$this->session->set_userdata('tiempo', $this->tiempo_comienzo);


									$mis_errores = true;	

						} else {
							$mis_errores["general"] = '<span class="error"><b>E01</b> - El nuevo participante no pudo ser agregado</span>';
						}
					} else {
						//print_r('aa');die;
						$mis_errores["general"] = '<span class="error">El <b>ticket</b> ya se encuentra registrado.</span>';
					}
				} else {
					$mis_errores["general"] = '<span class="error">Su ticket no es válido</b> y su <b>Confirmación</b> </span>';
				}
			} else {			
				//echo validation_errors('<span class="error">','</span>');

	//tratamiento de errores
				$error = validation_errors();
				$errores = explode("<b class='requerido'>*</b>", $error);
				$campos = array(
				    "ciudad" => 'Ciudad',
				    "ticket" => 'Núm de ticket',
				    "compra" => 'Fecha de compra',
   				    "tienda" => 'Tienda',
				       "sku" => 'SKU',
				    "monto" => 'Monto de la compra',
				);





				    foreach ($errores as $elemento) {

						foreach ($campos as $clave => $valor) {
							
						        if (stripos($elemento, $valor) !== false) {
						        	if  ($valor=="Requerido") {
						         		$mis_errores[$clave] = $elemento; //condiciones
						        	} else {
						        		$mis_errores[$clave] = '*';
						        	}						

						        	$mis_errores[$clave] = substr($elemento, 0, -5);   //condiciones 	
						        }
						}    	
				    }

				    if ($mis_errores["ticket"] !='') {
				    	$mis_errores["ticket"] =  '<span class="error">Su ticket no es <b>válido</b> </span>';	
				    }
				    
				    

			}
			
		}
		echo json_encode($mis_errores);
	}


///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

	//esto es para la rueda
	function juego_json() {
				$segmentos = $this->modelo_registro->listado_segmentos();


				if ( $segmentos != FALSE ){
					foreach ($segmentos as $clave => $segmento) {
						

							$colores[] ='#'.$segmento->color;

							$dato[]= array(
	  							"probability" =>  (base64_decode($this->session->userdata('cripto_ruleta')) == ($clave+1) ) ? 100 : 0,
	  							//"probability" =>  (8== ($clave+1) ) ? 100 : 0,
					            "type" => "string",
					            "value" => $segmento->valor,  //valor
					            "win" => $segmento->ganar,   //ganar
					            "resultText" => $segmento->texto,  //texto
					            "userData" => array("score" => $segmento->puntos)  //puntos
                               );				
					}
				}

				//print_r($dato);die;
				
					
				//header('Content-type: application/json');
				$data = array(
				"colorArray" => $colores, 
				"segmentValuesArray" => 
					$dato,

				"svgWidth" => 1024,
				"svgHeight" => 768,

				//Rueda principal
				"wheelStrokeColor" => "#FFFFFF", //"#D0BD0C", //HEX, RGB o RGBA valor para el color del contorno principal de la rueda
				"wheelStrokeWidth" => 18,        //ancho del borde principal de la rueda
				"wheelSize" => 500,   //Tamaño del diámetro de la rueda

				//texto que se encuentra dentro de cada segmento
				    "wheelTextOffsetY" => 100, //hasta qué punto el texto debe estar en el segmento
				    "wheelTextColor" => "#23CE3F",  //color del texto
				    "wheelTextSize" => "2.3em",  //font size “tamaño de la fuente

				//image que se encuentra dentro de cada segmento
				    "wheelImageOffsetY" => 40,
				    "wheelImageSize" => 50,

				//círculo central
				"centerCircleSize" => 120,               //diámetro del círculo central
				"centerCircleStrokeColor" => "transparent",  //color del trazo del círculo central
				//"centerCircleStrokeWidth" => 12,        //ancho del trazo del círculo central 
				"centerCircleFillColor" => "transparent",    //color de relleno del círculo central 



				//Segmentos
				"segmentStrokeColor" => "#fff",  //HEX, RGB or RGBA valores para el contorno del segmento
				"segmentStrokeWidth" => 4,          //ancho del contorno segmento
				    "centerX" => 512,               //esto es por lo general la mitad del valor svgWidth 
				    "centerY" => 384,               //esto es por lo general la mitad del valor svgHeight
				    "hasShadows" => true,


				"numSpins" => 1 ,
				"minSpinDuration" =>6,
				"spinDestinationArray" => array(),

				"gameOverText" => "GRACIAS POR JUGAR LA RUEDA SPIN2WIN. VEN Y JUEGA DE NUEVO!!",
				"invalidSpinText" =>"SPIN INVALIDO. POR FAVOR GIRAR DE NUEVO.",
				//"introText" => "Hola<br>lanza <span style='color=>#F282A9;'>1</span> para ganar!",
				"introText" => '',
				"hasSound" => false, //true, //sonido
				"gameId" => "9a0232ec06bc431114e2a7f3aea03bbe2164f1aa",
				"clickToSpin" => true //true es obligatorio cuando se hable de "probabilidades"

				);

				echo json_encode( $data);

	}

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////juego///////////////////////////////////////////////////////////////////////////////////
    function tarjetas(){
  		if($this->session->userdata('session_participante') === TRUE ){
			if ($this->session->userdata('num_ticket_participante')) {
				$data["id_participante"] = $this->session->userdata('id_participante');
				$dato 		=   $this->modelo_registro->record_personal($data);

				$this->load->view( 'juegos/jugar',$dato);
			} else {
				 redirect('registro_ticket');
			}
		} else { 
		  redirect('');
		}
	}

	function respuesta_tarjeta(){ 
		$valor = (int)$this->input->post( 'valor' );
		$pos = base64_decode($this->session->userdata('cripto_ruleta'));
		//pos y valor
		$data['formato'] = $this->session->userdata('tarjeta_participante').$pos.'+'.$valor.'-'.';';
		$data['posicion'] = $pos;
		$data['valor'] = $valor;

		//if guarda bien entonces
		$data 		  		= $this->security->xss_clean( $data );
		$guardar	 		= $this->modelo_registro->actualizar_respuesta_tarjeta( $data );
		if ( $guardar !== FALSE ){  
			$this->session->set_userdata('tarjeta_participante', $data['formato']);
		}	
		echo json_encode($data);        
	}






////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

public function	proc_modal_felicidades(){
 			if ( $this->session->userdata('session_participante') !== TRUE ) {
		      redirect('');
		    } else {
		    	
		    	$puntos = $this->modelo_registro->felicidades();
				$data['total'] = $puntos->total;

				    	//limpiar nuevamente
				$this->session->set_userdata('tarjeta_participante', '');
				$this->session->set_userdata('juego_participante', '');
				$this->session->set_userdata('num_ticket_participante', '');
				$this->session->set_userdata('registro_ticket', false );

		    	$this->session->set_userdata('abriendo_face', true );
		    	$data['total_facebook'] = $this->modelo_registro->total_facebook();


		       
               $this->load->view( 'juegos/modal_felicidades',$data );
		    }   			

	}



	//este todavía pero es el que voy a poner encima de las felicidades
	 public function proc_modal_facebook(){ //nuevo
			  if ( $this->session->userdata('session_participante') !== TRUE ) {
			      redirect('');
			    } else {
	               $this->load->view( 'registros/modal_face' );
			   }   			
	}


	function registrar_facebook($puntos){ //nuevo
			if ( $this->session->userdata( 'session_participante' ) == TRUE ){

				
				$ticket['total'] = (int) ($puntos);
				if  ($ticket['total']>0) { //si compartio el total>0
		
		

					$ticket['redes'] = 1;
					$ticket 						= $this->security->xss_clean( $ticket );

					$data['total_facebook'] = $this->modelo_registro->total_facebook();
					if  (($data['total_facebook']==false) ) {
						$guardar 						= $this->modelo_registro->actualizar_redes_compartir( $ticket );        	
					}	
				} 
				 //redirect('/registro_ticket');  //comparta o no va a ir al registro de ticket
				redirect('/nest20197p2/record/'.$this->session->userdata('id_participante'));
			}	

	}


	function record($id_participante){
		if ( $this->session->userdata( 'session_participante' ) == TRUE ){
			$data["id_participante"] = $id_participante;
			$dato 		=   $this->modelo_registro->record_personal($data);
			//print_r($dato);die;
			$this->load->view( '/juegos/record',$dato );
		}	
	}	



		/*
	//este es quien hace la pregunta, ya no se va a utilizar	
	 public function proc_modal_juego(){
		  if ( $this->session->userdata('session_participante') !== TRUE ) {
		      redirect('');
		    } else {
		      	$data['pregunta'] = $this->modelo_registro->get_preguntas();
               $this->load->view( 'tickes/modal_instrucciones',$data );
		   }   			
	}*/

		
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
/*

SELECT
AES_DECRYPT(juego, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS juego,
AES_DECRYPT(tarjeta, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tarjeta


   FROM calimax_registro_participantes

*/



	function mecanica(){ 
		
		$this->load->view( 'dashboard/mecanica' );

	}

	function recetas(){ 
		$this->load->view( 'dashboard/recetas' );
	}


	function facebook(){ 
		$this->load->view( 'facebook' );
	}


	function aviso(){ 
		$this->load->view( 'dashboard/aviso' );
	}	
	
	function legales(){ 
		$this->load->view( 'dashboard/legales' );
	}	

	function eleccion_premio(){ 
		if (( $this->session->userdata( 'session_participante' ) == TRUE ) && ($this->session->userdata('premiado_participante') == 1)  && ($this->session->userdata('id_premio_participante') == 0) ) {

			$data['premios']   = $this->catalogo->listado_premios();
			

			$this->load->view( 'premios/premios' ,$data);
		}	else {
			redirect('');
		}
	}	


	public function ganadores(){
		$this->load->view( 'home/ganadores' );
	}




/////////////////validaciones/////////////////////////////////////////	


	public function valid_cero($str)
	{
		return (  preg_match("/^(0)$/ix", $str)) ? FALSE : TRUE;
	}

	function nombre_valido( $str ){
		 $regex = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{2,60})$/i";
		//if ( ! preg_match( '/^[A-Za-zÁÉÍÓÚáéíóúÑñ \s]/', $str ) ){
		if ( ! preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'nombre_valido','<b class="requerido">*</b> La información introducida en <b>%s</b> no es válida.' );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_phone( $str ){
		if ( $str ) {
			if ( ! preg_match( '/\([0-9]\)| |[0-9]/', $str ) ){
				$this->form_validation->set_message( 'valid_phone', '<b class="requerido">*</b> El <b>%s</b> no tiene un formato válido.' );
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function valid_option( $str ){
		if ($str == 0) {
			$this->form_validation->set_message('valid_option', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_date( $str ){

		$arr = explode('-', $str);
		if ( count($arr) == 3 ){
			$d = $arr[0];
			$m = $arr[1];
			$y = $arr[2];
			if ( is_numeric( $m ) && is_numeric( $d ) && is_numeric( $y ) ){
				return checkdate($m, $d, $y);
			} else {
				$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.');
				return FALSE;
			}
		} else {
			$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD/MM/YYYY.');
			return FALSE;
		}
	}

	public function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	////Agregado por implementacion de registro insitu para evento/////
	public function opcion_valida( $str ){
		if ( $str == '0' ){
			$this->form_validation->set_message('opcion_valida',"<b class='requerido'>*</b>  Selección <b>%s</b>.");
			return FALSE;
		} else {
			return TRUE;
		}
	}


}

/* End of file main.php */
/* Location: ./app/controllers/main.php */