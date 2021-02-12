<?php
ob_start();
error_reporting(0);
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
        <title>TESTING</title>
    </head>
    <style type="text/css">
        body {
            font-family:Verdana, Arial, Helvetica, sans-serif;
            font-size:15px;
            margin:0px;
            padding:0px;
        }
        table,td,tr{

            border: 1px solid black;
        }
    </style>

    <body>
        <?php

        /*$table='<table class="">';
        $table.='<tr><th colspan="10" width="100%" style="border:1px solid;background-color:#a8d7e2;"><b>Report For The Duration Of Date From '. date("d-m-Y",strtotime($frmdate)).' - to '. date("d-m-Y",strtotime($todate)).'</b></th><tr>';*/

        foreach($purchase_order as $purchase)
        {
        ?>
        <form method="post" enctype="multipart/form-data">
            <div style="border:1px solid #000;">
                <table align="center" style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2"  style="text-align:center; font-size:16px;"><b>TAX INVOICE</b> </td>
                    </tr>
                    <tr>
                        <td style="">
                            <?php 
            $this->db->where('vendor_details.id',$purchase->vendor_id);
            $this->db->select('vendor_details.*, state.state_name');
            $this->db->join('state','vendor_details.state = state.state_id');
            $quer1 = $this->db->get('vendor_details');
            $fet_vender = $quer1->row();

                            ?>
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr >
                                    <td style="text-align:left; font-size:12px; border:1px solid #000; border-left:none;"><b>&nbsp;BILL NO.</b> <?php echo $purchase->receipt?></td>
                                    <td style="text-align:center; font-size:12px; border:1px solid #000; border-right:none;"><b>BILL DATE :</b> <?php echo date('d-m-Y',strtotime($purchase->date));?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top:1px solid; font-size:15px;"><b style="text-transform:capitalize;">&nbsp;<?php echo ucwords($fet_vender->name);?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="font-size:12px; text-transform:capitalize;">&nbsp;<b>Add.</b> <?php echo $fet_vender->address;?></td>
                                    <td colspan=" " style="font-size:12px; text-transform:capitalize;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:12px;"><b>&nbsp;Ph No.</b> <?php echo $fet_vender->contact; ?></td>
                                    <td colspan="" style="font-size:12px;"><b>&nbsp;PLACE OF SUPPLY : </b> <?php echo ucwords($fet_vender->city).", ".$fet_vender->state_name; ?> </td>
                                </tr>
                                <tr>
                                    <td style="font-size:12px;"><b>&nbsp;GSTIN NO.</b> <?php echo $fet_vender->gstin; ?></td>
                                    <td style="font-size:12px;">&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="50%" style="border:1px solid #000;">
                            <table width="100%" cellpadding="0" cellspacing="2">
                                <tr><td style="text-align:center; font-size:15px; text-transform:capitalize;"><b><?php echo $company_row->company_name;?></b></td></tr>
                                <tr><td style="text-align:center; font-size:12px; text-transform:capitalize;"> <?php echo $company_row->company_address;?> </td></tr>
                                <tr><td style="text-align:center; font-size:12px; text-transform:capitalize;"><b>Tel No. </b><?php echo $company_row->company_phone;?></td></tr>
                                <tr><td style=" text-align:center; font-size:12px; text-align:justified ;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%" style="font-size:12px; text-align:center;"><b>&nbsp;GST IN NO. </b><?php echo $company_row->gst_no;?></td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <table width="100.1%" style="text-align:center; " cellspacing="0" cellpadding="0">
                            <tr style="background-color:#DBDBDB;">
                                <td style="font-size:11px; border:1px solid #000; width:4%;"><b>SR #</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:35%; text-align:left; padding-left:1%;"><b>PRODUCT NAME</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:6%;"><b>HSN</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:6%;"><b>GST %</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:6%;"><b>MRP</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:6%;"><b>Disc%</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:6%;"><b>RATE</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:6%;"><b>QTY</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:6%;"><b>FREE</b></td>
                                <td style="font-size:11px; border:1px solid #000; width:8%;"><b>Amount</b></td>
                            </tr>
                            <?php
            $s=0;
            $total=0;
            $etem1=unserialize($purchase->received);
            $count= count($etem1);
            $re_co=0;
            foreach($etem1 as $key => $val) 
            {
                $s++; 
                $tot1=0;
                $rtcal=$val[3]-(($val[3]*$val[4])/100);
                $tot1=$rtcal*$val[1];

                            ?>
                            <tr>
                                <td style="font-size:11px; border:1px solid #ccc;"><?php echo $s; ?></td>
                                <td style="font-size:11px; border:1px solid #ccc; text-align:left; padding-left:1%; text-transform:capitalize;">
                                    <?php 
                $this->db->where('product_desc.id',$purchase->vendor_id);
                $this->db->select('product_desc.*, product.name as prod_name, product.hsn, product.i_gst');
                $this->db->join('product','product_desc.product_id = product.product_id');
                $quer2 = $this->db->get('product_desc');
                $fetch11 = $quer2->row();
                echo $fetch11->prod_name.'-'.$fetch11->weight; ?>
                                </td>
                                <td style="font-size:11px; border:1px solid #ccc;"><?php  echo $fetch11->hsn; ?></td>
                                <td style="font-size:11px; border:1px solid #ccc;"><?php echo $fetch11->i_gst;?>%</td>
                                <td style="font-size:11px; border:1px solid #ccc; text-align:;"><?php echo $fetch11->mrp;?>&nbsp;</td>
                                <td style="font-size:11px; border:1px solid #ccc; text-align:;"><?php echo $val[4];?>&nbsp;</td>
                                <td style="font-size:11px; border:1px solid #ccc; text-align:;"><?php echo  round($rtcal,2);?>&nbsp;</td>
                                <td style="font-size:11px; border:1px solid #ccc;"><?php  echo $val[1]; ?></td>
                                <td style="font-size:11px; border:1px solid #ccc;"><?php  echo $val[2]; ?></td>
                                <td style="font-size:11px; border:1px solid #ccc; text-align:right;"><?php echo round($tot1,2);?>&nbsp;</td>
                            </tr> 
                            <?php
                $hsn[]=$fetch11->hsn;
                $taxamt[]=$tot1;
                $gst[]=$fetch11->i_gst;
                $total +=$tot1;
            }
            if($count !== 12)
            {
                for($count; $count <= 12; $count++)
                {
                            ?>   
                            <tr>
                                <td style="font-size:11px;  "></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc;"></td>
                                <td style="font-size:11px; border-left:1px solid #ccc; text-align:right;">&nbsp;</td>
                            </tr>
                            <?php    
                }
            }
                            ?>
                            <tr>
                                <table width=100% cellspacing="0" cellpadding="0" >
                                    <tr>
                                        <td rowspan="5" style="width:75%; border-top:1px solid #000; padding-bottom:2%;">
                                            <table cellspacing="0" cellpadding="0" style="margin-left:8px; margin-top:0.5%; width:60%;">
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

            $array3  = $this->CommenModel->array_combine_($hsn,$taxamt,$gst);  
            $n2=1; 
            foreach($array3 as $key2=>$val2)
            { 
                $sum = 0;
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

            $c_gst=0;
            $s_gst=0;
            $i_gst=0;
            foreach($item1 as $k => $v)
            {
                $igst= $v['tax']*($v['gst']/100); 
                $i_gst +=$igst;
                                                    ?>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"><?php echo $v['hsn'];?></td>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;">
                                                        <?php
                echo $v['gst'];
                                                        ?>
                                                    </td>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"><?php echo $v['tax'];?></td>
                                                    <?php 
                if($company_row->company_state == $fet_vender->state){ ?>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"><?php 
                    $cgst= $v['tax']*(($v['gst']/2)/100);
                    echo round($cgst,2);
                                                        ?></td>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"><?php 
                    $sgst= $v['tax']*(($v['gst']/2)/100);
                    echo round($sgst,2);
                                                        ?></td>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"> - - - </td>
                                                    <?php } else {?>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"> - - - </td>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"> - - - </td>
                                                    <td style="font-size:11px; text-align:center; border:1px solid #ccc;"><?php 
                    echo round($igst,2);
                                                        ?></td>
                                                    <?php }?>
                                                </tr>
                                                <?php
            }
                                                ?>
                                            </table>
                                        </td>
                                        <td style="font-size:11px; border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; width:12%; padding-top:0.5%;"><b>&nbsp;SUB TOTAL RS</b></td>
                                        <td style="font-size:11px; border-top:1px solid #000;  text-align:right;"><?php echo round($total,2); ?>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:11px;  border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp; </b></td>
                                        <td style="font-size:11px;"><b> </b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp; </b></td>
                                        <td style="font-size:11px;"><b> </b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp;  <?php  //$purchase->?></b></td>
                                        <td style="font-size:11px; text-align:right;"> <?php  //round($purchase->,2);?> </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:11px; border-left:1px solid #000; border-right:1px solid #000;"><b>&nbsp;GST AMOUNT</b></td>
                                        <td style="font-size:11px; text-align:right;" ><?php 
            $totalgst=$i_gst;
            echo round($totalgst,2);
                                            ?>&nbsp;</td>
                                    </tr>
                                    <?php $tot=($total+$totalgst);
            $tot1= round($tot) ;  
                                    ?>
                                    <tr style="">
                                        <td style="font-size:11px; border-top:1px solid #000;"><b>&nbsp; In-words  </b><?php echo $this->CommenModel->convertToIndianCurrency($tot1);?> Rupees.</td>
                                        <td style="font-size:11px; border:1px solid #000; border-bottom:none; background-color:#DBDBDB;"><b>&nbsp;BILL R/O RS.</b></td>
                                        <td style="font-size:11px; border:1px solid #000; border-bottom:none; background-color:#DBDBDB; text-align:right;"><b><?php echo round($tot1,2); ?> &nbsp;</b></td>
                                    </tr>
                                </table>                                
                            </tr>
                        </table>
                    </tr>
                </table>
            </div>
            <div style="text-align:left; margin-left:1%; font-size:10px;">All Matters Subject to <b><?php echo ucwords($company_row->company_city);?></b> Jurisdicion.</div>
             
            <div style="text-align:left; margin-left:1%; font-size:9px;"> 
                <ul>
                    <li> I/We Certify that my/our registration under GST Act 2017 is in the forte on the same on which the sale of goods specified in this tax invoice is made by me/us & the transaction of sale covered by this tax invoice has been affected by me/us & shall be accounted for the turnover of the sale while filling return or due on salie is paid or shall be paid.</li>
                </ul>
            </div>
            <div style="text-align:center;">
                <table align="center" width="70%" style="text-align:center; " cellspacing="0" cellpadding="10">
                </table>
            </div>
            <div style="text-align:center;" class="">
                <table align="center" width="95%" style="text-align:center; " cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align:left; margin-right:1%; font-size:10px; text-transform:capitalize;">
                            <b>Receiver Sign :</b>
                        </td>
                        <td style="text-align:right; margin-right:1%; font-size:10px; text-transform:capitalize;">
                            <b>For : <?php echo $company_row->company_name;?></b>
                        </td>
                    </tr>
                </table>
            </div>
        </form>  

        <?php 

        }
        /*$table.='</table>';
        '<br/>';
        echo $table;*/
        
        header("Content-type: application/x-msdownload"); 
        header('Content-Disposition: attachment; filename="Purchase-Order.xls"');
        header("Pragma: no-cache");
        header("Expires: 0");
        ?>
    </body>
</html>