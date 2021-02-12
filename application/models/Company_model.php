<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model{

    public function get_company()
    {
        $this->db->select('company_master.*, state.state_name');
        $this->db->join('state','company_master.company_state = state.state_id');
        $query = $this->db->get("company_master");
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
    }

    public function fetch_company($comp_id)
    {
        $this->db->where('company_id', $comp_id);
        $query = $this->db->get('company_master');
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
    }

    public function fetch_state()
    {
        $query = $this->db->get('state');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }

    public function update($companydata, $id)
    {
        $this->db->where('company_id',$id);
        if($query = $this->db->update('company_master',$companydata))
        {
            return true;
        }
        return false;
    }
}
?>