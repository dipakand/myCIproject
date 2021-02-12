<?php   
$pur_id = $this->uri->segment(2);
//print_r($hold_order_row);
?>
<div class="row">
    <div class="col-lg-12">
        <?php //$this->load->view('PurchaseOrder/tabs');?>
        <div class="col-md-12 ">&nbsp;
            <?php 

            $this->session->userdata('purchase_direct');

            $this->session->userdata('old');

            $this->session->userdata('order');

            $this->session->userdata('purchase_Rate');

            ?>
            <div class="col-md-12 ">&nbsp;
                <form method="post" name="form1">                                 
                    <div class="col-md-12 ">
                        <div class="col-md-3 col-md-offset-3">
                            <div class="form-group"><b>&nbsp;Search By Product Name : </b>
                                <input type="text" name="barcode" id="search_barcode" class="form-control text-capitalize" <?php //echo isset($_SESSION['barcode'])?'' : 'autofocus'; ?>  required  placeholder="Enter Product Name">
                            </div>                                                
                        </div>                                                                                       
                        <div class="col-md-3">
                            <div class="form-group">&nbsp;
                                <button type="submit" class="btn btn-success btn-block" name="borcode" value="borcode"><span class="glyphicon glyphicon-search"></span> Search   </button>       
                            </div>
                        </div>
                    </div>                               
                </form>
            </div>

            <div class="col-md-12 text-center" style="font-size:20px;">&nbsp; </div>
            <div class="col-md-12 text-center hidden" style="font-size:20px;">&nbsp;<b>OR</b></div>
            <div class="col-md-12 hidden">&nbsp;
                <form method="post" name="form3">                                 
                    <div class="col-md-12 ">
                        <div class="col-md-3 col-md-offset-3">
                            <div class="form-group"><b>&nbsp;Serach Barcode : </b>
                                <input type="text" name="barcode12" class="form-control"   required  placeholder="Enter borcode">
                            </div>                                                
                        </div>                                                                                       
                        <div class="col-md-3">
                            <div class="form-group">&nbsp;
                                <button type="submit" class="btn btn-success btn-block" name="borcode1" value="borcode1"><span class="glyphicon glyphicon-search"></span>Search</button>       
                            </div>
                        </div>
                    </div>                               
                </form>
            </div>
            <?php 
            if($this->session->userdata('barcode'))
            {
                $pro_desc = $this->session->userdata('barcode');

                $this->db->select('product_desc.*, product.name as pro_name, brand_master.name as bran_name');
                $this->db->where('product_desc.id', $pro_desc);
                $this->db->join('product','product_desc.product_id = product.product_id');
                $this->db->join('brand_master','product.brand_id = brand_master.id');
                $query = $this->db->get('product_desc');

                $fetch12 = $query->row();

            ?>
            <div class="col-md-12 ">
                <form method="post" name="form2" action="<?php echo site_url('PurchaseController/add_product');?>">
                    <div class="col-md-4 col-md-offset-1">                                           
                        <div class="form-group"><b>&nbsp;Name </b>
                            <input type="text" name="" class="form-control" value="<?php echo $fetch12->bran_name.' '.$fetch12->pro_name.' '.$fetch12->weight; ?>" required style="text-transform:capitalize;" readonly>
                            <input type="hidden" name="id" value="<?php echo $pro_desc;?>">
                            <input type="hidden" name="edit_hold" value="edit_hold">
                            <input type="hidden" name="order_id" value="<?php echo $pur_id;?>">
                        </div>
                    </div>
                    <div class="col-md-1 ">                                           
                        <div class="form-group"><b>&nbsp;MRP </b>  
                            <input type="text" name="mrp" class="form-control" value="&#8377;<?php echo $fetch12->mrp;?>" style="text-transform:capitalize; padding:2px 2px !important; text-align:center;" readonly>

                        </div>
                    </div>
                    <div class="col-md-1 ">                                           
                        <div class="form-group"><b>&nbsp;Quantity</b>  
                            <input type="number" name="qty" class="form-control" min="1" required autofocus>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group"><b>&nbsp;Free</b>  
                            <input type="text" name="free" class="form-control" value="0" required >
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group"><b>&nbsp;Rate</b>  
                            <input type="number" name="rate" class="form-control" step="0.01" required value="<?php echo $fetch12->purchase_rate; ?>">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group"><b>&nbsp;Discount%</b>  
                            <input type="text" name="disc" value="0" class="form-control"  >
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">&nbsp;
                            <button type="submit" class="btn btn-warning btn-block" >Add</button>       
                        </div>
                    </div>     
                </form>
            </div>
            <?php
            }
            //purchase_direct
            //order
            //print_r($this->session->userdata('purchase_direct'));
            ?>
            <?php
            if($this->session->userdata('purchase_direct'))
            {
            ?>
            <div class="col-md-8 col-md-offset-2">&nbsp;
                <form method="post" name="form6" action="<?php echo site_url('PurchaseController/update_hold_order/'.$pur_id) ;?>">
                    <table class="table table-striped text-center">
                        <tr class="warning">
                            <td><b>Sr. No.</b></td>
                            <td><b>Product Name</b></td>
                            <!--                                    <td><b>Product Weight</b></td>-->
                            <td><b>MRP</b></td>
                            <td><b>Quantity</b></td>
                            <td><b>Free</b></td>
                            <td><b>Disc%</b></td>
                            <td><b>Actual Purchase Rate</b></td>
                            <td><b>Rate</b></td>
                            <td><b>Taxable<br />Amount</b></td>
                            <td><b>GST%</b></td>
                            <td><b>GST AMT</b></td>
                            <td><b>Total<br />Amount</b></td>
                            <td><b>Delete</b></td>
                        </tr>
                        <?php                          
                //print_r($this->session->userdata('purchase_direct'));
                $s=0;
                $tot_taxable = 0 ;
                $tot_gst = 0 ;
                $tot_amnt = 0 ;
                if(count($this->session->userdata('purchase_direct')) > 0){
                    foreach($this->session->userdata('purchase_direct') as $key => $val)
                    { 
                        $s++;
                        $pro_desc = $val[0];

                        $this->db->select('product_desc.*, product.name as pro_name, product.i_gst, brand_master.name as bran_name');
                        $this->db->where('product_desc.id', $pro_desc);
                        $this->db->join('product','product_desc.product_id = product.product_id');
                        $this->db->join('brand_master','product.brand_id = brand_master.id');
                        $query = $this->db->get('product_desc');

                        $fetch12 = $query->row();

                        $taxable=$val[1]*($val[3]-($val[3]*($val[4]/100))); 
                        $tot_taxable+=$taxable;

                        $gst_amt=round($taxable*$fetch12->i_gst/100,2);
                        $tot_gst+=$gst_amt;

                        $total=round($taxable+($taxable*$fetch12->i_gst/100),2);
                        $tot_amnt+=$total;
                        ?>
                        <tr>
                            <td><?php echo $s;?></td>
                            <td><?php echo ucwords($fetch12->bran_name.' '.$fetch12->pro_name.' '.$fetch12->weight); ?><input type="hidden" name="idd[]" value="<?php echo $val[0]; ?>">
                            </td>
                            <td>Rs.<?php //echo $fetch11['mrp'];?></td>
                            <td><?php echo $val[1];?><input type="hidden" name="qttyy[]" value="<?php echo $val[1]; ?>"></td>
                            <td><?php echo $val[2];?><input type="hidden" name="freee[]" value="<?php echo $val[2]; ?>"></td>
                            <td><?php echo $val[4];?><input type="hidden" name="discount[]" value="<?php echo $val[4] ?>"></td>
                            <td><?php echo $val[3]; ?></td>
                            <td> <?php echo $rtcal=$val[3]-(($val[3]*$val[4])/100);?><input type="hidden" name="ratess[]" value="<?php echo $val[3]; ?>"></td>
                            <td><?php echo $taxable; ?><input type="hidden" name="taxable[]" value="<?php echo $taxable; ?>"></td>
                            <td><?php echo $fetch12->i_gst."%";?><input type="hidden" name="gst_per[]" value="<?php echo $fetch12->i_gst; ?>"></td>
                            <td><?php echo $gst_amt; ?><input type="hidden" name="gst_amtss[]" value="<?php echo $gst_amt; ?>"></td>
                            <td><?php echo $total; ?><input type="hidden" name="totalss[]" value="<?php echo $total; ?>">
                                <input type="hidden" name="total_amount" value="<?php echo $tot_amnt; ?>">
                            </td>
                            <td><a href="<?php echo site_url('PurchaseController/unset_prod_edit_hold/'.$key.'/'.$pur_id.'/'.$val[0].'/'.$val[1]) ;?>" class="btn btn-danger glyphicon glyphicon-remove btn-sm"></a></td>
                        </tr>
                        <?php   
                    }
                        ?>
                        <tr>
                            <td colspan="8">&nbsp;</td>
                            <td colspan="" style="color:orange;"><b>&#8377; <?php echo $tot_taxable;?></b></td>
                            <td colspan=""><b>&nbsp;</b></td>
                            <td colspan="" style="color:red;"><b>&#8377; <?php echo $tot_gst;?></b></td>
                            <td colspan="" style="color:green;"><b>&#8377; <?php echo $tot_amnt;?></b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:left;"><b>Receipt No.</b>
                                <input class="form-control" type="text" name="receipt" value="<?php echo $hold_order_row->receipt?>" placeholder="Please enter receipt number" required >
                            </td>
                            <td colspan="3" style="text-align:left;"><b>Date</b>
                                <?php
                            if($hold_order_row->inv_date == '0000-00-00')
                            {
                                $date = date("d-m-Y");
                            } else
                            {
                                $date = date("d-m-Y", strtotime($hold_order_row->inv_date));
                            }
                                ?>
                                <input class="form-control datepicker" type="text" name="sel_date" value="<?php echo $date;?>"  placeholder="Please enter date" required >
                            </td>
                            <td colspan="3"><b>&nbsp;</b><br>
                                <button class="btn btn-info" name="order" value="order">Update Purchase</button>
                            </td>
                            <td colspan="3"><b>&nbsp;</b><br>
                                <button class="btn btn-primary" name="update_hold" value="update_hold">Update Hold</button>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                </form>

            </div>
            <?php
            }
            ?>
            <div class="col-md-12 ">&nbsp;
                <form method="post" name="form4">                                 
                    <div class="col-md-12 "> 
                        <div class="col-md-4 col-md-offset-4">
                            <!--                            <button type="submit" class="btn btn-default btn-block" name="cancel">Cancel</button>       -->
                            <a href="<?php echo site_url('PurchaseController/cancel_hold_edit');?>" class="btn btn-default btn-block" >Cancel</a>
                        </div>
                    </div>                  
                </form>
            </div>
            <?php ?>
        </div> 
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>

<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   
<script>
    $('#search_vendor').autocomplete({
        source: '<?=base_url()?>PurchaseController/getVenodr',
        select: function (event, ui) {
            var name = ui.item.label
            $("#id_vendor").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_vendor").val(name); // display the selected text
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