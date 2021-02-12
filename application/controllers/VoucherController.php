<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoucherController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('CommenModel');
        $this->load->model('VoucherModel');

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation'));
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    function unse_session()
    {
        $this->session->unset_userdata('vendor_row');
        redirect('GeneratVoucher');
    }

    public function generat_voucher()
    {
        $data['title'] = 'Voucher';
        $data['head_name'] = 'Voucher';

        $data['company_row'] = $this->company->get_company();
        $data['state_row'] = $this->company->fetch_state();

        if($this->input->post('autosearch'))
        {
            if($this->input->post('id_vendor') != '' & $this->input->post('id_vendor') != 0)
            {
                $vendor = $this->VoucherModel->fetch_vendor($this->input->post('id_vendor'));

                $this->session->set_userdata('vendor_row',$vendor);
            }
            else
            {
                $this->session->set_flashdata('error','Party Not Exist.!!!');
            }
        }

        $this->load->view('layout/header',$data);
        $this->load->view('Voucher/generate_voucher'); 
        $this->load->view('layout/footer');
    }

    function getVenodr()
    {
        $vendor_id = $this->input->get();

        $data = $this->VoucherModel->get_vendor($vendor_id);

        echo json_encode($data);
    }

    function save_vendor()
    {
        if(!$this->input->is_ajax_request())
        {
            $data = array('response' => 'error', 'message' => 'No direct script access allowed');
        }
        else
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('contact', 'Contact', 'required|is_unique[vendor_party.contact_no]');
            $this->form_validation->set_rules('gstin', 'GSTIN', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $data = array('response' => 'error', 'message' => array('name' => form_error('name'),'contact' => form_error('contact'),'gstin' => form_error('gstin'),'state' => form_error('state')));
            }
            else
            {
                $save_data = $this->input->post();

                $result = $this->VoucherModel->save_vendor($save_data);

                if($result > 0)
                {
                    $data = array('response' => 'success', 'message' => $result);
                }
                else
                {
                    $data = array('response' => 'success', 'message' => 'something wrong...');
                }
            }
        }

        echo json_encode($data);
    }

    function voucher_page()
    {
        $id = $this->uri->segment(3);

        $data = $this->VoucherModel->fetch_vendor($id);

        $this->session->set_userdata('vendor_row',$data);

        redirect('GeneratVoucher');
    }

    function save_voucher()
    {
        $date = $this->input->post('date_to');
        $product = $this->input->post('product');
        $rate = $this->input->post('rate');
        $qty = $this->input->post('qty');
        $hsn = $this->input->post('hsn');
        $gst = $this->input->post('gst');
        $total_amt = $this->input->post('total_amt');
        $bill_no = $this->input->post('bill_no');
        $n=0;
        $total=0;

        foreach($product as $val){
            $item1[$n]['product']=$val;
            $item1[$n]['rate']=$rate[$n];
            $item1[$n]['qty']=$qty[$n];
            $item1[$n]['hsn']=$hsn[$n];
            $item1[$n]['gst']=$gst[$n];
            $item1[$n]['total_amt']=$total_amt[$n];


            $total =($rate[$n]*$qty[$n]);
            $final_tot= ($total*$gst[$n])/100;

            $n++;
        }

        $tot_data = 0;
        foreach($item1 as $val22){
            $tot_data +=$val22['total_amt'];
        }

        $arry = array(
            "items" => serialize($item1),
            "vendor_name" => $this->session->userdata('vendor_row')->name,
            "party_id" => $this->session->userdata('vendor_row')->id,
            "cont_no" => $this->session->userdata('vendor_row')->contact_no,
            "state_id" => $this->session->userdata('vendor_row')->state_id,
            "gst_in" => $this->session->userdata('vendor_row')->gst_in,
            "bill_no" => $bill_no,
            "total" => $tot_data,
            "date" => $date,
            "date_time" => date("Y-m-d H:i:s")
        );

        $result = $this->VoucherModel->save_voucher($arry);

        if($result > 0)
        {
            $this->session->set_flashdata('success', 'Voucher Generated Successfully...');
        }
        else
        {
            $this->session->set_flashdata('success', 'Voucher Not Generated...');
        }

        $this->session->unset_userdata('vendor_row');
        redirect('GeneratVoucher');
    }

    function view_voucher()
    {
        $data['title'] = 'Voucher';
        $data['head_name'] = 'Voucher';

        $data['company_row'] = $this->company->get_company();

        $data['frmdate'] = date("01-m-Y");
        $data['todate'] = date("d-m-Y");

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('Voucher/view_voucher'); 
        $this->load->view('layout/footer');
    }

    function fetch_vouchers()
    {
        if(!$this->input->is_ajax_request())
        {
            $data = array('response' => 'error','message' => 'no data');
        }
        else
        {
            $frm_dt = date("Y-m-d",strtotime($this->input->post('frm_dt')));
            $to_dt = date("Y-m-d",strtotime($this->input->post('to_dt')));

            $voucher_row = $this->VoucherModel->fetch_voucher($frm_dt, $to_dt);

            $data = array('response' => 'success','message' => $voucher_row);

        }
        echo json_encode($data);
    }

    function fevhe_details()
    {
        if(!$this->input->is_ajax_request())
        {
            $data = array('response' => 'error','message' => 'no data');
        }
        else
        {
            $v_id = $this->input->post('id');

            $details_row = $this->VoucherModel->voucher_details($v_id);

            $data = array('response' => 'success','message' => $details_row);
        }
        echo json_encode($data);
    }

    function print_receipt()
    {
        $id = $this->uri->segment(3);
        $data['company_row'] = $this->company->get_company();

        $data['voucher_row'] = $this->VoucherModel->single_voucher($id);

        $this->load->view('Voucher/print_receipt',$data);
    }

    function delete_voucher()
    {
        if(!$this->input->is_ajax_request())
        {
            $data = array('response' => 'error','message' => 'no data');
        }
        else
        {
            $v_id = $this->input->post('voucherId');
            $result = $this->VoucherModel->voucher_delete($v_id);
            if($result == true)
            {
                $data = array('response' => 'success','message' => 'Voucher Deleted Successfully');
            }
            else
            {
                $data = array('response' => 'error','message' => 'Voucher Not Delete');
            }
        }
        echo json_encode($data);
    }

    function fetch_details()
    {
        if(!$this->input->is_ajax_request())
        {
            $data = array('response' => 'error','message' => 'no data');
        }
        else
        {
            $v_id = $this->input->post('id');

            $details_row = $this->VoucherModel->single_voucher($v_id);

            $data = array('response' => 'success','message' => $details_row);
        }
        echo json_encode($data);
    }

    function payments()
    {
        if(!$this->input->is_ajax_request())
        {
            $data = array('response' => 'error','message' => 'no data');
        }
        else
        {
            $params = array();
            $form_inputs = $this->input->post('form_inputs');

            parse_str($form_inputs, $params);

            if($params['pending'] >= $params['receive_amt'])
            {
                foreach($params['payment_number11'] as $ke1 => $va1)
                { 
                    $values[]=$va1;
                }
                $values ;
                $count_amt=count($values);
                $count_type=count($params['payment_type']);
                if($count_amt == $count_type)
                {
                    $tottal =$params['payment_number11'][0]+$params['payment_number11'][1]+$params['payment_number11'][2]+$params['payment_number11'][3]+$params['payment_number11'][4];
                    if($tottal == $params['receive_amt'])
                    { 
                        foreach($params['payment_number1'] as $pay1)
                        {
                            $payment_no1[] =$pay1;    
                        }
                        foreach($params['payment_number11'] as $pay11)
                        {
                            $payment_amt1[] =$pay11;    
                        }
                        foreach($params['payment_number111'] as $pay111)
                        {
                            $payment_date11[] =$pay111;    
                        }
                        foreach($params['payment_number1111'] as $pay1111)
                        {
                            $payment_name111[] =$pay1111;    
                        }
                        $n=0;
                        foreach($params['payment_type'] as $kk => $pay_type)   
                        {
                            if($payment_amt1[$n]!='' && $payment_amt1[$n]!=0){
                                $item[$n]['type']=$pay_type;
                                $item[$n]['no']=$payment_no1[$n];
                                $item[$n]['amt']=$payment_amt1[$n];
                                $item[$n]['date']=$payment_date11[$n];
                                $item[$n]['name']=$payment_name111[$n];
                            }
                            $n++;
                        }

                        $updat_arr = array(
                            "payment_detail" =>serialize($item),
                            "received" =>$params['receive_amt']
                        );

                        $result = $this->VoucherModel->payment_receive($updat_arr,$params['id']);

                        if($result == true)
                        {
                            $data = array('response' => 'success','message' => 'Payment Recieve');
                        }
                        else
                        {
                            $data = array('response' => 'error','message' => 'payment Not Receive');
                        }
                        //$update_vendor = "UPDATE voucher SET payment_detail='".serialize($item)."',received='".$params['receive_amt']."' where id='".$params['id']."' ";
                    }
                }
            }
            //$data = array('response' => 'success','message' => $params);
        }
        echo json_encode($data);
    }
}
?>