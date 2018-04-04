<?php if(!defined('BASEPATH')) exit('No direct access allowed');

	class login_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		/**
		 * @description Checks if the inputted email and password are valid
		 * @param  String $email Inputted email of the user
		 * @param  String $password Inputted password of the user
		 * @return Array  Returns an emtpy array if email and password is not valid or if user is inactive else returns an array containing user information of a user 
		 */
		public function if_user($email, $password)
		{
			//SELECT * FROM USER WHERE EMAIL=$EMAIL AND PASSWORD=$PASSWORD;
			$this->db->where('email', $email);
			$this->db->where('password', $password);
			$this->db->where('is_active', 1);
			$query = $this->db->get('user');
			return $query->first_row('array');
		}

		/**
		 * @description Checks if the user is a student
		 * @param  Integer $user_id User ID of current user 
		 * @return Array   Returns an array containing user information of a user with $user_id
		 */
		public function is_student($user_id)
		{
			//SELECT * FROM STUDENT WHERE USER_ID=$USER_ID;
			// $this->db->where('user_id', $user_id);
			// $query = $this->db->get('student');
			// $num = $query->num_rows();
			// if ($num > 0)
			// {
			// 	return 0;//student
			// }
			// else 
			// {
			// 	return 1;//faculty
			// }
			$sql = "SELECT * FROM USER WHERE USER_ID=".$user_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}

		/**
		 * @description Checks if the email input is a gmail account
		 * @param  String $email Inputted email of the user
		 * @return Array Returns an empty array if the email is not a valid gmail account else returns an array containing user information of a user
		 */
		public function if_user_gmail($email)
		{
			//SELECT * FROM USER WHERE EMAIL=$EMAIL;
			$this->db->where('email', $email);
			$this->db->where('is_active', 1);
			$query = $this->db->get('user');
			return $query->first_row('array');
		}

		/**
		 * @description Gets the user details given the user id
		 * @param  Integer $user_id User ID of the current user
		 * @return Array Returns an array contating the user information of a user with $user_id
		 */
		public function get_user_details($user_id)
		{
			if ($this->is_student($user_id) == 1)
			{
				$sql = "SELECT * FROM USER U JOIN STUDENT S ON S.USER_ID= U.USER_ID WHERE U.USER_ID=".$user_id.";";
				$query = $this->db->query($sql);
				return $query->result_array();
			}
			else
			{
				$sql = "SELECT * FROM USER U JOIN FACULTY F ON F.USER_ID= U.USER_ID WHERE U.USER_ID=".$user_id.";";
				$query = $this->db->query($sql);
				return $query->result_array();
			}

		}
		/**
		 * @description Checks if the user is a faculty
		 * @param  Integer $user_id User ID of current user 
		 * @return Array   Returns an empty array if the user is not a coordinator else it returns an array containing user information of a user with $user_id
		 */
		public function if_coordinator($user_id)
		{
			$sql = "SELECT * FROM FACULTY WHERE USER_ID=".$user_id." AND IS_COORDINATOR=1;";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}

		/**
		 * @description Gets Student info
		 * @param  Integer $user_id User ID of current user 
		 */
		public function get_student($user_id)
		{
			$sql = "SELECT";
		}
		/**
		 * @description Gets the email of the current user
		 * @return Returns an array containing the email address 
		 */
		public function get_email()
		{
			$sql = "select email from user;";
			$query = $this->db->query($sql);
			return $query->result_array();

		}
		

	}

?>