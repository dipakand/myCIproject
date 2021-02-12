<div class="row">
    <div class="col-lg-12">
        <!--<ul class="nav nav-justified nav-pills">
            <li ><a href="<?php echo site_url('ProductAdd');?>">Manage Product</a></li>
            <li class="active"><a >Manage Brand</a></li>
        </ul>-->

        <div class="col-md-12">&nbsp;
            <!--<ul class="nav nav-pills nav-justified">
                <li ><a href="<?php echo site_url('brandAdd');?>">Add New </a></li>
                <li class="active"><a >Manage All</a></li>
            </ul>&nbsp;-->
            <form method="post">
                <table class="table table-striped">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group"><b>Name :</b>
                                <input value="<?php echo $brandRow->name?>" type="text" name="name" class="form-control" placeholder="Enter name" >
                                <?php echo form_error('name');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>Billing Name :</b>
                                <input value="<?php echo $brandRow->bill_name?>" type="text" name="bill_name" class="form-control" placeholder="Enter billing name" >
                                <?php echo form_error('bill_name');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>Contact No. </b>
                                <input value="<?php echo $brandRow->contact_no?>" type="text" name="contact_no" class="form-control" placeholder="Enter contact" maxlength="10"  pattern="[0-9]{10}">
                                <?php echo form_error('contact_no');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group"><b>Email Id :</b>
                                <input value="<?php echo $brandRow->email?>" type="text" name="email" class="form-control" placeholder="Enter email id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please Enter volid eamil" >
                                <?php echo form_error('email');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>GST IN :</b>
                                <input value="<?php echo $brandRow->gst?>" type="text" name="gst" class="form-control" placeholder="Enter GST IN" >
                                <?php echo form_error('gst');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>PAN No. </b>
                                <input value="<?php echo $brandRow->pan_no?>" type="text" name="pan_no" class="form-control" placeholder="Enter PAN No." >
                                <?php echo form_error('pan_no');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <div class="form-group"><b>Address :</b>
                                <textarea name="address" placeholder="Enter address" class="form-control" ><?php echo $brandRow->address?></textarea>
                                <?php echo form_error('address');?>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4 col-md-offset-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning  btn-block" name="submit">Update</button>          
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <a href="<?php echo site_url('brandView');?>" class="btn btn-default  btn-block" name="submit">Cancel</a>
                            </div>
                        </div>
                    </div>
                </table>
            </form>
        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
</div>
