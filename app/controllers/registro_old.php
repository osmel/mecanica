<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registro extends CI_Controller {

	public function __construct(){ 
		parent::__construct();

		$this->load->model('admin/modelo', 'modelo'); 
		$this->load->model('registros', 'modelo_registro'); 
		$this->load->model('admin/catalogo', 'catalogo');  
		$this->load->library(array('email')); 
		$this->tiempo_comienzo      = "00:10";
	}

	public function index(){
		$this->dashboard();
	}

	function dashboard(){ 
		self::configuraciones();
		$data['nodefinido_todavia']        = '';
		$this->load->view( 'home/dashboard',$data );
	}

	public function mecanica1(){
		$this->load->view( 'mecanica1/dashboard' );
	}


/////////// cupones///mecanica2 //////////////////////
	public function cupones(){
		//
		//$temp = rand(10000, 99999);
		//$valor = 609055645645464564699;
		/*
		//el numero que va a salir
		$datos = $this->modelo_registro->get_cupones();
		foreach ($datos as $row) {
			$misdatos[]=$row->id;
		}	
		shuffle($misdatos);  //shuffle mezcla un array (creando un orden aleatorio de sus elementos).
		//print_r($misdatos[0]);die;
		$datos['cupon'] = $this->modelo_registro->get_cupon($misdatos[0]);
		//print_r($datos['cupon']);die;


		$valor = $datos['cupon']->valor; //en cadena soporta el tamaño necesario, en numero solo 19caracteres
		$data['codigobarra'] = $this->set_barcode($valor);
		*/
		
		$this->load->view( 'mecanica2/cupones' );
	}


	private function set_barcode($code)	{
			//cargando la librería	
		 	$this->load->library('zend');
		 	//cargando en carpeta Zend
		   $this->zend->load('Zend/Barcode');
		   //generar el codigo de barra
		   $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
		   //$code = time().$code;
		   //guardando la imagen de codigo generada en .png en la carpeta "barcode"
		   $store_image = imagepng($file,"barcode/{$code}.png");
		   //retornarlo para imprimirlo en la vista
		   return $code.'.png';
	}




function validar_correo_cupon(){
		
			$mis_errores=array(
					"exito" => false,				    
				    "email" => '',
				    "coleccion_id_aviso" =>  '',
				    "coleccion_id_base" =>  '',
				    'general'=> '',
			);

			$this->form_validation->set_rules( 'email', 'Correo', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('coleccion_id_aviso', 'Aviso de privacidad', 'callback_accept_terms[coleccion_id_aviso]');	
			$this->form_validation->set_rules('coleccion_id_base', 'Términos y condiciones', 'callback_accept_terms[coleccion_id_base]');	
	
			//todos los datos  y  la transaccion sea menor al monto
			if ( ($this->form_validation->run() === TRUE)  ) {
					$data['email']   			= $this->input->post( 'email' );
					$ya_participo = $this->modelo_registro->check_12horas( $data['email'] );


					//si NO HA participado o ya culmino sus 12 horas de espera
					if ( $ya_participo != TRUE ){		
							//el numero que va a salir
							$datos = $this->modelo_registro->get_cupones();
							if ($datos != false) {
								foreach ($datos as $row) {
									$misdatos[]=$row->id;
								}	
								shuffle($misdatos);  //shuffle mezcla un array (creando un orden aleatorio de sus elementos).
								//print_r($misdatos[0]);die;
								$datos['cupon'] = $this->modelo_registro->get_cupon($misdatos[0]);
								//print_r($datos['cupon']);die;


								$data['valor'] = $datos['cupon']->valor; //en cadena soporta el tamaño necesario, en numero solo 19caracteres
								$data['id'] = $datos['cupon']->id;

								//$data['codigobarra'] = $this->set_barcode($data['valor']);
							

								$data 						= $this->security->xss_clean( $data );
								$guardar 						= $this->modelo_registro->anadir_email_a_cupon( $data );

								$mis_errores['codigobarra']= $this->set_barcode($data['valor']);	;
								$mis_errores['exito'] = true;	
							} else {
									$mis_errores["general"] = '<span class="error">Ya no fue posible, se agotaron los cupones.</span>';		
							}	
						
					
					} else {
						$mis_errores["general"] = '<span class="error">Debe esperar 12 horas para canjear otro cupón.</span>';
					}
				
			} else {			
				//echo validation_errors('<span class="error">','</span>');

	//tratamiento de errores
				$error = validation_errors();
				$errores = explode("<b class='requerido'>*</b>", $error);
				$campos = array(
				    "email" => 'Correo',
				    "coleccion_id_aviso" => 'Aviso de privacidad',
				    "coleccion_id_base" => 'Términos y condiciones',
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

				
				    
				    

			}
			
		
		echo json_encode($mis_errores);
	}

  public function enviando_correo_cupon(){
  	    $data['email']   			    = $this->input->post( 'email' );
  	    $data['url_imagen']   			= $this->input->post( 'url_imagen' );
  	    
		$this->email->from('admin@ganacon7up.com', 'Refréscate y gana con 7up');
		$this->email->to( $data['email'] );
		$this->email->subject('Refréscate y gana con 7up'); //.$this->session->userdata('c2')
		$this->email->message( $this->load->view('admin/correos/envio_cupon', $data, TRUE ) );
		$this->email->send();
		

		//$data['vista'] = $this->email->message( $this->load->view('admin/correos/envio_cupon', $data, TRUE ) );

		echo json_encode($data);


  }	


////////////////////////////////////



  public function buscador(){
       $data['key']=$_GET['key'];
       $data['nombre']=$_GET['nombre'];
       
       switch ($data['nombre']) {
		      case 'editar_localizador':
	    	        $busqueda = $this->modelo_registro->buscador_vendedor($data);
    	      break;

			  case 'editar_cp':
	    	        $busqueda = $this->modelo_registro->buscador_cp($data);
    	      break;    	      
       }
       echo $busqueda;
  }


	public function miposicion() {
		 //print_r($this->input->ip_address());
		 echo json_encode($this->googlemaps->get_lat_long_from_address($this->input->ip_address()));
		 //die;
		//echo json_encode(  $this->input->ip_address()  );
	}	


	public function localizador() {
		 //creamos la configuración del mapa con un array
		 $config = array();
		       
		        //la zona del mapa que queremos mostrar al cargar el mapa
		        //como vemos le podemos pasar la ciudad y el país
		        //en lugar de la latitud y la longitud
		 //$config['center'] = 'madrid,espana';
		 $config['center'] = '19.3655, -99.2646';  //Álvaro Obregón, Ciudad de México
		 //$config['center'] = 'auto';  //Álvaro Obregón, Ciudad de México

		        // el zoom, que lo podemos poner en auto y de esa forma
		        //siempre mostrará todos los markers ajustando el zoom	
		 $config['zoom'] = '10'; //14
		        //el tipo de mapa, en el pdf podéis ver más opciones
		 $config['map_type'] = 'ROADMAP';  //“HYBRID”, “ROADMAP”, “SATELLITE”, “TERRAIN”,“STREET”
		        //el ancho del mapa 
		 $config['map_width'] = '700px'; 
		        //el alto del mapa	
		 $config['map_height'] = '600px'; 
		        
		  $config['https'] = 'TRUE';        
		        //inicializamos la configuración del mapa	
		 $this->googlemaps->initialize($config); 
		 
		 print_r($_POST['location']);die;

		 //hacemos la consulta al modelo para pedirle 
		 //la posición de los markers y el domicilio
		 $markers = $this->modelo_registro->get_markers();
		 foreach($markers as $info_marker) {
		 $marker = array();
		            //podemos elegir DROP o BOUNCE
		 $marker ['animation'] = 'DROP';
		            //posición de los markers
		 $marker ['position'] = $info_marker->lat.','.$info_marker->lng;
		            //domicilio de los markers(ventana de información)	
		 $marker ['infowindow_content'] = $info_marker->domicilio;
		            //la id del marker
		 $marker['id'] = $info_marker->id; 
		 $this->googlemaps->add_marker($marker);

		 //print_r($this->input->ip_address());
		 //print_r($this->googlemaps->get_lat_long_from_address($this->input->ip_address()));
		 //die;

		 
		            //podemos colocar iconos personalizados así de fácil
		 //$marker ['icon'] = base_url().'imagenes/'.$fila->imagen;
		 
		 //si queremos que se pueda arrastrar el marker
		 //$marker['draggable'] = TRUE;
		 //si queremos darle una id, muy útil
		 }


		 $miposicion = array();
		 $miposicion ['animation'] = 'DROP';
		            //posición de los markers
		 $pos=($this->googlemaps->get_lat_long_from_address($this->input->ip_address()));
		 $miposicion['position'] = $pos[0].','.$pos[1];
		            //domicilio de los markers(ventana de información)	
		 $miposicion['infowindow_content'] = 'mi posicion';
		            //la id del marker
		 
		 $miposicion['id'] = 99999; 
		 $this->googlemaps->add_marker($miposicion);
		 
		 //en $data['datos'tenemos la información de cada marker para
		        //poder utilizarlo en el sidebar en nuestra vista mapa_view
		 $data['datos'] = $this->modelo_registro->get_markers();
		        //en data['map'] tenemos ya creado nuestro mapa para llamarlo en la vista
		 $data['map'] = $this->googlemaps->create_map();
		 //print_r($data['map']); die;
		 //$this->load->view('mecanica2/mapa_view',$data);
		 $this->load->view( 'mecanica2/localizadordetiendas', $data);
		 //$this->load->view( 'mecanica2/mimapaBorrar', $data);
	}

	public function localizador2(){
	
			// Load the library
			$this->load->library('googlemaps');
			// Load our model
			$this->load->model('map_model', '', TRUE);
			// Initialize the map, passing through any parameters
			$config['center'] = '1600 Amphitheatre Parkway in Mountain View, Santa Clara County, California';
			$config['zoom'] = "auto";
			$this->googlemaps->initialize($config);
			// Get the co-ordinates from the database using our model
			$coords = $this->map_model->get_coordinates();
			// Loop through the coordinates we obtained above and add them to the map
			foreach ($coords as $coordinate) {
			$marker = array();
			$marker['position'] = $coordinate->lat.','.$coordinate->lng;
			$this->googlemaps->add_marker($marker);
			}
			// Create the map
			$data = array();
			$data['map'] = $this->googlemaps->create_map();
			// Load our view, passing through the map data
					$this->load->view( 'mecanica2/localizadordetiendas', $data);
	}




	public function configuraciones(){
			    $configuraciones = $this->modelo->listado_configuraciones();
				if ( $configuraciones != FALSE ){
					if (is_array($configuraciones))
						foreach ($configuraciones as $configuracion) {
							$this->session->set_userdata('c'.$configuracion->id, $configuracion->valor);
							$this->session->set_userdata('a'.$configuracion->id, $configuracion->activo);
						}
				} 
	}

    public function vigentes(){
		$this->load->view( 'home/vigentes' );
	}


   // Creación usuario (jugador)
	function nuevo_registro($mecanica){ //="MQ=="
		$data['mecanica']= base64_decode($mecanica);
		if($this->session->userdata('session_participante') === TRUE ){   //si esta logueado  ir al home
				  redirect('');
		} else {  //nuevo registro
			  $data['estados']   = $this->modelo_registro->listado_estados();
			  $this->load->view( 'home/registro',$data );   
			  //$this->load->view( 'registros/registro',$data );   
		}    
	}

 //validando registro usuario creado
function validar_registros(){

		if ($this->session->userdata('session_participante') == TRUE) {
			redirect('');
		} else {
			$this->form_validation->set_rules( 'nombre', 'Nombre', 'trim|required|callback_nombre_valido|min_length[3]|max_length[50]|xss_clean');
			$this->form_validation->set_rules( 'apellidos', 'Apellido(s)', 'trim|required|callback_nombre_valido|min_length[3]|max_length[50]|xss_clean');
			$this->form_validation->set_rules( 'email', 'Correo', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules( 'fecha_nac', 'Fecha de nacimiento', 'trim|required|callback_valid_nacimiento[fecha_nac]|xss_clean');
			$this->form_validation->set_rules( 'calle', 'Calle', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'numero', 'Número', 'trim|required|min_length[1]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'colonia', 'Colonia', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'municipio', 'Municipio', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			
			$this->form_validation->set_rules( 'cp', 'CP', 'trim|required|min_length[2]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('id_estado', 'Ciudad', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules( 'celular', 'Celular', 'trim|required|numeric|min_length[10]|callback_valid_phone|xss_clean');
			$this->form_validation->set_rules( 'telefono', 'Teléfono', 'trim|numeric|min_length[8]|callback_valid_phone|xss_clean');
			//$this->form_validation->set_rules( 'id_estado_compra', 'Cd. de compra', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules( 'ciudad', 'Cd. de compra', 'trim|required|callback_nombre_valido|min_length[3]|max_length[50]|xss_clean');
			$this->form_validation->set_rules( 'nick', 'Usuario', 'trim|required|min_length[3]|max_length[50]|callback_cadena_noacepta|xss_clean');
			$this->form_validation->set_rules( 'pass_1', 'La contraseña', 'required|trim|min_length[8]|xss_clean');
			$this->form_validation->set_rules( 'pass_2', 'Confirmación de contraseña', 'required|trim|min_length[8]|xss_clean');

			$this->form_validation->set_rules('coleccion_id_aviso', 'Aviso de privacidad', 'callback_accept_terms[coleccion_id_aviso]');	
			$this->form_validation->set_rules('coleccion_id_base', 'Términos y condiciones', 'callback_accept_terms[coleccion_id_base]');	
		

			$mis_errores=array(
						"exito" => false,
						"general" => '',

					    "nombre" =>  '',
					    "apellidos" =>  '',
					    "email" =>  '',
					    "fecha_nac" =>  '',
					    "calle" =>  '',
					    "numero" =>  '',
					    "colonia" =>  '',
					    "municipio" =>  '',

					    "cp" =>  '',
					    "id_estado" =>  '',
					    "celular" =>  '',
					    "telefono" =>  '',
					    //"id_estado_compra" =>  '',
					    "ciudad"=>'',
						"nick" =>  '',
					    'pass_1'=> '',
					    'pass_2'=>  '',

					    "coleccion_id_aviso" =>  '',
					    "coleccion_id_base" =>  '',
				);
			


			if ($this->form_validation->run() === TRUE){

				if ($this->input->post( 'pass_1' ) === $this->input->post( 'pass_2' ) ){
					$data['email']			=	$this->input->post('email');
					$data['contrasena']		=	$this->input->post('pass_1');
					$data 				= 	$this->security->xss_clean($data);  
					$login_check = $this->modelo_registro->check_correo_existente($data);

					if ( $login_check != FALSE ){		

						$usuario['id_facebook']   			= $this->input->post( 'id_facebook' );
						
						$usuario['nombre']   			= $this->input->post( 'nombre' );
						$usuario['apellidos']   		= $this->input->post( 'apellidos' );
						$usuario['email']   			= $this->input->post( 'email' );
						$usuario['fecha_nac']   		= $this->input->post( 'fecha_nac' );
						$usuario['telefono']   		= $this->input->post( 'telefono' );
						$usuario['nick']   				= $this->input->post( 'nick' );
						$usuario['contrasena']				= $this->input->post( 'pass_1' );


						$usuario['calle']   			= $this->input->post( 'calle' );
						$usuario['numero']   			= $this->input->post( 'numero' );
						$usuario['colonia']   			= $this->input->post( 'colonia' );
						$usuario['municipio']   		= $this->input->post( 'municipio' );
						$usuario['cp']   			= $this->input->post( 'cp' );
						$usuario['id_estado']   		= $this->input->post( 'id_estado' );
						$usuario['celular']   		= $this->input->post( 'celular' );
						//$usuario['id_estado_compra']   		= $this->input->post( 'id_estado_compra' );
						$usuario['ciudad']				= $this->input->post( 'ciudad' );
						

						$usuario['id_perfil']   		= 3; //significa participante

						$usuario 						= $this->security->xss_clean( $usuario );
						$guardar 						= $this->modelo_registro->anadir_registro( $usuario );

						
						if ( $guardar !== FALSE ){  

									$dato['nick']   			    = $usuario['nick'];   			
									$dato['contrasena']				= $usuario['contrasena'];				

									
									//envio de correo para notificar alta en usuarios del sistema
									
									$desde = $this->session->userdata('c1');
									$esp_nuevo = $usuario['email'];
									
									$this->email->from('admin@ganacon7up.com', 'Refréscate y gana con 7up');
									$this->email->to( $esp_nuevo );
									$this->email->subject('Gracias por registrarte a Refréscate y gana con 7up'); //.$this->session->userdata('c2')
									$this->email->message( $this->load->view('admin/correos/alta_usuario', $dato, TRUE ) );
									$this->email->send();

									
									//envio de correo para notificar alta en usuarios del sistema
									/*
									$desde = $this->session->userdata('c1');
									$esp_nuevo = $usuario['email'];
									$this->email->from('admin@promoscasaley.com.mx', 'Momentos para Compartir 7up');
									$this->email->to( $esp_nuevo );
									$this->email->subject('Momentos para Compartir 7up'); //.$this->session->userdata('c2')
									$this->email->message( $this->load->view('admin/correos/alta_usuario', $dato, TRUE ) );
									$this->email->send();

									$desde = $this->session->userdata('c1');
									$esp_nuevo = $usuario['email'];
									$this->email->from('admin@promoscasaley.com.mx', 'Momentos para Compartir 7up');
									$this->email->to( $esp_nuevo );
									$this->email->subject('Momentos para Compartir 7up'); //.$this->session->userdata('c2')
									$this->email->message( $this->load->view('admin/correos/receta', $dato, TRUE ) );
									$this->email->send();
									*/
										 
									//if ($this->email->send()) 
										//{	//si se notifico al usuario, que envie a los administradores un correo
										/*
										$dato['email']   			    = $usuario['email'];   			
										$dato['contrasena']				= $usuario['contrasena'];				
										$dato['nombre']   			    = $usuario['nombre'];   			
										$dato['apellidos']				= $usuario['apellidos'];
										$dato['celular']   			    = $usuario['celular'];   			

											
										$this->load->library('email');
										$this->email->from('admin@vamonosaespanaconcalimax.com', 'Información Calimax');
										$this->email->to('guerreroadrian1111@gmail.com,carlos.ramirez@lostres.mx');	

										$this->email->subject('Nuevo usuario en Vamonos a España Calimax');
										$this->email->message( $this->load->view('admin/correos/alta_usuarios', $dato, TRUE ) );
										$this->email->send();*/

									
									//checar el loguin y recoger datos de usuario registrado
									//$login_checkeo = $this->modelo_registro->check_login($usuario);
									$login_checkeo = $this->modelo_registro->check_login_nick($usuario);
									//agrega al historico de acceso de participantes
									$this->modelo_registro->anadir_historico_acceso($login_checkeo[0]);  

									$this->session->set_userdata('session_participante', TRUE);
									$this->session->set_userdata('email_participante', $usuario['email']);

									
									
									if (is_array($login_checkeo))  //si existe el usuario
										foreach ($login_checkeo as $element) {
											$this->session->set_userdata('id_participante', $element->id);
											$this->session->set_userdata('nombre_participante', $element->nombre.' '.$element->apellidos);
											$this->session->set_userdata('tarjeta_participante', '');
											$this->session->set_userdata('juego_participante', '');
											$this->session->set_userdata('nick_participante', $element->nick);
											//$this->session->set_userdata('juego_participante', $element->juego);
										}


										//cantidad de ; para saber a donde redirigir
										$mis_errores['redireccion'] = 'registro_ticket';	

										$mecanica = 1; //(int)$this->input->post( 'mecanica' );
										switch ($mecanica) {
											case 0:
													$mis_errores['redireccion'] = 'vigentes';	
												break;
											case 1:
													$mis_errores['redireccion'] = 'registro_ticket/'.$mecanica;	
												break;
											case 2:
													$mis_errores['redireccion'] = 'registro_ticket/'.$mecanica;	
												break;
											
											default:
												 $mis_errores['redireccion'] = 'vigentes';	
												break;
										}
										//cantidad de ; para saber a donde redirigir
										


										
										$mis_errores['exito'] = true;	



										//$mis_errores = true;
								
									/*} else {
										 $mis_errores["general"] = '<span class="error"><b>E01</b> - El nuevo participante no pudo ser agregado</span>';
									}*/
									
									/*
						} else {
							
							 	 $mis_errores["general"] = '<span class="error"><b>E01</b> - El nuevo participante no pudo ser agregado</span>';
							 
						}*/
						
					} else {  //if ( $guardar !== FALSE ){  
						
								 	 
							 
						
					}
				} else { //if ( $login_check != FALSE ){
					
					$mis_errores["general"] = '<span class="error">El <b>Correo electrónico</b> ya se encuentra registrado.</span>';		 	
							 
						
					
				}
			} else {	//if ($this->input->post( 'pass_1' ) === $this->input->post( 'pass_2' ) ){		
				
					$mis_errores["general"] = '<span class="error">No coinciden la Contraseña </b> y su <b>Confirmación</b> </span>';


		} ////if ($this->form_validation->run() === TRUE){

			//$mis_errores = true;


	} //fin del else if ($this->session->userdata('session_participante') == TRUE) {


//tratamiento de errores
				$error = validation_errors();
				
				$errores = explode("<b class='requerido'>*</b>", $error);
				$campos = array(
				    "nombre" => 'Nombre',
				    "apellidos" => 'Apellido(s)',
				    "email" => 'Correo',
				  	"fecha_nac" => 'Fecha de nacimiento',  
				  	"calle" => 'Calle',
				    "numero" => 'Número',
				    "colonia" => 'Colonia',
				    "municipio" => 'Municipio',

					"cp" => 'CP',
					"id_estado" => 'Ciudad',
					"celular" => 'Celular',
					"telefono" => 'Teléfono',
					//"id_estado_compra" =>  'Cd.',
					"ciudad" =>  'Cd.',
					"nick" => 'Usuario',
				    'pass_1'=>'La contraseña',
				    'pass_2'=>'Confirmación',
				    
				    "coleccion_id_aviso" => 'Aviso de privacidad',
				    "coleccion_id_base" => 'Términos y condiciones',
				    
				);




				    foreach ($errores as $elemento) {
				    	//echo $elemento.'<br/>';
						foreach ($campos as $clave => $valor) {
								
						        if (stripos($elemento, $valor) !== false) {
						        	if  ($valor=="requerido") {
						         		$mis_errores[$clave] = $elemento; //condiciones
						        	} else {
						        		$mis_errores[$clave] = '*';
						        	}						

						        	$mis_errores[$clave] = substr($elemento, 0, -5);   //condiciones 	
						        }
						}    	
				    }
			


				    echo json_encode($mis_errores);


			} //else

			
			//self::configuraciones_imagenes();

}		



  
 function ingresar_usuario($mecanica){
 	    //$mecanica=1;
 		$data['mecanica']= 1; //base64_decode($mecanica);
 		$this->session->set_userdata('mecanica',$mecanica );
		if ($this->session->userdata( 'session_participante' ) == TRUE )    { //ya esta registrado
			 redirect('/registro_ticket/'.$mecanica);
		} else {
			
			$this->load->view( 'registros/login',$data);
		}
 }



	function validar_login_facebook(){

				$data['nick']		=	$this->input->post('nick');
				$data['email']		=	$this->input->post('email');
				$data['id_facebook']		=	$this->input->post('id_facebook');

				$datos['login_checkeo'] = $this->modelo_registro->check_login_facebook($data);

				echo json_encode($datos);


	}	


	function validar_login_participante(){
				$mis_errores=array(
					"exito" => false,
				    //"email" => '',
				    "nick" => '',
				    "contrasena" => '',
				    'general'=> '',
				);

		//$this->form_validation->set_rules( 'email', 'Correo', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules( 'nick', 'Usuario', 'trim|required|min_length[3]|max_length[50]|callback_cadena_noacepta|xss_clean');
		$this->form_validation->set_rules( 'contrasena', 'Contraseña', 'required|trim|min_length[8]|xss_clean');

		if ( $this->form_validation->run() == TRUE ){
				//$data['email']		=	$this->input->post('email');
				$data['nick']		=	$this->input->post('nick');
				$data['id_facebook']		=	$this->input->post('id_facebook');

				$data['contrasena']		=	$this->input->post('contrasena');
				$data 				= 	$this->security->xss_clean($data);  

				//$login_checkeo = $this->modelo_registro->check_login($data);
				$login_checkeo = $this->modelo_registro->check_login_nick($data);
				
				if ( $login_checkeo != FALSE ){

					$this->modelo_registro->anadir_historico_acceso($login_checkeo[0]);  //agrega al historico de acceso de participantes

					$this->session->set_userdata('session_participante', TRUE);
					//$this->session->set_userdata('email_participante', $data['email']);
					$this->session->set_userdata('nick_participante', $data['nick'] );


					if (is_array($login_checkeo))  //si existe el usuario
					
						foreach ($login_checkeo as $element) {
							$this->session->set_userdata('id_participante', $element->id);
							$this->session->set_userdata('nombre_participante', $element->nombre.' '.$element->apellidos);
							$this->session->set_userdata('tarjeta_participante', '');
							$this->session->set_userdata('juego_participante', '');
						}					

										
					//cantidad de ; para saber a donde redirigir

							$mecanica = 1; // (int)$this->input->post( 'mecanica' );
							switch ($mecanica) {
								case 0:
										$mis_errores['redireccion'] = 'vigentes';	
									break;
								case 1:
										$mis_errores['redireccion'] = 'registro_ticket/'.base64_encode($mecanica);	
									break;
								case 2:
										$mis_errores['redireccion'] = 'registro_ticket/'.base64_encode($mecanica);	
									break;
								
								default:
									 $mis_errores['redireccion'] = 'vigentes';	
									break;
							}	

							//print_r($mis_errores);die;

					

					$mis_errores['exito'] = true;	
				} else {
					//$mis_errores['exito'] = true;	
					$mis_errores["general"] = '<span class="error">Tus datos no son correctos, verificalos e intenta nuevamente por favor.</span>';
				}
		} else {		
				//tratamiento de errores
				$error = validation_errors();
				$errores = explode("<b class='requerido'>*</b>", $error);
				$campos = array(
				    //"email" => 'Correo',
				    "nick" => 'Usuario',
				    "contrasena" => 'Contraseña',
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

		}	

		echo json_encode($mis_errores);
		//self::configuraciones_imagenes();
	}	





//recuperar constraseña OK
	function recuperar_participante(){ //NO FUNCIONA ERA PARA RECUPERAR CONTRASEÑA
		$this->load->view('registros/recuperar_password');
	}
	




//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	public function desconectar_participante(){
		$this->session->sess_destroy();
		redirect('');
	}	





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function cadena_noacepta( $str ){
		$regex = "/(uefa|pepsi|champio)/i";
		if ( preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'cadena_noacepta',"<b class='requerido'>*</b> La información introducida en <b>%s</b> no está permitida." );
			return FALSE;
		} else {
			return TRUE;
		}
	}



	function valid_fecha( $str, $campo ){
		if ($this->input->post($campo)){
			
			
			$fecha_inicial =  strtotime( date("Y-m-d", strtotime("03/15/2017") ) );
		    $fecha_compra  =  strtotime( date("Y-m-d", strtotime($this->input->post($campo)) ) );
			          $hoy =   strtotime(date("Y-m-d") );
			if ( ($fecha_compra>=$fecha_inicial) && ($fecha_compra<=$hoy) ) {
				return true;
			} else {
				$this->form_validation->set_message( 'valid_fecha',"<b class='requerido'>*</b> Su <b>%s</b> es incorrecta." );	
				return false;
			}

		} else {
			$this->form_validation->set_message( 'valid_fecha',"<b class='requerido'>*</b> Es obligatorio <b>%s</b>." );
			return false;
		}	

	}







	


/////////////////validaciones/////////////////////////////////////////	




	function accept_terms($str,$campo) {
        if ($this->input->post($campo)){
			return TRUE;
		} else {
			$this->form_validation->set_message( 'accept_terms',"<b class='requerido'>*</b> Favor lee y acepta <b>%s</b>." );
			return FALSE;
		}
	}

	function valid_phone( $str ){
		if ( $str ) {
			if ( ! preg_match( '/\([0-9]\)| |[0-9]/', $str ) ){
				$this->form_validation->set_message( 'valid_phone', "<b class='requerido'>*</b> El <b>%s</b> no tiene un formato válido." );
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function valid_nacimiento( $str, $campo ){
		if ($this->input->post($campo)){
			$hoy =  new DateTime (date("Y-m-d", strtotime(date("d-m-Y"))) );
			$fecha_nac = new DateTime ( date("Y-m-d", strtotime($this->input->post($campo)) ) );
			$fecha = date_diff($hoy, $fecha_nac);
			/*
			print_r($hoy); 
			echo '<br>';
			print_r($fecha_nac); 
			echo '<br>';
			print_r($fecha->y); 
			echo '<br>';
			print_r($fecha); die;
			*/
			if ( ($fecha->y>=18) && ($fecha->y<=2150) ) {
				return true;
			} else {
				$this->form_validation->set_message( 'valid_nacimiento',"<b class='requerido'>*</b> Su <b>%s</b> debe ser mayor a 18 años." );	
				return false;
			}

		} else {
			$this->form_validation->set_message( 'valid_nacimiento',"<b class='requerido'>*</b> Es obligatorio <b>%s</b>." );
			return false;
		}	

	}



	public function valid_cero($str) {
		return (  preg_match("/^(0)$/ix", $str)) ? FALSE : TRUE;
	}

	function nombre_valido( $str ){
		 $regex = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{2,60})$/i";
		//if ( ! preg_match( '/^[A-Za-zÁÉÍÓÚáéíóúÑñ \s]/', $str ) ){
		if ( ! preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'nombre_valido',"<b class='requerido'>*</b> La información introducida en <b>%s</b> no es válida." );
			return FALSE;
		} else {
			return TRUE;
		}
	}



	function valid_option( $str ){
		if ($str == 0) {
			$this->form_validation->set_message('valid_option', "<b class='requerido'>*</b> Es necesario que selecciones una <b>%s</b>.");
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
				$this->form_validation->set_message('valid_date', "<b class='requerido'>*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.");
				return FALSE;
			}
		} else {
			$this->form_validation->set_message('valid_date', "<b class='requerido'>*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD/MM/YYYY.");
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
