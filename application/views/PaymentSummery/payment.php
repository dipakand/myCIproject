<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
        <form method="post" name="form1">
            <div class="col-sm-12">
                <div class="col-sm-2 col-sm-offset-3"><b>Date From : </b>
                    <input type="text" name="frm_dt" id="frm_dt" value="<?php echo $frmdate;?>" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="col-sm-2"><b>Date To : </b>
                    <input type="text" name="to_dt" id="to_dt" value="<?php echo $todate;?>" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="col-sm-2"><br/>
                    <button class="btn btn-success btn-block" id="select_date" name="select_date" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <form method="POST" class="form-group-sm">&nbsp;
            <table class="table table-striped table-bordered" id="example" width="100%">
                <thead>
                    <tr class="danger">
                        <th>Sr.</th>
                        <th>Date</th>
                        <th>Party Name</th>
                        <th>Bill No</th>
                        <th>Mode Of Payment</th>
                        <th>Invoice Amount</th>
                        <th>Amount Received</th>
                        <th>CD</th>
                        <th>CD Amt</th>

                        <th>Cheque No</th>
                        <th>Cheque Amt</th>
                        <th>Date</th>
                        <th>Bank Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n=1;
                    if($sales_log_rows > 0)
                    {
                    foreach($sales_log_rows as $sale_log)
                    {
                        $unser_arr = unserialize($sale_log->detail);
                        $type = array();$tot=0;
                        foreach($unser_arr as $vl)
                        {
                            $type[]=$vl['type'];
                            $tot +=$vl['amt'];
                        }
                    ?>
                    <tr>
                        <td><?php echo $n++; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($sale_log->date_time)); ?></td>
                        <td><?php echo ucwords($sale_log->p_name); ?></td>
                        <td class="text-right"><?php echo $sale_log->sales_id; ?></td>
                        <td><?php echo implode(', ',$type); ?></td>
                        <td class="text-right"><?php echo  (Int)$sale_log->total_amt; if((Int)$sale_log->cod_amt == 0 ){   (Int)$sale_log->total_amt;} else {  (Int)$sale_log->cod_amt;} ?></td>
                        <td class="text-right"><?php echo $tot; ?></td>
                        <td class="text-right"><?php echo (Int)$sale_log->cod_percent; ?>%</td>
                        <td class="text-right"><?php if((Int)$sale_log->cod_amt > 0){ echo (Int)$sale_log->total_amt-(Int)$sale_log->cod_amt;} else{ echo ' - ';} ?></td>
                        <?php
                        $no='-';
                        $amt='-';
                        $date='-';
                        $name='-';
                        foreach($unser_arr as $value)
                        {
                            if($value['type']=='cheque')
                            {
                                $no=$value['no'];
                                $amt=$value['amt'];
                                $date=$value['date'];
                                $name=$value['name'];
                            }
                        }
                        ?>

                        <td><?php echo $no; ?></td>
                        <td><?php echo $amt; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   


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
<script> 
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            // buttons: [ 'copy', 'excel', 'pdf', 'csvHtml5','print' ]
            buttons: [
                {
                    extend: 'excel',footer: true,className: 'btn-primary', 
                    exportOptions: {         
                        columns: ':visible'         
                    }
                },
                {
                    extend: 'pdfHtml5',footer: true,className: 'btn-primary',
                    customize: function (doc) { doc.defaultStyle.alignment = 'center'; doc.styles.tableFooter.alignment = 'center'; },
                    exportOptions: {         
                        columns: ':visible'         
                    }
                },
                {
                    extend: 'print',footer: true,className: 'btn-primary',
                    exportOptions: {         
                        columns: ':visible'         
                    }
                    //							customize: function ( win ) {
                    //							$(win.document.body).find( 'table' ).addClass( 'display' ).css( 'text-align', 'right' );
                    //							}
                },
            ],
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script> 