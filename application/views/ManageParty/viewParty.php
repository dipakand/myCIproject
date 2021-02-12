<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-justified nav-pills">
            <li ><a href="<?php echo site_url('PartyAdd');?>"><b>Add New Party</b><span class=""></span></a></li>
            <li class="active"><a ><b>All Party</b><span class=""></span></a></li>
        </ul>
        <div class="col-md-12">&nbsp;
            <div class="table-responsive">
                <table class="table table-striped text-center" id="example" width="100%">
                    <thead>
                        <tr>
                            <td><b>Sr. No.</b></td>
                            <td><b>Name</b></td>
                            <td><b>Address</b></td>
                            <td><b>City</b></td>
                            <td><b>State</b></td>
                            <td><b>Pincode</b></td>
                            <td><b>Landmark</b></td>
                            <td><b>Contact NO.</b></td>
                            <td><b>Contact Person</b></td>
                            <td><b>Email ID</b></td>
                            <td><b>GST IN</b></td>
                            <td><b>Limit</b></td>
                            <td><b>FFSi</b></td>
                            <td ><b>Edit</b></td>
                            <td ><b>Delete</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $s=0;
                        foreach($party_row as $party)
                        { $s++;
                        ?>
                        <tr>
                            <td><?php echo $s;?></td>
                            <td style="text-transform:capitalize;"><?php echo $party->name;?></td>
                            <td style="text-transform:capitalize;"><?php echo $party->address;?></td>
                            <td style="text-transform:capitalize;"><?php echo $party->city;?></td>
                            <td style="text-transform:capitalize;"> 
                                <?php 
                          ?> 
                            </td>
                            <td style="text-transform:capitalize;"><?php echo $party->pincode;?></td>
                            <td style="text-transform:capitalize;"><?php echo $party->landmark;?></td>
                            <td  ><?php echo $party->contact_no;?></td>
                            <td  ><?php echo ucwords($party->contact_person);?></td>
                            <td><?php echo $party->email_id;?></td>
                            <td  ><?php echo $party->gst_in;?></td>
                            <td style="text-transform:capitalize;"><?php echo $party->limit_days;?></td>
                            <td style="text-transform:capitalize;"><?php echo $party->fssai_no;?></td>
                            <td style="width:10%;"><a href="<?php echo site_url('PartyEdit/'.$party->id);?>" class="btn btn-primary btn-sm glyphicon glyphicon-edit"></a></td>

                            &nbsp; 
                            <td><a href="<?php echo site_url('PartyDelete/'.$party->id);?>" class="btn btn-danger btn-sm glyphicon glyphicon-trash"></a></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                
            </div>
        </div>
        <div class="col-sm-12">&nbsp;</div>
    </div>
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