<?php
error_reporting(0);
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>

            /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
            body {
                background: rgb(204,204,204); 
            }

            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }
            page[size="A4"] {  
                width: 21cm;
                height: 29.7cm; 
            }
            page[size="A4"][layout="landscap"] {
                width: 29.7cm;
                height: 21cm;  
            }

            @media print {
                body, page {
                    margin: 0;
                    box-shadow: 0;
                }
            }
            td{
                border-bottom: 1px solid;
            }
        </style>

        <link rel="stylesheet" href="css/estimate.css">
        <style>
            @media print {
                #printPageButton {
                    display: none;
                }
                #printPageButton1 {
                    display: none;
                }
                #previous_transaction {
                    display: none;
                }
            }
        </style>
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    </head>
    <body>
        <br>
        <page size="A4">
            <div  id="printPageButton1">
                <br>
                <a class="btn btn-danger" style="text-decoration:none" href="<?php echo site_url('Transaction');?>"><b style="color:'white';">Cancel</b></a>
                <button class="btn btn-primary pull-right" onclick="doPrint();"><a style="text-decoration:none" ></a>Print</button>    
            </div>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr class="top">
                    <?php
                    $company_row;
                    ?>
                    <td colspan="2">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr style="border-bottom:1px solid;" >
                                <td style="text-align:center;"><img src="../company_master/<?php echo $company_row->logo_image; ?>" class=" img-rounded" width="180px" height="50px" /></td>
                                <td style="font-size:25px; text-align:left;">

                                    &nbsp;<b><?php echo $company_row->company_name;?></b>
                                    <br>

                                    <p style="font-size:10px; padding-left:2%;" > 
                                        Address Here.
                                        <?php echo  $company_row->company_address;?>
                                        <?php echo  $company_row->postal_code;?><br>
                                        Email Address : <?php echo  $company_row->admin_email;?>
                                        GST No : <?php echo  $company_row->gstin;?>
                                    </p>
                                </td>
                                <td style="font-size:18px; text-align:right; padding-right:2%;">
                                    <b><?php echo  date("F j, Y, g:i a"). "<br>"; ?></b>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td  style="border-bottom:1px solid black;font-weight:bold;">
                        <table style="font-size:14px;border-collapse: collapse;"  width="100%" cellspacing="8">
                            <tr >
                                <td Colspan="3" style="text-align:center"><h4><b>Customer Statement</b> </h4></td>
                            </tr>
                            <tr>
                                <td Colspan="3" style="text-align:center"><h5><b>From: <?php echo date('d-m-Y',strtotime($frm_dt)); ?> &nbsp;To : <?php echo date('d-m-Y',strtotime($to_dt)); ?></b></h5></td>
                            </tr>
                            <tr >
                                <td width="">Party Name:<?php echo $party_row->name; ?></td>
                                <td width="">Address : <?php echo $party_row->address; ?></td>
                                <td width="">&nbsp;&nbsp;&nbsp;Contact No :<?php echo $party_row->contact_no; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr style="font-size: 11px;line-height:14px">
                                <td colspan="1"  style="text-align:center">Sr .no</td>
                                <td colspan="1"  style="text-align:center">Date</td>
                                <td colspan="1"  style="text-align:center">Narration/Stock transfer Invoice No.</td>
                                <td colspan="1"  style="text-align:center">Debit</td>
                                <td colspan="1"  style="text-align:center">Credit</td>
                            </tr >
                            <tr style="font-size: 11px;line-height:14px">
                                <td colspan="1"  style="text-align:center">1.</td>
                                <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($datefrom1))  ?> </td>
                                <td colspan="1"  style="text-align:center">OPENING Balance</td>
                                <td colspan="1"  style="text-align:center"><?php echo $final_opening_bal; ?></td>
                                <td colspan="1"  style="text-align:center"></td>
                            </tr>

                            <?php 

                            $acc_amt=0;
                            $veh_amt=0;
                            $n=2;
                            $sla_tot=0;$sla_tot_t=0;$log_tot=0;$log_tot_t=0;

                            foreach($date_array as $dt)
                            {
                                $where = "party_id='".$party_row->id."' and date='".$dt."' and cancel_status!= 1";
                                $this->db->where($where);
                                $query3 = $this->db->get('sales');

                                if(count($query3->result())> 0)
                                {
                                    foreach($query3->result() as $sale)
                                    {
                            ?>
                            <tr style="font-size: 11px;line-height:14px" >
                                <td colspan="1"  style="text-align:center"><?php echo $n++;; ?>.</td>
                                <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($dt))  ?> </td>
                                <td colspan="1"  style="text-align:center">
                                    <b>Debit</b> Receipt No.<?php echo $sale->id; ?></td>
                                <td colspan="1"  style="text-align:center"><?php 
                                        if((Int)$sale->cod_percent > 0)
                                        {
                                            echo $sla_tot = (Int)$sale->cod_amt; 
                                        }
                                        else
                                        {
                                            echo $sla_tot = (Int)$sale->total_amt; 
                                        }
                                        $sla_tot_t +=$sla_tot;
                                    ?>
                                </td>
                                <td colspan="1"  style="text-align:center"></td>
                            </tr>
                            <?php
                                    }
                                }
                                $where = "party_id='".$party_row->id."' and date(date_time)='".$dt."'";
                                $this->db->where($where);
                                $query4 = $this->db->get('sales_log');

                                if(count($query4->result())> 0)
                                {
                                    foreach($query4->result() as $sale_log)
                                    {
                            ?>
                            <tr style="font-size: 11px;line-height:14px" >
                                <td colspan="1"  style="text-align:center"><?php echo $n++; ?>.</td>
                                <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($dt))  ?> </td>
                                <td colspan="1"  style="text-align:center"><b>Credit</b> Payment Received Against Bill No. <?php echo $sale_log->sales_id;?></td>
                                <td colspan="1"  style="text-align:center"></td>
                                <td colspan="1"  style="text-align:center"><?php echo $log_tot=$sale_log->deposit; $log_tot_t +=$log_tot;?></td>
                            </tr>
                            <?php
                                    }
                                }

                            }
                            ?> 
                            <tr>
                                <td  colspan="3" style="text-align:center"> </td>
                                <td  style="text-align:left"></td>
                                <td  colspan="1" style="width:20%"></td>
                            </tr>   

                            <tr>
                                <td  colspan="3" style="text-align:center"> &nbsp;</td>
                                <td   style="text-align:left"></td>
                                <td  colspan="1" style="width:20%"></td>
                            </tr>   

                            <tr>
                                <td  colspan="3" style="text-align:center"> </td>
                                <td  style="text-align:center"><b><?php echo $total_debit = $sla_tot_t+$final_opening_bal;?></b></td>
                                <td  colspan="1" style="width:20%;text-align:center"><b><?php echo $log_tot_t;?></b> </td>
                            </tr>

                            <?php 
                            $outstanding=$total_debit-$log_tot_t; 
                            if($outstanding<0)
                            {
                            ?>
                            <tr>
                                <td  colspan="3" style="text-align:center"> Cr. <i> Closing Balance</i> </td>
                                <td  style="text-align:center"><b><?php echo round(abs($outstanding)); ?></b></td>
                                <td></td>
                            </tr>   

                            <tr>
                                <td  colspan="3" style="text-align:center"> </td>
                                <td  style="text-align:center"><b><?php echo $total_debit+abs($outstanding); ?></b></td>
                                <td  style="text-align:center"><b><?php echo $log_tot_t; ?></b></td>
                            </tr>

                            <?php 
                            }else{
                            ?>
                            <tr>
                                <td  colspan="4" style="text-align:center"> Dr. <i> Closing Balance</i> </td>
                                <td   style="text-align:center"><b><?php echo round($outstanding); ?></b></td>
                                <td></td>
                            </tr> 

                            <tr>
                                <td  colspan="3" style="text-align:center"></td>
                                <td  style="text-align:center"><b><?php echo round($total_debit); ?></b></td>
                                <td  style="text-align:center"><b><?php echo $log_tot_t+round($outstanding); ?></b></td>
                            </tr>   
                            <?php  } ?>
                        </table>
                    </td>
                </tr> 

            </table>
        </page>           

        <script>
            function doPrint() {
                window.print();            
            }
        </script> 
    </body>
</html>