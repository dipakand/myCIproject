<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-justified nav-pills">
            <li class="active"><a >Manage Product</a></li>
            <li ><a href="<?php echo site_url('brandAdd');?>" >Manage Brand</a></li>
        </ul>
    </div>

    <div class="col-sm-12">&nbsp;
        <ul class="nav nav-pills nav-justified">
            <li ><a href="<?php echo site_url('ProductAdd');?>">Add New </a></li>
            <li class="active"><a >Manage All</a></li>
        </ul>&nbsp;

        <div class="col-sm-12">
            <table class="table table-striped text-center" id="example" width="100%">
                <thead>
                    <!--                                <tr class="success"><td colspan="9"><b><?php echo ucwords($fetch['name']);?></b></td></tr>-->
                    <tr>
                        <td><b>Sr. No.</b></td>
                        <td><b>Product Name </b></td>
                        <td><b>Brand</b></td>                                    
                        <td><b>Categary</b></td>
                        <td><b>HSN Code</b></td>
                        <td><b>I GST</b></td>
                        <!--<td><b>C GST</b></td>-->
                        <!--<td><b>S GST</b></td>-->
                        <td><b>Description</b></td>
                        <td><b>Edit</b></td>
                        <td><b>Add Sub Product Under</b></td>
                        <!--
