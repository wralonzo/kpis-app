<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	public function  __construct()
    {
		parent::__construct();
		$this->load->model('Emails_model');
		$this->load->model('Roles_model');
	}

	public function index()
	{
		$data['rol'] = $this->Roles_model->get_all();
		$this->load->view('layouts/main');
		$this->load->view('usuarios/usuario_view');
		
	}
}