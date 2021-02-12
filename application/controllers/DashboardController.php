<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
        $this->logged_in();
    }
    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function dashboard()
    {
        $data['company_row'] = $this->Company_model->get_company();
        $data['title'] = 'Dashboard';
        $data['head_name'] = 'Dashbosrd';
        $this->load->view('layout/header', $data);
        $this->load->view('dsshboard');
        $this->load->view('layout/footer');
    }
}
