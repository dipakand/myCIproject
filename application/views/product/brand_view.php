<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-justified nav-pills">
            <li ><a href="<?php echo site_url('ProductAdd');?>">Manage Product</a></li>
            <li class="active"><a >Manage Brand</a></li>
        </ul>

        <div class="col-md-12">&nbsp;
            <ul class="nav nav-pills nav-justified">
                <li ><a href="<?php echo site_url('brandAdd');?>">Add New </a></li>
                <li class="active"><a >Manage All</a></li>
            </ul>&nbsp;

            <table class="table table-striped table-bordered text-center" id="example" width="100%">
                <thead>
                    <tr>
                        <td><b>Sr. No.</b></td>
                        <td><b>Name</b></td>
                        <td><b>Billing Name</b></td>
                        <td><b>Contact No.</b></td>
                        <td><b>Email Id</b></td>
                        <td><b>GST No.</b></td>
                        <td><b>PAN No.</b></td>
                        <td><b>Address</b></td>
                        <td><b>Edit</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;

                    foreach($brandRow as $brand)
                    { $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td style="text-transform:capitalize;"><?php echo $brand->name; ?></td>
                        <td style="text-transform:capitalize;"><?php echo $brand->bill_name; ?></td>
                        <td><?php echo $brand->contact_no; ?></td>
                        <td><?php echo $brand->email; ?></td>
                        <td><?php echo $brand->gst; ?></td>
                        <td><?php echo $brand->pan_no; ?></td>
                        <td><?php echo $brand->address; ?></td>
                        <td><a href="<?php echo site_url('brandEdit/'.$brand->id);?>" class="btn btn-primary glyphicon glyphicon-edit"></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<script> 
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            // buttons: [ 'copy', 'excel', 'pdf', 'csvHtml5','print' ]
            buttons: [
                {
                    extend: 'excel',className: 'btn-primary',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5] //Your Colume value those you want
                    },
                },
                {
                    extend: 'pdf',className: 'btn-primary',orientation:'landscape', 
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5] //Your Colume value those you want
                    },
                },
                {
                    extend: 'print',className: 'btn-primary',orientation:'landscape',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5] //Your Colume value those you want
                    }
                },
            ],
        } );

        table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script>