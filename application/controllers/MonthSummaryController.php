<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonthSummaryController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->logged_in();

        $this->load->model('Company_model','company');
        $this->load->model('MonthSummaryModel');
        $this->load->model('CommenModel');

        $this->load->helper('user_helper');
    }

    private function logged_in() {
        if(! $this->session->userdata('auth')) {
            redirect('login');
        }
    }

    public function month_summary()
    {
        $data['title'] = 'Month Summary Report';
        $data['head_name'] = 'Month Summary Report';

        $data['company_row'] = $this->company->get_company();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/datatable');
        $this->load->view('MonthSummary/month_summary');
        $this->load->view('layout/footer');
    }

    function fetch_data()
    {
        if(!$this->input->is_ajax_request())
        {
            $data = array('response'=>'error','message'=> 'data not found');
        }
        else
        {
            $frm_dt = $this->input->post('frm_dt');
            $to_dt = $this->input->post('to_dt');

            $date = $frm_dt;
            $end_date = $to_dt;
            $s=0;
            $row_date = array();
            while (strtotime($date) <= strtotime($end_date)) {
                //voucher
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));

                $row_voucher = $this->MonthSummaryModel->fetch_voucher($date);
                if($row_voucher)
                {
                    foreach($row_voucher as $voucher)
                    {
                        $row_date[]=date("d-m-Y",strtotime($voucher->date)); 
                        $row_name[]=$voucher->id.'-'.ucwords($voucher->vendor_name);
                        $row_debit[]=$voucher->total;
                        $row_credit[]=0;
                    }
                }

                //purchaser
                $row_purchase_order = $this->MonthSummaryModel->fetch_purchase_order($date);
                if($row_purchase_order)
                {
                    foreach($row_purchase_order as $purchase)
                    {
                        //print_r($purchase); echo nl2br("\n");
                        $etem1=unserialize($purchase->received);
                        $s=0;
                        $tot_tamt=0;
                        $tot_totamt=0;
                        $tot_cgst=0;
                        $tot_sgst=0;
                        $tot_igst=0;
                        foreach($etem1 as $key1=>$val1)
                        { 
                            $tot1=0;
                            $rtcal11=$val1[3]-(($val1[3]*$val1[4])/100);
                            $tot1=$rtcal11*($val1[1]+$val1[2]);

                            $this->db->where('product_desc.id', $val1[0]);
                            $this->db->join('product','product_desc.product_id =product.product_id');
                            $fetch13 = $this->db->get('product_desc')->row();

                            $hsn[]=$fetch13->hsn;
                            $taxamt[]=$tot1;
                            $gst[]=$fetch13->i_gst;
                        }

                        $array3  = $this->CommenModel->array_combine_($hsn,$taxamt,$gst);  
                        unset($hsn);
                        unset($taxamt);
                        unset($gst);
                        $n2=1; 
                        foreach($array3 as $key2=>$val2)
                        { 
                            $sum =0 ;
                            $count=count($val2); 
                            for($ij=0; $ij<$count; $ij=$ij+2)
                            {
                                $sum += $val2[$ij];
                            }
                            if($sum=='')
                            {
                                $sum1 = $sum;
                            }else
                            {  
                                $sum1 = $sum;
                                $sum=0;
                            }       
                            $item1[$n2]['hsn'] = $key2;
                            $item1[$n2]['tax'] = $sum1;
                            $item1[$n2]['gst'] = $val2[1];
                            $n2++;   
                        }
                        $item1 ; 
                        unset($hsns);
                        unset($taxamts);
                        unset($gsts);

                        $c_gst=0;
                        $s_gst=0;
                        $i_gst=0;
                        foreach($item1 as $k => $v)
                        {
                            $igst= $v['tax']*($v['gst']/100); $i_gst +=$igst;
                        }
                        $total=0;
                        $count= count($etem1);
                        foreach($etem1 as $key => $val) 
                        {
                            $s++; 
                            $tot1=0;
                            $rtcal=$val[3]-(($val[3]*$val[4])/100);
                            $tot1=$rtcal*($val[1]);
                            $total +=$tot1;
                        }
                        $totalgst=$i_gst;
                        $tot=($total+$totalgst);
                        $tot1= round($tot) ;


                        $row_date[]=date("d-m-Y",strtotime($purchase->date));
                        $row_name[]=$purchase->inv_no.'-'.ucwords($purchase->v_name);
                        $row_debit[]=$tot1;
                        $row_credit[]=0;

                    }
                }

                //sales

                $row_sales_log = $this->MonthSummaryModel->fetch_sales_log($date);

                if($row_sales_log)
                {
                    foreach($row_sales_log as $sales_log)
                    {
                        $row_date[]=date("d-m-Y",strtotime($sales_log->date_time));
                        $row_name[]=$sales_log->id.'-'.ucwords($sales_log->p_name);
                        $row_debit[]=0;
                        $row_credit[]=$sales_log->deposit;
                    }
                }

                foreach($row_date as $ky => $val)
                {
                    $row_data[$ky]['date']=$val;
                    $row_data[$ky]['name']=$row_name[$ky];
                    $row_data[$ky]['debit']=$row_debit[$ky];
                    $row_data[$ky]['credit']=$row_credit[$ky];
                }
//                ksort($row_data);

            }


            $data = array('response'=>'success','message'=> $row_data);
        }

        echo json_encode($data);
    }


}
?>