<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct()
	{
		$acces_role = 2;
		parent::__construct($acces_role);
	}

	public function index()
	{

		$data['js'] = array(
			'jquery.flexslider-min',
		);

		$data['content'] = 'Esto es el contenido';

		$data['view'] = 'home';
		$this->load->view('template', $data);
    
	}
}
