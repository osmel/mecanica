<?php 
//require_once('google-api-php-client-2.2.3/vendor/autoload.php');

/*
require_once('google-api-php-client-2.2.3/vendor/autoload.php');

require APPPATH .'third_party/google-login-api/contrib/apiOauth2Service.php';
*/

class Google {
	protected $CI;

	public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->config->load('google'); //cargar la configuración


        require __DIR__ .'/third_party/google-login-api/apiClient.php';

		require __DIR__ .'/third_party/google-login-api/contrib/apiOauth2Service.php';

		

        //$this->client = new Google_Client();
        $this->client = new apiClient();



        $this->client->setApplicationName($this->CI->config->item('google_application_name'));
		$this->client->setClientId($this->CI->config->item('google_client_id'));
		$this->client->setClientSecret($this->CI->config->item('google_client_secret'));
		$this->client->setRedirectUri($this->CI->config->item('google_redirect_url'));

		$this->client->setDeveloperKey($this->CI->config->item('google_api_key'));

		$this->client->setScopes($this->CI->config->item('google_scopes'));
		
		/*
		$this->client->setScopes(array(  //google_scopes
			"https://www.googleapis.com/auth/plus.login",
			"https://www.googleapis.com/auth/plus.me",
			"https://www.googleapis.com/auth/userinfo.email",
			"https://www.googleapis.com/auth/userinfo.profile"
			)
		);
  
		*/
		$this->client->setAccessType('online');
		$this->client->setApprovalPrompt('auto');
		$this->oauth2 = new apiOauth2Service($this->client);
		//print_r($this->oauth2); 
		//die;


	}

	

	

	public function loginURL() {
        return  $this->client->createAuthUrl();
    }
	
	public function getAuthenticate() {
        return $this->client->authenticate();
    }
	
	public function getAccessToken() {
        return $this->client->getAccessToken();
    }
	
	public function setAccessToken() {
        return $this->client->setAccessToken();
    }
	
	public function revokeToken() {
        return $this->client->revokeToken();
    }
	
	public function getUserInfo() {
        return $this->oauth2->userinfo->get();
    }

    ////////////////////////////
	public function get_login_url(){
		return  $this->client->createAuthUrl();

	}

	public function validate(){		
		if (isset($_GET['code'])) {
		  $this->client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $this->client->getAccessToken();

		}
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		  $this->client->setAccessToken($_SESSION['access_token']);
		  $plus = new Google_Service_Plus($this->client);
			$person = $plus->people->get('me');
			$info['id']=$person['id'];
			$info['email']=$person['emails'][0]['value'];
			$info['name']=$person['displayName'];
			$info['link']=$person['url'];
			$info['profile_pic']=substr($person['image']['url'],0,strpos($person['image']['url'],"?sz=50")) . '?sz=800';

		   return  $info;
		}


	}

}