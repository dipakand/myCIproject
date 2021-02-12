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
    <div class="col-lg-12">
        <!--            <a href="import_excel.php?frm=<?php echo $frmdate;?>&&todate=<?php echo $todate;?>" class="btn btn-primary pull-right">Export Excel</a>-->
        <div class="col-lg-12 table-responsive">
            &nbsp;
            <!--                <input type="button" class="btn btn-primary " id="btnExport" value="Excel" onclick="Export()" />-->
            <table class="table table-bordered text-center table-responsive" id="example" width="100%">
                <thead>
                    <tr>
                        <td><b>Sr. No.</b></td>
                        <td><b>Date</b></td>
                        <td><b>Sale Party</b></td>
                        <td><b>GST No.</b></td>
                        <td><b>Invoice No.</b></td>
                        <td><b>Input GST @5%</b></td>
                        <td><b>C GST @2.5%</b></td>
                        <td><b>S GST @2.5%</b></td>
                        <td><b>Input GST @12%</b></td>
                        <td><b>C GST @6%</b></td>
                        <td><b>S GST @6%</b></td>
                        <td><b>Input GST @18%</b></td>
                        <td><b>C GST @9%</b></td>
                        <td><b>S GST @9%</b></td>
                        <td><b>Input GST @28%</b></td>
                        <td><b>C GST @14%</b></td>
                        <td><b>S GST @14%</b></td>
                        <td><b>GROSS</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
        //print_r($sales);
        $sr=0;
        //$select="select * from sales where  date between '".$_POST['from_date']."' and '".$_POST['to_date']."' and cancel_status=''";
        //$query=mysqli_query($conn,$select);
        //while($fetch=mysqli_fetch_assoc($query))
        foreach($sales as $sale)
        { 
            $sr++;
            //            $party="select * from manage_party where id='".$sale->party_id."'";
            //            $partyquery=mysqli_query($conn, $party);
            //            $fetchparty=mysqli_fetch_assoc($partyquery);

            $this->db->where('id', $sale->party_id);
            $query1 = $this->db->get('manage_party');
            $fetchparty = $query1->row();

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

                    $retu_array  = array_combine_($per_i, $tax_rat);
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
            $sum1=0;
            foreach($array3 as $key21=>$val21)
            {  
                $sum=0;
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
                    ?>
                    <tr>
                        <td><?php echo $sr;?></td>
                        <td><?php echo date("d-m-Y",strtotime($sale->date)) ;?></td>
                        <td>
                            <?php 
            echo ucwords($fetchparty->name);
                            ?>
                        </td>
                        <td><?php echo $fetchparty->gst_in;?></td>
                        <td><?php echo $sale->id;?></td>
                        <?php

            $a=0;
            $gsti1=0;
            $cgst1=0;
            $sgst1=0;
            $total_gst1=0;
            $taxable1=0;
            $perecent1=0;
            //print_r($item1); echo nl2br("\n");
            foreach($item1 as $key1 => $val1)
            {  
                if($val1['gst'] == '5' )
                {                                                    
                    foreach ($retu_combine as $retu_key1 => $retu_val1 )
                    {
                        if($val1['gst'] == $retu_val1['gst'])
                        { 
                            $taxable1=$retu_val1['tax'];  
                        }                                                        
                    }
                    $a++;
                    $igst1 = ($val1['tax']*$val1['gst'])/100; 
                    $val1['tax']; 
                    $tax_amt1 =$val1['tax'] - $taxable1;  
                    //                                     $perecent1 =  $tax_amt1*($sale->cod_percent']/100);//comment on date 8-8-19
                    $perecent1 = 0;
                    if($sale->pay_type != 'cod')
                    {
                        $perecent1=0;
                    }
                        ?>
                        <td> <?php echo $gsti1 = $tax_amt1-$perecent1;  ?> </td>
                        <td><?php  $cgst1 = round(($gsti1*($val1['gst']/2))/100,2);  echo $cgst1;?> </td>
                        <td><?php  $sgst1 = round(($gsti1*($val1['gst']/2))/100,2); echo $sgst1;  ?> </td>
                        <?php
                }
            }
            $total_gst1 = $gsti1 + $cgst1 + $sgst1; 
            if($a == 0)
            { ?>
                        <td> -- </td>
                        <td> -- </td>
                        <td> -- </td>
                        <?php    
            }

                        ?>
                        <?php 
            $b=0;
            $gsti2=0;
            $cgst2=0;
            $sgst2=0;
            $total_gst2=0;
            $taxable2=0;
            $perecent2=0;
            foreach($item1 as $key2 => $val2)
            { 
                if($val2['gst'] == '12')
                {      
                    foreach ($retu_combine as $retu_key2 => $retu_val2 )
                    {
                        if($val2['gst'] == $retu_val2['gst'])
                        { 
                            $taxable2=$retu_val2['tax'];  
                        }                                                        
                    }
                    $b++;
                    $igst2 = ($val2['tax']*$val2['gst'])/100;
                    $tax_amt2 =$val2['tax'] - $taxable2; 
                    //                                     $perecent2 =  $tax_amt2*($sale->cod_percent']/100);//comment on date 8-8-19
                    $perecent2 = 0;
                    if($sale->pay_type != 'cod')
                    {
                        $perecent2=0;
                    }
                        ?>
                        <td> <?php echo $gsti2 = $tax_amt2-$perecent2;?> </td>
                        <td><?php  $cgst2 = ($gsti2*($val2['gst']/2))/100; echo $cgst2;  ?> </td>
                        <td><?php  $sgst2 = ($gsti2*($val2['gst']/2))/100; echo $sgst2; ?> </td>
                        <?php
                }
            }
            $total_gst2 = $gsti2 + $cgst2 + $sgst2;   
            if($b == 0)
            { ?>
                        <td> -- </td>
                        <td> -- </td>
                        <td> -- </td>
                        <?php    
            }
                        ?>
                        <?php 
            $c=0;
            $gsti3=0;
            $cgst3=0;
            $sgst3=0;
            $total_gst3=0;
            $taxable3=0;
            $perecent3=0;
            foreach($item1 as $key3 => $val3)
            {
                if($val3['gst'] == '18')
                {
                    foreach ($retu_combine as $retu_key3 => $retu_val3 )
                    {
                        if($val3['gst'] == $retu_val3['gst'])
                        { 
                            $taxable3=$retu_val3['tax']; 
                        }                                                        
                    }
                    $c++;
                    $igst3 = ($val3['tax']*$val3['gst'])/100;
                    $tax_amt3 =$val3['tax'] - $taxable3; 
                    //                                     $perecent3 =  $tax_amt3*($sale->cod_percent']/100);//comment on date 8-8-19
                    $perecent3 = 0;
                    if($sale->pay_type != 'cod')
                    {
                        $perecent3=0;
                    }
                        ?>
                        <td> <?php echo $gsti3 = $tax_amt3-$perecent3; ?></td>
                        <td><?php $cgst3 = ($gsti3*($val3['gst']/2))/100; echo $cgst3;?></td>
                        <td><?php $sgst3 = ($gsti3*($val3['gst']/2))/100; echo $sgst3; ?></td>
                        <?php
                }
            }
            $total_gst3 = $gsti3 + $cgst3 + $sgst3; 
            if($c == 0)
            { ?>
                        <td> -- </td>
                        <td> -- </td>
                        <td> -- </td>
                        <?php    
            }
                        ?>
                        <?php 
            $d=0;
            $gsti4=0;
            $cgst4=0;
            $sgst4=0;
            $total_gst4=0;
            $taxable4=0;
            $perecent4=0;
            foreach($item1 as $key4 => $val4)
            {
                if($val4['gst'] == '28')
                { 
                    foreach ($retu_combine as $retu_key4 => $retu_val4 )
                    {
                        if($val4['gst'] == $retu_val4['gst'])
                        { 
                            $taxable4=$retu_val4['tax']; 
                        }                                                        
                    }
                    $d++;
                    $igst4 = ($val4['tax']*$val4['gst'])/100;
                    $tax_amt4 =$val4['tax'] - $taxable4; 
                    //                                     $perecent4 =  $tax_amt4*($sale->cod_percent']/100);//comment on date 8-8-19
                    $perecent4 = 0;
                    if($sale->pay_type != 'cod')
                    {
                        $perecent4=0;
                    }
                        ?>
                        <td><?php echo $gsti4 =$tax_amt4-$perecent4;  ?></td>
                        <td><?php  $cgst4 = ($gsti4*($val4['gst']/2))/100; echo $cgst4;?></td>
                        <td><?php $sgst4 = ($gsti4*($val4['gst']/2))/100; echo $sgst4; ?></td>
                        <?php
                }
            }
            $total_gst4 = $gsti4 + $cgst4 + $sgst4;  
            if($d == 0)
            { ?>
                        <td> -- </td>
                        <td> -- </td>
                        <td> -- </td>
                        <?php    
            }
                        ?>
                        <td><?php echo $total = round($total_gst1 + $total_gst2 + $total_gst3 + $total_gst4); ?></td>
                    </tr>
                    <?php
            unset($tax_rat);
            unset($per_i);
            unset($retu_combine);
            unset($tax);
            unset($gst);
            unset($item1);
        }   
                    ?>

                </tbody>
            </table>
        </div>
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