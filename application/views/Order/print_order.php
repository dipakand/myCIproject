<?php
error_reporting(0);
session_start();
ob_start();
//print_r($order_row);
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
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }
            page[size="A5"] {  
                width: 21cm;
                height: 29.7cm; 
            }
            page[size="A5"][layout="portrait"] {
                width: 29.7cm;
                height: 21cm;  
            }

            @media print 
            {
                body, page {
                    margin: 0;
                    box-shadow: 0;
                }
            }

        </style>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <title>Order Print</title>
        <?php
        include("../templets/meta+link.php");
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="ajax.js" ></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> 
        <script src="../style/js/jquery.js"></script>
        <script src="../style/js/jquery-ui.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../style/js/bootstrap.min.js"></script>

    </head>
    <body>
        <page size="A5">
            <form method="post" enctype="multipart/form-data">
                <?php
                $company_row;
                $order_row;
                ?>
                <div class="col-sm-12">&nbsp;</div>
                <div class="invoice-box" style="padding:10px;" >
                    <table style="width:100%;text-align:center;" cellspacing="0" cellpadding="0" style=" font-size:12px;">
                        <tr>
                            <td colspan="4">
                                <p style="font-size: 20px; margin: 0 0 0px; font-weight: bold; text-decoration: underline;"><?php echo strtoupper($company_row->company_name);?></p>
                                <p style="font-size: 12px; margin: 0 0 0px;">Order Date : <b style="font-weight: 900;"><?php echo date("d-m-Y", strtotime($order_row->date));?></b>&nbsp;&nbsp;&nbsp;&nbsp;Order For : <b style="font-weight: 900;"><?php echo $order_row->exe_name; ?></b></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="border:1px solid; width: 10%;"><b>Sr. No.</b></td>
                            <td style="border:1px solid;"><b>Product Name</b></td>
                            <!--<td style="border:1px solid;"><b>Product Description</b></td>-->
                            <td style="border:1px solid;"><b>MRP</b></td>
                            <td style="border:1px solid; width: 20%;"><b>Order Qty</b></td>
                        </tr>

                        <?php 


                        $s=0;
                        $item_ary=unserialize($order_row->item_array);
                        foreach($item_ary as $key=>$val)
                        {
                            $s++;
                            $fetch111 = $this->db->where('id',$val['id'])->get('product_desc')->row();
                            $fet11 = $this->db->where('product_id',$fetch111->product_id)->get('product')->row();
                        ?>
                        <tr>
                            <td style="border:1px solid;"><?php echo $s;?></td>
                            <td style="border:1px solid; text-align:left; padding: 0% 1%;"><?php echo ucwords($fet11->name.' '.$fetch111->weight);?></td>
                            <!--<td style="border:1px solid;"><?php echo ucwords($fetch111->weight);?></td>-->
                            <td style="border:1px solid;"><?php echo $val['mrp'];?></td>
                            <td style="border:1px solid;"><?php echo $val['qty'];?></td>
                        </tr>
                        <?php
                        }

                        ?>

                    </table>
                </div>

            </form>  

        </page>           

        <!-- jQuery -->
        <!--    <script src="../style/js/jquery.js"></script>-->

        <script src="../style/js/jquery-ui.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../style/js/bootstrap.min.js"></script>

        <script>
            function doPrint() 
            {
                window.print();            
                //                window.close();
                setTimeout(function(){window.close();},5000);

            }
            window.onload = doPrint;
        </script>

    </body>
</html>