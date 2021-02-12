<?php $fetchparty ;?>
<?php //print_r($sale_row->id);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-12 ">&nbsp;&nbsp;&nbsp;
            <form method="post"> 
                <div class="col-md-3">
                    <div class="form-group"><b>&nbsp; Party Name : </b>
                        <input type="text" name="party_name_old" id="party_name_old" class="form-control" Readonly style="text-transform:capitalize;" value="<?php echo $fetchparty->name; ?>">
                    </div>                                                
                </div>                                 
                <div class="col-md-3">
                    <div class="form-group"><b>&nbsp;Search Party Name : </b>
                        <input type="text" name="party_name_new" id="search_party" class="form-control" autofocus style="text-transform:capitalize;" placeholder="Enter Name" required>
                        <input type="hidden" name="party_id_new" id="id_party" >
                    </div>                                                
                </div> 
                <div class="col-md-3">
                    <div class="form-group"><b>&nbsp;Password : </b>
                        <input type="text" name="password_vl" id="password_vl" class="form-control"  placeholder="Enter Password" autocomplete="off" required>
                    </div>                                                
                </div>   
                <div class="col-md-3 ">
                    <div class="form-group">&nbsp;
                        <button type="submit" class="btn btn-success btn-block" name="search"> Change Party </button>       
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