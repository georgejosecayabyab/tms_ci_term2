<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Docs extends CI_Controller{
	const CONTROLLER_DIR = './application/controllers';

	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
	}

	public function index(){
		// redirect docs/view
    	echo 	'<script>
					window.location.href = "' . current_url() . '/view"
    		  	</script>';
	}

	public function view($controller_name = null){
		$view_data = array(
			'base_url' => preg_replace('/docs$/', '', explode('/docs', current_url())[0] . '/docs'),
			'api_list' => $this->_get_api_list(),
		);
		$view_data['active_controller'] = $controller_name != null ? $controller_name : key($view_data['api_list']);
		$view_data['api_detail'] = $this->my_doc_api_detail($view_data['active_controller']);
		// print_r($view_data);
		
		$this->load->view('docs.html', $view_data);
		
	}

	private function _get_controller_source($file_name){
		echo self::CONTROLLER_DIR . '/' . $file_name . '.php', "r";
		$controller_line = '';
		// Get your source in Controller (all contents)
		if ($fp = fopen(self::CONTROLLER_DIR . '/' . $file_name . '.php', "r")){
			
	    	while (!feof($fp)) {
	    	   $controller_line .= fgets($fp);
	    	}
	    	fclose($fp);
	    }
	    return $controller_line;
	}

	private function _get_model_source($file_name){
		$controller_line = '';
		// Get your source in Controller (all contents)
		if ($fp = fopen('./application/models'. '/' . $file_name . '.php', "r")){
			
	    	while (!feof($fp)) {
	    	   $controller_line .= fgets($fp);
	    	}
	    	fclose($fp);
	    }
	    return $controller_line;
	}

	private function _get_api_list(){
		$controller_arr = array();

		/* Open your_project/application/controllers directory */
		if ($handle = opendir(self::CONTROLLER_DIR)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && strpos($entry, ".php") && !preg_match('/^(?:docs.php)$/i', $entry) && 
					!preg_match('/^(?:welcome.php)$/i', $entry)) {
					
					$controller_name = explode('.php', $entry);
					$controller_name = $controller_name[0];
					$api_str = $this->_get_controller_source($controller_name);

					$controller_arr[$controller_name] = array();
					
					preg_match_all('/function (?P<method_name>[^_]\w+)\s{0,}\(/', $api_str, $method_list);
					foreach($method_list['method_name'] as $method_value){
						array_push($controller_arr[$controller_name], preg_replace('/_(get|post|put|delete)$/', '', $method_value));
					}
				}
			}
			closedir($handle);
		}
		
		return $controller_arr;
	}

	private function _get_api_detail($file_name){
		$current_url = explode('/docs', current_url());
		$api_list = array();

		foreach(explode('function', $this->_get_controller_source($file_name)) as $api_str){
			$api_str = 'function' . $api_str;
			preg_match('/function (?P<method_name>[^_]\w+)/', $api_str, $api_method);
			
			if (count($api_method)){
				/* Get API URL Parameter */
				$api_split_str = explode('{', $api_str);
				preg_match_all('/\$(\w+)/', $api_split_str[0], $api_url_parameter);
				
				/* Get API Parameter(Form data) */
				preg_match_all('/\$this\s{0,}->\s{0,}(?:input\s{0,}->){0,}\s{0,}(get|post|put|delete)\s{0,}\(\s{0,}\'(\w+)\'\s{0,}\)/', $api_str, $api_paramter);

				/* Get API Custom header */
				preg_match_all('/\$this\s{0,}->\s{0,}input\s{0,}->\s{0,}get_request_header\s{0,}\(\s{0,}\'(\S+)\'\s{0,}\,{0,}/', $api_str, $api_header);

				/* Get API Description */
				preg_match('/\/\*{1,}\s{0,}@description(?P<description>.*)\*\//si', $api_str, $api_description);

				/* Check use Codeigniter_restserver */ 
				$rest_method_pattern = '/_(get|post|put|delete)$/';
				$api_method_name = $api_method['method_name'];
				$call_type = null;
				if (preg_match($rest_method_pattern, $api_method['method_name'], $rest_method_parameter)){
					$api_method_name = preg_replace($rest_method_pattern, '', $api_method['method_name']);
					$call_type = strtoupper($rest_method_parameter[1]);
				}
				else{
					$call_type = count($api_paramter[1]) ? strtoupper($api_paramter[1][0]) : 'GET';
				}

				array_push($api_list, array(
					'method_name' => $api_method_name,
					'url_parameter' => $api_url_parameter[1],
					'parameter' => $api_paramter[2],
					'header' => $api_header[1],
					'call_type' => $call_type,
					'description' => count($api_description) ? $api_description['description'] : ''
				));
			}
		}

	    return $api_list;
	}

	public function my_doc_sample($controller_name = null)
	{
		$view_data = array(
			'base_url' => preg_replace('/docs$/', '', explode('/docs', current_url())[0] . '/docs'),
			'api_list' => $this->_get_api_list(),
		);
		$view_data['active_controller'] = $controller_name != null ? $controller_name : key($view_data['api_list']);
		$view_data['api_detail'] = $this->my_doc_api_detail('test');
		
		//echo $view_data['active_controller'];
		$this->load->view('docs.html', $view_data);
	}

	public function my_doc_api_detail($file_name)
	{
		$current_url = explode('/docs', current_url());
		$api_list = array();

		$txt = $this->_get_controller_source($file_name);

		$re1='((|\\/\\/(|\\s+)|\\/\\*[\\d\\D]*?\\*\\/\\s+)(|public|private)\\s+function\\s+(.*?)(\\()(.*?)(\\)).*?(\\{)(.*?)(\\}))';

		preg_match_all("/".$re1."/is", $txt, $matches);
		//echo 'NUMBER: '.sizeof($matches[0]).'<br>';
		foreach($matches[0] as $str)
		{
			//echo "LINE: <br>";
			//var_dump($str);
			if(!preg_match('/\\/\\/(|\\s+)(|public|private)\\s+function/', $str))
			{
				// echo $str;
				// echo '<br><br>';
				preg_match('/function (?P<method_name>[^_]\w+)/', $str, $api_method);
				//echo 'line 81: '.$str.'LOOP STSRTING <br>';
				if (count($api_method))
				{
					//echo 'METHOD NAME: '.$api_method['method_name'].'<br>';
					$api_split_str = explode('{', $str);

					/* Get API Parameter(Form data) */
					preg_match_all('/\$(\w+)/', $api_split_str[0], $api_url_parameter);

					// echo 'line 115: ';
					// var_dump($api_url_parameter[1]);
					// echo '<br>';

					/* Get API Parameter(Form data) */
					preg_match_all('/\$this\s{0,}->\s{0,}(?:input\s{0,}->){0,}\s{0,}(get|post|put|delete)\s{0,}\(\s{0,}\'(\w+)\'\s{0,}\)/', $str, $api_paramter);

					// echo 'line 122: ';
					// var_dump($api_paramter[2]);
					// echo '<br>';
					
					/* Get API Custom header */
					preg_match_all('/\$this\s{0,}->\s{0,}input\s{0,}->\s{0,}get_request_header\s{0,}\(\s{0,}\'(\S+)\'\s{0,}\,{0,}/', $str, $api_header);

					// echo 'line 130: ';
					// var_dump($api_header[1]);
					// echo '<br>';

					/* Get API Description */
					preg_match('/\/\*{1,}\s{0,}@description(?P<description>.*)\*\//si', $str, $api_description);

					//gets my description @description
					preg_match('/@description(?P<description>.*)\*/si', $str, $my_description);

					//gets my parameters @param
					preg_match_all('/@param(?P<param>.*)\*/si', $str, $my_parameters);

					//gets my return @return
					preg_match('/@return(?P<return>.*)\*\//si', $str, $my_return);

					$revised_description = "";
					$revised = array();
					$revised_individual_parameter = array();
					$revised_return = array();

					//echo 'line 188: ';
					if(count($my_description))
					{
						//echo 'DESCRIPTION <br>';
						$explode = "*/";
						//echo $my_description['description'].'<br>';
						if(preg_match("/@/", $my_description['description']))
						{
							$explode = "@";
						}
						$sample_description = explode($explode, $my_description['description']);
						$semi_clean_description = str_replace(' * ', ' ', $sample_description[0]);
						$clean_description = ucfirst(strtolower(ltrim($semi_clean_description)));
						//echo 'Description: '.$clean_description.'<br>';
						$revised_description = $clean_description;
					}

					if(count($my_parameters))
					{
						//echo 'PARAMETER <br>';
						foreach($my_parameters['param'] as $param)
						{
							foreach(explode('@param', $param) as $param_separate)
							{
								$explode = "*/";
								if(preg_match("/@/", $param_separate))
								{
									$explode = "@";
								}
								$sample_parameter = explode($explode, $param_separate);
								$clean_parameter = str_replace(' * ', ' ', $sample_parameter[0]);
								//echo 'JOKPARAM: '.$clean_parameter;
								$param_type = explode("$", $clean_parameter, 2);
								$clean_param_type = ucfirst(strtolower(ltrim($param_type[0])));
								//echo 'Type: '.$clean_param_type.'<br>';
								$param_name = explode(" ", $param_type[1], 2);
								$clean_param_name = ucfirst(strtolower(ltrim($param_name[0])));
								//echo 'Name: '.$clean_param_name.'<br>';
								$clean_param_description = ucfirst(strtolower(ltrim($param_name[1])));
								//echo 'Description: '.$clean_param_description.'<br>';
								array_push($revised_individual_parameter, array(
									'type' => $clean_param_type,
									'name' => $clean_param_name,
									'description' => $clean_param_description
								));

							}
						}
					}

					if(count($my_return))
					{
						//echo 'RETURN <br>';
						$explode = "*/";
						//echo $my_return['return'].'<br>';
						$sample_return = explode($explode, $my_return['return']);
						$clean_return = ucfirst(strtolower(str_replace(' * ', ' ', $sample_return[0])));
						//echo 'JOKRET: '.$clean_return;
						//echo 'Return: '.$clean_return.'<br>';
						$return_type = explode(" ", $clean_return, 3);
						$clean_return_type = ucfirst(strtolower(ltrim($return_type[1])));
						//echo 'Type: '.$clean_return_type.'<br>';
						$clean_return_description = ucfirst(strtolower(ltrim($return_type[2])));
						//echo 'Description: '.$clean_return_description.'<br>';

						array_push($revised_return, array(
							'type' => $clean_return_type,
							'description' => $clean_return_description
						));

					}


					array_push($revised, array(
						'description'=> $revised_description,
						'parameter'=> $revised_individual_parameter,
						'return'=> $revised_return
					));

					/* Check use Codeigniter_restserver */ 
					$rest_method_pattern = '/_(get|post|put|delete)$/';
					$api_method_name = $api_method['method_name'];
					// echo 'line 102: '.$api_method_name.'<br>';
					// echo 'line 104: '.$api_description['description'].'<br><br>';
					$call_type = null;
					if (preg_match($rest_method_pattern, $api_method['method_name'], $rest_method_parameter)){
						$api_method_name = preg_replace($rest_method_pattern, '', $api_method['method_name']);
						$call_type = strtoupper($rest_method_parameter[1]);
					}
					else{
						$call_type = count($api_paramter[1]) ? strtoupper($api_paramter[1][0]) : 'GET';
					}

					array_push($api_list, array(
						'method_name' => $api_method_name,
						'url_parameter' => $api_url_parameter[1],
						'parameter' => $api_paramter[2],
						'header' => $api_header[1],
						'call_type' => $call_type,
						'description' => count($api_description) ? $api_description['description'] : '',
						'revised_description' => $revised_description,
						'revised_parameters' => $revised_individual_parameter, 
						'revised_return' => $revised_return
					));

					// echo '=========================<br><br>';
					// foreach($revised as $rev)
					// {
					// 	echo 'Description: '.$rev['description'].'<br>';
					// 	foreach($rev['parameter'] as $parameter)
					// 	{
					// 		echo 'Parameter: '.'<br>';
					// 		echo '=== Name: '.$parameter['name'].'<br>';
					// 		echo '=== Type: '.$parameter['type'].'<br>';
					// 		echo '=== Description: '.$parameter['description'].'<br>';
					// 	}

					// 	foreach($rev['return'] as $return)
					// 	{
					// 		echo 'Return: '.'<br>';
					// 		echo '=== Type: '.$return['type'].'<br>';
					// 		echo '=== Description: '.$return['description'].'<br>';
					// 	}
					// }

				}
			}

			
		}
		
	    return $api_list;
	}

	public function my_doc_model_detail($file_name)
	{
		$current_url = explode('/docs', current_url());
		$api_list = array();

		$txt = $this->_get_model_source($file_name);

		$re1='((|\\/\\/(|\\s+)|\\/\\*[\\d\\D]*?\\*\\/\\s+)(|public|private)\\s+function\\s+(.*?)(\\()(.*?)(\\)).*?(\\{)(.*?)(\\}))';

		preg_match_all("/".$re1."/is", $txt, $matches);
		//echo 'NUMBER: '.sizeof($matches[0]).'<br>';
		foreach($matches[0] as $str)
		{
			//echo "LINE: <br>";
			//var_dump($str);
			if(!preg_match('/\\/\\/(|\\s+)(|public|private)\\s+function/', $str))
			{
				// echo $str;
				// echo '<br><br>';
				preg_match('/function (?P<method_name>[^_]\w+)/', $str, $api_method);
				//echo 'line 81: '.$str.'LOOP STSRTING <br>';
				if (count($api_method))
				{
					//echo 'METHOD NAME: '.$api_method['method_name'].'<br>';
					$api_split_str = explode('{', $str);

					/* Get API Parameter(Form data) */
					preg_match_all('/\$(\w+)/', $api_split_str[0], $api_url_parameter);

					// echo 'line 115: ';
					// var_dump($api_url_parameter[1]);
					// echo '<br>';

					/* Get API Parameter(Form data) */
					preg_match_all('/\$this\s{0,}->\s{0,}(?:input\s{0,}->){0,}\s{0,}(get|post|put|delete)\s{0,}\(\s{0,}\'(\w+)\'\s{0,}\)/', $str, $api_paramter);

					// echo 'line 122: ';
					// var_dump($api_paramter[2]);
					// echo '<br>';
					
					/* Get API Custom header */
					preg_match_all('/\$this\s{0,}->\s{0,}input\s{0,}->\s{0,}get_request_header\s{0,}\(\s{0,}\'(\S+)\'\s{0,}\,{0,}/', $str, $api_header);

					// echo 'line 130: ';
					// var_dump($api_header[1]);
					// echo '<br>';

					/* Get API Description */
					preg_match('/\/\*{1,}\s{0,}@description(?P<description>.*)\*\//si', $str, $api_description);

					//gets my description @description
					preg_match('/@description(?P<description>.*)\*/si', $str, $my_description);

					//gets my parameters @param
					preg_match_all('/@param(?P<param>.*)\*/si', $str, $my_parameters);

					//gets my return @return
					preg_match('/@return(?P<return>.*)\*\//si', $str, $my_return);

					$revised_description = "";
					$revised = array();
					$revised_individual_parameter = array();
					$revised_return = array();

					//echo 'line 188: ';
					if(count($my_description))
					{
						//echo 'DESCRIPTION <br>';
						$explode = "*/";
						//echo $my_description['description'].'<br>';
						if(preg_match("/@/", $my_description['description']))
						{
							$explode = "@";
						}
						$sample_description = explode($explode, $my_description['description']);
						$semi_clean_description = str_replace(' * ', ' ', $sample_description[0]);
						$clean_description = ucfirst(strtolower(ltrim($semi_clean_description)));
						//echo 'Description: '.$clean_description.'<br>';
						$revised_description = $clean_description;
					}

					if(count($my_parameters))
					{
						//echo 'PARAMETER <br>';
						foreach($my_parameters['param'] as $param)
						{
							foreach(explode('@param', $param) as $param_separate)
							{
								$explode = "*/";
								if(preg_match("/@/", $param_separate))
								{
									$explode = "@";
								}
								$sample_parameter = explode($explode, $param_separate);
								$clean_parameter = str_replace(' * ', ' ', $sample_parameter[0]);
								//echo 'JOKPARAM: '.$clean_parameter;
								$param_type = explode("$", $clean_parameter, 2);
								$clean_param_type = ucfirst(strtolower(ltrim($param_type[0])));
								//echo 'Type: '.$clean_param_type.'<br>';
								$param_name = explode(" ", $param_type[1], 2);
								$clean_param_name = ucfirst(strtolower(ltrim($param_name[0])));
								//echo 'Name: '.$clean_param_name.'<br>';
								$clean_param_description = ucfirst(strtolower(ltrim($param_name[1])));
								//echo 'Description: '.$clean_param_description.'<br>';
								array_push($revised_individual_parameter, array(
									'type' => $clean_param_type,
									'name' => $clean_param_name,
									'description' => $clean_param_description
								));

							}
						}
					}

					if(count($my_return))
					{
						//echo 'RETURN <br>';
						$explode = "*/";
						//echo $my_return['return'].'<br>';
						$sample_return = explode($explode, $my_return['return']);
						$clean_return = ucfirst(strtolower(str_replace(' * ', ' ', $sample_return[0])));
						//echo 'JOKRET: '.$clean_return;
						//echo 'Return: '.$clean_return.'<br>';
						$return_type = explode(" ", $clean_return, 3);
						$clean_return_type = ucfirst(strtolower(ltrim($return_type[1])));
						//echo 'Type: '.$clean_return_type.'<br>';
						$clean_return_description = ucfirst(strtolower(ltrim($return_type[2])));
						//echo 'Description: '.$clean_return_description.'<br>';

						array_push($revised_return, array(
							'type' => $clean_return_type,
							'description' => $clean_return_description
						));

					}


					array_push($revised, array(
						'description'=> $revised_description,
						'parameter'=> $revised_individual_parameter,
						'return'=> $revised_return
					));

					/* Check use Codeigniter_restserver */ 
					$rest_method_pattern = '/_(get|post|put|delete)$/';
					$api_method_name = $api_method['method_name'];
					// echo 'line 102: '.$api_method_name.'<br>';
					// echo 'line 104: '.$api_description['description'].'<br><br>';
					$call_type = null;
					if (preg_match($rest_method_pattern, $api_method['method_name'], $rest_method_parameter)){
						$api_method_name = preg_replace($rest_method_pattern, '', $api_method['method_name']);
						$call_type = strtoupper($rest_method_parameter[1]);
					}
					else{
						$call_type = count($api_paramter[1]) ? strtoupper($api_paramter[1][0]) : 'GET';
					}

					array_push($api_list, array(
						'method_name' => $api_method_name,
						'url_parameter' => $api_url_parameter[1],
						'parameter' => $api_paramter[2],
						'header' => $api_header[1],
						'call_type' => $call_type,
						'description' => count($api_description) ? $api_description['description'] : '',
						'revised_description' => $revised_description,
						'revised_parameters' => $revised_individual_parameter, 
						'revised_return' => $revised_return
					));

					// echo '=========================<br><br>';
					// foreach($revised as $rev)
					// {
					// 	echo 'Description: '.$rev['description'].'<br>';
					// 	foreach($rev['parameter'] as $parameter)
					// 	{
					// 		echo 'Parameter: '.'<br>';
					// 		echo '=== Name: '.$parameter['name'].'<br>';
					// 		echo '=== Type: '.$parameter['type'].'<br>';
					// 		echo '=== Description: '.$parameter['description'].'<br>';
					// 	}

					// 	foreach($rev['return'] as $return)
					// 	{
					// 		echo 'Return: '.'<br>';
					// 		echo '=== Type: '.$return['type'].'<br>';
					// 		echo '=== Description: '.$return['description'].'<br>';
					// 	}
					// }

				}
			}

			
		}
		
	    return $api_list;
	}

	public function pdf()
	{
		$this->load->library('Pdf');

		$data['coordinator'] = $this->my_doc_api_detail('coordinator');
		$data['super_user'] = $this->my_doc_api_detail('super_user');
		$data['faculty'] = $this->my_doc_api_detail('faculty');
		$data['student'] = $this->my_doc_api_detail('student');
		$data['login'] = $this->my_doc_api_detail('login');
		$data['home'] = $this->my_doc_api_detail('home');


		// $data['coordinator_model'] = $this->my_doc_model_detail('super_user_model');
		// $data['super_user_model'] = $this->my_doc_model_detail('super_user_model');
		// $data['faculty_model'] = $this->my_doc_model_detail('faculty_model');
		// $data['student_model'] = $this->my_doc_model_detail('super_user_model');
		// $data['login_model'] = $this->my_doc_model_detail('login_model');
		// $data['home_model'] = $this->my_doc_model_detail('home_model');

		$this->load->view('pdfreport',$data);
	}

	public function pdf_model()
	{
		$this->load->library('Pdf');

		// $data['coordinator'] = $this->my_doc_api_detail('coordinator');
		// $data['super_user'] = $this->my_doc_api_detail('super_user');
		// $data['faculty'] = $this->my_doc_api_detail('faculty');
		// $data['student'] = $this->my_doc_api_detail('student');
		// $data['login'] = $this->my_doc_api_detail('login');
		// $data['home'] = $this->my_doc_api_detail('home');


		$data['coordinator_model'] = $this->my_doc_model_detail('super_user_model');
		$data['super_user_model'] = $this->my_doc_model_detail('super_user_model');
		$data['faculty_model'] = $this->my_doc_model_detail('faculty_model');
		$data['student_model'] = $this->my_doc_model_detail('student_model');
		$data['login_model'] = $this->my_doc_model_detail('login_model');
		$data['home_model'] = $this->my_doc_model_detail('home_model');

		$this->load->view('pdfreport_model',$data);
	}
}

?>
















