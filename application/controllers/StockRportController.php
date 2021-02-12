<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockRportController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('CommenModel');
        $this->load->model('StockReportModel');
        $this->load->model('Productmodel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function product_report()
    {
        $data['title'] = 'Stock Report';
        $data['head_name'] = 'Stock Report';

        $data['company_row'] = $this->company->get_company();

        $data['brand_row'] = $this->Productmodel->getBrand();

        $data['brand_id'] = '';

        if($this->input->post())
        {
            if($this->input->post('brand_name')['0'] == 'all')
            {
                foreach($data['brand_row'] as $bran)
                {
                    $id[]= $bran->id; 
                }
            }
            else
            {
                $id =$this->input->post('brand_name');
            }

            //print_r($id);
            $data['brand_id'] = $id;
        }

        $this->load->view('layout/header',$data);
        $this->load->view('StockReport/product_report');
        $this->load->view('layout/footer');
    }

    public function product_stock()
    {
        $data['title'] = 'Stock Report';
        $data['head_name'] = 'Stock Report';
        //
        $data['company_row'] = $this->company->get_company();

        $data['product_stock'] = '';
        if($this->input->post())
        {
            $data['product_stock'] = $this->StockReportModel->product_stock();
        }
        $this->load->view('layout/header',$data);
        $this->load->view('StockReport/stock');
        $this->load->view('layout/footer');

    }

    public function view_sales_product()
    {
        $data['title'] = 'Stock Report';
        $data['head_name'] = 'Stock Report';
        //
        $data['company_row'] = $this->company->get_company();

        $data['sale_rows'] = '';
        if($this->input->post())
        {
            //print_r($this->input->post());
            $product_id = $this->input->post('product_id');
            $frm_date = $this->input->post('frm_date');
            $to_date = $this->input->post('to_date');
            $party_id = $this->input->post('party_id');

            $data['sale_rows'] = $this->StockReportModel->get_data($frm_date,$to_date,$party_id);
            //print_r($data['sale_rows']);
            
            $data['frm_date'] = $frm_date;
            $data['to_date'] = $to_date;
            $data['product_id'] = $product_id;
        }
        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('StockReport/view_sales_product');
        $this->load->view('layout/footer');
    }

    function getproduct()
    {
        $data_get = $this->input->post();
        $data = $this->StockReportModel->getbarcode($data_get);
        echo json_encode($data);
    }
}