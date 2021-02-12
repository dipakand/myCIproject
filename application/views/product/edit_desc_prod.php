<?php //print_r($proDescRow);?>
<div class="row">
    <!--<div class="col-sm-12">
<ul class="nav nav-justified nav-pills">
<li class="active"><a >Manage Product</a></li>
<li ><a >Manage Brand</a></li>
</ul>
</div>-->

    <div class="col-sm-6 col-sm-offset-3">&nbsp;
        <!--<ul class="nav nav-pills nav-justified">
<li ><a href="<?php echo site_url('ProductAdd');?>">Add New </a></li>
<li class="active"><a >Manage All</a></li>
</ul>&nbsp;-->

        <form method="post" >                
            <table class="table table-striped">
                <tr>
                    <td class="text-right"><b>Weight :</b></td>
                    <td>
                        <input type="text" name="weight" value="<?php echo $proDescRow->weight; ?>" class="form-control" style="text-transform:capitalize;" >
                        <?php echo form_error('weight')?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>MRP :</b></td>
                    <td>
                        <input type="text" name="mrp" value="<?php echo $proDescRow->mrp; ?>" class="form-control" style="text-transform:capitalize;" >
                        <?php echo form_error('mrp')?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>Barcode Value :</b></td>
                    <td>
                        <input type="text" name="barcode" value="<?php echo $proDescRow->barcode; ?>" class="form-control" style="text-transform:capitalize;" >
                        <?php echo form_error('barcode')?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>Stock :</b></td>
                    <td>
                        <input type="text" name="stock" value="<?php echo $proDescRow->stock; ?>" class="form-control" style="text-transform:capitalize;" >
                        <?php echo form_error('stock')?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>Salling Price :</b></td>
                    <td>
                        <input type="text" name="sale_price" value="<?php echo $proDescRow->sale_price; ?>" class="form-control" style="text-transform:capitalize;" >
                        <?php echo form_error('sale_price')?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <a href="<?php echo site_url('ProductView');?>" class="btn btn-default ">Cancel</a>&nbsp;&nbsp;
                        <button type="submit"  class="btn btn-success ">Update</button>
                    </td>                     
                </tr>
            </table>
        </form>
    </div>
</div>
