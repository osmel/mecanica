<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
todosganan2019.com
git remote add osmel https://github.com/osmel/mecanica.git
git push -u osmel master

osmel
osmel5458

https://tecadmin.net/install-php5-on-ubuntu/
eliminar 7.0
sudo apt-get purge php7.*
 apt-get autoremove php7.*
 apt-get install  php5.6-mcrypt

https://www.todosganan2019.com/7up/user_authentication

todosganan2019.com
git remote add osmel https://github.com/osmel/mecanica.git
git push -u osmel master


https://www.todosganan2019.com/7up/user_authentication/logout

desinstalar mysql y mariadb
https://www.eninsoft.com/eliminar-completamente-mariadb-o-mysql-en-debian9/

https://www.g2khosting.com/blog/uso-seguro-de-aes-encrypt-con-mysql/

<Directory /var/www/html/>
  Options Indexes FollowSymLinks
  AllowOverride None
  Require all granted
</Directory>

*/

//wqgQRnSU6j8bmqcN


class User_Authentication extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        
        //Las librerías de Google y el modelo de usuario se cargan en este método.
        
        // Cargando la librería "google oauth" 
        
        $this->load->library('google');
        
        // Cargando el modelo user
        $this->load->model('user');
        $this->load->model('registros', 'modelo_registro'); 
    }


  /* Indice
    esta función maneja la funcionalidad de autenticación con la cuenta de Google. 
    Si el usuario se autentica con Google, sucede lo siguiente:

   * - Conéctese y autentíquese con la "API de Google OAuth" utilizando la librería de Google OAuth.
  
   * - Obtener la información del perfil del usuario de la cuenta de Google.

   * - Inserte los datos de la cuenta de Google en la base de datos usando el método checkUser () del modelo de usuario.
  
   * - Almacene el token de estado de inicio de sesión y los datos del perfil de usuario en la sesión.
    
   * - Redirigir al usuario a la página de perfil.
    
    Para el usuario no autenticado, se genera la URL de autenticación de Google y se carga la vista de inicio de sesión.
*/
    

     public function index(){
        
        //Redirigir a la página de perfil si el usuario ya ha iniciado sesión
        if($this->session->userdata('loggedIn') == true){
            redirect('user_authentication/profile/');
        }
        

        //print_r  (isset($_GET['code']) ==1  ) ;
        
        if(isset($_GET['code'])){
            
            // Autenticar usuario con google
            if($this->google->getAuthenticate()){
            
                // Obtener información de usuario de google
                $gpInfo = $this->google->getUserInfo();
                
                
                //Preparación de datos para la inserción de la base de datos
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid']      = $gpInfo['id'];
                $userData['first_name']     = $gpInfo['given_name'];
                $userData['last_name']      = $gpInfo['family_name'];
                $userData['email']          = $gpInfo['email'];
                $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
                $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
                $userData['link']           = !empty($gpInfo['link'])?$gpInfo['link']:'';
                $userData['picture']        = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
                
                // Insertar o actualizar datos de usuario a la base de datos.
                $userID = $this->user->checkUser($userData);
                
                // Almacena el estado y la información del perfil del usuario en la sesión
                $this->session->set_userdata('session_participante', TRUE);
                $this->session->set_userdata('loggedIn', true);
                $this->session->set_userdata('userData', $userData);


 //////////////////////////////////////////
            
            

            $data['id_perfil']           = 3;
            $data['id_facebook']             = 2; //significa gmail $userData['oauth_uid']

            $data['nombre']              = $userData['first_name'].' '.$userData['last_name'];
            $data['apellidos']           = $userData['last_name'];
            $data['email']               = $userData['email'];
            $data['nick']               = $userData['first_name'].' '.$userData['last_name'];

            //checar si el usuario ya existe
            $login_checkeo = $this->user->check_login_gmail($data);

            if (!(is_array($login_checkeo))) {   //si NO existe el usuario, agregarlo
                  $userID = $this->user->anadir_gmail($data);
                   //Enonces checar nuevamente el loguin y recoger datos de usuario registrado
                    $login_checkeo = $this->user->check_login_gmail($data);
             }

            
            //agrega al historico de acceso de participantes
            $this->modelo_registro->anadir_historico_acceso($login_checkeo[0]);  

            $this->session->set_userdata('session_participante', TRUE);
            $this->session->set_userdata('email_participante', $data['email']);

            
            
            if (is_array($login_checkeo))  //si existe el usuario
                foreach ($login_checkeo as $element) {
                    $this->session->set_userdata('id_participante', $element->id);
                    $this->session->set_userdata('nombre_participante', $element->nombre);
                    $this->session->set_userdata('tarjeta_participante', '');
                    $this->session->set_userdata('juego_participante', '');
                    $this->session->set_userdata('nick_participante', $element->nick);
                    //$this->session->set_userdata('juego_participante', $element->juego);
                }


           //////////////////////////////////////////  


                
                // Redirigir a la página de perfil
                redirect('user_authentication/profile/');
            }
        } 
            
            

        // URL de autenticación de Google
        $data['loginURL'] = $this->google->loginURL();  //get_login_url();  //->

        return $data['loginURL'];

    }
    

    /* Perfil
      Recuperar los datos de usuario de la SESIÓN.
      Cargue la vista de perfil para mostrar la información del perfil de Google.
    */
    public function profile(){
        // Redirigir a la página de inicio de sesión si el usuario no ha iniciado sesión
        if(!$this->session->userdata('loggedIn')){
            redirect('/user_authentication/');
        }
            
            // Obtener información de usuario de la sesión
            $userData = $this->session->userdata('userData');
            
                                     


        redirect('/registro_ticket/MQ==');
        //Cargar vista de perfil de usuario
        //$this->load->view('user_authentication/profile',$data);
    }

    /*

        cerrar sesión 
        - Restablezca el token de acceso mediante la función revokeToken() de la biblioteca de Google OAuth.
        - Eliminar los datos de la cuenta de usuario de la SESIÓN.
        - Cierre la sesión del usuario de la cuenta de Google.
    */
    
    public function logout(){
        // Restablecer el token de acceso OAuth
        $this->google->revokeToken();
        
        // Eliminar token y datos de usuario de la sesión
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        
        // Destruye toda la sesión de datos.
        $this->session->sess_destroy();
        
        // Redirigir a la página de inicio de sesión
        redirect('/user_authentication/');
    }
    
}