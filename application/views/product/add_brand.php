<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-justified nav-pills">
            <li ><a href="<?php echo site_url('ProductAdd');?>">Manage Product</a></li>
            <li class="active"><a >Manage Brand</a></li>
        </ul>

        <div class="col-md-12">&nbsp;
            <ul class="nav nav-pills nav-justified">
                <li class="active"><a>Add New </a></li>
                <li ><a href="<?php echo site_url('brandView');?>">Manage All</a></li>
            </ul>&nbsp;
            <!--  form start-->
            <form method="post">
                <table class="table table-striped">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group"><b>Name :</b>
                                <input type="text" name="name" class="form-control" placeholder="Enter name" value="<?php echo set_value('name');?>">
                                <?php echo form_error('name');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>Billing Name :</b>
                                <input type="text" name="bill_name" class="form-control" placeholder="Enter billing name" value="<?php echo set_value('bill_name');?>">
                                <?php echo form_error('bill_name');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>Contact No. </b>
                                <input type="text" name="contact_no" class="form-control" placeholder="Enter contact" maxlength="10" value="<?php echo set_value('contact_no');?>" pattern="[0-9]{10}">
                                <?php echo form_error('contact_no');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group"><b>Email Id :</b>
                                <input type="text" name="email" class="form-control" placeholder="Enter email id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please Enter volid eamil" value="<?php echo set_value('email');?>">
                                <?php echo form_error('email');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>GST IN :</b>
                                <input type="text" name="gst" class="form-control" placeholder="Enter GST IN" value="<?php echo set_value('gst');?>">
                                <?php echo form_error('gst');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><b>PAN No. </b>
                                <input type="text" name="pan_no" class="form-control" placeholder="Enter PAN No." value="<?php echo set_value('pan_no');?>">
                                <?php echo form_error('pan_no');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <div class="form-group"><b>Address :</b>
                                <textarea name="address" placeholder="Enter address" class="form-control" ><?php echo set_value('address');?></textarea>
                                <?php echo form_error('address');?>
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
                </table>
            </form>
            <!-- form end-->
        </div>
    </div>
</div>