<td><b>Action</b></td>
<td><b>Add Sub Product Under</b></td>
-->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $s=0;
                    //print_r($proDescRow);
                    foreach($proDescRow as $vaule)
                    { 
                        $s++;
                        
                    ?>
                    <tr>
                        <td><?php echo $s; ?></td>
                        <td><?php echo $vaule->name;?></td>
                        <td><?php echo $vaule->brname;?></td>
                        <td><?php echo $vaule->category;?></td>
                        <td><?php echo $vaule->hsn;?></td>
                        <td><?php echo $vaule->i_gst;?></td>
                        <td>
                            <a data="<?php echo $vaule->product_id;?>" class="btn btn-warning btn-sm glyphicon glyphicon-th-list viewModal"></a><!--data-toggle="modal" data-target="#mymodel"-->
                        </td>
                        <td>
                            <a href="<?php echo site_url("ProductEdit/".$vaule->product_id);?>" class="btn btn-primary btn-sm glyphicon glyphicon-edit"></a>
                        </td>
                        <td>
                            <!--                            <a href="add_sub_prod.php?product_id=<?php echo $row['product_id'];?>" class="btn btn-danger"> ---**<?php echo $row['name'];?>**---</a>-->
                            <a href="<?php echo site_url('AddProductDesc/'.$vaule->product_id);?>" class="btn btn-danger"> ---**<?php echo $vaule->name;?>**---</a>
                        </td>
                    </tr>
                    <?php 
                    }
                    /*

                    ?>
                    <tr>
                        <td><?php echo $s; ?></td>
                        <td style="text-transform:capitalize;"><?php echo $row['name'];?></td>
                        <td style="text-transform:capitalize;">
                            <?php $selectbrand="select * from brand_master where id=".$row['brand_id'];
                     $querybrand=mysqli_query($conn, $selectbrand);
                     $rowbrand=mysqli_fetch_assoc($querybrand);
                     echo $rowbrand['name'];
                    ?></td>
                        <td style="text-transform:capitalize;">
                            <?php $selectcategory="select * from category where id=".$row['category_id'];
                     $querycategory=mysqli_query($conn, $selectcategory);
                     $rowcategory=mysqli_fetch_assoc($querycategory);
                     echo $rowcategory['category'];
                    ?>
                        </td>
                        <td style="text-transform:capitalize;"><?php echo $row['hsn'];?></td>
                        <td style="text-transform:capitalize;"><?php echo $row['i_gst'];?></td>
                        <td style="text-transform:capitalize;"><?php echo $row['c_gst'];?></td>
                        <td style="text-transform:capitalize;"><?php echo $row['s_gst'];?></td>
                        <td><a data-toggle="modal" data-target="#my<?php echo $row['product_id']+$row['name'];?>" class="btn btn-warning btn-sm glyphicon glyphicon-th-list"></a>

                            <div class="modal fade" id="my<?php echo $row['product_id']+$row['name'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Product Description -- <b><?php echo ucwords($row['name']);?></b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <table class="table table-striped table-hover text-center">
                                                    <tr>
                                                        <td><b>Sr. No.</b></td>
                                                        <td><b>Weight</b></td>
                                                        <td><b>MRP</b></td>
                                                        <td><b>Barcode Value</b></td>
                                                        <td><b>Stock</b></td>
                                                        <td><b>Selling Price</b></td>
                                                    </tr>
                                                    <?php
                     $i=0;
                     $select12="select * from product_desc where product_id='".$row['product_id']."'";
                     $query12=mysqli_query($conn, $select12);
                     while($row1=mysqli_fetch_assoc($query12))
                     { $i++;
                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo  $row1['weight']; ?></td>
                                                        <td><?php echo  $row1['mrp']; ?></td>
                                                        <td><?php echo  $row1['barcode']; ?></td>
                                                        <td><?php echo  $row1['stock']; ?></td>
                                                        <td><?php echo  $row1['sale_price']; ?></td>
                                                    </tr>
                                                    <?php
                     }
                    ?>
                                                </table>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <!-- <td><a href="edit_product.php?id=<?php echo $row['product_id'];?>&&brand_name=<?php echo $_GET['brand_name'];?>" class="btn btn-primary btn-sm glyphicon glyphicon-edit"></a></td>
<td><a href="add_sub_prod.php?product_id=<?php echo $row['product_id'];?>" class="btn btn-danger"><?php echo ucwords($row['name']);?></a></td>-->
                    </tr>
                    <?php } */?>
                </tbody>
            </table>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-warning">
                                        <td><b>Sr. No.</b></td>
                                        <td><b>Weight</b></td>
                                        <td><b>MRP</b></td>
                                        <td><b>Barcode Value</b></td>
                                        <td><b>Stock</b></td>
                                        <td><b>Selling Price</b></td>
                                        <td><b>Edit</b></td>
                                        <td><b>Delete</b></td>
                                    </tr>
                                </thead>
                                <tbody id="pro_details">
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
            <script>
                $('.viewModal').on('click', function(e) {
                    var descri = $(this).attr('data');
                    $('#myModal').modal('show');
                    //alert(descri)
                    $.ajax({
                        type: 'ajax',
                        method: 'get',
                        url: '<?php echo site_url("ProductController/View_description");?>',
                        data: {
                            'desc_id': descri
                        },
                        async: false,
                        dataType: 'json',
                        success: function(result){
                            var str = '';
                            sr_no = 1;
                            if(result != 0){
                                //alert(result)
                                result.forEach(function(entry){
                                    console.log(entry);
                                    str +='<tr>';
                                    str +='<td>'+sr_no+'</td>';
                                    str +='<td>'+entry.weight+'</td>';
                                    str +='<td>'+entry.mrp+'</td>';
                                    str +='<td>'+entry.barcode+'</td>';
                                    str +='<td>'+entry.stock+'</td>';
                                    str +='<td>'+entry.sale_price+'</td>';
                                    str +='<td><a href="<?php echo site_url("EditDesc/");?>'+entry.id+'" class="btn btn-primary btn-sm glyphicon glyphicon-edit"></a></td>';
                                    str +='<td><a href="<?php echo site_url("deleteDesc/");?>'+entry.id+'" class="btn btn-danger btn-sm glyphicon glyphicon-remove"></a></td>';
                                    str +='</tr>';
                                    sr_no++
                                })
                                //str +='<tr class="table-danger">';
                                //str +='<td colspan="6"> Balance Amount : '+pending+'</td>';
                                //str +='</tr>';
                            }
                            document.getElementById("pro_details").innerHTML = str;

                            //$('input[name=siteid]').val(data.siteid);
                            //$('input[name=sitename]').val(data.sitename);
                        },
                        error: function(){
                            console.log('Could not displaying data');
                        }           
                    });
                });
            </script>

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
        </div>
    </div>
</div>
