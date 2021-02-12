<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-pills nav-justified">
            <li  ><a href="<?php echo site_url('Order');?>">Add Order</a></li>
            <li class="active"><a >View All Order</a></li>
        </ul>
        <div class="col-md-12">
            <?php
            //            print_r($order_row);
            ?>
        </div>
        <div class="col-md-12">&nbsp;
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-2 col-md-offset-3    ">
                        <div class="form-group"><b>Enter Date From :</b>
                            <input type="date" name="from_date" class="form-control" autocomplete=off required value="<?php echo $fst_dt;?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group"><b>To :</b>
                            <input type="date" name="to_date" class="form-control" autocomplete=off required value="<?php echo $lst_dt;?>">
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <br>
                        <button type="submit" name="submit" class="btn btn-success btn-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 table-responsive">
            <form method="post">
                <table class="table table-stripted text-center" id="example" width="100%">
                    <thead>
                        <tr class="warning">
                            <td colspan="10"><b>Date From : <?php //echo date("d-m-Y",strtotime($fst_dt)) ;?>&nbsp; To : <?php //echo date("d-m-Y",strtotime($lst_dt)) ; ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Sr. No.</b></td>
                            <td><b>Date</b></td>
                            <td><b>View</b></td>
                            <td><b>Edit</b></td>
                            <td><b>Print</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $s1=0;
                        foreach($order_row as $order)
                        {
                            $s1++;
                        ?>
                        <tr>
                            <td><?php echo $s1;?></td>
                            <td><?php echo date('d-m-Y',strtotime($order->date));?></td>

                            <td>
                                <a class="btn btn-warning glyphicon glyphicon-list-alt btn-sm view_details" data="<?php echo $order->id;?>"></a>
                            </td>
                            <td>
                                <a href="<?php echo site_url('OrderEdit/'.$order->id);?>" class="btn btn-info btn-sm glyphicon glyphicon-edit" title="Edit"></a>
                            </td>
                            <td>
                                <a target="_blank" href="<?php echo site_url('OrderController/print_order/'.$order->id);?>" class="btn btn-primary btn-sm glyphicon glyphicon-print" title="Edit"></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="modal fade" id="detailModal" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Item Details</h4>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body" style="text-align:left;">
                            <table class="table table-stripted table-bordered text-center" id="" width="100%">
                                <thead>
                                    <tr class="warning">
                                        <td><b>Sr. No.</b></td>
                                        <td><b>Product Name</b></td>
                                        <td><b>Product Description</b></td>
                                        <td><b>MRP</b></td>
                                        <td><b>Order Qty</b></td>
                                    </tr>
                                </thead>
                                <tbody id="tbody_data">
                                    <?php 
                                    /* $s=0;
                                    $select="select * from orders where id='".$fetch1['id']."' ";
                                    $query=mysqli_query($conn,$select);
                                    $fetch=mysqli_fetch_assoc($query);

                                    $item_ary=unserialize($fetch['item_array']);
                                    foreach($item_ary as $key=>$val)
                                    {
                                        $s++;
                                        $fetch111=mysqli_fetch_assoc(mysqli_query($conn,"select * from product_desc  where id='".$val['id']."'"));

                                        $fet11=mysqli_fetch_assoc(mysqli_query($conn,"select * from product  where product_id='".$fetch111['product_id']."' "));
                                    ?>
                                    <tr>
                                        <td><?php echo $s;?></td>
                                        <td><?php echo ucwords($fet11['name']);?></td>
                                        <td><?php echo ucwords($fetch111['weight']);?></td>
                                        <td><?php echo $val['mrp'];?></td>
                                        <td><?php echo $val['qty'];?></td>
                                    </tr>
                                    <?php
                                    }*/

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>     

        <div class="col-md-12">&nbsp;</div>
    </div>
</div>
<!--<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>-->
<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   -->

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
-->

<script>
    $(document).on('click','.view_details', function(){
        var ID = $(this).attr('data');
        $('#detailModal').modal('show');
        $.ajax({
            url : '<?php echo site_url('OrderController/details');?>',
            type : 'post',
            dataType : 'json',
            data : {
                order_id : ID
            },
            success : function(data){

                var str = '';
                var sr = 1;

                data.forEach((element, index) => {
                    console.log(element)

                    sr = sr + index;

                    str +='<tr>';
                    str +='<td>'+sr+'</td>';

                    /*var names = '';
                    $.ajax({
                        url : '<?php echo site_url('OrderController/getName');?>',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            id : element.id
                        },
                        success : function(fetch){
                            names = fetch;
                            //                            console.log(names)
                        }
                    });
                    console.log(names);*/
                    str +='<td>'+element.name+'</td>';
                    str +='<td>'+element.weight+'</td>';
                    str +='<td>'+element.mrp+'</td>';
                    str +='<td>'+element.qty+'</td>';
                    str +='</tr>';
                });

                $('#tbody_data').html(str);
            }
        });
    });

</script>

<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-50:+10",
        });
    });
</script>