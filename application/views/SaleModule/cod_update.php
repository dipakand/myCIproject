<?php $fetchparty ;?>
<?php //print_r($sale_row->id);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-8 col-md-offset-2 text-center ">&nbsp;
            <form method="post">
                <div class="col-sm-12">
                    <div style="text-align:center">
                        <div class="col-sm-4 col-sm-offset-2"><b>COD In Percente (%) : </b><input type="text" name="cod" step="0.01" max="99" class="form-control" value="<?php echo $sale_row->cod_percent;?>"></div>
                        <div class="col-sm-4"><b>Bill Date : </b><input type="date" name="todate" class="form-control" value="<?php echo $sale_row->date;?>"></div>
                        <br>

                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="col-sm-6">&nbsp;
                                <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                            </div>
                            <div class="col-sm-6">&nbsp;<a href="<?php echo site_url('SaleController/cancel_edit_deal');?>" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>  
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<style>
    .ui-autocomplete{
        cursor : pointer;
        height: 200px;
        overflow-y: scroll;
    }
</style>
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
    $('#search_barcode').autocomplete({
        source: '<?=base_url()?>SaleController/getbarcode',
        /*select: function (event, ui) {
            var name = ui.item.label
            //$("#barco").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_barcode").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            //$( "#barco" ).val( ui.item? ui.item.value : 0 );
        }*/
    });
</script>