<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class registros extends CI_Model{    
    private $key_hash;
    private $timezone;

    function __construct(){
      parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';

        //usuarios
          $this->usuarios             = $this->db->dbprefix('usuarios');
          $this->perfiles             = $this->db->dbprefix('perfiles');

          $this->configuraciones      = $this->db->dbprefix('catalogo_configuraciones');
          
          $this->proveedores          = $this->db->dbprefix('catalogo_empresas');
          $this->historico_acceso     = $this->db->dbprefix('historico_acceso');

          $this->catalogo_estados      = $this->db->dbprefix('catalogo_estados');
          $this->catalogo_litraje      = $this->db->dbprefix('catalogo_litraje');

          $this->participantes      = $this->db->dbprefix('participantes');
          $this->bitacora_participante     = $this->db->dbprefix('bitacora_participante');
          $this->catalogo_imagenes         = $this->db->dbprefix('catalogo_imagenes');
          $this->catalogo_preguntas         = $this->db->dbprefix('catalogo_preguntas');
          $this->registro_participantes         = $this->db->dbprefix('registro_participantes');
          
          $this->coordenadas         = $this->db->dbprefix('coordenadas');
          $this->catalogo_cupones         = $this->db->dbprefix('catalogo_cupones');

          $this->catalogo_cadenas         = $this->db->dbprefix('catalogo_cadenas');
          $this->catalogo_productos         = $this->db->dbprefix('catalogo_productos');
          $this->catalogo_litrajes         = $this->db->dbprefix('catalogo_litrajes');

          
          
           
         
            $this->fecha_unixtime_inicio    = strtotime('07/15/2018');  
            $this->fecha_unixtime_hoy    = now(); //strtotime("now");

    }

        public function listado_cadenas(){
            $this->db->select( 'id, nombre' );
            $estados = $this->db->get($this->catalogo_cadenas );
            if ($estados->num_rows() > 0 )
               return $estados->result();
            else
               return FALSE;
            $estados->free_result();
        }   





        public function listado_productos(){
            $this->db->select( 'id, nombre' );
            $estados = $this->db->get($this->catalogo_productos );
            if ($estados->num_rows() > 0 )
               return $estados->result();
            else
               return FALSE;
            $estados->free_result();
        }  



        public function listado_litrajes(){
            $this->db->select( 'id, nombre' );
            $estados = $this->db->get($this->catalogo_litrajes );
            if ($estados->num_rows() > 0 )
               return $estados->result();
            else
               return FALSE;
            $estados->free_result();
        }  

////////////////////////////////////cupones////////////////////////

    public function get_cupones() {
          
          $this->db->select( 'id' ); //, valor
          $this->db->from($this->catalogo_cupones.' as c');
          $where='(
              (c.activo=0)
          )';
          $this->db->where($where);
          $result = $this->db->get();

          if($result->num_rows()>0) {
              return $result->result();
          } else {
               return FALSE;
            
          }

          $result->free_result();

    }


 public function get_cupon($id) {
          
          $this->db->select( 'id, valor' );
          $this->db->from($this->catalogo_cupones.' as c');
          $where='(
              (c.activo=0) and  (c.id='.$id.')
          )';
          $this->db->where($where);
          $result = $this->db->get();

          if($result->num_rows()>0) {
              return $result->row();
          } else {
               return FALSE;
            
          }

          $result->free_result();

    }

    


public function check_12horas($email) {
          
          $this->db->select( 'max(c.fecha_participacion) as fecha_participacion',false );
          $this->db->from($this->catalogo_cupones.' as c');
          $where='(
                
                (c.email="'.$email.'")
          )';
          $this->db->where($where);
          $result = $this->db->get();

          if($result->num_rows()>0) {
            if  ( ($result->row()->fecha_participacion+43200)>=$this->fecha_unixtime_hoy ) {
              return true;
            } else {
              return false;
            }

          } else {
               return FALSE;
            
          }

          $result->free_result();

    }

    public function anadir_email_a_cupon( $data ){
            $timestamp = time();

            $this->db->set( 'fecha_participacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'email','"'.$data['email'].'"', FALSE );
            $this->db->set( 'activo', 1 );
            //86400 = 24hrs
            //43200 = 12hrs
            $where='(
               (id='.$data["id"].')
            )';
            $this->db->where($where);
            
            $this->db->update($this->catalogo_cupones );
  
              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
     }        



