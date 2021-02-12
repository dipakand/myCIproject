<div class="row">
    <form method="post" action="<?php echo site_url('StockCounterController/save_stock');?>">
        <div class="col-md-12">
            <table class="table-striped table-bordered table " width="100%" >
                <thead>
                    <tr>
                        <th>Sr No.</th> 
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>MRP</th>
                        <th>Sale Price</th>
                        <th>Stock</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $counter = 0;

                    foreach($fetch_data as $list)
                    {
                        $counter++;
                        //if($counter <= 5)
                        {
                    ?>		
                    <tr>
                        <td><?php echo $counter;?></td> 
                        <td><?php echo ucwords($list->b_name);?></td>
                        <td><?php echo ucwords($list->pro_name);?></td>
                        <td><?php echo ucwords($list->weight);?></td>
                        <td><?php echo $list->mrp;?></td>
                        <td><?php echo $list->sale_price;?></td>
                        <td><?php echo $list->stock;?></td>
                        <td>
                            <input type="number" name="count[<?php echo $list->id;?>]" class="form-control">
                        </td>
                        <?php
                        }

                    }
                        ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">
            <div class="col-md-4 col-sm-offset-4">
                <input type="submit" name="btn_submit" value="Submit" class="btn btn-success btn-block">
            </div>
        </div>
    </form>
    <div class="col-md-12">
        <div class="col-md-12">&nbsp;</div>
    </div>
</div>