<div class="row">
    <!--<div class="col-sm-12">
<ul class="nav nav-justified nav-pills">
<li class="active"><a >Manage Product</a></li>
<li ><a href="brand.php">Manage Brand</a></li>
</ul>
</div>-->

    <!--<div class="col-sm-12">&nbsp;
<ul class="nav nav-pills nav-justified">
<li class="active"><a >Add New </a></li>
<li ><a href="<?php echo site_url('ProductView');?>">Manage All</a></li>
</ul>&nbsp;
</div>-->

    <?php //$this->session->unset_userdata('desc_arry');?>
    <div class="col-sm-12">
        <div class="alert alert-success text-center col-md-4 col-md-offset-4">
            <span style="text-transform:capitalize;"><?php echo $product_row->name;?></span></div>
        <form method="post" action="<?php echo site_url('ProductDesc');?>">                                 
            <div class="col-md-12">
                <div class="col-md-2">
                    <div class="form-group"><b>&nbsp;Weight: </b>
                        <input type="text" name="weight" class="form-control" placeholder="Enter Weight" autofocus value="<?php echo set_value('weight');?>" >
                    </div>
                    <?php echo form_error('weight')?>
                </div>
                <div class="col-md-2">
                    <div class="form-group"><b>&nbsp;MRP :  </b>
                        <input type="text" name="mrp" class="form-control" placeholder="Enter MRP" value="<?php echo set_value('mrp');?>">
                    </div>
                    <?php echo form_error('mrp')?>
                </div>

                <div class="col-md-3">
                    <div class="form-group"><b>&nbsp;Barcode Value :</b>
                        <input type="text" name="barcode" class="form-control" placeholder="Enter barcode value" value="<?php echo uniqid()?>"> 
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group"><b>&nbsp;Stock :</b>
                        <input type="text" name="stock" class="form-control" placeholder="Enter Stock" value="<?php echo set_value('stock');?>"> 
                    </div>
                    <?php echo form_error('stock')?>
                </div>

                <div class="col-md-2">
                    <div class="form-group"><b>&nbsp;Selling Price :  </b>
                        <input type="text" name="value" class="form-control" placeholder="Enter Selling Price" value="<?php echo set_value('value');?>">
                    </div>
                    <?php echo form_error('value')?>
                </div>
                <div class="col-md-1">
                    <div class="form-group">&nbsp;
                        <button type="submit" class="btn btn-warning btn-block" name="add">Add</button>       
                    </div>
                </div>
            </div>                               
        </form>
    </div>
    <div class="col-sm-8 col-sm-offset-2">
        <?php 
    if($this->session->userdata('desc_arry')) 
    {?>
        <form action="">
            <table class="table table-striped text-center ">
                <tr class="warning">
                    <td><b>Sr. No.</b></td>
                    <td><b>Weight</b></td>
                    <td><b>MRP</b></td>
                    <td><b>Barcode Value</b></td>
                    <td><b>Stock</b></td>
                    <td><b>Selling Price</b></td>
                    <td><b>Action</b></td>
                </tr>
                <?php 
        $s=0;
        //print_r($this->session->userdata('desc_arry'));
        $items = $this->session->userdata('desc_arry');
        foreach($items as $key => $val)
        {    $s++;
                ?>
                <tr>
                    <td><?php echo $s; ?></td>
                    <td><?php echo $val[0]; ?></td>
                    <td><?php echo $val[1];?></td>
                    <td><?php echo $val[2];?></td> 
                    <td><?php echo $val[3];?></td> 
                    <td><?php echo $val[4];?></td>
                    <td>
                        <a href="<?php echo site_url('subProductDelete/'.$key);?>" class="btn btn-danger btn-sm glyphicon glyphicon-remove"></a>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="7">
                        <div class="col-md-4 col-md-offset-4">
                            <a href="<?php echo site_url('subProductSave');?>"  class="btn btn-success btn-block">Submit</a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <?php }?>
    </div>
    
    <div class="col-sm-4 col-sm-offset-4">
        <a href="<?php echo site_url('ProductController/cancel_desc');?>" class="btn btn-default btn-sm btn-block">Cancel</a>
    </div>
</div>