////////////////////////////////////Localizador////////////////////////
    public function get_markers() {
          $markers = $this->db->get($this->coordenadas.' as c');
          if($markers->num_rows()>0) {
              return $markers->result();
          }
    }

      //valor predictivo
      public function buscador_vendedor($data){
            
            $this->db->select("id,cd, estado, domicilio, cp,  formato, fecha, lat, lng");  
            $this->db->from($this->coordenadas);
            
            $this->db->like("cd" ,$data['key'],FALSE);
            $this->db->or_like("estado" ,$data['key'],FALSE);
            $this->db->or_like("domicilio" ,$data['key'],FALSE);
            $this->db->or_like("cp" ,$data['key'],FALSE);
            $this->db->or_like("formato" ,$data['key'],FALSE);
            //$this->db->or_like("fecha" ,$data['key'],FALSE);
            $this->db->or_like("lat" ,$data['key'],FALSE);
            $this->db->or_like("lng" ,$data['key'],FALSE);

              $result = $this->db->get();
              if ( $result->num_rows() > 0 ) {
                  foreach ($result->result() as $row) 
                      {
                            $dato[]= array(
                                       "value"=>$row->id." | ".$row->domicilio.' '.$row->cp,
                                       "key"=>$row->id,
                                       "descripcion"=>$row->formato.' '.$row->estado,

                                       "cd"=>$row->cd,
                                       "estado"=>$row->estado,
                                       "domicilio"=>$row->domicilio,
                                       "cp"=>$row->cp,
                                       "formato"=>$row->formato,
                                       "lat"=>$row->lat,
                                       "lng"=>$row->lng,


                                    );
                      }
                      return json_encode($dato);
              }   
              else 
                 return False;
              $result->free_result();
      }    


      

     //valor predictivo
      public function buscador_cp($data){
            

            $this->db->select("id,cd, estado, domicilio, cp,  formato, fecha, lat, lng");  
            $this->db->from($this->coordenadas);
            $this->db->like("cp" ,$data['key'],FALSE);

            $this->db->group_by("cp");

              $result = $this->db->get();
              if ( $result->num_rows() > 0 ) {
                  foreach ($result->result() as $row) 
                      {
                            $dato[]= array(
                                       "key"=>$row->id,
                                       "cp"=>$row->cp,
                                       "lat"=>$row->lat,
                                       "lng"=>$row->lng,
                                    );
                      }
                      return json_encode($dato);
              }   
              else 
                 return False;
              $result->free_result();
      }    



