<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('PurchaseOrder/tabs');?>
    </div>
    <div class="col-md-12">&nbsp;
        <form method="post" name="form1">
            <div class="col-md-6 col-md-offset-3">
                <div class="col-md-4 ">
                    <div class="form-group"><b>Enter Date From :</b>
                        <input type="text" name="from_date" autocomplete=off class="form-control datepicker" required value="<?php echo date('d-m-Y', strtotime($frmdate));?>" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><b>To :</b>
                        <input type="text" name="to_date" autocomplete=off class="form-control datepicker" required value="<?php echo date('d-m-Y', strtotime($todate));?>" >
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-"><br/>
                    <button type="submit" name="submit" class="btn btn-success btn-block">Search</button>
                </div>
            </div>
        </form>
    </div>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/estimate.css"> 
    <div class="col-md-12 <?php if((!isset($frmdate)) && (!isset($todate))) { echo "hidden";} ?>">&nbsp;
        <div class="col-sm-10 col-sm-offset-1 text-center alert alert-success" style="color:#fff;">&nbsp;
            <b>Date From : <?php echo $frmdate;?> - To : <?php echo $todate;?></b>
        </div>

        <?php
        $purchase_order;
        $product_desc;

        //$product_desc1 = "product_desc1";
        //$product_desc1 = array();
        foreach($product_desc as $items)
        {
            $product_id = $items->id;
            $product_desc1['product_desc'.$product_id]=0;
        }

        foreach($purchase_order as $purcahse)
        {
            $etem1=unserialize($purcahse->received);

            foreach($etem1 as $key1 => $val1)
            { 
                $prod_id=$val1[0];
                $product_desc1['product_desc'.$prod_id] +=$val1[1];
                $product_unique_id[] =$val1[0];
            }
        }
        //print_r($product_unique_id);
        ?>
        <div class="col-md-12">&nbsp;
            <form method="post">
                <div class="col-md-12 <?php if((!isset($frmdate)) && (!isset($todate))) { echo "hidden";} ?>">&nbsp;
                    <div class="col-sm-10 col-sm-offset-1 text-center alert alert-success" style="color:#fff;">&nbsp;
                        <b>Date From : <?php echo $frmdate;?> - To : <?php echo $todate;?></b>
                    </div>

                    <div class="col-md-12">&nbsp;
                        <div class="table-responsive">
                            <table class="table table-striped text-center" id="example" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>Sr. No.</b></td>
                                        <td><b>Product Name</b></td>
                                        <td><b>Qty</b></td>
                                        <td><b>Nos</b></td>
                                        <td><b>Total</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $s=1;$qty=0;$total=0;$nos=0;
                                    foreach(array_unique($product_unique_id) as $value)
                                    {
                                        //echo $product_desc1['product_desc'.$value];
                                        $this->db->where('product_desc.id',$value);
                                        $this->db->select('product_desc.*, product.name as prod_name, product.hsn, product.i_gst');
                                        $this->db->join('product','product_desc.product_id = product.product_id');
                                        $quer2 = $this->db->get('product_desc');
                                        $fetch11 = $quer2->row();
                                        
                                        $qty += $product_desc1['product_desc'.$value];
                                        $nos += $fetch11->nos;
                                        $totl = $fetch11->nos * $product_desc1['product_desc'.$value];
                                        $total += $totl;
                                        ?>
                                    <tr>
                                        <td><?php echo $s++;?></td>
                                        <td style="text-transform:capitalize;"><?php echo $fetch11->prod_name.'-'.$fetch11->weight;?></td>
                                        <td style="text-transform:capitalize;"><?php echo $product_desc1['product_desc'.$value]; ?></td>
                                        <td style="text-transform:capitalize;"><?php echo $fetch11->nos; ?></td>
                                        <td style="text-transform:capitalize;"> 
                                            <?php echo $totl; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                     ?>
                                </tbody>
                                <tfoot>
                                    <td>&nbsp;</td>
                                    <td><b>Total</b></td>
                                    <td><?php echo $qty;?></td>
                                    <td><?php echo $nos;?></td>
                                    <td><?php echo $total;?></td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>  
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>

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