<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-justified nav-pills">
            <li class="active"><a  ><b>Add New Party</b><span class=""></span></a></li>
            <li><a href="<?php echo site_url('PartyView');?>"><b>All Party</b><span class=""></span></a></li>
        </ul>
        <div class="col-md-12">&nbsp;
            <form action="" name="testform10" method="post" class="form-group" enctype="multipart/form-data"  >

                <div class="col-md-12">
                    <!--Fist Name-->
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Name :</b>
                            <input style="text-transform: uppercase;" type="text" id="name_serch" name="name" autocomplete="off" class="form-control"  placeholder="Enter name" value="<?php echo set_value('name');?>" >
                            <?php echo form_error('name');?>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Address :</b>
                            <textarea rows="2" cols="2" style="text-transform: capitalize;"  id="address" name="address" placeholder="Enter Address" class="form-control" ><?php echo set_value('address');?></textarea>
                            <?php echo form_error('address');?>
                        </div>
                    </div>
                    <!--City-->        
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;City :</b>
                            <input style="text-transform: capitalize;" type="text" name="city" id="city" class="form-control"  placeholder="Enter city" title="Please Enter city name" value="<?php echo set_value('city');?>">
                            <?php echo form_error('city');?>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <!--   status  -->
                    <div class="col-sm-4"><b>&nbsp;State :</b>
                        <div class="form-group">
                            <select name="state_id" class="form-control" id="state" >
                                <option value="">Select State</option>
                                <?php  $sts = mysqli_query($conn, "SELECT* FROM state");
                                foreach($state_row as $state){ ?>
                                <option value="<?php echo $state->state_id;?>" <?php echo $state->state_id == set_value('state_id') ?'selected' : '';?> ><?php echo $state->state_name;?></option>
                                <?php   } ?>
                            </select>
                            <?php echo form_error('state_id'); ?>
                        </div>
                    </div>

                    <!--Pincode-->
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Pincode :</b>
                            <input style="text-transform: capitalize;" type="text" maxlength="6" name="pincode" id="Pincode" class="form-control"  placeholder="Enter Pincode"  value="<?php echo set_value('pincode');?>">
                            <?php echo form_error('pincode');?>
                        </div>
                    </div>
                    <!--City-->        
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Landmark :</b>
                            <input style="text-transform: capitalize;" type="text"  name="landmark" id="landmark" class="form-control"  placeholder="Enter landmark" title="Please Enter landmark" value="<?php echo set_value('landmark');?>">
                            <?php echo form_error('landmark');?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <!--Contact 1-->
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Contact No. :</b>
                            <input type="text" name="contact" maxlength="10"  class="form-control" id="contact" placeholder="Enter contact no." pattern="[0-9]{10}" title="Please Enter 10 digit"  value="<?php echo set_value('contact');?>" >
                            <?php echo form_error('contact');?>
                        </div>
                    </div>

                    <!--contact 2-->
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Contact Person Name :</b>
                            <input type="text" name="contact_person"  class="form-control" id="cont_name" placeholder="Enter Contact Person Name"   title="Please Enter Contact Person Name" value="<?php echo set_value('contact_person');?>" >
                            <?php echo form_error('contact_person');?>
                        </div>
                    </div>

                    <!--Email Address-->

                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Email Id :</b>
                            <input style="" type="text" name="email" id="email" class="form-control"  placeholder="Enter email id"  value="<?php echo set_value('email');?>" >
                            <?php echo form_error('email');?>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <!--gst in -->
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;GST IN :</b>
                            <input type="text" name="gst_in"  class="form-control " value="<?php echo set_value('gst_in');?>" id=" " placeholder="Enter GST IN"> 
                            <?php echo form_error('gst_in');?>
                        </div>
                    </div>
                    <!--limit -->
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Limit In Days :</b>
                            <input type="text" name="limit_1"  class="form-control " value="<?php echo set_value('limit_1') != '' ? set_value('limit_1') : 0;?>" id="limit" placeholder="Enter Limit" >
                            <?php echo form_error('limit_1');?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;FFSi :</b>
                            <input type="text" name="ffsi_no"  class="form-control " placeholder="Enter FFSI" value="<?php echo set_value('ffsi_no');?>" >
                            <?php echo form_error('ffsi_no');?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group"><b>&nbsp;Discount % :</b>
                            <input type="number" min="0" max="99" step="any" value="<?php echo set_value('discount') != '' ? set_value('discount') : 0;?>" name="discount" class="form-control" >
                            <?php echo form_error('discount');?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!--Button -->
                    <div class="col-sm-8 col-md-offset-2">
                        <div class="form-group">
                            <button class="btn btn-success btn-block  text-uppercase"   type="submit" >Submit</button>
                        </div>
                    </div> 
                </div>


            </form>
        </div>
    </div>
</div>