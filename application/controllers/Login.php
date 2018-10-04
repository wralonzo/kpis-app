<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Usuarios_model');
        $this ->load->library('encryption');
    }
     
    public function index()
    {
        if (!$this->session->userdata('logged_admin'));
        {
           $this->session->set_flashdata('no_access', 'No esta autorizado para acceder'); 
           //echo 'no access';
           
           //redirect('login/');
           
        }
        if ($this->Login_model->get_Login()) {
            $data['login_data'] = $this->login_model->get_Info_login();
        }
        $this->load->view('layouts/main');
        $this->load->view('login/login_view');
    }

    public function create()
    {
        
        $data['user_data'] = $this->Usuarios_model->get_all();
   
            $this->form_validation->set_rules('txtUser', 'Nombres', 'required');
            $this->form_validation->set_rules('txtPassword', 'Apellidos', 'required');
            $this->form_validation->set_rules('txtUsuario', 'Usuario', 'required');
        

            $options = ['cost'=>12];
            $encripted_pass = password_hash($this->input->post('txtPassword'), PASSWORD_BCRYPT,  $options);
        

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/main');
                $this->load->view('login/ingresar_user_view', $data);
            } else {
                $data = array(
                    'user' => $this->input->post('txtUser'),
                    'password' => $encripted_pass,
                    'idUsuario' => $this->input->post('txtUsuario'),
                );      
                $this->Login_model->create($data);
               redirect('login/create');
               
                }

                if ($this->session->userdata('logueado')){
                    //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
                    redirect(base_url());
                }

        
            //
        
    }

    

    public function start_Login()
    {
        if($this->input->post('txtUser') && $this->input->post('txtPassword'))
        {
            $username = $this->input->post('txtUser');
            $pass = $this->input->post('txtPassword');
            

            //$idLogin = $this->Login_model->login_user($username, $pass);
            $rol = $this->Login_model->get_rol($username, $pass);
            //$usuario = $rol->nombreUsuario;
            //echo $usuario;         
            


            if ($rol) {
                $user_data = array(
                    'logueado'  => true,
                    'id_login'  => $rol->idLogin,
                    'roles'     => $rol->nombreRol
                );
                
                $this->session->set_userdata($user_data);
                //echo $this->session->set_userdata('roles');
                redirect(base_url());
            }
            else {
                $this->session->set_flashdata('login_failed', 'Lo sentimos, no lograste ingresar al sistema');
                redirect(base_url().'login');
             }

        }
    }
    public function logout(){

        $this->session->sess_destroy();
        redirect(base_url());
    }


    public function roles()
    {
        $this->load->library('encryption');
        $username = 'wrgmail';
        $password = '$2y$12$0./MrfTdXAhm46s0bCvfN.0x2ehkuWoe5h6GgT4xGvnWGb00tfpj.';
        
        $rol = $this->Login_model->get_rol($username, $password);
        $usuario = $rol->nombreUsuario;
        $nombre = $rol->nombreRol;
        $user = $rol->user;
        $pass = $rol->password;
        echo $usuario;
        echo '<br>';
        echo $nombre;echo '<br>';
        echo $user;echo '<br>';
        echo $pass;

    }
}
