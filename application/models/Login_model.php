<?php
class Login_model extends CI_Model
{
    public function get_Login()
    {

    }
    
    public function get_Info_login()
    {

    }

    public function create($data)
    {
        $query = $this->db->insert('login', $data);
        return $query;
    }

    public function login_user($username, $password)
    {
        $this->db->where('user', $username);
        $result = $this->db->get('login');

        $dbPassword = $result->row(2)->password;

        if(password_verify($password, $dbPassword))
        {
            return $result->row(0)->idLogin;
        }
        else {
            return FALSE;
        }
    }

    public function get_rol($username, $password)
    {
        $this->db->select('u.nombreUsuario, r.nombreRol, l.idLogin, l.user, l.password');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.idRol = r.idRol', 'inner');
        $this->db->join('login l', 'u.idUsuario = l.idUsuario','inner');        
        $this->db->where('l.user', $username);
        
        $result = $this->db->get();

        $db_password = $result->row()->password;

        if(password_verify($password, $db_password)){

            return $result->row();
        }
        else{
            return FALSE;
        }
    }
}
