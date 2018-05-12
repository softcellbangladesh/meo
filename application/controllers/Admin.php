<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $session_data = $this->session->all_userdata();
//        print_r($session_data);
//        exit;
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
            if ($session_data['employee_username'] == 'demoMEO') {
                $data['main_content'] = 'admin/meoadmin';
                $this->load->view('template/template', $data);
            } else {
                $data['main_content'] = 'admin/request';
                $this->load->view('template/template', $data);
            }
        } else {
            $data['main_content'] = 'admin/login';
            $this->load->view('template/template', $data);
        }
    }

    public function request() {

        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
       
        } else {
            $data['main_content'] = 'admin/login';
            $this->load->view('template/template', $data);
        }
    }

    public function edit_user($owner_id = null) {

        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
            $data['land_owner'] = $this->user_model->get_table_data('land_owner', array('land_owner_id' => $owner_id));
            $data['main_content'] = 'admin/manage_user';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'admin/login';
            $this->load->view('template/template', $data);
        }
    }

    public function change_status() {
        $land_owner_id = trim($this->input->post('land_owner_id'));
        $data['is_active'] = trim($this->input->post('is_active'));

        if ($data['is_active'] != 1) {

            if ($this->user_model->update_data('land_owner', $data, array('land_owner_id' => $land_owner_id)) == true) {

                $message = [
                    'title' => 'Status Updated',
                    'description' => 'Owner updated successful!'
                ];
                _json(array(
                    'success' => true,
                    'message' => $message,
                ));
            } else {

                $message = [
                    'title' => 'Status Updated',
                    'description' => 'Owner updated failed, Please try again.'
                ];
                _json(array(
                    'success' => false,
                    'message' => $message,
                ));
            }
        } else {

            if ($this->user_model->update_data('land_owner', $data, array('land_owner_id' => $land_owner_id)) == true) {

                $document_list = $this->user_model->get_table_data('document_list', '');

                $req_data['employee_employee_id'] = 12;
                $req_data['curent_status'] = 'Started';
                $req_data['land_owner_land_owner_id'] = $land_owner_id;
                $req_data['request_date'] = date("Y-m-d H:i:s");

                $req_id = $this->user_model->insert_data('request', $req_data);

                foreach ($document_list as $dl) {
                    $owner_doc['owner_id'] = $land_owner_id;
                    $owner_doc['document_id'] = $dl['document_list_id'];
                    $owner_doc['status'] = 0;
                    $owner_doc['request_request_id'] = $req_id;
                    $owner_doc['update_at'] = date("Y-m-d H:i:s");

                    $owner_provide_doc = $this->user_model->insert_data_multi('owner_provide_doc', $owner_doc);
                }


                $message = [
                    'title' => 'Status Updated',
                    'description' => 'Owner updated successful!'
                ];
                _json(array(
                    'success' => true,
                    'message' => $message,
                ));
            } else {

                $message = [
                    'title' => 'Status Updated',
                    'description' => 'Owner updated failed, Please try again.'
                ];
                _json(array(
                    'success' => false,
                    'message' => $message,
                ));
            }
        }
    }

    public function started_request() {

        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {




            $data['main_content'] = 'admin/manage_request';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'admin/login';
            $this->load->view('template/template', $data);
        }
    }

    public function started_requestedit($request_id = null) {

        $session_data = $this->session->all_userdata();
        if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
            //$data['doc_submited']	= $this->user_model->get_table_data('owner_provide_doc', array('status'=>'0', 'request_request_id'=>$request_id));
            $data['doc_submited'] = $this->user_model->get_table_data('owner_provide_doc', array('request_request_id' => $request_id));

            $data['main_content'] = 'admin/manage_request_doc';
            $this->load->view('template/template', $data);
        } else {
            $data['main_content'] = 'admin/login';
            $this->load->view('template/template', $data);
        }
    }

    public function change_doc_status() {
        $owner_pro_doc_id['doc_id'] = $this->input->post('owner_pro_doc_id');

        foreach ($owner_pro_doc_id['doc_id'] as $di) {
            $doc_id = $di['0'];

            $doc_data['status'] = 1;

            $this->user_model->update_data('owner_provide_doc', $doc_data, array('owner_provide_doc_id' => $doc_id));
        }

        $message = [
            'title' => 'Status Updated',
            'description' => 'Document updated successful!'
        ];
        _json(array(
            'success' => true,
            'message' => $message,
        ));
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

    public function pageerror() {
        $data['main_content'] = 'website/404';
        $this->load->view('template/template', $data);
    }

    public function restricted() {
        $data['main_content'] = 'website/restricted';
        $this->load->view('template/template', $data);
    }

}
