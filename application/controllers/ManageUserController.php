<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUserController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
        $this->load->model('Company_model');
        $this->load->model('ManageUserModel');
    }
    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

        public function userList()
    {
        $data['title'] = 'Manage User';
        $data['head_name'] = 'Manage User';

        $data['company_row'] = $this->Company_model->get_company();

        $data['users_row'] = $this->ManageUserModel->get_users();

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('manageUsers/usersList');
        $this->load->view('layout/footer');
    }

    public function userDelete()
    {
        $id = $this->uri->segment(2);
        $result = $this->ManageUserModel->user_delete($id);
        if($result == true)
        {
            $this->session->set_flashdata('success','User Deleted Successfullly.!!!');
        }
        else
        {
            $this->session->set_flashdata('error','Something went ot wrong.!!!');
        }
        redirect('userList');
    }

    public function active_deactive()
    {
        $id = $this->uri->segment(2);
        $status = $this->uri->segment(3);
        $result = $this->ManageUserModel->status_change($id, $status);

        if($result == true)
        {
            $this->session->set_flashdata('success','User status changed');
        }
        else
        {
            $this->session->set_flashdata('error','Something went ot wrong.!!!');
        }
        redirect('userList');
    }

    public function exeList()
    {
        $data['title'] = 'Manage User';
        $data['head_name'] = 'Manage Executive';

        $data['company_row'] = $this->Company_model->get_company();

        $data['sales_executive'] = $this->ManageUserModel->get_sales_executive();

        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');

        if ($this->form_validation->run('sale_exe') == FALSE)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('layout/datatable');
            $this->load->view('manageUsers/executiveList');
            $this->load->view('layout/footer');
        }
        else
        {
            $data_arr = array(
                'name'=>$this->input->post('name'),
                'contact'=>$this->input->post('contact'),
                'email'=>$this->input->post('email'),
                'username'=>$this->input->post('contact'),
                'password'=>$this->input->post('password'),
                'status'=>1,
                'date_time'=>date("Y-m-d H:i:s")
            );
            print_r($data_arr);

            $result = $this->ManageUserModel->save_exe($data_arr);
            if($result == true)
            {
                $this->session->set_flashdata('success','Executive Save Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','Something went ot wrong.!!!');
            }
            redirect('executiveList');
        }

    }

    public function delete_exe()
    {
        $id = $this->uri->segment(2);
        $result = $this->ManageUserModel->exe_delete($id);
        if($result == true)
        {
            $this->session->set_flashdata('success','Executive Deleted Successfullly.!!!');
        }
        else
        {
            $this->session->set_flashdata('error','Something went ot wrong.!!!');
        }
        redirect('executiveList');
    }
}
?>