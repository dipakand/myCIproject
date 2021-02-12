<?php $fetchparty = $this->session->userdata('party_session');?>
<?php //print_r($this->session->userdata('discount'));
?>
<style>  
    @-webkit-keyframes blink {
        0%     { opacity: 0 } 50% { opacity: 0 }
        50.01% { opacity: 1 } 100% { opacity: 1 }
    }
    blink {
        -webkit-animation: blink 0.7s infinite linear alternate;
        -webkit-font-smoothing: antialiased;
        font-size: 50px;
    }    

    .blink {
        -webkit-animation-name: blink;
        -moz-animation-name: blink;
        -o-animation-name: blink;
        animation-name: blink;
        -webktit-animation-timing-function: linear;
        -moz-animation-timing-function: linear;
        -o-animation-timing-function: linear;
        animation-timing-function: linear;
        -webkit-animation-duration: 1s;
        -moz-animation-duration: 1s;
        -o-animation-duration: 1s;
        animation-duration: 1s;
        color: red;
    }

    .blink-infinite {
        -webkit-animation-iteration-count: infinite;
        -moz-animation-iteration-count: infinite;
        -o-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        color: red;
    }


    @-webkit-keyframes blink {
        50% {
            opacity: 0;
        }
    }
    @-moz-keyframes blink {
        50% {
            opacity: 0;
        }
    }
    @-o-keyframes blink {
        50% {
            opacity: 0;
        }
    }
    @keyframes blink {
        50% {
            opacity: 0;
        }
    }        
