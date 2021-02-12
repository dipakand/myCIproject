<div class="row"> 
    <div class="col-lg-12">
        <?php $this->load->view('SaleModule/tabes');?>
        &nbsp;
        <div class="col-md-12"> &nbsp;
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-2 col-md-offset-3">
                        <div class="form-group"><b>Enter Date From :</b>
                            <input type="text" name="from_date" class="form-control datepicker" autocomplete=off required value="<?php echo $from_date;?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group"><b>To :</b>
                            <input type="text" name="to_date" class="form-control datepicker" autocomplete=off required value="<?php echo $to_date?>">
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <b>&nbsp;</b>
                        <button type="submit" name="submit" class="btn btn-success btn-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-md-offset-3 table-responsive">&nbsp;
            <table class="table table-striped text-center table-hover" id="example" width="100%">
                <thead>

                    <tr class="danger text-center"><td colspan="8">
                        <b>Date From : <?php //echo date("d-m-Y",strtotime($_POST['from_date'])); ?>&nbsp; - To : <?php //echo date("d-m-Y",strtotime($_POST['to_date'])) ;?></b>
                        </td></tr>
                    <tr>
                        <td><b>Sr. No.</b></td>
                        <td><b>Product Name</b></td>
                        <td><b>Weight</b></td>
                        <td><b>Qty</b></td>
                        <td><b>Free Qty</b></td>
                        <td><b>Total Qty</b></td>
                        <td><b>NOS</b></td>
                        <td><b>Total</b></td>
                    </tr>
                </thead>
                <tbody>

                    <?php

    if(count($sale_summary) > 0)
    {
        $sr=0;
        //print_r($sale_summary);
        $grnad_to = 0;
        foreach($sale_summary as $value)
        { 
            //print_r($value); echo nl2br("\n");
            $sr++;
            $totl= $value['qty']+$value['free'];
            $tot_no = $value['qty']*$value['nos'];
            $grnad_to+=$tot_no;
                    ?>
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td><?php echo ucwords($value['pro_name']); ?></td>
                        <td><?php echo ucfirst($value['weight']); ?></td>
                        <td><?php echo $value['qty'];//echo $value['qty'].' '.$value['unit']; ?></td>
                        <td><?php echo $value['free']; ?></td>
                        <td><?php   echo $totl; ?></td>
                        <td><?php echo $value['nos']; ?></td>
                        <td><?php echo $tot_no; ?></td>
                    </tr>
                    <?php
        }
    }
                    ?>
                </tbody>
                <?php

                if(count($sale_summary) > 0)
                {
                ?>
                <tfoot>
                    <td colspan="6"></td>
                    <td><b>Grand Total</b></td>
                    <td><?php echo $grnad_to; ?></td>
                </tfoot>
                <?php }?>
            </table>
        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<script> 
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [
                {
                    extend: 'excel',className: 'btn-primary',
                    exportOptions: {
                        //columns: [ 0, 1, 2, 3,4,5,6,7,8] //Your Colume value those you want
                    },
                },
                {
                    extend: 'pdf',className: 'btn-primary',orientation:'landscape',
                    exportOptions: {
                        //columns: [ 0, 1, 2, 3,4,5,6,7,8] //Your Colume value those you want
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
                        //columns: [ 0, 1, 2, 3,4,5,6,7,8] //Your Colume value those you want
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