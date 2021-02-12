<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockReportModel extends CI_Model
{
    function product_stock()
    {
        $this->db->select('product_desc.*, product.name as proname, brand_master.name as brname, category.category');
        $this->db->join('product','product.product_id = product_desc.product_id');
        $this->db->join('brand_master','brand_master.id = product.brand_id');
        $this->db->join('category','category.id = product.category_id');
        $query = $this->db->get('product_desc');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }

    function getbarcode($data_get)
    {
        if($this->input->get('term') != '')
        {
            $this->db->where("product_desc.weight like '%".$this->input->get('term')."%' or  product.name like '%".$this->input->get('term')."%'");
            $this->db->select('product_desc.*, product.name as proname');
            $this->db->join('product','product.product_id = product_desc.product_id');
            $records = $this->db->get('product_desc')->result();
            //print_r($records);
            foreach($records as $row ){ 
                $response[] = array("value"=>$row->id,"label"=>ucwords($row->proname.'-'.$row->weight));
            }
            return $response;
        }
    }

    function get_data($frm_date,$to_date,$party_id)
    {
        $where = "date BETWEEN '".date('Y-m-d', strtotime($frm_date))."' AND '".date('Y-m-d', strtotime($to_date))."'";
        $this->db->where($where);
        $this->db->where('cancel_status','');
        if($party_id != '')
        {
            $this->db->where('party_id',$party_id);
        }
        $query = $this->db->get('sales');
        //echo $this->db->last_query();
        return $query->result();


        //        $where = "sales.date BETWEEN '".$date1."' AND '".$date2."'";
        //        $this->db->select('sales.*, manage_party.name as party_name, manage_party.contact_no, manage_party.limit_days');
        //        $this->db->join('manage_party','sales.party_id = manage_party.id');
        //        $this->db->where($where);
        //        $query = $this->db->get('sales');
        //        if($query->num_rows() > 0)
        //        {
        //            return $query->result();
        //        }
        //        return 0;
    }

    //    if($_POST['party_name']!=''){
    //        $partyy=explode(' ',$_POST['party_name']);
    //        $mang_party=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `manage_party` where contact_no='".end($partyy)."'"));
    //        $select ="SELECT * FROM `sales` WHERE date between '".$_POST['frm_date']."' and '".$_POST['to_date']."' and cancel_status='' and party_id='".$mang_party['id']."'";
    //    }else{
    //        $select ="SELECT * FROM `sales` WHERE date between '".$_POST['frm_date']."' and '".$_POST['to_date']."' and cancel_status=''";
    //    }
}
?>