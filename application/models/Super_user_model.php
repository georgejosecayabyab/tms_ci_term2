<?php
	if(!defined('BASEPATH')) exit('Direct acces not allowed');

	class super_user_model extends CI_Model
	{		
		/**
		 * @description Gets all coordinators
		 * @return array Returns array of coordinators
		 */
		public function get_all_coordinators()
		{
			$sql = "SELECT *
					FROM USER 
					WHERE USER_TYPE=2";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		
		/**
		 * @description Gets user information of a user with a specific user id
		 * @param  integer $user_id id of user
		 * @return array          returns array containing user information
		 */
		public function get_user_info($user_id)
		{
			$sql = "SELECT * FROM USER WHERE USER_ID=".$user_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		
		/**
		 * @description updates user's status to inactive or active
		 * @param  integer $user_id id of user
		 * @param  integer $status  status of user 
		 */
		public function update_user_status($user_id, $status)
		{
			$sql = "update user 
					set is_active=".$status."
					where user_id=".$user_id.";";
			$this->db->query($sql);
		}
		
		/**
		 * @description Creates and inserts a new user to the database
		 * @param  array $data array containing fields necessary to insert a new user to the database
		 */
		public function insert_user($data)
		{
			//escape every variable
			$this->db->insert('user', $data);
		}
		
		/**
		 * @description Gets user information of user with a specific email address
		 * @param  String $email email address of user
		 * @return array        Returns empty array if user does not exist
		 */
		public function get_user_by_email($email)
		{
			$sql = "SELECT * FROM USER WHERE EMAIL='".$email."';";
			$query = $this->db->query($sql);

			return $query->first_row('array');
		}
	}
?>