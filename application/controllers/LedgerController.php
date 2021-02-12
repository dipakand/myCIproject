<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LedgerController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('CommenModel');
        $this->load->model('BroadcastModel');
        $this->load->model('PartyModel');
        $this->load->model('VendorModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function party_ledger()
    {
        $data['title'] = 'Legder'; 
        $data['head_name'] = 'Legder';

        $data['company_row'] = $this->company->get_company();

        if($this->input->post())
        {
            $party_id = $this->input->post('id_party');
            $fromdate = $this->input->post('fromdate');
            $todate = $this->input->post('todate');

            $data['party_row'] = $this->PartyModel->fetch_party($party_id);
            $data['fromdate'] = $fromdate;
            $data['todate'] = $todate;

            $date_array = array();
            $datefrom = date("Y-m-d",strtotime($fromdate));
            $dateto = date("Y-m-d",strtotime($todate));
            while (strtotime($datefrom) <= strtotime($dateto)) 
            {
                $date_array[]=$datefrom;
                $datefrom = date ("Y-m-d", strtotime("+1 day", strtotime($datefrom)));
            }


            $data['date_array'] = $date_array;
        }

        $this->load->view('layout/header',$data);
        $this->load->view('Ledger/party_ledger'); 
        $this->load->view('layout/footer');
    }

    public function vendor_ledger()
    {
        $data['title'] = 'Legder'; 
        $data['head_name'] = 'Legder';

        $data['company_row'] = $this->company->get_company();

        if($this->input->post())
        {
            $vendor_id = $this->input->post('id_vendor');
            $fromdate = $this->input->post('fromdate');
            $todate = $this->input->post('todate');

            $data['vendor_row'] = $this->VendorModel->get_vendor($vendor_id);
            $data['fromdate'] = $fromdate;
            $data['todate'] = $todate;

            $date_array = array();
            $datefrom = date("Y-m-d",strtotime($fromdate));
            $dateto = date("Y-m-d",strtotime($todate));
            while (strtotime($datefrom) <= strtotime($dateto)) 
            {
                $date_array[]=$datefrom;
                $datefrom = date ("Y-m-d", strtotime("+1 day", strtotime($datefrom)));
            }


            $data['date_array'] = $date_array;
        }

        $this->load->view('layout/header',$data);
        $this->load->view('Ledger/vendor_ledger'); 
        $this->load->view('layout/footer');
    }
}
?>