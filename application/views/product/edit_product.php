<?php //print_r($productRow);?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">&nbsp;
        <form method="post" enctype="multipart/form-data" role="form">                
            <table class="table table-striped">
                <tr>
                    <td class="text-right"><b>Brand : </b></td>
                    <td>
                        <select class="form-control" style="text-transform:capitalize;" name="brand">
                            <?php
                            foreach($brand_row as $brand)
                            {
                            ?>
                            <option value="<?php echo $brand->id;?>"
                                    <?php if($productRow->brand_id == $brand->id)
                            {
                                echo "selected";
                            }
                                    ?>
                                    ><?php echo $brand->name;?></option>
                            <?php }
                            ?>
                        </select>
                        <?php echo form_error('brand');?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>Name :</b></td>
                    <td>
                        <input type="text" name="name" value="<?php echo $productRow->name; ?>" class="form-control" style="text-transform:capitalize;" >
                        <?php echo form_error('name');?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>Category :</b></td>
                    <td>
                        <select class="form-control" style="text-transform:capitalize;" name="category">
                            <?php
                            foreach($category_row as $category)
                            {
                            ?>
                            <option value="<?php echo $category->id;?>"
                                    <?php if($productRow->category_id == $category->id)
                            {
                                echo "selected";
                            }
                                    ?>
                                    ><?php echo $category->category;?></option>
                            <?php }
                            ?>
                        </select>
                        <?php echo form_error('category');?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>HSN Code :</b></td>
                    <td>
                        <input type="text" name="hsn" value="<?php echo $productRow->hsn; ?>" class="form-control" style="text-transform:capitalize;" >
                        <?php echo form_error('hsn');?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>I GST :</b></td>
                    <td>
                        <input type="text" name="i_gst" value="<?php echo $productRow->i_gst; ?>" class="form-control" style="text-transform:capitalize;"  onblur= "myfunction(this.value)">
                        <?php echo form_error('i_gst');?>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>C GST :</b></td>
                    <td>
                        <input type="text" name="c_gst" value="<?php echo $productRow->c_gst; ?>" class="form-control" style="text-transform:capitalize;" id="cgst1" readonly>
                    </td>
                </tr>
                <tr>
                    <td  class="text-right"><b>S GST :</b></td>
                    <td>
                        <input type="text" name="s_gst" value="<?php echo $productRow->s_gst; ?>" class="form-control" style="text-transform:capitalize;" id="sgst1" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center  ">
                        <div class="col-md-6">
                            <!--                            <button type="submit" name="cancel" class="btn btn-default btn-block">Cancel</button>-->
                            <a href="<?php echo site_url('ProductView');?>" class="btn btn-default btn-block">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit"  class="btn btn-warning btn-block">Update</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div> 
</div>
<script>
    function myfunction(value){
        var a= value/2;
        document.getElementById("cgst1").value=a;
        document.getElementById("sgst1").value=a;

    }
</script>