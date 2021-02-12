<div class="row">

    <div class="col-lg-12">
        <?php //$this->load->view('PurchaseOrder/tabs');
        $fetch = $purchase_order_row;
        $reci_items=unserialize($fetch->received);
        //$return_itemm=unserialize($rows['return_item']);
        ?>
        <div class="col-md-8 col-sm-offset-2 ">&nbsp;
            <form method="post">   
                <table class="table table-striped text-center">
                    <tr class="warning">
                        <td><b>Sr. No.</b></td>
                        <td><b>Product Name</b></td>
                        <td><b>Qty</b></td>
                        <td><b>Return Qty</b></td>
                    </tr>
                    <?php    
                    //                                    print_r($reci_items);echo nl2br("\n");
                    $s=0;
                    foreach($reci_items as $key => $val)
                    { 
                        $s++;
                        $this->db->where('product_desc.id',$val[0]);
                        $this->db->select('product_desc.*, product.name as prod_name, product.hsn, product.i_gst');
                        $this->db->join('product','product_desc.product_id = product.product_id');
                        $quer2 = $this->db->get('product_desc');
                        $fetch11 = $quer2->row();
                    ?>
                    <tr>
                        <td><?php echo $s;?></td>
                        <td><?php 
                        echo ucwords($fetch11->prod_name).' '.$fetch11->weight; 
                            ?>
                        </td>
                        <td>
                            <?php echo $val[1];?>
                        </td>
                        <td width="20%">
                            <input type="number" min="0" class="form-control" name="re_qty[]" required>
                            <input type="hidden" min="0" class="form-control" name="id[]" value="<?php echo $val[0];?>">
                            <input type="hidden" min="0" class="form-control" name="qty[]" value="<?php echo $val[1];?>">
                            <input type="hidden"  class="form-control" name="free[]" value="<?php echo $val[2];?>">
                            <input type="hidden"  class="form-control" name="rate[]" value="<?php echo $val[3];?>">
                            <input type="hidden"  class="form-control" name="dis[]" value="<?php echo $val[4];?>">
                            <input type="hidden" name="old_taxable[]" value="<?php echo $val[5]; ?>">

                            <input type="hidden" name="old_gst_per[]" value="<?php echo $val[6]; ?>">
                            <input type="hidden" name="old_gst_amtss[]" value="<?php echo $val[7]; ?>">
                            <input type="hidden" name="old_totalss[]" value="<?php echo $val[8]; ?>">
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4"><button name="submit" type="submit" class="btn btn-success">Submit</button></td>
                    </tr>
                </table>

            </form>
            <?php 
            /*if(isset($_POST['submit']))
            {
                

                else
                {
            ?>
            <script>alert('Note possible this qty.!!!');</script>
            <?php
                }
            }*/
            ?>
            <div class="col-md-12 ">&nbsp;
                <!--                            <form method="post" name="form4">                                 -->
                <!--                                    <div class="col-md-12 "> -->
                <div class="col-md-4 col-md-offset-4">
                    <a href="<?php echo site_url('ManageOrder');?>" class="btn btn-default btn-block">Cancel</a>       
                </div>
                <!--                                    </div>                  -->
                <!--                            </form>-->
            </div>

        </div>  
    </div>
</div>
<div class="col-sm-12">&nbsp;</div>
<div class="col-sm-12">&nbsp;</div>
</div>