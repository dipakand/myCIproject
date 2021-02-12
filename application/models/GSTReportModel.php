<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GSTReportModel extends CI_Model
{
    public function get_purchase($frmdate, $todate)
    {
        $where = "date between '".$frmdate."' and '".$todate."'";
        $this->db->where($where);
        $query = $this->db->get('purchase_order');
        
        return $query->result();
    }
    
    public function get_voucher($frmdate, $todate)
    {
        $where = "date between '".$frmdate."' and '".$todate."'";
        $this->db->where($where);
        $query = $this->db->get('voucher');
        
        return $query->result();
    }
    public function get_sales($frmdate, $todate)
    {
        $where = "date between '".$frmdate."' and '".$todate."'";
        $this->db->where($where);
        $this->db->where('cancel_status','');
        $query = $this->db->get('sales');
        
        return $query->result();
    }
}