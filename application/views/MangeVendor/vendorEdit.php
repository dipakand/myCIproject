<div class="row">
    <div class="col-lg-12">
        <!--<ul class="nav nav-justified nav-pills">
            <li class="active"><a  ><b>Vendor Registation</b><span class=""></span></a></li>
            <li><a href="<?php echo site_url('VendorView');?>"><b>Manage Vendor</b><span class=""></span></a></li>
        </ul>-->
        <div class="col-md-12">&nbsp; 
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">&nbsp;Name :
                            <input style="text-transform:capitalize;" type="text" name="name" class="form-control" value="<?php echo $Vendor_row->name;?>" placeholder="Enter name"  autofocus>
                            <?php echo form_error('name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">&nbsp;Email ID :
                            <input type="text" name="email" class="form-control" placeholder="Enter email id" value="<?php echo $Vendor_row->email;?>"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please Enter volid eamil">
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">&nbsp;Contact No. :
                            <input type="text" name="contact" pattern="[0-9]{10}" maxlength="10" class="form-control" placeholder="Enter contact number" value="<?php echo $Vendor_row->contact;?>">
                            <?php echo form_error('t'); ?>
                        </div>
                    </div>
                </div>  
                <div class="col-md-12">

                    <div class="col-md-4">
                        <div class="form-group">&nbsp;City :
                            <input style="text-transform:capitalize;" type="text" name="city" class="form-control" placeholder="enter city" value="<?php $Vendor_row->city;?>">
                            <?php echo form_error('city'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">&nbsp;State :
                            <select name="state_id" class="form-control" id="state" >
                                <option value="">Select State</option>
                                <?php  $sts = mysqli_query($conn, "SELECT* FROM state");
                                foreach($state_row as $state){ ?>
                                <option value="<?php echo $state->state_id;?>" <?php echo $state->state_id == $Vendor_row->state ?'selected' : '';?> ><?php echo $state->state_name;?></option>
                                <?php   } ?>
                            </select>
                            <?php echo form_error('state_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">&nbsp;Pincode :
                            <input type="text" name="pincode" maxlength="6" pattern="[0-9]{6}" class="form-control" placeholder="Enter pincode" value="<?php echo $Vendor_row->pincode;?>">
                            <?php echo form_error('pincode'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">&nbsp;GSTIN :
                            <input type="text" name="gstin" class="form-control" placeholder="Enter GSTIN" value="<?php $Vendor_row->gstin;?>" >
                            <?php echo form_error('gstin'); ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">&nbsp;Address :
                            <textarea style="text-transform:capitalize;" name="address" rows="2" class="form-control" placeholder="Enter address"><?php echo $Vendor_row->address;?></textarea>
                            <?php echo form_error('address'); ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-12">
                    <div class="col-md-4 col-md-offset-4">                                        
                        <button type="submit" class="btn btn-success btn-block">Submit</button>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>