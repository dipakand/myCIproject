<?php
$company_row;
$sale_row;
$party_row;

?>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-8 col-md-offset-2">&nbsp;
            <form method="post" name="form1">
                <table class="table table-striped ">
                    <tr>                                        
                        <td width="60%" style="text-align:right;"> <b>Return Date :</b></td>
                        <td>
                            <input class="form-control datepicker" type="text" name="inv_date" autocomplete="off" value="<?php echo set_value('inv_date');?>">
                            <?php echo form_error('inv_date');?>
                        </td>
                    </tr>
                </table>
                <table class="table table-striped text-center ">
                    <tr class="warning">
                        <td>
                            <input type="checkbox" id="chkboxx" >
                        </td>
                        <td><b>Sr. No.</b></td>
                        <td><b>Product Name</b></td>
                        <td><b>Quantity</b></td>                                         
                    </tr>
                    <?php 
                    $items = unserialize($sale_row->item_detail);
                    $s=0;
                    foreach($items as $k_item => $v_item)
                    {
                        $s++; 
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="inser_chkbox[<?php echo $v_item[0]; ?>]" class="case" value="<?php echo $v_item[0]; ?>">
                        </td>
                        <td><?php echo $s; ?> </td>
                        <td style="text-transform:capitalize;">
                            <?php 
                        $this->db->where('id', $v_item[0]);
                        $query = $this->db->get('product_desc');

                        $fetch11 = $query->row();

                        $this->db->where('product_id', $fetch11->product_id);
                        $query2 = $this->db->get('product');

                        $fetch111 = $query2->row();
                        echo $fetch111->name." ".$fetch11->weight;
                            ?>
                        </td>
                        <td width="20%">
                            <input type="hidden" name="name[]" value="<?php echo $v_item[0];?>">
                            <input type="number" min="0"  max="<?php echo $v_item[1];?>" name="qty[<?php echo $v_item[0];?>]" class="form-control"  placeholder="<?php  echo $v_item[1]; ?>">
                            <input type="hidden" name="unit[]" value="<?php echo $v_item[2];?>">
                        </td>
                    </tr>           
                    <?php

                    }
                    ?>
                    <tr>
                        <td colspan="4">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block">Submit</button>
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
<script src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
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
<script>
    $(document).ready(function(){
        $("#chkboxx").change(function()
                             {
            $(".case").prop('checked', $(this).prop("checked"));
        });
    });
</script>