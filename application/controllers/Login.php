<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('website/login');
	}
	public function status()
	{
		$session_data = $this->session->all_userdata();
		if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
			_json(_remove_array_elements($session_data, ['__ci_last_regenerate']));
		} else {
			// set_status_header('401');
			_json(array('user not logged in'));
		}
		
	}
	public function varify()
	{
		$user_data = $this->input->post(); // receive post data from login form

		$this->load->model('user_model');
		
		if ($result = $this->user_model->login_check($user_data)) { // check if email password combination is valid
			if(empty($user_data['user_verification'])){

				if ($result['is_active'] == 1 || $result['is_active'] == 2 || $result['is_active'] == 3 || $result['is_active'] == 4) { 
				    // login if account status is active			
				    $email = $result['email'];
				    $nid = $result['nid'];
					$success = true;
					$message = [
						'title' => 'Verification Required',
						'description' => 'Check email or phone for code'
					];
					
					$this->send_email($email,$nid);
					$data = [];
					//$data = $result;
				}   
				else if($result['is_active'] == 0) { // show message for registered but not email activated user
					$success = false;
					$message = [
						'title' => 'Not activated',
						'description' => 'Please contact meo for activation!'
					];
					$data = [];
				}

			}else{
				
				if ($result['is_active'] == 1) { // login if account status is active
					$success = true;
					$message = [
						'title' => 'Login Successfull!',
						'description' => 'Welcome '.$result['land_owner_name'],
						'login' => true
					];
					$data = $result;
					$data['logged_in'] = true;
				}
				else if ($result['is_active'] == 2) { // show message for banned user 
					$success = false;
					$message = [
						'title' => 'Incorrect Registration Information',
						'description' => 'Please update your correct registration information'
					];
					$data = $result;
				}
				else if ($result['is_active'] == 3) { // show message for banned user 
					$success = false;
					$message = [
						'title' => 'Incorrect Flat Information',
						'description' => 'Please update your correct flat information'
					];
					$data = $result;
				}

				else if ($result['is_active'] == 4) { // show message for banned user 
					$success = false;
					$message = [
						'title' => 'Flat Information Confirmation',
						'description' => 'Your flat information is not confirm by meo yet'
					];
					$data = [];
				}

			} 
			// else if ($result['user_status'] === 'deactivated') { // if user deactivated activate and login the user
			// 	$user_data = array(
			// 		'data' => array('user_status' => 'activated'),
			// 		'user_id' => $result['user_id']
			// 		);
			// 	$this->user_model->update_user_data($user_data); // here activate user
			// 	$result['user_status'] = 'activated';
			// 	$success = true;
			// 	$message = [
			// 		'title' => 'Login successful!',
			// 		'description' => 'Welcome back! '.$result['user_name']
			// 	];
			// 	$data = $result;
			// }
            
			$data = _remove_array_elements($data,['user_password','user_token']); // after successful login we will send data to frontend so remove all sensitive data from array
			
			$this->session->set_userdata( $data ); // set session
			_json(array( // return json response
				'success' => $success,
				'message' => $message,
				'data' => $data,
				));
		} else {

			if(!empty($user_data['user_verification'])){
				$message = [
					'title' => 'Login failed!',
					'description' => 'Verification code not match'
				];
				_json(array( // if email password not matched show this message
					'success' => false,
					'message' => $message,
					));
			}else{
				$message = [
					'title' => 'Login failed!',
					'description' => 'Nid not register yet'
				];
				_json(array( // if email password not matched show this message
					'success' => false,
					'message' => $message,
					));
			}
		}
	}

	public function admin_varify()
	{
		$user_data = $this->input->post(); // receive post data from login form

		$this->load->model('user_model');
		
		if ($result = $this->user_model->login_admin_check($user_data)) { // check if email password combination is valid                   
//                    print_r($result);
//                    exit;
                    
			if ($result['is_active'] == 1) { // login if account status is active
					$success = true;
					$message = [
						'title' => 'Login Successfull!',
						'description' => 'Welcome '.$result['employee_name'],
						'login' => true
					];
					$data = $result;
					$data['logged_in'] = true;
					
				}else if($result['is_active'] == 0) { // show message for registered but not email activated user
					$success = false;
					$message = [
						'title' => 'Not activated',
						'description' => 'Please contact admin for activation!'
					];
					$data = [];
				}			
            
			$data = _remove_array_elements($data,['employee_password','user_token']); // after successful login we will send data to frontend so remove all sensitive data from array
			
			$this->session->set_userdata( $data ); // set session
			_json(array( // return json response
				'success' => $success,
				'message' => $message,
				'data' => $data,
				));
		} else {
			
			$message = [
				'title' => 'Login failed!',
				'description' => 'Wrong username or password'
			];
			_json(array( // if email password not matched show this message
				'success' => false,
				'message' => $message,
				));
		}
	}

	function send_email($email, $nid) { 
        $random_no = mt_rand(100000, 999999);
         
        $data['random_number'] = $random_no;
        if($this->user_model->update_data('land_owner', $data, array('nid'=>$nid))){

	        $from_email = "meo@glitrabd.com"; 
	        //$to_email = $this->input->post('email'); 
	   
	        //Load email library 
	        $this->load->library('email'); 
	   
	        $this->email->from($from_email, 'MEO'); 
	        $this->email->to($email);
	        $this->email->subject('Verivication Code'); 
	        $this->email->message('Your verification code is : '.$random_no); 
	   
	    }

	    //Send mail 
	    if($this->email->send()){
			return true;
	    }
         
     } 

	public function logout()
	{
		$user_data = $this->input->post();

		if($user_data['logout']){
			session_destroy();

			$message = [
					'title' => 'Logout',
					'description' => 'Successfully Logout, Please back soon.'
				];
			_json(array( // if email password not matched show this message
					'success' => false,
					'message' => $message,
					));
		}

	}

}