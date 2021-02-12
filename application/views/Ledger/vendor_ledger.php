<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li class=""><a href="<?php echo site_url('PartyLedger');?>">Party</a></li>
            <li class="active"><a >Vendors</a></li>
        </ul>
    </div> 
    <div class="col-sm-12">&nbsp;
        <form method="post" enctype="multipart/form-data">
            <div class="col-sm-12 col-sm-offset-1 form-group">
                <div class="col-sm-3 form-group">
                    <input type="text" name="search_vendor" id="search_vendor" class="form-control" required placeholder="Enter Party Name" required autofocus/>
                    <input type="hidden" name="id_vendor" id="id_vendor">
                </div> 
                <div class="col-sm-3 form-group">
                    <input type="text" name="fromdate" autocomplete=off class="form-control datepicker" required />
                </div> 
                <div   class="col-sm-3 form-group">
                    <input type="text" name="todate" autocomplete=off class="form-control datepicker" required />
                </div>
                <div class="col-sm-3 form-group">
                    <button type="submit" name="getdate" class=" btn btn-success "><span class="glyphicon glyphicon-search"></span> Search</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    if(isset($fromdate) && isset($todate))
    {
        $final_opening_bal=0;
        $credit=0;
        $acc_amt=0;
        $veh_amt=0;
        $total_debit=0;
    ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/estimate.css');?>">
    <div class="col-sm-12 ">
        <button  onclick='printDiv();' id="printPageButton1" class="btn btn-primary pull-right"><span class=" glyphicon glyphicon-print "></span></button>
    </div>
    <div class="col-sm-12 ">
        <page size="A4" layout="portrait" id='DivIdToPrint' >
            <div class="invoice-box">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr class="top">
                        <td colspan="2">
                            <table width="100%">
                                <tr style="border-bottom:1px solid;" >
                                    <td style="font-size:35px;">
                                        <img src="../company_master/<?php echo $company_row->logo_image; ?>" class=" img-rounded" width="180px" height="50px" />
                                        &nbsp;<?php echo $company_row->company_name;?>
                                        <br>
                                        <br>
                                        <p style="font-size:17px;" >
                                            <b>   Address :</b>
                                            <?php echo  $company_row->company_address;?>
                                            <?php echo  $company_row->postal_code;?>
                                            &nbsp;&nbsp; <b>Contact No : </b><?php echo $company_row->company_phone;?>
                                            &nbsp;&nbsp;<b>Email Address :</b> <?php echo  $company_row->admin_email;?>
                                            &nbsp;&nbsp;<b>GST No :</b> <?php echo  $company_row->gst_no;?>
                                        </p>
                                    </td>
                                    <td>
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
                                    <td Colspan="3" style="text-align:center"><h4>Vendor Statement </h4></td>
                                </tr>
                                <tr>
                                    <td Colspan="3" style="text-align:center"><h5>From: <?php echo date('d-m-Y',strtotime($fromdate)); ?> &nbsp;To : <?php echo date('d-m-Y',strtotime($todate)); ?></h5></td>
                                </tr>
                                <tr >
                                    <td width="">Name of Manufacturer :<?php echo ucwords($vendor_row->name); ?></td>
                                    <td width="">Address : <?php echo ucwords($vendor_row->address); ?></td>
                                    <td width="">&nbsp;&nbsp;&nbsp;Contact No :<?php echo $vendor_row->contact; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" width="100%" cellspacing="0" >
                                <tr style="font-size: 11px;line-height:14px">
                                    <td colspan="1"  style="text-align:center">Sr .no</td>
                                    <td colspan="1"  style="text-align:center">Date</td>
                                    <td colspan="1"  style="text-align:center">Narration/Stock transfer Invoice No.</td>
                                    <td colspan="1"  style="text-align:center">Debit</td>
                                    <td colspan="1"  style="text-align:center">Credit</td>
                                </tr >
                                <tr style="font-size: 11px;line-height:14px">
                                    <td colspan="1"  style="text-align:center">1.</td>
                                    <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($fromdate))  ?> </td>
                                    <td colspan="1"  style="text-align:center">OPENING Balance</td>
                                    <?php 
        if($final_opening_bal > 0)
        { 
            //                                ?>
                                    <td colspan="1"  style="text-align:center"></td>
                                    <td colspan="1"  style="text-align:center"><?php echo $credit += abs($final_opening_bal); ?></td>
                                    <?php 
        }else{ 
            //                                ?>
                                    <td colspan="1"  style="text-align:center"><?php echo $total_debit += abs($final_opening_bal); ?></td>
                                    <td colspan="1"  style="text-align:center"></td>
                                    <?php }
                                    ?>
                                </tr>
                                <?php 
        $n=2;
        foreach($date_array as $key_selected=>$date_value)
        {
            $query_purchase = $this->db->query("SELECT * from  purchase_order  where date='".$date_value."' and vendor_id='".$vendor_row->id."' and recev_status=1");
            $num1 = $query_purchase->num_rows();
            //            echo $num1;  echo nl2br("\n");
            //echo $this->db->last_query();echo nl2br("\n");
            if($num1>0)
            { 
                $fetch_purchase = $query_purchase->result();
                foreach($fetch_purchase as $f1)
                { 
                    $etem1=unserialize($f1->received);
                    $reciv=0;
                    foreach($etem1 as $key1 => $val1)
                    { 
                        $tot1=0;
                        $ret=0;
                        $i_gst=0;
                        $rtcal11=$val1[3]-(($val1[3]*$val1[4])/100);
                        $tot1=$rtcal11*$val1[1];

                        $fetch12 = $this->db->query("select * from product_desc where id='".$val1[0]."'")->row();
                        $fetch13 = $this->db->query("select * from product where product_id='".$fetch12->product_id."'")->row();

                        $gst[]=$fetch13->i_gst;
                        $ret = $tot1*($fetch13->i_gst/100); 
                        $aa = $tot1+ $ret;
                        $reciv += $aa;
                    }
                                ?>
                                <tr style="font-size: 11px;line-height:14px" >
                                    <td colspan="1"  style="text-align:center"><?php echo $n++; ?>.</td>
                                    <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($date_value))  ?> </td>
                                    <td colspan="1"  style="text-align:center"> Purchase Order Number.  <?php echo $f1->id; ?> </td>
                                    <td colspan="1"  style="text-align:center"><?php echo $tt= round($reciv); ?></td>
                                    <td colspan="1"  style="text-align:center"></td>
                                </tr>
                                <?php  $total_debit+=$tt;
                }
            }
        }
       /*
//       $query_purchase1 = $this->db->query("SELECT * from  purchase_order  where return_date='".$date_value."' and vendor_id='".$vendor_row->id."' ");
         //echo $this->db->last_query();echo nl2br("\n");
        $num12 = $query_purchase1->num_rows();
        if($num12>0)
        { 
            $fetch_purchase1 = $query_purchase1->result();
            foreach($fetch_purchase1 as $f2)
            { 
                $retu_cal=unserialize($f2->return_item);
                $tot_ret_amt=0;
                foreach($retu_cal as $ret_key => $ret_val){
                    if($ret_val[7]==''){
                        $ret=$ret_val[3];
                    }
                    else{
                        $ret=$ret_val[7];
                    }
                    $tot_ret_amt +=$ret*$ret_val[1];
                }
                                ?>
                                <tr style="font-size: 11px;line-height:16px" >
                                    <td colspan="1"  style="text-align:center"><?php echo $n++; ?>.</td>
                                    <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($date_value))  ?> </td>
                                    <td colspan="1"  style="text-align:center"> Purchase Return of Purchase Bill No. <?php echo $f2->id; ?> </td>
                                    <td colspan="1"  style="text-align:center"></td>
                                    <td colspan="1"  style="text-align:center"><?php echo $tot_ret_amt;////echo $f2->tot_amt; ?></td>
                                </tr>
                                <?php $credit+=$tot_ret_amt;
            }
        }*/

       /* $query_purchase_log = $this->db->query("SELECT * from  purchase_dep_log  where date(date_time) ='".$date_value."' and party_id='".$vendor_row->id."' ");
        $num13 = $query_purchase_log->num_rows();
        if($num13>0)
        { 
            $fetch_purchase_log = $query_purchase_log->result();
            foreach($fetch_purchase_log as $f3)
            {
                                ?>
                                <tr style="font-size: 11px;line-height:14px" >
                                    <td colspan="1"  style="text-align:center"><?php echo $n++; ?>.</td>
                                    <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($date_value))  ?> </td>
                                    <td colspan="1"  style="text-align:center">CREDIT by <?php echo $f3->method; ?></td>
                                    <td colspan="1"  style="text-align:center"></td>
                                    <td colspan="1"  style="text-align:center"><?php echo $f3->amount; ?></td>
                                </tr>
                                <?php
            }
        }*/
                                ?>
                                <tr>
                                    <td  colspan="3" style="text-align:center"> </td>
                                    <td   style="text-align:left"></td>
                                    <td  colspan="1" style="width:20%"></td>
                                </tr>   
                                <tr>
                                    <td  colspan="3" style="text-align:center"> &nbsp;</td>
                                    <td   style="text-align:left"></td>
                                    <td  colspan="1" style="width:20%"></td>
                                </tr>   
                                <tr>
                                    <td  colspan="3" style="text-align:center"> </td>
                                    <td   style="text-align:center"><b><?php echo $total_debit; ?></b></td>
                                    <td  colspan="1" style="width:20%;text-align:center"><b><?php echo $credit;?></b> </td>
                                </tr>   
                                <?php  
        $outstanding=$total_debit-$credit; 
        if($outstanding<0)
        {
                                ?>
                                <tr>
                                    <td  colspan="3" style="text-align:center"> Cr. <i> Closing Balance</i> </td>
                                    <td  style="text-align:center"><b><?php echo round(abs($outstanding)); ?></b></td>
                                    <td></td>
                                </tr>   
                                <?php 
        }else{
                                ?>
                                <tr>
                                    <!--      <td  colspan="4" style="text-align:center"> Dr. <i> Closing Balance</i> </td>-->
                                    <!--		<td   style="text-align:center"><b><?php //echo round($outstanding); ?></b></td>-->
                                    <td></td>
                                </tr> 
                                <?php  } ?>
                            </table>
                        </td>
                    </tr> 
                </table>
            </div>
        </page>
    </div>
    <?php } ?>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   
<script>
    $('#search_vendor').autocomplete({
        source: '<?=base_url()?>PurchaseController/getVenodr',
        select: function (event, ui) {
            var name = ui.item.label
            $("#id_vendor").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_vendor").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            $( "#id_party" ).val( ui.item? ui.item.value : 0 );
        }
    });
</script>
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-50:+10",
        });
    });
</script>
<script type="text/javascript">
    function printDiv() 
    {
        var divToPrint=document.getElementById('DivIdToPrint');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        setTimeout(function(){newWin.close();},10);
    }
</script>