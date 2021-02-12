<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li class=""><a href="<?php echo site_url('GeneratVoucher');?>">Generate Voucher</a></li>
            <li class="active"><a >View Voucher</a></li>
        </ul>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12">
        <form method="post" name="form1">
            <div class="col-sm-12">
                <div class="col-sm-2 col-sm-offset-3"><b>Date From : </b>
                    <input type="text" name="frm_dt" id="frm_dt" value="<?php echo $frmdate;?>" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="col-sm-2"><b>Date To : </b>
                    <input type="text" name="to_dt" id="to_dt" value="<?php echo $todate;?>" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="col-sm-2"><br/>
                    <button class="btn btn-success btn-block" onclick="fetch()" name="select_date" type="button">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12">
        <div class="col-sm-12 table-responsive">
            <form method="POST" action="action.php" class="form-group-sm">&nbsp;
                <table class="table " id="example" width="100%">
                    <thead>
                        <tr class="danger">
                            <th>Sr.</th>
                            <th>Date</th>
                            <th>Voucher No</th>
                            <th>Vendor Name</th>
                            <th>Contact</th>
                            <th>Total Amount</th>
                            <th>Received Amount</th>
                            <th>Payment Receive</th>
                            <th>View</th>
                            <th>Print</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_data">
                        <?php
                        $n=0;
                        /*while($row=mysqli_fetch_assoc($rid))
                        {
                            $fetch_vendor = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from vendor_party where id='".$row['party_id']."'"));
                            $n++; 
                        ?>
                        <tr id="newposition">
                            <td><?php echo $n; ?></td>
                            <td><?php echo date("d-m-Y",strtotime($row['date'])); ?></td>
                            <td><?php echo $row['bill_no']; ?></td>
                            <td><?php echo ucwords($fetch_vendor['name']); ?></td>
                            <td><?php echo $fetch_vendor['contact_no']; ?></td>
                            <td><i class="fa fa-inr"><span> <?php echo $row['total']; ?></span></i></td>
                            <td><i class="fa fa-inr"><span> <?php if($row['received']!=''){ echo $row['received'];} else{ echo "0"; } ?></span></i></td>
                            <td>
                                <?php
                            $pending = $row['total']-$row['received'];
                            if($pending!=0)
                            {
                        ?>
                                <a href="payment_recv.php?id=<?php echo $row['id']; ?>" class="btn btn-default btn-sm" >Payment</a>
                                <?php } 
                            else{
                        ?>
                                <a class="btn btn-default btn-sm" disabled>Payment</a>
                                <?php
                            }
                        ?>
                            </td>
                            <td>
                                <a class="btn btn-success glyphicon glyphicon-list" data-toggle="modal" data-target="#details<?php echo $row['id']; ?>"></a>
                            </td>
                            <td>
                                <a href="print_voc_rec.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm glyphicon glyphicon-print" name="page" value="2" type="submit"></a>
                            </td>
                            <td>
                                <a href="?id=<?php echo $row['id']; ?>&delete=delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash" name="page" value="2" type="submit"></a>
                            </td>
                        </tr>
                        <?php
                        }*/
                        ?>

                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="modal fade" id="details" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b id="m_title"></b></h4>
                </div>

                <div class="modal-body">
                </div>
            </div>
        </div>
    </div> 
    <div class="modal fade" id="payment_modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="text-center;">Receive Payment</h4>
                </div>

                <div class="modal-body" style="padding:0px;" id="getCode">
                    <div class="col-md-12 col-md-offset-">&nbsp;
                        <form id="reg_form" method="post">
                            <table class="table table-striped">
                                <tr>
                                    <td><b>Total Amount</b>
                                        <input type="text" id="total_amt"  class="form-control total_amount" readonly>
                                        <input type="hidden" id="voucher_id"  name="id" class="form-control" >
                                    </td>
                                    <td><b>Pending Amount</b>
                                        <input type="text" name="pending" id="pending_amt" class="form-control total_amount" readonly >
                                    </td>
                                    <td><b>Receive Amount</b>
                                        <input type="number" class="form-control total_amount" id="receive"  name="receive_amt" placeholder="Enter Amount" required>
                                    </td>

                                </tr>
                            </table>

                            <div class="col-md-6 col-md-offset-3 "><b>Select method Payment :</b>
                                <select class="form-control" name="payment" id="payment_method" required>
                                    <option value="">Select</option>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="paytm">Paytm</option>
                                    <option value="cash_card">Cash / card</option>
                                    <!--<option value="neft-bank">NEFT-Bank</option>-->
                                </select>
                            </div>

                            <div class="col-md-6 col-md-offset-3 " style="display:none;" id="cash_div">
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <input type="checkbox" name="payment_type[]" value="cash" checked hidden="hidden">  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" ><b>Enter Cash Amount </b>
                                        <input type="number" min="0" id="cash1" class="form-control " name="payment_number11[]" placeholder="Enter Amount" value="<?php //echo round($total_amt) ;?>"  autofocus>   
                                        <input type="hidden"  class="form-control " name="payment_number1[]" value="0">
                                        <input type="hidden"  class="form-control" name="payment_number111[]" placeholder="Enter Amount" value="0">
                                        <input type="hidden"  class="form-control" name="payment_number1111[]" placeholder="Enter Amount" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-md-offset-3 " style="display:none;" id="card_div">
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <input type="checkbox" name="payment_type[]" value="card" checked hidden="hidden">  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" ><b>Enter Card Amount </b>
                                        <input type="number" min="0" id="card1" class="form-control" name="payment_number11[]" placeholder="Enter Amount" value="<?php //echo round($total_amt) ;?>"  autofocus>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >&nbsp; 
                                        <input type="text"  class="form-control" name="payment_number1[]"   placeholder="Enter Debit/Credit Number" >   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12" >&nbsp; 
                                        <input type="hidden"  class="form-control" name="payment_number111[]"   placeholder="Enter Amount">  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >  
                                        <input type="text"  class="form-control" name="payment_number1111[]" placeholder="Enter Bank Name">   
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-offset-3" style="display:none;" id="neft_div">
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <input type="checkbox" name="payment_type[]" value="neft" checked hidden="hidden">  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" ><b>Enter NEFT Amount </b>
                                        <input type="number" min="0" id="neft_amt" class="form-control" name="payment_number11[]" placeholder="Enter Amount" value="<?php //echo round($total_amt) ;?>"  autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >&nbsp; 
                                        <input type="hidden"  class="form-control" name="payment_number1[]"   placeholder="Enter Debit/Credit Number" >   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12" >&nbsp; 
                                        <input type="hidden"  class="form-control" name="payment_number111[]"   placeholder="Enter Amount">  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >  
                                        <input type="text"  class="form-control" name="payment_number1111[]" placeholder="Enter Bank Name">   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-md-offset-3 " style="display:none;" id="paytm_div">
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <input type="checkbox" name="payment_type[]" value="paytm" checked hidden="hidden">  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" ><b>Enter Paytm Amount </b>
                                        <input type="number" min="0" id="paytm1" class="form-control" name="payment_number11[]" placeholder="Enter Amount" value="<?php //echo round($total_amt) ;?>"  autofocus>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >&nbsp; 
                                        <input type="text"  class="form-control" name="payment_number1[]"   placeholder="Enter Paytm Number" >   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12" >&nbsp; 
                                        <input type="hidden"  class="form-control" name="payment_number111[]"   placeholder="Enter Amount">  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >  
                                        <input type="hidden"  class="form-control" name="payment_number1111[]" placeholder="Enter Bank Name">   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10 col-md-offset-1 " style="display:none;" id="cash_card_div">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <div class="col-sm-12" >
                                            <input type="checkbox" name="payment_type[]" value="cash" checked hidden="hidden">  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" ><b>Enter Cash Amount </b>
                                            <input type="number" min="0" class="form-control" name="payment_number11[]" placeholder="Enter Amount" value="0" autofocus> 
                                            <input type="hidden"  class="form-control " name="payment_number1[]" value="0">
                                            <input type="hidden"  class="form-control" name="payment_number111[]" placeholder="Enter Amount" value="0">
                                            <input type="hidden"  class="form-control" name="payment_number1111[]" placeholder="Enter Amount" value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <div class="col-sm-12" >
                                            <input type="checkbox" name="payment_type[]" value="card" checked hidden="hidden">  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" ><b>Enter Card Amount </b>
                                            <input type="number" min="0"  class="form-control" name="payment_number11[]" placeholder="Enter Amount" value="0" autofocus>   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" >&nbsp; 
                                            <input type="text"  class="form-control" name="payment_number1[]"   placeholder="Enter Debit/Credit Number" >   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12" >&nbsp; 
                                            <input type="hidden"  class="form-control" name="payment_number111[]"   placeholder="Enter Amount">  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" >  
                                            <input type="text"  class="form-control" name="payment_number1111[]" placeholder="Enter Bank Name">   
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <script>
                                $(document).ready(function () {
                                    $('#payment_method').change(function () {
                                        var payment =$('#payment_method').val();
                                        var receive =$('#receive').val();
                                        //alert(receive);
                                        if(payment=='cash'){
                                            document.getElementById('cash_div').style.display = 'block';
                                            document.getElementById('card_div').style.display = 'none';
                                            document.getElementById('paytm_div').style.display = 'none';
                                            document.getElementById('cash_card_div').style.display = 'none';
                                            document.getElementById('neft_div').style.display = 'none';
                                            document.getElementById('card1').value = 0;
                                            document.getElementById('paytm1').value = 0;
                                            document.getElementById('neft_amt').value = 0;
                                            document.getElementById('cash1').value = receive;
                                        }else if(payment=='card'){
                                            document.getElementById('cash_div').style.display = 'none';
                                            document.getElementById('cash_card_div').style.display = 'none';
                                            document.getElementById('paytm_div').style.display = 'none';
                                            document.getElementById('neft_div').style.display = 'none';
                                            document.getElementById('card_div').style.display = 'block';
                                            document.getElementById('cash1').value = 0;
                                            document.getElementById('paytm1').value = 0;
                                            document.getElementById('neft_amt').value = 0;
                                            document.getElementById('card1').value = receive;
                                        }else if(payment=='paytm'){
                                            document.getElementById('cash_div').style.display = 'none';
                                            document.getElementById('cash_card_div').style.display = 'none';
                                            document.getElementById('card_div').style.display = 'none';
                                            document.getElementById('neft_div').style.display = 'none';
                                            document.getElementById('paytm_div').style.display = 'block';
                                            document.getElementById('cash1').value = 0;
                                            document.getElementById('card1').value = 0;
                                            document.getElementById('neft_amt').value = 0;
                                            document.getElementById('paytm1').value = receive;
                                        }else if(payment=='cash_card'){
                                            document.getElementById('cash_div').style.display = 'none';
                                            document.getElementById('card_div').style.display = 'none';
                                            document.getElementById('paytm_div').style.display = 'none';
                                            document.getElementById('neft_div').style.display = 'none';
                                            document.getElementById('cash_card_div').style.display = 'block';
                                            document.getElementById('cash1').value = 0;
                                            document.getElementById('card1').value = 0;
                                            document.getElementById('paytm1').value = 0;
                                            document.getElementById('neft_amt').value = 0;
                                        }else if(payment=='neft-bank'){
                                            document.getElementById('cash_div').style.display = 'none';
                                            document.getElementById('card_div').style.display = 'none';
                                            document.getElementById('paytm_div').style.display = 'none';
                                            document.getElementById('cash_card_div').style.display = 'none';
                                            document.getElementById('neft_div').style.display = 'block';
                                            document.getElementById('cash1').value = 0;
                                            document.getElementById('card1').value = 0;
                                            document.getElementById('paytm1').value = 0;
                                            document.getElementById('neft_amt').value = receive;
                                        }
                                    });
                                });
                            </script>

                            <div class="col-md-6 col-md-offset-3">&nbsp;
                                <button class=" btn btn-success btn-block" type="button" id="receive_amount" >Paid</button>
                            </div>
                            <div class="col-md-6 col-md-offset-3">&nbsp;
                                <a class=" btn btn-danger btn-block" class="close" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>

                    </div> 

                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>

