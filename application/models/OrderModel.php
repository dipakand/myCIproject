<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model
{

    function fetch_sales_log($date1,$date2)
    {
        $where = "DATE(sales_log.date_time) between '".date("Y-m-d", strtotime($date1))."' and '".date("Y-m-d", strtotime($date2))."' ";
        $this->db->where($where);
        $this->db->select('sales_log.*, manage_party.name as p_name , sales.total_amt, sales.cod_amt, sales.cod_percent');
        $this->db->join('sales','sales_log.sales_id =sales.id');
        $this->db->join('manage_party','sales.party_id =manage_party.id');
        $query = $this->db->get('sales_log');
        if($this->db->affected_rows() > 0)
        {
            return $query->result();
        }
        return false;

    }
    
    function save_order($arr)
    {
        $this->db->insert('orders', $arr);
        return $this->db->affected_rows();
    }
    
    function view_order($fst_dt,$lst_dt)
    {
        $where = "date between '".date("Y-m-d", strtotime($fst_dt))."' and '".date("Y-m-d", strtotime($lst_dt))."' ";
        $this->db->where($where);
        $query = $this->db->get('orders');
        return $query->result();
    }
    
    function get_order($order_id)
    {
        $this->db->select('orders.*, sales_executive.name as exe_name');
        $this->db->where('orders.id',$order_id);
        $this->db->join('sales_executive','orders.sales_ex = sales_executive.id');
        $query = $this->db->get('orders');
        //echo $this->db->last_query(); exit;
        return $query->row();
    }
    
    function update_order($arr,$id)
    {
        $this->db->where('orders.id',$id);
        $this->db->update('orders', $arr);
        //echo $this->db->last_query(); echo nl2br("\n");
        return $this->db->affected_rows(); 
    }
}
?>