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
            page[size="A5"] {  
                width: 21cm;
                min-height: 10cm; 
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
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php //print_r($party_row);?>
        <?php //print_r($company_row);?>
        <page size="A5">
            <div style="border:1px solid black; ">
                <table align="center" style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>&nbsp;</td>
                        <td  style="text-align:right; font-size:14px;"><b>TAX INVOICE</b> </td>
                        <td  style="text-align:right; font-size:10px;"> <span>Original for Recipient</span>&nbsp;   </td>
                    </tr>
                    <tr>

                        <td width="24%" style="border-top:1px solid black;vertical-align: top;">
                            <img src="<?php echo base_url('uploads/').$company_row->logo_image;?>" style="padding-left:5px;" width="150px" height="40px">
                        </td>
                        <td style="width:27%; font-size:21px; text-transform:capitalize;border-top:1px solid black;vertical-align: top; padding-top: 9px;"><b><?php echo $company_row->company_name;?></b>
                            <br> 
                            <p style="margin-left:-199px;font-size: 13px;text-align:center;"><?php echo $company_row->company_address;?><br>
                                <b>Tel No. </b> <?php echo $company_row->company_phone;?><br>
                                <b>&nbsp;GST IN NO. </b><?php echo $company_row->gst_no;?><br>
                                <b>FSSAI No.</b> <?php ?>
                            </p>

                        </td>
                        <td style="border:1px solid black;">
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr >
                                    <td style="text-align:left; font-size:10px; width:%;"><b>&nbsp;BILL NO.</b><?php ?></td>
                                    <td style="text-align:center; font-size:10px;"><b>BILL DATE :</b><?php echo date("d-m-Y");?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top:1px solid; font-size:12px; "><b style="text-transform:capitalize;">&nbsp;BILL TO : </b> <?php echo ucwords($party_row->name);?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-size:10px; text-transform:capitalize;"> &nbsp;<?php
                                        ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size:10px; width:35%;"><b>&nbsp;Ph No.</b> <?php echo ucwords($party_row->contact_no);?></td>
                                    <td colspan="" style="font-size:10px;"><b>&nbsp;PLACE : </b><?php echo ucwords($party_row->city); //echo ucwords($party_row->city.', '.$party_row->state_name);?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:10px;"><b>&nbsp;GSTIN NO. <?php echo ucwords($party_row->gst_in);?></b></td>
                                    <?php
                                    $n= $party_row->limit_days;

                                    $enddate = date("Y-m-d",strtotime($n.'day', strtotime( date("Y-m-d"))));
                                    ?>
                                    <td colspan=" " style="font-size:10px; text-transform:capitalize;">&nbsp;<b>Due date : </b><?php echo $enddate; ?></td>
                                </tr>
                                <tr>
                                    <td colspan=" " style="font-size:10px;"><b style="text-transform:capitalize;">&nbsp;Previous Bal : </b> <?php
                                        ?></td>
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
                                $item= $this->session->userdata('all_bar');
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
                                    <td colspan="12">
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
                                                            $gst_tot=0;
                                                            $tax=$this->session->userdata('tax_detail');
                                                            //print_r($tax);
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
            <div style="text-align:left; margin-left:1%; font-size:11px;">All Matter Subject to <?php echo ucwords($company_row->company_city);?> Jurisdicion</div>
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
            $sale_date= '';
            $sale_exec = '';
            if($this->session->userdata('edit')){
                $sale_id = $this->session->userdata('edit');
                $sale_exe = $this->salemodule->one_sale_fetch($sale_id);
                $sale_exec = $sale_exe->sale_exe;
                $sale_date = $sale_exe->date;
                $controller = 'SaleController/update_deal';
            }
            else{
                $controller = 'SaleController/save_deal';
            }
            ?>
            <?php echo form_open($controller,array('id'=>'submit_id'));?>
          
            <div class="row" style="display : flex; justify-content : center;">
                <div class="col-sm-3"><b>COD In Percente (%) : </b><input type="text" name="cod" step="0.01" max="99" class="form-control" value="0"></div>
                <div class="col-md-3"><b>H Discount (%) : </b><input type="text" name="h_disc" step="0.01" max="99" class="form-control" value="0"></div>
                <div class="col-sm-3"><b>Bill Date : </b><input type="date" name="todate" class="form-control" value="<?php echo $sale_date !='' ? $sale_date : date("Y-m-d");?>" <?php echo $sale_date !='' ? 'readonly' : '';?>></div>
                <div class="col-sm-3"><b>Sale Executive : </b>
                    <select name="sale_exe" class="form-control" required>
                        <option value="">Select</option>
                        <?php
                    
                        foreach($sales_exe as $exe){
                        ?>
                        <option value="<?php echo $exe->id;?>" <?php echo $exe->id == $sale_exec ? 'selected' : '';?> ><?php echo ucwords($exe->name);?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div> 
            <div class="row" style="text-align:center; margin-top:1%; display : flex; justify-content : center;">
                <div class="col-sm-3">
                    <a href="<?php echo site_url('salescontroller/cancel_deal');?>" class="btn btn-default btn-block">Cancle</a>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-success btn-block btn-lg">Save & Print</button>
                </div>
            </div>
            <?php echo form_close();?>
            <br/>
        </page>     
    </body>
</html>