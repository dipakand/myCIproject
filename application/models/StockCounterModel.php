<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockCounterModel extends CI_Model
{

    function fetch_data()
    {
        $this->db->select('product_desc.* , product.hsn, product.i_gst, product.name as pro_name, brand_master.name as b_name');
        $this->db->join('product','product_desc.product_id = product.product_id');
        $this->db->join('brand_master','product.brand_id = brand_master.id');
        $query = $this->db->get('product_desc');
        return $query->result();
        //        print_r($query->result());

    }

    function save_stock($count)
    {
        foreach($count as $key => $val)
        {
            if($val!='')
            {
                $arrr = array(
                    "prod_desc_id" => $key,
                    "count" => $val,
                    "date" => date('Y-m-d'),
                    "date_time" => date('Y-m-d H:i:s')
                );
                
                $this->db->insert('stock_counter',$arrr);
            }
        }
        
        return $this->db->affected_rows();
    }
}
?>