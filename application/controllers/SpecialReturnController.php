<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SpecialReturnController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('CommenModel');
        $this->load->model('SpecialReturnModel');
        $this->load->model('Productmodel');
        $this->load->model('SaleModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    function cancel()
    {
        $this->session->unset_userdata('party_row');
        $this->session->unset_userdata('case');
        $this->session->unset_userdata('inv_date');
        $this->session->unset_userdata('all_item');
        $this->session->unset_userdata('all_item1');
    }

    public function special_return()
    {
        $data['title'] = 'Special Retrun';
        $data['head_name'] = 'Special Retrun';

        $data['company_row'] = $this->company->get_company();

        if($this->input->post('search') == 'party')
        {
            $party_id = $this->input->post('party_id');

            $party_row = $this->SaleModel->single_arty($party_id);

            $this->session->set_userdata('party_row' , $party_row);
        }

        if($this->session->userdata('party_row'))
        {
            $data['head_name'] = 'Special Retrun From -- '.ucwords($this->session->userdata('party_row')->name);
        }

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('SpecialReturn/special_return');
        $this->load->view('layout/footer');
    }

    function make_array()
    {
        //if($this->input->post('submit') == 'add_item')
        //{
        //print_r($this->input->post());
        //[case] => case_1 [inv_date] => 15-01-2021 [barcode] => 5c4aa69925c7e [qty] => 1 [rate] 
        $case = $this->input->post('case');
        $inv_date = $this->input->post('inv_date');
        $barcode = $this->input->post('barcode');
        $qty = $this->input->post('qty');

        $this->session->set_userdata('case' , $case);
        $this->session->set_userdata('inv_date' , $inv_date);

        if($this->input->post('case') == 'case_1')
        {
            $this->db->where('barcode',$this->input->post('barcode'));
            $query1 = $this->db->get('product_desc');
            if($query1->num_rows() > 0)
            {
                $query1->row();

                //if($this->input->post('barcode') == $query1->row()->barcode)
                {
                    $product_id=$query1->row()->id;             
                    $qty=$this->input->post('qty');
                    $rate=$this->input->post('rate');

                    $array[] =array('id' => $product_id,'qty' => $qty,'rate' => $rate);

                    if($this->session->userdata('all_item'))
                    {
                        $old = $this->session->userdata('all_item');
                        $new_ar = array_merge($old,$array);
                        $this->session->set_userdata('all_item' , $new_ar);
                    }
                    else
                    {
                        $this->session->set_userdata('all_item' , $array);
                    }

                }
            }
            else
            {
                $this->session->set_flashdata('error','This barcode NOT exist.!!!');
            }

        }
        elseif($this->input->post('case') == 'case_2')
        {
            $data['company_row'] = $this->company->get_company();

            $this->db->where('barcode',$this->input->post('barcode'));
            $query1 = $this->db->get('product_desc');

            if($query1->num_rows() > 0)
            {
                $query1->row();

                $this->db->where('product_id',$query1->row()->product_id);
                $query2 = $this->db->get('product');
                $fetch2 = $query2->row();

                $product_id = $query1->row()->id;             
                $qty = $this->input->post('qty');
                $rate = $this->input->post('rate');

                $hsn = $fetch2->hsn;
                $amount = $rate * $qty;             
                $i_gst = $fetch2->i_gst;
                $c_gst = $fetch2->c_gst;
                $s_gst = $fetch2->s_gst;
                $all_item1 = array();
                if($data['company_row']->company_state == $this->session->userdata('party_row')->state_id)
                { 
                    $cgst= ($amount*$c_gst)/100 ;
                    $sgst= ($amount*$s_gst)/100 ;
                    $all_item1[]= array("id" => $product_id, "qty" => $qty, "rate" => $rate, "hsn" => $hsn, "amt" => $amount, "gstc" => $cgst, "gsts" => $sgst, "igst" => $i_gst);

                }
                else
                { 
                    $igst= ($amount*$i_gst)/100 ;
                    $all_item1[]= array("id" => $product_id, "qty" => $qty, "rate" => $rate, "hsn" => $hsn, "amt" => $amount, "gsti" => $igst, "igst" => $i_gst);
                }

                //                print_r($all_item1); exit;
                if($this->session->userdata('all_item1'))
                {
                    $old = $this->session->userdata('all_item1');
                    $new_ar = array_merge($old,$all_item1);
                    $this->session->set_userdata('all_item1' , $new_ar);
                }
                else
                {
                    $this->session->set_userdata('all_item1' , $all_item1);
                }

            }
            else
            {
                $this->session->set_flashdata('error','This barcode NOT exist.!!!');
            }
        }

        //}
        redirect('SpecialReturn');
    }

    function remove_item()
    {
        $key = $this->uri->segment(3);
        $old = $this->session->userdata('all_item');
        unset($old[$key]);
        $this->session->set_userdata('all_item' , $old);
        redirect('SpecialReturn');
    }

    function remove_item2()
    {
        $key = $this->uri->segment(3);
        $old = $this->session->userdata('all_item1');
        unset($old[$key]);
        $this->session->set_userdata('all_item1' , $old);
        redirect('SpecialReturn');
    }

    function cancle_deal()
    {
        $this->cancel();
        redirect('SpecialReturn');
    }

    function save_case1()
    {
        $credit_type=serialize($old = $this->session->userdata('all_item'));

        $inser_arr = array(
            "party_id" => $this->session->userdata('party_row')->id,
            "return_date" => $this->session->userdata('inv_date'),
            "case_type" => $this->session->userdata('case'),
            "expiry_type" => $credit_type,
            "credit_amt" => $this->input->post('total_val'),
            "user" => $this->session->userdata('auth')->role,
            "date_time" => date("Y-m-d H:i:s")
        );

        $result = $this->SpecialReturnModel->save_creditor($inser_arr);


        if($result > 0)
        {
            $credit_tot1 = $this->session->userdata('party_row')->credit_type + round($_POST['tatal_val']);

            $upda_arr = array(
                "credit_type" => $credit_tot1
            );

            $this->db->where('id', $this->session->userdata('party_row')->id);
            $this->db->update('manage_party', $upda_arr);
            foreach($_SESSION['all_item1'] as $kys => $vls)
            {  
                $this->db->where('id',$vls['id']);
                $query1 = $this->db->get('product_desc')->row();

                $stock= $query1->case_2 + $vls['qty']; 

                $arry = array('stock_2' => $stock);

                $this->db->where('id',$vls['id']);
                $this->db->update('product_desc', $arry);
            }

            $this->session->set_flashdata('success' , 'Item Return Successfully.!!!');
        }
        else
        {
            $this->session->set_flashdata('error' , 'Item Not Return.!!!');
        }
        $this->cancel();
        redirect('SpecialReturn');
    }

    function save_case2()
    {
        $credit_type=serialize($old = $this->session->userdata('all_item1'));

        $inser_arr = array(
            "party_id" => $this->session->userdata('party_row')->id,
            "return_date" => $this->session->userdata('inv_date'),
            "case_type" => $this->session->userdata('case'),
            "credit_type" => $credit_type,
            "credit_amt" => $this->input->post('tatal_val'),
            "user" => $this->session->userdata('auth')->role,
            "date_time" => date("Y-m-d H:i:s")
        );

        $result = $this->SpecialReturnModel->save_creditor($inser_arr);


        if($result > 0)
        {
            $credit_tot1 = $this->session->userdata('party_row')->credit_type + round($_POST['tatal_val']);

            $upda_arr = array(
                "credit_type" => $credit_tot1
            );

            $this->db->where('id', $this->session->userdata('party_row')->id);
            $this->db->update('manage_party', $upda_arr);
            foreach($_SESSION['all_item1'] as $kys => $vls)
            {  
                $this->db->where('id',$vls['id']);
                $query1 = $this->db->get('product_desc')->row();

                $stock= $query1->case_2 + $vls['qty']; 

                $arry = array('stock_2' => $stock);

                $this->db->where('id',$vls['id']);
                $this->db->update('product_desc', $arry);
            }

            $this->session->set_flashdata('success' , 'Item Return Successfully.!!!');
        }
        else
        {
            $this->session->set_flashdata('error' , 'Item Not Return.!!!');
        }
        $this->cancel();
        redirect('SpecialReturn');
    }
}
?>