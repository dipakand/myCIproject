<div class="row"> 
    <div class="col-lg-12">
        <?php $this->load->view('SaleModule/tabes');?>
        &nbsp;
        <div class="col-md-12"> &nbsp;
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="form-group"><b>&nbsp;Serach Party Name : </b>
                            <!--<input type="text" name="party_name" id="search_party" class="form-control" style="text-transform:capitalize;" autofocus required>-->
                             <input type="text" name="party_name" id="search_party" class="form-control" autofocus style="text-transform:capitalize;" placeholder="Enter Name" />
                            <input type="hidden" name="id_party" id="id_party" value="sfsf" />
                        </div>                                                
                    </div>                                                                                       
                    <div class="col-md-2 ">
                        <div class="form-group"><b>Enter Date From :</b>
                            <input type="text" name="from_date" class="form-control datepicker" autocomplete=off required value="<?php //echo $from_date;?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group"><b>To :</b>
                            <input type="text" name="to_date" class="form-control datepicker" autocomplete=off required value="<?php //echo $to_date?>">
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

        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
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

<!--<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>-->
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
            $( "#id_party" ).val( ui.item? ui.item.value : '' );
        }
    });
</script>