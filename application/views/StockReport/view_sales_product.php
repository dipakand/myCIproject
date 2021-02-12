<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('StockReport/tabs');?>
    </div>
    <div class="col-md-12 ">&nbsp;
        <form method="post">                                 
            <div class="col-md-12 ">
                <div class="col-md-3">
                    <div class="form-group"><b>&nbsp;Search By Product Name: </b>
                        <input type="text" name="barcode" id="search_barcode" class="form-control text-capitalize" required placeholder="Enter Product Name" />
                        <input type="hidden" name="product_id" id="product_id">
                    </div>                                                
                </div>    
                <div class="col-md-2">
                    <div class="form-group" required><b>&nbsp;From Date : </b>
                        <input type="text" name="frm_date"  class="form-control datepicker" style="" required autocomplete="off" >
                    </div>                                                
                </div>  
                <div class="col-md-2">
                    <div class="form-group" required><b>&nbsp;To Date : </b>
                        <input type="text" name="to_date" id="" class="form-control datepicker" style="" required autocomplete="off" >
                    </div>                                                
                </div> 
                <div class="col-md-3">
                    <div class="form-group" required><b>&nbsp;Search Party Name : </b>
                        <input type="text" name="party_name" id="search_party" class="form-control" style="text-transform:capitalize;" placeholder="Enter Party Name" >
                        <input type="hidden" name="party_id" id="id_party" class="form-control" style="text-transform:capitalize;" autofocus >
                    </div>                                                
                </div> 
                <div class="col-md-2">
                    <div class="form-group">&nbsp;
                        <button type="submit" class="btn btn-success btn-block" name="search"><span class="glyphicon glyphicon-search"></span> Search   </button>       
                    </div>
                </div>
            </div>                               
        </form>
    </div>

    <?php
    $sale_rows;
    //print_r($sale_rows);
    ?>
    <?php
    if($sale_rows != '')
    {
    ?>
    <div class="col-md-10 col-md-offset-1">&nbsp;
        <form method="post">                                 
            <table class="table table-striped text-center table-hover" id="example" width="100%">
                <thead>
                    <tr class="danger ">
                        <td colspan="3" style="text-align:left;">
                            <b>Date From : <?php echo date("d-m-Y",strtotime($frm_date)); ?>&nbsp; - To : <?php echo date("d-m-Y",strtotime($to_date)) ;?></b>
                        </td>
                        <td colspan="4" style="text-align:right;">
                            <?php
        $this->db->select('product_desc.*, product.name as proname');
        $this->db->where('product_desc.id',$product_id);
        $this->db->join('product','product_desc.product_id = product.product_id');
        $query = $this->db->get('product_desc');
        $product_desc_nam = $query->row();
                            ?>
                            <b>Available Stock For <?php echo ucwords($product_desc_nam->proname); ?> is <?php echo $product_desc_nam->stock; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Sr. No.</b></td>
                        <td><b>Date</b></td>
                        <td><b>Party Name</b></td>
                        <td><b>Product Name</b></td>
                        <td><b>Qty</b></td>
                        <td><b>Free Qty</b></td>
                        <td><b>Total Qty</b></td>
                    </tr>
                </thead>


                <tbody>    
                    <?php
        $sr=0;$finl_tot=0;$qty_tot=0;$free_tot=0;
        foreach($sale_rows as $sale)
        {
            //                        unset($id);
            //                        unset($free);
            //                        unset($qty);

            $id = array();
            $free = array();
            $qty = array();

            $item=unserialize($sale->item_detail);
            $n=0;

            foreach($item as $item_key => $item_val)
            {
                if($sale->return_item!='')
                {
                    $item2=unserialize($sale->return_item);
                    foreach($item2 as $key => $item2_val)
                    {
                        if($item2_val[0] == $item_val[0])
                        {
                            if($item2_val[0]==$product_id){
                                $ret = $item_val[1]-$item2_val[1]; 
                                $qty_cl=$ret; 
                                $id []=$item_val[0];
                                $qty []=$qty_cl;
                                $free[]=$item_val[3];
                                $n++;
                            }
                        }
                    }  
                }
                else
                {
                    //echo $item_val[0]."==".$product_id; echo nl2br("\n");
                    if($item_val[0]==$product_id){ 
                        $ret = $item_val[1]; 
                        $qty_cl=$ret; 
                        $id []=$item_val[0];
                        $free[]=$item_val[3];
                        $qty []=$qty_cl;
                        $n++;
                    }
                }
            }  
            $totl= array_sum($qty) + array_sum($free);
            //echo $totl; echo nl2br("\n");

            if($totl > 0)
            {
                $sr++;
                $qty_tot+=array_sum($qty);
                $free_tot+=array_sum($free);
                $finl_tot +=$totl;
                    ?>
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($sale->date)); ?></td>
                        <td><?php 
                $mang_party21 = $this->db->where('id',$sale->party_id)->get('manage_party')->row();
                echo ucwords($mang_party21->name); ?></td>
                        <td>
                            <?php 
                //$select12="select * from product_desc where  id='".$id[0]."'";
                //$query12=mysqli_query($conn,$select12);
                //$fetch12=mysqli_fetch_assoc($query12);
                //$select11="select * from product where product_id='".$fetch12['product_id']."'";
                //$query11=mysqli_query($conn,$select11);
                //$fetch11=mysqli_fetch_assoc($query11);
                //echo ucwords($fetch11['name']).'-'.ucfirst($fetch12['weight']);
                echo ucwords($product_desc_nam->proname.' '.$product_desc_nam->weight); 
                            ?>
                        </td>
                        <td><?php echo array_sum($qty);//.' '.$fetch12['unit']; ?></td>
                        <td><?php echo array_sum($free); ?></td>
                        <td><?php echo $totl; ?></td>
                    </tr>
                    <?php
            }
        }

                    ?>      
                </tbody>
                <tfoot >
                    <tr  >
                        <td  style="border:1px solid black">&nbsp;</td>
                        <td style="border:1px solid black" >&nbsp;</td>
                        <td style="border:1px solid black" >&nbsp;</td>
                        <td colspan="" style="text-align:right;border:1px solid black"><b>Total</b></td>
                        <td style="text-align:center;border:1px solid black;"><b><?php  echo $qty_tot;?></b></td>
                        <td style="text-align:center;border:1px solid black;"><b><?php  echo $free_tot;?></b></td>
                        <td style="text-align:center;border:1px solid black;"><b><?php echo $finl_tot; ?></b></td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <?php }?>

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
    $('#search_barcode').autocomplete({
        source: '<?=base_url()?>StockRportController/getproduct',
        select: function (event, ui) {
            var name = ui.item.label
            $("#product_id").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_barcode").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            //$( "#product_id" ).val( ui.item? ui.item.value : 0 );
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