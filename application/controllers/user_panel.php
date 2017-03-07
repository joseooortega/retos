<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_panel extends MY_Controller {

	function __construct()
	{
		$acces_role = 0;
		parent::__construct($acces_role);
	}

	public function index()
	{

		$data['js'] = array();

		$data['content'] = 'Esto es el contenido del panel de usuario.';

		$data['view'] = 'user_panel';
		$this->load->view('template', $data);
	}

	public function manage_user($action, $data){
		$this->load->model('user');
		switch ($action) {
			case 'delete':
				$this->model->delete();
				break;
			case 'update':
				$this->model->inser();
				break;
			case 'new':
				$this->model->inser();
				break;
		}
	}
}
