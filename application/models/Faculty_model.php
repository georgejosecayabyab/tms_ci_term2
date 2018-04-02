<?php if(!defined('BASEPATH')) exit('Direct acces not allowed');
	
	class faculty_model extends CI_Model
	{
		/**
		 * Gets the faculty details
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing the faculty details of the user
		 */
		public function get_faculty_detail($user_id)
		{
			$sql = "SELECT F.USER_ID, FIRST_NAME, LAST_NAME, EMAIL, R.RANK
					FROM RANK R JOIN FACULTY F
								ON R.RANK_CODE=F.RANK
								JOIN USER U 
								ON U.USER_ID=F.USER_ID
					WHERE F.USER_ID=".$user_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array'); 
		}
		/**
		 * Gets the faculty specialization
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing the specialization of the user
		 */
		public function get_faculty_specialization($user_id)
		{
			$sql = "SELECT FS.USER_ID, S.SPECIALIZATION, S.SPECIALIZATION_ID 
					FROM FACULTY_SPECIALIZATION FS
					JOIN SPECIALIZATION S
					ON S.SPECIALIZATION_ID=FS.SPECIALIZATION_ID
					WHERE USER_ID=".$user_id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		/**
		 * Gets the groups who have the current faculty as their adviser
		 * @param  Integer $faculty_id Faculty ID of current user 
		 * @return Returns an array containing the groups under the faculty
		 */
		public function get_active_advisee_thesis_groups($faculty_id)
		{
			$sql = "SELECT GROUP_ID, GROUP_NAME, THESIS_TITLE	
					FROM THESIS_GROUP G 	JOIN FACULTY F
									ON G.ADVISER_ID = F.USER_ID
									JOIN THESIS T
									ON T.THESIS_ID = G.THESIS_ID
					WHERE G.ADVISER_ID=".$faculty_id." AND T.THESIS_STATUS='ON-GOING'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		
		/**
		 * Gets the defense dates of the groups who have the current faculty as their panel
		 * @param  Integer $faculty_id Faculty ID of current user 
		 * @return Returns an array containing the defense date of the groups who have the current faculty as their panel
		 */
		public function get_defense_list($faculty_id)
		{
			$sql = "SELECT DD.GROUP_ID, DATE(DD.DEFENSE_DATE) AS DEF_DATE, TIME_FORMAT(DD.START_TIME, '%h:%i %p') AS START, TIME_FORMAT(DD.END_TIME, '%h:%i %p') AS END, DD.VENUE, DD.STATUS, TG.GROUP_NAME, DATEDIFF(DD.DEFENSE_DATE, CURDATE()) AS DIFF, CURDATE() AS 'NOW'
					FROM DEFENSE_DATE DD
					JOIN THESIS_GROUP TG
					ON TG.GROUP_ID=DD.GROUP_ID
					WHERE DD.GROUP_ID IN (SELECT GROUP_ID
					FROM PANEL_GROUP
					WHERE PANEL_ID=".$faculty_id.")
					AND DATEDIFF(DD.DEFENSE_DATE, CURDATE()) >= 0;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the group members who have the current faculty as their adviser
		 * @param  Integer $faculty_id Faculty ID of current user 
		 * @return Returns an array containing the group members under the faculty
		 */
		public function get_advisee_thesis_group_members($faculty_id)
		{
			$sql = "SELECT *
					FROM STUDENT_GROUP SG 
					JOIN USER U
					ON U.USER_ID=SG.STUDENT_ID
					JOIN THESIS_GROUP TG
					ON TG.GROUP_ID = SG.GROUP_ID
					WHERE SG.STATUS=1
					AND TG.ADVISER_ID=".$faculty_id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		/**
		 * Gets the number of notification of each group that the faculty handlesr
		 * @param  Integer $faculty_id Faculty ID of current user 
		 * @return Returns an array containing the count of notification for each group handled by the faculty
		 */
		public function get_notification_count_under_advisee($faculty_id)
		{
			$sql = "SELECT TG.GROUP_NAME, TG.GROUP_ID, N.CREATED_BY, CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) AS CREATOR, N.TARGET_USER_ID, N.NOTIFICATION_DETAILS, N.IS_READ, COUNT(TG.GROUP_ID) AS NOTIF
					FROM THESIS_GROUP TG
					JOIN STUDENT_GROUP SG
					ON SG.GROUP_ID=TG.GROUP_ID
					JOIN STUDENT S
					ON S.USER_ID=SG.STUDENT_ID
					JOIN USER U
					ON U.USER_ID=S.USER_ID
					JOIN NOTIFICATION N
					ON N.CREATED_BY=U.USER_ID
					WHERE N.TARGET_USER_ID=".$faculty_id."
					AND TG.ADVISER_ID=".$faculty_id."
					AND N.IS_READ=0
					GROUP BY TG.GROUP_ID;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the notifications of a specific group that the faculty handles
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty 
		 * @return Returns an array containing the notifications for a specific group handled by the faculty
		 */
		public function get_notifications($group_id)
		{
			$sql = "SELECT N.NOTIFICATION_ID, N.CREATED_BY, U.FIRST_NAME, U.LAST_NAME, N.TARGET_USER_ID, N.IS_READ, TG.GROUP_ID, TG.GROUP_NAME
					FROM NOTIFICATION N JOIN USER U
					ON U.USER_ID=N.CREATED_BY
					JOIN STUDENT_GROUP SG
					ON SG.STUDENT_ID = N.CREATED_BY
					JOIN THESIS_GROUP TG
					ON TG.GROUP_ID = SG.GROUP_ID
					WHERE N.IS_READ=0
					AND TG.GROUP_ID=".$group_id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets all the discussion of a specific group handled by the faculty 
		 * @return Returns an array containing the discussions for a specific group handled by the faculty
		 */
		public function get_discussion()
		{	
			$sql = "SELECT GROUP_ID, COUNT(GROUP_ID) AS 'COUNT'
					FROM TOPIC_DISCUSSION
					GROUP BY GROUP_ID;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		/**
		 * Gets the count of replies in a specific discussion of a specific group handled by the faculty 
		 * @return Returns an array containing the count of replies in a specific discussion for a specific group handled by the faculty
		 */
		public function get_discussion_reply_count()
		{	
			$sql = "SELECT TD.TOPIC_DISCUSSION_ID, COUNT(D.DISCUSSION_ID) AS 'COUNT', TD.GROUP_ID
					FROM TOPIC_DISCUSSION TD
					LEFT JOIN DISCUSSION D 
					ON D.TOPIC_DISCUSSION_ID=TD.TOPIC_DISCUSSION_ID
					GROUP BY TD.TOPIC_DISCUSSION_ID;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets a specific discussion of a specific group handled by the faculty 
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty 
		 * @return Returns an array containing a specific discussions for a specific group handled by the faculty
		 */
		public function get_discussion_specific($group_id)
		{	
			$sql = "SELECT TD.GROUP_ID, TD.TOPIC_DISCUSSION_ID, TD.TOPIC_NAME, TD.TOPIC_INFO, TD.CREATED_BY, CONCAT(U.FIRST_NAME, ' ',U.LAST_NAME) AS 'NAME', TIME_FORMAT(TD.DATE_TIME, '%h:%i %p') AS 'TIME', DATE(TD.DATE_TIME) AS 'DATE'
					FROM TOPIC_DISCUSSION TD 
					JOIN USER U
					ON U.USER_ID = TD.CREATED_BY
					WHERE TD.GROUP_ID=".$group_id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the detials of a specific group handled by the faculty 
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty 
		 * @return Returns an array containing details for a specific group handled by the faculty
		 */
		public function get_group_details($group_id)
		{
			$sql = "SELECT * 
					FROM THESIS_GROUP TG 
					JOIN THESIS T
					ON T.THESIS_ID = TG.THESIS_ID
					JOIN COURSE C
					ON C.COURSE_CODE=TG.COURSE_CODE
					JOIN USER U
					ON TG.ADVISER_ID = U.USER_ID
					WHERE TG.GROUP_ID=".$group_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Gets the defense of a specific group handled by the faculty 
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty 
		 * @return Returns an array containing defense date for a specific group handled by the faculty
		 */
		public function get_defense($group_id)
		{
			$sql = "SELECT DATE(DEFENSE_DATE) AS DEF_DATE, VENUE
					FROM DEFENSE_DATE
					WHERE GROUP_ID=".$group_id."
					AND STATUS=0";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}

		/**
		 * Gets the specializations of a specific group handled by the faculty 
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty 
		 * @return Returns an array containing specializations for a specific group handled by the faculty
		 */
		public function get_thesis_specialization($group_id)
		{
			$sql = "SELECT * 
					FROM THESIS_SPECIALIZATION TS
					JOIN THESIS T
					ON T.THESIS_ID = TS.THESIS_ID
					JOIN THESIS_GROUP TG
					ON TG.THESIS_ID = T.THESIS_ID
					JOIN SPECIALIZATION S
					ON S.SPECIALIZATION_ID = TS.SPECIALIZATION_ID
					WHERE TS.THESIS_ID=(SELECT THESIS_ID FROM THESIS_GROUP WHERE GROUP_ID=".$group_id.");";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		
		/**
		 * Gets the groups who have the current faculty as their panel
		 * @param  Integer $id user ID of of the current faculty 
		 * @return Returns an array containing the groups with the current faculty as their panel
		 */
		public function get_panel_thesis_group_members($id)
		{
			$sql ="SELECT TG.GROUP_ID, U.FIRST_NAME, U.LAST_NAME
					FROM USER U 	JOIN STUDENT S
									ON U.USER_ID = S.USER_ID
                					JOIN STUDENT_GROUP SG
									ON S.USER_ID = SG.STUDENT_ID
									JOIN THESIS_GROUP TG
                					ON TG.GROUP_ID = SG.GROUP_ID
                					JOIN PANEL_GROUP PG
                					ON TG.GROUP_ID = PG.GROUP_ID
					WHERE PG.PANEL_ID = ".$id."
					GROUP BY U.USER_ID;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the group tags of groups who have the current faculty as their panel
		 * @param  Integer $id user ID of of the current faculty 
		 * @return Returns an array containing the group tags of groups with the current faculty as their panel
		 */
		public function get_panel_thesis_group_tags($id)
		{
			$sql = "SELECT S.specialization, TG.group_id
					FROM THESIS T 	JOIN thesis_specialization TS
									ON T.THESIS_ID = TS.THESIS_ID
                					JOIN specialization S
                					ON TS.specialization_id = S.specialization_id
                					JOIN THESIS_GROUP TG 
                					ON T.THESIS_id = TG.THESIS_id
                					JOIN PANEL_GROUP PG
                					ON PG.GROUP_ID = TG.GROUP_ID
					WHERE PG.panel_id = ".$id.";";
			$query = $this->db->query($sql);
			return $query->result_array();

		}

		/**
		 * Gets the details of groups who have the current faculty as their panel
		 * @param  Integer $id user ID of of the current faculty 
		 * @return Returns an array containing the details of groups with the current faculty as their panel
		 */
		public function get_panel_details($id)
		{
			$sql = "SELECT PG.PANEL_GROUP_ID, PG.PANEL_ID, PG.STATUS, PG.GROUP_ID, TG.GROUP_NAME, TG.ADVISER_ID, TG.THESIS_ID, TG.COURSE_CODE, DD.DEFENSE_DATE, TIME_FORMAT(DD.START_TIME, '%h:%i %p') AS START, TIME_FORMAT(DD.END_TIME, '%h:%i %p') AS END, DD.VENUE, DD.STATUS, TG.INITIAL_VERDICT, IV.VERDICT AS 'IV_CODE', TG.FINAL_VERDICT, FV.VERDICT AS 'FV_CODE'
					FROM PANEL_GROUP PG	JOIN THESIS_GROUP TG 
										ON PG.GROUP_ID = TG.GROUP_ID
                        				LEFT JOIN DEFENSE_DATE DD
										ON PG.GROUP_ID = DD.GROUP_ID
                        				JOIN THESIS T
                        				ON TG.THESIS_ID = T.THESIS_ID
                        				JOIN INITIAL_VERDICT IV
                        				ON TG.INITIAL_VERDICT=IV.VERDICT_CODE
                        				JOIN FINAL_VERDICT FV
                        				ON TG.FINAL_VERDICT=FV.VERDICT_CODE
					WHERE PG.PANEL_ID =".$id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the count of thesis comments made by other panelist or students in groups who have the current user as their panel
		 * @return Returns an array containing the count of comments in thesis of groups with the current faculty as their panel
		 */
		public function get_thesis_comment_count()
		{
			$sql = "SELECT PG.GROUP_ID, COUNT(THESIS_COMMENT) AS 'COUNT'
					FROM THESIS_COMMENT	TC
					JOIN PANEL_GROUP PG
					ON PG.PANEL_GROUP_ID=TC.PANEL_GROUP_ID		    
					GROUP BY PG.GROUP_ID;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the thesis comments of groups who have been paneled by the current faculty
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty as a panel
		 * @return Returns an array containing the thesis comments of groups who have been paneled by the current faculty
		 */
		public function get_thesis_comment($group_id)
		{
			$sql = "SELECT * FROM ((SELECT TC.THESIS_COMMENT_ID AS 'COMMENT_ID', TC.THESIS_COMMENT AS 'THESIS_COMMENT', PG.PANEL_GROUP_ID AS 'GROUP_GROUP_ID', PG.GROUP_ID AS 'GROUP_ID', TG.GROUP_NAME AS 'GROUP_NAME', U.USER_ID AS 'USER_ID', CONCAT(U.FIRST_NAME,' ', U.LAST_NAME) AS 'COMMENTED BY', DATE(TC.DATE_TIME) AS 'DATE', TIME_FORMAT(TIME(TC.DATE_TIME), '%h:%i %p') AS 'TIME', U.USER_TYPE AS 'TYPE'
					FROM THESIS_COMMENT TC 
					JOIN PANEL_GROUP PG
					ON PG.PANEL_GROUP_ID=TC.PANEL_GROUP_ID
					JOIN USER U
					ON U.USER_ID=PG.PANEL_ID
					JOIN THESIS_GROUP TG
					ON TG.GROUP_ID=PG.GROUP_ID
					WHERE PG.GROUP_ID=".$group_id."
					ORDER BY DATE, TIME ASC) 
				UNION 
				(SELECT TC.THESIS_COMMENT_ID AS 'COMMENT_ID', TC.THESIS_COMMENT AS 'THESIS_COMMENT', SG.STUDENT_GROUP_ID AS 'GROUP_GROUP_ID', SG.GROUP_ID AS 'GROUP_ID', TG.GROUP_NAME AS 'GROUP_NAME', U.USER_ID AS 'USER_ID', CONCAT(U.FIRST_NAME,' ', U.LAST_NAME) AS 'COMMENTED BY', DATE(TC.DATE_TIME) AS 'DATE', TIME_FORMAT(TIME(TC.DATE_TIME), '%h:%i %p') AS 'TIME', U.USER_TYPE AS 'TYPE'
					FROM THESIS_COMMENT TC 
					JOIN STUDENT_GROUP SG
					ON SG.STUDENT_GROUP_ID=TC.STUDENT_GROUP_ID
					JOIN USER U
					ON U.USER_ID=SG.STUDENT_ID
					JOIN THESIS_GROUP TG
					ON TG.GROUP_ID=SG.GROUP_ID
					WHERE SG.GROUP_ID=".$group_id."
					ORDER BY DATE, TIME ASC) ) T
				ORDER BY T.DATE, T.TIME ASC;";
			$query = $this->db->query($sql);
			return $query->result_array();

		}
		/**
		 * Gets the group ID of groups who have been paneled by the current faculty
		 * @param  Integer $user_id Specific user ID of the current User
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty as a panel 
		 * @return Returns an array containing the group ID of groups who have been paneled by the current faculty
		 */
		public function get_panel_group_id($user_id, $group_id)
		{
			$sql = "SELECT * FROM PANEL_GROUP WHERE PANEL_ID=".$user_id." AND GROUP_ID=".$group_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Inserts a thesis comment as a panel
		 * @param  Array $data Contains the content
		 */
		public function insert_thesis_comment($data)
		{
			//escape every variable
			$this->db->insert('thesis_comment', $data);

		}
		/**
		 * Deletes a thesis comment as a panel
		 * @param  Integer $id Comment ID to be removed
		 */
		public function delete_thesis_comment($id)
		{
			//escape all variable
			$this->db->where('thesis_comment_id', $id);
			$this->db->delete('thesis_comment'); 
		}
		/**
		 * Gets the specific thesis comment of groups who have been paneled by the current faculty
		 * @param  Integer $thesis_comment_id Specific thesis comment id
		 * @return Returns an array containing the specific thesis comment of groups who have been paneled by the current faculty
		 */
		public function get_thesis_group_by_thesis_comment_id($thesis_comment_id)
		{
			$sql = "SELECT *
					FROM THESIS_COMMENT TC 
					JOIN PANEL_GROUP PG
					ON PG.PANEL_GROUP_ID=TC.PANEL_GROUP_ID
					WHERE TC.THESIS_COMMENT_ID=".$thesis_comment_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Gets the new notifications of the user
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing the new notifications of the user
		 */
		public function get_new_faculty_notification($user_id)
		{
			$sql = "SELECT * 
					FROM NOTIFICATION
					WHERE IS_READ=0
					AND TARGET_USER_ID=".$user_id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets all notifications of the user
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing all notifications of the user
		 */
		public function get_all_faculty_notification($user_id)
		{
			$sql = "SELECT * 
					FROM NOTIFICATION
					WHERE TARGET_USER_ID=".$user_id."
					ORDER BY NOTIFICATION_ID DESC;";
			$query = $this->db->query($sql);
			return $query->result_array();
			
		}
		/**
		 * Updates the notification to make it read
		 * @param  Integer $notification_id Specific notification ID of current user 
		 */
		public function update_notification($notification_id)
		{
			$data = array(
               'is_read' => 1 //1 means it has been read
            );

			$this->db->where('notification_id', $notification_id);
			$this->db->update('notification', $data); 
		}
		/**
		 * Gets all notifications of the user as a panel
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing all notifications of the user as a panel
		 */
		public function get_notifications_as_panel($user_id)
		{	
			$sql = "SELECT N.NOTIFICATION_ID, N.NOTIFICATION_DETAILS, PG.PANEL_ID, TG.GROUP_ID, TG.GROUP_NAME, TIME_FORMAT(N.DATE_CREATED, '%h:%i %p') AS 'TIME'
					FROM PANEL_GROUP PG
					JOIN THESIS_GROUP TG
					ON TG.GROUP_ID=PG.GROUP_ID
					JOIN NOTIFICATION N
					ON N.GROUP_ID=TG.GROUP_ID
					WHERE PG.GROUP_ID IN (SELECT GROUP_ID FROM PANEL_GROUP WHERE PANEL_ID=".$user_id.")
					AND PG.PANEL_ID=".$user_id."
					AND N.TARGET_USER_ID=".$user_id."
					AND N.IS_READ=0;";

			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets all notifications of the user as an adviser
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing all notifications of the user as an adviser
		 */
		public function get_notifications_as_advisee($user_id)
		{	
			$sql = "SELECT N.NOTIFICATION_ID, N.NOTIFICATION_DETAILS, TG.GROUP_ID, TG.GROUP_NAME, TIME_FORMAT(N.DATE_CREATED, '%h:%i %p') AS 'TIME', N.IS_READ
					FROM THESIS_GROUP TG
					JOIN NOTIFICATION N
					ON N.GROUP_ID=TG.GROUP_ID
					WHERE TG.ADVISER_ID=".$user_id."
					AND N.TARGET_USER_ID=".$user_id."
					AND N.IS_READ=0;";

			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets all specialization not assign to the current user
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing all specialization not assigned to the current user
		 */
		public function get_all_specialization($user_id)
		{
			$sql = "SELECT *
					FROM SPECIALIZATION 
					WHERE SPECIALIZATION_ID NOT IN (SELECT SPECIALIZATION_ID FROM FACULTY_SPECIALIZATION WHERE USER_ID=".$user_id.")";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Inserts a notification
		 * @param  Array $data Contains the content
		 */
		public function insert_notification($data)
		{
			//escape every variable
			$this->db->insert('notification', $data);
		}
		/**
		 * Gets the thesis comments relevant to the faculty as a panel
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty as a panel
		 * @param  Integer $user_id Specific user ID of the current Use 
		 * @return Returns an array containing the thesis comments relevant to the faculty as a panel
		 */
		public function get_all_thesis_comment_notification_target($group_id, $user_id)
		{
			$sql = "SELECT * 
					FROM USER U
					WHERE USER_ID!=".$user_id."
					AND USER_ID IN (SELECT PANEL_ID FROM PANEL_GROUP WHERE GROUP_ID=".$group_id.")
					OR USER_ID!=".$user_id."
					AND USER_ID IN (SELECT STUDENT_ID FROM STUDENT_GROUP WHERE GROUP_ID=".$group_id.")
					OR USER_ID!=".$user_id."
					AND USER_ID IN (SELECT ADVISER_ID FROM THESIS_GROUP WHERE GROUP_ID=".$group_id.");";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the topic from a discussion in a group as an adviser
		 * @param  Integer $topic_id Specific topic ID  
		 * @return Returns an array containing the topic from a discussion in a group as an adviser
		 */
		public function get_topic($topic_id)
		{
			$sql = "SELECT *
					FROM TOPIC_DISCUSSION TD 
					JOIN THESIS_GROUP TG 
					ON TD.GROUP_ID=TG.GROUP_ID
					JOIN USER U
					ON U.USER_ID=TD.CREATED_BY
					WHERE TD.TOPIC_DISCUSSION_ID=".$topic_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Gets the replies from a discussion in a group as an adviser
		 * @param  Integer $id Specific discussion ID  
		 * @return Returns an array containing the replies from a discussion in a group as an adviser
		 */
		public function get_discussion_reply($id)
		{
			$sql = "SELECT * FROM DISCUSSION WHERE DISCUSSION_ID=".$id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Gets the content from a discussion in a group as an adviser
		 * @param  Integer $topic_id Specific topic ID  
		 * @return Returns an array containing the content from a discussion in a group as an adviser
		 */

		public function get_topic_discussion($topic_id)
		{
			$sql = "SELECT TD.TOPIC_DISCUSSION_ID, TD.TOPIC_NAME, TD.TOPIC_INFO, D.DISCUSSION_ID, D.DISCUSS, U.USER_ID, CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) AS 'NAME', DATE(D.DATE_TIME) AS 'DATE', TIME_FORMAT(TIME(D.DATE_TIME), '%h:%i %p') AS 'TIME' 
					FROM TOPIC_DISCUSSION TD
					JOIN DISCUSSION D
					ON TD.TOPIC_DISCUSSION_ID=D.TOPIC_DISCUSSION_ID
					JOIN USER U
					ON U.USER_ID=D.USER_ID
					WHERE TD.TOPIC_DISCUSSION_ID=".$topic_id."
					ORDER BY TD.DATE_TIME ASC;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Inserts a reply in a discussion as an adviser
		 * @param  Array $data Contains the content
		 */
		public function insert_discussion_reply($data)
		{
			//escape every variable
			$this->db->insert('discussion', $data);
		}
		/**
		 * Gets the discussion replies relevant to the faculty as a adviser
		 * @param  Integer $group_id Specific group ID of ones handled by the current faculty as an adviser
		 * @param  Integer $user_id Specific user ID of the current Use 
		 * @return Returns an array containing the discussions relevant to the faculty as an adviser
		 */
		public function get_all_discussion_target($group_id, $user_id)
		{
			$sql = "SELECT * 
					FROM USER U
					WHERE USER_ID !=".$user_id."
					AND USER_ID IN (SELECT STUDENT_ID FROM STUDENT_GROUP WHERE GROUP_ID=".$group_id.")
					OR USER_ID !=".$user_id."
					AND USER_ID IN (SELECT ADVISER_ID FROM THESIS_GROUP WHERE GROUP_ID=".$group_id.");";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the topic id by the discussion id
		 * @param  Integer $discussion_id Specific discussion ID  
		 * @return Returns an array containing topic id with the same discussion id
		 */
		public function get_topic_id_by_discussion_id($discussion_id)
		{
			$sql = "SELECT * 
					FROM DISCUSSION
					WHERE DISCUSSION_ID=".$discussion_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Deletes a discussion reply as an adviser
		 * @param  Integer $id Comment ID to be removed
		 */
		public function delete_discussion_reply($id)
		{
			//escape all variable
			$this->db->where('discussion_id', $id);
			$this->db->delete('discussion'); 
		}
		/**
		 * Updates a discussion reply as an adviser
		 * @param  Integer $id Comment ID to be updated
		 * @param  Array $data Content of the update
		 */
		public function update_discussion_reply($id, $data)
		{
			$this->db->where('discussion_id', $id);
			$this->db->update('discussion', $data); 
		}

		/**
		 * Gets all the ranks
		 * @param  Integer $user_id User ID of current user 
		 * @return Returns an array containing the ranks
		 */
		public function get_all_rank($user_id)
		{
			$sql = "SELECT RANK_CODE, RANK 
					FROM RANK 
					ORDER BY RANK_CODE=(SELECT RANK FROM FACULTY WHERE USER_ID=".$user_id.") DESC, RANK ASC;";
			$query = $this->db->query($sql);
			return $query->result_array();	
		}
		/**
		 * Inserts a specialization on the faculty specialization
		 * @param  Integer @user_id User ID of the current user
		 * @param  String @tag_name Specialization inputted
		 */
		public function insert_faculty_specialization($user_id, $tag_name)
		{
			$sql = "INSERT INTO FACULTY_SPECIALIZATION 
					VALUES (".$user_id.", (SELECT SPECIALIZATION_ID FROM SPECIALIZATION WHERE SPECIALIZATION='".$tag_name."'));";
			$this->db->query($sql);
		}
		/**
		 * Inserts a new discussion
		 * @param  Array $data Contains the content of the discussion
		 */
		public function insert_new_discussion($data)
		{
			//escape every variable
			$this->db->insert('topic_discussion', $data);
		}
		/**
		 * Gets the archived thesis done by past students 
		 * @return Returns an array containing the archived thesis 
		 */
		public function archive_thesis()
		{
			$sql = "select t.thesis_id, t.thesis_title, tg.group_id, t.abstract, tg.course_code
					from thesis t 
					join thesis_group tg
					on tg.thesis_id=t.thesis_id
					where thesis_status='COMPLETED';";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the members of the archived thesis project 
		 * @return Returns an array contating the group memebers of the archived thesis
		 */
		public function archive_members()
		{
			$sql = "select tg.thesis_id, sg.group_id, concat(u.first_name,' ', u.last_name) as 'name', tg.course_code
					from student_group sg
					join student s
					on s.user_id=sg.student_id
					join user u
					on u.user_id=s.user_id
					join thesis_group tg
					on tg.group_id=sg.group_id;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the specialization of the archived thesis project 
		 * @return Returns an array containing the specialization of the archived thesis project
		 */
		public function archive_specialization()
		{
			$sql = "select s.specialization, ts.thesis_id
					from thesis_specialization ts
					join specialization s
					on s.specialization_id=ts.specialization_id; ";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the panelist of the arhived thesis project
		 * @return Returns an array containing the panelist of the archived thesis project
		 */
		public function archive_panels()
		{
			$sql = "select tg.thesis_id, pg.group_id, concat(u.first_name,' ', u.last_name) as 'name'
					from panel_group pg
					join faculty f
					on f.user_id=pg.panel_id
					join user u
					on u.user_id=f.user_id
					join thesis_group tg
					on tg.group_id=pg.group_id;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the thesis by the thesis id
		 * @param  Integer $thesis_id Specific thesis ID  
		 * @return Returns an array containing thesis with the same thesis id
		 */
		public function get_thesis_by_thesis_id($thesis_id)
		{	
			$sql = "SELECT * FROM THESIS WHERE THESIS_ID=".$thesis_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');

		}

		// public function insert_some($data)
		// {
		// 	$this->db->insert('time', $data);
		// }
		/**
		 * Inserts a schedule
		 * @param  Interger @user_id User ID of the faculty
		 * @param  Interger @time_id Time ID of the chosen time slot
		 * @param  String @day Chosen day
		 */
		public function insert_schedule($user_id, $time, $day)
		{
			$sql = "INSERT INTO SCHEDULE (user_id, time_id, day)
					VALUES (".$user_id.", (select time_id from time where start_time='".$time."'), '".$day."');";
			$this->db->query($sql);
		}
		/**
		 * Deletes the current schedule of the faculty
		 * @param  Integer $user_id User ID of the faculty
		 */
		public function delete_schedule($user_id)
		{
			//escape all variable
			$this->db->where('user_id', $user_id);
			$this->db->delete('schedule'); 
		}
		/**
		 * Gets the latest uploaded document by the group as a panel
		 * @param  Interger @group_id Specific group ID
		 * @return Returns an array containing the latest uploaded bu the group as a panel
		 */		
		public function latest_uploaded($group_id)
		{
			$sql = "SELECT * 
					FROM UPLOAD 
					WHERE GROUP_ID=".$group_id."
					ORDER BY UPLOAD_DATE_TIME DESC;";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Gets the uploaded revisions of the group as a panel
		 * @param  Interger @group_id Specific group ID
		 * @return Returns an array uploaded revisions
		 */	
		public function get_uploads_revision($group_id)
		{
			$sql = "SELECT * 
					FROM UPLOAD U 
					LEFT JOIN REVISION R 
					ON R.UPLOAD_ID=U.UPLOAD_ID
					WHERE U.GROUP_ID = ".$group_id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the uploaded thesis with revisions of the group as a panel
		 * @param  Interger @upload_id Specific upload ID
		 * @return Returns an array containing uploaded thesis with revisions
		 */	
		public function get_upload_thesis_revision($upload_id)
		{
			$sql = "SELECT * 
					FROM UPLOAD U 
					LEFT JOIN REVISION R 
					ON R.UPLOAD_ID=U.UPLOAD_ID
					WHERE U.UPLOAD_ID = ".$upload_id.";";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Gets the schedule of the faculty
		 * @param  Interger @user_id User ID of the user
		 * @return Returns an array containing the schedule of the user
		 */
		public function get_sched($user_id)
		{
			$sql = "SELECT S.USER_ID, S.DAY, TIME_FORMAT(T.START_TIME, '%h:%i %p') AS START, TIME_FORMAT(T.END_TIME, '%h:%i %p') AS END
					FROM SCHEDULE S 
					JOIN TIME T 
					ON T.TIME_ID=S.TIME_ID 
					WHERE USER_ID=".$user_id.";";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Gets the current day schedule of the user
		 * @param  Interger @user_id User ID of the user
		 * @param  String @day Chosen day
		 * @return Returns an array containing the complete shcdule for the day of the user
		 */		
		public function get_schedule_complete_by_day($user_id, $day)
		{
			$sql = "SELECT TIME_FORMAT(TIME(T.START_TIME), '%h:%i %p') AS 'START_TIME'
					FROM SCHEDULE S JOIN TIME T
					ON S.TIME_ID=T.TIME_ID
					WHERE S.USER_ID='".$user_id."' 
					AND S.DAY='".$day."';";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		/**
		 * Deletes specialization from the faculty
		 * @param  Integer @user_id User ID of the user
		 */
		public function delete_faculty_tags($user_id)
		{
			//escape all variable
			$this->db->where('user_id', $user_id);
			$this->db->delete('faculty_specialization'); 
		}
		/**
		 * Inserts a meeting on the student's group
		 * @param  Array $data Array containing the information of the meeting
		 */
		public function insert_meeting($data)
		{
			$this->db->insert('meeting', $data);
		}
		/**
		 * Gets the group id by the thesis id
		 * @param  Integer $thesis_id Specific thesis ID  
		 * @return Returns an array containing group id with the same thesis id
		 */
		public function get_group_id_by_thesis_id($thesis_id)
		{
			$sql = "select * from thesis_group where thesis_id=".$thesis_id."";
			$query = $this->db->query($sql);
			return $query->first_row('array');
		}
		/**
		 * Gets the all time
		 * @return Returns an array containing the time slots
		 */
		public function get_all_time()
		{
			$sql = "SELECT TIME_ID, TIME_FORMAT(START_TIME, '%h:%i %p') AS 'START', TIME_FORMAT(END_TIME, '%h:%i %p') AS 'END'
					FROM TIME;";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

	}
?>