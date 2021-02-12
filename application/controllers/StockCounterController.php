<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockCounterController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('CommenModel');
        $this->load->model('StockCounterModel');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function stock_counter()
    {
        $data['title'] = 'Stock Counter';
        $data['head_name'] = 'Stock Counter';

        $data['company_row'] = $this->company->get_company();

        $data['fetch_data'] = $this->StockCounterModel->fetch_data();

        $this->load->view('layout/header',$data);
        //        $this->load->view('layout/datatable');
        $this->load->view('StockCounter/stock_counter'); 
        $this->load->view('layout/footer');

    }

    function save_stock()
    {
        $count = $this->input->post('count');

        $result = $this->StockCounterModel->save_stock($count);

        if($result > 0)
        {
            $this->session->set_flashdata('success','Save successfully.!!!');
        }
        else
        {
            $this->session->set_flashdata('error','Not Save .!!!');
        }

        redirect('StockCounter');

    }

    public function all_stock_counter()
    {

    }
}
?>