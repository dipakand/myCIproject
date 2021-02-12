<?php
$sale_row;
//print_r($party_row->name);
$total_amt = 0;
$pending = 0;
if((Int)$sale_row->cod_amt > 0 )
{
    $total_amt = (Int)$sale_row->cod_amt - (Int)$sale_row->return_amt;
    $pending = (Int)$sale_row->cod_amt - (Int)$sale_row->receive_amt - (Int)$sale_row->credit_amt - (Int)$sale_row->return_amt;
    $flag = 1;
}
else
{
    $total_amt = (Int)$sale_row->total_amt - (Int)$sale_row->return_amt;
    $pending = (Int)$sale_row->total_amt - (Int)$sale_row->receive_amt - (Int)$sale_row->credit_amt - (Int)$sale_row->return_amt;
    $flag = 0;
}
$total_amt;
$pending;
?>
<script src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

<div class="row">
    <div class="col-sm-12">
        <form method="post" >
            <table class="table table-striped">
                <tr>
                    <td><b>Total Amount</b>
                        <input type="text" value="<?php echo  $total_amt  ;?>" class="form-control" readonly>
                    </td>
                    <td><b>Pending Amount</b>
                        <input type="text" name="pending" value="<?php echo $pending-$sale_row->credit_amt;?>" class="form-control" readonly >
                    </td>
                    <td><b>Receive Amount</b>
                        <input type="number" min="0" value="<?php echo $pending-$sale_row->credit_amt;?>" id="receive_amt" class="form-control" name="receive_amt" placeholder="Enter Amount" required <?php echo $flag==1 ? 'readonly' : '';?> >
                    </td>
                </tr>
            </table>
            <div class="col-sm-4 col-sm-offset-4">
                <div class="col-sm-12  "><b>Select method Payment :</b>
                    <select class="form-control" name="payment" id="payment_method" required>
                        <option value="">Select</option>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <!--<option value="paytm">Paytm</option>-->
                        <option value="cheque">Cheque</option>
                        <option value="cash_card">Cash / card</option>
                    </select>
                </div>
            </div>
            <div class=" col-sm-4 col-sm-offset-4">
                <div class="col-sm-12  " style="display:none;" id="cash_div">
                    <div class="form-group">
                        <div class="col-sm-12" >
                            <input type="checkbox" name="payment_type[]" value="cash" checked hidden="hidden">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" ><b>Enter Cash Amount </b>
                            <input type="number" min="0"  class="form-control" name="payment_number11[]" placeholder="Enter Amount" id="cash1" value="" autofocus>   
                            <input type="hidden"  class="form-control " name="payment_number1[]" value="0">
                            <input type="hidden"  class="form-control" name="payment_number111[]" placeholder="Enter Amount" value="0">
                            <input type="hidden"  class="form-control" name="payment_number1111[]" placeholder="Enter Amount" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-sm-4 col-sm-offset-4">
                <div class="col-sm-12  " style="display:none;" id="card_div">
                    <div class="form-group">
                        <div class="col-sm-12" >
                            <input type="checkbox" name="payment_type[]" value="card" checked hidden="hidden">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" ><b>Enter Card Amount </b>
                            <input type="number" min="0" id="card1" class="form-control" name="payment_number11[]" placeholder="Enter Amount"  value="<?php echo round($total_amt) ;?>" autofocus>   
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
            <div class=" col-sm-4 col-sm-offset-4">
                <div class="col-sm-12  " style="display:none;" id="cheque_div">
                    <div class="form-group">
                        <div class="col-sm-12" >
                            <input type="checkbox" name="payment_type[]" value="cheque" checked hidden="hidden">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" ><b>Enter Cheque Amount </b>
                            <input type="number" id="cheque1" min="0"  value="<?php echo round($total_amt) ;?>"  class="form-control" name="payment_number11[]" placeholder="Enter Amount"  autofocus>   
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" >&nbsp; 
                            <input type="text"  class="form-control" name="payment_number1[]" id="cheq" placeholder="Enter cheque Number" >   
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" >&nbsp; 
                            <input type="text"  class="form-control datepicker" name="payment_number111[]" id="cheamt" placeholder="Enter Date">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" >&nbsp; 
                            <input type="text"  class="form-control datepicker" name="drawer_name" id="drawer" placeholder="Enter Date" value="<?php echo $party_row->name;?>">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" > &nbsp; 
                            <input type="text"  class="form-control" name="payment_number1111[]" placeholder="Enter Bank Name">   
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-sm-4 col-sm-offset-4">
                <div class="col-sm-12 " style="display:none;" id="cash_card_div">
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
            </div>
            <div class=" col-sm-4 col-sm-offset-4">
                <div class="col-sm-12">&nbsp;
                    <button class=" btn btn-success btn-block" type="submit" name="paid">Paid</button>
                </div>
            </div>
            <div class=" col-sm-4 col-sm-offset-4">
                <div class="col-sm-12">&nbsp;
                    <a class=" btn btn-default btn-block" href="<?php echo site_url('AllSales');?>" >Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<script>
    $(document).ready(function () {
        $('#payment_method').change(function () {
            var payment =$('#payment_method').val();
            var receive_amt = $('#receive_amt').val();
            //            alert(payment);
            if(payment=='cash'){
                document.getElementById('cash_div').style.display = 'block';
                document.getElementById('card_div').style.display = 'none';
                //				 document.getElementById('paytm_div').style.display = 'none';
                document.getElementById('cheque_div').style.display = 'none';
                document.getElementById('cash_card_div').style.display = 'none';
                document.getElementById('cash1').value = receive_amt;
                document.getElementById('card1').value = 0;
                //                 document.getElementById('paytm1').value = 0;
                document.getElementById('cheque1').value = 0;
            }else if(payment=='card'){
                document.getElementById('cash_div').style.display = 'none';
                document.getElementById('cash_card_div').style.display = 'none';
                document.getElementById('cheque_div').style.display = 'none';
                //				 document.getElementById('paytm_div').style.display = 'none';
                document.getElementById('card_div').style.display = 'block';
                document.getElementById('card1').value = receive_amt;
                document.getElementById('cash1').value = 0;
                //                 document.getElementById('paytm1').value = 0;
                document.getElementById('cheque1').value = 0;
                //			}else if(payment=='paytm'){
                //                  document.getElementById('cash_div').style.display = 'none';
                //                 document.getElementById('card_div').style.display = 'none';
                //				 document.getElementById('paytm_div').style.display = 'block';
                //                 document.getElementById('cheque_div').style.display = 'none';
                //                 document.getElementById('cash_card_div').style.display = 'none';
                //                 document.getElementById('paytm1').value = receive_amt;
                //                 document.getElementById('card1').value = 0;
                //				 document.getElementById('cash1').value = 0;
                //                 document.getElementById('cheque1').value = 0;
            }else if(payment=='cheque'){
                document.getElementById('cash_div').style.display = 'none';
                document.getElementById('cash_card_div').style.display = 'none';
                document.getElementById('card_div').style.display = 'none';
                //				 document.getElementById('paytm_div').style.display = 'none';
                document.getElementById('cheque_div').style.display = 'block';
                $("#cheqmt").attr('required', true);
                $("#cheq").attr('required', true);
                $("#cheamt").attr('required', true);
                document.getElementById('cheque1').value = receive_amt;
                document.getElementById('cash1').value = 0;
                document.getElementById('card1').value = 0;
                //                document.getElementById('paytm1').value = 0;
            }else if(payment=='cash_card'){
                document.getElementById('cash_div').style.display = 'none';
                document.getElementById('card_div').style.display = 'none';
                document.getElementById('cheque_div').style.display = 'none';
                //				 document.getElementById('paytm_div').style.display = 'none';
                document.getElementById('cash_card_div').style.display = 'block';
                document.getElementById('cash1').value = 0;
                document.getElementById('card1').value = 0;
                //                 document.getElementById('paytm1').value = 0;
                document.getElementById('cheque1').value = 0;
            }
        });
    }); 
</script>
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-50:+10",
        });
    });
</script>
