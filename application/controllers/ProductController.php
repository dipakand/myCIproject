<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
        $this->load->model('Company_model');
        $this->load->model('Productmodel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function productadd()
    {

        $user_id = $this->session->userdata('auth')->role;
        $data['title'] = 'Manage Product';
        $data['head_name'] = 'Manage Product';

        $data['company_row'] = $this->Company_model->get_company();

        $data['brand_row'] = $this->Productmodel->getBrand();

        $data['category_row'] = $this->Productmodel->getcategory();

        //$data['users_row'] = $this->ManageUserModel->get_users();
        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        if($this->form_validation->run('product_add') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('product/product_add');
            $this->load->view('layout/footer');
        }
        else
        {
            $prod_arr = array(
                'brand_id' => $this->input->post('brand'),
                'name' => $this->input->post('name'),
                'category_id' => $this->input->post('category'),
                'hsn' => $this->input->post('hsn'),
                'i_gst' => $this->input->post('i_gst'),
                'c_gst' => $this->input->post('c_gst'),
                's_gst' => $this->input->post('s_gst'),
                'user' => $user_id,
                'date_time' =>date("Y-m-d H:i:s")
            );

            $result = $this->Productmodel->save_produvt($prod_arr);
            if($result != 0)
            {
                $this->session->set_flashdata('success','Product Save Successfullly.!!!');
                $this->session->set_userdata('product_id',$result); 
                redirect('ProductDesc');
            }
            else
            {
                $this->session->set_flashdata('error','Something went ot wrong.!!!');
                redirect('ProductAdd');
            }
        }
    }

    public function productadddesc()
    {

        $user_id = $this->session->userdata('auth')->reg_id;
        $data['title'] = 'Manage Product';
        $data['head_name'] = 'Manage Product';

        $data['company_row'] = $this->Company_model->get_company();

        $product_id = $this->session->userdata('product_id'); 

        $data['product_row'] = $this->Productmodel->getProduct($product_id);

        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        if($this->form_validation->run('product_add_desc') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('product/product_add_desc');
            $this->load->view('layout/footer');
        }
        else
        {
            $weight[] = $this->input->post('weight');
            $mrp[] = $this->input->post('mrp');
            $barcode[] = $this->input->post('barcode');
            $stock[] = $this->input->post('stock');
            $value[] = $this->input->post('value');
            $desc_arry[]=array_merge($weight,$mrp,$barcode,$stock,$value);

            if($this->session->userdata('desc_arry'))
            {
                $desc_arry12 = $this->session->userdata('desc_arry');
                $desc_arry123 = array_merge($desc_arry12,$desc_arry);

                $this->session->set_userdata('desc_arry',$desc_arry123);
            }
            else{
                $this->session->set_userdata('desc_arry',$desc_arry);
            }

            redirect('ProductDesc');
        }
    }

    public function productRemove()
    {
        $key = $this->uri->segment(2);
        $desc_arry = $this->session->userdata('desc_arry');

        unset($desc_arry[$key]);

        $this->session->set_userdata('desc_arry',$desc_arry);
        redirect('ProductDesc');
    }

    public function subProductSave()
    {
        $desc_arry = $this->session->userdata('desc_arry');
        $prodcut_id = $this->session->userdata('product_id');
        $result = $this->Productmodel->save_prod_desc($desc_arry, $prodcut_id);

        if($result != 0)
        {
            $this->session->set_flashdata('success','Save Successfullly.!!!');
            $this->session->set_userdata('product_id',$result);
            $this->session->unset_userdata('product_id');
            $this->session->unset_userdata('desc_arry');
            if($this->session->userdata('addProd'))
            {
                $this->session->unset_userdata('addProd');
                redirect('ProductView');
            }
            else
            {
                redirect('ProductAdd');
            }
        }
        else
        {
            $this->session->set_flashdata('error','Something went ot wrong.!!!');
            redirect('ProductDesc');
        }
    }

    public function cancel_desc()
    {
        $this->session->unset_userdata('product_id');
        $this->session->unset_userdata('desc_arry');
        if($this->session->userdata('addProd'))
        {
            $this->session->unset_userdata('addProd');
            redirect('ProductView');
        }
        else
        {
            redirect('ProductDesc');
        }
    }

    public function addproductadddesc()
    {
        $product_id = $this->uri->segment(2);
        $this->session->set_userdata('product_id',$product_id);
        $this->session->set_userdata('addProd',1);
        redirect('ProductDesc');
    }

    public function productview()
    {
        $user_id = $this->session->userdata('auth')->reg_id;
        $data['title'] = 'Manage Product';
        $data['head_name'] = 'Manage Product';

        $data['company_row'] = $this->Company_model->get_company();
        $data['proDescRow'] = $this->Productmodel->getProductDesc();

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('product/productView');
        $this->load->view('layout/footer');
    }

    public function productedit()
    {
        $product_id = $this->uri->segment(2);
        $data['title'] = 'Manage Product';
        $data['head_name'] = 'Manage Product';

        $data['company_row'] = $this->Company_model->get_company();

        $data['productRow'] = $this->Productmodel->getProduct($product_id);

        $data['brand_row'] = $this->Productmodel->getBrand();

        $data['category_row'] = $this->Productmodel->getcategory();

        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div?');

        if($this->form_validation->run('product_edit') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('product/edit_product');
            $this->load->view('layout/footer');
        }
        else
        {
            //print_r($this->input->post());

            $array = array(
                'brand_id'=>$this->input->post('brand'),
                'name'=>$this->input->post('name'),
                'category_id'=>$this->input->post('category'),
                'hsn'=>$this->input->post('hsn'),
                'i_gst'=>$this->input->post('i_gst'),
                'c_gst'=>$this->input->post('c_gst'),
                's_gst'=>$this->input->post('s_gst')
            );

            $result = $this->Productmodel->update_prod($product_id, $array);
            //            print_r($result);
            //            exit;
            if($result > 0)
            {
                $this->session->set_flashdata('success','Product Update Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','No Update.!!!');
            }
            redirect('ProductView');
        }
    }

    public function View_description()
    {
        $result = $this->Productmodel->get_description();
        echo json_encode($result); 
    }

    public function delete_description()
    {
        $id = $this->uri->segment(2);
        $result = $this->Productmodel->delete_desc($id);
        if($result > 0)
        {
            $this->session->set_flashdata('success','Product Deleted Successfullly.!!!');
        }
        else
        {
            $this->session->set_flashdata('error','Not Delete.!!!');
        }
        redirect('ProductView');

    }
    public function edit_description()
    {
        $id = $this->uri->segment(2);

        $data['title'] = 'Manage Product';
        $data['head_name'] = 'Edit Product Description';

        $data['company_row'] = $this->Company_model->get_company();

        $data['proDescRow'] = $this->Productmodel->Desc_row($id);

        $this->form_validation->set_error_delimiters('<div class="alert-danger">','</div>');

        //print_r($this->input->post());
        if($this->form_validation->run('edit_product_desc') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('layout/datatable');
            $this->load->view('product/edit_desc_prod');
            $this->load->view('layout/footer');
        }
        else
        {
            $arrry = array(
                'weight' => $this->input->post('weight'),
                'mrp' => $this->input->post('mrp'),
                'barcode' => $this->input->post('barcode'),
                'stock' => $this->input->post('stock'),
                'sale_price' => $this->input->post('sale_price')
            );

            $result = $this->Productmodel->save_desc($id,$arrry);
            if($result > 0)
            {
                $this->session->set_flashdata('success','Product Save Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','Not Updated.!!!');
            }
            redirect('ProductView');

        }
    }

    public function addbrand()
    {
        $data['title'] = 'Manage Brand';
        $data['head_name'] = 'Manage Brand';

        $data['company_row'] = $this->Company_model->get_company();

        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');

        if($this->form_validation->run('add_brand') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('product/add_brand');
            $this->load->view('layout/footer');
        }
        else
        {
            $arra = array(
                "name" =>$this->input->post('name'),
                "bill_name" =>$this->input->post('bill_name'),
                "contact_no" =>$this->input->post('contact_no'),
                "email" =>$this->input->post('email'),
                "gst" =>$this->input->post('gst'),
                "pan_no" =>$this->input->post('pan_no'),
                "address" =>$this->input->post('address')
            );
            $result = $this->Productmodel->save_brand($arra);
            if($result > 0)
            {
                $this->session->set_flashdata('success','Brand Save Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','Not Updated.!!!');
            }
            redirect('brandAdd');
        }
    }

    public function viewbrand()
    {
        $data['title'] = 'Manage Brand';
        $data['head_name'] = 'Manage Brand';

        $data['company_row'] = $this->Company_model->get_company();

        $data['brandRow'] = $this->Productmodel->getbrand();

        $this->load->view('layout/header',$data);
        $this->load->view('layout/datatable');
        $this->load->view('product/brand_view');
        $this->load->view('layout/footer');
    }

    public function editbrand()
    {
        $id = $this->uri->segment(2);
        $data['title'] = 'Manage Brand';
        $data['head_name'] = 'Edit Brand';

        $data['company_row'] = $this->Company_model->get_company();

        $data['brandRow'] = $this->Productmodel->getbrandrow($id);

        if($this->form_validation->run('add_brand') == false)
        {
            $this->load->view('layout/header',$data);
            $this->load->view('product/edit_brand');
            $this->load->view('layout/footer');
        }
        else
        {
            $arra = array(
                "name" =>$this->input->post('name'),
                "bill_name" =>$this->input->post('bill_name'),
                "contact_no" =>$this->input->post('contact_no'),
                "email" =>$this->input->post('email'),
                "gst" =>$this->input->post('gst'),
                "pan_no" =>$this->input->post('pan_no'),
                "address" =>$this->input->post('address')
            );
            $result = $this->Productmodel->update_brand($id, $arra);
            if($result > 0)
            {
                $this->session->set_flashdata('success','Brand Updated Successfullly.!!!');
            }
            else
            {
                $this->session->set_flashdata('error','No Change.!!!');
            }
            redirect('brandView');
        }
    }

    public function deletebrand()
    {

    }
}
?>