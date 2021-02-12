<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUserModel extends CI_Model{

    public function get_users()
    {
        $query = $this->db->get('tbl_reg');
        if($query->num_rows() > 0)
        {
            return $query->result();
            //            return $query->result_array();
        }
    }

    public function status_change($id, $status)
    {
        if($status == 'Active')
        {
            $chang_st='Not Active';
        }
        else
        {
            $chang_st='Active';
        }
        $arry = array('status'=>$chang_st);
        $this->db->where('reg_id',$id);
        $this->db->update('tbl_reg',$arry);
        if($this->db->affected_rows() > 0 ) 
            return true;
        else
            return false;
    }

    public function user_delete($id)
    {
        $this->db->where('reg_id',$id);
        $this->db->delete('tbl_reg');
        if($this->db->affected_rows() > 0 ) 
            return true;
        else
            return false;
    }
    public function get_sales_executive()
    {
        $query = $this->db->get('sales_executive');
        if($query->num_rows() > 0)
        {
            return $query->result();
            //            return $query->result_array();
        }
    }

    public function exe_delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('sales_executive');
        if($this->db->affected_rows() > 0 ) 
            return true;
        else
            return false;
    }

    public function save_exe($data_arr)
    {
        $this->db->insert('sales_executive',$data_arr);
        if($this->db->affected_rows() > 0 ) 
            return true;
        else
            return false;
    }

}
?>