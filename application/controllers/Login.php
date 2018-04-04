<?php if(!defined('BASEPATH')) exit('Direct access not allowed');

	class login extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model('login_model');

			$this->load->library('form_validation');

			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->helper('html');

		}


		/**
		 * @description Function responsible for creating google client object
		 * and redirecting to check() with the google token
		 */
		public function index()
		{
			$g_client = $this->google->get_client();
			$code = isset($_GET['code']) ? $_GET['code'] : NULL;
			$token = $g_client->fetchAccessTokenWithAuthCode($code);
            $g_client->setAccessToken($token);
            $pay_load = $g_client->verifyIdToken();
            $refresh_token = $g_client->getRefreshToken();
			$json_encode = json_encode($pay_load);
			$url_encode = $this->base64UrlEncode($json_encode);
			$json_token_encode = json_encode($token);
			$url_token_encode = $this->base64UrlEncode($json_token_encode);
			redirect('login/check/'.$url_encode.'/'.$url_token_encode);
		}


		/**
		 * @description Checks what type of user is then redirects to proper home page
		 * @param  String $url_encode      	Contains user email address and other information
		 * @param  String $url_token_encode 	Contains google auth token
		 */
		public function check($url_encode, $url_token_encode)
		{
			$url_decode = $this->base64UrlDecode($url_encode);
			$json_decode = json_decode($url_decode, true);
			$pay_load = $json_decode;		
			$url_token_decode = $this->base64UrlDecode($url_token_encode);
			$json_token_decode = json_decode($url_token_decode, true);
			$token = $json_token_decode;
			$email = $pay_load["email"];
		    $result = $this->login_model->if_user_gmail($email);

			if(sizeof($result) > 0)
			{
				//user exist and correct
				$user_type = $this->login_model->is_student($result['user_id']);
				$data = [
					'access_token' => $token,
					'user_id' => $result['user_id'],
					'user_type' => $user_type['user_type']
				];

				$this->session->set_userdata($data);

				//student or faculty
				if($user_type['user_type']  == 0)
				{
					redirect("student");
				}
				else if($user_type['user_type']  == 1)
				{
					redirect("faculty");
				}
				
				else if($user_type['user_type'] == 3)
				{
					redirect("super_user");
				}
				else
				{
					redirect("coordinator");
				}
			}
			else
			{

				$this->session->set_flashdata('fail', 'Invalid email or password!');
                redirect('home');
			}
		}
		
		/**
		 * @description Sets google auth
		 * @return object Google client object
		 */
		public function google()
		{
			require ("vendor/autoload.php");
			//Step 1: Enter you google account credentials

			$g_client = new Google_Client();

			$g_client->setClientId("1067483480445-gengh3tq4anad9odhqs0fralk85veclh.apps.googleusercontent.com");
			$g_client->setClientSecret("lQMtpbYso3Hw0FD3G-H8srEq");
			$g_client->setRedirectUri("http://localhost/tms_ci/index.php/login");     
			$g_client->setScopes("https://www.googleapis.com/auth/plus.login profile email https://mail.google.com/ https://www.googleapis.com/auth/gmail.compose");
			$g_client->setAccessType("offline");

			return $g_client;
		}

		/**
		 * @description Encodes a string input
		 * @param  String $inputStr 	String to be encoded
		 * @return String				Encoded $inputStr		
		 */
		public function base64UrlEncode($inputStr)
        {
            return strtr(base64_encode($inputStr), '+/=', '-_,');
        }

        /**
         * @description Decodes a string input
         * @param  String $inputStr String to be decoded
         * @return String           Decoded $inputStr
         */
        public function base64UrlDecode($inputStr)
        {
            return base64_decode(strtr($inputStr, '-_,', '+/='));
        }

	}

?>