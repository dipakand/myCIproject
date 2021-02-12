<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonthSummaryModel extends CI_Model
{
    function fetch_voucher($date)
    {
        $this->db->where('date', $date);
        $query = $this->db->get('voucher');
        if($this->db->affected_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }
    
    function fetch_purchase_order($date)
    {
        $this->db->where('purchase_order.date', $date);
        $this->db->select('purchase_order.*, vendor_details.name as v_name');
        $this->db->join('vendor_details','purchase_order.vendor_id =vendor_details.id');
        $query = $this->db->get('purchase_order');
        if($this->db->affected_rows() > 0)
        {
            return $query->result();
        }
        return false;
        
    }
    
    function fetch_sales_log($date)
    {
        $where = "DATE(sales_log.date_time) = '".date("Y-m-d", strtotime($date))."' ";
        $this->db->where($where);
        $this->db->select('sales_log.*, manage_party.name as p_name');
        $this->db->join('sales','sales_log.sales_id =sales.id');
        $this->db->join('manage_party','sales.party_id =manage_party.id');
        $query = $this->db->get('sales_log');
        if($this->db->affected_rows() > 0)
        {
            return $query->result();
        }
        return false;
        
    }
    
}
?>