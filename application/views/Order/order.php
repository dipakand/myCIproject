<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-pills nav-justified">
            <li class="active" ><a >Add Order</a></li>
            <li><a href="<?php echo site_url('AllOrder');?>">View All Order</a></li>
        </ul>
        <?php
        //print_r($sale_exe);
        $exe_name = 0;
        $exe_name = $sale_exe;

        ?>
        <?php
        //print_r($sales_executive_rows);
        //print_r($brand_master_rows);
        ?>
        <?php //echo validation_errors('<div class="col-sm-12 aler-danger">', '</div>'); ?>
        <style>
            .multiselect-container {
                position: inherit !important;
                height: 200px;
                overflow: auto;
            }
        </style>
        <div class="col-md-12">&nbsp;
            <form method="post" >
                <div class="col-md-3 col-md-offset-2"><?php //echo set_value('sale_exe'); ?>
                    <select name="sale_exe" class="form-control" >
                        <option value="">Sales Executive</option>
                        <?php
                        foreach($sales_executive_rows as $sale_exe)
                        {

                        ?>
                        <option value="<?php echo $sale_exe->id;?>" <?php echo set_select('sale_exe',$sale_exe->id, ( !empty($data) && $data == $sale_exe->id ? TRUE : FALSE )); ?> ><?php echo ucwords($sale_exe->name);?></option>
                        <?php
                        }
                        ?>
                    </select>     
                    <?php echo form_error('sale_exe');?>      
                </div>
                <div class="col-md-3"><?php //echo set_value('sel_brand[]'); ?>
                    <?php

                    ?>
                    <select name="sel_brand[]" multiple id="sel_brand" class="form-control" >

                        <?php 
                        foreach($brand_master_rows as $brand)
                        {
                        ?>
                        <option value="<?php echo $brand->id; ?>" <?php echo set_select('sel_brand[]',$brand->id, ( !empty($data) && $data == $brand->id ? TRUE : FALSE )); ?> ><?php echo $brand->name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <?php echo form_error('sel_brand[]');?>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="submit_brand" class="btn btn-warning btn-block">Submit Brand</button> 
                </div>
            </form>
        </div>
        <?php
        if($sale_exe !='' && $sel_brand != '')
        {
        ?>
        <div class="col-md-10 col-sm-offset-1">&nbsp;
            <form method="post" action="<?php echo site_url('OrderController/get_order');?>">
                <table class="table table-stripted table-bordered text-center" id="" width="100%">
                    <thead>
                        <tr class="warning">
                            <td><b>Sr. No.</b></td>
                            <td><b>Product Name</b></td>
                            <td><b>MRP</b></td>
                            <td><b>Selling Price</b></td>
                            <td><b>Stock</b></td>
                            <td style="width:10%;"><b>Order Qty</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
            $s=0;

            foreach($sel_brand as $kee=>$value)
            {
                $fetch111 = $this->db->where('brand_id',$value)->get('product')->result();
                foreach($fetch111 as $product)
                {
                    $fetch = $this->db->where('product_id',$product->product_id)->get('product_desc')->result();
                    foreach($fetch as $desc)
                    {
                        $s++;
                        ?>
                        <tr>
                            <td><?php echo $s;?></td>
                            <td><?php echo ucwords($product->name.' '.$desc->weight);?></td>
                            <td>&#x20B9;.<?php echo $desc->mrp;?></td>
                            <td>&#x20B9;.<?php echo $desc->sale_price;?></td>
                            <td><?php echo $desc->stock;?></td>
                            <td>
                                <input type="hidden" name="sales_exidd" id="" class="form-control" value="<?php echo $exe_name; ?>" >
                                <input type="hidden" name="mrp[<?php echo $desc->id;?>]" id="" class="form-control" value="<?php echo $desc->mrp;?>" min="0">
                                <input type="text" name="stock[<?php echo $desc->id;?>]" id="" class="form-control" value="0" min="0">
                            </td>
                        </tr>
                        <?php
                    }

                }
            }

                        ?>
                    </tbody>
                </table>
                <div class="col-sm-4 col-sm-offset-4">
                    <button type="submit" name="btn-order" class="btn btn-success btn-block">Submit</button>
                </div>
            </form>
        </div>
        <?php
        }
        ?>
        <div class="col-md-12">&nbsp;</div>
    </div>
</div>
<!--<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>-->
<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

<script>
    $(document).ready(function(){
        $('#sel_brand').multiselect({
            includeSelectAllOption: true,
            nonSelectedText: 'Select Brand',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'100%'
        });
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