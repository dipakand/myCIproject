<?php
error_reporting(0);
ob_start();
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            body {
                background: rgb(204,204,204); 
            }
            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                /*                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
            }
            page[size="A5"] {  
                width: 14.8cm;
                height: 21.0cm; 
            }
            page[size="A5"][layout="landscap"] {
                width: 21.0cm;
                height: 14.8cm;  
            }
            @media print {
                body, page {
                    margin: 0;
                    box-shadow: 0;
                }
            }
        </style>
        <title>Receipt</title>
    </head>
    <body>
        <page size="A5" layout="landscap">
            <?php
            $counter = 1;
            //print_r($voucher_row);
            ?>
            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                <tr class="top">
                    <td >
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td colspan="2" style="font-size:30px;text-align:center;">
                                    <?php echo $company_row->company_name;?>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid;" >
                                <td style="font-size:30px; width:70%;">
                                    <p style="font-size:12px;" >Voucher No.<b><?php echo $voucher_row->id; ?></b><br>
                                        Address : &nbsp;
                                        <?php echo  ucwords($company_row->company_address);?><br>
                                        <?php echo  $company_row->postal_code;?><br></p>
                                </td>
                                <td>
                                    <h3>Voucher<br></h3>
                                    <b><?php echo  date("F j, Y, g:i a"). "<br>"; ?></b>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td  style="border-bottom:1px solid black;font-weight:bold;">
                        <table style="font-size:12px;font-family:arial sans-serif;border-collapse: collapse;"  width="100%" cellspacing="8">
                            <tr >
                                <td>Name of Vendor :&nbsp;<?php echo ucwords($voucher_row->vendor_name);?></td>
                            </tr>
                            <tr>
                                <td>Contact No :&nbsp;<?php echo $voucher_row->cont_no; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td >
                        <table style="font-size:12px; width:100%" >
                            <tr style="height: 16px !important; border-bottom: solid 1px #ccc;border-top: solid 1px #ccc;">
                                <th scope="row">Sr No</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <?php if($voucher_row->gst_in != ''){?>
                                <th>HSN </th>
                                <th>GST</th>
                                <?php } ?>
                                <th style="text-align: right;padding-right:5px;">Total</th>
                            </tr>
                            <?php
                            $item_ser =  unserialize($voucher_row->items);
                            $sr = 1;
                            $total = 0; 
                            $tot = 0;
                            foreach($item_ser as $key=>$val)
                            {
                                $key; 
                                $item = $val['product'];
                                $qty = $val['qty'];
                                $amt = $val['rate'];
                                $hsn = $val['hsn'];
                                $gst = $val['gst'];
                                $tot = $val['total_amt'];
                                $total+= $tot;
                            ?>
                            <tr style="height: 16px !important; border-bottom: solid 1px #ccc;border-top: solid 1px #ccc;">
                                <td scope="row" ><?php echo $sr++;?></td>
                                <td style="float:left;"><?php echo ucfirst($item);?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $amt; ?></td>
                                <?php if($voucher_row->gst_in != ''){?>
                                <td><?php echo $hsn; ?></td>
                                <td><?php echo $gst; ?></td>
                                <?php } ?>
                                <td style="text-align: right;padding-right:5px;"><i class="fa fa-inr"></i>&nbsp;<?php echo $tot; ?></td>
                            </tr>
                            <?php }?>
                            <?php if($voucher_row->gst_in != ''){?>
                            <tr style="height: 16px !important; border-bottom: solid 1px #ccc;border-top: solid 1px #ccc;">
                                <td scope="row"></td>
                                <td style="float:left;">(=) Total Amount To Be Paid </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;padding-right:5px;"><i class="fa fa-inr"></i>&nbsp;<?php echo $total; ?></td>
                            </tr>   
                            <?php }else {?>
                            <tr style="height: 16px !important; border-bottom: solid 1px #ccc;border-top: solid 1px #ccc;">
                                <td scope="row"></td>
                                <td style="float:left;">(=) Total Amount To Be Paid </td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;padding-right:5px;"><i class="fa fa-inr"></i>&nbsp;<?php echo $total; ?></td>
                            </tr>  
                            <?php } ?>
                        </table>   
                    </td>
                </tr>
                <tr>
                    <td >
                        <h5 style="margin-bottom: 2px;">Terms & Conditions :</h5>
                        <ul style="font-size:12px;margin-bottom: -2px;">
                            <li>Lorem ipsum dolor sit amet, sit an vide nulla conceptam. </li>
                            <li>Lorem ipsum dolor sit amet, sit an vide nulla conceptam. </li>
                            <li>Lorem ipsum dolor sit amet, sit an vide nulla conceptam. </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td style="float:left;">I have received amount of Rs:&nbsp;<?php echo $total;?>&nbsp;/-&nbsp;by Cash / Cheque</td>
                </tr> 
                <tr >
                    <td style="float:left;" colspan="2">Amount (in words)&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-inr">&nbsp;<?php  //echo convert_number_to_words($total);?> Only</i>
                    </td>
                </tr>
                <br/>
                <tr >
                    <p style="float:right;" >
                        <td colspan="2" style="text-align:right; padding-right:20px;">Receiver Signature</td>
                    </p>     
                </tr>
            </table>
        </page>           
        <!-- jQuery -->
        <script src="../style/js/jquery.js"></script>
        <script src="../style/js/jquery-ui.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../style/js/bootstrap.min.js"></script>
        <script>
            function doPrint() 
            {
                window.print();   
                //window.close();
                setTimeout(function(){window.close();},5000);
            }
            window.onload = doPrint;
        </script>
    </body>
</html>