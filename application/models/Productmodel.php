<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productmodel extends CI_Model{
    public function getBrand()
    {
        $query = $this->db->get('brand_master');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }
    public function getcategory()
    {
        $query = $this->db->get('category');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }

    public function save_produvt($prod_arr)
    {
        $this->db->insert('product',$prod_arr);
        //echo $this->db->last_query();
        if($this->db->affected_rows() > 0)
        {
            return $this->db->insert_id();
        }
        return 0;
    }

    public function update_prod($product_id, $array)
    {
        $this->db->where('product_id', $product_id);
        $this->db->update('product',$array);
        //echo $this->db->last_query(); echo nl2br("\n");
        //echo $this->db->affected_rows();
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getProduct($product_id)
    {
        $this->db->where('product_id',$product_id);
        $query = $this->db->get('product');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
    }

    public function save_prod_desc($desc_arry, $prodcut_id)
    {
        $prodcut_id; 
        $user_id = $this->session->userdata('auth')->role;

        $arrry = '';
        foreach($desc_arry as $val)
        {
            $arrry = array(
                'product_id' => $prodcut_id,
                'weight' => $val[0],
                'mrp' => $val[1],
                'barcode' => $val[2],
                'stock' => $val[3],
                'sale_price' => $val[4],
                'user' => $user_id,
                'date_time' => date("Y-m-d H:i:s")
            );
            //print_r($arrry);echo nl2br("\n");
            $this->db->insert('product_desc',$arrry);
            //echo $this->db->last_query();
        }
        if($this->db->affected_rows() > 0)
        {
            return $this->db->affected_rows();
        }
        return 0;
    }

    public function getProductDesc()
    {
        //$this->db->select('product_desc.*, product.name as proname, product.hsn , brand_master.name as brname, category.category');
        $this->db->select('product.*, brand_master.name as brname, category.category');
        //$this->db->join('product','product.product_id = product_desc.product_id');
        $this->db->join('brand_master','brand_master.id = product.brand_id');
        $this->db->join('category','category.id = product.category_id');
        $query = $this->db->get('product');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }
    public function Desc_row($id)
    {
        //$this->db->select('product_desc.*, product.name as proname, product.hsn , brand_master.name as brname, category.category');
        $this->db->select('product_desc.*, product.name as proname, brand_master.name as brname, category.category');
        $this->db->where('product_desc.id', $id);
        $this->db->join('product','product.product_id = product_desc.product_id');
        $this->db->join('brand_master','brand_master.id = product.brand_id');
        $this->db->join('category','category.id = product.category_id');
        $query = $this->db->get('product_desc');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
    }

    public function get_description()
    {
        $siteid = $this->input->get('desc_id');
        $this->db->where('product_id',$siteid);
        $query = $this->db->get('product_desc');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            //print_r($query->row());
            return $query->result();
        }
        return false;
    }

    public function save_desc($id,$arrry)
    {
        $this->db->where('id',$id);
        $this->db->update('product_desc',$arrry);
        //echo $this->db->last_query();
        if($this->db->affected_rows() > 0)
        {
            return $this->db->affected_rows();
        }
        return false;
    }

    public function delete_desc($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('product_desc');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function save_brand($arra)
    {
        $this->db->insert('brand_master', $arra);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getbrandrow($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('brand_master');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
    }

    public function update_brand($id, $arra)
    {
        $this->db->where('id',$id);
        $this->db->update('brand_master',$arra);
        //echo $this->db->last_query(); exit;
        if($this->db->affected_rows() > 0)
        {
            return $this->db->affected_rows();
        }
        return false;
    }
}
?>