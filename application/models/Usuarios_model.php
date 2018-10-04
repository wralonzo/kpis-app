<?php
class Usuarios_model extends CI_Model
{
    public function create($data)
    {
        $query = $this->db->insert('usuario', $data);
        return $query;
    }

    public function get_all()
    {
        $query = $this->db->get('usuario');
        return $query->result();
    }
    public function get_user()
    {
        $this->db->select('nombreUsuario, apellidoUsuario');
        $this->db->from('usuario');
		$query = $this->db->get();      
        return $query->result();
    }

    public function listar_usuarios()
    {
        $this->db->select('u.nombreUsuario, u.apellidoUsuario, u.telefono, e.email, d.nombreDepto, r.nombreRol');
        $this->db->from('usuario u');
        $this->db->join('email e', 'e.idEmail = u.idEmail', 'inner');
        $this->db->join('departamento d', 'u.idDepartamento = d.idDepartamento', 'inner');
        $this->db->join('rol r', 'u.idRol = r.idRol', 'inner');
        $data = $this->db->get();
        return $data->result();
    }
    


    //obtener la filas de los usuarios
    public function filas()
    {
        $consulta = $this->db->get('usuario');
        return  $consulta->num_rows() ;
    }
            
        //obtenemos todas las provincias a paginar con la función
        //total_posts_paginados pasando la cantidad por página y el segmento
        //como parámetros de la misma
    public function total_paginados($por_pagina,$segmento) 
    {
        $consulta = $this->db->get('usuario',$por_pagina,$segmento);
        if($consulta->num_rows()>0)
        {
            foreach($consulta->result() as $fila)
            {
                $data[] = $fila;
            }
            return $data;
        }
    }
       
}
