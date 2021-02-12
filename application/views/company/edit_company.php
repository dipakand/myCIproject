
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
    <!--                <form name="frmUser" method="post" class="form-group" enctype="multipart/form-data" action="<?php echo site_url('companyEdit/'.$company->company_id);?>">-->
    <?php echo form_open_multipart( ) ?>

    <div class="col-sm-12">    
        <div class="form-group">
            <label for="logo_image">Company Logo</label>
            <img src="<?php echo base_url().'/uploads/'.$company_row->logo_image; ?>" class=" img-thumbnail" width="100px" height="100px" />
            <input type="hidden" name="original" value="<?php echo $company->logo_image; ?>" />
            <span class="btn btn-primary btn-file">Browse Logo
                <input type="file" name="img_file" />
            </span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input style="text-transform: capitalize;" type="text" id="company_name" name="company_name" value="<?php echo $company->company_name; ?>"   class="form-control"/>
            <input type="hidden" name="id" value="<?php echo $company->company_id; ?>">
            <?php echo form_error('company_name');?>
        </div>
    </div>    
    <div class="col-sm-4">
        <div class="form-group">
            <label for="industry_type">Industry Type</label>
            <input style="text-transform: capitalize;" type="text" id="industry_type" name="industry_type" value="<?php echo $company->industry_type; ?>"  class="form-control"/>
            <?php echo form_error('industry_type');?>
        </div>
    </div>
    <div class="col-sm-4">    
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" id="website" name="website" value="<?php echo $company->website; ?>"  class="form-control"/>
            <?php echo form_error('website');?>
        </div> 
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="company_city">City</label>
            <input style="text-transform: capitalize;" type="text" id="company_city" name="company_city" value="<?php echo $company->company_city; ?>"  class="form-control"/>
            <?php echo form_error('company_city');?>
        </div>
    </div>
    <div class="col-sm-4">  
        <label for="">State</label>
        <select name="state"class="form-control" id="state">
            <?php 
            foreach($state as $states)
            {
                if ($company->company_state == $states->state_id) 
                {
                    $sel = 'selected="selected"';
                }else
                {
                    $sel='';
                }
            ?>
            <option value="<?php echo $states->state_id;?>" <?php echo $sel;?> ><?php echo $states->state_name;?></option>
            <?php } ?> 
        </select>
        <?php echo form_error('state');?>
    </div>
    <div class="col-sm-4">    
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" value="<?php echo $company->postal_code; ?>"  class="form-control"/>
            <?php echo form_error('postal_code');?>
        </div>
    </div>
    <div class="col-sm-4">    
        <div class="form-group">
            <label for="company_phone">Phone No</label>
            <input type="text" id="company_phone" name="company_phone" value="<?php echo $company->company_phone; ?>"  class="form-control"/>
            <?php echo form_error('company_phone');?>
        </div>
    </div>
    <div class="col-sm-4">    
        <div class="form-group">
            <label for="company_phone">Gst No</label>
            <input type="text" id="company_gst" name="company_gst" value="<?php echo $company->gst_no; ?>"  class="form-control"/>
            <?php echo form_error('company_gst');?>
        </div>
    </div>
    <div class="col-sm-12">    
        <div class="form-group">
            <label for="company_address">Address</label>
            <textarea style="text-transform: capitalize;"  id="company_address" name="company_address"   class="form-control"><?php echo $company->company_address; ?></textarea>
            <?php echo form_error('company_address');?>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <input type="submit" value="Update" class="btn btn-warning btn-block"/>
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo site_url('company');?>" class="btn btn-default btn-block" role="button">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--                </form>-->
</div>
