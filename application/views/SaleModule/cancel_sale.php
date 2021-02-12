<div class="row">
    <div class="col-lg-12">
        <div class="col-md-12">
            <form method="post">
                <?php  
                $company_row;
                $sale_row;
                $party_row;
               
                ?>
                <table class="table table-striped text-center ">
                    <tr class="warning">
                        <td><b>Sr. No.</b></td>
                        <td><b>Product<br/>Name</td>
                        <td><b>Quantity</b></td>                                         
                        <td><b>Selling Price</b></td>                                         
                        <td><b>Free</b></td>                                         
                        <td><b>Discount</b></td>
                        <td><b>HSN</b></td>
                        <td><b>Taxable<br/>Amount</b></td>

                        <?php
                        if($company_row->company_state == $party_row->state_id)
                        { ?>
                        <td><b>C GST</b></td>
                        <td><b>S GST</b></td>
                        <?php
                        }
                        else
                        { ?>
                        <td><b>i GST</b></td>
                        <?php
                        }
                        ?>                                    
                    </tr>
                    <?php 
                    $all_bar=unserialize($sale_row->item_detail);  
                    $s=0;
                    foreach($all_bar as $key => $val)
                    {  $s++;                                                
                    ?>
                    <tr>
                        <td><?php echo $s; ?> </td>
                        <td style="text-transform:capitalize;">
                            <?php 
                     $this->db->where('id', $val[0]);
                     $query = $this->db->get('product_desc');
                     $fetch11 = $query->row();

                     $this->db->where('product_id', $fetch11->product_id);
                     $query2 = $this->db->get('product');

                     $fetch111 = $query2->row();
                     echo $fetch111->name." ".$fetch11->weight;
                      ?>
                        </td>
                        <td><?php echo $val[1]; ?></td>
                        <td><?php echo $val[2]; ?></td>
                        <td><?php echo $val[3]; ?></td>
                        <td><?php echo $val[4]; ?></td>
                        <td><?php echo $val[5]; ?></td>
                        <td><?php echo round($val[6],2); ?></td>
                        <?php
                     if($company_row->company_state == $party_row->state_id)
                     { ?>
                        <td><?php echo round($val[7],2); ?></td>
                        <td><?php echo round($val[8],2); ?></td>
                        <?php
                     }
                     else
                     { ?>
                        <td><?php echo round($val[7],2); ?></td>
                        <?php
                     }
                        ?>
                    </tr>
                    <?php 
                    } 
                    ?>
                    <tr>
                        <td colspan="
                                     <?php
                                     if($company_row->company_state == $party_row->state_id)
                                     { 
                                         echo"12";
                                     }
                                     else
                                     { 
                                         echo "11";
                                     }
                                     ?>
                                     ">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" name="submit" value="yes" class="btn btn-default btn-block" onclick="return confirm('Are you sure order cancel ?...');">Order Cancel</button>
                            </div>
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>