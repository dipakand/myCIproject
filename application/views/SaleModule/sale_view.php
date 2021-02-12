<?php $fetchparty ;?>
<?php //print_r($sale_row->id);

//company_row
//sale_row
//party_row
?>
<div class="row">
    <div class="col-lg-12">
        <div class="col-sm-12 col-sm-offset-11">
            <?php  

            $accy_countt=unserialize($sale_row->item_detail);
            $accy_countt1=count($accy_countt);
            if($accy_countt1 > 10){ ?>

            <a href="<?php echo site_url('SaleController/invoice_print/'.$sale_row->id); ?>&view_all=view_all"  class="btn btn-primary btn-sm " title="Invoice Print" target="_blank">Print</a>
            <?php }else{ ?>
            <a href="<?php echo site_url('SaleController/invoice_print/'.$sale_row->id); ?>"  class="btn btn-primary btn-sm " title="Invoice Print"  target="_blank">Print</a>
            <?php } ?>
        </div>  

        <div class="col-sm-12">&nbsp;</div>    
        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/estimate.css">
        <div class="col-sm-12"> 
            <div class="invoice-box">      

                <div style="border:1px solid black;">
                    <table align="center" style="width:100%;" cellspacing="0" cellpadding="0">
                        <tr>
                            <td  style="text-align:right; font-size:14px;"><b>TAX INVOICE</b> </td>
                            <td  style="text-align:right; font-size:10px;"> <span>Customer Copy</span>&nbsp;   </td>
                        </tr>
                        <tr>
                            <td width="50%" style="border:1px solid black;">
                                <?php 
                                $total_amt=0;

                                $id = $this->uri->segment(2);

                                $p_id = $sale_row->party_id;

                                $total_amt = $this->SaleModel->all_sale_total($p_id, $id);
                                ?>
                                <table width="100%" cellpadding="0" cellspacing="2">
                                    <tr><td colspan="2" style="text-align:center; font-size:16px; text-transform:capitalize;"><b><?php echo $company_row->company_name;?></b></td></tr>
                                    <tr><td colspan="2" style="text-align:center; text-transform:capitalize; font-size:12px;"> <?php echo $company_row->company_address;?> </td></tr>
                                    <tr><td colspan="2" style="text-align:center; text-transform:capitalize; font-size:12px;"><b>Tel No. </b><?php echo $company_row->company_phone;?></td></tr>
                                    <tr>
                                        <td colspan="2" width="50%" style="text-align:center;font-size:12px;"><b>&nbsp;GST IN NO. </b><?php echo $company_row->gst_no;?>&nbsp;&nbsp;<b>FSSAI No.</b> <?php echo $company_row->fssai_no;?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="" style="font-size:10px;padding-top:2%;padding-left:2%;"><b>Available Credit.-</b> <?php echo $party_row->credit_type ; ?></td>
                                        <td colspan=" " style="font-size:10px;padding-top:2%;"><b style="text-transform:capitalize;">&nbsp;Previous Bal : </b> <?php echo round($total_amt);?></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border:1px solid black;">

                                <table width="100%" cellspacing="0" cellpadding="0" style="line-height: 18px;">
                                    <tr >
                                        <td style="text-align:left; font-size:10px;"><b>&nbsp;BILL NO.</b> <?php 
                                            if($sale_row->bill_no!='')
                                            {
                                                echo $sale_row->bill_no;
                                            }else{
                                                echo $sale_row->id;
                                            }

                                            ?></td>
                                        <td colspan="2" style="text-align:center; font-size:10px;"><b>BILL DATE :</b> <?php echo date('d-m-Y',strtotime($sale_row->date));?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-top:1px solid; font-size:12px;"><b style="text-transform:capitalize;">&nbsp;BILL TO. <?php echo ucwords($party_row->name);?></b></td>
                                        <?php

                                        $qr_code = $sale_row->id.'@'.$sale_row->bill_no.'@'.ucwords($party_row->name).'@'.$sale_row->total_amt.'@'.date("d-m-Y", strtotime($sale_row->date));
                                        ?>
                                        <td rowspan="5" style="border-top:1px solid; width: 18%;">
                                            <img src="https://chart.googleapis.com/chart?chs=75x75&cht=qr&chl=<?php echo $qr_code;?>&choe=UTF-8" title="" />
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size:10px; text-transform:capitalize;"> &nbsp;<?php echo $party_row->address;?></td>
                                        <?php 
                                        $n= $party_row->limit_days;

                                        $enddate = date("Y-m-d",strtotime($n.'day', strtotime( date("Y-m-d"))));
                                        ?>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10px;"><b>&nbsp;Ph No.</b> <?php echo $party_row->contact_no; ?></td>
                                        <td colspan="" style="font-size:10px;"><b>&nbsp;PLACE : </b>
                                            <?php 
                                            echo ucwords($party_row->city).', '. $party_row->state_name;
                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10px;"><b>&nbsp;GSTIN NO. <?php echo $party_row->gst_in; ?></b></td>
                                        <td style="font-size:10px;"><b>&nbsp;Sales Executive :</b> <?php echo $sale_row->sale_name;
                                            ?></td>

                                    </tr>

                                    <tr>
                                        <td style="font-size:10px;">&nbsp;<b>FSSAI No : </b> <?php echo $party_row->fssai_no; ?></td>
                                        <td style="font-size:10px;">&nbsp;<b>Landmark : </b> <?php echo ucwords($party_row->landmark); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
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
                                    //print_r($item);
                                    foreach($item as $key => $val) 
                                    { 
                                        $s++;
                                        $disc=0;
                                        //$disc=(($val[2]*$val[4])/100)*$val[1];
                                        $per = str_replace('%','',$val[4]);
                                        $disc=(($val[2]*$per)/100)*$val[1];
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
                                    <tr>
                                        <td colspan="12" >
                                            <table width=100% cellspacing="0" cellpadding="0" >
                                                <tr>
                                                    <td rowspan="5" style="width:75%; vertical-align: middle;">
                                                        <table cellspacing="0" cellpadding="0" style="margin-left:8px; margin-top:1%; width: 90%;">
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
                                                                $gst_tot=0;
                                                                 
                                                                $tax=unserialize($sale_row->tax_detail);
                                                                foreach($tax as $k => $v)
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
                                                    <td style="font-size:11px; text-align:right;" ><?php echo $gst_total;?>&nbsp;</td>
                                                </tr>

                                                <tr style="">
                                                    <td style="font-size:11px;"><b>&nbsp; In-word </b><?php  echo $this->CommenModel->convertToIndianCurrency($gst_total); ?> Rupees.</td>
                                                    <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB;"><b>&nbsp;BILL R/O RS.</b></td>
                                                    <td style="font-size:11px; border:1px solid #000; background-color:#DBDBDB; text-align:right;"><b><?php echo $g_tot = $gst_total; ?> &nbsp;</b></td>
                                                </tr>
                                            </table>       
                                        </td>                         
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="text-align:left; margin-left:1%; font-size:11px;">
                    <b style="text-decoration: underline;">Terms & Conditions</b><br>
                    <p style="font-size:11px;">
                        <?php

                        $terms=explode(',',$company_row->tmc);
                        $daysss=0;
                        $no=1;
                        if($daysss!='' and $daysss!=0){

                            echo '<b>'.$no++.'.</b> Due Date is <b>'.date('d-m-Y',strtotime('+'.$daysss.'days',strtotime($sale_row->date))).'.</b><br>';
                        }
                        foreach($terms as $term){
                            echo '<b>'.$no++.'.</b> '.ucfirst($term).'<br>';
                        }
                        /* 
                                //                                                $daysss=$sale_row->due_days'];
                            */
                        ?>

                    </p>
                </div>
                <div style="text-align:right; margin-right:1%; font-size:11px; text-transform:capitalize;"><b>For : <?php echo $company_row->company_name;?></b></div>
            </div> 
        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>

