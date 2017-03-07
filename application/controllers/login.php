<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	function __construct()
	{
		$acces_role = 0;
		parent::__construct($acces_role);
	}

	public function index()
	{

		$data['view'] = 'login';
		$this->load->view('template', $data);
	}

  public function check(){

    $this->load->model('user');


    $user = $this->input->post('username');
    $pass = $this->input->post('password');//$this->hash_value($this->input->post('password'));

    //$this->verify_hash($pass);

    $data = array(
      'username' => $user,
      'password' => $pass,
    );

		//die(var_dump($data));

    $result = $this->user->login($data);

		//die(var_dump($result));

    if (count($result) > 0){
			$this->session->set_userdata('user', new User_object($result));
		}
		die(var_dump($this->session->userdata('user')));
  }
}
