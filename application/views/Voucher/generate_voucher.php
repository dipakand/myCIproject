<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a >Generate Voucher</a></li>
            <li class=""><a href="<?php echo site_url('ViewVoucher');?>">View Voucher</a></li>
        </ul>

    </div>
    <?php
    if(!$this->session->userdata('vendor_row'))
    {
    ?>
    <div class="col-md-12" style="margin-top : 2%;">
        <div class="col-md-2 col-md-offset-2">
            <form method="post" name="frma">
                <div class="from-group">
                    <a style="border-radius: 50%;" class="btn btn-primary  btn-sm glyphicon glyphicon-plus " data-toggle="modal" data-target="#myModel"></a><b style="padding-right:30px;font-size:16px;"> New Party</b>
                </div>
            </form>
            <div class="modal fade" id="myModel" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add New Voucher</h4>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <table width="100%"><tr><td>
                                    <form class="form-horizontal" method="post">
                                        <div class="form-group col-sm-12"><br>
                                            <label for="name" class="col-sm-4 control-label">Party Name : </label>
                                            <div class="col-sm-8">
                                                <input style="text-transform: capitalize;" type="text" class="form-control" id="name" name="ename" required placeholder="Enter Name">
                                                <div class="alert-danger" style="display : none;" id="name_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12"><br>
                                            <label for="econtact" class="col-sm-4 control-label">Contact No : </label>
                                            <div class="col-sm-8">
                                                <input style="text-transform: capitalize;" maxlength="10" type="text" class="form-control" id="contact" name="econtact" required placeholder="Enter Contact No">
                                                <div class="alert-danger" style="display : none;" id="contact_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12"><br>
                                            <label for="name" class="col-sm-4 control-label">GSTIN  : </label>
                                            <div class="col-sm-8">
                                                <input style="text-transform: capitalize;" type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter GST No">
                                                <div class="alert-danger" style="display : none;" id="gstin_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12"><br>
                                            <label for="name" class="col-sm-4 control-label">State : </label>
                                            <div class="col-sm-8">
                                                <select name="state"class="form-control" id="state">
                                                    <option value="">Select State</option>
                                                    <?php 
        foreach($state_row as $state)
        {
                                                    ?>
                                                    <option value="<?php echo $state->state_id;?>"><?php echo $state->state_name;?></option>
                                                    <?php
        }
                                                    ?> 
                                                </select>
                                                <div class="alert-danger" style="display : none;" id="state_error"></div>
                                            </div>
                                        </div>
                                    </form>
                                    </td></tr></table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btn_submit" name="btn_submit" class="btn btn-success" >Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
        <form method="post">
            <div class="col-md-3 form-group">
                <b>Existing Party :</b>
                <input type="text" name="searchsearch_vendor_party" id="search_vendor" class="form-control" style="text-transform:capitalize;" required autofocus placeholder="Search Party Name">
                <input type="hidden" name="id_vendor" id="id_vendor">
            </div>
            <div class="col-md-2 form-group">
                <b>&nbsp;</b><input type="submit" name="autosearch" class="form-control btn btn-success btn-block">
            </div>
        </form>
    </div>
    <?php
    }
    else
    {
        $vendor = $this->session->userdata('vendor_row');
    ?>
    <form id="form" action="<?php echo site_url('VoucherController/save_voucher');?>" method="post" enctype="multipart/form-data" >
        <table class="table table-bordered" id="dynamic_field">
            <tr>
                <td><b>Party Name : </b><?php echo ucwords($vendor->name); ?></td>
                <td><b>Contact No : </b><?php echo $vendor->contact_no; ?></td>
                <td><b>State : </b> <?php  echo $vendor->state_name; ?> </td>
                <td><b>GST In No. :</b><?php echo $vendor->gst_in; ?></td>
                <td><b>Bill Date :</b><input type="date" class="form-control" name="date_to" value="<?php echo date('Y-m-d'); ?>" required></td>
                <td><b>Bill No :</b><input type="text" class="form-control" name="bill_no" required></td>
                <?php if($vendor->gst_in != ''){ $party="required"; ?>
                <td colspan="4"></td> <?php }else{ $party=""; } ?>
            </tr>
            <tr>
                <td colspan="1"><b>Product Name :</b></td>
                <td colspan="1"><b>Rate :</b></td>
                <td colspan="1"><b>Quantity :</b></td>
                <?php if($vendor->gst_in != ''){?>
                <td colspan="1"><b>HSN :</b> </td>
                <td colspan="1"><b>GST % :</b> </td>
                <?php } ?>
                <td colspan="1"><b>Total Amount :</b> </td>
                <td colspan="1"> </td>
            </tr>
            <tr>
                <td colspan="1"><input type="text" name="product[]" id="product_id" placeholder="Enter Product Name" class="form-control name_list" required title="Please enter item"></td> 
                <td colspan="1"><input type="number" name="rate[]" id="rate_id" class="form-control" placeholder="Rate" step="any" required title="Please enter rate" ></td>
                <td colspan="1"><input type="number"   name="qty[]" id="qty_id" placeholder="Quantity" class="form-control name_list" required pattern="[0-9]{1,10}" title="Please enter quantity" <?php if($vendor->gst_in == ''){?>onblur="myFunction0()" <?php } ?>></td> 
                <?php $none =''; if($vendor->gst_in == '') { $none="display:none"; } ?>
                <td colspan="1" style="<?php echo $none; ?>"><input type="text" name="hsn[]"  placeholder="HSN" class="form-control name_list"  pattern="[0-9]{1,10}" title="Please enter HSN" <?php echo $party;?>></td>
                <td colspan="1" style="<?php echo $none; ?>"><input type="number" step="any" name="gst[]" id="gst_id" placeholder="GST" class="form-control name_list"  value="0" <?php if($vendor->gst_in != ''){?>onblur="myFunction0()" <?php } echo $party; ?>></td> 
                <td colspan="1"><input type="text" name="total_amt[]" id="total_id" placeholder="Total Amount" class="form-control name_list last_num"   required></td>
                <td width="20px"><button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i> </button></td> 
            </tr> 
        </table>
        <div class="hide" id="response">Sending Data.......</div>
        <button id="button" type="submit" value="Upload" name="submit" class="btn btn-warning">Request</button>
    </form>
    <div class="col-sm-4 col-sm-offset-4">
        <a class="btn btn-danger btn-block" href="<?php echo site_url('VoucherController/unse_session');?>">Cancel</a>
    </div>
    <script>
        function myFunction0() {
            var x = $("#rate_id").val();
            var y = $("#qty_id").val();
            var z = $("#gst_id").val();
            var tot = (x*y*z)/100;
            var all_tot= parseFloat(tot)+parseFloat(x*y);
            //    alert(tot);
            //    alert(all_tot);
            document.getElementById("total_id").value=all_tot;   
        }
    </script>  
    <script>
        $(document).ready(function (e) {
            <?php
        if(isset($_GET['suc']) && $_GET['suc']==1){
            ?>
            $('#msg').delay(3000).slideUp();
            <?php
        }
            ?>
            var i=1;  
            $('#add').click(function(){  
                i++;  
                $('#dynamic_field').append('<tr id="row'+i+'"><td colspan="1"><input type="text" name="product[]" placeholder="Enter Product Name" class="form-control name_list" required /></td><td colspan="1"><input type="number" name="rate[]" id="rate_id'+i+'" class="form-control" placeholder="Rate" step="any" required></td><td colspan="1"><input type="text" name="qty[]" id="qty_id'+i+'" class="form-control" placeholder="Quantity" required ></td> <?php if($vendor->gst_in != ''){?><td colspan="1"><input type="text" name="hsn[]" class="form-control" placeholder="HSN" <?php echo $party;?> ></td><td colspan="1"><input type="text" name="gst[]" id="gst_id'+i+'"  class="form-control" placeholder="GST" <?php echo $party;?>></td><?php } ?><td colspan="1"><input type="text" name="total_amt[]" id="total_id'+i+'" onblur="function_data()" class="form-control last_num" placeholder="Total Amount"  required></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove"><i class="glyphicon glyphicon-trash"></i></button></td></tr>');  
                <?php if($vendor->gst_in == ''){ ?>
                $('#qty_id'+i).blur(function(){ 
                    var x = $("#rate_id"+i).val();
                    var y = $("#qty_id"+i).val();
                    var tot = (x*y);
                    //                        alert(tot);
                    document.getElementById("total_id"+i).value=tot;  
                });
                <?php }else{ ?>
                $('#gst_id'+i).blur(function(){ 
                    var x = $("#rate_id"+i).val();
                    var y = $("#qty_id"+i).val();
                    var z = $("#gst_id"+i).val();
                    var tot = (x*y*z)/100;
                    var all_tot= parseFloat(tot)+parseFloat(x*y);
                    //                        alert(all_tot);
                    document.getElementById("total_id"+i).value=all_tot;  
                });
                <?php } ?>
                var last= $("#total_id"+i+":last").val();
                if(last == ''){
                    $('#add').attr("disabled",true);
                }else{
                    alert('disabled')
                    //$('#add').attr("disabled",false);
                    $('#add').removeAttr("disabled");
                }
            });  
            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
                $('#add').removeAttr("disabled");
            });
        }); 
        function function_data(){
            //        alert("welcome");
            var last_data= $(".last_num:last").val();
            //                 alert(last_data);
            if(last_data == ''){
                //                        alert("yoyoyoyo");
                $('#add').attr("disabled",true);
            }else{
                //                         alert("hiiiiiyyy");
                $('#add').removeAttr("disabled");
            }
        }
    </script>
    <?php 
    }
    ?>
