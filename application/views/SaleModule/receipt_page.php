<div class="row">
    <div class="col-lg-12">
        <?php
        $company_row;
        $sale_row;
        $sale_log_row;
        $party_row;

        foreach($sale_log_row as $sale_log)
        {
            $detail=unserialize($sale_log->detail);
            foreach($detail as $ke => $ve)
            {
                if($ve['amt']>0){
                    $type[]=$ve['type']; 
                    $amt[]= $ve['amt'];
                }
            }

            $amount=array_sum($amt);
            $types= implode(', ',$type);
        ?>

        <div class="col-md-8 col-md-offset-2 text-center "> &nbsp;
            <div style="border:1px solid black; padding:4%;"> 
                <div style="border:1px solid black; border-radius: 5px; padding:1%;">
                    <div style="border:1px solid black; border-radius: 7px; padding:1%; width=100%;">
                        <div style="text-align:center; font-size:15px;"><b><?php echo ucwords($company_row->company_name);?></b></div>
                        <div style="text-align:center; font-size:12px;"><b><b><?php echo ucwords($company_row->company_address.', '.$company_row->company_city);?></b></b></div>
                        <div style="text-align:center; font-size:12px;"><b>Phone : <?php echo $company_row->company_phone;?></b></div>
                        <div style="text-align:center; font-size:25px; text-decoration: underline; padding-bottom:1%;"><b>RECEIPT</b></div>

                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="text-align:left; font-size:12px; padding-top:2%; border-bottom:1px solid #ccc;"><b>Receipt No.: </b> <?php echo $sale_log->id;?></td>
                                <td style="text-align:right; font-size:12px; padding-top:2%; padding-right:2%; border-bottom:1px solid #ccc;"><b>Dated : </b><?php echo date("d-m-Y",strtotime($sale_log->date_time));?></td>
                            </tr> 
                            <tr>
                                <td colspan="2" style="text-align:left; font-size:12px; padding-top:2%;border-bottom:1px solid #ccc;"><b>Received From : </b><?php echo ucwords($party_row->name);?> &nbsp;&nbsp;<b>Mobile No : </b> <?php echo $party_row->contact_no;?></td>
                            </tr>

                            <tr>
                                <td colspan="2" style="text-align:left; font-size:12px; padding-top:2%;border-bottom:1px solid #ccc;"><b>Account of :</b> <?php echo 'Main Receipt Id : '.$sale_row->id.', dated :'.date("d-m-Y",strtotime($sale_row->date));?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:left; font-size:12px; padding-top:2%;border-bottom:1px solid #ccc;"><b>Rupees :</b> <?php echo $this->CommenModel->convertToIndianCurrency($amount); ?> Rupees. &nbsp;&nbsp;<b>By : </b><?php echo $types;?></td>
                            </tr>

                            <tr>
                                <td colspan="2" style="text-align:left; font-size:12px; padding-top:2%;">
                                    <div style="border: 2px solid #000; font-size:15px; width:30%;"><b style="margin-left:5%;">&#x20B9; <?php echo $amount;?></b></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:left; font-size:10px; padding-top:5%;"><b>Check/Draft Subject to Realization</b></td>
                                <td style="text-align:right; font-size:10px; padding-top:5%;padding-right:2%;"><b>Authorized Signatory</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right; font-size:12px; padding-bottom:2%; padding-right:5%; padding-top:2%;"><b><?php echo ucwords($company_row->company_name);?></b></td>
                            </tr>        
                        </table>
                    </div>
                </div>
                <div class="col-sm-8  col-sm-offset-2 text-center"> 
                    <a onclick="window.open('<?php echo site_url('ReceiptPrint/'.$sale_log->id);?>')" class="btn btn-primary glyphicon glyphicon-print"></a>
                </div>
            </div>

        </div> 
        <?php
            unset($type);
            unset($amt);
        }
        ?>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div>