<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VendorController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model');
        $this->load->model('VendorModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function vendorAdd()
    {
        $user_id = $this->session->userdata('auth')->role;
        $data['title'] = 'Manage Vendor';
        $data['head_name'] = 'Manage Vendor';

        $data['company_row'] = $this->Company_model->get_company();
        $data['state_row'] = $this->Company_model->fetch_state();


        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        if($this->form_validation->run('add_vendor') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('MangeVendor/vendorAdd');
            $this->load->view('layout/footer');
        }
        else
        {
            //vendor_details (name, email, contact, city, state, pincode, address, gstin, user, date_time) 
            $array = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'contact' => $this->input->post('contact'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state_id'),
                'pincode' => $this->input->post('pincode'),
                'address' => $this->input->post('address'),
                'gstin' => $this->input->post('gstin'),
                'user' => $user_id,
                'date_time' => date("Y-m-d H:i:s")
            );
            $result = $this->VendorModel->save_vendor($array);

            if($result != 0)
            {
                $this->session->set_flashdata('success','Party Save Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','Something went ot wrong.!!!');
            }
            redirect('VendorAdd');
        }

    }

    public function vendorView()
    {
        $data['title'] = 'Manage Vendor';
        $data['head_name'] = 'Manage Vendor';

        $data['company_row'] = $this->Company_model->get_company();
        $data['Vendor_row'] = $this->VendorModel->fetch_vendor();

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('MangeVendor/vendorView');
        $this->load->view('layout/footer');
    }
    
    public function vendorEdit()
    {
        $vendor_id = $this->uri->segment(2);
        $data['title'] = 'Manage Vendor';
        $data['head_name'] = 'Edit Vendor';

        $data['company_row'] = $this->Company_model->get_company();
        
        $data['state_row'] = $this->Company_model->fetch_state();
        
        $data['Vendor_row'] = $this->VendorModel->get_vendor($vendor_id);

        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        if($this->form_validation->run('add_vendor') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('MangeVendor/vendorEdit');
            $this->load->view('layout/footer');
        }
        else
        {
            //vendor_details (name, email, contact, city, state, pincode, address, gstin, user, date_time) 
            $array = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'contact' => $this->input->post('contact'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state_id'),
                'pincode' => $this->input->post('pincode'),
                'address' => $this->input->post('address'),
                'gstin' => $this->input->post('gstin'),
                'date_time' => date("Y-m-d H:i:s")
            );
            $result = $this->VendorModel->update_vendor($array,$vendor_id);

            if($result != 0)
            {
                $this->session->set_flashdata('success','Party Save Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','Something went ot wrong.!!!');
            }
            redirect('VendorView');
        }
    }
}
?>