</style>
<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('SaleModule/tabes');?>

        <?php
        if(!$this->session->userdata('party_session')){
        ?>
        <div class="col-md-12">&nbsp;
            <form method="post" name="form1" action="<?php echo site_url('SaleController/party_session');?>">                                 
                <div class="col-md-12 ">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group" required><b>&nbsp;Search Party Name : </b>
                            <input type="text" name="party_name" id="search_party" class="form-control" style="text-transform:capitalize;" autofocus required>
                            <input type="hidden" name="party_id" id="id_party" class="form-control" style="text-transform:capitalize;" autofocus required>
                        </div>                                                
                    </div> 

                    <div class="col-md-2">
                        <div class="form-group" required><b>&nbsp;Enter Discount (%) : </b>
                            <input type="number" min="0" max="100" step="0.01" value="0" name="enter_disc" class="form-control" style="text-transform:capitalize;" required>
                        </div>                                                
                    </div> 

                    <div class="col-md-2">
                        <div class="form-group">&nbsp;
                            <button type="submit" class="btn btn-success btn-block" name="btn_submit"><span class="glyphicon glyphicon-search"></span> Search   </button>       
                        </div>
                    </div>
                </div>                               
            </form>
        </div>
        <?php } 
        else {?>
        <div class="col-md-8 col-md-offset-2">&nbsp;
            <table class="table table-striped ">
                <tr>
                    <td class="success" style="text-transform:capitalize;"><b> Name : </b><?php echo $fetchparty->name;?> </td>
                    <td class="success" > <b>Contact No :</b> <?php echo $fetchparty->contact_no;?> </td>
                    <td class="danger" colspan="2" style="text-transform:capitalize; text-align:center;"> <b>Pending Amount : <?php echo round($this->session->userdata('pending'));?></b>  </td>
                </tr>
            </table>                             
        </div>

        <div class="col-md-12 ">&nbsp;
            <form method="post" name="form2" action="<?php echo site_url('SaleController/product_session');?>">                                 
                <div class="col-md-12 ">
                    <div class="col-md-4 col-md-offset-3">
                        <div class="form-group"><b>&nbsp;Search By Product Name: </b>
                            <input type="text" name="barcode" id="search_barcode" class="form-control text-capitalize" required autocomplete="off" <?php if(!$this->session->userdata('product_id')) {?> autofocus <?php }?> >
                        </div>                                                
                    </div>                                                                                       
                    <div class="col-md-2">
                        <div class="form-group">&nbsp;
                            <button type="submit" class="btn btn-success btn-block" name="search">Search</button>       
                        </div>
                    </div>
                </div>                               
            </form>
        </div>

        <?php
              if($this->session->userdata('product_id'))
              {
                  $this->session->userdata('product_id'); 
                  $this->session->userdata('sale_price'); 
                  $this->session->userdata('hsn'); 
                  $this->session->userdata('i_gst'); 
                  $this->session->userdata('c_gst'); 
                  $this->session->userdata('s_gst'); 
                  $this->session->userdata('discount');
                  $fetch12 = $this->session->userdata('product_desc');
                  $this->session->userdata('product_name');

                  $mrp = $fetch12->mrp;

                  $stock = $fetch12->stock
        ?>
        <div class="col-md-12 ">&nbsp;  
            <form method="post" name="form3" action="<?php echo site_url('SaleController/add_session');?>">                                 
                <div class="col-sm-12  text-center">  
                    <div class="col-sm-3 ">                                           
                        <div class="form-group"><b>&nbsp;Name </b> 
                            <input type="text" name="" class="form-control" 
                                   value="<?php echo $fetch12 = $this->session->userdata('product_name');?>" required style="text-transform:capitalize;" readonly>
                            <input type="hidden" name="name" value="<?php echo$this->session->userdata('product_id');?>">
                        </div>
                    </div>
                    <div class="col-sm-1" style="margin-bottom:5px;">
                        <a >MRP <br/><span style="font-size:15px;" class="badge badge-danger">&#8377;<?php echo $mrp; ?></span></a>
                    </div>
                    <div class="col-sm-1" style="margin-bottom:5px;">
                        <a >GST <br/><span style="font-size:15px;" class="badge "><?php echo $this->session->userdata('i_gst');?> %</span></a>
                    </div>
                    <div class="col-sm-1 ">                                           
                        <div class="form-group"><b>&nbsp;Quantity  </b>
                            <input type="number" min="0" name="qty" class="form-control" required 
                                   <?php if($this->session->userdata('product_id')) { echo "autofocus";  } ?>   >
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group"><b style="font-size:15px; color:#34723d;">&nbsp;Stock </b><br/>
                            <span  class=" <?php 
                  if(30 >=  $stock) {
                      echo 'blink blink-infinite';
                  }
                                          ?> " ><?php echo $stock;  ?></span>
                            <input type="hidden" name="stock" value="<?php echo $stock;  ?>">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group"><b>Selling Price </b>
                            <input type="text" name="sale_price" class="form-control" value="<?php echo $this->session->userdata('sale_price'); ?>" required  >
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group"><b>&nbsp;Free </b> 
                            <input type="text" name="free" class="form-control" value="0" required  >
                        </div>
                    </div>

                    <?php
                  if($this->session->userdata('discount')>0)
                  {
                      $disc1=$this->session->userdata('discount');
                  }else{
                      $disc1=round($fetchparty->discount,2);
                  }
                    ?>

                    <div class="col-md-1">
                        <div class="form-group"><b>&nbsp;Disc. (%) </b>
                            <input type="number" name="disc_per" class="form-control" required  value="<?php echo $disc1;?>" title="Please enter only number" step="0.01" max="99" min="0">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">&nbsp;
                            <button type="submit" class="btn btn-warning btn-block" name="add">Add</button>       
                        </div>
                    </div>
                </div>                               
            </form>

        </div>
        <?php
              }
        ?> 

        <?php }?>

        <div class="col-md-12 table-responsive">&nbsp; 
            <form method="post" name="form4" action="<?php echo site_url('SaleController/preview');?>">
                <?php 
                if(!empty($this->session->userdata('all_bar')))
                {

                ?>
                <table class="table table-striped text-center ">
                    <tr class="warning">
                        <td><b>Sr. No.</b></td>
                        <td><b>Product<br/>Name</b></td>
                        <td><b>MRP</b></td>
                        <td><b>Quantity</b></td>                                         
                        <td><b>Selling Price</b></td>                                         
                        <td><b>Free</b></td>                                         
                        <td><b>Discount</b></td>
                        <td><b>HSN</b></td>
                        <td><b>Taxable<br/>Amount</b></td>
                        <td><b>GST %</b></td>

                        <td><b>GST</b></td>

                        <td><b>Action</b></td>                                         
                    </tr>
                    <?php 
                    $all_bar = $this->session->userdata('all_bar');

                    //print_r($all_bar);
                    $s=0;
                    $cgst1=0;
                    $sgst1=0;
                    $igst1=0;
                    $tax=0;
                    foreach($all_bar as $key => $val)
                    {  $s++;    
                     $tax += $val[6];
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
                        <td><?php echo $fetch11->mrp; ?></td>
                        <td><?php echo $val[1]; ?></td>
                        <td><?php echo $val[2]; ?></td>
                        <td><?php echo $val[3]; ?></td>
                        <td><?php echo $val[4]; ?></td>
                        <td><?php echo $val[5]; ?></td>
                        <td><?php echo round($val[6],2); ?></td>
                        <?php

                     $fetchcom = $company_row;
                     $fetchparty = $this->session->userdata('party_session');

                     if($company_row->company_state == $fetchparty->state_id)
                     { ?>
                        <?php round($val[7],2);
                      $cgst1 +=$val[7]; ?>
                        <td><?php echo $val[9]; ?></td>
                        <td><?php echo round($val[8]+$val[7],2); 
                      $sgst1 +=$val[8]; ?></td>
                        <?php
                     }

                     else
                     { ?>
                        <td><?php echo $val[8]; ?></td>
                        <td><?php echo round($val[7],2); 
                      $igst1 +=$val[7]; ?></td>
                        <?php
                     }
                        ?>

                        <td><a href="<?php echo site_url('SaleController/unset_product/'.$key);; ?>" class="btn btn-danger btn-sm glyphicon glyphicon-remove"></a></td>

                    </tr>
                    <?php 
                    } 
                    ?>
                    <tr><td colspan="12">&nbsp;</td></tr>
                    <tr >
                        <td colspan="9"></td>
                        <td class="success"><b>Sub Total</b></td>
                        <td class="success" style="border:1px solid;"><b><?php echo round($tax,2); ?></b></td>
                        <td></td>
                    </tr>
                    <tr >
                        <td colspan="9"></td>
                        <td class="info"><b>GST</b></td>
                        <?php
                    if($company_row->company_state == $fetchparty->state_id)
                    { ?>
                        <td style="border:1px solid;" class="info"><?php echo round($sgst1+$cgst1,2); ?></td>
                        <?php
                    }
                    else
                    { ?>
                        <td style="border:1px solid;" class="info"><?php echo round($igst1,2); ?></td>
                        <?php
                    }
                        ?>

                        <td></td>
                    </tr>
                    <tr >
                        <td colspan="9"></td>
                        <td class="danger"><b>Grand Total</b></td>

                        <td style="border:3px solid;" class="danger"><font color="red"><?php echo round(($tax+$cgst1+$sgst1+$igst1),2); ?></font></td>
                        <td></td>
                    </tr>

                </table>
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" name="preview" class="btn btn-success btn-block">Submit</button>
                </div>
                <div class="col-md-12">&nbsp;</div>
                <?php 
                } 
                ?>
            </form>
        </div> 

        <?php
        if($this->session->userdata('party_session')){
        ?>
        <div class="col-md-12 text-center">
            <form method="post">
                <div class="col-md-4 col-md-offset-4">
                    <a type="submit" href="<?php echo site_url('SaleController/cancel_deal');?>" class="btn btn-default btn-block">Cancel</a>
                </div>
            </form>
        </div>

        <?php } ?>

    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>
<style>
    .ui-autocomplete{
        cursor : pointer;
        height: 200px;
        overflow-y: scroll;
    }
</style>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   

<script>
    $('#search_party').autocomplete({
        source: '<?=base_url()?>SaleController/getParty',
        select: function (event, ui) {
            var name = ui.item.label
            $("#id_party").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_party").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            $( "#id_party" ).val( ui.item? ui.item.value : 0 );
        }
    });
</script>

<script>
    $('#search_barcode').autocomplete({
        source: '<?=base_url()?>SaleController/getbarcode',
        /*select: function (event, ui) {
            var name = ui.item.label
            //$("#barco").val(ui.item.value); // save selected id to hidden input
            event.preventDefault();
            $("#search_barcode").val(name); // display the selected text
            minLength:1
        }
        ,
        change: function( event, ui ) {
            //$( "#barco" ).val( ui.item? ui.item.value : 0 );
        }*/
    });
</script>