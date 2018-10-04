<?php

class Departamentos_model extends CI_Model{
    public function get_all()
    {
        $query = $this->db->get('departamento');
        return $query->result();
    }
}
