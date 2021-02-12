<?php
error_reporting(0);
ob_start();
date_default_timezone_set('Asia/Kolkata');

$company_row;
$all_count;
$sale_row;
$party_row;
$count;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
            body {
                /*background: rgb(204,204,204); */
            }
            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                /*box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
            }
            page[size="A5"] {  
                width: 21cm;
                min-height: 13cm;  
            }
            page[size="A5"][layout="portrait"] {
                width: 29.7cm;
                height: 21cm;  
            }
            @media print {
                body, page {
                    margin: 0;
                    box-shadow: 0;
                }
            }
        </style>
        <link rel="stylesheet" href="../estimate/css/estimate.css"> 
    </head>
    <body>
        <?php

        ?>
        <page size="A5">
            <form method="post" enctype="multipart/form-data">

                <div style="border:1px solid black;">
                    <table align="center" style="width:100%;" cellspacing="0" cellpadding="0">
                        <tr>
                            <!--                            <td>&nbsp;</td>-->
                            <td  style="text-align:right; font-size:14px;"><b>TAX INVOICE</b> </td>
                            <td  style="text-align:right; font-size:10px;"> <span>Original Copy</span>&nbsp;   </td>
                        </tr>
                        <tr>
                            <!--<td width="" style="border-top:1px solid black;vertical-align: top;">
<img src="../company_master/<?php echo $company_row->logo_image; ?>" style="padding-left:5px;" width="180px" height="50px">
</td>-->
                            <?php 
                            /*$sel_com2 = "select * from company_master";
                $que_com2 = mysqli_query($conn,$sel_com2);
                $fet_com2=mysqli_fetch_assoc($que_com2); 

                $sel_party = "select * from manage_party where id='".$rows['party_id']."'";
                $que_party = mysqli_query($conn,$sel_party);
                $fet_party=mysqli_fetch_assoc($que_party); 

                $total_amt=0;
                $select="select * from sales where party_id='".$rows['party_id']."'  and id!='".$value."'";
                $query=mysqli_query($conn,$select);

                while($fetch=mysqli_fetch_assoc($query))
                {
                    if($fetch['return_amt'] > 0 && $fetch['return'] !== '')
                    {
                        $total=$fetch['total_amt']-$fetch['receive_amt']-$fetch['return_amt'];
                    }
                    else
                    {
                        $total=$fetch['total_amt']-$fetch['receive_amt'];
                    }
                    $total; 
                    $total_amt +=$total;
                }*/
                            ?>
                            <td style="width:50%; font-size:21px; text-align:center; text-transform:capitalize;border-top:1px solid black;vertical-align: top;">
                                <table style="width : 100%;">
                                    <tr>
                                        <td colspan="2">
                                            <b><?php echo $company_row->company_name;?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size: 11px;">
                                            <?php echo $company_row->company_address;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size: 11px;">
                                            <b>Tel No. </b> <?php echo $company_row->company_phone;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size: 11px;">
                                            <b>&nbsp;GST IN NO. </b><?php echo $company_row->gst_no;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size: 11px;">
                                            <b>FSSAI No.</b> <?php echo $company_row->fssai_no;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 10px; text-align : left;">
                                            &nbsp;<b>Available Credit :</b> <?php echo $party_row->credit_type;?>
                                        </td>
                                        <?php 
                                        $total_amt=0;

                                        $id = $this->uri->segment(3);

                                        $p_id = $sale_row->party_id;

                                        $total_amt = $this->SaleModel->all_sale_total($p_id, $id);
                                        ?>
                                        <td style="font-size: 10px; text-align : right;">
                                            <b>Previous Bal :</b> <?php echo $total_amt;?> &nbsp;
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td style="width:%; border:1px solid black; vertical-align: top;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr >
                                        <td style="text-align:left; font-size:10px; width:%;"><b>&nbsp;BILL NO.</b><?php echo  id;?></td>
                                        <td colspan="2" style="text-align:center; font-size:10px;"><b>BILL DATE :</b><?php echo date("d-m-Y" ,strtotime($sale_row->date));?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-top:1px solid; font-size:12px; "><b style="text-transform:capitalize;">&nbsp;BILL TO : </b> <?php echo ucwords($party_row->name);?></td>
                                        <?php

                                        $qr_code = $sale_row->id.'@'.$sale_row->bill_no.'@'.ucwords($party_row->name).'@'.$sale_row->total_amt.'@'.date("d-m-Y", strtotime($sale_row->date));
                                        ?>
                                        <td rowspan="5" style="border-top:1px solid; width: 18%;">
                                            <img src="https://chart.googleapis.com/chart?chs=75x75&cht=qr&chl=<?php echo $qr_code;?>&choe=UTF-8" title="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size:10px; text-transform:capitalize;"> &nbsp;<?php echo $party_row->address;?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10px; width:35%;"><b>&nbsp;Ph No.</b> <?php echo ucwords($party_row->contact_no);?></td>
                                        <td colspan="" style="font-size:10px;"><b>&nbsp;PLACE : </b><?php echo ucwords($party_row->city.', '.$party_row->state_name);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10px;"><b>&nbsp;GSTIN NO. <?php echo ucwords($party_row->gst_in);?></b></td>
                                        <?php
                                        $n= $party_row->limit_days;

                                        $enddate = date("Y-m-d",strtotime($n.'day', strtotime( date("Y-m-d"))));
                                        ?>
                                        <td colspan=" " style="font-size:10px; text-transform:capitalize;">&nbsp;<b>Sales Executive : </b><?php echo $enddate; ?></td>
                                        <!--<td colspan=" " style="font-size:10px; text-transform:capitalize;">&nbsp;<b>Due date : </b><?php echo $enddate; ?></td>-->
                                    </tr>
                                    <tr>
                                        <td colspan=" " style="font-size:10px;"><b style="text-transform:capitalize;">&nbsp;FSSAI No : </b> <?php echo  $party_row->fssai_no;?></td>
                                        <td colspan=" " style="font-size:10px;"><b style="text-transform:capitalize;">&nbsp;Landmark : </b> <?php echo  $party_row->landmark;;?></td>
                                        <!--<td colspan=" " style="font-size:10px;"><b style="text-transform:capitalize;">&nbsp;Previous Bal : </b> <?php ?></td>-->
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <table width="100.1%" style="text-align:center; " cellspacing="0" cellpadding="0">
                                <tr style="background-color:#DBDBDB;">
                                    <td style="font-size:11px; border:1px solid #000; width:4%;"><b>SR<br/>#</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:35%; text-align:left; padding-left:1%;"><b>PRODUCT NAME</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>HSN</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>GST %</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Unit</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>MRP</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Rate</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>QTY</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:4%;"><b>Free</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Disc.<br/>%</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Disc. Amt</b></td>
                                    <td style="font-size:11px; border:1px solid #000; width:8%;"><b>Amount</b></td>
                                </tr>
                                <?php

                                $s=0;
                                $total=$gst_total=0;

                                $item= unserialize($sale_row->item_detail);
                                $count= count($item);
                                //print_r($item);exit;
                                foreach($item as $key => $val) 
                                { 
                                    $s++;
                                    //$pro_id = $val['pro_id'];
                                    //$value = $this->salemodule->search_prod($pro_id);
                                ?>
                                <tr>
                                    <td style="font-size:11px; border:1px solid #000;"><?php echo $s; ?></td>
                                    <td style="font-size:11px; border:1px solid #000; text-align:left; padding-left:1%; text-transform:capitalize;">
                                        <?php 

                                    $this->db->where('id', $val[0]);
                                    $query = $this->db->get('product_desc');

                                    $fetch11 = $query->row();

                                    $this->db->where('product_id', $fetch11->product_id);
                                    $query2 = $this->db->get('product');

                                    $fetch111 = $query2->row();
                                    echo $fetch111->name." ".$fetch11->weight;
                                        ?>
                                    </td>
                                    <td style="font-size:11px; border:1px solid #000;"><?php  echo $val[5]; ?></td>
                                    <td style="font-size:11px; border:1px solid #000;"><?php echo $fetch111->i_gst;?>%</td>
                                    <td style="font-size:11px; border:1px solid #000;"><?php  ?></td>
                                    <td style="font-size:11px; border:1px solid #000; text-align:right;"><?php echo  $fetch11->mrp ; ?>&nbsp; </td>
                                    <td style="font-size:11px; border:1px solid #000; text-align:right;"><?php echo  $val[2] ; ?>&nbsp; </td>
                                    <td style="font-size:11px; border:1px solid #000;"><?php  echo $val[1]; ?></td>
                                    <td style="font-size:11px; border:1px solid #000;"><?php  echo $val[3]; ?></td>
                                    <td style="font-size:11px; border:1px solid #000;"><?php echo $val[4]; ?></td>
                                    <td style="font-size:11px; border:1px solid #000;">
                                        <?php echo $disc; ?>
                                    </td>
                                    <td style="font-size:11px; border:1px solid #000; text-align:right;"><?php echo round($val[6],2   );?>&nbsp;</td>
                                </tr>

                                <?php  $total +=$val[6];
                                }

                                ?>

                                <?php
                                if($count !== 10)
                                {
                                    for($count; $count <= 10; $count++)
                                    {
                                ?>   
                                <tr>
                                    <td style="font-size:11px;  "></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000;"></td>
                                    <td style="font-size:11px; border-left:1px solid #000; text-align:right;">&nbsp;</td>
                                </tr>
                                <?php    
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="12" style="border-top: 1px solid;">
                                        <table width=100% cellspacing="0" cellpadding="">
                                            <tr>
                                                <td rowspan="7" style="width:75%;"  >
                                                    <table cellspacing="0" cellpadding="0" style="margin-left:8px; margin-top:;">
                                                        <tr>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><b>&nbsp;HSN</b></td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><b>&nbsp;GST %</b></td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><b>TAXABLE RS</b></td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><b>C GST RS</b></td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><b>S GST RS</b></td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><b>I GST RS</b></td>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            $tax_detail= unserialize($sale_row->tax_detail);
                                                            //print_r($tax);
                                                            foreach($tax_detail as $k => $v)
                                                            {
                                                                $gst_tot += $v['tax']*($v['gst']/100);
                                                            ?>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><?php echo $v['hsn'];?></td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;">
                                                                <?php echo $v['gst']; ?>
                                                            </td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;"><?php echo $v['tax'];?></td>

                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;">
                                                                <?php 
                                                                if($party_row->state_id == $company_row->company_state){                                              
                                                                    echo $v['tax']*($v['gst']/100)/2;

                                                                }
                                                                else{
                                                                    echo "- - -";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;">
                                                                <?php
                                                                if($party_row->state_id == $company_row->company_state){                                              
                                                                    echo $v['tax']*($v['gst']/100)/2;
                                                                }
                                                                else{
                                                                    echo "- - -";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td style="font-size:11px; text-align:center; border:1px solid #000;">
                                                                <?php 
                                                                if($party_row->state_id != $company_row->company_state) { 
                                                                    echo $v['tax']*($v['gst']/100);
                                                                }
                                                                else{
                                                                    echo "- - -";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php } 
                                                            $gst_total = $total + $gst_tot;
                                                        ?>

                                                    </table>
                                                </td>
                                                <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000; width:12%; padding-top:0.5%;"><b>&nbsp;SUB TOTAL RS</b></td>
                                                <td style="font-size:11px; text-align:right;"><?php echo $total; ?>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp; </b></td>
                                                <td style="font-size:11px;"><b> </b></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp; </b></td>
                                                <td style="font-size:11px;"><b> </b></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp; </b></td>
                                                <td style="font-size:11px;"><b> </b></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp;GST AMOUNT</b></td>
                                                <td style="font-size:11px; text-align:right;" ><?php echo $gst_tot;?>&nbsp;</td>
                                            </tr>
                                            <?php $tot=($total+$gst_tot);
                                            $tot1= round($tot) ;  
                                            ?>

                                            <tr style="">
                                                <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB;"><b>&nbsp;BILL R/O RS.</b></td>
                                                <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB; text-align:right;"><b><?php echo $g_tot = $gst_total; ?> &nbsp;</b></td>
                                            </tr>
                                            <tr style="">
                                                <td colspan="" style="text-align:left; padding-right:1%; font-size:11px; border:1px solid #000; background-color:# ;"><b>&nbsp;Cash Discount <?php echo $sale_row->cod_percent;?>%</b></td>
                                                <td style="font-size:11px; border:1px solid #000; background-color:# ; text-align:right;"><b><?php 
                                                    $cod=round(($tot1*$sale_row->cod_percent)/100);
                                                    echo round($cod,2); ?> &nbsp;</b></td>
                                            </tr>
                                            <tr style="">
                                                <td style="font-size:11px; "><b>&nbsp; In-words  </b><?php echo $this->CommenModel->convertToIndianCurrency($tot1-$cod);?> Rupees.</td>
                                                <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB;"><b>&nbsp;Total Bill R/O RS.</b></td>
                                                <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB; text-align:right;"><b><?php echo round(($tot1-$cod),2); ?> &nbsp;</b></td>
                                            </tr>
                                        </table>       
                                    </td>                         
                                </tr>
                            </table>
                        </tr>
                    </table>
                </div>
                <div style="font-size:10px; padding-left:7px;color:#CCC">
                    <?php
                    $val_selsql = $company_row->cd;
                    $ftotal = ($tot1-$cod)-(($tot1-$cod)*($val_selsql/100));
                    echo round($ftotal.AsFloat);
                    ?>
                </div>
                <div style="text-align:left; margin-left:1%; font-size:10px;">All Matters Subject to <b><?php echo ucwords($company_row->company_city);?></b> Jurisdicion.</div>
                <?php 
                if($sale_row->cod_percent > 0  && $sale_row->return_amt == 0)
                {?>
                <div style="text-align:left; margin-left:1%; font-size:11px;"><b>If payment done of cash. Please Pay <i class="fa fa-inr"></i> <?php echo round($sale_row->cod_amt,2); ?> /-.</b></div>
                <?php
                }         
                ?>
                <div style="text-align:left; margin-left:1%; font-size:9px;"> 
                    <ul>
                        <li> I/We Certify that my/our registration under GST Act 2017 is in the forte on the same on which the sale of goods specified in this tax invoice is made by me/us & the transaction of sale covered by this tax invoice has been affected by me/us & shall be accounted for the turnover of the sale while filling return or due on salie is paid or shall be paid.</li>
                    </ul>
                </div>
                <div style="text-align:center;">
                    <table align="center" width="70%" style="text-align:center; " cellspacing="0" cellpadding="10">
                    </table>
                </div>
                <div style="text-align:center;">
                    <table align="center" width="95%" style="text-align:center; " cellspacing="0" cellpadding="0">
                        <tr>
                            <td></td>
                            <td style="border:1px solid #000; font-size:12px;"><b>Total Invoice Amount</b></td>
                            <td style="border:1px solid #000; font-size:12px;"><b>Used Credit Amount</b></td>
                            <td style="border:1px solid #000; font-size:12px;"><b>Total Pay Amount</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; margin-right:1%; font-size:10px; text-transform:capitalize;">
                                <b>Receiver Sign :</b>
                            </td>
                            <td style="border:1px solid #000; font-size:12px;"><?php echo round($tot1,2); ?></td>
                            <td style="border:1px solid #000; font-size:12px;"><?php echo $tot1; ?></td>
                            <td style="border:1px solid #000; font-size:12px;"><?php $tot_val= round($tot1-$party_row->credit_type); 
                                if($tot_val > 0)
                                {
                                    echo $tot_val;
                                }
                                else
                                {
                                    echo $tot_val=0;
                                }
                                ?>
                                <input type="hidden" name="tot_val" value="<?php  echo $tot_val ;?>">
                            </td>
                            <td style="text-align:right; margin-right:1%; font-size:10px; text-transform:capitalize;">
                                <b>For : <?php echo $company_row->company_name;?></b>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <form>
                <?php
                if($party_row->return_amt > 0)
                { 
                ?>
                <div style="border:1px solid black;">
                    <table width="100.1%" style="text-align:center; " cellspacing="0" cellpadding="0">
                        <tr><td colspan="12" style="text-align:center; font-size:12px;"><b>NOTE : Return Product</b></td></tr>
                        <tr>
                            <td style="font-size:11px; border:1px solid #000; width:4%;"><b>SR<br/>#</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:35%; text-align:left; padding-left:1%;"><b>PRODUCT NAME</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>HSN</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>GST %</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Unit</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>MRP</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Rate</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>QTY</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:4%;"><b>Free</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Disc.<br/>%</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Disc. Amt</b></td>
                            <td style="font-size:11px; border:1px solid #000; width:8%;"><b>Amount</b></td>
                        </tr>
                        <?php
                    $s=0;
                    $total1=0;
                    $return=unserialize($sale_row->return_item);
                    foreach($return as $keys => $vals) 
                    { $s++;
                        ?>
                        <tr>
                            <td style="font-size:11px; border:1px solid #ccc;"><?php echo $s; ?></td>
                            <td style="font-size:11px; border:1px solid #ccc; text-align:left; padding-left:1%; text-transform:capitalize;">
                                <?php 
                     /*$select111="select * from product_desc where id='".$vals[0]."'";
                     $query111=mysqli_query($conn,$select111);
                     $fetch111=mysqli_fetch_assoc($query111);

                     $select1111="select * from product  where product_id='".$fetch111['product_id']."'";
                     $query1111=mysqli_query($conn,$select1111);
                     $fetch1111=mysqli_fetch_assoc($query1111);                                             
                     echo $fetch1111['name'].'-'.$fetch111['weight'];*/



                     $this->db->where('id', $vals[0]);
                     $query = $this->db->get('product_desc');

                     $fetch11 = $query->row();

                     $this->db->where('product_id', $fetch11->product_id);
                     $query2 = $this->db->get('product');

                     $fetch111 = $query2->row();
                     echo $fetch111->name." ".$fetch11->weight; ?>
                            </td>
                            <td style="font-size:11px; border:1px solid #ccc;"><?php  echo $vals[5]; ?></td>
                            <td style="font-size:11px; border:1px solid #ccc;"><?php echo $fetch111->i_gst;?>%</td>
                            <td style="font-size:11px; border:1px solid #ccc;"><?php  ?></td>
                            <td style="font-size:11px; border:1px solid #ccc; text-align:right;">
                                <?php echo  round($fetch11->sale_price,2);
                                ?>&nbsp;  
                            </td>
                            <td style="font-size:11px; border:1px solid #ccc; text-align:right;"><?php echo round($vals[2],2); ?>&nbsp; </td>
                            <td style="font-size:11px; border:1px solid #ccc;"><?php  echo $vals[1]; ?></td>
                            <td style="font-size:11px; border:1px solid #ccc;"><?php  echo $vals[3]; ?></td>
                            <td style="font-size:11px; border:1px solid #ccc;"><?php echo $vals[4]; ?></td>
                            <td style="font-size:11px; border:1px solid #ccc;">
                                <?php echo $disc=(($vals[2]*$vals[4])/100)*$vals[1]; ?>
                            </td>
                            <td style="font-size:11px; border:0.5px solid #ccc; text-align:right;"><?php echo round($vals[6],2   );?>&nbsp;</td>
                        </tr> 
                        <?php  $total1 +=$vals[6];
                    }
                        ?>
                        <tr >
                            <table width=100% cellspacing="0" cellpadding="">
                                <tr>
                                    <td rowspan="2" style="width:75%;"  >
                                    </td>
                                    <td style="font-size:11px; border-left:1px solid #ccc; border-right:1px solid #ccc; width:12%; padding-top:0.5%;"><b>&nbsp;SUB TOTAL RS</b></td>
                                    <td style="font-size:11px; border-left:1px solid #ccc; text-align:right;"><?php echo round($total1,2); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="font-size:11px; border-left:1px solid #ccc; border-right:1px solid #ccc;"><b>&nbsp;GST AMOUNT</b></td>
                                    <td style="font-size:11px; border-left:1px solid #ccc; text-align:right;" ><?php 
                    foreach($return as $ks => $vs)
                    {
                        if($party_row->state_id == $company_row->company_state)
                        {
                            $totgst += $vs[7];
                        }
                        else
                        {
                            $totgst += $vs[7] +$vs[8];
                        }
                    }
                    echo $totgst; 
                                        ?>&nbsp;</td>
                                </tr>
                                <?php $tot_r=$total1+$totgst;
                    $tot_rt= round($tot_r) ;  
                                ?>
                                <tr  >
                                    <td style="font-size:11px; "><b>&nbsp; In-words </b><?php echo $this->CommenModel->convertToIndianCurrency($tot_rt);?> Rupees.</td>
                                    <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB;"><b>&nbsp;BILL R/O RS.</b></td>
                                    <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB; text-align:right;"><b><?php echo round($tot_rt,2); ?>&nbsp;</b></td>
                                </tr>
                            </table> 
                        </tr >
                        <tr>&nbsp;
                            <table align="center" width="90%" style="text-align:center; " cellspacing="0" cellpadding="10">
                                <tr>
                                    <td     style="border:1px solid #000; font-size:12px;"><b>Total Invoice Amount</b></td>
                                    <td style="border:1px solid #000; font-size:12px;"><b>Total Return Amount</b></td>
                                    <td style="border:1px solid #000; font-size:12px;"><b>Total Pay Amount</b></td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; font-size:12px;"><?php echo round($tot1,2); ?></td>
                                    <td style="border:1px solid #000; font-size:12px;"><?php echo round($tot_rt,2); ?></td>
                                    <td style="border:1px solid #000; font-size:12px;"><?php echo round($tot1-$tot_rt,2); ?></td>
                                </tr>
                            </table>
                        </tr>
                        &nbsp;
                    </table>
                    <?php 
                    if($sale_row->cod_percent > 0  && $sale_row->return_amt > 0)
                    {?>
                    <div style="text-align:left; margin-left:1%; font-size:11px;"><b>If payment done of cash. Please Pay <i class="fa fa-inr"></i> 
                        <?php 
                        echo $tot1-$tot_rt-(($tot1-$tot_rt*$sale_row->cod_percent)/100);
                        ?> /-.</b></div>
                    <?php
                    }         
                    ?>
                </div>
                <?php
                }
                ?>
            </form>
        </page> 
        <?php $c_plus = $this->uri->segment(3); ?>
        <?php  ?>
        <script>
            function doPrint() {
                window.print();
                setTimeout(function () { window.close(); }, 100);
                <?php
                if($c_plus)
                {
                    $cnt=$c_plus+1;    
                ?>
                var aabb=<?php echo $cnt; ?>;
                setTimeout(function(){document.location.href = "<?php echo site_url('SaleController/all_page/');?>"+aabb},500);
                <?php
                }   
                ?>
            }
            window.onload = doPrint;
        </script>                   

        <?php
        if($count==$all_count)
        {
        ?>
        <script> 
            setTimeout(function(){document.location.href = "<?php echo site_url('AllSales');?>"},500);
        </script>
        <?php
        }
        ?>
    </body>
</html>