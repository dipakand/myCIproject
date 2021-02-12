<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
    <div id="demo2" class="">
        <table class="table table-striped" >
            <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Logo</th>
                <th>Industry</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Phone Detail</th>
                <th>Website</th>
                <th>Gst No</th>
                <th>Address</th>
                <th>Edit</th>
            </tr>
            <?php
            $n=0;
            //print_r($company_row);
            $n++;
            ?>
            <tr>
                <td><?php echo $n; ?></td>

                <td style="text-transform: capitalize;"><?php echo $company_row->company_name; ?></td>

                <td>
                    <img class="img-responsive" height="50px" width="50px" src="<?php echo base_url().'/uploads/'.$company_row->logo_image; ?>" data-toggle="modal" data-target="#myImg" title="click to view image">
                    <div class="modal fade" id="myImg" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img class="img-responsive" height="500px" width="700px" src= "<?php echo $company_row->logo_image; ?>">
                                </div>       
                            </div>
                        </div>
                    </div>            
                </td>

                <td style="text-transform: capitalize;"><?php echo $company_row->industry_type; ?></td>
                <td style="text-transform: capitalize;"><?php echo $company_row->company_state; ?></td>
                <td style="text-transform: capitalize;"><?php echo $company_row->state_name; ?></td>
                <td><?php echo $company_row->postal_code; ?></td>
                <td><?php echo $company_row->company_phone; ?></td>
                <td><?php echo $company_row->website; ?></td>
                <td><?php echo $company_row->gst_no; ?></td>
                <td style="text-transform: capitalize;"><?php echo $company_row->company_address; ?></td>
                <td><a href="<?php echo site_url('/companyEdit/'.$company_row->company_id);?>" class="btn btn-primary glyphicon glyphicon-edit"></a></td>

            </tr>

        </table>

    </div>
</div>
