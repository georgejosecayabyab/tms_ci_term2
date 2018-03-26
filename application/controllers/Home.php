<?php if(!defined('BASEPATH')) exit('Direct access not allowed');
	
	class home extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model('home_model');
			
		}

		/**
		 * Loads home page
		 */
		public function index()
		{
			$data['awards'] = $this->home_model->get_awards_list();
			$data['news'] = $this->home_model->get_news_list();
			$data['news_1'] = $this->home_model->get_specific_news(1);
			$data['news_2'] = $this->home_model->get_specific_news(2);
			$data['news_3'] = $this->home_model->get_specific_news(3);
			$data['defense'] = $this->home_model->get_defense_list();
			$data['active_tab'] = array(
				'home' => "active",
				'login' => "",
			);

			$this->load->view('home/complete_home_view', $data);
		}
		
	}
?>