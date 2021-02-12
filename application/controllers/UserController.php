<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }


    public function index()
    {
        $this->load->view('user/login');
    }
    public function login()
    {
        $data['title'] = 'Login Page';

        //$this->load->library('form_validation');

        //$this->form_validation->set_rules('username', 'username', 'trim|required|alpha');
        //$this->form_validation->set_rules('password', 'password', 'required|numeric');

        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');

        if ($this->form_validation->run('login') == FALSE)
        {
            $this->load->view('user/login');
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->UserModel->login_check($username, $password);
            if($user === '1')
            {
                $this->session->set_flashdata('message1','user not available');
                redirect('login');
            }
            elseif($user === '2')
            {
                $this->session->set_flashdata('message1','Invalid user name or password, Try again');
                redirect('login');
            }
            elseif($user === '3')
            {
                $this->session->set_flashdata('message1','user not active');
                redirect('login');
            }
            else
            {
                $this->session->set_userdata('auth',$user);
                redirect('Dashboard');

            }
            //print_r($this->input->post());
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function set_session()
    {
        echo 'hello';
    }
}
