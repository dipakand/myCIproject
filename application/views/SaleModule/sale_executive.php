<div class="row"> 
    <div class="col-lg-12">
        <?php $this->load->view('SaleModule/tabes');?>
        &nbsp;
        <div class="col-md-12 table-responsive">&nbsp;
            <table class="table table-stripted text-center" id="example" width="100%">
                <thead>
                    <tr>
                        <td><b>Sr. No.</b></td>                              
                        <td><b>Party Name</b></td>
                        <td><b>Sale Executive Name</b></td>
                        <td><b>Date</b></td>
                        <td><b>Taxable Amount</b></td>
                        <td><b>Total Amount</b></td>
                        <td></td>
                        <!--                                        <td style="width:5%;"><input type="checkbox" id="selecctall"></td>-->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($tem_data != 0)
                    {
                        $s=0;
                        foreach($tem_data as $temp_sale)
                        {
                            $s++;
                            //if($s == 1)
                            {
                    ?>
                    <tr>
                        <form method="post">
                            <td><?php echo $s;?></td>
                            <td style="text-transform:capitalize; text-align:left;"><?php echo $temp_sale->party_name ; //$temp_sale->contact_no ; ?> </td>
                            <td style="text-transform:capitalize; text-align:center;"><?php  echo $temp_sale->sale_name ; ?> </td>
                            <td><?php echo date("Y-m-d",strtotime($temp_sale->date));?></td>
                            <td><?php echo $temp_sale->taxable_amt;?></td>
                            <td><?php echo $temp_sale->total_amt;?></td>
                            <td style="width:5%;">
                                <input type="hidden" class="" name="sales_check" value="<?php echo $temp_sale->id; ?>"/>

                                <a href="<?php echo site_url('EditTempSale/'.$temp_sale->id);?>" class="btn btn-primary">Submit</a><!--edit_temp_sales.php?id=<?php //echo $temp_sale->id; ?>-->
                            </td>
                        </form>
                    </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br/>
            <div class="col-sm-4 col-sm-offset-4">
                <!--                                        <button type="submit" class="btn btn-success btn-block form-control" name="btn_submit">Submit </button>-->
            </div>
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