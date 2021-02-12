<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class VoucherModel extends CI_Model
{
    function get_vendor($vendor_id)
    {
        if($this->input->get('term') !='')
        {
            $this->db->like('name', $this->input->get('term'), 'both'); 
            $query = $this->db->get('vendor_party');

            foreach($query->result() as $vendor)
            {
                $data[]= array('label'=>$vendor->name,'value'=>$vendor->id);
            }

            return $data;
        }
    }


    function save_vendor($save_data)
    {
        //        print_r($save_data);
        $arr = array(
            "name" => $this->input->post('name'),
            "contact_no" => $this->input->post('contact'),
            "gst_in" => $this->input->post('gstin'),
            "state_id" => $this->input->post('state')
        );

        $this->db->insert('vendor_party',$arr);
        //echo $this->db->last_query();

        if($this->db->affected_rows() > 0)
        {
            return $this->db->insert_id();
        }
        return false;
    }

    function fetch_vendor($id)
    {
        $this->db->where('id', $id);
        $this->db->select('vendor_party.*, state.state_name');
        $this->db->join('state','vendor_party.state_id = state.state_id');
        $query = $this->db->get('vendor_party');
        return $query->row();
    }

    function save_voucher($data)
    {
        $this->db->insert('voucher', $data);
        return $this->db->insert_id();
    }

    function fetch_voucher($frmdate,$todate)
    {
        //        $this->db->select('voucher.*, vendor_party.name as party_name, vendor_party.contact_no');
        //        $this->db->join('vendor_party','vendor_party.id = voucher.party_id');

        $where = " DATE(date_time) between '".$frmdate."' and '".$todate."' ";
        $this->db->where($where);
        return $this->db->get('voucher')->result();
    }

    function voucher_details($v_id)
    {
        $this->db->where('id',$v_id);
        $query = $this->db->get('voucher')->row();
        
        $items = unserialize($query->items);
        
        return array('vendor_name'=> $query->vendor_name,'gstin'=> $query->gst_in,'items'=>$items);
//        return array('gstin'=> $query->gst_in,'items'=>$query->items);
        
        //gst_in
        //items
    }
    
    function single_voucher($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('voucher')->row();
    }
    
    function voucher_delete($v_id)
    {
        $this->db->where('id', $v_id);
        $this->db->delete('voucher');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }
    
    function payment_receive($updat_arr,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('voucher',$updat_arr);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }
    
}

?>