<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('StockReport/tabs');?>
    </div>
    <div class="col-md-12">&nbsp;
        <form method="post">
            <div class="col-sm-4 col-sm-offset-4">
                <button type="submit" name="all_report" class="btn btn-success btn-block">Click To View All Report</button>
            </div>
        </form>
    </div>
    <?php 
    //print_r($product_stock);
    if($product_stock != '')
    {
    ?>

    <?php ?>
    <div class="col-sm-2 col-sm-offset-5 text-center">&nbsp;
        <a onclick="printDiv()" class="btn btn-primary glyphicon glyphicon-print"></a>
    </div>
    <div class="col-md-4 col-sm-offset-4">&nbsp;
        <div style="border:1px solid black;" id="DivIdToPrint">
            <table align="center" style="width:100%;" cellspacing="0" cellpadding="0">
                <tr>
                    <td  colspan="2"  style="text-align:center; font-size:16px; border-bottom:1px solid black; border-left:none;"><b>STOCK REPORT</b> </td>
                </tr>
                <tr hidden="hidden">
                    <td colspan="2" width="100%" style="border:1px solid black; border-left:none;">
                        <table width="100%" cellpadding="0" cellspacing="2">
                            <tr><td style="text-align:center; font-size:20px; text-transform:capitalize;"><b><?php echo $company_row->company_name;?></b></td></tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <table width="100.4%" style="text-align:center; " cellspacing="0" cellpadding="0">
                            <tr style="background-color:#DBDBDB;">
                                <td style="font-size:11px; border:1px solid #000; border-top:none; border-left:none; width:10%;"><b>SR. NO.</b></td>
                                <td style="font-size:11px; border:1px solid #000; border-top:none; width:%; text-align:left; padding-left:1%;"><b>PRODUCT NAME</b></td>
                                <td style="font-size:11px; border:1px solid #000; border-top:none; width:20%;"><b>QTY</b></td>
                            </tr>
                            <?php
        $sr=0;
        foreach($product_stock as $prodcut)
        {
            $sr++;
            $name= ucwords($prodcut->proname).' '.$prodcut->weight.' ('.$prodcut->brname.')';
                            ?>
                            <tr>
                                <td style="font-size:11px; border:1px solid #ccc; border-left:none;"><?php echo $sr;?></td>
                                <td style="font-size:11px;  text-align:left; padding-left:.5%; border:1px solid #ccc; border-left:none;"><?php echo $name;?></td>
                                <td style="font-size:11px; border:1px solid #ccc; border-left:none; border-right:none"><?php echo round((Int)$prodcut->stock,3);?></td>
                            </tr>
                            <?php
        }
                            ?>
                            <tr>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <?php } ?>

    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div> 

<script type="text/javascript">
    function printDiv() {    
        var printContents = document.getElementById('DivIdToPrint').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<script>
    $("#ExportToExcel").click(function (e) {
        let file = new Blob([$('#DivIdToPrint').html()], { type: "application/vnd.ms-excel" });
        let url = URL.createObjectURL(file);
        let a = $("<a />", {
            href: url,
            download: "filename.xls"
        }).appendTo("body").get(0).click();
        e.preventDefault();
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