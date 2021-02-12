<div class="row">
    <div class="col-sm-12">
        <?php $this->load->view('SaleModule/tabes');?>

        <div class="row">
            <div class="col-md-8 ">&nbsp;
                <form method="post" >                                 
                    <div class="col-md-4 col-md-offset- ">
                        <div class="form-group"><b>&nbsp;Search By Party Name : </b>
                            <input type="text" name="party_name" id="search_party" class="form-control" autofocus style="text-transform:capitalize;" placeholder="Enter Name" />
                            <input type="hidden" name="id_party" id="id_party" value="sfsf" />
                        </div>                                                
                    </div>   
                    <div class="col-md-3">
                        <div class="form-group"><b>&nbsp;Search By Date From :</b> 
                            <input type="date" name="date_frm" class="form-control " autocomplete=off placeholder="Enter From" value="<?php echo $date1;?>" />
                        </div>                                                
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"><b>&nbsp;To : </b>
                            <input type="date" name="date_to" class="form-control " autocomplete=off placeholder="Enter To" value="<?php echo $date2;?>" />
                        </div>                                                
                    </div>                    
                    <div class="col-md-2 col-md-offset-">
                        <div class="form-group">&nbsp;
                            <button type="submit" class="btn btn-success btn-block" name="search"><span class="<!--glyphicon glyphicon-search-->"></span> Search </button>       
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 ">&nbsp;
                <form method="post">                                 
                    <div class="col-md-7 col-md-offset- ">
                        <div class="form-group"><b>&nbsp;Search By Invoice No: </b>
                            <input type="text" name="search_invoice" id="search_invoice" class="form-control" autofocus required style="text-transform:capitalize;" placeholder="Enter Invoice No">
                        </div>                                                
                    </div>                                                                                       
                    <div class="col-md-5 col-md-offset-">
                        <div class="form-group">&nbsp;
                            <button type="submit" class="btn btn-success btn-block" name="search_inv"><span class="glyphicon glyphicon-search"></span> Search </button>       
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 ">
            <h4 class="alert alert-success text-center" style="margin-bottom: 10px; margin-top: 5px; padding: 10px;"><b>Date From : <?php //echo date("d-m-Y",strtotime($_SESSION['frm_dt'])); ?>&nbsp; - To : <?php //echo date("d-m-Y",strtotime($_SESSION['to_dt'])) ;?></b></h4>
        </div>
        <div class="col-sm-12 text-center alert-danger">
            <form class="form-inline" enctype="multipart/form-data" method="post" action="<?php echo site_url('SaleController/all_print_page');?>">
                <div class="form-group">
                    <label for="email">Enter From Date : </label>
                    <input type="date" name="from_id" min="0" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="pwd">Enter To Date : </label>
                    <input type="date" name="to_id" min="0" class="form-control">
                </div>
                <button type="submit" name="print_btn" class="btn btn-success">Submit To Print</button>
            </form>
            <?php
            /*if(isset($_POST['print_btn']))
            {
                $_POST['from_id'];
                $_POST['to_id'];
                $select22="select * from sales where cancel_status!='1' and date between '".$_POST['from_id']."' and '".$_POST['to_id']."' ";
                $query22=mysqli_query($conn,$select22);
                while($fetch22=mysqli_fetch_assoc($query22))
                {
                    $arr[]= $fetch22['id'];
                }
                $_SESSION['mult_arr_print']=$arr;
                echo"<meta http-equiv='refresh'content='0; url=all_print_sale_party.php?count=0'>";
            }*/
            ?>
        </div>
        <div class="col-md-12 table-responsive"> &nbsp;
            <form method="post">
                <table class="table table-striped text-center table-hover table-responsive" id="example" width="100%">
                    <thead>                                     
                        <tr>
                            <td><b>Sr.<br/>No.</b></td>
                            <td><b>Receipt<br/>No.</b></td>
                            <td><b>Party Name</b></td>
                            <td><b>Date</b></td>
                            <td><b>Due Date</b></td>
                            <td><b>Taxable<br/>Amount</b></td>
                            <td><b>GST</b></td> 
                            <td><b>Return<br/>Amount</b></td> 
                            <td><b>Total<br/>Amount</b></td> 
                            <td><b>Pending<br/>Amount</b></td> 
                            <td><b>Payment</b></td> 
                            <td><b>Action</b></td> 
                            <td><b>Print</b></td>
                            <!--<td><b>Print2</b></td>-->
                            <td><b>Payment<br/>Recieve</b></td>                                        
                            <td><b>view<br/>log</b></td>                                        
                            <td><b>Receipt</b></td>                                        
                            <td><b>Return</b></td>
                            <td><b>Order<br/>Cancel</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($sale_rows > 0)
                        {
                            $s=0;
                            $total_amt=0;
                            $taxable_amt=0;
                            $gst_amt=0;$total_amt12=0;$total_amt123=0;
                            foreach($sale_rows as $sale)
                            { 

                                $total=0;
                                $s++; 
                                //if($s <= 10)
                                {
                                    if($sale->cod_amt > 0)
                                    {
                                        $total = (Int)$sale->cod_amt - (Int)$sale->receive_amt - (Int)$sale->credit_amt - (Int)$sale->return_amt;
                                    }
                                    else
                                    {
                                        $total = (Int)$sale->total_amt - (Int)$sale->receive_amt - (Int)$sale->credit_amt - (Int)$sale->return_amt;
                                    }

                                    $total_amt +=$total;
                                    $total_amt12 +=(Int)$sale->total_amt;
                                    $total_amt123 +=(Int)$sale->return_amt;
                                    $taxable_amt +=(Int)$sale->taxable_amt;
                        ?>                                    
                        <tr>
                            <td><?php echo $s;?></td>
                            <td>
                                <?php
                                    $accy_countt=unserialize($sale->item_detail);
                                    $accy_countt1=count($accy_countt);
                                    if($accy_countt1 > 12){
                                        $print_page=site_url('SaleController/invoice_12_print/');
                                    }else{
                                        $print_page=site_url('SaleController/invoice_print/');
                                    }
                                ?>
                                <a onclick="window.open('<?php echo $print_page.$sale->id; ?>')" title="Invoice Print">
                                    <!--<a href="<?php echo site_url('SaleController/invoice_print/'.$sale_row->id); ?>"  class="btn btn-primary btn-sm " title="Invoice Print"  target="_blank">Print</a>-->
                                    <?php 
                                    if($sale->bill_no!='')
                                    {
                                        echo $sale->bill_no;
                                    }else{

                                        echo $sale->id;
                                    }
                                    ?></a>
                            </td>
                            <td style="text-transform:capitalize; text-align:left;"><?php
                                    if($sale->receive_amt!=0)
                                    {
                                        echo $sale->party_name.' '.$sale->contact_no;
                                    }else{
                                ?>
                                <a href="<?php echo site_url('PartyChange/'.$sale->id); ?>"><?php echo $sale->party_name.' '.$sale->contact_no; ?></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo date("d-m-Y",strtotime($sale->date)) ;?></td>
                            <td><?php $n= $sale->limit_days;
                                    echo $enddate = date("d-m-Y",strtotime ( $n.'day' , strtotime ( $sale->date ) )) ;
                                ?>
                            </td>
                            <td><?php echo round($sale->taxable_amt,2);?></td>
                            <td><?php 
                                    if($sale->i_gst > 0)
                                    {
                                        echo $val=$sale->i_gst;
                                        $gst_amt += $val;
                                    }
                                    else
                                    {
                                        echo $val=round($sale->c_gst+$sale->c_gst,2);
                                        $gst_amt += $val;
                                    }
                                ?>
                            </td>
                            <td><?php 
                                    if($sale->return_amt > 0){
                                        echo round($sale->return_amt,2); 
                                    }
                                    else{
                                        echo "0";
                                    }
                                ?>
                            </td> 
                            <td><?php echo round($sale->total_amt,2); ?></td> 
                            <?php 
                                    if($sale->cancel_status == '1')
                                    { ?>
                            <td  colspan="9">
                                <div class="col-md-12 label label-default" style="font-size:20px; width=100%;">Order Canceled </div>
                            </td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <td style="display:none;"></td>
                            <?php }
                                    else
                                    { ?>
                            <td><?php echo round($total,2); ?></td>
                            <td>
                                <?php 
                                     if($sale->total_amt != $sale->return_amt){
                                         if((Int)$sale->total_amt == ((Int)$sale->receive_amt+(Int)$sale->credit_amt) || ((Int)$sale->receive_amt>0 && (((Int)$sale->receive_amt+(Int)$sale->credit_amt-(Int)$sale->return_amt) == (Int)$sale->cod_amt)) )
                                         {
                                ?>
                                <label class="label label-success" style="font-size:15px;">Received</label>
                                <?php
                                         }
                                         else
                                         { 
                                ?>
                                <label class="label label-danger" style="font-size:15px;">Pending</label>
                                <?php
                                         }
                                     }  else { ?>
                                <label class="label label-default" style="font-size:15px;">Return</label>
                                <?php } 
                                ?>
                            </td>
                            <td width="3%">
                                <?php 
                                     $item_detail=unserialize($sale->item_detail);
                                     $ary_cnt=count($item_detail);
                                     if((Int)$sale->total_amt == ((Int)$sale->receive_amt+(Int)$sale->credit_amt) || ((Int)$sale->receive_amt>0 && (((Int)$sale->receive_amt+(Int)$sale->credit_amt) == (Int)$sale->cod_amt)) )
                                     {
                                         if($ary_cnt==0){
                                ?>
                                <a href="<?php echo site_url('EditSales/'.$sale->id); ?>" class="btn btn-info btn-sm glyphicon glyphicon-edit" title="Edit"></a>    
                                <?php
                                         }else{
                                ?>
                                <button class="btn btn-info btn-sm glyphicon glyphicon-edit disabled"></button>&nbsp;                                            
                                <?php
                                         } 
                                     }
                                     else
                                     { 
                                ?>
                                <?php if($sale->return_item==''){?>
                                <a href="<?php echo site_url('EditSales/'.$sale->id); ?>" class="btn btn-info btn-sm glyphicon glyphicon-edit" title="Edit"></a>                                  
                                <?php
                                                                } else {?>
                                <button class="btn btn-info btn-sm glyphicon glyphicon-edit disabled"></button>&nbsp;
                                <?php }?>
                                <?php
                                     }
                                ?>

                            </td>
                            <td width="3%">
                                <?php
                                     if($ary_cnt > 0){
                                ?>
                                <a href="<?php echo site_url('SaleView/'.$sale->id); ?>"  class="btn btn-primary btn-sm glyphicon glyphicon-file" title="Invoice Print"></a>
                                <?php } else {?>
                                <a  class="btn btn-primary btn-sm glyphicon glyphicon-file disabled" title="Invoice Print"></a>
                                <?php } ?>
                            </td>
                            <!--<td width="3%">
<a href="invoice_printa5.php?id=<?php echo $sale->id; ?>&all_frm_to=all_frm_to'"  class="btn btn-primary btn-sm" title="Invoice Print" target="_blank"><b>A5</b></a>
</td>--> 
                            <td> 
                                <?php 
                                     if((Int)$sale->total_amt == ((Int)$sale->receive_amt+(Int)$sale->credit_amt) || ((Int)$sale->receive_amt>0 && (((Int)$sale->receive_amt+(Int)$sale->credit_amt) == (Int)$sale->cod_amt)) )
                                     { 
                                ?>
                                <button class="btn btn-default disabled">Received</button>
                                <?php
                                     }
                                     else
                                     { 
                                ?>
                                <?php if($sale->return_item==''){?>
                                <a href="<?php echo site_url('ReceiveMain/'.$sale->id.'/sale'); ?>" class="btn btn-default  ">Receive</a>
                                <?php
                                                                } else {?>
                                <button class="btn btn-default disabled">Received</button>
                                <?php }?>
                                <?php
                                     }
                                ?>
                            </td>
                            <td>
                                <?php

                                     $this->db->where('sales_id', $sale->id);
                                     $num_row = $this->db->get('sales_log');

                                     if($num_row->num_rows() >0)
                                     {
                                ?>
                                <a  data="<?php echo $sale->id;?>" data-pend="<?php echo round($total,2);?>" class="btn btn-warning  viewModal">View</a>
                                <?php
                                     }
                                     else
                                     {
                                ?>
                                <button class="btn btn-warning disabled" title="No log">View</button>
                                <?php
                                     }
                                ?>
                            </td>
                            <td>
                                <?php
                                     if($num_row->num_rows() >0)
                                     {
                                ?>
                                <a href="<?php echo site_url('Receipts/'.$sale->id);?>" class="btn btn-warning btn-sm glyphicon glyphicon-list-alt"></a>
                                <?php
                                     }
                                     else
                                     {
                                ?>
                                <button class="btn btn-warning btn-sm disabled glyphicon glyphicon-list-alt" title="No log"></button>
                                <?php
                                     }
                                ?>
                            </td>
                            <td>
                                <?php 
                                     if($sale->return_amt > 0 ) { ?>
                                <button  class="btn btn-success disabled">Return</button>
                                <?php }  else  { ?>
                                <a href="<?php echo site_url('ReturnProduct/'.$sale->id);?>" class="btn btn-success">Return</a>
                                <?php }?>
                            </td>
                            <td>
                                <?php 
                                     if((Int)$sale->total_amt == ((Int)$sale->receive_amt+(Int)$sale->credit_amt) || ((Int)$sale->receive_amt>0 && (((Int)$sale->receive_amt+(Int)$sale->credit_amt) == (Int)$sale->cod_amt)) )
                                     { 
                                ?>
                                <button class="btn btn-danger disabled">Cancel</button>
                                <?php
                                     }
                                     else
                                     { 
                                ?>
                                <?php if($sale->return_item==''){?>
                                <!--                                <a href="cancel_sale.php?id=<?php echo $sale->id;?>" class="btn btn-danger">Cancel</a>-->
                                <a href="<?php echo site_url('CancelSale/'.$sale->id);?>" class="btn btn-danger">Cancel</a>
                                <?php
                                                                } else {?>
                                <button class="btn btn-danger disabled">Cancel</button>
                                <?php }?>
                                <?php
                                     }
                                ?>
                            </td>
                            <?php }
                            ?> 
                        </tr>   
                        <?php 
                                } 
                            }

                        ?>
                    </tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid green;"><b><?php echo round($taxable_amt,2);?></b></td>
                        <td style="border: 1px solid blue;"><b><?php echo round($gst_amt,2);?></b></td>
                        <td style="border: 1px solid red;"><b><?php echo round($total_amt123,2);?></b></td>
                        <td style="border: 1px solid red;"><b><?php echo round($total_amt12,2);?></b></td>
                        <td style="border: 1px solid #FF4500;"><b><?php echo round($total_amt,2);?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </table>
            </form>
        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>

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
                            <td><b>Amount</b></td>
                            <td><b>Payment Mode</b></td>
                            <td><b>Cheque No.e</b></td>
                            <td><b>Bank Name</b></td>
                            <td><b>Date</b></td>
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
<script>
    $('.viewModal').on('click', function(e) {
        var sale_id = $(this).attr('data');
        var pendAmt = $(this).attr('data-pend');
        $('#myModal').modal('show');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo site_url("SaleController/View_saleLog");?>',
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
                    $.each(result[0], function( key, value ) {
                        //console.log( key + ": " + value.deposit );
                        str +='<tr>';
                        str +='<td>'+sr_no+'</td>';
                        str +='<td>'+value.deposit+'</td>';
                        str +='<td>'+value.payentMode+'</td>';
                        str +='<td>'+value.chequeNo+'</td>';
                        str +='<td>'+value.names+'</td>';
                        str +='<td>'+value.date_time+'</td>';
                        str +='</tr>';
                        sr_no++
                        pending = parseInt(pending) + parseInt(value.deposit);
                    });
                    str +='<tr class="success">';
                    str +='<td colspan=""> Total </td>';
                    str +='<td colspan="">'+pending+'</td>';
                    str +='<td colspan="4"> </td>';
                    str +='</tr>';
                    str +='<tr class="danger">';
                    str +='<td colspan="6"> Pending Amount : '+pendAmt+'</td>';
                    str +='</tr>';
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
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            // buttons: [ 'copy', 'excel', 'pdf', 'csvHtml5','print' ]
            buttons: [
                {
                    extend: 'excel',className: 'btn-primary',
                    exportOptions: {
                        //columns: [ 0, 1, 2, 3,4,5] //Your Colume value those you want
                    },
                },
                {
                    extend: 'pdf',className: 'btn-primary',orientation:'landscape', 
                    exportOptions: {
                        //columns: [ 0, 1, 2, 3,4,5] //Your Colume value those you want
                    },
                },
                {
                    extend: 'print',className: 'btn-primary',orientation:'landscape',
                    exportOptions: {
                        //columns: [ 0, 1, 2, 3,4,5] //Your Colume value those you want
                    }
                },
            ],
        } );

        table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script>

<style>
    .ui-autocomplete{
        cursor : pointer;
        height: 200px;
        overflow-y: scroll;
    }
</style>

<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   

<script>
    $('#search_party').autocomplete({
        source: '<?=base_url()?>SaleController/getParty',
        select: function (event, ui) {
            var name = ui.item.label
            $("#id_party").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_party").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            $( "#id_party" ).val( ui.item? ui.item.value : '' );
        }
    });
</script>

<script>
    $('#search_barcode').autocomplete({
        source: '<?=base_url()?>SaleController/getbarcode',
        /*select: function (event, ui) {
            var name = ui.item.label
            //$("#barco").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_barcode").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            //$( "#barco" ).val( ui.item? ui.item.value : 0 );
        }*/
    });
</script>