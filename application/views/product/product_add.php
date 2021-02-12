<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-justified nav-pills">
            <li class="active"><a >Manage Product</a></li>
            <li ><a href="<?php echo site_url('brandAdd');?>" >Manage Brand</a></li>
        </ul>
    </div>

    <div class="col-sm-12">&nbsp;
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a >Add New </a></li>
            <li ><a href="<?php echo site_url('ProductView');?>">Manage All</a></li>
        </ul>&nbsp;
        <form method="post" action="<?php echo site_url('ProductAdd');?>">
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <div class="form-group"><b>&nbsp;Brand : </b>
                        <select class="form-control" name="brand" style="text-transform:capitalize;">
                            <option value="">Select Brand</option>
                            <?php 
                            //getUserDetails($user_id,'user_name');
                            //$rr = getBrand();
                            foreach($brand_row as $brand)
                            { ?>
                            <option value="<?php echo $brand->id;?>" <?php //if(isset($set_value('brand')) { echo "selected"; } ?> ><?php echo $brand->name;?></option>
                            <?php    
                            }
                            ?>
                        </select>
                        <?php echo form_error('brand')?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group"><b>&nbsp;Name :</b>  
                        <input style="text-transform:capitalize;" value="<?php echo set_value('name'); ?>" type="text" name="name" class="form-control" placeholder="Enter name"   >
                        <?php echo form_error('name')?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><b>&nbsp;Category  :</b> 
                        <select class="form-control" name="category" style="text-transform:capitalize;">
                            <option value="">Select Category</option>
                            <?php 

                            foreach($category_row as $category)
                            { ?>
                            <option value="<?php echo $category->id;?>" <?php echo set_value('name') == $category->id ? 'selected' : ''; ?> ><?php echo $category->category;?></option>
                            <?php 
                            }
                            ?>
                        </select>
                        <?php echo form_error('category')?>
                    </div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group"><b>&nbsp;HSN Code :</b> 
                        <input style="text-transform:capitalize;" value="<?php echo set_value('hsn'); ?>" type="text" name="hsn" class="form-control" placeholder="Enter HSN Code"   >
                        <?php echo form_error('hsn')?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><b>&nbsp; I GST  :</b>  
                        <input style="text-transform:capitalize;" value="<?php echo set_value('i_gst'); ?>" type="text" name="i_gst" class="form-control" placeholder="Enter I GST"   onblur= "myfunction(this.value)">
                        <?php echo form_error('i_gst')?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><b>&nbsp;C GST  :</b> 
                        <input style="text-transform:capitalize;" value="<?php echo set_value('c_gst'); ?>" type="text" name="c_gst" class="form-control" placeholder="Enter C GST" id="cgst1" readonly >
                    </div>
                </div>                                        
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group"><b>&nbsp;S GST :</b> 
                        <input style="text-transform:capitalize;" value="<?php echo set_value('s_gst'); ?>" type="text" name="s_gst" class="form-control" placeholder="Enter S GST   "  id="sgst1" readonly>
                    </div>
                </div>

            </div> 


            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block" >Submit</button>       
                    </div>
                </div>
            </div>


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