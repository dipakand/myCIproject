<div class="row">
    <?php
    if(!$this->session->userdata('party_row'))
    {
    ?>
    <div class="col-md-12 ">&nbsp;
        <form method="post">                                 
            <div class="col-md-12 ">
                <div class="col-md-4 col-md-offset-3">
                    <div class="form-group"><b>&nbsp;Serach Party Name : </b>
                        <input type="text" name="party_name" id="search_party" class="form-control" autofocus required style="text-transform:capitalize;">
                        <input type="hidden" name="party_id" id="id_party" class="form-control" style="text-transform:capitalize;" autofocus >
                    </div>                                                
                </div>                                                                                       
                <div class="col-md-2">
                    <div class="form-group">&nbsp;
                        <button type="submit" class="btn btn-success btn-block" name="search" value="party"><span class="glyphicon glyphicon-search"></span>Submit</button>       
                    </div>
                </div>
            </div>                               
        </form>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="col-md-8 col-md-offset-2">&nbsp;
        <form method="post" name="form1" action="<?php echo site_url('SpecialReturnController/make_array');?>">
            <table class="table table-striped ">
                <tr>                                      
                    <td width="60%" style=" width:50%; text-align:"><b>Select Case:  </b>
                        <select class="form-control"  name="case" required>   
                            <option value=""
                                    <?php

        if($this->session->userdata('case') == 'case_1')
        {
            echo "disabled";
        }
        elseif($this->session->userdata('case') == 'case_2')
        {
            echo "disabled";
        }
                                    ?>
                                    >Select Case</option>
                            <option value="case_1" 
                                    <?php
        if($this->session->userdata('case') == 'case_1')
        {
            echo "selected";
        }
        elseif($this->session->userdata('case') == 'case_2')
        {
            echo "disabled";
        }
                                    ?>
                                    > Case 1</option>
                            <option value="case_2"
                                    <?php
        if($this->session->userdata('case') == 'case_2')
        {
            echo "selected";
        }
        elseif($this->session->userdata('case') == 'case_1')
        {
            echo "disabled";
        }
                                    ?>
                                    >Case 2</option>
                        </select>
                    </td>
                    <td><b>Return Date :</b>
                        <input class="form-control datepicker" type="text" autocomplete=off name="inv_date" 
                               value="<?php echo $this->session->userdata('inv_date'); ?>" required>
                    </td>
                </tr>
            </table>
            <table class="table table-striped ">

                <tr>
                    <td><b>&nbsp;Barcode :</b></td>
                    <td><b>&nbsp;Quantity :</b></td>
                    <td><b>&nbsp;Rate :</b></td>
                </tr>
                <tr>
                    <td><input type="text" name="barcode" class="form-control" required autofocus></td>
                    <td><input type="number" name="qty"  min=0 class="form-control" required></td>
                    <td><input type="number" name="rate"  min=0 class="form-control" required></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center">
                        <button type="submit" class="btn btn-warning" name="submit" value="add_item">Submit</button>
                    </td>
                </tr>
            </table>                                  
        </form>
    </div>

    <?php
        if($this->session->userdata('all_item'))
        {
    ?>
    <div class="col-md-8 col-md-offset-2">&nbsp;
        <form method="post" name="form2" action="<?php echo site_url('SpecialReturnController/save_case1');?>">
            <table class="table table-striped text-center">
                <tr>
                    <td><b>Sr. No.</b></td>
                    <td><b>Product</b></td>
                    <td><b>Weight</b></td>
                    <td><b>Barcode</b></td>
                    <td><b>QTY</b></td>
                    <td><b>Rate</b></td>
                    <td><b>Total Amount</b></td>
                    <td><b>Delete</b></td>
                </tr>
                <?php
            $sr=0;
            $total_amt=0;
            $total_vals=0;
            foreach($this->session->userdata('all_item') as $ke => $va)
            {   $sr++;

             $this->db->select('product_desc.*, product.name as proname');
             $this->db->where('product_desc.id',$va["id"]);
             $this->db->join('product','product_desc.product_id = product.product_id');
             $query1 = $this->db->get('product_desc')->row();
                ?>
                <tr>
                    <td><?php echo $sr; ?></td>
                    <td><?php echo ucwords($query1->proname); ?></td>
                    <td><?php echo $query1->weight;?></td>
                    <td><?php echo $query1->barcode;?></td>
                    <td><?php echo $va['qty'];?></td>
                    <td><?php echo $va['rate'];?></td>
                    <td><?php echo $to_vals= $va['qty'] * $va['rate'];
             $total_vals +=$to_vals;

                        ?></td>

                    <td><a href="<?php echo site_url('SpecialReturnController/remove_item/'.$ke);?>" class="btn btn-danger btn-sm glyphicon glyphicon-remove"></a></td>
                </tr>
                <?php
            }
                ?>
                <tr>
                    <td colspan="8" class="text-center"> 
                        <input type="hidden" name="total_val" value="<?php echo $total_vals;?>">
                        <button class="btn btn-success" name="case1_save" type="submit">Submit</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>
    <?php
        }
    ?>
    <?php
        if($this->session->userdata('all_item1'))
        {
    ?>
    <div class="col-md-12 col-md-offset-">&nbsp;
        <form method="post" name="form3" action="<?php echo site_url('SpecialReturnController/save_case2');?>">
            <table class="table table-striped text-center">
                <tr>
                    <td><b>Sr. NO.</b></td>
                    <td><b>Product<br/>Name</b></td>
                    <td><b>Quantity</b></td>
                    <td><b>Rate</b></td>
                    <td><b>HSN</b></td>
                    <td><b>Taxable<br/>Amount</b></td>
                    <?php
            if($company_row->company_state == $this->session->userdata('party_row')->state_id)
            {
                    ?>
                    <td><b>C GST</b></td>
                    <td><b>S GST</b></td>
                    <?php
            }
            else
            { ?>
                    <td><b>i GST</b></td>
                    <?php
            }
                    ?>
                    <td><b>Delete</b></td>
                </tr>
                <?php
            $total_amt1=0;
            $sr1=0;
            $amt1=0;
            $c1=0;
            $tot_c1=0;
            $s1=0;
            $tot_s1=0;
            $i1=0;
            $tot_i1=0;
            foreach($this->session->userdata('all_item1') as $key => $val)
            {   
                $sr1++;

                ?>
                <tr>
                    <td><?php echo $sr1;?></td>
                    <td><?php

                $this->db->select('product_desc.*, product.name as proname');
                $this->db->where('product_desc.id',$val["id"]);
                $this->db->join('product','product_desc.product_id = product.product_id');
                $query1 = $this->db->get('product_desc')->row();
                echo ucwords($query1->proname); 

                        ?></td>
                    <td><?php echo $val['qty'];?></td>
                    <td><?php echo $val['rate'];?></td>
                    <td><?php echo $val['hsn'];?></td>
                    <td><?php echo $val['amt'];?></td>
                    <?php
                $amt1=$val['amt'];
                $total_amt1 +=$amt1;
                if($company_row->company_state == $this->session->userdata('party_row')->state_id)
                { 
                    $c1=$val['gstc'];
                    $tot_c1 +=$c1;
                    $s1=$val['gstc'];
                    $tot_s1 +=$s1;
                    ?>
                    <td><?php echo $val['gstc'];?></td>
                    <td><?php echo $val['gsts'];?></td>
                    <?php
                }
                else
                { 
                    $i1=$val['gstc'];
                    $tot_i1 +=$i1;
                    ?>
                    <td><?php echo $val['gsti'];?></td>
                    <?php
                }
                    ?>

                    <td><a href="<?php echo site_url('SpecialReturnController/remove_item2/'.$key);?>" class="btn btn-danger btn-sm glyphicon glyphicon-remove"></a></td>
                </tr>
                <?php
            }

            $total_val=$total_amt1+$tot_c1+$tot_s1+$tot_i1;
                ?>
                <tr>
                    <td><?php  ?></td>
                    <td><?php  ?></td>
                    <td><?php  ?></td>
                    <td><?php  ?></td>
                    <td><?php  ?></td>
                    <td><?php echo $total_amt1; ?></td>
                    <?php
            if($company_row->company_state == $this->session->userdata('party_row')->state_id)
            { ?>
                    <td><?php echo $tot_c1 ;?></td>
                    <td><?php echo $tot_s1 ;?></td>
                    <?php
            }
            else
            { ?>
                    <td><?php echo $tot_i1 ;?></td>
                    <?php
            }
                    ?>   
                    <td><?php echo $total_val; ?>
                        <input type="hidden" name="tatal_val" value="<?php echo $total_val; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php
            if($company_row->company_state == $this->session->userdata('party_row')->state_id)
            { 
                echo"12";
            }
            else
            { 
                echo "11";
            }
                                                     ?>
                                                     ">
                        <button class="btn btn-success" name="case2_save" type="submit">Return</button>
                    </td>
                </tr>

            </table>                                
        </form>
    </div>
    <?php
        }
    ?>
    <div class="col-md-12 ">&nbsp;
        <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">&nbsp;
                <a href="<?php echo site_url('SpecialReturnController/cancle_deal');?>" class="btn btn-default btn-block">Cancel</a>       
            </div>
        </div>
    </div>
    <?php
    }
    ?>
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
    /* $('#search_barcode').autocomplete({
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
    });*/
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