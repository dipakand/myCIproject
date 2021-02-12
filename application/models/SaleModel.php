<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaleModel extends CI_Model{
    function getParty($postData){

        //echo $this->input->get('term');
        $response = array();
        if($this->input->get('term') )
        {
        }
        // Select record
        $this->db->select('*');
        $this->db->where("name like '%".$this->input->get('term')."%'");

        $records = $this->db->get('manage_party')->result();
        //echo $this->db->last_query();
        foreach($records as $row ){ 
            $response[] = array("value"=>$row->id,"label"=>$row->name.'-'.$row->contact_no);
        }
        //        return $response;
        //print_r($response);
        return $response;
    }

    function getbarcode($data_get)
    {
        $respons = array();

        $term = $this->input->get('term');
        if($this->input->get('term'))
        {
            //$select =mysqli_query($conn,"SELECT name, weight, barcode, id FROM product LEFT JOIN product_desc ON product.product_id = product_desc.product_id WHERE  (product.name LIKE '%".$_GET['term']."%' or product_desc.weight LIKE '%".$_GET['term']."%')");

        }
        $this->db->select('name, weight, barcode, id');
        $this->db->join('product_desc','product.product_id = product_desc.product_id', 'left');
        $this->db->where("product.name like '%".$term."%' OR product_desc.weight like '%".$term."%' ");
        //$this->db->like('product.name', '%".$term."%');
        //$this->db->or_like('product_desc.weight', '%'.$term.'%');
        $query = $this->db->get('product');
        //echo $this->db->last_query();
        //print_r($query->result());
        foreach($query->result() as $query) 
        {    
            $data[] = ucwords($query->name).' '.$query->weight.' '.$query->id ;
        }
        return $data;
    }

    public function get_saleExe()
    {
        $query = $this->db->get('sales_executive');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }

    public function last_sales($variable)
    {
        $this->db->select('bill_no as max_bill_no ');
        $this->db->where("bill_no LIKE '%".$variable."%' ORDER BY id DESC LIMIT 1 ");
        $query = $this->db->get('sales');

        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;

    }

    public function save_sale($array, $id, $total_amt, $cod_amt)
    {
        $this->db->insert('sales', $array);
        if($this->db->affected_rows() > 0)
        {
            $last_id = $this->db->insert_id();

            $this->db->where('id', $id);
            $query1 = $this->db->get('manage_party');
            //echo $this->db->last_query(); echo nl2br("\n");
            $party_man = $query1->row();

            $credit_type = $party_man->credit_type;

            if($credit_type == '')
            {
                $cre_type = 0;
            }
            else
            {
                $cre_type = $credit_type;
            }

            if($cod_amt > 0)
            {
                $credit_tot=$cre_type - round($cod_amt);  
            }
            else
            {
                $credit_tot=$cre_type - round($total_amt); 
            }

            if($credit_tot > 0 )
            {
                $credit_tot; 
            }
            else
            {
                $credit_tot=0; 
            }
            $m_party =array('credit_type'=>$credit_tot);

            $this->db->update('manage_party', $m_party);

            foreach($this->session->userdata('all_bar') as $ky => $vals)
            {         
                $this->db->where('id', $vals[0]);
                $query1 = $this->db->get('product_desc');
                $na = $query1->row();
                $stock = $na->stock; 
                $lesss = $stock - ($vals[1] + $vals[3]);

                $product_desc =array('stock'=>$lesss);

                $this->db->where('id', $vals[0]);
                $this->db->update('product_desc', $product_desc);

            }
            return $last_id;
        }
        return false;

    }

    public function get_sale($sale_id)
    {
        $this->db->select('sales.*, sales_executive.name as sale_name');
        $this->db->join('sales_executive','sales.sale_exe = sales_executive.id','left');
        $this->db->where('sales.id', $sale_id);
        $query = $this->db->get('sales');

        return $query->row();
    }

    public function all_sale_total($p_id, $id)
    {
        $total_amt =0 ;
        $this->db->where('id !='.$id);
        $this->db->where('party_id',$p_id);
        //        echo $this->db->get_compiled_select('sales');
        $query = $this->db->get('sales');
        if($query->num_rows() > 0)
        {
            //print_r($query->result_array());
            foreach($query->result_array() as $row){
                $total =0 ;
                //                 print_r($row);
                if($row['return_amt'] > 0 && $row['return_amt'] !== '')
                {
                    $total=$row['total_amt']-$row['receive_amt']-$row['return_amt'];
                }
                else
                {
                    $total=$row['total_amt']-$row['receive_amt'];
                }
                $total_amt +=$total;
            }
            return $total_amt;
            //return $query->row();
        }
        else{
            return false;
        }

    }

    public function search_prod($pro_id)
    {
        //echo $pro_id;
        $this->db->select('product_desc.* , product.hsn, product.i_gst, product.name as pro_name');
        $this->db->where('id',$pro_id);
        $this->db->join('product','product_desc.product_id = product.product_id');
        $query = $this->db->get('product_desc')->row();
        return $query;
    }

    public function fetch_allsale($date1, $date2, $party_id)
    {
        if($party_id != '' && $date1 !='' && $date2 !='')
        {
            $where = "sales.date BETWEEN '".$date1."' AND '".$date2."' and sales.party_id = '".$party_id."' ";

        }elseif($party_id == 0 && $date1 !='' && $date2 !='')
        {
            $where = "sales.date BETWEEN '".$date1."' AND '".$date2."'";

        }/*elseif($party_id != 0 && $date1 !='' && $date2 !='')
        {
            $this->db->where('party_id',$party_id);
            $where = "date BETWEEN '".$date1."' AND '".$date2."'";
            $this->db->where($where);
        }*/


        //$where = "sales.date BETWEEN '".$date1."' AND '".$date2."'";

        $this->db->select('sales.*, manage_party.name as party_name, manage_party.contact_no, manage_party.limit_days');
        $this->db->join('manage_party','sales.party_id = manage_party.id');
        $this->db->where($where);
        $query = $this->db->get('sales');
        //echo $this->db->last_query(); echo nl2br("\n");
        //echo $query->num_rows();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return 0;

    }


    public function party_wise_allsale($date1, $date2, $party_id)
    {
        $query1 = $this->db->get('manage_party');

        $data = array();
        foreach($query1->result() as $party)
        {
            $where = "sales.date BETWEEN '".$date1."' AND '".$date2."' and sales.party_id = '".$party->id."' ";

            $this->db->select('sales.*, manage_party.name as party_name, manage_party.id as mp_id, manage_party.contact_no, manage_party.limit_days');
            $this->db->join('manage_party','sales.party_id = manage_party.id');
            $this->db->where($where);
            $query = $this->db->get('sales');
            if($query->num_rows() > 0)
            {
                $data = array_merge($data,$query->result());
            }
        }

        //print_r($data);echo nl2br("\n"); echo nl2br("\n");
        return $data;
    }


    public function single_arty($id)
    {
        $query = $this->db->where('id', $id)
            ->get('manage_party');
        return $query->row();
    }

    public function update_sale($sal_array, $sale_id)
    {
        //print_r($sal_array); 
        //echo nl2br("\n");
        $this->db->where('id', $sale_id);
        $this->db->update('sales',$sal_array);
        //        $this->db->set($sal_array);
        //        echo $this->db->get_compiled_update('sales');

        return $this->db->affected_rows();
    }

    public function get_product($txt_barcode)
    {
        $this->db->where('barcode',$txt_barcode);
        $query = $this->db->get('product_desc');
        return $query->row();
    }

    public function get_sale_log($sale_id)
    {
        $this->db->where('sales_id',$sale_id);
        $wuery = $this->db->get('sales_log');

        return $wuery->num_rows();
    }

    public function sale_log_rows($sale_id)
    {
        $this->db->where('sales_id',$sale_id);
        $wuery = $this->db->get('sales_log');

        return $wuery->result();
    }
    public function one_sale_log($id)
    {
        $this->db->where('id',$id);
        $wuery = $this->db->get('sales_log');

        return $wuery->row();
    }

    public function sales_log_insert($sal_log)
    {
        $this->db->insert('sales_log', $sal_log);
        if($this->db->affected_rows() > 0)
        {
            $this->db->where('id', $sal_log['sales_id']);
            $query = $this->db->get('sales');
            $receive_amt = $query->row()->receive_amt + $sal_log['deposit'];

            $rec_array =array('receive_amt'=>$receive_amt);
            $this->db->where('id', $sal_log['sales_id']);
            $this->db->update('sales', $rec_array);
            return $this->db->affected_rows();
        }
        return false;
    }

    public function sale_log()
    {
        $siteid = $this->input->get('desc_id');
        $this->db->where('sales_id',$siteid);
        $query = $this->db->get('sales_log');
        //echo $this->db->last_query();
        $deposit = array();
        if($query->num_rows() > 0)
        {
            //$value = new stdClass();
            $rows = $query->result();
            foreach($rows as $key => $val)
            {
                //$value->deposit = $val->deposit;
                //$value->date_time = date("d-m-Y", strtotime($val->date_time));
                $value[$key]['deposit'] = $val->deposit;
                $value[$key]['date_time'] = date("d-m-Y", strtotime($val->date_time));
                $details = unserialize($val->detail);

                $type = array();
                $no = array();
                $amt = array();
                $date = array();
                $name = array();

                foreach($details as $vles)
                {
                    $type[]=$vles['type'];
                    if($vles['no'] > 0)
                    {
                        $no[]=$vles['no'];
                    }

                    $amt[]=$vles['amt'];
                    $date[]=$vles['date'];

                    if(strlen($vles['name']) > 1)
                    {
                        $name[]=$vles['name'];
                    }
                }

                $value[$key]['payentMode'] = implode(', ',$type);
                $value[$key]['chequeNo'] = implode(', ',$no);
                $value[$key]['names'] = implode(', ',$name);

            }
            $data[]=$value;
            return $data;
        }
        return false;
    }

    public function sale_summary($frm_dt,$to_dt)
    {
        //echo $frm_dt.' '.$to_dt;

        $where = "date between '".date("Y-m-d", strtotime($frm_dt))."' and  '".date("Y-m-d", strtotime($to_dt))."' ";
        $this->db->where($where);
        $this->db->where('cancel_status','');
        $query1 = $this->db->get('sales');
        //echo $this->db->last_query();

        $id = array();
        $qty = array();
        $free = array();
        $arr = array();
        if($this->db->affected_rows() > 0)
        {
            foreach($query1->result() as $sale)
            {
                $item=unserialize($sale->item_detail);
                $item2=unserialize($sale->return_item);
                $n=0;
                foreach($item as $item_key => $item_val)
                {
                    if($sale->return_item!='')
                    {
                        foreach($item2 as $key => $item2_val)
                        {
                            if($item2_val[0] == $item_val[0])
                            {
                                $ret = $item_val[1]-$item2_val[1]; 

                                $id []=$item_val[0];
                                $qty []=$ret;
                                $free[]=$item_val[3];
                                $n++;
                            }
                        }  
                    }
                    else
                    {
                        $id []=$item_val[0];
                        $qty []=$item_val[1];
                        $free[]=$item_val[3];
                        $n++;
                    }   

                }
            }

            $this->load->model('CommenModel');
            $retu_array  = $this->CommenModel->array_combine_1($id, $qty);
            $s=1;
            $add=0;
            $add1=0;
            ksort($retu_array);
            foreach($retu_array as $retu_key => $retu_val)
            {
                $add = array_sum($retu_val);

                if($add == '')
                {
                    $add1 = $retu_val; 
                }
                else
                {
                    $add1 =$add; 
                }

                $combine[$s]['id']=$retu_key;
                $combine[$s]['qty']=$add1;
                $s++;
            }

            $retu_array1  = $this->CommenModel->array_combine_1($id, $free);     
            $s1=1;
            $ad=0;
            $ad1=0;
            ksort($retu_array1);
            foreach($retu_array1 as $retu_key1 => $retu_val1)
            {
                $ad = array_sum($retu_val1);
                if($ad == '')
                {
                    $ad1 = $ad; 
                }
                else
                {
                    $ad1 =$ad; 
                }

                $combine1[$s1]['id']=$retu_key1;
                $combine1[$s1]['free']=$ad1;
                $s1++;
            }
            foreach($combine as $arr1)
            {
                foreach($combine1 as $arr2)
                {
                    if($arr1['id'] == $arr2['id'])
                    {
                        $this->db->where('id', $arr1['id']);
                        $query = $this->db->get('product_desc');
                        $fetch11 = $query->row();
                        $weight = $fetch11->weight;
                        $nos = $fetch11->nos;
                        //$unit = $fetch11->unit;

                        $this->db->where('product_id', $fetch11->product_id);
                        $query2 = $this->db->get('product');
                        $fetch111 = $query2->row();

                        $arr[] = array('id'=> $arr1['id'], 'qty'=> $arr1['qty'], 'free'=> $arr2['free'], 'pro_name'=> $fetch111->name, 'weight'=>$weight, 'nos'=>$nos);//, 'unit'=>$unit
                        //print_r($arr);echo nl2br("\n");

                    }
                }
            }
        }

        return $arr;

    }

    public function fetch_temp_sale()
    {
        $where = "temp_sales.cancel_status!=1 and temp_sales.status=0";
        $this->db->where($where);
        $this->db->select('temp_sales.*, manage_party.name as party_name, manage_party.contact_no, sales_executive.name as sale_name');
        $this->db->join('manage_party','temp_sales.party_id = manage_party.id');
        $this->db->join('sales_executive','temp_sales.sale_exe = sales_executive.id','left');
        $query = $this->db->get('temp_sales');

        //echo  $this->db->last_query();

        if($this->db->affected_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }


    public function get_temp_sale($sale_id)
    {
        $this->db->select('temp_sales.*, sales_executive.name as sale_name');
        $this->db->join('sales_executive','temp_sales.sale_exe = sales_executive.id','left');
        $this->db->where('temp_sales.id', $sale_id);
        $query = $this->db->get('temp_sales');

        return $query->row();
    }
    
    public function insert_sale_temp($array, $all_itmes)
    {
        //print_r($all_itmes); 
        $this->db->insert('sales', $array);
        if($this->db->affected_rows() > 0)
        {
            $last_id = $this->db->insert_id();
       
            /*$this->db->where('id', $id);
            $query1 = $this->db->get('manage_party');
            //echo $this->db->last_query(); echo nl2br("\n");
            $party_man = $query1->row();

            $credit_type = $party_man->credit_type;

            if($credit_type == '')
            {
                $cre_type = 0;
            }
            else
            {
                $cre_type = $credit_type;
            }

            if($cod_amt > 0)
            {
                $credit_tot=$cre_type - round($cod_amt);  
            }
            else
            {
                $credit_tot=$cre_type - round($total_amt); 
            }

            if($credit_tot > 0 )
            {
                $credit_tot; 
            }
            else
            {
                $credit_tot=0; 
            }
            //$m_party =array('credit_type'=>$credit_tot);

            //$this->db->update('manage_party', $m_party);*/

            foreach($all_itmes as $ky => $vals)
            {         
                $this->db->where('id', $vals[0]);
                $query1 = $this->db->get('product_desc');
                $na = $query1->row();
                $stock = $na->stock; 
                $lesss = $stock - ($vals[1] + $vals[3]);

                $product_desc =array('stock'=>$lesss);

                $this->db->where('id', $vals[0]);
                $this->db->update('product_desc', $product_desc);

            }
            return $last_id;
        }
         
         
        return false;

    }
}
?>