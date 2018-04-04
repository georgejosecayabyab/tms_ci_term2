<?php 

	if(!defined('BASEPATH')) exit('Direct access not allowed');

	class super_user extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model('super_user_model');


			$this->load->helper('download');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('email');
			//check if session exist

			$session = $this->session->userdata();
			$user_id = $session['user_id'];
			$user_type = $session['user_type'];
			if($user_type != 3) exit('Access not allowed');
			// $if_coordinator = $this->coordinator_model->if_coordinator($user_id);
			// if(sizeof($if_coordinator) == 0)
			// {
			// 	exit('Access not allowed');
			// }
		}

		/**
		 * @description Loads super user home page
		 */
		public function index()
		{
			$data['coordinator'] = $this->super_user_model->get_all_coordinators();
			$this->load->view('super_user/super_user_base_head', $data);
			$this->load->view('super_user/super_user_home_view', $data);
			$this->load->view('super_user/super_user_base_foot', $data);
		}


		/**
		 * @description Logs out logged in user
		 */
		public function logout()
		{
            $g_client = $this->google->get_client();
            $g_client->setAccessToken($this->session->userdata('access_token'));

			$data = array(
				'access_token' => '',
				'user_id' => '',
				'user_type' => ''
			);
			$this->session->unset_userdata($data);
			$this->session->sess_destroy();
			$g_client->revokeToken();
			redirect("home/index");
		}

		/**
		 * @description Updates user's status to inactive or active
		 */
		public function update_user_status()
		{
			$user_id = $this->input->post('user_id');
			$status = $this->input->post('status');
			$status_to_be = "";
			if($status == 0)
			{
				$status_to_be = 1;
			}
			else
			{
				$status_to_be = 0;
			}
			$this->super_user_model->update_user_status($user_id, $status_to_be);
			$data = $this->super_user_model->get_user_info($user_id);

			header('Content-Type: application/json');
			echo json_encode($data);
		}

		/**
		 * @description Inserts a new coordinator in the database
		 */
		public function insert_user()
		{
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email = $this->input->post('email');
			date_default_timezone_set('Asia/Manila');
			$date_time = date("Y-m-d H:i:s");

			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');

			if($this->form_validation->run() == FALSE)
			{
				//// set flash data
				$this->session->set_flashdata('fail', validation_errors());
				redirect('super_user');
			}
			else
			{
				$email_exist = $this->super_user_model->get_user_by_email($email);
				if(sizeof($email_exist) == 0)
				{
					$user = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'password' => 1234,
						'email' => $email,
						'is_active' => 1,
						'date_joined' => $date_time,
						'profile_pic' => NULL,
						'user_type' => 2,

					);
					$this->super_user_model->insert_user($user);
					$this->session->set_flashdata('success', 'Coordinator has been created!');
					redirect('super_user');
				}
				else
				{
					$this->session->set_flashdata('fail', 'Email already exists!');
					redirect('super_user');
				}
				
			}

			
		}
	}
?>