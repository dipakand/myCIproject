<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentSummeryController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('PaymentSummeryModel');
        $this->load->model('CommenModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }
    
    public function payment_summery()
    {
        $data['title'] = 'Payment Summery';
        $data['head_name'] = 'Payment Summery';

        $data['company_row'] = $this->company->get_company();
        
        if($this->input->post())
        {
            $frmdate = $this->input->post('frm_dt');
            $todate = $this->input->post('to_dt');
        }
        else
        {
            $frmdate = date("d-m-Y");
            $todate = date("d-m-Y");
        }
        
        $data['frmdate'] = $frmdate;
        $data['todate'] = $todate;
        
        $data['sales_log_rows'] = $this->PaymentSummeryModel->fetch_sales_log($frmdate,$todate);
        

        $this->load->view('layout/header', $data);
        $this->load->view('layout/datatable');
        $this->load->view('PaymentSummery/payment');
        $this->load->view('layout/footer');
    }
}
?>