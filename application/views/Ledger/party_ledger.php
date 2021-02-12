<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a >Party</a></li>
            <li class=""><a href="<?php echo site_url('VendorLedger');?>">Vendors</a></li>
        </ul>
    </div> 
    <div class="col-sm-12">&nbsp;
        <form method="post" enctype="multipart/form-data">
            <div class="col-sm-12 col-sm-offset-1 form-group">
                <div class="col-sm-3 form-group">
                    <input type="text" name="pt_id" id="search_party" class="form-control" required placeholder="Enter Party Name" required autofocus/>
                    <input type="hidden" name="id_party" id="id_party">
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
        $total_debit = 0;
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
                        <?php
        $company_row;
                        ?>
                        <td colspan="2">
                            <table width="100%">
                                <tr style="border-bottom:1px solid;" >
                                    <td style="font-size:35px;">
                                        <img src="../company_master/<?php echo $company_row->logo_image; ?>" class=" img-rounded" width="180px" height="50px" />
                                        &nbsp;<?php echo $company_row->company_name;?>
                                        <br>
                                        <br>
                                        <p style="font-size:17px;" >
                                            <b> Address Here.</b>
                                            <?php echo  $company_row->company_address;?>
                                            <?php echo  $company_row->postal_code;?>
                                            <b>    Contact No :</b> <?php echo $company_row->company_phone;?>
                                            <b>    Email Address :</b> <?php echo  $company_row->admin_email;?>
                                            <b> GST No :</b> <?php echo  $company_row->gst_no;?>
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
                                    <td Colspan="3" style="text-align:center"><h4>Party Statement </h4></td>
                                </tr>
                                <tr>
                                    <td Colspan="3" style="text-align:center"><h5>From: <?php echo date('d-m-Y',strtotime($fromdate)); ?> &nbsp;To : <?php echo date('d-m-Y',strtotime($todate)); ?></h5></td>
                                </tr>
                                <tr >
                                    <td width="">Name of Customer :<?php echo ucwords($party_row->name); ?></td>
                                    <td width="">Address : <?php echo ucwords($party_row->address); ?></td>
                                    <td width="">&nbsp;&nbsp;&nbsp;Contact No :<?php echo $party_row->contact_no; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
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
                                                <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($_REQUEST['fromdate']))  ?> </td>
                                                <td colspan="1"  style="text-align:center">OPENING Balance</td>
                                                <?php 
                            if($final_opening_bal > 0)
                            { 
                                                ?>
                                                <td colspan="1"  style="text-align:center"></td>
                                                <td colspan="1"  style="text-align:center"><?php echo $credit += abs($final_opening_bal); ?></td>
                                                <?php 
                            }else{ 
                                                ?>
                                                <td colspan="1"  style="text-align:center"><?php echo $total_debit += abs($final_opening_bal); ?></td>
                                                <td colspan="1"  style="text-align:center"></td>
                                                <?php }
                                                ?>
                                            </tr>
                                            <?php 
        $n=2;
        foreach($date_array as $key_selected=>$date_value)
        {       
            $query_sale = $this->db->query("SELECT * from sales where date='".$date_value."' and party_id='".$party_row->id."' and cancel_status!='1'");
            $num1 = $query_sale->num_rows();
            //echo $this->db->last_query();echo nl2br("\n");
            if($num1>0)
            { 
                $fetch_sale = $query_sale->result();
                foreach($fetch_sale as $f1)
                { 
                    $cr = 0;
                    $last_day=date ("Y-m-d", strtotime("+$cr day", strtotime($date_value)));
                    $sale_id[]=$f1->id; 
                    $date1=date_create($last_day);
                    $date2=date_create(date("Y-m-d"));
                    $diff=date_diff($date1,$date2);
                                            ?>
                                            <tr style="font-size: 11px;line-height:14px" >
                                                <td colspan="1"  style="text-align:center"><?php echo $n++; ?>.</td>
                                                <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($date_value));  ?> </td>
                                                <td colspan="1"  style="text-align:center"> Sales Bill No.  <?php echo $f1->id;  ?></td>
                                                <td colspan="1"  style="text-align:center"><?php echo $f1->total_amt;?></td>
                                                <td colspan="1"  style="text-align:center"></td>
                                            </tr>
                                            <?php  $total_debit +=$f1->total_amt;
                }  
            }
            $query_sale_log = $this->db->query("SELECT * from sales_log  where date(date_time)='".$date_value."'  and `return_status`=''");
            $num11 = $query_sale->num_rows();
            if($num11 > 0)
            {
                $fetch_sale_log = $query_sale_log->result();
                $credit =0 ;
                foreach($fetch_sale_log as $f4)
                {
                    $detail=unserialize($f4->detail);
                    foreach($detail as $det)
                    {
                        if($det['amt'] >0)
                        {
                            $pay_mode=$det['type'];
                        }
                    }
                    if($pay_mode !=''){
                        $query_sale1 = $this->db->query("SELECT * from sales  where  party_id='".$party_row->id."' and id='".$f4->sales_id."' and cancel_status!='1'");
                        $count_row = $query_sale1->num_rows();
                        if($count_row > 0){  
                                            ?>
                                            <tr style="font-size: 11px;line-height:14px" >
                                                <td colspan="1"  style="text-align:center"><?php echo $n++; ?>.</td>
                                                <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($date_value))  ?> </td>
                                                <td colspan="1"  style="text-align:center">CREDIT by <?php echo ucfirst($pay_mode); ?> For Bill No. <?php echo $f4->sales_id; ?> </td>
                                                <td colspan="1"  style="text-align:center"></td>
                                                <td colspan="1"  style="text-align:center"><?php  echo $depo_amt=$f4->deposit ; ?></td>
                                            </tr>
                                            <?php           $credit+=$depo_amt; 
                        }
                    }
                } 
            }
            $query_sale_retr = $this->db->query("SELECT * from sales  where  party_id='".$party_row->id."' and return_date ='".$date_value."' and cancel_status!='1'");
            $count_retur = $query_sale_retr->num_rows();
            $fetch_sale_retr = $query_sale_retr->result();
            foreach($fetch_sale_retr as $f2)
            {
                if($f2->receive_amt==0 && $f2->return_amt!=''){
                    $dep_amt=0;
                }
                else{
                    $dep_amt=$f2->return_amt;
                }
                                            ?>
                                            <tr style="font-size: 11px;line-height:16px" >
                                                <td colspan="1"  style="text-align:center"><?php echo $n++; ?>.</td>
                                                <td colspan="1"  style="text-align:center"><?php echo date('d-m-Y',strtotime($date_value))  ?> </td>
                                                <td colspan="1"  style="text-align:center">
                                                    Sales Return of Sales Bill No. <?php echo $f2->id;  ?>
                                                </td>
                                                <td colspan="1"  style="text-align:center"><?php   echo $dep_amt;?></td>
                                                <td colspan="1"  style="text-align:center"></td>
                                            </tr>
                                            <?php $total_debit+=($dep_amt);
            }
        }?>
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
                                                <td></td>
                                                <td  style="text-align:center"><b><?php echo round(abs($outstanding)); ?></b></td>
                                            </tr>   
                                            <?php 
        }
        else{
                                            ?>
                                            <tr>
                                                <td  colspan="4" style="text-align:center"> Dr. <i> Closing Balance</i> </td>
                                                <td   style="text-align:center"><b><?php echo round($outstanding); ?></b></td>
                                                <td></td>
                                            </tr> 
                                            <?php  } ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </page>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
    <?php } ?>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   
<script>
    $('#search_party').autocomplete({
        source: '<?=base_url()?>SaleController/getParty',
        select: function (event, ui) {
            var name = ui.item.label
            $("#id_party").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_party").val(name); // display the selected text
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