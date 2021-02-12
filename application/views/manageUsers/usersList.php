<ul class="nav nav-justified nav-pills">
    <li class="active"><a >Manage User</a></li>
    <li><a href="<?php echo site_url('executiveList');?>">Sales Executive</a></li>
</ul>
<div class="col-lg-8 col-sm-offset-2 col-md-8 col-sm-offset-2 col-sm-12 col-xs-12 ">
    <table class="table table-bordered text-center" id="example" width="100%">
        <thead>
            <tr>
                <td><b>Sr. No.</b></td>
                <td><b>Firstname</b></td>
                <td><b>Lastname</b></td>
                <td><b>Username</b></td>
                <td><b>Role</b></td>
                <td><b>Status</b></td>
                <td><b>Action</b></td>
                <td><b>Delete</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            foreach($users_row as $user)
            { 
                $i++;
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ucwords($user->f_name);?></td>
                <td><?php echo ucwords($user->l_name);?></td>
                <td><?php echo ucwords($user->username);?></td>
                <td><?php echo ucwords($user->role);?></td>
                <td><?php 
                if($user->status== 'Active')
                { ?>
                    <div style="font-size:15px;color:green;">Active</div> 
                    <?php } 
                elseif($user->status=='Not Active')
                { ?>
                    <div style="font-size:15px;color:red;">Not Active</div> 
                    <?php  }
                    ?></td>
                <td>
                    <?php
                if($user->status== 'Active')
                { ?>
                    <a href="<?php echo site_url('activeDeactive/'.$user->reg_id.'/'.$user->status)?>" class="form-control btn-warning glyphicon glyphicon-remove"></a>
                    <?php }
                elseif($user->status=='Not Active')
                { ?>
                    <a href="<?php echo site_url('activeDeactive/'.$user->reg_id.'/'.$user->status)?>" class="form-control btn-success glyphicon glyphicon-ok"></a>
                    <?php }
                else{
                    ?>
                    <a href="<?php echo site_url('activeDeactive/'.$user->reg_id.'/'.$user->status)?>" class="form-control btn-success glyphicon glyphicon-ok"></a>
                    <?php        
                }
                    ?>
                </td>
                <td><a href="<?php echo site_url('deleteUser/'.$user->reg_id);?>"><button class="form-control btn-danger"><span><i class="glyphicon glyphicon-trash"></i></span></button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
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