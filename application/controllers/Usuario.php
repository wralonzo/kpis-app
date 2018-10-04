<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function  __construct()
    {
		parent::__construct();
		$this->load->model('Emails_model');
		$this->load->model('Roles_model');
		$this->load->model('Departamentos_model');
		$this->load->model('Usuarios_model');
	}
	
    public function index()
	{
		$data['user'] = $this->Usuarios_model->listar_usuarios();
		$this->load->view('layouts/main');
		$this->load->view('usuarios/usuario_view', $data);
		$this->load->view('layouts/footer');
		
	}
	

	public function create_User()
	{
		$data2['correos'] = $this->Emails_model->get_all();
		$data2['roles'] = $this->Roles_model->get_all();
		$data2['deptos'] = $this->Departamentos_model->get_all();

		//$this->load->model('Usuarios_model');
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('txtApellido', 'Apellido', 'required');
		$this->form_validation->set_rules('txtTelefono', 'Telefono', 'required');
		$this->form_validation->set_rules('txtCorreo', 'Correo', 'required');
		$this->form_validation->set_rules('txtDepto', 'Departemento', 'required');
		$this->form_validation->set_rules('txtRol', 'Rol', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			# code...
			$this->load->view('layouts/main');
			$this->load->view('usuarios/ingreso_usuario_view',$data2);
		}else{
			$data = array(
				'nombreUsuario' => $this->input->post('txtNombre'),
				'apellidoUsuario' => $this->input->post('txtApellido'),
				'telefono' => $this->input->post('txtTelefono'),
				'idEmail' => $this->input->post('txtCorreo'),
				'idDepartamento' => $this->input->post('txtDepto'),				
				'idRol' => $this->input->post('txtRol')
			);
			$this->Usuarios_model->create($data);
			
			redirect(base_url().'Usuario');
			
		}
	}

	public function paginar(){
		$data['title'] = 'Paginacion_ci';
		$pages=1; //Número de registros mostrados por páginas
		$this->load->library('pagination'); //Cargamos la librería de paginación
		$config['base_url'] = base_url().'Usuario/paginar/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->Usuarios_model->filas();//calcula el número de filas  
		$config['per_page'] = $pages; //Número de registros mostrados por páginas
		$config['num_links'] = 20; //Número de links mostrados en la paginación
		$cabecera = ' <li class="page-item" ><a class="page-link" mdbWavesEffect aria-label="Previous"><span aria-hidden="true">&laquo;</span>
		  <span class="sr-only">Primera</span>
		</a>
	  </li>';
		$config['first_link'] = 'primera';//primer link
		$config['last_link'] = ' Última';//último link
		$config["uri_segment"] = 3;//el segmento de la paginación
		$config['next_link'] = 'Siguiente';//siguiente link
		$config['prev_link'] = 'Anterior';//anterior link
		$this->pagination->initialize($config); //inicializamos la paginación 
		$data["usu"] = $this->Usuarios_model->total_paginados($config['per_page'],$this->uri->segment(3)); 
					   
					   //cargamos la vista y el array data
		$this->load->view('usuarios/paginar', $data);
	}
}
