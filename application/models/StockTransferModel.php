<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockTransferModel extends CI_Model
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
}
?>