<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseModel extends CI_Model{

    function getVendor()
    {
        //echo $this->input->get('term');
        $response = array();
        if($this->input->get('term'))
        {
            $this->db->where("name like '%".$this->input->get('term')."%'");

            $records = $this->db->get('vendor_details')->result();
            //echo $this->db->last_query();
            foreach($records as $row ){ 
                $response[] = array("value"=>$row->id,"label"=>$row->name.'-'.$row->contact);
            }
            return $response;
        }
        return $response;
    }

    function fetch_vendor($vendor_id)
    {
        $this->db->where('id',$vendor_id);
        $query = $this->db->get('vendor_details');
        if($query->num_rows() > 0 )
        {
            return $query->row();
        }
        return false;
    }

    public function insert_order($order_arr,$inv_no,$in_date)
    {

        $this->db->insert('purchase_order', $order_arr);
        if($this->db->affected_rows() > 0 )
        {
            $last_id = $this->db->insert_id();

            $this->db->where('id', $last_id);

            $arr = array(
                "inv_no" => $last_id,
                "inv_date" => $in_date
            );
            $this->db->update('purchase_order', $arr);
            return true;
        }
        return false;
    }
    public function insert_hold_order($order_arr)
    {
        $this->db->insert('hold_order', $order_arr);
        if($this->db->affected_rows() > 0 )
        {
            return true;
        }
        return false;
    }

    public function get_purchase_order($frmdate,$todate)
    {
        $where = "purchase_order.date between '".$frmdate."' and '".$todate."' order by id desc";
        $this->db->select('purchase_order.*, vendor_details.name, vendor_details.contact');
        $this->db->where($where);
        $this->db->join('vendor_details','purchase_order.vendor_id = vendor_details.id','left');
        $query = $this->db->get('purchase_order');
        //echo $this->db->last_query();
        return $query->result();

    }

    function get_order($ord_id)
    {
        $this->db->where('id', $ord_id);
        $query = $this->db->get('purchase_order');
        //echo $this->db->last_query();
        //print_r($query->row());

        $items = unserialize($query->row()->items);
        $data = array();
        foreach($items as $key => $item)
        {
            $this->db->where('id',$item[0]);
            $this->db->select('product_desc.*, product.name as prod_name');
            $this->db->join('product','product_desc.product_id = product.product_id','left');
            $query1 = $this->db->get('product_desc');
            //print_r($query1->row());echo nl2br("\n");
            $data[$key]['name'] = ucwords($query1->row()->prod_name);
            $data[$key]['weight'] = $query1->row()->weight;
            $data[$key]['barcode'] = $query1->row()->barcode;
            $data[$key]['qty'] = $item[1];

        }
        return $data;
    }

    function get_order_hold($ord_id)
    {
        $this->db->where('id', $ord_id);
        $query = $this->db->get('hold_order');
        //echo $this->db->last_query();
        //print_r($query->row());

        $data = array();
        if($query->row()->items != 'N;' and $query->row()->items != '')
        {
            $items = unserialize($query->row()->items);
            if(count($items) > 0){
                foreach($items as $key => $item)
                {
                    $this->db->where('id',$item[0]);
                    $this->db->select('product_desc.*, product.name as prod_name');
                    $this->db->join('product','product_desc.product_id = product.product_id','left');
                    $query1 = $this->db->get('product_desc');
                    //print_r($query1->row());echo nl2br("\n");
                    $data[$key]['name'] = ucwords($query1->row()->prod_name);
                    $data[$key]['weight'] = $query1->row()->weight;
                    $data[$key]['barcode'] = $query1->row()->barcode;
                    $data[$key]['qty'] = $item[1];

                }
            }
        }
        //print_r($data);
        return $data;
    }

    function get_purchase_order_row($order_id)
    {
        $this->db->where('purchase_order.id', $order_id);
        //$this->db->select('purchase_order.*, vendor_details.name as vend_name, vendor_details.contact as vend_contact');
        //$this->db->join('vendor_details','purchase_order.vendor_id = vendor_details.id', 'left');
        $query = $this->db->get('purchase_order');
        return $query->row();
    }

    function update_order($upda_arr,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('purchase_order', $upda_arr);
        $this->db->last_query();
        return true;
    }

    function save_pur_log($pur_log)
    {
        $this->db->insert('purchase_log', $pur_log);
        if($this->db->affected_rows() > 0 )
        {
            $last_id = $this->db->insert_id();
            return $last_id;
        }
        return false;
    }

    public function purchase_order_cancel($order_id)
    {
        $this->db->where('id', $order_id);
        $this->db->set('status','1');
        //echo $this->db->get_compiled_update('purchase_order');
        $this->db->update('purchase_order');
        //exit;
        if($this->db->affected_rows() > 0 )
        {
            return true;
        }
        return false;
    }

    public function get_hold_order($frmdate,$todate)
    {
        $where = "hold_order.date between '".$frmdate."' and '".$todate."' order by id desc";
        $this->db->select('hold_order.*, vendor_details.name, vendor_details.contact');
        $this->db->where($where);
        $this->db->join('vendor_details','hold_order.vendor_id = vendor_details.id','left');
        $query = $this->db->get('hold_order');
        //echo $this->db->last_query();
        return $query->result();
    }


    function get_hold_order_row($order_id)
    {
        $this->db->where('hold_order.id', $order_id);
        //$this->db->select('purchase_order.*, vendor_details.name as vend_name, vendor_details.contact as vend_contact');
        //$this->db->join('vendor_details','purchase_order.vendor_id = vendor_details.id', 'left');
        $query = $this->db->get('hold_order');
        return $query->row();
    }

    function update_hold_order($update,$order_id)
    {
        $this->db->where('id', $order_id);
        $this->db->update('hold_order', $update);
        $this->db->last_query();
        return true;
    }

    function all_purcahse_order($frmdate,$todate)
    {
        //$where = "status!=1 and recev_status!=0 and date between '".date("Y-m-d",strtotime($frmdate))."' and '".date("Y-m-d",strtotime($todate))."'";
        $where = "date between '".date("Y-m-d",strtotime($frmdate))."' and '".date("Y-m-d",strtotime($todate))."'";
        $this->db->where($where);
        $this->db->where('status!=',1);
        $this->db->where('recev_status!=',0);
        $this->db->order_by('date','asc');
        $query = $this->db->get('purchase_order');

        //print_r($query->result());
        //exit;
        return $query->result();
    }

    public function all_purcahse_order_fetch($frmdate,$todate)
    {
        $where = "date between '".date("Y-m-d",strtotime($frmdate))."' and '".date("Y-m-d",strtotime($todate))."'";
        $this->db->where($where);
        $this->db->where('status!=',1);
        $this->db->where('recev_status!=',0);
        $this->db->where('received!=','');
        $this->db->order_by('date','asc');
        $query = $this->db->get('purchase_order');

        //print_r($query->result());
        //exit;
        return $query->result();
        //"select * from purchase_order where received!='' and status!=1 and recev_status!=0 and date between '".date("Y-m-d",strtotime($frmdate))."' and '".date("Y-m-d",strtotime($todate))."' order by date asc"
    }

    public function get_product()
    {
        $query = $this->db->get('product_desc');
        return $query->result();
    }
}