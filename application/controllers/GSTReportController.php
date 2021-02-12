<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GSTReportController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model');
        $this->load->model('CommenModel');
        $this->load->model('GSTReportModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function purchase_register()
    {

        $data['title'] = 'GST Report';
        $data['head_name']= 'GST Report';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
            $data['frmdate'] = $frmdate;
            $data['todate'] = $todate;
            
            $data['purchase_order'] = $this->GSTReportModel->get_purchase($frmdate, $todate);
            $data['voucher'] = $this->GSTReportModel->get_voucher($frmdate, $todate);
            //print_r($data['purchase_order']);
        }
        /*else
        {
            $frmdate = date("Y-m-01"); 
            $todate = date("Y-m-d");
        }*/

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('GstReport/purchase_register');
        $this->load->view('layout/footer');
    }

    public function sales_register()
    {
        $data['title'] = 'GST Report';
        $data['head_name']= 'GST Report';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
            $data['frmdate'] = $frmdate;
            $data['todate'] = $todate;
            
            $data['sales'] = $this->GSTReportModel->get_sales($frmdate, $todate);
            //print_r($data['purchase_order']);
        }
        /*else
        {
            $frmdate = date("Y-m-01"); 
            $todate = date("Y-m-d");
        }*/

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('GstReport/sales_register');
        $this->load->view('layout/footer');
    }

    public function summary_b2b()
    {
        $data['title'] = 'GST Report';
        $data['head_name']= 'GST Report';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
            $data['frmdate'] = $frmdate;
            $data['todate'] = $todate;
            
            $data['sales'] = $this->GSTReportModel->get_sales($frmdate, $todate);
        }

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('GstReport/summary_b2b');
        $this->load->view('layout/footer');
    }
    
    public function summary_b2cs()
    {
        $data['title'] = 'GST Report';
        $data['head_name']= 'GST Report';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
            $data['frmdate'] = $frmdate;
            $data['todate'] = $todate;
            
            $data['sales'] = $this->GSTReportModel->get_sales($frmdate, $todate);
        }

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('GstReport/summary_b2cs');
        $this->load->view('layout/footer');
    }
}