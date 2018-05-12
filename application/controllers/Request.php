<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Request extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('website/request');
	}

	public function request(){

		if(!empty($this->session->dohs)){
			$user_data['land_owner_name'] =  $this->session->land_owner_name;
			$user_data['rank'] =  $this->session->rank;
			$user_data['service_number'] =  $this->session->service_number;
			$user_data['nid'] =  $this->session->nid;
			$user_data['date_of_birth'] =  $this->session->date_of_birth;

			$user_data['email'] =  $this->session->email;
			$user_data['phone'] =  $this->session->phone;
			$user_data['photo'] =  $this->session->photo;

			$user_data['is_active'] =  4;
			
			$user_data['dohs'] =  trim($this->input->post('dohs'));
			$user_data['road_no'] =  trim($this->input->post('road_no'));
			$user_data['plot_no'] =  trim($this->input->post('plot_no'));
			$user_data['floor_no'] =  trim($this->input->post('floor_no'));
			$user_data['flat_no'] =  trim($this->input->post('flat_no'));


			
			$user_data['create_date'] = date("Y-m-d H:i:s");  
		
			if ($this->user_model->insert_user($user_data) == true) {
				
				$message = [
					'title' => 'Request Added',
					'description' => 'Meo will verify and update your status'
				];
				_json(array(
					'success' => true,
					'message' => $message,
					));
			}else{

				$message = [
					'title' => 'Request Failed',
					'description' => 'Please try again later'
				];
				_json(array(
					'success' => false,
					'message' => $message,
					));
			}
		}else{

			$user_data['dohs'] =  trim($this->input->post('dohs'));
			$user_data['road_no'] =  trim($this->input->post('road_no'));
			$user_data['plot_no'] =  trim($this->input->post('plot_no'));
			$user_data['floor_no'] =  trim($this->input->post('floor_no'));
			$user_data['flat_no'] =  trim($this->input->post('flat_no'));
			$user_data['is_active'] =  4;
			
			$owner_id = $this->session->land_owner_id;

			if($this->user_model->update_data('land_owner', $user_data, array('land_owner_id'=>$owner_id)))
			{
				$message = [
					'title' => 'Request Updated',
					'description' => 'Meo will verify and update your status'
				];
				_json(array(
					'success' => true,
					'message' => $message,
					));
			}
			else{
				$message = [
					'title' => 'Request Failed',
					'description' => 'Please try again later'
				];
				_json(array(
					'success' => false,
					'message' => $message,
					));
			}
		}
	}

	public function add_buyer()
	{
		
      if(isset($_FILES['user_picture']) && $_FILES['user_picture']['size'] > 0){  
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['encrypt_name']			= true;
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('user_picture'))
        {
                //$error = array('error' => $this->upload->display_errors());
                $error =  $this->upload->display_errors();
				
				$message = array(
					'title' => 'Photo Upload failed!',
					'description' => $error,
					);
					
				_json(array(
					'success' => false,
					'message' => $message,
					));
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
			$this->load->library('image_lib');
			/*----------  thumbnail creating block start  ----------*/
			
        	$thumbnail['image_library'] = 'gd2';
			$thumbnail['source_image'] = './uploads/'.$data['upload_data']['file_name'];
			$thumbnail['create_thumb'] = TRUE;
			$thumbnail['height']         = 50;
			$thumbnail['width']         = 50;
			$this->image_lib->initialize($thumbnail);
			$this->image_lib->resize();
			/*----------  thumbnail creating block end  ----------*/
            $this->image_lib->clear();
			/*----------  image resizing block start  ----------*/
        	$resize['image_library'] = 'gd2';
			$resize['source_image'] = './uploads/'.$data['upload_data']['file_name'];
			$resize['maintain_ratio'] = TRUE;
			$resize['width']         = 300;
			$resize['height']         = 300;
			$this->image_lib->initialize($resize);
			$this->image_lib->resize();
			/*----------  image resizing block end  ----------*/
			
			$user_data['photo'] = $data['upload_data']['file_name'];
		}
	}	

		$user_data['land_owner_name'] =  trim($this->input->post('user_name'));
		$user_data['rank'] =  trim($this->input->post('user_rank'));
		$user_data['service_number'] =  trim($this->input->post('user_service_no'));
		$user_data['nid'] =  trim($this->input->post('user_nid'));
		$user_data['date_of_birth'] =  trim($this->input->post('user_dob'));

		$user_data['email'] =  trim($this->input->post('user_email'));
		$user_data['phone'] =  trim($this->input->post('user_phone'));

		
		$user_data['create_date'] = date("Y-m-d H:i:s");  
		$user_data['is_buyer'] = 1;

		$flat_data	= $this->user_model->get_flat_data(array('dohs','road_no','plot_no','floor_no','flat_no'),'land_owner',array('nid'=>$this->session->nid));	  
		foreach($flat_data as $f){ 
			$user_data['dohs'] = $f['dohs'];
			$user_data['road_no'] = $f['road_no'];
			$user_data['plot_no'] = $f['plot_no'];
			$user_data['floor_no'] = $f['floor_no'];
			$user_data['flat_no'] = $f['flat_no'];
		}

		//$user_pass = trim($this->input->post('user_password'));
		//$user_data['password'] = sha1($user_pass);
		
		//$this->load->model('user_model');
		
		if ($this->user_model->insert_user($user_data) == true) {
			
			$message = [
				'title' => 'Add Buyer',
				'description' => 'Buyer added successful!'
			];
			_json(array(
				'success' => true,
				'message' => $message,
				));
		}else{

			$message = [
				'title' => 'Add Buyer',
				'description' => 'Buyer add failed, Please try again.'
			];
			_json(array(
				'success' => false,
				'message' => $message,
				));
		}
	}
	

	public function send_mail($to_email, $owner_id) { 
        $random_no = mt_rand(100000, 999999);
         
        $data['random_number'] = $random_no;
        if($this->user_model->update_data('land_owner', $data, array('land_owner_id'=>$owner_id))){

	        $from_email = "meo@glitrabd.com"; 
	        //$to_email = $this->input->post('email'); 
	   
	        //Load email library 
	        $this->load->library('email'); 
	   
	        $this->email->from($from_email, 'MEO'); 
	        $this->email->to($to_email);
	        $this->email->subject('Verivication Code'); 
	        $this->email->message('Your verification code is : '.$random_no); 
	   
	    }

	    //Send mail 
	    if($this->email->send()){
			return true;
	    }
         
     } 
     
    
}