<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrintChequeSlipController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('CommenModel');
        $this->load->model('PrintChequeSlipModel');
        //$this->load->model('PartyModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    function data_return()
    {
        $data_row = $this->PrintChequeSlipModel->fetch_data();

        foreach($data_row as $rows)
        {
            $details = unserialize($rows->detail);
            foreach($details as $kee=>$vall)
            {
                if($vall['type']=='cheque')
                {
                    $chNo_aar[] = $vall['no'];
                    $mergval='';
                    $mergval = array_merge($vall,array('party_id'=>$rows->partyId));
                    $chequ_det[] = $mergval;
                }
            }
        }

        $unq_arr = array_unique($chNo_aar);

        $mainArr = array();
        foreach($unq_arr as $k1=>$v1)
        {
            $tot_amt=0;
            foreach($chequ_det as $value1)
            {
                if($v1==$value1['no'])
                {
                    $tot_amt += $value1['amt'];
                    $key = (string)$v1;

                    $select_party = $this->db->where('id', $value1['party_id'])->get('manage_party')->row();

                    $draer_name = '';
                    //                    if($value1['draer_name'] != '' && isset($value1['draer_name']))
                    //                    {
                    //                        $draer_name = $value1['draer_name'];
                    //                    }
                    $mainArr[$key] = array('cno'=>$value1['no'],'cdate'=>$value1['date'],'cname'=>$value1['name'],'cparty'=>$value1['party_id'],'cdrawer'=>$draer_name,'total'=>$tot_amt,'p_name'=>$select_party->name);
                }
            }
        }
        return $mainArr;
    }

    public function print_cheque_slip()
    {
        $data['title'] = 'Print Cheque Slip';
        $data['head_name'] = 'Print Cheque Slip';

        $data['company_row'] = $this->company->get_company();

        $data['mainArr'] = $this->data_return();

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('PrintChequeSlip/print_cheque_slip'); 
        $this->load->view('layout/footer');
    }

    function print_slip()
    {
//        print_r($this->input->post());
//        exit;
        $data['company_row'] = $this->company->get_company();
        $data['sess_cheq'] = $this->input->post('chkbox1');
        $data['cheq_alldet'] = $this->data_return();
        
        $this->load->view('PrintChequeSlip/deposit_pay_slip',$data); 
    }


}
?>