<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartyController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model');
        $this->load->model('PartyModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function paryadd()
    {
        $user_id = $this->session->userdata('auth')->role;
        $data['title'] = 'Manage Party';

        $data['head_name'] = 'Manage Product';

        $data['company_row'] = $this->Company_model->get_company();
        $data['state_row'] = $this->Company_model->fetch_state();

        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        if($this->form_validation->run('add_party') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('ManageParty/addparty');
            $this->load->view('layout/footer');
        }
        else
        {
            $array = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state_id' => $this->input->post('state_id'),
                'pincode' => $this->input->post('pincode'),
                'landmark' => $this->input->post('landmark'),
                'contact_no' => $this->input->post('contact'),
                'contact_person' => $this->input->post('contact_person'),
                'email_id' => $this->input->post('email'),
                'gst_in' => $this->input->post('gst_in'),
                'limit_days' => $this->input->post('limit_1'),
                'user' => $user_id,
                'date_time' => date("Y-m-d H:i:s"),
                'fssai_no' => $this->input->post('ffsi_no'),
                'discount' => $this->input->post('discount')
            );

            $result = $this->PartyModel->save_party($array);
            if($result != 0)
            {
                $this->session->set_flashdata('success','Party Save Successfullly.!!!');
                redirect('PartyAdd');
            }
            else
            {
                $this->session->set_flashdata('error','Something went ot wrong.!!!');
                redirect('PartyAdd');
            }
        }

    }
    public function paryview()
    {
        $data['title'] = 'Manage Party';

        $data['head_name'] = 'Manage Product';

        $data['company_row'] = $this->Company_model->get_company();

        $data['party_row'] = $this->PartyModel->getParty();

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('ManageParty/viewparty');
        $this->load->view('layout/footer');
    }
    public function paryedit()
    {
        $party_id = $this->uri->segment(2); 
        $data['title'] = 'Manage Party';

        $data['head_name'] = 'Edit Party';

        $data['company_row'] = $this->Company_model->get_company();

        $data['state_row'] = $this->Company_model->fetch_state();

        $data['party_row'] = $this->PartyModel->fetch_party($party_id);

        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        if($this->form_validation->run('edit_party') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('ManageParty/editparty');
            $this->load->view('layout/footer');
        }
        else
        {
            $array = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state_id' => $this->input->post('state_id'),
                'pincode' => $this->input->post('pincode'),
                'landmark' => $this->input->post('landmark'),
                'contact_no' => $this->input->post('contact'),
                'contact_person' => $this->input->post('contact_person'),
                'email_id' => $this->input->post('email'),
                'gst_in' => $this->input->post('gst_in'),
                'limit_days' => $this->input->post('limit_1'),
                'fssai_no' => $this->input->post('ffsi_no'),
                'discount' => $this->input->post('discount')
            );

            $result = $this->PartyModel->update_party($array, $party_id);
            if($result != 0)
            {
                $this->session->set_flashdata('success','Party Save Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','No Update.!!!');
            }
            redirect('PartyView');
        }
    }
    public function parydelete()
    {
        $id = $this->uri->segment(2);

        $result = $this->PartyModel->delete_party($id);
        if($result > 0)
        {
            $this->session->set_flashdata('success','Party Delete Successfullly.!!!');
        }
        else
        {
            $this->session->set_flashdata('error','Something went ot wrong.!!!');
        }
        redirect('PartyView');
    }
}