<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model');
        $this->load->model('CommenModel');
        $this->load->model('PurchaseModel');
        $this->load->model('SaleModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function purchase_order()
    {
        $data['title'] = 'Purchase';
        $data['head_name']= 'Direct PO';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post('search') == 1)
        {
            $data['vendor_row'] = $this->PurchaseModel->fetch_vendor($this->input->post('id_vendor'));
            //print_r($data['vendor_row']);exit;
            $this->session->set_userdata('vendor_data',$data['vendor_row']);

            //$data['head_name']= 'Direct PO '.$data['vendor_row']->name;
        }
        if($this->input->post('borcode') == 'borcode')
        {
            $barcode = $this->input->post('barcode');

            $bcd=explode(' ',$barcode);

            if(count($bcd) > 1)
            {
                $pro_id = end($bcd);
            }
            else{
                //$fetchbarcode=mysqli_fetch_assoc(mysqli_query($conn,"select * from product_desc where barcode='".$_POST['barcode']."'"));
                //$pro_id = $fetchbarcode['id'];
            }
            //echo $pro_id;
            $no=0;

            if($this->session->userdata('purchase_direct'))
            {
                foreach($this->session->userdata('purchase_direct') as $key1 => $val1)
                {
                    if($pro_id == $val1[0])
                    {
                        $no++;
                        $this->session->set_flashdata('error', 'This product exist please remove and add....');
                    }
                }
            }


            if($no == 0)
            {
                $this->session->set_userdata('barcode',$pro_id);
            }

            /*
            if($no == 0)
            {
                $result1="select * from product_desc where id='".$pro_id."'";
                $query1=mysqli_query($conn,$result1);
                $fetch2=mysqli_fetch_assoc($query1);
                $fetch2['id'];
                $_SESSION['barcode']=$fetch2['id'];
            }
            if(empty($_SESSION['purchase_direct']))
            {
                $result1="select * from product_desc where id='".$pro_id."'";
                $query1=mysqli_query($conn,$result1);
                $fetch2=mysqli_fetch_assoc($query1);
                $fetch2['id'];
                $_SESSION['barcode']=$fetch2['id'];
            }*/
        }

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/direct_p_o');
        $this->load->view('layout/footer');
    }

    public function getVenodr()
    {
        $post = $this->input->post();   
        $data = $this->PurchaseModel->getVendor($post);

        echo json_encode($data);
    }

    function unset_session()
    {
        $this->session->unset_userdata('vendor_data');
        $this->session->unset_userdata('purchase_direct');
        $this->session->unset_userdata('order');
        $this->session->unset_userdata('barcode');
        $this->session->unset_userdata('purchase_order_row');
        $this->session->unset_userdata('old');
        $this->session->unset_userdata('old_stock');
        $this->session->unset_userdata('edit_hold');
    }

    function cancel_deal()
    {
        $this->unset_session();
        redirect('PurchaesOrder');
    }

    public function add_product()
    {
        $id=$this->input->post('id');
        $qty=$this->input->post('qty');
        $free=$this->input->post('free');
        $rate=$this->input->post('rate');
        $disc=$this->input->post('disc');
        $array1[]=array($id, $qty, $free, $rate, $disc);
        $array12[]=array($id, $qty, $free);

        if($this->session->userdata('purchase_direct'))
        {
            $purchase_direct_old = $this->session->userdata('purchase_direct');
            $order_old = $this->session->userdata('order');

            $purchase_direct_new = array_merge($purchase_direct_old, $array1);
            $order_new = array_merge($order_old, $array12);

            $this->session->set_userdata('purchase_direct',$purchase_direct_new);
            $this->session->set_userdata('order',$order_new);
        }
        else
        {
            $this->session->set_userdata('purchase_direct',$array1);
            $this->session->set_userdata('order',$array12);
        }

        $this->session->unset_userdata('barcode');
        if($this->input->post('edit') == 'edit')
        {
            redirect('EditOrder/'.$this->input->post('order_id'));
        }
        elseif($this->input->post('edit_hold') == 'edit_hold')
        {
            redirect('ProcessHoldOrder/'.$this->input->post('order_id'));
        }
        else
        {
            redirect('PurchaesOrder');
        }
    }


    public function unset_prod()
    {
        $key = $this->uri->segment(3);

        $purchase_direct_old = $this->session->userdata('purchase_direct');
        $order_old = $this->session->userdata('order');

        unset($purchase_direct_old[$key]);
        unset($order_old[$key]);

        sort($purchase_direct_new);
        sort($order_new);

        $this->session->set_userdata('purchase_direct',$purchase_direct_old);
        $this->session->set_userdata('order',$order_old);
        redirect('PurchaesOrder');
    }

    function save_order()
    {
        $idd=$_POST['idd'];
        $qttyy=$_POST['qttyy'];
        $frees=$_POST['freee'];
        $ratess=$_POST['ratess'];
        $discount=$_POST['discount'];
        $taxable=$_POST['taxable'];
        $totalss=$_POST['totalss'];
        $gst_amtss=$_POST['gst_amtss'];
        $gst_per=$_POST['gst_per'];
        $n=0;

        foreach($idd as $keyy=>$vall){
            $rec_order[$n][]=$vall;
            $rec_order[$n][]=$qttyy[$keyy];
            $rec_order[$n][]=$frees[$keyy];
            $rec_order[$n][]=$ratess[$keyy];
            $rec_order[$n][]=$discount[$keyy];
            $rec_order[$n][]=$taxable[$keyy];
            $rec_order[$n][]=$gst_per[$keyy];
            $rec_order[$n][]=$gst_amtss[$keyy];
            $rec_order[$n][]=$totalss[$keyy];
            $n++;
        }
        $odr=serialize($this->session->userdata('order'));
        $purchase=serialize($rec_order);

        $order_arr = array(
            "vendor_id" => $this->session->userdata('vendor_data')->id,
            "date" => date("Y-m-d",strtotime($this->input->post('sel_date'))),
            "items" => $odr,
            "received" => $purchase,
            "user" => $this->session->userdata('auth')->role,
            "date_time" => date("Y-m-d H:i:s"),
            "receipt" => $this->input->post('receipt'),
            "total_amt" => $this->input->post('total_amount')
        );

        $inv_no = $this->input->post('receipt');
        $in_date = date("Y-m-d", strtotime($this->input->post('sel_date')));


        if($this->input->post('order') == 'order')
        {
            $result1 = $this->PurchaseModel->insert_order($order_arr,$inv_no,$in_date);
            if($result1 > 0)
            {
                $this->session->set_flashdata('success', 'Order save successfully.!!!!');
            }
            else
            {
                $this->session->set_flashdata('error', 'something want to wrong.!!!!');
            }
        }
        else
        {
            $result1 = $this->PurchaseModel->insert_hold_order($order_arr);
            if($result1 > 0)
            {
                $this->session->set_flashdata('success', 'Hold Order save successfully.!!!!');
            }
            else
            {
                $this->session->set_flashdata('error', 'something want to wrong.!!!!');
            }

        }

        $this->unset_session();
        redirect('PurchaesOrder');

    }

    public function manage_order()
    {
        $data['title'] = 'Purchase';
        $data['head_name']= 'Direct PO';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
        }
        else
        {
            $frmdate = date("Y-m-01"); 
            $todate = date("Y-m-d");
        }

        $data['purchase_order'] = $this->PurchaseModel->get_purchase_order($frmdate,$todate);

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/manage_order');
        $this->load->view('layout/footer');

    }

    public function View_order()
    {
        $ord_id = $this->input->get();

        $data = $this->PurchaseModel->get_order($ord_id['desc_id']);

        echo json_encode($data);
    }


    public function view_purchase_order()
    {
        $order_id = $this->uri->segment(2);
        $data['title'] = 'Purchase';
        $data['head_name']= 'Preview Order';

        $data['company_row'] = $this->Company_model->get_company();

        $data['purchase_order_row'] = $this->PurchaseModel->get_purchase_order_row($order_id);
        $purcahse = $data['purchase_order_row'];
        $etem1=unserialize($purcahse->received);

        $s=0;
        $tot_tamt=0;
        $tot_totamt=0;
        $tot_cgst=0;
        $tot_sgst=0;
        $tot_igst=0;
        $re_co=0;
        foreach($etem1 as $key1 => $val1)
        { 
            $tot1=0;

            $rtcal11=$val1[3]-(($val1[3]*$val1[4])/100);

            $tot1=$rtcal11*$val1[1];

            $this->db->where('product_desc.id',$purcahse->vendor_id);
            $this->db->select('product_desc.*, product.name as prod_name, product.hsn, product.i_gst');
            $this->db->join('product','product_desc.product_id = product.product_id');
            $quer2 = $this->db->get('product_desc');
            $fetch11 = $quer2->row();

            $tot1420=0;
            $rtcal420=$val1[3]-(($val1[3]*$val1[4])/100);
            $tot1420=$rtcal420*$val1[1];

            $gst_rupees=($tot1420*$fetch11->i_gst)/100;
            $fin_tot_rupes=$tot1+$gst_rupees;
            $recombine[$re_co][]=$val1[0];
            $recombine[$re_co][]=$val1[1];
            $recombine[$re_co][]=$val1[2];
            $recombine[$re_co][]=$val1[3];
            $recombine[$re_co][]=$val1[4];
            $recombine[$re_co][]=(string)$tot1420;
            $recombine[$re_co][]=$fetch11->i_gst;
            $recombine[$re_co][]=$gst_rupees;
            $recombine[$re_co][]=round($fin_tot_rupes);
            $re_co++;

        }
        $upda_arr = array(
            'received' => serialize($recombine)
        );


        $this->PurchaseModel->update_order($upda_arr,$purcahse->id);


        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/preview_order');
        $this->load->view('layout/footer');
    }

    public function print_page()
    {
        $order_id = $this->uri->segment(2);
        $data['title'] = 'Purchase';
        $data['head_name']= 'Preview Order';

        $data['company_row'] = $this->Company_model->get_company();

        $data['purchase_order_row'] = $this->PurchaseModel->get_purchase_order_row($order_id);
        $this->load->view('PurchaseOrder/print', $data);
    }
    public function receive_order()
    {
        $order_id = $this->uri->segment(2);
        $data['title'] = 'Purchase';
        $data['head_name']= 'Preview Order';

        $data['company_row'] = $this->Company_model->get_company();

        $data['purchase_order_row'] = $this->PurchaseModel->get_purchase_order_row($order_id);

        if($this->input->post())
        {
            $pro_id=$this->input->post('id');
            $qty=$this->input->post('qty');
            $free=$this->input->post('free');
            $rate=$this->input->post('rate');
            $disc=$this->input->post('disc');
            $gst=$this->input->post('gst');
            $n=0;
            foreach($pro_id as $id_key => $id_val)
            {

                $araa[$n][]=$id_val;
                $araa[$n][]=$qty[$id_key];
                $araa[$n][]=$free[$id_key];
                $araa[$n][]=$rate[$id_key];
                $araa[$n][]=$disc[$id_key];
                $araa[$n][]=$qty[$id_key] * $rate[$id_key];
                $araa[$n][]=$gst[$id_key];

                $gst = (($qty[$id_key] * $rate[$id_key]) * $gst[$id_key]) / 100 ;

                $araa[$n][]=$gst;
                $araa[$n][]=($qty[$id_key] * $rate[$id_key]) + $gst;
                $n++;
            }
            $updat_arr = array(
                "received"=>serialize($araa),
                "inv_date"=>date("Y-m-d",strtotime($this->input->post('inv_date'))),
                "inv_no"=>$this->input->post('inv_no'),
                "receipt"=>$this->input->post('receipt'),
                "recev_status"=>1
            );

            $result = $this->PurchaseModel->update_order($updat_arr,$order_id);
            if($result == true)
            {
                foreach($araa as $k => $v)
                {
                    $this->db->where('id', $v[0]);
                    $query1 = $this->db->get('product_desc');
                    $na = $query1->row();
                    $stock = $na->stock; 
                    $lesss = $stock + ($v[1]+$v[2]);

                    $product_desc =array('stock'=>$lesss);

                    $this->db->where('id', $v[0]);
                    $this->db->update('product_desc', $product_desc);

                    $this->db->query("update vendor_product set price='".$v[3]."' where prod_desc_id='".$v[0]."' and vendor_id='".$fetch['vendor_id']."'");
                }

                redirect('ManageOrder');
            }
        }


        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/receive_order');
        $this->load->view('layout/footer');

    }

    public function pament_receive()
    {

        $order_id = $this->uri->segment(2);
        $data['title'] = 'Purchase';
        $data['head_name']= 'Payment Receive';

        $data['company_row'] = $this->Company_model->get_company();

        $data['purchase_order_row'] = $this->PurchaseModel->get_purchase_order_row($order_id);

        $rows = $data['purchase_order_row'];

        if($this->input->post())
        {
            //print_r($this->input->post());
            if($this->input->post('pending') == $this->input->post('receive_amt'))
            {

                foreach($this->input->post('payment_number11') as $ke1 => $va1)
                { 
                    if($va1 !='')
                    {
                        $values[]=$va1;
                    } 
                }
                $values ;
                $count_amt=count($values);
                $count_type=count($this->input->post('payment_type'));
                if($count_amt == $count_type)
                {
                    $tottal =$this->input->post('payment_number11')[0]+$this->input->post('payment_number11')[1]+$this->input->post('payment_number11')[2]+$this->input->post('payment_number11')[3]+$this->input->post('payment_number11')[4];
                    if($tottal == $this->input->post('receive_amt'))
                    { 
                        foreach($this->input->post('payment_number1') as $pay1)
                        {
                            $payment_no1[] =$pay1;    
                        }
                        foreach($this->input->post('payment_number11') as $pay11)
                        {
                            $payment_amt1[] =$pay11;    
                        }
                        foreach($this->input->post('payment_number111') as $pay111)
                        {
                            $payment_date11[] =$pay111;    
                        }
                        foreach($this->input->post('payment_number1111') as $pay1111)
                        {
                            $payment_name111[] =$pay1111;    
                        }
                        $n=0;
                        foreach($this->input->post('payment_type') as $pay_type)   
                        {
                            if($payment_amt1[$n]!=0)
                            {
                                $item[$n]['type']=$pay_type;
                                $item[$n]['no']=$payment_no1[$n];
                                $item[$n]['amt']=$payment_amt1[$n];
                                $item[$n]['date']=$payment_date11[$n];
                                $item[$n]['name']=$payment_name111[$n];
                            }
                            $n++;
                        }

                        $pur_log = array(
                            "purchase_id"=> $order_id,
                            "deposit"=> $this->input->post('receive_amt'),
                            "detail"=> serialize($item),
                            "user"=> $this->session->userdata('auth')->role,
                            "date_time"=> date("Y-m-d H:i:s")
                        );
                        print_r($pur_log);echo nl2br("\n");

                        $result = $this->PurchaseModel->save_pur_log($pur_log);
                        if($result > 0)
                        {
                            //echo 'last id '.$result; echo nl2br("\n");
                            //$receive = $rows->receive_amt + $this->input->post('receive_amt');
                            $receive = $this->input->post('receive_amt');
                            //echo 'receive '.$receive; echo nl2br("\n");
                            $this->db->query("update purchase_order set receive_amt='".round($receive)."' where id='".$order_id."'");

                        }
                        else
                        {
                            $this->session->set_flashdata('error','Something wrong.!!');
                        }


                    }
                }
                else
                {
                    $this->session->set_flashdata('error','Amount Description Does NOT Match.!!');
                }
            }
            redirect('ManageOrder');
        }


        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/receive_paryment');
        $this->load->view('layout/footer');
    }

    public function cancle_order()
    {
        $order_id = $this->uri->segment(2);

        $pur_order = $this->PurchaseModel->get_purchase_order_row($order_id);

        $received = unserialize($pur_order->received);

        $result = $this->PurchaseModel->purchase_order_cancel($order_id);

        if($result == true)
        {
            foreach($received as $item)
            {
                $this->db->where('id', $item[0]);
                $query1 = $this->db->get('product_desc');
                $na = $query1->row();
                $stock = $na->stock; 
                $lesss = $stock + ($item[1]+$item[2]);

                //echo $stock. ' = '.$lesss.' =>'.$item[1].' =>'.$item[2]; echo nl2br("\n");

                $product_desc =array('stock'=>$lesss);

                $this->db->where('id', $item[0]);
                $this->db->update('product_desc', $product_desc);
            }
            $this->session->set_flashdata('success', 'Order Cancel successfully.!!!!');
        }
        else
        {
            $this->session->set_flashdata('error', 'something want to wrong.!!!!');
        }
        redirect('ManageOrder');

    }

    public function item_wise_cancel()
    {
        $order_id = $this->uri->segment(2);
        $data['title'] = 'Purchase';
        $data['head_name']= 'Item Wise Cancel';

        $data['company_row'] = $this->Company_model->get_company();

        $data['purchase_order_row'] = $this->PurchaseModel->get_purchase_order_row($order_id);

        if($this->input->post())
        {
            $return_itemm=unserialize($data['purchase_order_row']->return_item);
            //print_r($return_itemm); exit;
            $id=$this->input->post('id');
            $qty=$this->input->post('qty');
            $re_qty=$this->input->post('re_qty');
            $free=$this->input->post('free');
            $rate=$this->input->post('rate');
            $dis=$this->input->post('dis');
            $gst_per=$this->input->post('old_gst_per');
            $old_txbl=$this->input->post('old_taxable');
            $old_gst_amt=$this->input->post('old_gst_amtss');
            $old_totl=$this->input->post('old_totalss');

            $qty1=array_sum($qty);
            $re_qty1=array_sum($re_qty);
            $i=0;
            foreach($qty as $keys => $value)
            {
                if($value < $re_qty[$keys])
                {
                    $i++;
                }
            }
            if($i == 0)
            {
                $n= 0;

                foreach($id as $k => $v)
                {
                    $qty[$k];
                    //                    $unit[$k];
                    $qty_cl = 0;
                    $qty_cl=$re_qty[$k];
                    //
                    $ret_taxable=$re_qty[$k]*($rate[$k]-($rate[$k]*($dis[$k]/100)));
                    $ret_gst_amt=$ret_taxable*$gst_per[$k]/100;
                    $ret_tot_amt=$ret_taxable+$ret_gst_amt;

                    $item[$n][]=$v;
                    $item[$n][]=$re_qty[$k];

                    $item12[$n][]=$v;
                    $item12[$n][]=$qty[$k]-$re_qty[$k];
                    $item12[$n][]=$gst_per[$k];
                    $item12[$n][]=$old_txbl[$k]-$ret_taxable;
                    $item12[$n][]=$old_gst_amt[$k]-$ret_gst_amt;
                    $item12[$n][]=$old_totl[$k]-$ret_tot_amt;

                    $item1[$n][]=$v;
                    $item1[$n][]=$qty[$k]-$re_qty[$k];
                    $item1[$n][]=$free[$k];                            
                    $item1[$n][]=$rate[$k];
                    $item1[$n][]=$dis[$k];
                    $item1[$n][]=$old_txbl[$k]-$ret_taxable;
                    $item1[$n][]=$gst_per[$k];
                    $item1[$n][]=$old_gst_amt[$k]-$ret_gst_amt;
                    $item1[$n][]=$old_totl[$k]-$ret_tot_amt;

                    $this->db->where('id', $v);
                    $query1 = $this->db->get('product_desc');
                    $na = $query1->row();
                    $stock = $na->stock; 
                    $lesss = $stock - $qty_cl;
                    $product_desc =array('stock'=>$lesss);

                    //$this->db->where('id', $v);
                    //$this->db->update('product_desc', $product_desc);

                    $n++;
                }
                if(!empty($return_itemm)){
                    $result= array_merge($return_itemm,$item);
                }
                else{
                    $result=$item;
                }
                foreach($item1 as $ky => $vl)
                {
                    if($vl[1]!=0)
                    {
                        $re_item[]=$vl;
                    }
                }
                foreach($item12 as $ky12 => $vl12)
                {
                    if($vl12[1]!=0)
                    {
                        $re_item12[]=$vl12;
                    }
                }
                print_r($re_item12);

                if($qty1==$re_qty1){
                    $this->db->query("UPDATE `purchase_order` SET `return_item`='".serialize($result)."',`items`='".serialize($re_item12)."' ,`received`='".serialize($re_item)."' and `status`='1' WHERE id='".$order_id."'"); 
                }
                else
                {
                    $this->db->query("UPDATE `purchase_order` SET `return_item`='".serialize($result)."',`items`='".serialize($re_item12)."' ,`received`='".serialize($re_item)."' WHERE id='".$order_id."'");
                }
                $this->session->set_flashdata('success', 'Item Wise Return successfully.!!!!');
                redirect('ManageOrder');
            }

        }

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/item_wise_cancel');
        $this->load->view('layout/footer');

    }

    public function edit_order()
    {
        $order_id = $this->uri->segment(2);
        $data['title'] = 'Purchase';

        $data['company_row'] = $this->Company_model->get_company();

        $data['purchase_order_row'] = $this->PurchaseModel->get_purchase_order_row($order_id);

        $data['vendor'] = $this->PurchaseModel->fetch_vendor($data['purchase_order_row']->vendor_id);

        $data['head_name']= 'Edit Purchase Order ('.ucwords($data['vendor']->name).')';

        if(!$this->session->userdata('purchase_direct'))
        {
            $purchase_direct = unserialize($data['purchase_order_row']->received);
            $old = unserialize($data['purchase_order_row']->items);
            $this->session->set_userdata('purchase_direct', $purchase_direct);
            $this->session->set_userdata('old', $old);
            $this->session->set_userdata('order', $old);

            $purchase_Rate = array();
            foreach($purchase_direct as $keyt=>$vl)
            {
                $purchase_Rate[] = array($vl[0],$vl[3]);
            }

            $this->session->set_userdata('purchase_Rate', $purchase_Rate);
        }

        if($this->input->post('borcode') == 'borcode')
        {
            $barcode = $this->input->post('barcode');

            $bcd=explode(' ',$barcode);

            if(count($bcd) > 1)
            {
                $pro_id = end($bcd);
            }
            else{
                //$fetchbarcode=mysqli_fetch_assoc(mysqli_query($conn,"select * from product_desc where barcode='".$_POST['barcode']."'"));
                //$pro_id = $fetchbarcode['id'];
                $this->db->where('barcode',$barcode);
                $query = $this->db->get('product_desc');
                $pro_id = $query->row()->id;
            }
            //echo $pro_id;
            $no=0;

            if($this->session->userdata('purchase_direct'))
            {
                foreach($this->session->userdata('purchase_direct') as $key1 => $val1)
                {
                    if($pro_id == $val1[0])
                    {
                        $no++;
                        $this->session->set_flashdata('error', 'This product exist please remove and add....');
                    }
                }
            }
            if($no == 0)
            {
                $this->session->set_userdata('barcode',$pro_id);
            }

        }

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/edit_order');
        $this->load->view('layout/footer');
    }

    function cancel_deal_edit()
    {
        $this->unset_session();
        redirect('ManageOrder');
    }

    public function unset_prod_edit()
    {
        $key = $this->uri->segment(3);
        $pur_id = $this->uri->segment(4);
        $p_id = $this->uri->segment(5);
        $qty = $this->uri->segment(6);

        $array_old=$this->session->userdata('old');

        $array_d=$this->session->userdata('purchase_direct');

        $array_order=$this->session->userdata('order');
        $array_rate=$this->session->userdata('purchase_Rate');

        $no=0;
        $old_stock = array();
        foreach($array_old as $key_lod => $val_old)
        {
            if($val_old[0] == $array_d[$key][0])
            {
                $no++;
                $p_id1[]=$p_id;
                $qty1[]=$qty;
                $old_stock[]=array_merge($p_id1,$qty1);
                unset($array_d[$key]);
                unset($array_order[$key]);
                unset($array_old[$key_lod]);
                unset($array_rate[$key_lod]);
            }

        }
        if($no == 0)
        {
            unset($array_d[$key]); 
            unset($array_order[$key]);
            unset($array_rate[$key]);
        }

        sort($array_d);
        sort($array_old);
        sort($array_order);
        sort($array_rate);

        $this->session->set_userdata('old_stock',$old_stock);

        $this->session->set_userdata('purchase_direct',$array_d);
        $this->session->set_userdata('old',$array_old);
        $this->session->set_userdata('order',$array_order);
        $this->session->set_userdata('purchase_Rate',$array_rate);
        redirect('EditOrder/'.$pur_id);
    }

    public function update_order()
    {
        $order_id = $this->uri->segment(3);

        $idd=$this->input->post('idd');
        $qttyy=$this->input->post('qttyy');
        $frees=$this->input->post('freee');
        $ratess=$this->input->post('ratess');
        $discount=$this->input->post('discount');
        $taxable=$this->input->post('taxable');
        $totalss=$this->input->post('totalss');
        $gst_amtss=$this->input->post('gst_amtss');
        $gst_per=$this->input->post('gst_per');
        $n=0;

        foreach($idd as $keyy=>$vall){
            $rec_order[$n][]=$vall;
            $rec_order[$n][]=$qttyy[$keyy];
            $rec_order[$n][]=$frees[$keyy];
            $rec_order[$n][]=$ratess[$keyy];
            $rec_order[$n][]=$discount[$keyy];
            $rec_order[$n][]=$taxable[$keyy];
            $rec_order[$n][]=$gst_per[$keyy];
            $rec_order[$n][]=$gst_amtss[$keyy];
            $rec_order[$n][]=$totalss[$keyy];
            $n++;
        }

        $odr=serialize($this->session->userdata('order'));
        $purchase=serialize($rec_order);

        $update = array(
            "items" => $odr,
            "received" => $purchase,
            "total_amt" => $this->input->post('total_amount')
        );

        $result = $this->PurchaseModel->update_order($update,$order_id);
        if($result == true)
        {
            foreach($this->session->userdata('purchase_Rate') as $k => $v)
            {
                $product_desc =array('purchase_rate'=>$v[1]);

                $this->db->where('id', $v[0]);
                $this->db->update('product_desc', $product_desc);
            }

            $this->session->unset_userdata('vendor_name');
            $this->session->unset_userdata('product_id');
            $this->session->unset_userdata('weight');

            $this->session->unset_userdata('purchase_order');
            $this->session->unset_userdata('order');
            $this->session->unset_userdata('barcode');
            $this->session->unset_userdata('purchase_Rate');

            $this->session->set_userdata('success', 'update successfully.....');
            redirect('ManageOrder');
        }

    }

    public function manage_hold_order()
    {
        $data['title'] = 'Purchase';
        $data['head_name']= 'Hold Purchase Order';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
        }
        else
        {
            $frmdate = date("Y-m-01"); 
            $todate = date("Y-m-d");
        }

        $data['frmdate'] = $frmdate;
        $data['todate'] = $todate;

        $data['hold_order'] = $this->PurchaseModel->get_hold_order($frmdate,$todate);

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/manage_hold_order');
        $this->load->view('layout/footer');

    }


    public function View_hold_order()
    {
        $ord_id = $this->input->get();

        $data = $this->PurchaseModel->get_order_hold($ord_id['desc_id']);

        echo json_encode($data);
    }

    public function process_hold_order()
    {
        $order_id = $this->uri->segment(2);
        $data['title'] = 'Purchase';

        $data['company_row'] = $this->Company_model->get_company();

        $data['hold_order_row'] = $this->PurchaseModel->get_hold_order_row($order_id);

        $data['vendor'] = $this->PurchaseModel->fetch_vendor($data['hold_order_row']->vendor_id);

        $data['head_name']= 'Edit Purchase Order ('.ucwords($data['vendor']->name).')';

        if(!$this->session->userdata('edit_hold'))
        {
            $purchase_direct = unserialize($data['hold_order_row']->received);
            //print_r($purchase_direct);
            $old = unserialize($data['hold_order_row']->items);
            $this->session->set_userdata('edit_hold', 1);
            $this->session->set_userdata('purchase_direct', $purchase_direct);
            $this->session->set_userdata('order', $old);
        }

        if($this->input->post('borcode') == 'borcode')
        {
            $barcode = $this->input->post('barcode');

            $bcd=explode(' ',$barcode);

            if(count($bcd) > 1)
            {
                $pro_id = end($bcd);
            }
            else{
                $this->db->where('barcode',$barcode);
                $query = $this->db->get('product_desc');
                $pro_id = $query->row()->id;
            }
            $no=0;

            if($this->session->userdata('purchase_direct'))
            {
                foreach($this->session->userdata('purchase_direct') as $key1 => $val1)
                {
                    if($pro_id == $val1[0])
                    {
                        $no++;
                        $this->session->set_flashdata('error', 'This product exist please remove and add....');
                    }
                }
            }
            if($no == 0)
            {
                $this->session->set_userdata('barcode',$pro_id);
            }

        }

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/edit_hold_order');
        $this->load->view('layout/footer');
    }


    function cancel_hold_edit()
    {
        $this->unset_session();
        redirect('HoldPurchaseOrder');
    }

    public function unset_prod_edit_hold()
    {
        $key = $this->uri->segment(3);
        $pur_id = $this->uri->segment(4);

        $array_d=$this->session->userdata('purchase_direct');

        $array_order=$this->session->userdata('order');
        //print_r($array_d); echo nl2br("\n");
        unset($array_d[$key]); 
        unset($array_order[$key]);

        //print_r($array_d); echo nl2br("\n");
        sort($array_d);
        sort($array_order);

        $this->session->set_userdata('purchase_direct',$array_d);
        $this->session->set_userdata('order',$array_order);
        redirect('ProcessHoldOrder/'.$pur_id);
    }

    public function update_hold_order()
    {
        $order_id = $this->uri->segment(3);

        $vendor_data = $this->PurchaseModel->get_hold_order_row($order_id);

        $idd=$this->input->post('idd');
        $qttyy=$this->input->post('qttyy');
        $frees=$this->input->post('freee');
        $ratess=$this->input->post('ratess');
        $discount=$this->input->post('discount');
        $taxable=$this->input->post('taxable');
        $totalss=$this->input->post('totalss');
        $gst_amtss=$this->input->post('gst_amtss');
        $gst_per=$this->input->post('gst_per');
        $n=0;

        foreach($idd as $keyy=>$vall){
            $rec_order[$n][]=$vall;
            $rec_order[$n][]=$qttyy[$keyy];
            $rec_order[$n][]=$frees[$keyy];
            $rec_order[$n][]=$ratess[$keyy];
            $rec_order[$n][]=$discount[$keyy];
            $rec_order[$n][]=$taxable[$keyy];
            $rec_order[$n][]=$gst_per[$keyy];
            $rec_order[$n][]=$gst_amtss[$keyy];
            $rec_order[$n][]=$totalss[$keyy];
            $n++;
        }

        $odr=serialize($this->session->userdata('order'));
        $purchase=serialize($rec_order);

        $update = array(
            "items" => $odr,
            "received" => $purchase,
            "total_amt" => $this->input->post('total_amount')
        );

        //print_r($this->input->post('receipt')); echo nl2br("\n");
        //print_r($this->input->post('sel_date')); echo nl2br("\n");

        if($this->input->post('order') == 'order')
        {
            $order_arr = array(
                "vendor_id" => $vendor_data->vendor_id,
                "date" => date("Y-m-d",strtotime($this->input->post('sel_date'))),
                "items" => $odr,
                "received" => $purchase,
                "user" => $this->session->userdata('auth')->role,
                "date_time" => date("Y-m-d H:i:s"),
                "receipt" => $this->input->post('receipt'),
                "total_amt" => $this->input->post('total_amount')
            );

            //print_r($order_arr); echo nl2br("\n"); exit;
            $inv_no = $this->input->post('receipt');
            $in_date = date("Y-m-d", strtotime($this->input->post('sel_date')));
            $result1 = $this->PurchaseModel->insert_order($order_arr,$inv_no,$in_date);
            if($result1 > 0)
            {
                $product_desc =array('purchase_rate'=>$v[1]);

                $this->db->where('id', $order_id);
                $this->db->delete('hold_order');
                $this->session->set_flashdata('success', 'Order save successfully.!!!!');
                $this->unset_session();
                redirect('HoldPurchaseOrder');
            }
        }
        elseif($this->input->post('update_hold') == 'update_hold')
        {
            $result = $this->PurchaseModel->update_hold_order($update,$order_id);
            if($result == true)
            {
                $this->session->set_userdata('success', 'update successfully.....');
                $this->unset_session();
                redirect('HoldPurchaseOrder');
            }
        }
    }

    public function purchase_summary()
    {
        $data['title'] = 'Purchase';
        $data['head_name']= 'Purchase Summary';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
        }
        else
        {
            $frmdate = date("Y-m-01"); 
            $todate = date("Y-m-d");
        }

        $data['frmdate'] = $frmdate;
        $data['todate'] = $todate;

        $data['purchase_order'] = $this->PurchaseModel->all_purcahse_order($frmdate,$todate);

        //print_r($data['purchase_order']); exit;

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/purchase_summary');
        $this->load->view('layout/footer');

    }

    public function excel_summary()
    {
        $frmdate = $this->uri->segment(3);
        $todate = $this->uri->segment(4);

        $data['title'] = 'Purchase';
        $data['head_name']= 'Excel Summary';
        $data['company_row'] = $this->Company_model->get_company();

        $data['frmdate'] = $frmdate;
        $data['todate'] = $todate;

        $data['purchase_order'] = $this->PurchaseModel->all_purcahse_order($frmdate,$todate);

        ///print_r($data['purchase_order']); exit;

        $this->load->view('PurchaseOrder/excel_summary',$data);
    }

    public function itemwise_purchase_summary()
    {
        $data['title'] = 'Purchase';
        $data['head_name']= 'Purchase Summary';
        $data['company_row'] = $this->Company_model->get_company();

        if($this->input->post())
        {
            $frmdate = date("Y-m-d", strtotime($this->input->post('from_date')));
            $todate = date("Y-m-d", strtotime($this->input->post('to_date')));
        }
        else
        {
            $frmdate = date("Y-m-01"); 
            $todate = date("Y-m-d");
        }

        $data['frmdate'] = $frmdate;
        $data['todate'] = $todate;

        $data['purchase_order'] = $this->PurchaseModel->all_purcahse_order_fetch($frmdate,$todate);
        $data['product_desc'] = $this->PurchaseModel->get_product();

        //print_r($data['product_desc']); 
//        exit;

        $this->load->view('layout/header',$data);
        $this->load->view('PurchaseOrder/item_wise_purchase');
        $this->load->view('layout/footer');


    }


}