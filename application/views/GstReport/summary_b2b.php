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
    <div class="col-md-12 table-responsive">&nbsp;
        <table class="table table-bordered text-center table-responsive" id="example" width="100%">
            <thead>
                <tr>
                    <td><b>Sr. No.</b></td>
                    <td><b>GSTIN/UNI of Recipients</b></td>
                    <td><b>Reciever Name</b></td>
                    <td><b>Invoice No</b></td>
                    <td><b>&nbsp;&nbsp;&nbsp;Invoice Date&nbsp;&nbsp;&nbsp;</b></td>
                    <td><b>Invoice Value</b></td>
                    <td><b>Place of Supply</b></td>
                    <td><b>Reverse Charge</b></td>
                    <td><b>Aplicable % of Tax Rate</b></td>
                    <td><b>Invoice Type</b></td>
                    <td><b>E-Commerce GST IN</b></td>
                    <td><b>Rate</b></td>
                    <td><b>Taxable Value</b></td>
                    <td><b>Cess Amount</b></td>
                    <!--<td><b>Party Code</b></td>-->
                </tr>
            </thead>
            <tbody>
                <?php 
        $sr=0;
        //        $select="select * from sales where  date between '".$_POST['from_date']."' and '".$_POST['to_date']."' and cancel_status=''";
        //        $query=mysqli_query($conn,$select);
        //        while($fetch=mysqli_fetch_assoc($query))
        foreach($sales as $sale)
        { 
            //print_r($sale); echo nl2br("\n");
            //            $party="select * from manage_party where id='".$sale->party_id."' and LENGTH(gst_in) > 10";
            //            $partyquery=mysqli_query($conn, $party);
            //            $fetchparty=mysqli_fetch_assoc($partyquery);
            //            $fetchnum=mysqli_num_rows($partyquery);

            $this->db->select('manage_party.*, state.state_name');
            //$where = "manage_party.id='".$sale->party_id."' and LENGTH(manage_party.gst_in) > 10";
            //$this->db->where($where);
            $this->db->where('manage_party.id', $sale->party_id);
            //            $this->db->where('LENGTH(manage_party.gst_in) > 10');
            $this->db->join('state','manage_party.state_id = state.state_id');
            $query1 = $this->db->get('manage_party');
            $fetchparty = $query1->row();

            //print_r($fetchparty->gst_in); echo nl2br("\n");echo nl2br("\n");

            //            $sel="SELECT * FROM state where state_id='".$fetchparty['state_id']."'";
            //            $sts = mysqli_query($conn,$sel);
            //            $row = mysqli_fetch_assoc($sts);

            $str= strlen($fetchparty->gst_in);
            if($str != '' || $str > 10)
                //            if($fetchnum != 0)
            {
                $retu_combine = array();
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

                        $s=1;
                        foreach($retu_array as $retu_key => $retu_val)
                        {
                            $add=0;
                            $add1=0;
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

                    }
                }

                $tax_det=unserialize($sale->tax_detail);
                $tax = array();
                $gst = array();
                foreach($tax_det as $ke => $va)
                { 
                    $tax[]=$va['tax'];
                    $gst[]=$va['gst']; 
                } 
                $array3  = $this->CommenModel->array_combine_1( $gst,$tax ); 
                $n2=1;
                foreach($array3 as $key21=>$val21)
                {  
                    $sum=0;
                    $sum1=0;
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
                $gsti1=0;$gsti2=0;$gsti3=0;$gsti4=0;

                foreach($item1 as $key1 => $val1)
                {  
                    if($val1['gst'] == '5' )
                    {                 
                        $taxable1 =0;
                        foreach ($retu_combine as $retu_key1 => $retu_val1 )
                        {
                            if($val1['gst'] == $retu_val1['gst'])
                            { 
                                $taxable1=$retu_val1['tax'];  
                            }                                                        
                        }
                        //$a++;
                        $igst1 = ($val1['tax']*$val1['gst'])/100; 
                        $val1['tax']; 
                        $tax_amt1 =$val1['tax'] - $taxable1;  
                        $perecent1 =  $tax_amt1*((Int)$sale->cod_percent/100);
                        if((Int)$sale->pay_type != 'cod')
                        {
                            $perecent1=0;
                        }
                        $gsti1 = $tax_amt1-$perecent1; 
                        $sr++;
                ?>
                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $fetchparty->gst_in;?></td>
                    <td><?php echo strtoupper($fetchparty->name);?></td>
                    <td><?php echo $sale->id;?></td>
                    <td><?php echo date("d-M-Y",strtotime($sale->date));?></td>
                    <td class="text-right"><?php echo round($sale->total_amt,2);?></td>
                    <td><?php echo $fetchparty->state_name; ?></td>
                    <td><?php echo "N";?></td>
                    <td><?php ?></td>
                    <td><?php echo 'Regular';?></td>
                    <td><?php  ?></td>
                    <td class="text-right"><?php echo round($val1['gst'],2);?></td>
                    <td class="text-right"><?php echo round($gsti1,2);?></td>
                    <td class="text-right">0.00</td>
                    <!--<td><?php echo $fetchparty->id;?></td>-->
                </tr>
                <?php
                    }
                    if($val1['gst'] == '12')
                    {      
                        $taxable2 =0;
                        foreach ($retu_combine as $retu_key2 => $retu_val2 )
                        {
                            if($val1['gst'] == $retu_val2['gst'])
                            { 
                                $taxable2=$retu_val2['tax'];  
                            }                                                        
                        }
                        //$b++;
                        $igst2 = ($val1['tax']*$val1['gst'])/100;
                        $tax_amt2 =$val1['tax'] - $taxable2; 
                        $perecent2 =  $tax_amt2*((Int)$sale->cod_percent/100);
                        if((Int)$sale->pay_type != 'cod')
                        {
                            $perecent2=0;
                        }
                        $gsti2 = $tax_amt2-$perecent2; 
                        $sr++;
                ?>
                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $fetchparty->gst_in;?></td>
                    <td><?php echo strtoupper($fetchparty->name);?></td>
                    <td><?php echo $sale->id;?></td>
                    <td><?php echo date("d-M-Y",strtotime($sale->date));?></td>
                    <td class="text-right"><?php echo round($sale->total_amt,2);?></td>
                    <td><?php echo $fetchparty->state_name; ?></td>
                    <td><?php echo "N";?></td>
                    <td><?php ?></td>
                    <td><?php echo 'Regular';?></td>
                    <td><?php ?></td>
                    <td class="text-right"><?php echo round($val1['gst'],2);?></td>
                    <td class="text-right"><?php echo round($gsti2,2);?></td>
                    <td class="text-right">0.00</td>
                    <!--<td><?php echo $fetchparty->id;?></td>-->
                </tr>
                <?php
                    }
                    if($val1['gst'] == '18')
                    {
                        $taxable3 =0;
                        foreach ($retu_combine as $retu_key3 => $retu_val3 )
                        {
                            if($val1['gst'] == $retu_val3['gst'])
                            { 
                                $taxable3=$retu_val3['tax']; 
                            }                                                        
                        }
                        //$c++;
                        $igst3 = ($val1['tax']*$val1['gst'])/100;
                        $tax_amt3 =$val1['tax'] - $taxable3; 
                        $perecent3 =  $tax_amt3*((Int)$sale->cod_percent/100);
                        if((Int)$sale->pay_type != 'cod')
                        {
                            $perecent3=0;
                        }
                        $gsti3 = $tax_amt3-$perecent3;  
                        $sr++;
                ?>
                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $fetchparty->gst_in;?></td>
                    <td><?php echo strtoupper($fetchparty->name);?></td>
                    <td><?php echo $sale->id;?></td>
                    <td><?php echo date("d-M-Y",strtotime($sale->date));?></td>
                    <td class="text-right"><?php echo round($sale->total_amt,2);?></td>
                    <td><?php echo $fetchparty->state_name; ?></td>
                    <td><?php echo "N";?></td>
                    <td><?php ?></td>
                    <td><?php echo 'Regular';?></td>
                    <td><?php ?></td>
                    <td class="text-right"><?php echo round($val1['gst'],2);?></td>
                    <td class="text-right"><?php echo round($gsti3,2);?></td>
                    <td class="text-right">0.00</td>
                    <!--<td><?php echo $fetchparty->id;?></td>-->
                </tr>
                <?php
                    }
                    if($val1['gst'] == '28')
                    { 
                        $taxable4 = 0;
                        foreach ($retu_combine as $retu_key4 => $retu_val4 )
                        {
                            if($val1['gst'] == $retu_val4['gst'])
                            { 
                                $taxable4=$retu_val4['tax']; 
                            }                                                        
                        }
                        $d++;
                        $igst4 = ($val1['tax']*$val1['gst'])/100;
                        $tax_amt4 =$val1['tax'] - $taxable4; 
                        $perecent4 =  $tax_amt4*((Int)$sale->cod_percent/100);
                        if((Int)$sale->pay_type != 'cod')
                        {
                            $perecent4=0;
                        }
                        $gsti4 =$tax_amt4-$perecent4; 
                        $sr++;
                ?>
                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $fetchparty->gst_in;?></td>
                    <td><?php echo strtoupper($fetchparty->name);?></td>
                    <td><?php echo $sale->id;?></td>
                    <td><?php echo date("d-M-Y",strtotime($sale->date));?></td>
                    <td class="text-right"><?php echo round($sale->total_amt,2);?></td>
                    <td><?php echo $fetchparty->state_name; ?></td>
                    <td><?php echo "N";?></td>
                    <td><?php ?></td>
                    <td><?php echo 'Regular';?></td>
                    <td><?php ?></td>
                    <td class="text-right"><?php echo round($val1['gst'],2);?></td>
                    <td class="text-right"><?php echo round($gsti4,2);?></td>
                    <td class="text-right">0.00</td>
                    <!--                    <td><?php echo $fetchparty->id;?></td>-->
                </tr>
                <?php
                    }
                }
                ?>
                <?php
                unset($tax_rat);
                unset($per_i);
                unset($retu_combine);
                unset($tax);
                unset($gst);
                unset($item1);
            } 
        } ?>
            </tbody>   
        </table>
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