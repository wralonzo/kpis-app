<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->load->view('layouts/main');
        $this->load->view('kpis/graficas');
        $this->load->model('Usuarios_model');
    }
    
    public function create_Kpi()
    {
        
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]');
        if (!$this->form_validation->run() == FALSE) {
            $data['main_view'] = 'kpis/create_kpi_view';
            $this->load->view('layouts/main');
        } else {
            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('layouts/main');
                $this->load->view('kpis/create_kpi_view');
                $this->load->view('layouts/footer');
            }else{

            }
        }
        
    }

    public function grafica()
    {
        $this->load->model('Usuarios_model');
        $result = $this->Usuarios_model->get_user();
        echo json_encode($result);
        //echo "hola";
    }
    
    
}