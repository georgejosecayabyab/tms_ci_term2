<?php if(!defined('BASEPATH')) exit('No direct access allowed');

	class home_model extends CI_Model
	{
		public function __constructs()
		{
			parent::__constructs();
		}


		/**
		 * @description Gets list of awards
		 * @return Array Returns an array of awards
		 */
		public function get_awards_list()
		{
			$query = $this->db->get('award');
			return $query->result_array();
		}

		/**
		 * @description Gets specific award with a specific id
		 * @param  string $id id of the specific award
		 * @return array     Returns array containing information about the specific award
		 */
		public function get_award($id)
		{	$this->db->where('award_id', $id);
			$query = $this->db->get('award');
			return $query->first_row('array');
		}

		/**
		 * @description Gets list of news
		 * @return array Returns an array of news
		 */
		public function get_news_list()
		{
			$query = $this->db->get('news');
			return $query->result_array();
		}


		/**
		 * @description Gets list of defense dates
		 * @return array Returns array of defense dates
		 */
		public function get_defense_list()
		{
			$query = $this->db->get('defense_date');
			return $query->result_array();
		}

		/**
		 * @description Gets specific defense with a specific id
		 * @param  String $id id of the specific news
		 * @return array     Returns array containing information about the specific defense 
		 */
		public function get_defense($id)
		{	$this->db->where('defense_date_id', $id);
			$query = $this->db->get('defense_date');
			return $query->first_row('array');
		}

		/**
		 * @description Gets specific news with a specific id
		 * @param  String $id id of the specific news
		 * @return array     Returns array containing information about the specific news
		 */
		public function get_specific_news($news_id)
		{
			$sql = "SELECT * FROM NEWS 
					WHERE NEWS_ID='".$news_id."';";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		
			
	}
?>