</div>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   

<script>

    $(function(){
        fetch()
    });

    function fetch()
    {
        var FromDt = $('#frm_dt').val();
        var ToDt = $('#to_dt').val();
        $.ajax({
            type : 'Post',
            url : '<?php echo base_url();?>VoucherController/fetch_vouchers',
            dataType : 'json',
            data : {
                frm_dt : FromDt,
                to_dt : ToDt
            },
            success: function(response){
                //console.log(response)
                var str = '';
                sr_no = 1;
                response.message.forEach((element, index) => {
                    //console.log(element)

                    var pend = element.total - element.received;
                    var rece = 0;
                    if(element.received != '' & element.received != 0)
                    {
                        rece = element.received;
                    }
                    str +='<tr>';
                    str +='<td>'+(index+1)+'</td>';
                    str +='<td>'+element.date+'</td>';
                    str +='<td>'+element.bill_no+'</td>';
                    str +='<td>'+element.vendor_name+'</td>';
                    str +='<td>'+element.cont_no+'</td>';
                    str +='<td><i class="fa fa-inr"> '+element.total+'</td>';
                    str +='<td><i class="fa fa-inr"> '+rece+'</td>';
                    str +='<td>';
                    if(pend != 0)
                    {
                        str +='<a data="'+element.id+'" class="btn btn-default btn-sm payment" >Payment</a>';
                    }
                    else
                    {
                        str +='<a class="btn btn-default btn-sm" disabled>Payment</a>';
                    }
                    str +='</td>';
                    str +='<td><a class="btn btn-success glyphicon glyphicon-list details" data ='+element.id+'></a></td>';
                    str +='<td><a target="_blank" href="<?php echo site_url('VoucherController/print_receipt/');?>'+element.id+'" class="btn btn-info btn-sm glyphicon glyphicon-print" name="page" value="2" type="submit"></a></td>';
                    str +='<td><a onclick="func_delete('+element.id+')" class="btn btn-danger btn-sm glyphicon glyphicon-trash" name="page" value="2" type="submit"></a></td>';
                    str +='</tr>';
                    sr_no++
                });
                //document.getElementById("tbody_data").innerHTML = str;
                //data-toggle="modal" data-target="#details"
                $('#tbody_data').html(str);
            }
        });
    }

    function func_delete(id) {
        var answer = confirm ("Are you sure you want to delete this voucher?");
        if (answer)
        {
            var DeletId = id;
            $.ajax({
                type : 'Post',
                url : '<?php echo base_url();?>VoucherController/delete_voucher',
                dataType : 'json',
                data : {
                    voucherId : DeletId
                },
                success : function (response){
                    //console.log(response)
                    if(response.response == 'success')
                    {
                        fetch()
                        $('#div_success').show();
                        $('#success').html(response.message);
                    }
                    else
                    {
                        $('#div_error').show();
                        $('#error').html(response.message);
                    }
                }
            });
        } 
    } 

    $(document).on('click','#receive_amount', function(e){
        e.preventDefault();
        var formValues = $("#reg_form").serialize();
        //console.log(formValues)

        $.ajax({
            type : 'post',
            url : '<?php echo site_url();?>VoucherController/payments',
            dataType :'json',
            data : {
                form_inputs : formValues
            },
            success : function(response){
                console.log(response)
                if(response.response == 'success')
                {
                    fetch()
                    $('#div_success').show();
                    $('#success').html(response.message);
                }
                else
                {
                    $('#div_error').show();
                    $('#error').html(response.message);
                }
                $('#payment_modal').modal('hide');
                $('#reg_form').trigger('reset');
                //$('#reg_form')[0].reset();
            }
        });
    });

    $(document).on('click','.payment', function(event){
        event.preventDefault();
        var ID = $(this).attr('data');
        $('#payment_modal').modal('show');
        $.ajax({
            type : 'post',
            url : '<?php echo base_url();?>VoucherController/fetch_details',
            dataType : 'json',
            data : {
                id : ID
            },
            success : function(data){
                if(data.response == 'success')
                {
                    $('.total_amount').val(data.message.total);
                    $('#voucher_id').val(ID);
                }
            }
        });
    });

    $(document).on('click','.details', function(event){
        event.preventDefault();
        var ID = $(this).attr('data');
        $('#details').modal('show');
        $.ajax({
            type : 'post',
            url : '<?php echo base_url();?>VoucherController/fevhe_details',
            dataType : 'json',
            data : {
                id : ID
            },
            success : function(data){
                //                console.log(data.message)
                if(data.response == 'success')
                {
                    $('#m_title').html(data.message.vendor_name);

                    var GSTIN = data.message.gstin;

                    var Itmes = data.message.items;

                    var str = '';

                    var SrNo = 0;

                    var Total = 0;

                    str +='<table class="table table-bordered">';
                    str +='<tr>';
                    str +='<td width="20px"><b>Sr.</b></td>';
                    str +='<td><b>Item Name</b></td>';
                    str +='<td><b>Quantity</b></td>';
                    str +='<td><b>Rate</b></td>';
                    if(GSTIN != ''){
                        str +='<td><b>HSN </b> </td>';
                        str +='<td><b>GST</b> </td>';
                    }
                    str +='<td><b>Total</b></td>';
                    str +='</tr>';
                    Itmes.forEach((element, Index) => {
                        //console.log.Element;
                        SrNo = Index+1;
                        Total = Total + parseInt(element.total_amt);
                        str +='<tr>';
                        str +='<td width="20px"><b>'+SrNo+'</b></td>';
                        str +='<td><b>'+element.product+'</b></td>';
                        str +='<td><b>'+element.qty+'</b></td>';
                        str +='<td><b>'+element.rate+'</b></td>';
                        if(GSTIN != ''){
                            str +='<td><b>'+element.hsn+'</b> </td>';
                            str +='<td><b>'+element.gst+'</b> </td>';
                        }
                        str +='<td><b>'+element.total_amt+'</b></td>';
                        str +='</tr>';
                    });
                    str +='<tr>';
                    if(GSTIN != ''){
                        str +='<td colspan="6" class="text-right"><b>Total</b></td>';
                    } else {
                        str +='<td colspan="4" class="text-right"><b>Total</b></td>';
                    }
                    str +='<td><b><i class="fa fa-inr"> <span>'+Total+'</span></i></b></td>';
                    str +='</tr>';

                    $('.modal-body').html(str);
                }
                else
                {
                    alert('data fetch to problem');
                }
            }
        });
    })

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
                //console.log(data.response)
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
<script> 
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            // buttons: [ 'copy', 'excel', 'pdf', 'csvHtml5','print' ]
            buttons: [
                {
                    extend: 'excel',footer: true,className: 'btn-primary', 
                    exportOptions: {         
                        columns: ':visible'         
                    }
                },
                {
                    extend: 'pdfHtml5',footer: true,className: 'btn-primary',
                    customize: function (doc) { doc.defaultStyle.alignment = 'center'; doc.styles.tableFooter.alignment = 'center'; },
                    exportOptions: {         
                        columns: ':visible'         
                    }
                },
                {
                    extend: 'print',footer: true,className: 'btn-primary',
                    exportOptions: {         
                        columns: ':visible'         
                    }
                    //							customize: function ( win ) {
                    //							$(win.document.body).find( 'table' ).addClass( 'display' ).css( 'text-align', 'right' );
                    //							}
                },
            ],
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script> 