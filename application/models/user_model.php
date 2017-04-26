<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function get_by_name_and_pwd($username, $password){
	    return $this->db->get_where('t_user', array('username'=>$username, 'password'=>$password))->row();
    }
















}