////////////////////////////////////fin de localizador////////////////////////


		//Recuperar contraseña	del participante
	    public function recuperar_contrasena($data){
	    	$this->db->select("id", FALSE);						
			$this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);						
			$this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);			
			$this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);			
      $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
			$this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);			
			$this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
			$this->db->from($this->participantes.' as p');
			$this->db->where('p.email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return $login->result();
			else 
				return FALSE;
			$login->free_result();		
	    }	

          public function listado_segmentos(){

            $this->db->select('c.id, c.nombre, c.valor, c.activo, c.puntos, c.ganar, c.color, c.texto');
            
            $this->db->from($this->catalogo_imagenes.' as c');
            $this->db->where('c.activo',0);
            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }  


         public function actualizar_redes_compartir($data){
             $this->db->set( 'redes', 1 ); //$data['redes']

            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            //$this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('num_ticket_participante')}','{$this->key_hash}')",FALSE);

              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio
           
            $this->db->update($this->registro_participantes);
            
            
            
            







              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }        

            /*
            $this->db->set( 'tarjeta', "AES_ENCRYPT('{$data['formato']}','{$this->key_hash}')", FALSE );
            
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('num_ticket_participante')}','{$this->key_hash}')",FALSE);*/
            





        public function listado_preguntas(){
            $this->db->select( 'id' );
            $preguntas = $this->db->get($this->catalogo_preguntas );
            if ($preguntas->num_rows() > 0 )
                 

               return $preguntas->result();
            else
               return FALSE;
            $estados->free_result();
        }   



        public function get_preguntas(){
            $this->db->select( 'id, pregunta, a, b, respuesta' );
            $this->db->from($this->catalogo_preguntas);
            $this->db->where('id', $this->session->userdata( 'pregunta'));
            $preg = $this->db->get();
            if ($preg->num_rows() > 0)
              return $preg->row();
            else
              return TRUE;
            $login->free_result();
        }



        //checar si el correo ya fue registrado
    public function check_correo_existente($data){
      $this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);      
      $this->db->from($this->participantes);
      $this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
      $login = $this->db->get();
      if ($login->num_rows() > 0)
        return FALSE;
      else
        return TRUE;
      $login->free_result();
    }

       //agregar participante
    public function anadir_registro( $data ){
            $timestamp = time();

            
            $this->db->set( 'total', "AES_ENCRYPT(0,'{$this->key_hash}')", FALSE );  //total comienza en 0
            //$this->db->set( 'tarjeta', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0
            //$this->db->set( 'juego', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0

            $this->db->set( 'id_perfil', $data['id_perfil']);
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'id', "UUID()", FALSE); //id

            $this->db->set( 'id_facebook', $data['id_facebook']);

            $this->db->set( 'nombre', "AES_ENCRYPT('{$data['nombre']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'apellidos', "AES_ENCRYPT('{$data['apellidos']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'fecha_nac', strtotime(date( "d-m-Y", strtotime($data['fecha_nac']) )) ,false);
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'nick', "AES_ENCRYPT('{$data['nick']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );


            $this->db->set( 'calle', "AES_ENCRYPT('{$data['calle']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'numero', $data['numero']);
            $this->db->set( 'colonia', "AES_ENCRYPT('{$data['colonia']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'municipio', "AES_ENCRYPT('{$data['municipio']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'cp', "AES_ENCRYPT('{$data['cp']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_estado', $data['id_estado']);
            $this->db->set( 'celular', "AES_ENCRYPT('{$data['celular']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'ciudad', "AES_ENCRYPT('{$data['ciudad']}','{$this->key_hash}')", FALSE );
            


            $this->db->insert($this->participantes );

            if ($this->db->affected_rows() > 0){
                  return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }


     //checar el loguin y recoger datos de usuario registrado
    public function check_login_nick($data){
          $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);

          $this->db->from($this->participantes.' as p');
            
          $this->db->where('p.nick', "AES_ENCRYPT('{$data['nick']}','{$this->key_hash}')", FALSE); 
          $this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->result();
          else 
            return FALSE;
          $login->free_result();
    }    


        //facebook
 public function check_login_facebook($data){
          $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);

          $this->db->from($this->participantes.' as p');
            
          $this->db->where('p.nick', "AES_ENCRYPT('{$data['nick']}','{$this->key_hash}')", FALSE); 
          $this->db->where('p.email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE);
          $this->db->where('p.id_facebook', $data['id_facebook'], FALSE);
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->result();
          else 
            return FALSE;
          $login->free_result();
    }   
  


     //checar el login del participante
        public function check_login($data){
          $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);

          //$this->db->select("AES_DECRYPT(p.tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);
          //$this->db->select("AES_DECRYPT(p.juego,'{$this->key_hash}') AS juego", FALSE);

          $this->db->from($this->participantes.' as p');
            
          $this->db->where('p.email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE); 
          $this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->result();
          else 
            return FALSE;
          $login->free_result();
        }        



      //agregar a la bitacora de participante sus accesos  
       public function anadir_historico_acceso($data){
            $timestamp = time();
            $ip_address = $this->input->ip_address();
            $user_agent= $this->input->user_agent();

            $this->db->set( 'id_usuario', $data->id); // luego esta se compara con la tabla participante
            $this->db->set( 'email', "AES_ENCRYPT('{$data->email}','{$this->key_hash}')", FALSE );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'ip_address',  $ip_address, TRUE );
            $this->db->set( 'user_agent',  $user_agent, TRUE );
            $this->db->insert($this->bitacora_participante );
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }




 //----------------**************catalogos-------------------************------------------
        public function listado_estados(){
            $this->db->select( 'id, nombre' );
            $estados = $this->db->get($this->catalogo_estados );
            if ($estados->num_rows() > 0 )
               return $estados->result();
            else
               return FALSE;
            $estados->free_result();
        }   





        /////////////////////ticket//////////////////////////


        //checar si el tickets ya fue registrado
        public function check_tickets_existente($data){
            $this->db->select("AES_DECRYPT(tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);
            $this->db->select("AES_DECRYPT(juego,'{$this->key_hash}') AS juego", FALSE);
            $this->db->from($this->registro_participantes);
            $this->db->where('ticket',"AES_ENCRYPT('{$data['ticket']}','{$this->key_hash}')",FALSE);
            $login = $this->db->get();
            if ($login->num_rows() > 0)
                return false; // $login->row();
            else
                return TRUE;
            $login->free_result();
        }





            //agregar participante
        public function anadir_tickets( $data ){
            $timestamp = time();

            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            
            $id_participante = $this->session->userdata('id_participante');
            $this->db->set( 'id_participante', '"'.$id_participante.'"',false); // id del usuario que se registro

            $this->db->set( 'ciudad', '"'.$data['ciudad'].'"', FALSE );
            $this->db->set( 'ticket', "AES_ENCRYPT('{$data['ticket']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'compra', strtotime(date( "d-m-Y", strtotime($data['compra']) )) ,false);
            
            $this->db->set( 'tienda', '"'.$data['tienda'].'"', FALSE );
            $this->db->set( 'sku', '"'.$data['sku'].'"', FALSE );

            $this->db->set( 'monto', "AES_ENCRYPT('{$data['monto']}','{$this->key_hash}')", FALSE );

            $this->db->set( 'id_cadena', $data['id_cadena']);
            $this->db->set( 'id_producto', $data['id_producto']);
            $this->db->set( 'id_litraje', $data['id_litraje']);


            
            
            //el orden de las cartas
            $this->db->set( 'puntos', "AES_ENCRYPT('{$data['puntos']}','{$this->key_hash}')", FALSE );
            //tarjeta vacia inicialmente
            $this->db->set( 'tarjeta', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0
            $this->db->set( 'juego', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0
            $this->db->insert($this->registro_participantes );
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }   


         public function actualizar_respuesta_tarjeta($data){
            $this->db->set( 'tarjeta', "AES_ENCRYPT('{$data['formato']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'posicion', "AES_ENCRYPT('{$data['posicion']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'valor', "AES_ENCRYPT('{$data['valor']}','{$this->key_hash}')", FALSE );

            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('num_ticket_participante')}','{$this->key_hash}')",FALSE);
             $this->db->update($this->registro_participantes );
  
              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }



       

 public function felicidades(){

          $this->db->select("
           sum(
                 (AES_DECRYPT( r.valor,  '{$this->key_hash}')) 
              ) AS total

            ",false );
                         
          $this->db->select("AES_DECRYPT(r.tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);
          
          $this->db->from($this->participantes.' as p');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante','left');

          $this->db->where("r.id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
          $this->db->where('r.ticket',"AES_ENCRYPT('{$this->session->userdata('num_ticket_participante')}','{$this->key_hash}')",FALSE);

          $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->row();
            else
               return False;
            $result->free_result();


         } 


    

   public function total_facebook(){

         
        $this->db->select("(sum( r.redes=1)* 77) AS total", FALSE); 

          $this->db->from($this->registro_participantes.' as r');
          $this->db->where("r.id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
        

          $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return  (int) ($result->row()->total);
            else
               return False;
            $result->free_result();


         } 


      public function record_personal(){
           
          
          $this->db->select("count(p.id) cantida_ticket");   

            $this->db->select("
             sum(
                 (AES_DECRYPT( r.valor,  '{$this->key_hash}')) + ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}'))))
              ) AS total

            ",false ); 


          $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')) AS puntos", FALSE);
          $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS total_redes", FALSE); 

          //devuelve la semana en q estoy
          $semana_actual=ceil(((ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)==0) ? 1 : ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)) / 7) ;

          $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual-1) );
          $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual) )-1;

          
          $this->db->select($semana_actual." as semana_actual",false);

          ////separado   no lo uso por el momento. actual
          $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) ) AS puntos_semana", FALSE);
          $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}'))))*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) AS total_redes_semana", FALSE); 


          for ($i=1; $i <=7 ; $i++) { 

            
            $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i-1) );
            $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i) )-1;
            
           $this->db->select("sum( AES_DECRYPT(r.valor, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) + ( (r.redes =1)*(( AES_DECRYPT(r.valor, '{$this->key_hash}')))*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) ) AS puntos_semana".$i, FALSE);
            
             
            
            //separado   no lo uso por el momento
            $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) ) AS puntos_semana_solo".$i, FALSE);
            $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) *( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) AS total_redes_semana_solo".$i, FALSE); 

            
          


          }




          //r.fecha_pc >= ".$primer_dia_semana_actual." AND ". r.fecha_pc <= ".$ultimo_dia_semana_actual." 

          //$this->db->select("( CASE WHEN r.fecha_pc >= ".$primer_dia_semana_actual." AND  THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(r.fecha_pc),'%d-%m-%Y %H:%i:%s') END ) AS fecha_unixtime_hoy", FALSE);  


          $this->db->select("p.fecha_pc");   
          $this->db->select("AES_DECRYPT(p.nombre, '{$this->key_hash}') AS nombre", FALSE);
          $this->db->select("AES_DECRYPT(p.Apellidos, '{$this->key_hash}') AS Apellidos", FALSE);
          $this->db->select("AES_DECRYPT(p.nick, '{$this->key_hash}') AS nick", FALSE);
          
         


          $this->db->from($this->participantes.' as p');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');

          $this->db->where("p.id", '"'.$this->session->userdata('id_participante').'"',false);  

          
          $this->db->group_by("p.id");

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->row();
            else
               return False;
            $result->free_result();


      }  

















        /*
                   SELECT AES_DECRYPT( juego,  'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS juego, 
AES_DECRYPT( tarjeta, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS tarjeta, 
id_pregunta, AES_DECRYPT( responder, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS responder,
AES_DECRYPT( posicion, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS posicion, 
AES_DECRYPT( valor, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS valor 

FROM calimax_registro_participantes


SELECT AES_DECRYPT( juego,  'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS juego, AES_DECRYPT( tarjeta, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS tarjeta, id_pregunta, responder, AES_DECRYPT( posicion, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS posicion, AES_DECRYPT( valor,  'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5' ) AS valor
FROM calimax_registro_participantes

*/


      
}    
