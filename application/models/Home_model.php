<?php if(!defined('BASEPATH')) exit('No direct access allowed');

	class home_model extends CI_Model
	{
		public function __constructs()
		{
			parent::__constructs();
		}


		//gets all awards
		public function get_awards_list()
		{
			$query = $this->db->get('award');
			return $query->result_array();
		}

		//get specific award by id
		public function get_award($id)
		{	$this->db->where('award_id', $id);
			$query = $this->db->get('award');
			return $query->first_row('array');
		}

		//gets all news
		public function get_news_list()
		{
			$query = $this->db->get('news');
			return $query->result_array();
		}

		//get specific news by id
		public function get_news($id)
		{	$this->db->where('news_id', $id);
			$query = $this->db->get('news');
			return $query->first_row('array');
		}

		//gets all defense
		public function get_defense_list()
		{
			$query = $this->db->get('defense_date');
			return $query->result_array();
		}

		//get specific award by id
		public function get_defense($id)
		{	$this->db->where('defense_date_id', $id);
			$query = $this->db->get('defense_date');
			return $query->first_row('array');
		}

		public function get_specific_news($news_id)
		{
			$sql = "SELECT * FROM NEWS 
					WHERE NEWS_ID='".$news_id."';";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		
			
	}
?>