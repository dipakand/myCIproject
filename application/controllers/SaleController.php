<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaleController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model');
        $this->load->model('CommenModel');
        $this->load->model('SaleModel');
        $this->load->model('PartyModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function sale()
    {
        $data['title'] = 'Sale';
        $data['head_name'] = 'Sale';

        $data['company_row'] = $this->Company_model->get_company();

        $this->load->view('layout/header',$data);
        $this->load->view('SaleModule/sale');
        $this->load->view('layout/footer');
    }

    function party_session()
    {
        //print_r($this->input->post());

        $id_party = $this->input->post('party_id');
        $discount = $this->input->post('enter_disc');

        $this->db->where('id', $id_party);
        //        $this->db->join('state');
        $query = $this->db->get('manage_party');

        //print_r($query->row());

        $this->session->set_userdata('party_session',$query->row());

        $this->db->where('party_id', $id_party);
        $query2 = $this->db->get('sales');
        $total_amt = 0;
        foreach($query2->result() as $sale)
        {
            if($sale->return_amt > 0 && $sale->return_amt !=='')
            {
                $total=$sale->total_amt-$sale->receive_amt-$sale->return_amt;
            }
            else
            {
                $total=$sale->total_amt-$sale->receive_amt;
            }
            $total; 
            $total_amt +=$total;
        }
        //echo $total_amt;
        $this->session->set_userdata('pending',$total_amt);
        $this->session->set_userdata('discount',$discount);

        redirect('Sale');
    }

    public function getParty()
    {
        // POST data
        $postData = $this->input->post();
        // Get data 
        $data = $this->SaleModel->getParty($postData);
        echo json_encode($data);
    }

    public function getbarcode()
    {
        $data_get = $this->input->post();
        $data = $this->SaleModel->getbarcode($data_get);
//        print_r($data);

        echo json_encode($data);
    }

    public function product_session()
    {
        $barcode = $this->input->post('barcode');
        $sale_id = $this->input->post('edit'); 
        $exp = explode(' ',$barcode);

        if(count($exp) > 1)
        {
            $id_pr = end($exp);
            $this->db->where('id', $id_pr);
            $query = $this->db->get('product_desc');
        }
        else
        {
            $this->db->where('barcode', $barcode);
            $query = $this->db->get('product_desc');
        }

        $pro_desc = $query->row();

        $n=0;
        if($this->input->post('edit'))
        {
            $sale_row = $this->SaleModel->get_sale($sale_id);
            $item_detail = unserialize($sale_row->item_detail);
            foreach($item_detail as $keys => $vals)
            { 
                if($pro_desc->id == $vals[0])
                {   
                    $n ++;
                    $this->session->set_flashdata('error', 'This item is alredy exist , Please remove and enter again...');
                }
            }
        }
        else
        {
            $all=$this->session->userdata('all_bar');    
            //check item exist
            foreach($all as $keys => $vals)
            { 
                if($pro_desc->id == $vals[0])
                {   
                    $n ++;
                    $this->session->set_flashdata('error', 'This item is alredy exist , Please remove and enter again...');
                }
            }
        }

        if($n == 0){
            $this->db->where('product_id', $pro_desc->product_id);
            $query2 = $this->db->get('product');

            $prodcut = $query2->row();

            $this->session->set_userdata('product_desc', $pro_desc);
            $this->session->set_userdata('product_name', $prodcut->name.' '.$pro_desc->weight);
            $this->session->set_userdata('product_id', $pro_desc->id);
            $this->session->set_userdata('sale_price', $pro_desc->sale_price);
            $this->session->set_userdata('hsn', $prodcut->hsn);
            $this->session->set_userdata('i_gst', $prodcut->i_gst);
            $this->session->set_userdata('c_gst', $prodcut->c_gst);
            $this->session->set_userdata('s_gst', $prodcut->s_gst);
        }
        if($this->input->post('edit'))
        {
            redirect('EditSales/'.$this->input->post("edit"));
        }
        elseif($this->input->post('edit_temp'))
        {
            redirect('EditTempSale/'.$this->input->post("edit_temp"));
        }
        else
        {
            redirect('Sale');
        }

    }

    public function add_session()
    {
        $fetchcom = $this->Company_model->get_company();
        $fetchparty = $this->session->userdata('party_session');
        //echo $this->input->post('edit_temp_sale');

        if($this->input->post('stock') >= $this->input->post('qty'))
        {
            $name = $this->input->post('name'); 
            $qty = $this->input->post('qty'); 
            $sale_price =$this->input->post('sale_price'); 
            $free = $this->input->post('free'); 
            $disc_amt1 = $this->input->post('disc_per'); 
            $disc_amt = $disc_amt1."%"; 
            $disc = ($this->input->post('sale_price')*($disc_amt1/100)); 
            $amount = ($this->input->post('sale_price')-$disc)*$this->input->post('qty') ; 
            $hsn = $this->session->userdata('hsn'); 


            if($fetchcom->company_state == $fetchparty->state_id)
            {
                $i_gst = $this->session->userdata('i_gst');
                $c_gst = $this->session->userdata('c_gst');
                $s_gst = $this->session->userdata('s_gst');
                $cgst= ($amount*$c_gst)/100 ;
                $sgst= ($amount*$s_gst)/100 ;
                $all_bar[]=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$cgst,$sgst,$i_gst);
                //print_r($all_bar);

            }
            else
            {
                $i_gst[] = $this->session->userdata('i_gst');
                $igst[] = ($amount*$i_gst)/100 ;
                $all_bar[]=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$igst,$i_gst);

            }
            if($this->session->userdata('all_bar'))
            {

                $all_bar_sess = $this->session->userdata('all_bar');

                $all_bar1 = array_merge($all_bar_sess, $all_bar);

                $this->session->set_userdata('all_bar', $all_bar1);
            }
            else
            {
                $this->session->set_userdata('all_bar', $all_bar);

            }
            unset($all_bar);

            $this->session->unset_userdata('product_desc');
            $this->session->unset_userdata('product_name');
            $this->session->unset_userdata('product_id');
            $this->session->unset_userdata('sale_price');
            $this->session->unset_userdata('hsn');
            $this->session->unset_userdata('i_gst');
            $this->session->unset_userdata('c_gst');
            $this->session->unset_userdata('s_gst');
        }
        else
        {
            $this->session->set_flashdata('error','Item Stock Not Availabel.!!!');
        }
        if($this->input->post('edit_temp_sale'))
        {
            redirect('EditTempSale/'.$this->input->post('edit_temp_sale'));

        }
        else
        {
            redirect('Sale');
        }
    }

    public function unset_product()
    {
        $key = $this->uri->segment(3);
        $temp_id = $this->uri->segment(4);

        $all_bar_sess = $this->session->userdata('all_bar');

        unset($all_bar_sess[$key]);

        $this->session->set_userdata('all_bar', $all_bar_sess);
        if($temp_id)
        {
            redirect('EditTempSale/'.$temp_id);
        }
        else
        {
            redirect('Sale');
        }

    }

    function unset_session()
    {
        $this->session->unset_userdata('party_session');
        $this->session->unset_userdata('product_desc');
        $this->session->unset_userdata('product_name');
        $this->session->unset_userdata('product_id');
        $this->session->unset_userdata('sale_price');
        $this->session->unset_userdata('hsn');
        $this->session->unset_userdata('i_gst');
        $this->session->unset_userdata('c_gst');
        $this->session->unset_userdata('s_gst');
        $this->session->unset_userdata('all_bar');
        $this->session->unset_userdata('tax_detail');
    }

    public function cancel_deal()
    {
        /*$this->session->unset_userdata('party_session');
        $this->session->unset_userdata('product_desc');
        $this->session->unset_userdata('product_name');
        $this->session->unset_userdata('product_id');
        $this->session->unset_userdata('sale_price');
        $this->session->unset_userdata('hsn');
        $this->session->unset_userdata('i_gst');
        $this->session->unset_userdata('c_gst');
        $this->session->unset_userdata('s_gst');
        $this->session->unset_userdata('all_bar');
        $this->session->unset_userdata('tax_detail');*/
        $this->unset_session();
        redirect('Sale');
    }

    public function preview()
    {
        //print_r($this->session->userdata('all_bar'));

        $data['company_row'] = $this->Company_model->get_company();

        $data['sales_exe'] = $this->SaleModel->get_saleExe();

        //$fetchcom = $this->Company_model->get_company();
        //$fetchparty = $this->session->userdata('party_session');
        $data['party_row'] =  $this->session->userdata('party_session');

        $all_item=$this->session->userdata('all_bar');
        $tax_amt=0;
        $gst_c=0;
        $gst_s=0;
        $gst_i=0;
        foreach($all_item as $k => $v)
        {
            $hsn11[]=$v[5];
            $tax_rat[]=$v[6];
            $tax_amt += $v[6];
            if($data['company_row']->company_state == $data['party_row']->state_id)
            {
                $gst_c +=$v[7];
                $gst_s +=$v[8];
                $per_i[] =$v[9];  
            }
            else
            {
                $gst_i +=$v[7];
                $per_i[]=$v[8];
            }
        }
        $tax_amt; 
        $gst_c; 
        $gst_s;
        $gst_i;
        $per_i;
        //    print_r($hsn11);echo nl2br("\n");
        //    print_r($tax_rat);echo nl2br("\n");

        $array3  = $this->CommenModel->array_combine_($hsn11,$tax_rat,$per_i);  
        $n2=1; 
        foreach($array3 as $key2=>$val2)
        { 
            $count=count($val2);
            $sum = 0;
            for($ij=0; $ij<$count; $ij=$ij+2)
            {
                $sum += $val2[$ij];
                $amt[]=$val2[$ij];
                $gst[]=$val2[$ij+1];
            }

            $common  = $this->CommenModel->array_combine_1($gst,$amt);
            foreach($common as $ky => $vl)
            {
                $sum = 0;
                if(is_array($vl)){
                    $sum= array_sum($vl); 
                } else {
                    $sum= $vl; 
                }
                $item1[$n2]['hsn'] = $key2;
                $item1[$n2]['tax'] = $sum;
                $item1[$n2]['gst'] = $ky;
                $n2++; 
            }
            unset($amt);
            unset($gst);
        }
        //print_r($item1);echo nl2br("\n");echo nl2br("\n");

        $this->session->set_userdata('tax_detail', $item1);

        $this->load->view('SaleModule/preview_sale', $data);
    }

    public function save_deal()
    {

        $fetchcom = $this->Company_model->get_company();
        $fetchparty = $this->session->userdata('party_session');
        $all_item=$this->session->userdata('all_bar');
        //print_r($all_item);
        $tax_amt=0;
        $gst_c=0;
        $gst_s=0;
        $gst_i=0;
        foreach($all_item as $k => $v)
        {
            $hsn11[]=$v[5];
            $tax_rat[]=$v[6];
            $tax_amt += $v[6];
            if($fetchcom->company_state == $fetchparty->state_id)
            {
                $gst_c +=$v[7];
                $gst_s +=$v[8];
                $per_i[] =$v[9];  
            }
            else
            {
                $gst_i +=$v[7];
                $per_i[]=$v[8];
            }
        }

        $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i; 
        $cod_perc=$this->input->post('cod');  
        $percent = $total_amt*($cod_perc/100);

        $cod_amt=0;
        if($cod_perc > 0)
        {
            $cod_amt = $total_amt-$percent; 
        }
        else
        {
            $cod_amt = $cod_perc; 
        }

        $h_disc=$this->input->post('h_disc');  
        $h_percent = $total_amt*($h_disc/100);
        if($h_disc > 0)
        {
            $h_disc_amt = $total_amt-$h_percent; 
        }
        else
        {
            $h_disc_amt = $h_disc; 
        }


        $curdate = strtotime(date("d-m-Y")) ;
        $cald = date('Y');
        $date2 = strtotime("31-03-".$cald) ;
        if($curdate > $date2 )
        {
            $curdate;
            $financial_year1 = date("y", $curdate);
            $financial_year2 =  date("y", strtotime("+1 year"));
            $current_year1 =  $financial_year1 . $financial_year2 ;
        }
        elseif($curdate <= $date2)
        {
            $financial_year1= date('y',strtotime("-1 year"));
            $financial_year2 = date('y');
            $current_year1 =  $financial_year1 . $financial_year2;
        }

        $bill_no='';
        if($fetchcom->bill_display_date < date('Y-m-d'))
        {
            //mysqli_fetch_assoc(mysqli_query($conn,"SELECT bill_no as max_bill_no FROM `sales` WHERE bill_no LIKE '%".$current_year1.$fetchcom->prefix."%' ORDER BY id DESC LIMIT 1"));

            $variable = $current_year1.$fetchcom->prefix;
            $last_job_no = $this->SaleModel->last_sales($variable);
            if($last_job_no->max_bill_no!= '')
            {
                $bill_len= strlen($current_year1)+strlen($fetchcom->prefix);
                $bill_splt= str_split($last_job_no->max_bill_no,$bill_len);
                //print_r($bill_splt);echo nl2br("\n");
                $bl_no=$bill_splt[1]+1;
                //print_r($bl_no);echo nl2br("\n");

                $strto= strtoupper($current_year1.$fetchcom->prefix);
                $bl_no1 = str_replace($strto,'',$last_job_no->max_bill_no);
                $bl_no1 = $bl_no1 + 1;
                $last_Job_id = $current_year1.strtoupper($fetchcom->prefix).sprintf("%05d",(int)$bl_no1);
            }
            else
            {
                $last_Job_id = $current_year1.strtoupper($fetchcom->prefix).'00001';
            }
        }
        $bill_no = $last_Job_id;

        $item_detail = serialize($all_item);
        $tax_detail = serialize($this->session->userdata('tax_detail'));
        $credit_amt =0;
        if($this->input->post('tot_val')){
            $credit_amt = $this->input->post('tot_val');
        }

        if($total_amt !=0 && ($item_detail !='' || $item_detail != 'N;')){

            $sal_array = array(
                "party_id" => $fetchparty->id,
                "date" => $this->input->post('todate'),
                "taxable_amt" => $tax_amt,
                "c_gst" => $gst_c,
                "s_gst" => $gst_s,
                "i_gst" => $gst_i,
                "item_detail" => $item_detail,
                "tax_detail" => $tax_detail,
                "total_amt" => round($total_amt),
                "cod_percent" => $cod_perc,
                "cod_amt" => round($cod_amt),
                "h_disc_percent" => $h_disc,
                "h_disc_amt" => round($h_disc_amt),
                "receive_amt" => 0,
                "credit_amt" => $credit_amt,
                "user" => $this->session->userdata('auth')->role,
                "date_time" => date("Y-m-d H:i:s"),
                "sale_exe" => $this->input->post('sale_exe'),
                "bill_no" => $bill_no
            );
            //print_r($sal_array);

            $result = $this->SaleModel->save_sale($sal_array, $fetchparty->id, $total_amt, $cod_amt);
            if($result > 0)
            {
                $this->unset_session();
                $this->session->set_flashdata('message', 'sale save.!!!');
                //redirect('SaleController/invoice_print/',$result);
                redirect('Sale');
            }
            else
            {
                $this->session->set_flashdata('error', 'sale not save.!!!');
                $this->unset_session();
                redirect('Sale');
            }
        }
        else
        {
            $this->unset_session();
            $this->session->set_flashdata('error', 'item not available in array.!!!');
            redirect('Sale');
        }

    }

    public function invoice_print()
    {
        $sale_id = $this->uri->segment(3);

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $this->load->view('SaleModule/invoice',$data);
    }

    public function invoice_12_print()
    {
        $sale_id = $this->uri->segment(3);

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $this->load->view('SaleModule/invoice_12',$data);
    }

    public function allsale()
    {
        //print_r($this->input->post());
        $this->unset_session();

        if($this->input->post())
        {
            $party_id = $this->input->post('id_party');
            $date_frm = $this->input->post('date_frm');
            $date_to = $this->input->post('date_to');


            if($party_id != '' && $date_frm != '' && $date_to != '')
            {
                $p_id =$party_id ;
                $date1 = $date_frm;
                $date2 = $date_to;
            }
            else
            {
                $p_id = '' ;
                $date1 = $date_frm;
                $date2 = $date_to;
            }
        }
        else
        {
            $p_id = '' ;
            $date1 = date("Y-m-01");
            $date2 = date("Y-m-d");
        }
        //echo $date1.' '.$date2.' '.$p_id; 
        $data['title'] = 'Sale';
        $data['head_name'] = 'All Sale';
        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_rows'] = $this->SaleModel->fetch_allsale($date1, $date2, $p_id);
        //echo 'sale_rows ';print_r($data['sale_rows']);exit;
        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SaleModule/viewAllSale');
        $this->load->view('layout/footer');
    }

    public function party_change()
    {
        $sale_id = $this->uri->segment(2); 
        //PartyChange
        $data['title'] = 'Sale';
        $data['head_name'] = 'Party Change';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);
        //print_r($data['sale_row']);
        $id_party = $data['sale_row']->party_id;

        $data['fetchparty'] = $this->SaleModel->single_arty($id_party);

        if($this->input->post())
        {
            $password = $data['company_row']->passcode;
            if($this->input->post('password_vl') == $password)
            {
                $sal_array = array('party_id' => $this->input->post('party_id_new'));
                $result = $this->SaleModel->update_sale($sal_array, $sale_id);
                $this->session->set_flashdata('success','Update Successfully.!!!');
                redirect('AllSales');
            }
        }
        else
        {
            $this->load->view('layout/header',$data);
            $this->load->view('SaleModule/party_change');
            $this->load->view('layout/footer');
        }

    }

    public function edit_sale()
    {
        $sale_id = $this->uri->segment(2); 

        //$this->db->where('id', $id_party);
        //$query = $this->db->get('manage_party');
        //$this->session->set_userdata('party_session',$query->row());

        $data['title'] = 'Sale';
        $data['head_name'] = 'Edit Sale';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);
        //print_r($data['sale_row']);
        $id_party = $data['sale_row']->party_id;

        $data['fetchparty'] = $this->SaleModel->single_arty($id_party);


        $this->load->view('layout/header',$data);
        $this->load->view('SaleModule/edit_sale');
        $this->load->view('layout/footer');

    }

    public function cancel_edit_deal()
    {
        $this->unset_session();
        redirect('AllSales');
    }
    public function cancel_edit_temp()
    {
        $this->unset_session();
        redirect('SaleExecutive');
    }

    public function update_sale()
    {
        $fetchcom = $this->Company_model->get_company();

        $sale_id = $this->input->post('sale_id');

        $sale_row = $this->SaleModel->get_sale($sale_id);
        $id_party = $sale_row->party_id;

        $fetchparty = $this->SaleModel->single_arty($id_party);


        if($this->input->post('stock') >= $this->input->post('qty'))
        {
            $name = $this->input->post('name'); 
            $qty = $this->input->post('qty'); 
            $sale_price =$this->input->post('sale_price'); 
            $free = $this->input->post('free'); 
            $disc_amt1 = $this->input->post('disc_per'); 
            $disc_amt = $disc_amt1."%"; 
            $disc = ($this->input->post('sale_price')*($disc_amt1/100)); 
            $amount = ($this->input->post('sale_price')-$disc)*$this->input->post('qty') ; 
            $hsn = $this->session->userdata('hsn'); 


            if($fetchcom->company_state == $fetchparty->state_id)
            {
                $i_gst = $this->session->userdata('i_gst');
                $c_gst = $this->session->userdata('c_gst');
                $s_gst = $this->session->userdata('s_gst');
                $cgst= ($amount*$c_gst)/100 ;
                $sgst= ($amount*$s_gst)/100 ;
                $all_bar[]=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$cgst,$sgst,$i_gst);
            }
            else
            {
                $i_gst[] = $this->session->userdata('i_gst');
                $igst[] = ($amount*$i_gst)/100 ;
                $all_bar[]=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$igst,$i_gst);
            }
            $all_items = unserialize($sale_row->item_detail);
            $all_item = array();
            if(count($all_items) > 0)
            {
                $all_item = array_merge($all_items, $all_bar);
            }
            else
            {
                $all_item = $all_bar;
            }
            //unset($all_bar);
            //print_r($all_item);echo nl2br("\n");

            $tax_amt=0;
            $gst_c=0;
            $gst_s=0;
            $gst_i=0;
            foreach($all_item as $k => $v)
            {
                $hsn11[]=$v[5];
                $tax_rat[]=$v[6];
                $tax_amt += $v[6];
                if($fetchcom->company_state == $fetchparty->state_id)
                {
                    $gst_c +=$v[7];
                    $gst_s +=$v[8];
                    $per_i[] =$v[9];  
                }
                else
                {
                    $gst_i +=$v[7];
                    $per_i[]=$v[8];
                }
            }

            $array3  = $this->CommenModel->array_combine_($hsn11,$tax_rat,$per_i);  
            $n2=1; 
            foreach($array3 as $key2=>$val2)
            { 
                $count=count($val2);
                $sum = 0;
                for($ij=0; $ij<$count; $ij=$ij+2)
                {
                    $sum += $val2[$ij];
                    $amt[]=$val2[$ij];
                    $gst[]=$val2[$ij+1];
                }

                $common  = $this->CommenModel->array_combine_1($gst,$amt);
                foreach($common as $ky => $vl)
                {
                    $sum = 0;
                    if(is_array($vl)){
                        $sum= array_sum($vl); 
                    } else {
                        $sum= $vl; 
                    }
                    $item1[$n2]['hsn'] = $key2;
                    $item1[$n2]['tax'] = $sum;
                    $item1[$n2]['gst'] = $ky;
                    $n2++; 
                }
                unset($amt);
                unset($gst);
            }

            $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i; 
            $cod_perc=$this->input->post('cod');  
            $percent = $total_amt*($cod_perc/100);
            $cod_perc = 0;

            $cod_amt=0;
            if($cod_perc > 0)
            {
                $cod_amt = $total_amt-$percent; 
            }
            else
            {
                $cod_amt = $cod_perc; 
            }

            $h_disc=$this->input->post('h_disc'); 
            $h_disc = 0;
            $h_percent = $total_amt*($h_disc/100);
            if($h_disc > 0)
            {
                $h_disc_amt = $total_amt-$h_percent; 
            }
            else
            {
                $h_disc_amt = $h_disc; 
            }

            $item_detail = serialize($all_item);
            $tax_detail = serialize($item1);
            $credit_amt =0;
            if($this->input->post('tot_val')){
                $credit_amt = $this->input->post('tot_val');
            }

            if($total_amt !=0 && ($item_detail !='' || $item_detail != 'N;'))
            {

                $sal_array = array(
                    "taxable_amt" => $tax_amt,
                    "c_gst" => $gst_c,
                    "s_gst" => $gst_s,
                    "i_gst" => $gst_i,
                    "item_detail" => $item_detail,
                    "tax_detail" => $tax_detail,
                    "total_amt" => round($total_amt),
                    "cod_percent" => $cod_perc,
                    "cod_amt" => round($cod_amt),
                    "h_disc_percent" => $h_disc,
                    "h_disc_amt" => round($h_disc_amt)
                );
                //print_r($sal_array); 

                //echo $name.' = '.$qty;

                $this->db->where('id', $name);
                $query1 = $this->db->get('product_desc');
                $na = $query1->row();
                $stock = $na->stock; 
                $lesss = $stock - ($qty + $free);

                $product_desc =array('stock'=>$lesss);

                $this->db->where('id', $name);
                $this->db->update('product_desc', $product_desc);

                $result = $this->SaleModel->update_sale($sal_array, $sale_id);
                if($result > 0)
                {
                    $this->unset_session();
                }
                else
                {
                    $this->unset_session();
                }
                redirect('EditSales/'.$sale_id);
            }
            else
            {
                $this->unset_session();
                $this->session->set_flashdata('error', 'item not available in array.!!!');
                redirect('Sale');
            }

        }
        else
        {
            $this->session->set_flashdata('error','Item Stock Not Availabel.!!!');
        }
    }

    public function delete_item()
    {
        $this->uri->segment(3);   
        $this->uri->segment(4); 

        $fetchcom = $this->Company_model->get_company();

        $key = $this->uri->segment(3);

        $sale_id = $this->uri->segment(4);

        $sale_row = $this->SaleModel->get_sale($sale_id);
        $id_party = $sale_row->party_id;
        $fetchparty = $this->SaleModel->single_arty($id_party);

        {
            $id=$sale_id;
            $key;

            $array_d=unserialize($sale_row->item_detail);

            $this->db->where('id', $array_d[$key][0]);
            $query1 = $this->db->get('product_desc');
            $na = $query1->row();
            $stock = $na->stock; 
            $lesss = $stock + ($array_d[$key][1] + $array_d[$key][3]);

            $product_desc =array('stock'=>$lesss);

            $this->db->where('id', $array_d[$key][0]);
            $this->db->update('product_desc', $product_desc);


            unset($array_d[$key]);

            $all_item=$array_d;
            $tax_amt=0;
            $gst_c=0;
            $gst_s=0;
            $gst_i=0;

            $hsn11 = array();
            $tax_rat = array();
            $per_i = array();
            foreach($all_item as $k => $v)
            {         
                $hsn11[]=$v[5];
                $tax_rat[]=$v[6];
                $tax_amt += $v[6];
                if($fetchcom->company_state == $fetchparty->state_id)
                {
                    $gst_c +=$v[7];
                    $gst_s +=$v[8];
                    $per_i[] =$v[9]; 
                }
                else
                {
                    $gst_i +=$v[7];
                    $per_i[]=$v[8];
                } 
            }
            $tax_amt; 
            $gst_c; 
            $gst_s;
            $gst_i;
            $per_i; 


            $array3  = $this->CommenModel->array_combine_($hsn11,$tax_rat,$per_i);  
            $n2=1; 
            foreach($array3 as $key2=>$val2)
            { 
                $count=count($val2); 
                for($ij=0; $ij<$count; $ij=$ij+2)
                {
                    $sum += $val2[$ij];
                    $amt[]=$val2[$ij];
                    $gst[]=$val2[$ij+1];
                }

                $common  = $this->CommenModel->array_combine_1($gst,$amt);
                foreach($common as $ky => $vl)
                {
                    if(is_array($vl)){
                        $sum= array_sum($vl); 
                    } else {
                        $sum= $vl; 
                    }

                    $item1[$n2]['hsn'] = $key2;
                    $item1[$n2]['tax'] = $sum;
                    $item1[$n2]['gst'] = $ky;
                    $n2++; 
                }
                unset($amt);
                unset($gst);
            }
            $tax_detail=serialize($item1);

            $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i;
            sort($all_item);


            $item_detail=serialize($all_item) ;

            $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i;
            //$percent = $total_amt*($_POST['cod']/100);


            $sal_array = array(
                "taxable_amt" => $tax_amt,
                "c_gst" => $gst_c,
                "s_gst" => $gst_s,
                "i_gst" => $gst_i,
                "item_detail" => $item_detail,
                "tax_detail" => $tax_detail,
                "total_amt" => round($total_amt),
                "cod_percent" => $cod_perc,
                "cod_amt" => round($cod_amt)
            );

            $result = $this->SaleModel->update_sale($sal_array, $sale_id);
            redirect('EditSales/'.$sale_id);

        }
    }

    public function discount_update()
    {
        $this->input->post('discount');   
        $this->input->post('sale_id');

        $fetchcom = $this->Company_model->get_company();

        $discount = $this->input->post('discount');

        $sale_id = $this->input->post('sale_id'); 

        $sale_row = $this->SaleModel->get_sale($sale_id);
        $id_party = $sale_row->party_id;

        $fetchparty = $this->SaleModel->single_arty($id_party);

        $item_detail = unserialize($sale_row->item_detail);

        foreach($item_detail as $ky1=>$val1)
        {
            $name=$val1[0];
            $qty=$val1[1];
            $sale_price=$val1[2];
            $free=$val1[3];
            $disc_amt1=$discount;
            $disc_amt=$disc_amt1."%";
            $disc=($sale_price*($disc_amt1/100));
            $amount=($sale_price-$disc)*$qty ;
            $hsn=$val1[5];
            if($fetchcom->company_state == $fetchparty->state_id)
            {
                $i_gst=$val1[9];
                $c_gst=$val1[9]/2;
                $s_gst=$val1[9]/2;
                $cgst= round(($amount*$c_gst)/100,2) ;
                $sgst= round(($amount*$s_gst)/100,2) ;
                $all_bar=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$cgst,$sgst,$i_gst);
                $array_bar[$ky1]=$all_bar;
                unset($all_bar);
            }
            else
            {
                $i_gst=$val1[8];
                $igst= round(($amount*$i_gst)/100,2) ;
                $all_bar=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$igst,$i_gst);
                $array_bar[$ky1]=$all_bar;
                unset($all_bar);
            }
        }

        $all_item=$array_bar;
        $tax_amt=0;
        $gst_c=0;
        $gst_s=0;
        $gst_i=0;
        foreach($all_item as $k => $v)
        {         
            $hsn11[]=$v[5];
            $tax_rat[]=$v[6];
            $tax_amt += $v[6];
            if($fetchcom->company_state == $fetchparty->state_id)
            {
                $gst_c +=$v[7];
                $gst_s +=$v[8];
                $per_i[] =$v[9]; 
            }
            else
            {
                $gst_i +=$v[7];
                $per_i[]=$v[8];
            } 
        }
        $tax_amt; 
        $gst_c; 
        $gst_s;
        $gst_i;
        $per_i; 


        $array3  = $this->CommenModel->array_combine_($hsn11,$tax_rat,$per_i);  
        $n2=1; 
        foreach($array3 as $key2=>$val2)
        { 
            $count=count($val2); 
            for($ij=0; $ij<$count; $ij=$ij+2)
            {
                //$sum += $val2[$ij];
                $amt[]=$val2[$ij];
                $gst[]=$val2[$ij+1];
            }

            $common  = $this->CommenModel->array_combine_1($gst,$amt);
            foreach($common as $ky => $vl)
            {
                if(is_array($vl)){
                    $sum= array_sum($vl); 
                } else {
                    $sum= $vl; 
                }

                $item1[$n2]['hsn'] = $key2;
                $item1[$n2]['tax'] = $sum;
                $item1[$n2]['gst'] = $ky;
                $n2++; 
            }
            unset($amt);
            unset($gst);
        }
        $tax_detail=serialize($item1);

        $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i;
        sort($all_item);

        $cod_amt=0;
        $cod_perc = 0;
        if($cod_perc > 0)
        {
            $cod_amt = $total_amt-$percent; 
        }
        else
        {
            $cod_amt = $cod_perc; 
        }

        $h_disc=$this->input->post('h_disc'); 
        $h_disc = 0;
        $h_percent = $total_amt*($h_disc/100);
        if($h_disc > 0)
        {
            $h_disc_amt = $total_amt-$h_percent; 
        }
        else
        {
            $h_disc_amt = $h_disc; 
        }

        $item_detail=serialize($all_item) ;

        $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i;
        //$percent = $total_amt*($_POST['cod']/100);


        $sal_array = array(
            "taxable_amt" => $tax_amt,
            "c_gst" => $gst_c,
            "s_gst" => $gst_s,
            "i_gst" => $gst_i,
            "item_detail" => $item_detail,
            "tax_detail" => $tax_detail,
            "total_amt" => round($total_amt),
            "cod_percent" => $cod_perc,
            "cod_amt" => round($cod_amt),
            "h_disc_percent" => $h_disc,
            "h_disc_amt" => round($h_disc_amt)
        );
        $result = $this->SaleModel->update_sale($sal_array, $sale_id);
        redirect('EditSales/'.$sale_id);
    }

    public function delete_by_borcode()
    {
        //echo $this->input->post('txt_barcode'); echo nl2br("\n");
        //echo $this->input->post('sale_id'); echo nl2br("\n");echo nl2br("\n");

        $fetchcom = $this->Company_model->get_company();

        $txt_barcode = $this->input->post('txt_barcode');
        $prduct_des = $this->SaleModel->get_product($txt_barcode);
        $pro_desc = $prduct_des->id;

        $sale_id = $this->input->post('sale_id'); 

        $fetchsale = $this->SaleModel->get_sale($sale_id);
        $id_party = $fetchsale->party_id;

        $fetchparty = $this->SaleModel->single_arty($id_party);

        $item_detail = unserialize($fetchsale->item_detail);
        foreach($item_detail as $kkee=>$vvll12)
        {

            if($vvll12[0]==$pro_desc)
            {
                //echo $vvll12[0] .' = '.$pro_desc;
                $vvll = $vvll12;

                unset($item_detail[$kkee]);

                $fnl_qty = $vvll[1]-1;

                $name=$vvll[0];
                $qty = $fnl_qty;
                $sale_price=$vvll[2];
                $free=$vvll[3];
                $disc_amt1 = explode('%',$vvll[4]);
                $disc_amt=$vvll[4];
                $disc=($sale_price*($disc_amt1[0]/100));
                $amount=($sale_price-$disc)*$qty ;
                $hsn=$vvll[5];
                if($fetchcom->company_state == $fetchparty->state_id)
                {

                    $i_gst=$vvll[9];
                    $c_gst=$vvll[9]/2;
                    $s_gst=$vvll[9]/2;
                    $cgst= ($amount*$c_gst)/100 ;
                    $sgst= ($amount*$s_gst)/100 ;
                    $all_bar[] = array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$cgst,$sgst,$i_gst);

                }
                else
                {

                    $i_gst=$vvll[8];
                    $igst= ($amount*$i_gst)/100 ;
                    $all_bar[] = array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$igst,$i_gst);

                }
                //print_r($all_bar);echo nl2br("\n");

                if($fnl_qty>0)
                {
                    $item_detail = array_merge($item_detail,$all_bar);
                    //$qr11="update product_desc set stock=stock+'1' where id='".$name."'";

                    $this->db->where('id', $name);
                    $query1 = $this->db->get('product_desc');
                    $na = $query1->row();
                    $stock = $na->stock; 
                    $lesss = $stock + 1;

                    $product_desc =array('stock'=>$lesss);

                    $this->db->where('id', $name);
                    $this->db->update('product_desc', $product_desc);
                }
            }
        }

        $all_item=$item_detail;
        $tax_amt=0;
        $gst_c=0;
        $gst_s=0;
        $gst_i=0;



        foreach($all_item as $k => $v)
        {         
            $hsn11[]=$v[5];
            $tax_rat[]=$v[6];
            $tax_amt += $v[6];
            if($fetchcom->company_state == $fetchparty->state_id)
            {
                $gst_c +=$v[7];
                $gst_s +=$v[8];
                $per_i[] =$v[9]; 
            }
            else
            {
                $gst_i +=$v[7];
                $per_i[]=$v[8];
            } 
        }
        $tax_amt; 
        $gst_c; 
        $gst_s;
        $gst_i;
        $per_i; 

        $array3  = $this->CommenModel->array_combine_($hsn11,$tax_rat,$per_i);  
        $n2=1; 
        foreach($array3 as $key2=>$val2)
        { 
            $count=count($val2); 
            for($ij=0; $ij<$count; $ij=$ij+2)
            {
                //$sum += $val2[$ij];
                $amt[]=$val2[$ij];
                $gst[]=$val2[$ij+1];
            }
            $common  = $this->CommenModel->array_combine_1($gst,$amt);
            foreach($common as $ky => $vl)
            {
                if(is_array($vl)){
                    $sum= array_sum($vl); 
                } else {
                    $sum= $vl; 
                }
                $item1[$n2]['hsn'] = $key2;
                $item1[$n2]['tax'] = $sum;
                $item1[$n2]['gst'] = $ky;
                $n2++; 
            }
            unset($amt);
            unset($gst);
        }


        $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i;
        sort($all_item);

        $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i;
        $percent = $total_amt*(0/100);

        $h_disc=$fetchsale->h_disc_percent;  
        $h_percent = $total_amt*($fetchsale->h_disc_percent/100);
        $h_disc_amt=0;
        if($fetchsale->h_disc_percent > 0)
        {
            $h_disc_amt = $total_amt-$h_percent; 
        }
        else
        {
            $h_disc_amt = $fetchsale->h_disc_percent; 
        }

        if(count($all_item)>0)
        {
            $item_detail=serialize($all_item) ;
            $tax_detail=serialize($item1);
        }
        else{
            $item_detail='' ;
            $tax_detail='';
        }
        //print_r($item_detail);

        $sal_array = array(
            "taxable_amt" => $tax_amt,
            "c_gst" => $gst_c,
            "s_gst" => $gst_s,
            "i_gst" => $gst_i,
            "item_detail" => $item_detail,
            "tax_detail" => $tax_detail,
            "total_amt" => round($total_amt),
            "cod_percent" => $cod_perc,
            "cod_amt" => round($cod_amt),
            "h_disc_percent" => $h_disc,
            "h_disc_amt" => round($h_disc_amt)
        );
        $result = $this->SaleModel->update_sale($sal_array, $sale_id);
        redirect('EditSales/'.$sale_id);

    }

    public function cod_update()
    {
        $sale_id = $this->uri->segment(2);

        $data['title'] = 'Sale';
        $data['head_name'] = 'Edit Sale';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);


        if($this->input->post())
        {
            $sale_fetch = $data['sale_row'];
            $total_amt=$sale_fetch->taxable_amt + $sale_fetch->c_gst + $sale_fetch->s_gst + $sale_fetch->i_gst ;  
            $cod_perc=$this->input->post('cod');  
            $percent = $total_amt*($this->input->post('cod')/100);
            if($this->input->post('cod') > 0)
            {
                $cod_amt = $total_amt-$percent; 
            }
            else
            {
                $cod_amt = $this->input->post('cod'); 
            }

            $sal_array = array(
                "date" => $this->input->post('todate'),
                "cod_percent" => $cod_perc,
                "cod_amt" => round($cod_amt)
            );
            $result = $this->SaleModel->update_sale($sal_array, $sale_id);
            $this->session->set_flashdata('success','Update Successfully.!!!');
            $this->unset_session();
            redirect('AllSales');
        }
        else
        {
            $this->load->view('layout/header',$data);
            $this->load->view('SaleModule/cod_update');
            $this->load->view('layout/footer');
        }
    }

    public function sale_view()
    {
        $sale_id = $this->uri->segment(2);

        $data['title'] = 'Sale';
        $data['head_name'] = 'View Sale';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $this->load->view('layout/header',$data);
        $this->load->view('SaleModule/sale_view');
        $this->load->view('layout/footer');
    }

    public function pending_list()
    {
        $data['title'] = 'Sale';
        $data['head_name'] = 'View Sale';

        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frm_dt = date("d-m-Y", strtotime($this->input->post('from_date')));
            $to_dt = date("d-m-Y", strtotime($this->input->post('to_date')));
        }
        else
        {
            $frm_dt = date("01-m-Y"); 
            $to_dt = date("d-m-Y");
        }

        $data['from_dt'] = $frm_dt;
        $data['to_dt'] = $to_dt;
        $date1 = date("Y-m-d", strtotime($frm_dt));
        $date2 = date("Y-m-d", strtotime($to_dt));
        $party_id = '';

        $data['pendiing_sales'] = $this->SaleModel->fetch_allsale($date1, $date2, $party_id);


        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SaleModule/pending_list');
        $this->load->view('layout/footer');
    }
    public function party_pending_list()
    {
        $data['title'] = 'Sale';
        $data['head_name'] = 'View Sale';

        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frm_dt = date("d-m-Y", strtotime($this->input->post('from_date')));
            $to_dt = date("d-m-Y", strtotime($this->input->post('to_date')));
            $aging = $this->input->post('aging');
        }
        else
        {
            $frm_dt = date("01-m-Y"); 
            $to_dt = date("d-m-Y");
            $aging = '';
        }

        $data['from_dt'] = $frm_dt;
        $data['to_dt'] = $to_dt;
        $data['aging'] = $aging;
        $date1 = date("Y-m-d", strtotime($frm_dt));
        $date2 = date("Y-m-d", strtotime($to_dt));
        $party_id = '';

        $data['pendiing_list'] = $this->SaleModel->party_wise_allsale($date1, $date2, $party_id);


        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SaleModule/party_pending_list');
        $this->load->view('layout/footer');
    }

    public function receive_main()
    {
        $sale_id = $this->uri->segment(2);
        //party_pending
        if($this->uri->segment(3))
        {
            $this->session->set_userdata($this->uri->segment(3),1);
        }

        $data['title'] = 'Sale';
        $data['head_name'] = 'View Sale';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        $data['sale_log_row'] = $this->SaleModel->get_sale_log($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $this->load->view('layout/header',$data);
        $this->load->view('SaleModule/received_main');
        $this->load->view('layout/footer');
    }
    public function sale_cod()
    {
        //print_r($this->input->post());echo nl2br("\n");

        $sale_id = $this->input->post('s_id');
        $cod = $this->input->post('cod');
        $sale_row = $this->SaleModel->get_sale($sale_id);


        //print_r($sale_row);


        $total_amt = $sale_row->total_amt;

        $percent = $total_amt*($cod/100);
        if($cod > 0)
        {
            $cod_amt = $total_amt-$percent; 
        }
        else
        {
            $cod_amt = $cod; 
        }
        $cod_arr = array(
            'cod_percent' =>$this->input->post('cod'),
            'cod_amt' =>round($cod_amt)
        );

        $result = $this->SaleModel->update_sale($cod_arr, $sale_id);
        $this->session->set_flashdata('success','Update Successfully.!!!');

        redirect('ReceivePayment/'.$sale_id);
    }

    public function receive_Payment()
    {
        $sale_id = $this->uri->segment(2);
        $this->session->userdata('pending');

        $data['title'] = 'Sale';
        $data['head_name'] = 'Receive Payment';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);
        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        //print_r($this->input->post());
        if($this->input->post())
        {
            $tot=$_POST['payment_number11'][0]+$_POST['payment_number11'][1]+$_POST['payment_number11'][2]+$_POST['payment_number11'][3]+$_POST['payment_number11'][4];
            if($tot == $_POST['receive_amt'])
            {
                foreach($_POST['payment_number1'] as $pay1)
                {
                    $payment_no1[] =$pay1;    
                }
                foreach($_POST['payment_number11'] as $pay11)
                {
                    $payment_amt1[] =$pay11;    
                }
                foreach($_POST['payment_number111'] as $pay111)
                {
                    $payment_date11[] =$pay111;    
                }
                foreach($_POST['payment_number1111'] as $pay1111)
                {
                    $payment_name111[] =$pay1111;    
                }
                $n=0;
                foreach($_POST['payment_type'] as $pay_type)   
                {
                    if($payment_amt1[$n]!=0)
                    {
                        $item[$n]['type']=$pay_type;
                        $item[$n]['no']=$payment_no1[$n];
                        $item[$n]['amt']=$payment_amt1[$n];
                        $item[$n]['date']=$payment_date11[$n];
                        $item[$n]['name']=$payment_name111[$n];
                    }
                    $n++;
                }
            }
            $sal_log = array(
                'sales_id' => $sale_id,
                'deposit' => $_POST['receive_amt'],
                'detail' => serialize($item),
                'user' => $this->session->userdata('auth')->role,
                'date_time' => date("Y-m-d H:i:s")
            );
            //print_r($sal_log);exit;
            $result_insrt = $this->SaleModel->sales_log_insert($sal_log);

            if($result_insrt == 1)
            {
                $this->session->set_flashdata('success','Successfully paid');
            }
            else
            {
                $this->session->set_flashdata('error','Payment issue');
            }
            if($this->session->userdata('pending'))
            {
                $this->session->unset_userdata('pending');
                redirect('PendingList');
            }
            elseif($this->session->userdata('party_pending'))
            {
                $this->session->unset_userdata('party_pending');
                redirect('PartyPendingList');
            }
            else
            {
                redirect('AllSales');
            }
        }
        else
        {
            $this->load->view('layout/header',$data);
            $this->load->view('SaleModule/receive');
            $this->load->view('layout/footer');
        }
    }

    public function View_saleLog()
    {
        $result = $this->SaleModel->sale_log();
        echo json_encode($result);
    }

    public function receipt_page()
    {
        $sale_id = $this->uri->segment(2);

        $data['title'] = 'Sale';
        $data['head_name'] = 'Receipt';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        $data['sale_log_row'] = $this->SaleModel->sale_log_rows($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $this->load->view('layout/header',$data);
        $this->load->view('SaleModule/receipt_page');
        $this->load->view('layout/footer');
    }

    public function receipt_print()
    {
        $id = $this->uri->segment(2);
        $data['sale_log_row'] = $this->SaleModel->one_sale_log($id);
        $sale_id = $data['sale_log_row']->sales_id;

        $data['title'] = 'Sale';
        $data['head_name'] = 'Receipt';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);


        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $this->load->view('SaleModule/receipt_print',$data);
    }

    public function return_product()
    {
        $sale_id = $this->uri->segment(2);

        $data['title'] = 'Sale';
        $data['head_name'] = 'Return Product';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);


        $this->form_validation->set_rules('inv_date', 'Invoice DAte','required');

        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        if($this->form_validation->run() == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('SaleModule/return_product');
            $this->load->view('layout/footer');
        }
        else
        {

            //print_r($this->input->post());echo nl2br("\n");
            $inv_date = $this->input->post('inv_date');
            $items12 = $this->input->post('inser_chkbox');
            $qtyy = $this->input->post('qty');

            $amount_grand=0;    
            $items = unserialize($data['sale_row']->item_detail);
            foreach($items as $key => $val)
            {                                
                foreach($items12 as $key11 => $val11)
                {
                    if($val11 == $val[0]) 
                    {
                        if(($val[1] >= $qtyy[$key11]) and (0< $qtyy[$key11]))
                        {
                            $this->db->where('id', $val11[0]);
                            $query = $this->db->get('product_desc');

                            $fetch1 = $query->row();

                            $this->db->where('product_id', $fetch1->product_id);
                            $query2 = $this->db->get('product');

                            $fetch11 = $query2->row();

                            $product_weight = $val11;             
                            $qty = $qtyy[$key11];            
                            $sel_price = $val[2];            
                            $free = $val[3];            
                            $disc_amt1 = substr($val[4],0,-1);            
                            $disc_amt = $val[4];            
                            $disc=($val[2]*($disc_amt1/100));             
                            $amount = ($val[2]-$disc)*$qtyy[$key11];
                            $hsn = $fetch11->hsn;
                            $gsti = $fetch11->i_gst;

                            if($data['company_row']->company_state == $data['party_row']->state_id)
                            { 
                                $c_gst=$fetch11->c_gst;
                                $s_gst=$fetch11->s_gst;
                                $cgst= ($amount*$c_gst)/100 ;
                                $sgst= ($amount*$s_gst)/100 ;

                                $all_bar=array($product_weight,$qty,$sel_price,$free,$disc_amt,$hsn,$amount,$cgst,$sgst,$gsti);
                                $allproduct[]=$all_bar;
                                $amount_grand +=($amount+$cgst+$sgst);
                                //                                unset($all_bar);
                            }
                            else
                            { 
                                $i_gst[]=$fetch11->i_gst;
                                $igst[]= ($amount*$i_gst)/100 ;

                                $all_bar=array($product_weight,$qty,$sel_price,$free,$disc_amt,$hsn,$amount,$igst,$gsti);
                                $allproduct[]=$all_bar;
                                $amount_grand +=($amount+$igst);
                                //                                unset($all_bar);
                            } 
                        }
                    }
                }
            }

            //print_r($allproduct);echo nl2br("\n"); echo $amount_grand;
            if(isset($allproduct))
            {
                $return=serialize($allproduct);

                $return_array =array(
                    "return_item" => $return,
                    "return_date" => $inv_date,
                    "return_amt" => $amount_grand
                );

                $result = $this->SaleModel->update_sale($return_array, $sale_id);

                if($result > 0)
                {
                    $this->session->set_flashdata('success','Product Return Successfully.!!!');
                    foreach($allproduct as $k => $v)
                    {
                        $this->db->where('id', $v[0]);
                        $query1 = $this->db->get('product_desc');
                        $na = $query1->row();
                        $stock = $na->stock; 
                        $lesss = $stock + $v[1];

                        $product_desc =array('stock'=>$lesss);

                        $this->db->where('id', $v[0]);
                        $this->db->update('product_desc', $product_desc);
                    }
                }
                else{
                    $this->session->set_flashdata('success','Something Wrong.!!!');
                }
                redirect('AllSales');
            }
        }
    }

    public function cancle_sale()
    {
        //CancelSale
        $sale_id = $this->uri->segment(2);

        $data['title'] = 'Sale';
        $data['head_name'] = 'Cancel Order';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);

        //$data['sale_log_row'] = $this->SaleModel->sale_log_rows($sale_id);

        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        if($this->input->post('submit') == 'yes')
        {
            $all_bar=unserialize($data['sale_row']->item_detail); 

            $tot = $data['sale_row']->receive_amt+$data['sale_row']->credit_amt; 

            foreach($all_bar as $k => $v)
            {
                $this->db->where('id', $v[0]);
                $query = $this->db->get('product_desc');
                $na = $query->row();

                $add = $na->stock+$v[1]+$v[3]; 

                $product_desc =array('stock'=>$add);

                //$this->db->where('id', $v[0]);
                //$this->db->update('product_desc', $product_desc);

            }

            echo $add_party = $tot + $data['party_row']->credit_type;
            $part_array =array('credit_type'=>$add_party);
            //$this->PartyModel->update_party($part_array, $party_id)

            $sal_array =array('total_amt'=>0, 'cancel_status'=> 1);

            $result = $this->SaleModel->update_sale($sal_array, $sale_id);

            $this->session->set_flashdata('success', 'order canceled');

            redirect('AllSales');

        }
        else
        {
            $this->load->view('layout/header',$data);
            $this->load->view('SaleModule/cancel_sale');
            $this->load->view('layout/footer');
        }

    }

    public function all_print_page()
    {
        $from_id = $this->input->post('from_id');
        $to_id = $this->input->post('to_id');

        $where = "cancel_status!='1' and date between '".$from_id."' and '".$to_id."'";
        $this->db->where($where);
        $query = $this->db->get('sales');

        $ids = array();
        $rows = $query->result();
        foreach($rows as $id)
        {
            $ids[]=$id->id;
        }

        if(count($ids) > 0)
        {
            $this->session->set_userdata('sale_id', $ids);
            redirect('SaleController/all_page/0');
        }
        else{
            $this->session->set_flashdata('error','Sale entry not availabel between selected date.!!!');
            redirect('AllSales');
        }
    }

    public function all_page()
    {
        $count = $this->uri->segment(3);
        $sess_arr = $this->session->userdata('sale_id');
        $data['company_row'] = $this->Company_model->get_company();

        $data['all_count'] = count($sess_arr);

        $sale_id = $sess_arr[$count];

        $data['sale_row'] = $this->SaleModel->get_sale($sale_id);
        $party_id = $data['sale_row']->party_id;

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $data['count'] = $count;

        if($count != $sess_arr)
        {
            $this->load->view('SaleModule/all_print_sale_party',$data);
        }
        else
        {
            redirect('AllSales');
        }
    }

    public function sale_summary()
    {
        $data['title'] = 'Sale';
        $data['head_name'] = 'Sale';

        $data['company_row'] = $this->Company_model->get_company();


        if($this->input->post())
        {
            $frm_dt = date("d-m-Y", strtotime($this->input->post('from_date')));
            $to_dt = date("d-m-Y", strtotime($this->input->post('to_date')));
        }
        else
        {
            $frm_dt = date("01-m-Y"); 
            //$frm_dt = date("01-12-2020"); 
            $to_dt = date("d-m-Y");
        }

        $data['from_date'] = $frm_dt;
        $data['to_date'] = $to_dt;
        $data['sale_summary'] = $this->SaleModel->sale_summary($frm_dt,$to_dt);
        //exit;
        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SaleModule/sale_summeray');
        $this->load->view('layout/footer');
    }

    public function transaction()
    {
        $data['title'] = 'Sale';
        $data['head_name'] = 'Sale';

        $data['company_row'] = $this->Company_model->get_company();


        if($this->input->post())
        {
            $frm_dt = date("d-m-Y", strtotime($this->input->post('from_date')));
            $to_dt = date("d-m-Y", strtotime($this->input->post('to_date')));
            $party_id = $this->input->post('id_party');

            redirect('SaleController/transaction_list/'.$frm_dt.'/'.$to_dt.'/'.$party_id);
        }
        else
        {
            $frm_dt = date("01-m-Y"); 
            //$frm_dt = date("01-12-2020"); 
            $to_dt = date("d-m-Y");
        }

        $data['from_date'] = $frm_dt;
        $data['to_date'] = $to_dt;
        //$data['sale_summary'] = $this->SaleModel->sale_summary($frm_dt,$to_dt);
        //exit;
        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SaleModule/transaction');
        $this->load->view('layout/footer');
    }

    public function transaction_list()
    {
        $frm_dt = $this->uri->segment(3);
        $to_dt = $this->uri->segment(4);
        $party_id = $this->uri->segment(5);

        $data['title'] = 'Sale';
        $data['head_name'] = 'Sale';

        $data['company_row'] = $this->Company_model->get_company();

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $date_array = array();
        $date_array1 = array();
        $datefrom = date("Y-m-d",strtotime($frm_dt));
        $dateto = date("Y-m-d",strtotime($to_dt));
        while (strtotime($datefrom) <= strtotime($dateto)) 
        {
            $date_array[]=$datefrom;
            $datefrom = date ("Y-m-d", strtotime("+1 day", strtotime($datefrom)));
        }
        $datefrom1= $data['party_row']->opening_date; 
        if($datefrom1 == '0000-00-00')
        {
            $this->db->order_by("id", "asc");
            $this->db->limit(1);
            $query1 = $this->db->get('sales');
            //print_r($query1->row()->date);
            $datefrom1 = $query1->row()->date;
            //$date_array1[]=date ("Y-m-d", strtotime("-1 day", strtotime($frm_dt)));
        }

        while (strtotime($datefrom1) < strtotime($frm_dt)) 
        {
            $date_array1[]=$datefrom1;
            $datefrom1 = date ("Y-m-d", strtotime("+1 day", strtotime($datefrom1)));
        }



        $total_sale=0;$rec_total=0;$final_opening_bal=0;

        foreach($date_array1 as $dat)
        {
            $this->db->where('party_id', $party_id);
            $this->db->where('date', $dat);
            $query2 = $this->db->get('sales');
            //print_r($query2->result());
            foreach($query2->result() as  $sale)
            {
                if($sale->cod_percent>0)
                {
                    $total_sale +=$sale->cod_amt; 
                }
                else
                {
                    $total_sale +=$sale->total_amt; 
                }
            }

            $this->db->where('party_id', $party_id);
            $this->db->where('DATE(date_time)', $dat);
            $query3 = $this->db->get('sales_log');
            //print_r($query3->result());
            foreach($query3->result() as  $sale_log)
            {
                $rec_total +=$sale_logdeposit;
            }
        }

        //echo $total_sale.' = '.$rec_total;

        $final_opening_bal = $total_sale - $rec_total;

        $data['frm_dt'] = $frm_dt;
        $data['to_dt'] = $to_dt;
        $data['date_array'] = $date_array;
        $data['datefrom1'] = $datefrom1;
        $data['final_opening_bal'] = $final_opening_bal;
        $data['party_id'] = $party_id;

        $this->load->view('SaleModule/transaction_list',$data);

    }

    public function sale_executive()
    {
        $data['title'] = 'Sale';
        $data['head_name'] = 'Sale Executive';

        $data['company_row'] = $this->Company_model->get_company();

        $data['tem_data'] = $this->SaleModel->fetch_temp_sale();

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SaleModule/sale_executive');
        $this->load->view('layout/footer');
    }

    public function edit_temp_sale()
    {
        $sale_id = $this->uri->segment(2);

        $data['title'] = 'Sale';
        $data['head_name'] = 'Edit Sale';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sale_row'] = $this->SaleModel->get_temp_sale($sale_id);
        //sprint_r($data['sale_row']); exit;
        $id_party = $data['sale_row']->party_id;

        if(!$this->session->userdata('all_bar'))
        {
            $all_bar1 = unserialize($data['sale_row']->item_detail);

            $this->session->set_userdata('all_bar', $all_bar1);
        }

        $this->session->set_userdata('temp_sale', $sale_id);

        $this->db->where('id', $id_party);
        $query = $this->db->get('manage_party');
        $this->session->set_userdata('party_session',$query->row());

        //echo $this->session->userdata('party_session');

        $data['fetchparty'] = $this->SaleModel->single_arty($id_party);


        $this->load->view('layout/header',$data);
        $this->load->view('SaleModule/edit_temp_sale');
        $this->load->view('layout/footer');

    }

    public function collection_format()
    {
        $data['title'] = 'Sale';
        $data['head_name'] = 'View Sale';

        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frm_dt = date("d-m-Y", strtotime($this->input->post('from_date')));
            $to_dt = date("d-m-Y", strtotime($this->input->post('to_date')));
        }
        else
        {
            $frm_dt = date("01-m-Y"); 
            $to_dt = date("d-m-Y");
        }

        $data['from_dt'] = $frm_dt;
        $data['to_dt'] = $to_dt;
        $date1 = date("Y-m-d", strtotime($frm_dt));
        $date2 = date("Y-m-d", strtotime($to_dt));
        $party_id = '';

        $data['pendiing_sales'] = $this->SaleModel->fetch_allsale($date1, $date2, $party_id);


        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SaleModule/collection_format');
        $this->load->view('layout/footer');
    }

    public function SaveToSale()
    {
        $temp_sale = $this->session->userdata('temp_sale');

        $fetchcom = $this->Company_model->get_company();

        $id_party = $this->session->userdata('party_session')->id;

        $fetchparty = $this->SaleModel->single_arty($id_party);

        $tmp_sal = $this->SaleModel->get_temp_sale($temp_sale);

        $cod_percent = $tmp_sal->cod_percent; 
        $receive_amt = $tmp_sal->receive_amt; 
        $credit_amt = $tmp_sal->credit_amt; 
        $return_item = $tmp_sal->return_item; 
        $return_date = $tmp_sal->return_date; 
        $return_amt = $tmp_sal->return_amt; 

        if($tmp_sal->user != '')
        {

            $user = $tmp_sal->user; 
        }
        else
        {
            $user = $this->session->userdata('auth')->role;
        }
        $pay_type = $tmp_sal->pay_type; 
        $sale_exe = $tmp_sal->sale_exe; 


        $all_itmes = array();
        foreach($this->session->userdata('all_bar') as $items)
        {
            foreach($this->input->post('qty_inp') as $key => $it_qty)
            {
                if($key == $items[0]){

                    $name = $items[0];
                    $qty = $it_qty;
                    $sale_price =$items[2];
                    $free = $items[3];
                    $disc_amt1 = str_replace('%','',$items[4]);
                    $disc_amt = $disc_amt1."%"; 
                    $disc = ($sale_price*($disc_amt1/100)); 
                    $amount = ($sale_price-$disc)*$qty ; 
                    $hsn = $items[5]; 

                    $all_bar = array();
                    if($fetchcom->company_state == $fetchparty->state_id)
                    {
                        $i_gst = $items[9];
                        $c_gst = $items[9]/2;
                        $s_gst = $items[9]/2;
                        $cgst= ($amount*$c_gst)/100 ;
                        $sgst= ($amount*$s_gst)/100 ;
                        $all_bar=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$cgst,$sgst,$i_gst);
                    }
                    else
                    {
                        $i_gst[] = $items[8];
                        $igst[] = ($amount*$i_gst)/100 ;
                        $all_bar=array($name,$qty,$sale_price,$free,$disc_amt,$hsn,$amount,$igst,$i_gst);
                    }

                    $all_itmes[] = $all_bar;
                    unset($all_bar);
                }
            }
        }

        //print_r($all_itmes); echo nl2br("\n");

        $tax_amt=0;
        $gst_c=0;
        $gst_s=0;
        $gst_i=0;
        foreach($all_itmes as $k => $v)
        {
            $hsn11[]=$v[5];
            $tax_rat[]=$v[6];
            $tax_amt += $v[6];
            if($fetchcom->company_state == $fetchparty->state_id)
            {
                $gst_c +=$v[7];
                $gst_s +=$v[8];
                $per_i[] =$v[9];  
            }
            else
            {
                $gst_i +=$v[7];
                $per_i[]=$v[8];
            }
        }

        $array3  = $this->CommenModel->array_combine_($hsn11,$tax_rat,$per_i);  
        $n2=1; 
        foreach($array3 as $key2=>$val2)
        { 
            $count=count($val2);
            $sum = 0;
            for($ij=0; $ij<$count; $ij=$ij+2)
            {
                $sum += $val2[$ij];
                $amt[]=$val2[$ij];
                $gst[]=$val2[$ij+1];
            }

            $common  = $this->CommenModel->array_combine_1($gst,$amt);
            foreach($common as $ky => $vl)
            {
                $sum = 0;
                if(is_array($vl)){
                    $sum= array_sum($vl); 
                } else {
                    $sum= $vl; 
                }
                $item1[$n2]['hsn'] = $key2;
                $item1[$n2]['tax'] = $sum;
                $item1[$n2]['gst'] = $ky;
                $n2++; 
            }
            unset($amt);
            unset($gst);
        }

        $total_amt=$tax_amt+$gst_c+$gst_s+$gst_i; 
        $cod_perc=(Int)$cod_percent;  
        $percent = $total_amt*($cod_perc/100);
        $cod_perc = 0;

        $cod_amt=0;
        if($cod_perc > 0)
        {
            $cod_amt = $total_amt-$percent; 
        }
        else
        {
            $cod_amt = $cod_perc; 
        }

        $h_disc=$this->input->post('h_disc'); 
        $h_disc = 0;
        $h_percent = $total_amt*($h_disc/100);
        if($h_disc > 0)
        {
            $h_disc_amt = $total_amt-$h_percent; 
        }
        else
        {
            $h_disc_amt = $h_disc; 
        }

        $item_detail = serialize($all_itmes);
        $tax_detail = serialize($item1);
        $credit_amt =0;
        if($this->input->post('tot_val')){
            $credit_amt = $this->input->post('tot_val');
        }

        if($total_amt !=0 && ($item_detail !='' || $item_detail != 'N;'))
        {

            $sal_array = array(
                "party_id" => $id_party,
                "date" => date("Y-m-d"),
                "taxable_amt" => round($tax_amt,2),
                "c_gst" => round($gst_c,2),
                "s_gst" => round($gst_s,2),
                "i_gst" => round($gst_i,2),
                "total_amt" => round($total_amt),
                "cod_percent" => $cod_perc,
                "cod_amt" => round($cod_amt),
                "receive_amt" => $receive_amt,
                "credit_amt" => $credit_amt,
                "item_detail" => $item_detail,
                "tax_detail" => $tax_detail,
                "return_item" => $return_item,
                "return_date" => $return_date,
                "return_amt" => $return_amt,
                "user" => $user,
                "date_time" => date("Y-m-d h:i:s"),
                "pay_type" => $pay_type,
                "sale_exe" => $sale_exe,
                "temp_sale" => $temp_sale
            );

            //echo $temp_sale; 

            //print_r($sal_array); 

            //echo $name.' = '.$qty;
            
            $result = $this->SaleModel->insert_sale_temp($sal_array, $all_itmes);

            if($result > 0)
            {
                $this->unset_session();
                $this->db->where('id', $temp_sale);
                $arr = array('status' => 1);
                $query = $this->db->update('temp_sales',$arr);
                $this->session->set_flashdata('success', 'Convet to Sale Successfully ');
            }
            else
            {
                $this->unset_session();
            }
            redirect('SaleExecutive');
        }
    }


}
?>