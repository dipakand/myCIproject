<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('OrderModel');
        $this->load->model('CommenModel');
        $this->load->model('Productmodel');
        $this->load->model('ManageUserModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function order()
    {
        $data['title'] = 'Order';
        $data['head_name'] = 'Order';

        $data['company_row'] = $this->company->get_company();

        $data['sales_executive_rows'] = $this->ManageUserModel->get_sales_executive();
        $data['brand_master_rows'] = $this->Productmodel->getBrand();

        $this->form_validation->set_rules('sale_exe', 'Sale Executive', 'required');
        $this->form_validation->set_rules('sel_brand[]', 'Brand', 'required');

        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');

        $data['sale_exe'] = '';
        $data['sel_brand'] = '';

        if ($this->form_validation->run() == FALSE)
        {
        }
        else
        {
            if($this->input->post())
            {
                //print_r($this->input->post()); exit;
                $data['sale_exe'] = $this->input->post('sale_exe');
                $data['sel_brand'] = $this->input->post('sel_brand');
            }

        }
        $this->load->view('layout/header', $data);
        $this->load->view('layout/datatable');
        $this->load->view('Order/order');
        $this->load->view('layout/footer');

    }

    function get_order()
    {
        //print_r($this->input->post());
        $stock = $this->input->post('stock');
        $mrp = $this->input->post('mrp');
        $s = 0;
        $item_arr = array();
        foreach($stock as $key => $val)
        {
            if($val != 0)
            {
                $item_arr[$s]['id']=$key;
                $item_arr[$s]['mrp']=$mrp[$key];
                $item_arr[$s]['qty']=$val;
                $s++;
            }
        }

        //print_r($item_arr); echo count($item_arr);
        if(count($item_arr) == 0)
        {
            $this->session->set_flashdata('error', 'Please enter stock');
            redirect('Order');
        }
        else
        {

            //print_r($arr);exit;
            if($this->input->post('edit') != '')
            {
                $id = $this->input->post('edit');
                $arr = array(
                    "item_array" =>serialize($item_arr),
                    "sales_ex" =>$this->input->post('sales_exidd'),
                );

                //                print_r($arr); exit;
                //$update = "UPDATE `orders` SET `item_array` = '".serialize($item_arr)."', `sales_ex` = '".$_POST['sales_exidd']."' WHERE `id`= '".$_REQUEST['id']."' ";

                $result = $this->OrderModel->update_order($arr,$id);
                if($result > 0)
                {
                    $this->session->set_flashdata('success','Order successfully Update...');
                }
                else{
                    $this->session->set_flashdata('errror','Order Not Update...');

                }
                redirect('AllOrder');
            }
            else
            {
                $arr = array(
                    "date" =>date("Y-m-d"),
                    "item_array" =>serialize($item_arr),
                    "sales_ex" =>$this->input->post('sales_exidd'),
                    "date_time" =>date("Y-m-d H:i:s")
                );
                $result = $this->OrderModel->save_order($arr);
                if($result > 0)
                {
                    $this->session->set_flashdata('success','Order successfully save...');
                }
                else{
                    $this->session->set_flashdata('errror','Order Not save...');

                }
                redirect('Order');
            }


        }
    }

    public function view_order()
    {
        $data['title'] = 'view Order';
        $data['head_name'] = 'view Order';

        $data['company_row'] = $this->company->get_company();

        if($this->input->post())
        {
            $fst_dt = $this->input->post('from_date');
            $lst_dt = $this->input->post('to_date');
        }
        else
        {
            $fst_dt = date("Y-m-d");
            $lst_dt = date("Y-m-d");
        }

        $data['fst_dt'] = $fst_dt;
        $data['lst_dt'] = $lst_dt;

        $data['order_row'] = $this->OrderModel->view_order($fst_dt,$lst_dt);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/datatable');
        $this->load->view('Order/view_order');
        $this->load->view('layout/footer');
    }

    public function print_order()
    {
        $order_id = $this->uri->segment(3);
        $data['title'] = 'view Order';
        $data['head_name'] = 'view Order';

        $data['company_row'] = $this->company->get_company();

        $data['order_row'] = $this->OrderModel->get_orer($order_id);

        $this->load->view('Order/print_order',$data);
    }

    public function edit_order()
    {
        $order_id = $this->uri->segment(2); 
        $data['title'] = 'Edit Order';
        $data['head_name'] = 'Edit Order';

        $data['company_row'] = $this->company->get_company();

        $data['order_row'] = $this->OrderModel->get_order($order_id);

        $data['sales_executive_rows'] = $this->ManageUserModel->get_sales_executive();

        $data['brand_master_rows'] = $this->Productmodel->getBrand();

        $item_array = unserialize($data['order_row']->item_array);
        foreach($item_array as $ky => $vl)
        {
            $ids[$ky]=$vl['id'];
            $edit_arra[$vl['id']]=$vl['qty'];
        }

        foreach($ids as $key1=>$val1)
        {
            $select_prodt_desc = $this->db->where('id',$val1)->get('product_desc')->row();
            $select_prodt = $this->db->where('product_id',$select_prodt_desc->product_id)->get('product')->row();
            $brnd_arr[] = $select_prodt->brand_id;
        }
        $sel_brand = array_unique($brnd_arr);
        $data['ids'] = $ids;
        $data['edit_arra'] = $edit_arra;
        $data['order_id'] = $order_id;

        if($this->input->post())
        {
            //print_r($this->input->post()); exit;
            $data['sale_exe'] = $this->input->post('sale_exe');
            $data['sel_brand'] = $this->input->post('sel_brand');

        }
        else
        {
            $data['sel_brand'] = $sel_brand;

            $data['sale_exe'] = $data['order_row']->sales_ex;
        }

        $this->load->view('layout/header', $data);
        //        $this->load->view('layout/datatable');
        $this->load->view('Order/edit_order');
        $this->load->view('layout/footer');

    }

    function details()
    {
        $id = $this->input->post();

        $order_row = $this->OrderModel->get_order($id['order_id']);

        $item_array = unserialize($order_row->item_array);

        $data = array();
        foreach($item_array as $item)
        {
            $select_prodt_desc = $this->db->where('id',$item['id'])->get('product_desc')->row();
            $select_prodt = $this->db->where('product_id',$select_prodt_desc->product_id)->get('product')->row();

            $data[] = array('name' =>$select_prodt->name,'weight' =>$select_prodt_desc->weight,'mrp' =>$item['mrp'],'qty' =>$item['qty']);
        }

        echo json_encode($data);
    }

    function getName()
    {
        $id = $this->input->post('id');

        $select_prodt_desc = $this->db->where('id',$id)->get('product_desc')->row();
        $select_prodt = $this->db->where('product_id',$select_prodt_desc->product_id)->get('product')->row();
        //$order_row = $this->OrderModel->get_order($id['id']);

        //$item_array = unserialize($order_row->item_array);

        echo json_encode(array('name'=>$select_prodt->name,'weight'=>$select_prodt_desc->weight));
        //        echo json_encode($select_prodt_desc);
    }
}

?>