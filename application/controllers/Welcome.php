<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $data['main_content'] = 'website/home';
        $this->load->view('template/template', $data);
    }

    public function registration() {
        //$data['newses'] = $this->user_model->get_news();
        $data['main_content'] = 'website/registration';
        $this->load->view('template/template', $data);
    }

    public function check_nid() {

        if ($this->input->post() > 0) {

            $data['nid'] = trim($this->input->post('nid'));

            $query = $this->user_model->get_row_count('land_owner', $data);

            echo $query;
        }
    }

    public function create_user() {

        if (isset($_FILES['user_picture']) && $_FILES['user_picture']['size'] > 0) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 5000;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('user_picture')) {
                //$error = array('error' => $this->upload->display_errors());
                $error = $this->upload->display_errors();

                $message = array(
                    'title' => 'Photo Upload failed!',
                    'description' => $error,
                );

                _json(array(
                    'success' => false,
                    'message' => $message,
                ));
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->load->library('image_lib');
                /* ----------  thumbnail creating block start  ---------- */

                $thumbnail['image_library'] = 'gd2';
                $thumbnail['source_image'] = './uploads/' . $data['upload_data']['file_name'];
                $thumbnail['create_thumb'] = TRUE;
                $thumbnail['height'] = 50;
                $thumbnail['width'] = 50;
                $this->image_lib->initialize($thumbnail);
                $this->image_lib->resize();
                /* ----------  thumbnail creating block end  ---------- */
                $this->image_lib->clear();
                /* ----------  image resizing block start  ---------- */
                $resize['image_library'] = 'gd2';
                $resize['source_image'] = './uploads/' . $data['upload_data']['file_name'];
                $resize['maintain_ratio'] = TRUE;
                $resize['width'] = 300;
                $resize['height'] = 300;
                $this->image_lib->initialize($resize);
                $this->image_lib->resize();
                /* ----------  image resizing block end  ---------- */

                $user_data['photo'] = $data['upload_data']['file_name'];
            }
        }

        $user_data['land_owner_name'] = trim($this->input->post('user_name'));
        $user_data['rank'] = trim($this->input->post('user_rank'));
        $user_data['service_number'] = trim($this->input->post('user_service_no'));
        $user_data['nid'] = trim($this->input->post('user_nid'));
        $user_data['date_of_birth'] = trim($this->input->post('user_dob'));

        $user_data['email'] = trim($this->input->post('user_email'));
        $user_data['phone'] = trim($this->input->post('user_phone'));


        $user_data['create_date'] = date("Y-m-d H:i:s");

        //$user_pass = trim($this->input->post('user_password'));
        //$user_data['password'] = sha1($user_pass);
        //$this->load->model('user_model');

        if ($this->user_model->insert_user($user_data) == true) {

            $message = [
                'title' => 'Registration',
                'description' => 'Registration Successful!'
            ];
            _json(array(
                'success' => true,
                'message' => $message,
            ));
        } else {

            $message = [
                'title' => 'Registration',
                'description' => 'Registration not complete, Please try again.'
            ];
            _json(array(
                'success' => false,
                'message' => $message,
            ));
        }
    }

    public function login() {

        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
            $data['main_content'] = 'website/history';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'website/login';
            $this->load->view('template/template', $data);
        }
    }

    public function request() {

        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
            $data['main_content'] = 'website/request';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'website/login';
            $this->load->view('template/template', $data);
        }
    }

    public function addbuyer() {

        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
            $data['main_content'] = 'website/addbuyer';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'website/login';
            $this->load->view('template/template', $data);
        }
    }

    public function pageerror() {
        $data['main_content'] = 'website/404';
        $this->load->view('template/template', $data);
    }

    public function restricted() {
        $data['main_content'] = 'website/restricted';
        $this->load->view('template/template', $data);
    }

    //abdullah modification
    //primary document

    public function primary_document() {
        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {

            $data['main_content'] = 'website/prmary_document';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'website/login';
            $this->load->view('template/template', $data);
        }
    }

    //secondary document
    public function document() {
        $session_data = $this->session->all_userdata();
//         echo '<pre>';
//           print_r($session_data);
//           echo '</pre>';
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
            $data['main_content'] = 'website/document';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'website/login';
            $this->load->view('template/template', $data);
        }
    }

//    uplod primary document in project  folder  and save file name in database 

    public function upload_primarydocumnet() {
        $session_data = $this->session->all_userdata();
        
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {

             $F = array();

    $count_uploaded_files = count( $_FILES['images']['name'] );

    $files = $_FILES;
    for( $i = 0; $i < $count_uploaded_files; $i++ )
    {
        $_FILES['userfile'] = [
            'name'     => $files['images']['name'][$i],
            'type'     => $files['images']['type'][$i],
            'tmp_name' => $files['images']['tmp_name'][$i],
            'error'    => $files['images']['error'][$i],
            'size'     => $files['images']['size'][$i]
        ];

        $F[] = $_FILES['userfile'];
           $this->user_model->insert_documnet($F[]);
    }

    echo json_encode($F);

        }
    }

}
