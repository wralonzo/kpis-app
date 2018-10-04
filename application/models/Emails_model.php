<?php
class Emails_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db->get('email');
        return $query->result();
    }
    public function create($data)
    {
        $query = $this->db->insert('email', $data);
        return $query;
    }
    
}
