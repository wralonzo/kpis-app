<?php
class Roles_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db->get('rol');
        return $query->result();
    }
    public function create($data)
    {
        $query = $this->db->insert('email', $data);
        return $query;
    }
    
}
