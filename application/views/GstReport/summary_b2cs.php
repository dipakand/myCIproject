<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('GstReport/tabs');?>
    </div>
    <div class="col-md-12">&nbsp;
        <form method="post" name="form1">
            <div class="col-md-6 col-md-offset-3">
                <div class="col-md-4 ">
                    <div class="form-group"><b>Enter Date From :</b>
                        <input type="text" name="from_date" autocomplete=off class="form-control datepicker" required value="<?php //echo date('d-m-Y', strtotime($frmdate));?>" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><b>To :</b>
                        <input type="text" name="to_date" autocomplete=off class="form-control datepicker" required value="<?php //echo date('d-m-Y', strtotime($todate));?>" >
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-"><br/>
                    <button type="submit" name="submit" class="btn btn-success btn-block">Search</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    if(isset($frmdate) && isset($todate))
    {
    ?>
    <div class="col-md-8 col-sm-offset-2">
        &nbsp;
        <form>
            <!--                            <a href="import_excel_b2cs.php?frm=<?php echo $_POST['from_date'];?>&&todate=<?php echo $_POST['to_date'];?>" class="btn btn-primary pull-right">Export Excel</a>-->
            <div class="col-md-12 table-responsive">
                &nbsp;
                <table class="table table-bordered text-center table-responsive" id="example" width="100%">
                    <thead>
                        <tr>
                            <td><b>Sr. No.</b></td>
                            <td><b>Type</b></td>
                            <td><b>Place of Supply</b></td>
                            <td><b>Aplicable % of Tax Rate</b></td>
                            <!--<td><b>Invoice No</b></td>-->
                            <td><b>Rate %</b></td>
                            <td><b>Taxable</b></td>
                            <td><b>Cess Amount</b></td>
                            <td><b>E-Commerce GSTIN</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
        $sr=0;
        foreach($sales as $sale)
        { 

            //            $party="select * from manage_party where id='".$sale->party_id']."' AND LENGTH(gst_in) < 10";

            $this->db->select('manage_party.*, state.state_name');
            //$where = "manage_party.id='".$sale->party_id."' and LENGTH(manage_party.gst_in) < 10";
            //$this->db->where($where);
            $this->db->where('manage_party.id', $sale->party_id);
            //            $this->db->where('LENGTH(manage_party.gst_in) > 10');
            $this->db->join('state','manage_party.state_id = state.state_id');
            $query1 = $this->db->get('manage_party');
            $fetchparty = $query1->row();

            $str= strlen($fetchparty->gst_in);
            //$fetchnum=mysqli_num_rows($partyquery);
                $retu_combine = array();

            if($str == '' || $str < 10)
            {
                if($sale->return_item != '')
                {
                    $return=unserialize($sale->return_item);
                    if(count($return) > 0)
                    {
                        foreach($return as $retu => $trn)
                        { 
                            if($company_row->company_state == $fetchparty->state_id)
                            {
                                $tax_rat[]=$trn[6]; 
                                $per_i[]=$trn[9];
                            }
                            else
                            {
                                $tax_rat[]=$trn[6]; 
                                $per_i[]=$trn[8];
                            }
                        }
                        $retu_array  = $this->CommenModel->array_combine_1($per_i, $tax_rat);
                        unset($tax_rat);
                        unset($per_i);
                        $s=1;
                        $add=0;
                        $add1=0;
                        foreach($retu_array as $retu_key => $retu_val)
                        {
                            $add = array_sum($retu_val);
                            if($add == '')
                            {
                                $add1 = $retu_val; 
                            }
                            else
                            {
                                $add1 =$add; 
                            }
                            $retu_combine[$s]['gst']=$retu_key;
                            $retu_combine[$s]['tax']=$add1;
                            $s++;
                        }
                        unset($retu_array);

                    }
                }
                $tax_det=unserialize($sale->tax_detail);
                foreach($tax_det as $ke => $va)
                { 
                    $tax[]=$va['tax'];
                    $gst[]=$va['gst']; 
                } 
                $array3  = $this->CommenModel->array_combine_1( $gst,$tax ); 
                $n2=1;
                $sum=0;
                $sum1=0;
                foreach($array3 as $key21=>$val21)
                {  
                    $sum = array_sum($val21);   
                    if($sum=='')
                    {
                        $sum1 = $val21; 
                    }else
                    {  
                        $sum1 = $sum;
                    }       
                    $item1[$n2]['gst'] = $key21;
                    $item1[$n2]['tax'] = $sum1;                                            
                    $n2++;   
                }
                foreach($item1 as $key1 => $val1)
                {  
                    $gsti2=0;$gsti3=0;$gsti4=0;
                    if($val1['gst'] == '5' )
                    {    
                        $gsti1=0;
                        $tax_amt1=0;$perecent1=0;
                        $taxable1 = 0;
                        foreach ($retu_combine as $retu_key1 => $retu_val1 )
                        {
                            if($val1['gst'] == $retu_val1['gst'])
                            { 
                                $taxable1=$retu_val1['tax'];  
                            }                                                        
                        }
                        $igst1 = ($val1['tax']*$val1['gst'])/100; 
                        $tax_amt1 =$val1['tax']-$taxable1;  
                        $perecent1 =  $tax_amt1*((Int)$sale->cod_percent/100);
                        if($sale->pay_type != 'cod')
                        {
                            $perecent1=0;
                        }
                        $gsti1 = $tax_amt1-$perecent1; 
                        unset($retu_combine);
                        if($gsti1 > 0)
                        {
                            $sr++;
                        ?>
                        <tr>
                            <td><?php echo $sr;?></td>
                            <td><?php echo 'OE';?></td>
                            <td><?php echo ucwords($fetchparty->city);?></td>
                            <!--<td><?php echo $sale->id; ?></td>-->
                            <td></td>
                            <td><?php echo $val1['gst'];?></td>
                            <td class="text-right"><?php echo round($gsti1,2);?></td>
                            <td class="text-right">0.00</td>
                            <td><?php ?></td>
                        </tr>
                        <?php
                        }
                    }
                    if($val1['gst'] == '12')
                    {      
                        $tax_amt2=0;$perecent2=0;
                        $taxable2=0;
                        foreach ($retu_combine as $retu_key2 => $retu_val2 )
                        {
                            if($val1['gst'] == $retu_val2['gst'])
                            { 
                                $taxable2=$retu_val2['tax'];  
                            }                                                        
                        }
                        $igst2 = ($val1['tax']*$val1['gst'])/100;
                        $tax_amt2 =$val1['tax'] - $taxable2; 
                        $perecent2 =  $tax_amt2*((Int)$sale->cod_percent/100);
                        if($sale->pay_type != 'cod')
                        {
                            $perecent2=0;
                        }
                        $gsti2 = $tax_amt2-$perecent2; 
                        if($gsti2 > 0){
                            $sr++;
                        ?>
                        <tr>
                            <td><?php echo $sr;?></td>
                            <td><?php echo 'OE';?></td>
                            <td><?php echo ucwords($fetchparty->city);?></td>
                            <!--<td><?php echo $sale->id; ?></td>-->
                            <td></td>
                            <td><?php echo $val1['gst'];?></td>
                            <td class="text-right"><?php echo round($gsti2,2);?></td>
                            <td class="text-right">0.00</td>
                            <td><?php ?></td>
                        </tr>
                        <?php
                        }
                    }
                    if($val1['gst'] == '18')
                    {
                        $tax_amt3=0; $perecent3=0;
                        $taxable3=0;
                        foreach ($retu_combine as $retu_key3 => $retu_val3 )
                        {
                            if($val1['gst'] == $retu_val3['gst'])
                            { 
                                $taxable3=$retu_val3['tax']; 
                            }                                                        
                        }
                        $igst3 = ($val1['tax']*$val1['gst'])/100;
                        $tax_amt3 =$val1['tax'] - $taxable3; 
                        $perecent3 =  $tax_amt3*((Int)$sale->cod_percent/100);
                        if($sale->pay_type != 'cod')
                        {
                            $perecent3=0;
                        }
                        $gsti3 = $tax_amt3-$perecent3; 
                        if($gsti3 > 0){
                            $sr++;
                        ?>
                        <tr>
                            <td><?php echo $sr;?></td>
                            <td><?php echo 'OE';?></td>
                            <td><?php echo ucwords($fetchparty->city);?></td>
                            <!--<td><?php echo $sale->id; ?></td>-->
                            <td></td>
                            <td><?php echo $val1['gst'];?></td>
                            <td class="text-right"><?php echo round($gsti3,2);?></td>
                            <td class="text-right">0.00</td>
                            <td><?php ?></td>
                        </tr>
                        <?php
                        }
                    }
                    if($val1['gst'] == '28')
                    { 
                        $tax_amt4=0;$perecent4=0;
                        $taxable4=0;
                        foreach ($retu_combine as $retu_key4 => $retu_val4 )
                        {
                            if($val1['gst'] == $retu_val4['gst'])
                            { 
                                $taxable4=$retu_val4['tax']; 
                            }                                                        
                        }
                        $igst4 = ($val1['tax']*$val1['gst'])/100;
                        $tax_amt4 =$val1['tax'] - $taxable4; 
                        $perecent4 =  $tax_amt4*((Int)$sale->cod_percent/100);
                        if($sale->pay_type != 'cod')
                        {
                            $perecent4=0;
                        }
                        $gsti4 =$tax_amt4-$perecent4; 
                        if($gsti4 > 0){
                            $sr++;
                        ?>
                        <tr>
                            <td><?php echo $sr;?></td>
                            <td><?php echo 'OE';?></td>
                            <td><?php echo ucwords($fetchparty->city);?></td>
                            <!--<td><?php echo $sale->id; ?></td>-->
                            <td></td>
                            <td><?php echo $val1['gst'];?></td>
                            <td class="text-right"><?php echo round($gsti4,2);?></td>
                            <td class="text-right">0.00</td>
                            <td><?php ?></td>
                        </tr>
                        <?php
                        }
                    }
                }
                        ?>
                        <?php
                unset($tax_rat);
                unset($per_i);
                unset($tax);
                unset($gst);
                unset($item1);
            }
        } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php
    }
    ?>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div> 
<script> 
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [
                {
                    extend: 'excel',className: 'btn-primary',
                    exportOptions: {
                    },
                },
                {
                    extend: 'pdf',className: 'btn-primary',orientation:'landscape',pageSize:'LEGAL',
                    exportOptions: {
                    },
                },
                {
                    extend: 'print',className: 'btn-primary',
                    exportOptions: {
                    }
                },
            ],
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
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