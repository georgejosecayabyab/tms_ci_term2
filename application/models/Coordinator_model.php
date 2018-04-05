<?php
	if(!defined('BASEPATH')) exit('Direct acces not allowed');

class coordinator_model extends CI_Model
{
	/**
	 * @description Gets the group common free time
	 * @param  Interger $group_id Group ID of the group
	 * @param  String $day Day of the free time
	 * @return Array Returns an array containing the free time of the group on a specific day
	 */
	public function get_group_common_free_time_by_day($group_id, $day)
	{
		$sql = "SELECT T.TIME_ID, TIME_FORMAT(T.START_TIME, '%h:%i %p') AS 'START', TIME_FORMAT(T.END_TIME, '%h:%i %p') AS 'END'
				FROM TIME T
				WHERE T.TIME_ID NOT IN
				(SELECT TIME_ID FROM SCHEDULE WHERE USER_ID IN 
						(SELECT STUDENT_ID FROM STUDENT_GROUP WHERE GROUP_ID=".$group_id.") 
						AND DAY='".$day."'
						OR USER_ID IN 
						(SELECT PANEL_ID FROM PANEL_GROUP WHERE GROUP_ID=".$group_id." AND STATUS=1)
					AND DAY='".$day."'
					GROUP BY TIME_ID);";
		$query = $this->db->query($sql);
		return $query->result_array();


	}
	/**
	 * @description Gets the group common free time
	 * @param  Interger $user_id User ID of the user
	 * @return Array Returns an empty array if the user ID is not a coordinator or an array contains the info of the user
	 */
	public function if_coordinator($user_id)
	{
		$sql = "SELECT * FROM FACULTY WHERE USER_ID=".$user_id." AND IS_COORDINATOR=1;";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	 * @description Gets the faculty information
	 * @return Array Returns an array containing the info of the faculty
	 */
	public function get_faculty_info()
	{
		$sql = "SELECT CONCAT(U.LAST_NAME,', ',U.FIRST_NAME) AS 'NAME', U.IS_ACTIVE, U.USER_ID, U.EMAIL, R.RANK, D.DEPARTMENT_NAME
				FROM FACULTY F 	LEFT JOIN USER U
								ON F.USER_ID = U.USER_ID
								JOIN RANK R
								ON R.RANK_CODE=F.RANK
                                JOIN DEPARTMENT D
                                ON 	F.DEPARTMENT_CODE = D.DEPARTMENT_CODE
                WHERE U.USER_TYPE=1;";

		$query = $this->db->query($sql);
		return $query->result_array();
	}

	
	/**
	 * @description Gets the count of panels
	 * @return Array Returns an array containing the count of panel
	 */
	public function get_no_of_panels()
	{
		$sql = "SELECT COUNT(PG.PANEL_ID) AS 'PANEL', U.USER_ID
				FROM FACULTY F 	LEFT JOIN USER U 
								ON F.USER_ID = U.USER_ID
                				LEFT JOIN PANEL_GROUP PG
                				ON F.USER_ID = PG.PANEL_ID
                				JOIN THESIS_GROUP TG
                				ON TG.GROUP_ID=PG.GROUP_ID
                WHERE PG.STATUS=1
                AND TG.IS_ACTIVE=1
				GROUP BY F.USER_ID;";

		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets the count of groups
	 * @return Array Returns an array containing the count of group
	 */
	public function get_no_of_groups()
	{
		$sql = "SELECT COUNT(U.USER_ID) AS 'GROUP', TG.adviser_id, U.USER_ID
				FROM FACULTY F 	JOIN USER U
								ON F.USER_ID = U.USER_ID
                				JOIN THESIS_GROUP TG 
                				ON F.USER_ID = TG.ADVISER_ID
                WHERE TG.IS_ACTIVE=1
				GROUP BY U.USER_ID;";

		$query = $this->db->query($sql);
		return $query->result_array();
	}	

	/**
	 * @description Gets the group information
	 * @return Array Returns an array containing the group information
	 */
	public function get_group_info()
	{
		$sql = "SELECT TG.GROUP_ID, TG.GROUP_NAME, TG.ADVISER_ID, TG.THESIS_ID, TG.COURSE_CODE, TG.INITIAL_VERDICT, TG.FINAL_VERDICT, TG.IS_ACTIVE, DD.DEFENSE_DATE_ID, DD.DEFENSE_DATE, TIME_FORMAT(DD.START_TIME, '%h:%i %p') AS 'START', TIME_FORMAT(DD.END_TIME, '%h:%i %p') AS 'END', DD.VENUE, TG.SECTION, DD.DEFENSE_TYPE, T.THESIS_TITLE
				FROM THESIS_GROUP TG	LEFT JOIN DEFENSE_DATE DD
										ON TG.GROUP_ID = DD.GROUP_ID
                        				JOIN COURSE C
                        				ON TG.COURSE_CODE=C.COURSE_CODE
                        				JOIN THESIS T
                        				ON T.THESIS_ID=TG.THESIS_ID
                        				WHERE TG.IS_ACTIVE=1;";

		$query = $this->db->query($sql);
		return $query->result_array();
	}	

	/**
	 * @description Gets the student information
	 * @return Array Returns an array containing the student information
	 */
	public function get_student_info()
	{
		$sql = "SELECT CONCAT(U.LAST_NAME,', ', U.FIRST_NAME) AS 'NAME', U.USER_ID, S.COURSE_CODE, TG.GROUP_NAME, U.IS_ACTIVE, TG.GROUP_ID, U.EMAIL
				FROM STUDENT S 	JOIN USER U
								ON S.USER_ID = U.USER_ID
                				LEFT JOIN STUDENT_GROUP SG 
                				ON SG.STUDENT_ID = S.USER_ID
                				LEFT JOIN THESIS_GROUP TG
                				ON SG.GROUP_ID = TG.GROUP_ID;";

		$query = $this->db->query($sql);
		return $query->result_array();
	}	

	/**
	 * @description Gets all the courses information
	 * @return Array Returns an array containing all the course information
	 */
	public function get_all_course_details()
	{
		$sql = "SELECT * 
				FROM COURSE;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets all the courses with its information
	 * @return Array Returns an array containing all the courses with its information
	 */
	public function get_all_course()
	{
		$sql = "SELECT * 
				FROM COURSE;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Inserts an announcement to a corresponding course
	 * @param String $description Contains the content of the announcement  
	 * @param String $course_code Contains the corresponding course for the announcement
	 */
	public function add_announcement($description, $course_code)
	{
		$sql = "INSERT INTO `thesis_related_event` (`event_id`, `event_desc`, `course_code`) 
				VALUES (NULL, ".$description.", ".$course_code.");";

		$query = $this->db->query($sql);
	}	

	/**
	 * @description Gets all the forms
	 * @return Array Returns an array containing all the forms
	 */
	public function get_form()
	{
		$sql = "SELECT *
				FROM FORM;";

		$query = $this->db->query($sql);
		return $query->result_array();
	}	

	/**
	 * @description Inserts a form to a corresponding course
	 * @param String $form Contains the form 
	 * @param String $course_code Contains the corresponding course for the form
	 */
	public function add_form($form, $course_code)
	{
		$sql = "INSERT INTO `form` (`form_id`, `form_name`, `course_code`) 
				VALUES (NULL, ".$form.", ".$course_code.");";

		$query = $this->db->query($sql);
	}

	/**
	 * @description Gets all the defense date and time available
	 * @return Array Returns an array containing all the defense date and time available
	 */
	public function get_all_open_meetings()
	{
		$sql = "SELECT DD.GROUP_ID, DATE(DD.DEFENSE_DATE) AS DEF_DATE, TIME_FORMAT(DD.START_TIME, '%h:%i %p') AS START, TIME_FORMAT(DD.END_TIME, '%h:%i %p') AS END, DD.VENUE, DD.STATUS, DATEDIFF(DD.DEFENSE_DATE, CURDATE()) AS DIFF, CURDATE() AS 'NOW', T.THESIS_TITLE, TG.GROUP_NAME
				FROM DEFENSE_DATE DD
				JOIN THESIS_GROUP TG
				ON TG.GROUP_ID=DD.GROUP_ID
				JOIN THESIS T
				ON T.THESIS_ID=TG.THESIS_ID
				WHERE DATEDIFF(DD.DEFENSE_DATE, CURDATE()) >= 0
				ORDER BY DD.DEFENSE_DATE ASC;";

		$query = $this->db->query($sql);
		return $query->result_array();
	}

	/**
	* @description Gets the archived thesis done by past students 
	* @return Array Returns an array containing the archived thesis 
	*/
	public function archive_thesis()
	{
		$sql = "select t.thesis_id, t.thesis_title, tg.group_id, t.abstract, tg.course_code
				from thesis t 
				left join thesis_group tg
				on tg.thesis_id=t.thesis_id
				where thesis_status='COMPLETED';";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets the members of the archived thesis project 
	 * @return Array Returns an array contating the group memebers of the archived thesis
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
	* @description Gets the specialization of the archived thesis project 
	* @return Array Returns an array containing the specialization of the archived thesis project
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
	* @description Gets the panelist of the arhived thesis project
	* @return Array Returns an array containing the panelist of the archived thesis project
	*/
	public function archive_panels()
	{
		$sql = "select tg.thesis_id, pg.group_id, concat(u.first_name,' ', u.last_name) as 'name', u.is_active
				from panel_group pg
				join faculty f
				on f.user_id=pg.panel_id
				join user u
				on u.user_id=f.user_id
				join thesis_group tg
				on tg.group_id=pg.group_id
				where pg.status=1;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Gets the thesis by the thesis id
	* @param  Integer $thesis_id Specific thesis ID  
	* @return Array Returns an array containing thesis with the same thesis id
	*/
	public function get_thesis_by_thesis_id($thesis_id)
	{	
		$sql = "SELECT * FROM THESIS WHERE THESIS_ID=".$thesis_id.";";
		$query = $this->db->query($sql);
		return $query->first_row('array');

	}
	/**
	* @description Updates intial verdict of a corresponding group
	* @param  Integer $group_id Specific group ID to be updated
	* @param  String $verdict Verdict to be updated into
	*/
	public function update_initial_verdict($group_id, $verdict)
	{

		$data = array(
			'initial_verdict' => $verdict
		);

		$this->db->where('group_id', $group_id);
		$this->db->update('thesis_group', $data); 
	}
	/**
	* @description Updates defense type depeneding on the verdict
	* @param  Integer $group_id Specific group ID to be updated
	* @param  String $verdict Verdict to be updated into
	*/
	public function update_defense_type($group_id, $verdict)
	{
		$defense_type = "";
		// if()
		// {

		// }
		// else if()
		// {

		// }
		// else
		// {

		// }


		$data = array(
			'group_id' => $group_id,
			'defense_type' => $verdict
		);

		$this->db->where('group_id', $group_id);
		$this->db->update('defense_date', $data); 
	}
	/**
	* @description Updates final verdict of a corresponding group
	* @param  Integer $group_id Specific group ID to be updated
	* @param  String $verdict Verdict to be updated into
	*/
	public function update_final_verdict($group_id, $verdict)
	{

		$data = array(
			'final_verdict' => $verdict
		);
		$this->db->where('group_id', $group_id);
		$this->db->update('thesis_group', $data); 
	}
	/**
	* @description Gets the verdict by the group id
	* @param  Integer $group_id Specific group ID  
	* @return Array Returns an array containing the verdict corresponding to a
	*/
	public function get_verdict($group_id)
	{
		$sql = "SELECT FV.VERDICT AS 'FINAL', IV.VERDICT AS 'INITIAL' 
				FROM THESIS_GROUP TG 
				JOIN INITIAL_VERDICT IV 
				ON IV.VERDICT_CODE= TG.INITIAL_VERDICT
				JOIN FINAL_VERDICT FV
				ON FV.VERDICT_CODE = TG.FINAL_VERDICT
				WHERE GROUP_ID=".$group_id.";";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Gets the time of defenses the panels is needed to attend on a specific date
	* @param  Integer $group_id Specific group ID  
	* @param  Date $date Specific date
	* @return Array Returns an array containing the time of defenses the panels is needed to attend on a specific date
	*/ 
	public function get_panel_defense_date($group_id, $date)
	{
		$sql = "SELECT CONCAT(U.FIRST_NAME,' ', U.LAST_NAME) AS 'NAME',DEFENSE_DATE, TIME_FORMAT(DD.START_TIME, '%h:%i %p') AS 'START', TIME_FORMAT(DD.END_TIME, '%h:%i %p') AS 'END'
				FROM DEFENSE_DATE DD
				JOIN THESIS_GROUP TG
				ON TG.GROUP_ID=DD.GROUP_ID
				JOIN PANEL_GROUP PG
				ON PG.GROUP_ID=TG.GROUP_ID
				JOIN FACULTY F
				ON F.USER_ID=PG.PANEL_ID
				JOIN USER U
				ON U.USER_ID=F.USER_ID
				WHERE PG.PANEL_ID IN (SELECT PANEL_ID FROM PANEL_GROUP WHERE GROUP_ID=".$group_id." AND STATUS=1)
				AND DD.DEFENSE_DATE = '".$date."'
				AND DD.GROUP_ID !=".$group_id.";";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Gets the defense date of a specific group
	* @param  Integer $group_id Specific group ID  
	* @return Array Returns an array containing the defense date of a specific group
	*/ 
	public function check_defense_date($group_id){
		$sql = "SELECT * FROM DEFENSE_DATE WHERE GROUP_ID=".$group_id.";";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Updates thesis defense date of a corresponding group
	* @param  Integer $group_id Specific group ID to be updated
	* @param  Array $data Contains the data needed
	*/
	public function update_thesis_defense_date($group_id, $data)
	{

		$this->db->where('group_id', $group_id);
		$this->db->update('defense_date', $data); 
	}
	/**
	* @description Inserts a thesis defense date
	* @param  Array $data Contains the data needed
	*/
	public function insert_thesis_defense_date($data)
	{
		//escape every variable
		$this->db->insert('defense_date', $data);
	}
	/**
	* @description Inserts a thesis defense date convert 
	* @param  Integer $defense_date_id Specific existing defense date
	* @param  Integer $start_time Specific time
	*/
	public function insert_defense_convert($defense_date_id, $start_time)
	{
		//escape every variable
		$sql = "INSERT INTO 'defense_convert' (defense_date_id, time_id) 
				VALUES (".$defense_date_id.", (select time_id from time where start_time=".$start_time."));";
		$query = $this->db->query($sql);
	}
	/**
	* @description Deletes a thesis defense date convert 
	* @param  Integer $defense_date_id Specific existing defense date
	*/
	public function delete_defense_convert($defense_date_id)
	{
		//escape all variable
		$this->db->where('defense_date_id', $defense_date_id);
		$this->db->delete('defense_convert');
	}
	/**
	 * @description Gets the current term
	 * @return Array Returns an array containing the current term
	 */
	public function get_term()
	{
		$sql = "SELECT * FROM SCHOOL_TERM WHERE IS_ACTIVE=1;";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	 * @description Gets all the terms
	 * @return Array Returns an array containing all terms
	 */
	public function get_all_term()
	{
		$sql = "SELECT * FROM SCHOOL_TERM;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets the current year
	 * @return Array Returns an array containing the current year
	 */
	public function get_year()
	{
		$sql = "SELECT * FROM SCHOOL_YEAR WHERE IS_ACTIVE=1;";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Inserts a form corresponding to a specific course
	* @param  String $form_name Title of the form
	* @param  String $course_code Specific course code for a specific course
	*/
	public function insert_form($form_name, $course_code)
	{
		//escape every variable
		$data = array(
			'form_name' => $form_name,
			'course_code' => $course_code
		);
		$this->db->insert('form', $data);
	}
	/**
	* @description Deletes a form
	* @param  Integer $form_id Specific form ID corresponding to form
	*/
	public function delete_form($form_id)
	{
		//escape all variable
		$this->db->where('form_id', $form_id);
		$this->db->delete('form');
	}
	/**
	* @description Gets a specific form
	* @param  Integer $form_id Specific form ID corresponding to form
	* @return Array Returns an array containing a specific form corresponding to a form ID
	*/
	public function get_specific_form($form_id)
	{
		$sql = "SELECT * FROM FORM WHERE FORM_ID=".$form_id.";";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Gets the group tags of groups
	* @param  Integer $group_id Group ID of a speicifc group 
	* @return Array Returns an array containing the group tags 
	*/
	public function get_group_tags($group_id)
	{
		$sql = "SELECT * 
				FROM SPECIALIZATION
				WHERE SPECIALIZATION_ID IN 
					(SELECT SPECIALIZATION_ID FROM THESIS_SPECIALIZATION WHERE THESIS_ID IN 
						(SELECT THESIS_ID FROM THESIS_GROUP WHERE GROUP_ID=".$group_id."));";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Gets the faculty who have common tags with a specific group
	* @param  Integer $group_id Group ID of a speicifc group 
	* @return Array Returns an array containing the faculty who have common tags with a specific group 
	*/
	public function get_common_tag($group_id)
	{
		$sql = "SELECT * 
				FROM FACULTY F
				JOIN FACULTY_SPECIALIZATION FS
				ON FS.USER_ID=F.USER_ID
				JOIN USER U
				ON U.USER_ID=F.USER_ID
				JOIN SPECIALIZATION S
				ON S.SPECIALIZATION_ID=FS.SPECIALIZATION_ID
                JOIN  (SELECT RANK AS 'RANK_NAME', RANK_CODE FROM RANK)R
                ON R.RANK_CODE=F.RANK
				WHERE FS.SPECIALIZATION_ID IN (SELECT SPECIALIZATION_ID FROM THESIS_SPECIALIZATION WHERE THESIS_ID IN 
										(SELECT THESIS_ID FROM THESIS_GROUP WHERE GROUP_ID=".$group_id."));";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Gets the faculty and count of common tags with a specific group
	* @param  Integer $group_id Group ID of a speicifc group 
	* @return Array Returns an array containing the faculty and count of common tags with a specific group 
	*/
	public function get_common_tag_count($group_id)
	{
		$sql = "SELECT FS.USER_ID, CONCAT( U.LAST_NAME,', ',U.FIRST_NAME) AS 'NAME', COUNT(FS.USER_ID) AS 'COUNT'
				FROM FACULTY F
				JOIN FACULTY_SPECIALIZATION FS
				ON FS.USER_ID=F.USER_ID
				JOIN USER U
				ON U.USER_ID=F.USER_ID
				WHERE FS.SPECIALIZATION_ID IN (SELECT SPECIALIZATION_ID FROM THESIS_SPECIALIZATION WHERE THESIS_ID IN 
										(SELECT THESIS_ID FROM THESIS_GROUP WHERE GROUP_ID=".$group_id."))
				GROUP BY FS.USER_ID
				ORDER BY COUNT DESC
				LIMIT 3;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets the specializations of all faculty
	 * @return Array Returns an array containing the specializations of all faculty
	 */
	public function get_common_panel_specialization()
	{
		$sql = "SELECT * 
				FROM FACULTY_SPECIALIZATION FS
				JOIN SPECIALIZATION S
				ON S.SPECIALIZATION_ID=FS.SPECIALIZATION_ID";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Gets the active faculty panelist to a specific group
	* @param  Integer $group_id Group ID of a speicifc group 
	* @return Array Returns an array containing the active faculty panelist to a specific group
	*/
	public function get_possible_panelist($group_id)
	{
		$sql = "SELECT * 
				FROM FACULTY F
				JOIN USER U
				ON U.USER_ID=F.USER_ID
				WHERE F.USER_ID NOT IN (SELECT ADVISER_ID FROM THESIS_GROUP WHERE GROUP_ID=".$group_id.")
				AND U.IS_ACTIVE=1
				AND U.USER_TYPE=1
				ORDER BY U.LAST_NAME ASC;";
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}
	/**
	* @description Gets the possible active panel group to a specific group
	* @param  Integer $group_id Group ID of a speicifc group 
	* @return Array Returns an array containing the possible active panel group to a specific group
	*/
	public function get_active_group_panel($group_id)
	{
		$sql = "SELECT * 
				FROM PANEL_GROUP PG
				JOIN FACULTY F
                ON F.USER_ID=PG.PANEL_ID
				JOIN USER U
				ON U.USER_ID=F.USER_ID 
				WHERE PG.GROUP_ID=".$group_id."
				AND PG.STATUS=1
				AND U.IS_ACTIVE=1
				AND U.USER_TYPE=1;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Gets the inactive panel group to a specific group
	* @param  Integer $group_id Group ID of a speicifc group 
	* @return Array Returns an array containing the inactive panel group to a specific group
	*/
	public function get_inactive_group_panel($group_id)
	{
		$sql = "SELECT * 
				FROM PANEL_GROUP PG
				JOIN FACULTY F
                ON F.USER_ID=PG.PANEL_ID
				JOIN USER U
				ON U.USER_ID=F.USER_ID 
				WHERE PG.GROUP_ID=".$group_id."
				AND PG.STATUS=0;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Gets the specializations of a panel given the user ID
	* @param  Integer $panel Specific user ID
	* @return Array Returns an array containing the specializations of a panel given the user ID
	*/
	public function get_panel_tags($panel)
	{
		$sql = "SELECT * 
				FROM FACULTY_SPECIALIZATION FS
				JOIN SPECIALIZATION S
				ON FS.SPECIALIZATION_ID=S.SPECIALIZATION_ID
				WHERE FS.USER_ID=".$panel.";";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Updates the current status of a specific panel group
	* @param  Integer $panel_group_id Specific panel group id
	* @param  Integer $status Specific status
	*/
	public function update_group_panelist($panel_group_id, $status)
	{
		$data = array(
			'status' => $status
		);
		$this->db->where('panel_group_id', $panel_group_id);
		$this->db->update('panel_group', $data); 
	}
	/**
	* @description Updates the current status of a past specific panel group
	* @param  Integer $panel_group_id Specific panel group id
	* @param  Integer $group_id Specific group ID of a group
	* @param  Integer $status Specific status
	*/

	public function update_previous_group_panelist($panel_id, $group_id, $status)
	{
		$data = array(
			'status' => $status
		);
		$this->db->where('panel_id', $panel_id);
		$this->db->where('group_id', $group_id);
		$this->db->update('panel_group', $data); 
	}
	/**
	* @description Inserts a group panelist
	* @param  Array $data Contains the data needed
	*/
	public function insert_group_panelist($data)
	{
		//escape every variable
		$this->db->insert('panel_group', $data);
	}
	/**
	* @description Deletes a group panelist
	* @param  Array $group_id Specific group ID
	*/
	public function delete_group_panelist($group_id)
	{
		//escape all variable
		$this->db->where('group_id', $group_id);
		$this->db->delete('panel_group');
	}
	/**
	 * @description Gets all ranks
	 * @return Array Returns an array containing all ranks
	 */
	public function get_all_rank()
	{
		$sql = "SELECT * FROM RANK";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets all departments
	 * @return Array Returns an array containing all departments
	 */
	public function get_all_department()
	{
		$sql = "SELECT * FROM DEPARTMENT";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Inserts a user
	* @param  Array $data Contains the data needed
	*/
	public function insert_user($data)
	{
		//escape every variable
		$this->db->insert('user', $data);
	}
	/**
	* @description Inserts a student
	* @param  String $first_name First name of the user
	* @param  String $last_name Last name of the user
	* @param  String $email Email of the user
	* @param  String $course Course of the student
	*/
	public function insert_student($first_name, $last_name, $email, $course)
	{

		$sql = "INSERT INTO STUDENT (USER_ID, COURSE_CODE) 
				VALUES ((SELECT USER_ID FROM USER WHERE FIRST_NAME='".$first_name."' AND LAST_NAME='".$last_name."' AND EMAIL='".$email."' AND USER_TYPE=0), (SELECT COURSE_CODE FROM COURSE WHERE COURSE_CODE='".$course."'));";

		$query = $this->db->query($sql);
	}
	/**
	* @description Inserts a student
	* @param  String $first_name First name of the user
	* @param  String $last_name Last name of the user
	* @param  String $email Email of the user
	* @param  String $rank Rank of the faculty
	* @param  String $department_name Department of the faculty
	*/
	public function insert_faculty($first_name, $last_name, $email, $rank, $department_name)
	{
		$sql = "INSERT INTO FACULTY (USER_ID, IS_COORDINATOR, RANK, DEPARTMENT_CODE)
				VALUES ((SELECT USER_ID FROM USER WHERE FIRST_NAME='".$first_name."' AND LAST_NAME='".$last_name."' AND EMAIL='".$email."' AND USER_TYPE=1),0, (SELECT RANK_CODE FROM RANK WHERE RANK='".$rank."'),(SELECT DEPARTMENT_CODE FROM DEPARTMENT WHERE DEPARTMENT_NAME='".$department_name."'));"; 

		$query = $this->db->query($sql);
	}
	/**
	 * @description Gets all news
	 * @return Array Returns an array containing all news
	 */
	public function get_news()
	{
		$sql = "SELECT * FROM NEWS;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets a speicific news
	 * @param  Integer $news_id Specific ID of a speicifc news
	 * @return Array Returns an array containing specific news
	 */
	public function get_specific_news($news_id)
	{
		$sql = "SELECT * FROM NEWS 
				WHERE NEWS_ID='".$news_id."';";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	 * @description Updates a speicific news
	 * @param  Array $data Contains the content
	 */
	public function update_specific_news($data)
	{
		$sql = "update news
				set news_title='".$data['news_title']."', news_details='".$data['news_details']."', date_time='".$data['date_time']."' 
				where news_id='".$data['news_id']."';";
		$this->db->query($sql);
	}
	/**
	 * @description Deletes a speicific news
	 * @param  Integer $news_id Specific ID of a speicifc news
	 */
	public function delete_news($news_id)
	{
		//escape all variable
		$this->db->where('news_id', $news_id);
		$this->db->delete('news');
	}
	/**
	 * @description Gets all related news
	 * @return Array Returns an array containing all related news
	 */
	public function get_related_news()
	{
		$sql = "SELECT * FROM THESIS_RELATED_EVENT;";
		$query = $this->db->query($sql);
		return $query->result_array();

	}
	/**
	 * @description Gets a speicific related news
	 * @param  Integer $event_id Specific ID of a event
	 * @return Array Returns an array containing specific events
	 */
	public function get_specific_related_news($event_id)
	{
		$sql = "SELECT * FROM THESIS_RELATED_EVENT WHERE EVENT_ID=".$event_id.";";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	 * @description Deletes a speicific related news
	 * @param  Integer $event_id Specific ID of a event
	 */
	public function delete_related_news($event_id)
	{
		//escape all variable
		$this->db->where('event_id', $event_id);
		$this->db->delete('thesis_related_event');
	}
	/**
	 * @description Updates a speicific related news
	 * @param  Array $data Contains the content
	 */
	public function update_related_news($data)
	{
		$sql = "update thesis_related_event
				set event_desc='".$data['event_desc']."', course_code='".$data['course_code']."'
				where event_id='".$data['event_id']."';";
		$this->db->query($sql);
	}
	/**
	* @description Inserts a home announcement
	* @param  Array $data Contains the data needed
	*/
	public function insert_new_home_announcement($data)
	{
		//escape every variable
		$this->db->insert('news', $data);
	}
	/**
	* @description Inserts a specific announcement
	* @param  Array $data Contains the data needed
	*/
	public function insert_new_specific_announcement($data)
	{
		//escape every variable
		$this->db->insert('thesis_related_event', $data);
	}
	/**
	 * @description Gets all specialization
	 * @return Array Returns an array containing all specialization
	 */
	public function get_all_specialization()
	{
		$sql = "SELECT * FROM SPECIALIZATION;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Inserts a specialization
	* @param  Array $data Contains the data needed
	*/
	public function insert_specialization($data)
	{
		//escape every variable
		$this->db->insert('specialization', $data);
	}
	/**
	 * @description Gets information of a specific user
	 * @param  Integer $user_id Specific user ID of a user
	 * @return Array Returns an array containing information of a specific user
	 */
	public function get_user_info($user_id)
	{
		$sql = "SELECT * FROM USER WHERE USER_ID=".$user_id.";";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	 * @description Gets all active faculty
	 * @return Array Returns an array containing all active faculty
	 */
	public function get_all_active_faculty()
	{
		$sql = "SELECT * FROM USER WHERE USER_ID IN(SELECT USER_ID FROM FACULTY WHERE IS_COORDINATOR=0) AND IS_ACTIVE=1 ORDER BY LAST_NAME ASC;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets all years
	 * @return Array Returns an array containing all years
	 */
	public function get_all_year()
	{
		$sql = "SELECT * FROM SCHOOL_YEAR;";

		$query = $this->db->query($sql);
		return $query->result_array();
		
	}
	/**
	 * @description Gets all passed groups
	 * @return Array Returns an array containing all passed groups
	 */
	public function get_all_passed_group()
	{
		$sql = "SELECT C.COURSE_ORDER, TG.COURSE_CODE, TG.GROUP_NAME, TG.GROUP_ID, C.DEGREE_CODE, TG.THESIS_ID
				FROM COURSE C 
				LEFT JOIN THESIS_GROUP TG 
				ON TG.COURSE_CODE=C.COURSE_CODE
				WHERE TG.FINAL_VERDICT='P'
				ORDER BY GROUP_NAME ASC;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * @description Gets next course for a specific group with their degree, updates course of specific group if their final verdict is a 'pass'
	 * @param  Integer $group_id Specific ID of a group
	 * @param  String $degree Specific degree
	 * @return Array Returns an array containing the next course of a specific group, or current course if the group is on the last course in the thesis
	 */
	public function sample_move_term($group_id, $degree_code)
	{
		$this->db->query("SET @GROUP_ID =".$group_id.";");
		$this->db->query("SET @DEGREE_CODE = '".$degree_code."';");
		$this->db->query("SET @ANSWER = IF(
						(SELECT COURSE_ORDER+1 
							FROM COURSE C
					        JOIN THESIS_GROUP TG
					        ON TG.COURSE_CODE=C.COURSE_CODE
					        WHERE DEGREE_CODE=@DEGREE_CODE
					        AND TG.GROUP_ID=@GROUP_ID) <= (SELECT COURSE_ORDER 
							FROM COURSE 
							WHERE DEGREE_CODE=@DEGREE_CODE
							ORDER BY COURSE_ORDER DESC
							LIMIT 1), 

					        (SELECT COURSE_ORDER+1 FROM COURSE C
					        JOIN THESIS_GROUP TG
					        ON TG.COURSE_CODE=C.COURSE_CODE
					        WHERE DEGREE_CODE=@DEGREE_CODE
					        AND TG.GROUP_ID=@GROUP_ID), 

					        (SELECT COURSE_ORDER FROM COURSE C
					        JOIN THESIS_GROUP TG
					        ON TG.COURSE_CODE=C.COURSE_CODE
					        WHERE DEGREE_CODE=@DEGREE_CODE
					        AND TG.GROUP_ID=@GROUP_ID)
					        );");

		$sql = "UPDATE THESIS_GROUP
					SET COURSE_CODE=(SELECT COURSE_CODE FROM COURSE WHERE COURSE_ORDER=@ANSWER AND DEGREE_CODE=@DEGREE_CODE)
					WHERE GROUP_ID=@GROUP_ID;";
						
		$this->db->query($sql);

		$sql = "SELECT @ANSWER;";

		$query = $this->db->query($sql);

		return $query->first_row('array');
	}
	/**
	* @description Decactivates a specific term
	* @param  Integer $term Specific term
	*/
	public function deactivate_old_term($term)
	{	
		$data = array(
			'is_active' => 0
		);
		$this->db->where('term', $term);
		$this->db->update('school_term', $data);
	}
	/**
	* @description Decactivates a specific year
	* @param  Integer $year Specific year
	*/
	public function deactivate_old_year($year)
	{	
		$data = array(
			'is_active' => 0
		);
		$this->db->where('year', $year);
		$this->db->update('school_year', $data);
	}
	/**
	* @description Activates a specific term
	* @param  Integer $term Specific term
	*/
	public function activate_new_term($term)
	{
		$data = array(
			'is_active' => 1
		);
		$this->db->where('term', $term);
		$this->db->update('school_term', $data);
	}
	/**
	* @description Activates a specific year
	* @param  Integer $year Specific year
	*/
	public function activate_new_year($year)
	{
		$data = array(
			'is_active' => 1
		);
		$this->db->where('year', $year);
		$this->db->update('school_year', $data);

	}
	/**
	 * @description Gets specific time given the time id
	 * @param  Integer $time_id Specific time ID
	 * @return Array Returns an array containing specific time given the time id
	 */
	public function get_time($time_id)
	{
		$sql = "SELECT T.START_TIME AS 'START', T.END_TIME AS 'END'
				FROM TIME T WHERE T.TIME_ID=".$time_id.";";

		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Inserts a thesis
	* @param  String $thesis_title The thesis title of a thesis project
	*/
	public function insert_thesis($thesis_title)
	{	
		$data = array(
			'thesis_title' => $thesis_title,
			'thesis_status' => 'ON-GOING',
			'abstract' => ''
		);

		$this->db->insert('thesis', $data);

	}
	/**
	* @description Inserts a thesis group
	* @param  String $group_name Group name of the group
	* @param  Integer $adviser Specific user id of a faculty
	* @param  String $thesis_title The thesis title of a thesis project
	* @param  String $course_code Current course of the group
	*/
	public function insert_thesis_group($group_name, $adviser, $thesis_title, $course_code)
	{
		$sql = "INSERT INTO THESIS_GROUP (GROUP_NAME, ADVISER_ID, THESIS_ID, INITIAL_VERDICT, FINAL_VERDICT, IS_ACTIVE, COURSE_CODE)
				VALUES ('".$group_name."', (SELECT USER_ID FROM FACULTY WHERE USER_ID=".$adviser."), (SELECT THESIS_ID FROM THESIS WHERE THESIS_TITLE='".$thesis_title."'), 'NOV', 'NVY', 1, '".$course_code."')";
		$this->db->query($sql);
	}
	/**
	* @description Inserts a student into a group
	* @param  Integer $user_id Specific user id of a user
	* @param  Integer $group_id Specific group id of a group
	*/
	public function insert_student_group($user_id, $group_id)
	{
		$data = array(
			'group_id' => $group_id,
			'student_id' => $user_id,
			'status' => 1
		);

		$this->db->insert('student_group', $data);
	}
	/**
	 * @description Gets a specific thesis group
	 * @param  String $group_name Specific group name of the thesis group
	 * @param  Integer $adviser_id User id of a faculty
	 * @return Array Returns an array containing a specific thesis group
	 */
	public function get_thesis_group($group_name, $adviser_id)
	{
		$sql = "SELECT * FROM THESIS_GROUP WHERE GROUP_NAME='".$group_name."' AND ADVISER_ID=".$adviser_id.";";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Inserts a student into a group
	* @param  Integer $user_id Specific user id of a user
	* @return Array Returns an array containing the degree code of a specific user
	*/	
	public function check_degree_code($user_id)
	{
		$sql = "SELECT * FROM STUDENT WHERE USER_ID=".$user_id.";" ;
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Deletes all the defense schedules of a group
	* @param  Integer $group_id Specific group id of a group
	*/
	public function delete_all_defense_date($group_id)
	{
		$sql = "delete from defense_date where group_id=".$group_id.";";
		$this->db->query($sql);
	}
	/**
	* @description Updates the verdict of a group
	* @param  Integer $group_id Specific group id of a group
	*/
	public function update_verdicts($group_id)
	{
		$sql = "update thesis_group
				set initial_verdict='NOV', final_verdict='NVY' 
				where group_id=".$group_id.";";
		$this->db->query($sql);
	}
	/**
	* @description Deletes notification of all users
	*/
	public function delete_notifications()
	{
		// $this->db->query("SET SQL_SAFE_UPDATES = 0;");
		// $this->db->query("delete from notification;");
		// $this->db->query("SET SQL_SAFE_UPDATES = 1;");

		$sql = "SELECT * FROM NOTIFICATION";
		$query = $this->db->query($sql);
		$all_notif = $query->result_array();

		foreach($all_notif as $row)
		{
			$this->db->where('notification_id', $row['notification_id']);
			$this->db->delete('notification');	
		}
	}
	/**
	* @description Gets memebers of a group
	* @param  Integer $group_id Specific group id of a group
	* @return Array Returns an array containing the members of a group
	*/	
	public function get_members($group_id)
	{
		$sql = "SELECT * 
				FROM STUDENT_GROUP SG
				JOIN STUDENT S
				ON S.USER_ID=SG.STUDENT_ID
				JOIN COURSE C
				ON S.COURSE_CODE=C.COURSE_CODE
				WHERE GROUP_ID=".$group_id." AND STATUS=1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	* @description Updates the students course
	* @param  Integer $user_id Specific user id of a user
	* @param  String $degree Degree of the student
	* @param  Integer $course_order Specific order of the current course
	*/
	public function update_student_course($user_id, $degree, $course_order)
	{
		$sql = "UPDATE STUDENT
				SET COURSE_CODE=(SELECT COURSE_CODE FROM COURSE WHERE DEGREE_CODE='".$degree."' AND COURSE_ORDER=".$course_order.")
				WHERE USER_ID=".$user_id.";";
		$this->db->query($sql);
	}
	/**
	* @description Updates the students status
	* @param  Integer $user_id Specific user id of a user
	* @param  String $status Status of a user 
	*/
	public function update_user_status($user_id, $status)
	{
		$sql = "update user 
				set is_active=".$status."
				where user_id=".$user_id.";";
		$this->db->query($sql);
	}
	/**
	* @description Updates the thesis project status
	* @param  Integer $thesis_id Specific thesis id 
	*/
	public function update_thesis_status($thesis_id)
	{
		$sql = "update thesis 
				set thesis_status='COMPLETED'
				where thesis_id=".$thesis_id.";";
		$this->db->query($sql);
	}
	/**
	* @description Updates the group status
	* @param  Integer $group_id Specific group id 
	*/
	public function update_group_status($group_id)
	{
		$sql = "update thesis_group 
				set is_active=0
				where group_id=".$group_id.";";
		$this->db->query($sql);
	}

	/**
	 * @description Gets information of a specific user
	 * @param  String $email Specific email of a user
	 * @return Array Returns an array containing information of a specific user
	 */
	public function get_specific_user_info($email)
	{
		$sql = "select * from user 
				where email='".$email."';";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	 * @description Gets students under a specific course
	 * @param  String $course_code Specific course code
	 * @return Array Returns an array containing students under a specific course
	 */
	public function get_specific_course_students($course_code)
	{
		$sql = "SELECT CONCAT(U.LAST_NAME, ', ', U.FIRST_NAME) AS 'NAME', S.COURSE_CODE, U.USER_ID 
				FROM STUDENT S JOIN USER U
				ON U.USER_ID=S.USER_ID
				WHERE COURSE_CODE='".$course_code."'
				AND U.USER_ID NOT IN (SELECT STUDENT_ID FROM STUDENT_GROUP)
				AND U.IS_ACTIVE=1;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	/**
	* @description Updates the time lot in the scheduler
	* @param  Integer $time Specific time
	*/
	public function update_time($time)
	{
		$sql = "SELECT * FROM TIME LIMIT 8;";
		$query = $this->db->query($sql);
		$time_db = $query->result_array();
		for($x = 0; $x < sizeof($time_db); $x++)
		{
			// $data = array(
			// 	'start_time' => $time['start_time'][$x],
			// 	'end_time' => $time['end_time'][$x]
			// );

			$update_sql = "update time 
					set start_time='".$time['start_time'][$x]."', end_time='".$time['end_time'][$x]."'
					where time_id=".$time_db[$x]['time_id'].";";
			$this->db->query($update_sql);


			
		}

	}

	/**
	* @description Deactivates all guest accounts
	*/
	public function deactivate_all_guests()
	{
		$sql = "SELECT * FROM FACULTY WHERE RANK='GUEST';";
		$query = $this->db->query($sql);
		$all_guest = $query->result_array();

		foreach($all_guest as $row)
		{
			
			$data = array(
				'is_active' => 0
			);

			$this->db->where('user_id', $row['user_id']);
			$this->db->update('user', $data); 
		}
	}

	/**
	* @description Gets the group id by the thesis id
	* @param  Integer $thesis_id Specific thesis ID  
	* @return Array Returns an array containing group id with the same thesis id
	*/
	public function get_group_id_by_thesis_id($thesis_id)
	{
		$sql = "select * from thesis_group where thesis_id=".$thesis_id."";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	/**
	* @description Gets the upload revisions of a specific group
	* @param  Integer $group_id Group ID of a speicifc group 
	* @return Array Returns an array containing upload revisions of a specific group
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
}


?>
