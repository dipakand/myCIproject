<?php $fetchparty ;?>
<?php //print_r($sale_row->id);


$total=0;
if($sale_row->cod_amt > 0)
{
    $total = (Int)$sale_row->cod_amt - (Int)$sale_row->receive_amt - (Int)$sale_row->credit_amt - (Int)$sale_row->return_amt;
}
else
{
    $total = (Int)$sale_row->total_amt - (Int)$sale_row->receive_amt - (Int)$sale_row->credit_amt - (Int)$sale_row->return_amt;
}
$total_amt =$total;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="col-md-4 col-md-offset-4">&nbsp;
            <form method="post">
                <table class="table table-striped">
                    <tr class="danger">
                        <td class="text-center"><b>Total Pending Amount :- </b><?php echo round($total_amt,2);?></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-md-4 col-md-offset-4  ">&nbsp;
            <table class="table table-bordered">
                <?php 
                if($sale_row->cod_percent > 0) 
                {
                ?>
                <div class="col-sm-12 ">&nbsp;
                    <a class="btn btn-primary btn-block" href="<?php echo site_url('ReceivePayment/'.$sale_row->id);?>">COD Amount</a> </div>
                <?php 
                } 
                else 
                {
                ?>

                <div class="col-sm-12 ">
                    <a class="btn btn-primary btn-block" href="<?php echo site_url('ReceivePayment/'.$sale_row->id);?>">Normal Amount</a>
                </div>
                <?php
                    $num=$sale_log_row;
                    if($num == 0 && $sale_row->receive_amt == 0){
                ?>
                <div class="col-sm-6 col-sm-offset-3">&nbsp;
                    <form method="post" action="<?php echo site_url('SaleController/sale_cod');?>">
                        <table class="table table-striped" width="50%">
                            <tr class="">
                                <td class="text-center" style="vertical-align: middle;"><b>COD %</b></td>
                                <td class="text-center"><input type="number" name="cod" class="form-control" required></td>
                                <input type="hidden" name="s_id" id="" value="<?php echo $sale_row->id;?>">
                            </tr>
                            <tr class="">
                                <td colspan="2">
                                    <button class="btn btn-danger btn-block" name="btncod">COD</button>
                                </td>
                            </tr>
                        </table> 
                    </form>
                </div>
                <?php }
                }
                ?>
            </table>
            <?php
            ?>
        </div>

    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>

