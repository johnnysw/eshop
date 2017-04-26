<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$this->load->view('index');
	}

	public function check_login()
    {
        $loginUser = $this->session->userdata('loginUser');
        if($loginUser){
            echo 'logined';
        }else{
            echo 'nologin';
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->model('user_model');
        $user = $this->user_model->get_by_name_and_pwd($username, $password);
        if($user){
            $this->session->set_userdata('loginUser', $user);
            echo 'success';
        }else{
            echo 'fail';
        }
    }


}
