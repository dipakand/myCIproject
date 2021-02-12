<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Print</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            body {
                background: rgb(204,204,204); 
            }

            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                /*box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
            }
            page[size="A4"] {  
                width: 21cm;
                min-height: 13cm; 
            }
            page[size="A4"][layout="Landscape"] {
                width: 29.7cm;
                min-height: 21cm;  
            }

            @media print {
                body, page {
                    margin: 0;
                    box-shadow: 0;
                }
            }
            /* td{
            border-top: 1px solid #ccc;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            font-size: 10px;
            padding-left: .5%;
            padding-right: .5%;
            }
            th{
            border: 1px solid #000;
            font-size: 12px;
            padding-left: .2%;
            padding-right: .2%;
            text-align: center;
            }*/
        </style>

        <link rel="stylesheet" href="../estimate/css/estimate.css"> 

    </head>
    <body>

        <?php 
        //print_r($company_row);
        //print_r($sale_row);

        for($i=1; $i<=2; $i++)
        {
            if($i == 1)
            {
                $copy = 'Original for Recipient ';
                $display = 'block';
            }
            else{
                $copy = 'Marchant Copy';
                $display = 'none';
            }

        ?>
        <page size="A4">
            <div style="border:1px solid black; ">
                <table align="center" style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr>
                        <!--                                <td>&nbsp;</td>-->
                        <td  style="text-align:right; font-size:14px;"><b>TAX INVOICE</b> </td>
                        <td  style="text-align:right; font-size:10px;"> <span><!--Original for Recipient--><?php echo $copy;?></span>&nbsp;   </td>
                    </tr>
                    <tr>
                        <!--<td width="24%" style="border-top:1px solid black;vertical-align: top;">-->
                        <!--    <img src="<?php echo base_url('uploads/').$company_row->logo_image;?>" style="padding-left:5px;" width="150px" height="40px">-->
                        <!--</td>-->
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
                        <td style="border:1px solid black; vertical-align: top;">
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
                                                <td rowspan="5" style="width:75%;"  >
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

                                            <tr style="">
                                                <td style="font-size:11px; border:1px solid #000; text-align : left;"><b>&nbsp; In-word </b><?php echo $this->CommenModel->convertToIndianCurrency($gst_total); ?> Rupees.</td>
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

                <div style="font-size:10px; padding-left:7px;color:#CCC">
                    <?php
            $tot1 = round($gst_total);
            $val_selsql = $company_row->cd;
            $ftotal = ($tot1-$cod)-(($tot1-$cod)*($val_selsql/100));
            echo round($ftotal.AsFloat);
            //echo round($rows['h_disc_amt'].AsFloat); 

                    ?>
                </div>
                <!--<div style="text-align:left; margin-left:1%; font-size:11px;">All Matter Subject to <?php echo ucwords($company_row->company_city);?> Jurisdicion</div>-->
                <div style="text-align:left; margin-left:1%; font-size:11px;">
                    <b style="text-decoration: underline;">Terms & Conditions</b><br>
                    <p style="font-size:11px;">
                        <?php

            //                                                $daysss=$rows['due_days'];
            $terms=explode(',',$company_row->tmc);
            $no=1;
            if($daysss!='' and $daysss!=0){

                echo '<b>'.$no++.'.</b> Due Date is <b>'.date('d-m-Y',strtotime('+'.$daysss.'days',strtotime($rows['date']))).'.</b><br>';
            }
            foreach($terms as $term){
                echo '<b>'.$no++.'.</b> '.ucfirst($term).'<br>';
            }
                        ?>

                    </p>
                </div>
                <div style="text-align:right; margin-right:1%; font-size:11px; text-transform:capitalize;"><b>For : <?php echo $company_row->company_name;?></b></div>
                <?php
            if($party_row->credit_type > 0)
            {
                ?>  
                <div style="text-align:center;">
                    <table align="center" width="70%" style="text-align:center; " cellspacing="0" cellpadding="10">
                        <tr>
                            <td style="border:1px solid #000; font-size:12px;"><b>Total Invoice Amount</b></td>
                            <td style="border:1px solid #000; font-size:12px;"><b>Credit Amount</b></td>
                            <td style="border:1px solid #000; font-size:12px;"><b>Total Pay Amount</b></td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000; font-size:12px;"><?php echo $g_tot; ?></td>
                            <td style="border:1px solid #000; font-size:12px;"><?php echo $party_row->credit_type; ?></td>
                            <td style="border:1px solid #000; font-size:12px;"><?php $tot_val= ($g_tot-$party_row->credit_type); 
                if($tot_val > 0)
                {
                    echo $tot_val;
                }
                else
                {
                    echo $tot_val=0;
                }
                if($tot_val <= 0 )
                {
                    $tot1111 = $g_tot;
                }
                else
                {
                    $tot1111=$party_row->credit_type;
                }
                                ?>
                                <input type="hidden" name="tot_val" value="<?php  echo $tot1111 ;?>">
                            </td>
                        </tr>
                    </table>
                </div><br/>
                <?php
            }             
                ?>
            </div>
            <div style="display : <?php echo $display?>; padding-bottom: 2%; padding-top: 4%;">
                - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            </div>
        </page>
        <?php } ?>

        <?php //exit;?>
        <script>
            function doPrint() {
                window.print();
                //window.close();
                //window.location.href = <?php echo base_url('Sale');?>
                //setTimeout(function(){document.location.href = "<?php echo base_url('Sale');?>"},5000);
                setTimeout(function(){ window.close(); },5000);
            }
            window.onload = doPrint;
        </script>
    </body>
</html>