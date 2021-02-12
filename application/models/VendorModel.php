<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VendorModel extends CI_Model{
    public function save_vendor($array)
    {
        $this->db->insert('vendor_details',$array);
        
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }
    
    public function fetch_vendor()
    {
        $query = $this->db->get('vendor_details');
        
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }
    
    public function get_vendor($vendor_id)
    {
        $this->db->where('id',$vendor_id);
        $query = $this->db->get('vendor_details');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
        return false;
    }
    
    public function update_vendor($array,$vendor_id)
    {
        $this->db->where('id', $vendor_id);
        $this->db->update('vendor_details', $array);
        
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }
   
}