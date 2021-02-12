<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('StockReport/tabs');?>
    </div>

    <?php
    if($brand_id == '')
    {
    ?>
    <div class="col-md-12">&nbsp;
        <form method="post" name="form1">
            <div class="col-md-4 col-md-offset-4"><b>Select Brand :</b> 
                <select name="brand_name[]" class="form-control"> 
                    <option value="all">All Brand</option>
                    <?php
        foreach($brand_row as $brand)
        {
                    ?>
                    <option value="<?php echo $brand->id;?>"><?php echo ucwords($brand->name);?></option>
                    <?php     
        }
                    ?>                                            
                </select>
            </div>
            <div class="col-md-4 col-md-offset-4 text-center"><br/>
                <button type="submit" class="btn btn-success" name="brand">Search</button>
            </div>
        </form>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="col-md-6 col-md-offset-3">&nbsp;
        <div class="col-md-12">
            <a href="<?php echo site_url('ProductReport');?>" class="btn btn-primary pull-left">Back</a>
            <a  id="ExportToExcel" class="btn btn-primary pull-right">Import Excel</a>
        </div>
        <br/><br/>

        <?php
        foreach($brand_id as $key => $val) 
        {
        ?>
        <div id="DivIdToPrint">
            <table class="table table-bordered text-center"  >
                <tr>
                    <?php   
            $fetch11 = $this->db->where('id',$val)->get('brand_master')->row();
                    ?>
                    <td colspan="9" class="warning"><b>Brand Name : </b><?php echo ucwords($fetch11->name);?></td>
                </tr>
                <tr>
                    <td><b>Sr No </b></td>
                    <td><b>Product Name </b></td>
                    <td><b>Weight </b></td>
                    <td><b>Stock</b></td>
                    <!--<td><b>Stock 2</b></td>-->
                    <td><b>MRP</b></td>
                    <td><b>PP</b></td>
                    <td><b>SP</b></td>
                    <td><b>Value Based on PP</b></td>
                    <td><b>Value Based on MRP</b></td>
                </tr>
                <tr>
                    <?php
            $sr=1;
            $query3 = $this->db->where('brand_id',$fetch11->id)->get('product')->result();

            $grand_pp=0;
            $grand_mrp=0;
            foreach($query3 as $product)
            {
                $brand_pp=0;
                $brand_mrp=0;

                $query_product = $this->db->where('product_id',$fetch11->id)->get('product_desc');

                $num = $query_product->num_rows();
                $fetch_rows = $query_product->result();

                if($num==0)
                {
                    $row_no=1;
                }else{
                    $row_no=$num;
                }
                    ?>
                    <td class="" rowspan="<?php echo $row_no; ?>" style="text-transform:capitalize;"><b><?php echo $sr++;?></b></td>
                    <td class="" rowspan="<?php echo $row_no; ?>" style="text-transform:capitalize;"><b><?php echo $product->name;?></b></td>
                    <?php 
                if($num>0)
                {
                    foreach($fetch_rows as $fetch1)
                    { 
                    ?>                                         
                    <td><?php echo ucwords($fetch1->weight);?></td>
                    <td><?php echo $fetch1->stock;?></td>
                    <!--<td><?php echo $fetch1->stock_2;?></td>-->
                    <td><?php echo $fetch1->mrp;?></td>
                    <?php 
                        if(is_numeric($product->i_gst)){
                            $gst = 1+$product->i_gst/100;
                        }
                        else
                        {
                            $gst = 1+0/100;
                        }
                    ?>
                    <td><?php echo $pp=round(((($fetch1->mrp)/$gst)*$fetch11->retail_m)*$fetch11->db_m,3);?></td>
                    <td><?php echo round(($fetch1->mrp/$gst)*$fetch11->retail_m,3);?></td>

                    <td><?php echo $pp*$fetch1->stock;
                        $brand_pp+=$pp*$fetch1->stock;
                        $grand_pp+=$pp*$fetch1->stock;
                        ?></td>
                    <td><?php echo $fetch1->mrp*$fetch1->stock;
                        $brand_mrp+=$fetch1->mrp*$fetch1->stock;
                        $grand_mrp+=$fetch1->mrp*$fetch1->stock;
                        ?>
                    </td>

                </tr> 
                <?php
                    }
                }
                else
                {
                ?>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                </tr> 
            <?php
                }
            ?>
            <?php
            } 
            ?> 
            <tr>
                <td colspan="7"><b>Total Value of All</b></td>
                <td><b><?php echo $grand_pp;?></b></td>
                <td><b><?php echo $grand_mrp;?></b></td>
            </tr>
            </table>
    </div>
    <?php 
        }
    ?>
</div> 
<?php   
    }
?>
<div class="col-sm-12">&nbsp;</div>
<div class="col-sm-12">&nbsp;</div>
</div> 

<script>
    $("#ExportToExcel").click(function (e) {
        let file = new Blob([$('#DivIdToPrint').html()], { type: "application/vnd.ms-excel" });
        let url = URL.createObjectURL(file);
        let a = $("<a />", {
            href: url,
            download: "filename.xls"
        }).appendTo("body").get(0).click();
        e.preventDefault();
    });
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