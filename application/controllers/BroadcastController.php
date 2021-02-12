<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BroadcastController extends CI_Controller {

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

    public function vendor_sms()
    {
        $data['title'] = 'Broadcast';
        $data['head_name'] = 'Broadcast';

        $data['company_row'] = $this->company->get_company();
        $data['vendor_details'] = $this->VendorModel->fetch_vendor();

        $this->load->view('layout/header',$data);
//        $this->load->view('layout/datatable');
        $this->load->view('Broadcost/vendor_sms'); 
        $this->load->view('layout/footer');
    }


    public function party_sms()
    {
        $data['title'] = 'Broadcast';
        $data['head_name'] = 'Broadcast';

        $data['company_row'] = $this->company->get_company();
        $data['party_row'] = $this->PartyModel->getParty();



        $this->load->view('layout/header',$data);
//        $this->load->view('layout/datatable');
        $this->load->view('Broadcost/party_sms');
        $this->load->view('layout/footer');
    }

    function send_msg($number,$msg)
    {
        $msg2=urlencode($msg);
        $url = "https://bhashsms.com/api/sendmsg.php?user=xlgroup&pass=aditya57&sender=XLCORP&phone=$number&text=$msg2&priority=sdnd&stype=normal";


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $header);

        $data = curl_exec($ch);

        if(curl_errno($ch))
        {
            curl_error($ch);
            $_SESSION['send']=1;
            //echo "Msg send";
        }

        else
        {
            curl_close($ch);
            unset($_SESSION['send']);
        }
    }

    function party_send()
    {
        $message = $this->input->post('party_sms');
        $company_row = $this->company->get_company();

        foreach($this->input->post('selectallparty1') as $key => $val)
        {
            $party = $this->PartyModel->fetch_party($val);
            //print_r($party); 
            echo nl2br("\n");
            $number11=$party->contact_no;
            echo $msg='Hi, '.ucwords($party->name).', '.$message.'.  from '.$company_row->company_name.'.';
            //            $this->send_msg($number11,$msg);
        }

        redirect('PartySMS');
    }

    function vendor_send()
    {
        $message = $this->input->post('vendor_sms');
        $company_row = $this->company->get_company();

        foreach($this->input->post('selectallvendor1') as $key => $val)
        {
            $vendor = $this->VendorModel->get_vendor($val);

            $number11=$vendor->contact;
            echo $msg='Hi, '.ucwords($vendor->name).', '.$message.'.  from '.$company_row->company_name.'.';
            //            $this->send_msg($number11,$msg);
        }
        redirect('PartySMS');
    }
}
?>