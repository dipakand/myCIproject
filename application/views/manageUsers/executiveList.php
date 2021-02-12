<ul class="nav nav-justified nav-pills">
    <li ><a href="<?php echo site_url('userList');?>" >Manage User</a></li>
    <li class="active"><a >Sales Executive</a></li>
</ul>
<div class="col-sm-6">&nbsp;
    <div class="col-sm-12 alert alert-warning text-center"><b>Add Executive Details</b></div>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Executive Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo set_value('name');?>" >
                <?php echo form_error('name');?>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Contact:</label>
            <div class="col-sm-10">
                <input type="number" min="1000000000" max="9999999999" class="form-control" name="contact" placeholder="Enter Contact" value="<?php echo set_value('contact');?>" >
                <?php echo form_error('contact');?>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo set_value('email');?>" >
                <?php echo form_error('email');?>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Enter Password" >
                <?php echo form_error('password');?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit"  class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
<div class="col-sm-6">&nbsp;
    <div class="col-sm-12 alert alert-warning text-center"><b>Manage to Executive</b></div>
    <div class="col-sm-12 table-responsive">
        <form class="form-horizontal" method="post">
            <table class="table table-bordered text-center" width="100%" id="example">
                <thead>
                    <tr>
                        <td style="width:10%"><b>Sr. No.</b></td>
                        <td><b>Executive Name</b></td>
                        <td><b>Contact</b></td>
                        <td><b>Action</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr=0;

                    foreach($sales_executive as $saleexe)
                    {
                        $sr++;
                    ?>
                    <tr>
                        <td><?php echo $sr;?></td>
                        <td <?php if($saleexe->status=='0'){ echo 'style="color:red"';} ?> ><?php echo ucwords($saleexe->name);?></td>

                        <td><?php echo ucwords($saleexe->contact);?></td>
                        <td>
                            <a class="btn btn-primary glyphicon glyphicon-edit btn-sm" data-toggle="modal" data-target="#my<?php echo $saleexe->id;?>"></a> |
                            <a href="<?php echo site_url('delete_exe/'.$saleexe->id);?>" class="btn btn-danger glyphicon glyphicon-remove btn-sm"></a>
                        </td>
                    </tr>
                    <?php
                    }
                    /*$query_party=mysqli_query($conn,"select * from sales_executive");
                    while($row=mysqli_fetch_assoc($query_party))
                    {
                        $sr++;
                        //										$nature=mysqli_fetch_assoc(mysqli_query($conn,"select * from nature_work where id='".$row['designation']."'"));
                        //                                        $manag=mysqli_fetch_assoc(mysqli_query($conn,"select * from tbl_reg where reg_id='".$row['manager_id']."'"));
                    ?>
                    <tr>
                        <td><?php echo $sr;?></td>
                        <td <?php if($row['status']=='0'){ echo 'style="color:red"';} ?> ><?php echo ucwords($row['name']);?></td>

                        <td><?php echo ucwords($row['contact']);?></td>
                        <!--                                            <td><?php echo ucwords($row['contact']);?></td>-->

                        <td width="18%">
                            <a class="btn btn-primary glyphicon glyphicon-edit btn-sm" data-toggle="modal" data-target="#my<?php echo $row['id'];?>"></a> |

                            <!-- Modal -->
                            <div class="modal fade" id="my<?php echo $row['id'];?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form class="form-horizontal" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <table>
                                                        <tr><td>
                                                            <?php
                        $query_party1=mysqli_query($conn,"select * from sales_executive where id='".$row['id']."'");
                        $row1=mysqli_fetch_assoc($query_party1);
                    ?>
                                                            <div class="col-sm-12">
                                                                <div class="">
                                                                    <label for="name" class="col-sm-4 control-label">Executive Name :</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo ucwords($row1['name']);?>">
                                                                        <input type="hidden" class="form-control" name="id1" placeholder="Name" value="<?php echo $row['id'];?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12" style="margin-top:0.5em">
                                                                <div class="">
                                                                    <label for="contact" class="col-sm-4 control-label">Contact :</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" class="form-control" min="1000000000" max="9999999999" class="form-control" name="contact" value="<?php echo $row['contact'] ?>" placeholder="Enter Contact" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12" style="margin-top:0.5em">
                                                                <div class="">
                                                                    <label for="email" class="col-sm-4 control-label">Email :</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" placeholder="Enter Email" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12" style="margin-top:0.5em">
                                                                <div class="">
                                                                    <label for="password" class="col-sm-4 control-label">Password :</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="password" class="form-control"  name="password" placeholder="Enter Password" value="<?php echo $row['password'] ?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12" style="margin-top:0.5em">
                                                                <div class="">
                                                                    <label for="status" class="col-sm-4 control-label">Status :</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="status" required>
                                                                            <option value="1" <?php if($row1['status']==1){echo "selected";}?>>Active</option>
                                                                            <option value="0" <?php if($row1['status']==0){echo "selected";}?>>Deactive</option>
                                                                        </select>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="btn_edit" class="btn btn-success" >Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>                                            

                            <a href="?id=<?php echo $row['id'];?>" class="btn btn-danger glyphicon glyphicon-remove btn-sm"></a></td>
                    </tr>
                    <?php
                    }*/
                    ?>
                </tbody>
            </table>
        </form>

        <?php
        /*if(isset($_POST['btn_edit']))
        {
            //							   echo $_POST['id1'];echo nl2br("\n");
            //							   echo $_POST['name1'];echo nl2br("\n");
            //							   echo $_POST['cantact1'];echo nl2br("\n");
            //							   echo $_POST['email1'];echo nl2br("\n"); 
            //							   echo $_POST['nature_work1'];echo nl2br("\n");
            $update= "UPDATE `sales_executive` SET `name`='".$_POST['name']."', `contact`='".$_POST['contact']."', `email`='".$_POST['email']."', `password`='".$_POST['password']."' , `status`='".$_POST['status']."' WHERE id='".$_POST['id1']."'";
            $query_update=mysqli_query($conn,$update);
            if($query_update == true)
            {
                //								   $massage="Inserted Successfully";
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=add_exe.php\">";
            }
        }*/
        ?>
    </div>
</div>
<?php ?>
<div class="col-sm-12">&nbsp;</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>