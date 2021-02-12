<?php 
//print_r($pendiing_sales);
//echo $aging;
?>
<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('SaleModule/tabes');?>
        &nbsp;
        <ul class="nav nav-pills nav-justified">
            <li><a>Pending List</a href="<?php echo site_url('PendingList');?>"></li>
            <li class="active"><a >Partywise pending List</a></li><!--sale_partywise.php-->
        </ul>
        <?php
        $from_dt;
        $to_dt;
        ?>
        <div class="col-md-12"> &nbsp;
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-2 col-md-offset-2">
                        <div class="form-group"><b>Enter Date From :</b>
                            <input type="text" name="from_date" class="form-control datepicker" autocomplete=off required value="<?php echo $from_dt;?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group"><b>To :</b>
                            <input type="text" name="to_date" class="form-control datepicker" autocomplete=off required value="<?php echo $to_dt?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group"><b>Aging</b>
                            <input type="number" min="0" name="aging" class="form-control" autocomplete=off>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <b>&nbsp;</b>
                        <button type="submit" name="submit" class="btn btn-success btn-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <!--<div><a href="import_excel.php?frm=<?php echo $fst_dt;?>&&todate=<?php echo $lst_dt;?>" class="btn btn-primary pull-right">Export Excel</a></div>-->
        </div>
        <div class="col-md-12 table-responsive">&nbsp;
            <table class="table table-stripted text-center" id="example" width="100%">
                <thead>
                    <tr class="warning">
                        <td colspan="10"><b>Date From : <?php //echo date("d-m-Y",strtotime($fst_dt)) ;?>&nbsp; To : <?php //echo date("d-m-Y",strtotime($lst_dt)) ; ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Sr. No.</b></td>
                        <td><b>invoice No.</b></td>
                        <td><b>Party Name</b></td>
                        <td><b>Contact No</b></td>
                        <td><b>Invoice Date</b></td>
                        <td><b>Due Date</b></td>
                        <td><b>Total Amount</b></td>
                        <td><b>Pending Amount</b></td>
                        <td><b>Days</b></td>
                        <td><b>Payment</b></td>
                        <?php /*if($exp != 'sale_party_print.php'){?>
                        <?php }*/?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($aging != ''){

                        $agiing = $aging;
                        $curr_date = date("Y-m-d");

                        $aging_date = date("Y-m-d" ,strtotime("+".$agiing." day",strtotime($curr_date)));
                    }



                    $tbl=1;
                    $s=0;
                    $mp_id = 0;
                    $mp_id_count = 1;
                    $total_amt=0; $grand_total_amt=0; $grand_pending_total=0;
                    foreach($pendiing_list as $sale)
                    {  
                        $total_amt += (Int)$sale->total_amt - (Int)$sale->return_amt;
                        if($sale->cod_amt > 0)
                        {
                            $total = (Int)$sale->cod_amt - (Int)$sale->receive_amt - (Int)$sale->credit_amt - (Int)$sale->return_amt;
                        }
                        else
                        {
                            $total = (Int)$sale->total_amt - (Int)$sale->receive_amt - (Int)$sale->credit_amt - (Int)$sale->return_amt;
                        }
                        if((Int)$sale->total_amt !== ((Int)$sale->receive_amt + (Int)$sale->credit_amt) || ((Int)$sale->receive_amt > 0 && (((Int)$sale->receive_amt + (Int)$sale->credit_amt) !== (Int)$sale->cod_amt)) )
                        {
                            if($total>0)
                            {
                                $s++;

                                $date1 = date_create($sale->date);
                                $date2 = date_create(date("Y-m-d"));
                                $diff = date_diff($date1,$date2);
                                $days = $diff->format("%a");

                                //if($s <= 1)
                                if(($aging != '' && $days >= $agiing) || ($aging == ''))
                                {

                                    if($sale->mp_id != $mp_id)
                                    {
                                        $mp_id_count++;
                                    }
                                    if($mp_id_count%2==0)
                                    {
                                        $back_color = '#c5c5c5';
                                    }
                                    else
                                    {
                                        $back_color = '';
                                    }
                    ?>
                    <tr style="background-color: <?php echo $back_color;?>;">
                        <td><?php echo $s;?></td>
                        <td><?php 
                                    if($sale->bill_no!='')
                                    {
                                        echo $sale->bill_no;
                                    }else{
                                        echo $sale->id;
                                    }

                            ?></td>
                        <td style="text-transform:capitalize; text-align:left;"><?php echo $sale->party_name;?>
                        </td>
                        <td><?php echo $sale->contact_no;?></td>
                        <td><?php echo date("d-m-Y",strtotime($sale->date)) ;?></td>
                        <td><?php $n= $sale->limit_days;
                                    echo $enddate = date("d-m-Y",strtotime ( $n.'day' , strtotime ( $sale->date ) )) ;
                            ?></td>
                        <td><?php echo round((Int)$sale->total_amt-(Int)$sale->return_amt,2);
                                    if(((Int)$sale->total_amt-(Int)$sale->return_amt > 0)){
                                        $grand_total_amt +=(Int)$sale->total_amt-(Int)$sale->return_amt;
                                    }
                            ?>
                        </td>
                        <td style="color:red;"><?php echo round($total,2);
                                    if($total > 0){
                                        $grand_pending_total +=$total;
                                    }
                            ?>
                        </td>
                        <td><?php 
                                    echo $days;
                            ?>
                        </td>
                        <td><a href="<?php echo site_url('ReceiveMain/'.$sale->id.'/party_pending');?>" class="btn btn-default">Receive</a></td>
                    </tr>
                    <?php
                                    $mp_id = $sale->mp_id;
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td style="border: 1px solid #ccc;" colspan="6"></td>
                        <td style="border: 1px solid red;"><b><?php echo $grand_total_amt;?></b></td>
                        <td style="border: 1px solid #FF4500;"><b><?php echo $grand_pending_total;?></b>
                        </td>
                        <td style="border: 1px solid #ccc;" colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<!--<script src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>-->
<script> 
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [
                {
                    extend: 'excel',className: 'btn-primary',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6,7,8] //Your Colume value those you want
                    },
                },
                {
                    extend: 'pdf',className: 'btn-primary',orientation:'landscape',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6,7,8] //Your Colume value those you want
                    },
                },
                //  {
                //extend: 'csvHtml5',className: 'btn-primary',
                //exportOptions: {
                //columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10] //Your Colume value those you want
                //    }
                //  },
                {
                    extend: 'print',className: 'btn-primary',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6,7,8] //Your Colume value those you want
                    }
                },
            ],
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
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