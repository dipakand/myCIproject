<div class="row">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/estimate.css');?>">
    <div class="col-lg-12">
        <?php //$this->load->view('PurchaseOrder/tabs');
        $fetch = $purchase_order_row;
        ?>

    </div>
    <div class="col-md-8 col-md-offset-2">&nbsp;
        <form method="post" name="form1">
            <table class="table table-striped ">
                <tr>
                    <td><b>Invoice No :</b>
                        <input class="form-control" placeholder="Please enter receipt number" type="text" name="receipt" required value="<?php if($fetch->receipt != '0'){ echo $fetch->receipt;}?>"  <?php if($fetch->receipt != '0'){ echo "readonly";} else { echo "required";}?>> 
                        <input class="form-control" type="hidden" name="inv_no" value="<?php echo $fetch->id;?>" required  >
                    </td>
                    <td> <b>Invoice Date :</b>
                        <input class="form-control" type="date" name="inv_date"  value="<?php if($fetch->inv_date != '0000-00-00'){ echo $fetch->inv_date;} ?>"  <?php if($fetch->inv_date != '0000-00-00'){ echo "readonly";} else { echo "required";}?>>
                    </td>
                </tr>
            </table>
            <table class="table table-striped ">

                <tr>
                    <td><b>&nbsp;Sr No.</b></td>
                    <td><b>&nbsp;Product Name :</b></td>
                    <td><b>&nbsp;Quantity :</b></td>
                    <td><b>&nbsp;Free :</b></td>
                    <td><b>&nbsp;Rate :</b></td>
                    <td><b>&nbsp;Discount% :</b></td>
                </tr>
                <?php
                $sr_no=1;
                $items=unserialize($fetch->items);
                $items1=unserialize($fetch->received);
                foreach($items as $key => $val)
                {
                    foreach($items1 as $key1 => $val1)
                    {
                        if($val[0]==$val1[0])
                        {
                            $freei=$val1[2];
                            $rates=$val1[3];
                            $discc=$val1[4];
                        }
                    }
                    $this->db->where('product_desc.id',$val[0]);
                    $this->db->select('product_desc.*, product.name as prod_name, product.hsn, product.i_gst');
                    $this->db->join('product','product_desc.product_id = product.product_id');
                    $quer2 = $this->db->get('product_desc');
                    $fetch11 = $quer2->row();

                ?>
                <tr>
                    <td><?php echo $sr_no++; ?></td>
                    <td class="">
                        <input type="hidden" name="id[]" class="form-control " value="<?php echo $val[0]; ?>" >
                        <input type="hidden" name="gst[]" class="form-control " value="<?php echo $fetch11->i_gst; ?>" >
                        <input type="text" name="name[]" class="form-control text-capitalize" value="<?php echo $fetch11->prod_name.'-'.$fetch11->weight; ?>" readonly>
                    </td>
                    <td><input type="number" name="qty[]" class="form-control" required value="<?php echo $val[1]; ?>"></td>
                    <td><input type="number" name="free[]" class="form-control" required value="<?php if($freei!= 0){echo $freei;} else { echo '0';} ?>"></td>
                    <td><input type="number" name="rate[]" class="form-control" min="0" step="0.01" required value="<?php echo $rates; ?>"></td>
                    <td><input type="number" name="disc[]" class="form-control" required value="<?php if($discc!= 0){echo $discc;} else { echo '0';}?>"></td>
                </tr>
                <?php
                }
                ?>

                <tr>
                    <td colspan="6" class="text-center">
                        <a class="btn btn-default"  href="<?php echo site_url('ManageOrder');?>">Cancel</a>&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-warning" name="submit">Received</button>
                    </td>
                </tr>
            </table>                                  
        </form>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>