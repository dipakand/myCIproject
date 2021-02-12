<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-justified nav-pills">
            <li ><a href="<?php echo site_url('VendorAdd');?>" ><b>Vendor Registation</b><span class=""></span></a></li>
            <li class="active"><a ><b>Manage Vendor</b><span class=""></span></a></li>
        </ul>
        <div class="col-md-12">&nbsp;
            <div class="col-lg-12 table-responsive">
                <table class="table table-striped text-center table-hover" id="example" width="100%">
                    <thead>
                        <tr>
                            <td><b>Sr. No.</b></td>
                            <td><b>Name</b></td>
                            <td><b>contact</b></td>
                            <td><b>Email</b></td>
                            <td><b>City</b></td>
<!--                            <td><b>Product<br/>Detail</b></td>-->
                            <td><b>Edit</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $s=0;
                        foreach($Vendor_row as $vendor)
                        {$s++;
                        ?>
                        <tr>
                            <td><?php echo $s;?></td>
                            <td><?php echo $vendor->name;?></td>
                            <td><?php echo $vendor->contact;?></td>
                            <td><?php echo $vendor->email;?></td>
                            <td><?php echo $vendor->city;?></td>
<!--                            <td><a href="product_detail.php?id=<?php //echo site_url(''.$vendor->id);?>" class="btn btn-warning glyphicon glyphicon-list-alt btn-sm"></a></td>-->
                            <td><a href="<?php echo site_url('VendorEdit/'.$vendor->id); ?>" class="btn btn-primary glyphicon glyphicon-edit btn-sm"></a></td>
                        </tr>                                   
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>