<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'D:\Programas\xampp\htdocs\retos\application\controllers\objects\user_object.php';

class MY_Controller extends CI_Controller {


	public function __construct($acces_role = null)
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');


		$this->control_access($acces_role);
	}

	private function control_access($role){

		$user = $this->session_control();
		if ($user->get_role() < $role && $role != null){
			redirect ('home');
		}
	}

	private function session_control(){

		if (!$this->session->has_userdata('user') || empty($this->session->userdata('user'))){
			$this->session->set_userdata('user', new User_object(array(
				'role' => 0,
			)));
		}

		$role = $this->session->userdata('user');

		return $role;
	}

	public function hash_value($string){
		return password_hash($string, PASSWORD_DEFAULT);
	}

	public function verify_hash($hash){
		if (password_verify('rasmuslerdorf', $hash)){
			//die('OK1');
		}else{
			//die('Ok2');
		}
	}
}










/**/