</div>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   
<script>
    $('#search_vendor').autocomplete({
        source: '<?=base_url()?>VoucherController/getVenodr',
        select: function (event, ui) {
            var name = ui.item.label
            $("#id_vendor").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_vendor").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            $( "#id_party" ).val( ui.item? ui.item.value : 0 );
        }
    });
</script>
<script>
    $(document).on("click","#btn_submit",function(e){
        e.preventDefault();
        var name = $('#name').val();
        var contact = $('#contact').val();
        var gstin = $('#gstin').val();
        var state = $('#state').val();
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>VoucherController/save_vendor',
            dataType : 'json',
            data: {
                name: name,
                contact: contact,
                gstin: gstin,
                state: state
            },
            beforeSend: function() {    
                isProcessing = true;
                //alert('Processing input: ');
            },
            success: function (data) {
                console.log(data.response)
                if(data.response == 'success')
                {
                    //alert(data.message)
                    var id = data.message;
                    $('#name_error').hide();
                    $('#contact_error').hide();
                    $('#gstin_error').hide();
                    $('#state_error').hide();
                    setTimeout(function() {
                        $('#mysModel').modal('hide');
                        window.location.href = "<?php echo base_url();?>VoucherController/voucher_page/"+id;
                    }, 5000);
                }
                else
                {
                    $('#name_error').show();
                    $('#name_error').html(data.message.name);
                    $('#contact_error').show();
                    $('#contact_error').html(data.message.contact);
                    $('#gstin_error').show();
                    $('#gstin_error').html(data.message.gstin);
                    $('#state_error').show();
                    $('#state_error').html(data.message.state);
                }
            },
            completed: function() {    
                isProcessing = false;
                //alert('Processing input: ');
            }/*,
            error: function() {
                alert('ajax call failed...');
            }*/
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