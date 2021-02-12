<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('PurchaseOrder/tabs');?>
        <div class="col-md-12">&nbsp;
            <form method="post" name="form1">
                <div class="col-md-6 col-md-offset-3">
                    <div class="col-md-4 ">
                        <div class="form-group"><b>Enter Date From :</b>
                            <input type="text" name="from_date" autocomplete=off class="form-control datepicker" value="<?php echo date('d-m-Y', strtotime($frmdate));?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><b>To :</b>
                            <input type="text" name="to_date" autocomplete=off class="form-control datepicker" value="<?php echo date('d-m-Y', strtotime($todate));?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-"><br/>
                        <button type="submit" name="submit" class="btn btn-success btn-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-10 col-md-offset-1">&nbsp;
            <form method="post">                                 
                <table class="table table-striped text-center table-responsive" id="example" width="100%">
                    <thead> 
                        <tr class="success"><td colspan="15"><b>Date From : <?php //echo date("d-m-Y",strtotime($frmdate)) ; ?> To : <?php //echo date("d-m-Y",strtotime($todate)); ?></b></td></tr>

                        <tr>
                            <td><b>Sr. No.</b></td>
                            <td><b>Invoice Id</b></td>
                            <td><b>Vendor Name</b></td>
                            <td><b>Contact</b></td>
                            <td><b>Date</b></td>
                            <td><b>Taxable Amt</b></td>
                            <td><b>GST</b></td>
                            <td><b>Total Amt</b></td>
                            <td><b>View Order</b></td>
                            <td><b>Process</b></td>
                        </tr>
                    </thead>
                    <?php 
                    //print_r($hold_order);exit;
                    if(count($hold_order) > 0){
                    ?>
                    <tbody>
                        <?php
                        $s=0;
                        $tot_am_fnl = 0;
                        $fnl_gst = 0;
                        $fnl_totamt = 0;
                        foreach($hold_order as $purchase)
                        {
                            $s++;

                            $rcv_un = unserialize($purchase->received);
                            
                            //print_r($rcv_un); echo nl2br("\n");

                            $tot_amt=0; $tot_gst=0; $tot_fnlamt=0;
                            foreach($rcv_un as $ky=>$vla)
                            {
                                $tot_amt += ($vla[5]);
                                $tot_gst += ($vla[7]);
                                $tot_fnlamt += ($vla[8]);
                            }

                            $tot_am_fnl+=$tot_amt;
                            $fnl_gst+=$tot_gst;
                            $fnl_totamt+=$tot_fnlamt;
                        ?>
                        <tr>
                            <td><?php echo $s; ?></td>
                            <td><?php echo $purchase->id; ?></td>
                            <td><?php echo ucwords($purchase->name); ?></td>
                            <td><?php echo $purchase->contact; ?></td>
                            <td><?php echo date("d-m-Y",strtotime($purchase->date)) ; ?></td>
                            <td><?php echo $tot_amt;   ?></td>
                            <td><?php echo $tot_gst;  ?></td>
                            <td><?php echo $tot_fnlamt;  ?></td>
                            <td><a data="<?php echo $purchase->id; ?>" class="btn btn-warning glyphicon glyphicon-search viewModal"></a></td>
                            
                            <td>
                                <?php 
                                if($purchase->received == '')
                                {
                                ?>
                                <a class="btn btn-primary disabled glyphicon glyphicon-share-alt"></a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo site_url('ProcessHoldOrder/'.$purchase->id); ?>" class="btn btn-primary glyphicon glyphicon-share-alt"></a>
                                <?php
                                }
                                ?>
                            </td>

                             
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <td style="border: 1px solid green;" colspan="4"></td>
                        <td style="border: 1px solid green;"><b>Total</b></td>
                        <td style="border: 1px solid green;"><b><?php echo round($tot_am_fnl); ?></b></td>
                        <td style="border: 1px solid green;"><b><?php echo round($fnl_gst); ?></b></td>
                        <td style="border: 1px solid green;"><b><?php echo round($fnl_totamt); ?></b></td>
                        <td style="border: 1px solid green;" colspan="7"></td>
                    </tfoot>
                    <?php }?>
                </table>                                  
            </form>
        </div>  
        <div class="col-sm-12">&nbsp;</div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-warning">

                            <td><b>Sr. No.</b></td>
                            <td><b>Product Name</b></td>
                            <td><b>Product Weight</b></td>
                            <td><b>Barcode</b></td>
                            <td><b>Quantity</b></td>
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

<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   
<script>
    $('.viewModal').on('click', function(e) {
        var sale_id = $(this).attr('data');
        //var pendAmt = $(this).attr('data-pend');
        $('#myModal').modal('show');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo site_url("PurchaseController/View_hold_order");?>',
            data: {
                'desc_id': sale_id
            },
            async: false,
            dataType: 'json',
            success: function(result){
                var str = '';
                sr_no = 1;
                if(result != 0){
                    var pending =0 ;
                    //alert(result)
                    $.each(result, function( key, value ) {
                        str +='<tr>';
                        str +='<td>'+sr_no+'</td>';
                        str +='<td>'+value.name+'</td>';
                        str +='<td>'+value.weight+'</td>';
                        str +='<td>'+value.barcode+'</td>';
                        str +='<td>'+value.qty+'</td>';
                        str +='</tr>';
                        sr_no++
                        pending = parseInt(pending) + parseInt(value.deposit);
                    });
                    /*str +='<tr class="success">';
                    str +='<td colspan=""> Total </td>';
                    str +='<td colspan="">'+pending+'</td>';
                    str +='<td colspan="4"> </td>';
                    str +='</tr>';
                    str +='<tr class="danger">';
                    str +='<td colspan="6"> Pending Amount : '+pendAmt+'</td>';
                    str +='</tr>';*/
                    /*result.forEach(function(entry){
                        console.log(entry.deposit);
                    })*/
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
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-50:+10",
        });
    });
</script>