<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
        $this->load->model('Company_model');
    }
    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function view()
    {
        $data['title'] = 'Company';
        $data['head_name'] = 'Company';

        $data['company_row'] = $this->Company_model->get_company();

        $this->load->view('layout/header', $data);
        $this->load->view('company/view_company');
        $this->load->view('layout/footer');
    }

    public function edit()
    {
        $data['title'] = 'Company';
        $data['head_name'] = 'Edit Company';

        $comp_id = $this->uri->segment(2);
        $data['company'] = $this->Company_model->fetch_company($comp_id);
        $data['company_row'] = $this->Company_model->get_company();
        $data['state'] = $this->Company_model->fetch_state();

        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');

        if($this->form_validation->run('edit_company') == false){
            $this->load->view('layout/header', $data);
            $this->load->view('company/edit_company');
            $this->load->view('layout/footer');
        } 
        else 
        {
            if($_FILES["img_file"]["name"] != '')
            {
                //print_r($_FILES["img_file"]); echo nl2br("\n");echo nl2br("\n");
                $selct_file =  $_FILES["img_file"]["name"];
                $ext = explode('.',$selct_file);

                $config['upload_path'] = 'uploads/'; 
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['file_name'] = strtotime(date("Y-m-d H:i:s")).'.'.end($ext);
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('img_file'))
                {
                    $upload_data = array('upload_data' => $this->upload->data());
                    $images = $this->upload->data('orig_name');
                }
                else
                {
                    $error = array('error' => $this->upload->display_errors());
                    $images  =$this->input->post('original');
                }
            }
            else{
                $images = $this->input->post('original');
            }
            $id=$this->input->post('id');
            $companydata=array(
                'company_name'=>$this->input->post('company_name'),
                'industry_type'=>$this->input->post('industry_type'),
                'company_city'=>$this->input->post('company_city'),
                'company_state'=>$this->input->post('state'),
                'postal_code'=>$this->input->post('postal_code'),
                'company_phone'=>$this->input->post('company_phone'),
                'website'=>$this->input->post('website'),
                'gst_no'=>$this->input->post('company_gst'),
                'company_address'=>$this->input->post('company_address'),
                'logo_image'=>$images
            );

            $result = $this->Company_model->update($companydata, $id);

            if($result == true)
            {
                $this->session->set_flashdata('success','Update Successfully');
            }
            else
            {
                $this->session->set_flashdata('error','Not Update');
            }
            redirect('company');
        }


    }
}
