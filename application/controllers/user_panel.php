<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_panel extends MY_Controller {

	function __construct()
	{
		$acces_role = 0;
		parent::__construct($acces_role);
		$this->load->library('form_validation');
	}

	public function index($action = 'new')
	{
		//die(var_dump($this->session->userdata('user')));
		$user = new User_object();
		$user->set_username('admin');
		$user->login();

		$data['js'] = array();
		$data['action'] = $action;

		$data['content'] = 'Esto es el contenido del panel de usuario.';
		$view = $action;

		if ($action == 'new' || $action == 'edit'){
			$view = 'manage';
		}
		if ($action == 'edit'){
			$data['user'] = $this->session->userdata('user');
		}

		//die(var_dump($data));

		$data['view'] = $action.'_user';
		$this->load->view('template', $data);
	}

	public function manage_user($action = ''){

		$post = $this->input->post();

		$this->form_validation->set_rules('u_id', '', 'number');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|alpha_numeric_spaces'); //trim
		if ($post['username'])
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required|is_unique[user.username]');
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		if ($post['repeat_password'])
		$this->form_validation->set_rules('repeat_password', 'Las contraseñas no coinciden', 'required|matches[password]');
		$this->form_validation->set_rules('nivel', '', 'number|regex_match[/^[0-9]{2}$/]');
		$this->form_validation->set_rules('siguiente_nivel', '', 'number|regex_match[/^[0-9]{3}$/]');
		$this->form_validation->set_rules('role', '', 'number|regex_match[/^[0-2]{1}$/]');

		if ($this->form_validation->run()){

			isset($post['u_id']) ? $data['u_id'] = $post['u_id'] : '';
			$data['nombre'] = trim($post['nombre']);
			$data['apellidos'] = trim($post['apellidos']);
			$data['username'] = trim($post['username']);
			$data['password'] = trim($post['password']);
			$data['email'] = trim($post['email']);

			$data = limpiar_inputs($data);

			die(var_dump($data));
			$this->load->model('user');
			switch ($action) {
				case 'delete':
					$this->user->delete($data);
					break;
				case 'edit':
					$this->user->update($data);
					break;
				case 'new':
					$this->user->new($data);
					break;
				default:
					log_message('info', 'Se ha intentado acceder por esta ruta: user/'.$action);
					redirect ('error/404', 'refresh');
			}
		}else{
			$this->index($action);
		}
	}
}
