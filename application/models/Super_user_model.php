<?php
	if(!defined('BASEPATH')) exit('Direct acces not allowed');

	class super_user_model extends CI_Model
	{
		public function get_all_coordinators()
		{
			$sql = "SELECT *
					FROM USER 
					WHERE USER_TYPE=2";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function get_user_info($user_id)
		{
			$sql = "SELECT * FROM USER WHERE USER_ID=".$user_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}

		public function update_user_status($user_id, $status)
		{
			$sql = "update user 
					set is_active=".$status."
					where user_id=".$user_id.";";
			$this->db->query($sql);
		}

		public function insert_user($data)
		{
			//escape every variable
			$this->db->insert('user', $data);
		}

		public function get_user_by_email($email)
		{
			$sql = "SELECT * FROM USER WHERE EMAIL='".$email."';";
			$query = $this->db->query($sql);

			return $query->first_row('array');
		}
	}
?>