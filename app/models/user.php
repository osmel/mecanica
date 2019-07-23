<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
  /*  

        User.php
    El modelo de usuario se utiliza para insertar/actualizar datos en la tabla de usuarios.


*/

    /* defina el nombre de la tabla de la base de datos y la clave principal. */
    function __construct() {

     parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';


        $this->tableName      = $this->db->dbprefix('users');
        $this->primaryKey = 'id';

        $this->participantes      = $this->db->dbprefix('participantes');
    }
    
/*
   inserte o actualice los datos de la cuenta de usuario en la base de datos según el ID y el proveedor de OAuth.
*/
    public function checkUser($data = array()){
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        
        $con = array(
            'oauth_provider' => $data['oauth_provider'],
            'oauth_uid' => $data['oauth_uid']
        );
        $this->db->where($con);
        
        $query = $this->db->get();
        
        $check = $query->num_rows();
        
        if($check > 0){
            // Obtener datos previos de usuario
            $result = $query->row_array();
            
            // Actualizar datos de usuario
            $data['modified'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName, $data, array('id'=>$result['id']));
            
            //  id del usuario
            $userID = $result['id'];
        }else{
            // Insertar datos de usuario
            $data['created'] = date("Y-m-d H:i:s");
            $data['modified'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$data);
            
            // id de Usuario
            $userID = $this->db->insert_id();
        }
        
        // retorna id de usuario
        return $userID?$userID:false;
    }




      public function check_login_gmail($data){
          $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);

          $this->db->from($this->participantes.' as p');
            
          
          $this->db->where('p.email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE);
          $this->db->where('p.id_facebook', 2);
          
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->result();
          else 
            return FALSE;
          $login->free_result();
    }   



        public function anadir_gmail( $data ){
            $timestamp = time();

            
            $this->db->set( 'total', "AES_ENCRYPT(0,'{$this->key_hash}')", FALSE );  //total comienza en 0
            $this->db->set( 'id_perfil', $data['id_perfil']);
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'id', "UUID()", FALSE); //id

            $this->db->set( 'id_facebook', $data['id_facebook']);

            $this->db->set( 'nombre', "AES_ENCRYPT('{$data['nombre']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'apellidos', "AES_ENCRYPT('{$data['apellidos']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'nick', "AES_ENCRYPT('{$data['nick']}','{$this->key_hash}')", FALSE );
            

            $this->db->insert($this->participantes );

            if ($this->db->affected_rows() > 0){
                  return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }





}