<?php
error_reporting(0);
session_start();
ob_start();

$sess_cheq;
$cheq_alldet;

//print_r($sess_cheq);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            body {
                background: rgb(204,204,204); 
                color: #4a9bbc;
            }
            table, td, tr, div{
                border-color: #4a9bbc;
            }
            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
                color: #4a9bbc;
            }
            page[size="A4"] {  
                width: 21cm;
                height: 29.7cm; 
            }
            page[size="A4"][layout="portrait"] {
                width: 29.7cm;
                height: 21cm;
                color: #4a9bbc;
            }

            @media print 
            {
                body, page {
                    margin: 0;
                    box-shadow: 0;
                    color: #4a9bbc;
                    border: 1px solid #4a9bbc;
                }
            }

        </style>

        <title>Deposit Pay In Slip</title>
    </head>
    <body>
        <?php
        foreach($sess_cheq as $kee=>$vall)
        {
            foreach($cheq_alldet as $kyy=>$value) 
            {
                if($vall==$kyy)
                {
                    $date_st = explode('-',$value['cdate']);

                    $split_yr = str_split($date_st[0]);
                    $split_month = str_split($date_st[1]);
                    $split_date = str_split($date_st[2]);
        ?>
        <page size="A4" layout="portrait">
            <div style="text-align:left; margin-left:1%; font-size:8px;padding: 10px; color: #4a9bbc;">
                <?php 
                    $fetch = $company_row;

                    $account_num = $fetch->bank_details;
                    $array = (explode("*",$account_num));

                    $str = $array[1];
                    $chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
                ?>
                <table border="0" width=100% cellspacing="0" cellpadding="0" >
                    <tr>
                        <td style="width: 32%; padding-right: 10px;">
                            <table border="0" width= "" cellspacing="10" cellpadding="10" >
                                <tr>
                                    <td>

                                        <b style="font-size:10px;">पैसे भरणा स्लिप/ जमा पर्ची / DEPOSIT PAY SLIP</b><br>
                                        <img src="../images/ub-logo.png" height="40px;" style="padding-left:35px;"><br>

                                        <span>शाखा/ Branch : _________________</span><br>

                                        <table >
                                            <tr>
                                                <td style="width:5%;padding-top: 4px;">
                                                    दिनांक <br> Date   &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td style="width:35%; border-color:#4a9bbc;">
                                                    <table border="1" height= "20px" style="border-color: #77d8ff;">
                                                        <tr style="border-color:#4a9bbc;"> 
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_date[0]; ?></td>
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_date[1]; ?></td>
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_month[0]; ?></td>
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_month[1]; ?></td>
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[0]; ?></td>
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[1]; ?></td>
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[2]; ?></td>
                                                            <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[3]; ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        <span style="font-size:7px;">बचत / चालू / ओडी / कॅश क्रेडिट /आवर्ती जमा खाते / टीएल / डीएल / खाते / क्रेडिट कार्ड नं.</span><br>
                                        <span>SB / CA / OD / CC / RD / TL / A/c No. /Credit Card No.</span>
                                        <p>
                                        <table border="1" width="100%" height="20px" style="border-color: #77d8ff;">
                                            <tr style="text-align:center">
                                                <td style="width: 20px;"><?php echo $chars[4]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[5]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[6]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[7]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[8]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[9]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[10]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[11]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[12]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[13]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[14]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[15]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[16]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[17]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[18]; ?></td>
                                            </tr>
                                        </table>
                                        <span>नाम/ Name : &nbsp;&nbsp;<?php echo $fetch->company_name;?></span><br>
                                        <span>टेलिफोन नं./ Tel. No. &nbsp;&nbsp;<?php echo $fetch->company_phone;?></span>
                                        <span>
                                            <table style="border-color: #4a9bbc;">
                                                <tr>
                                                    <td style="padding-right:10px;">राशी <br>Amount   </td>
                                                    <td style="border: 1px solid #4a9bbc; width:200px;padding-left: 3px;text-align:center;"><span style="font-size: 20px;float:left;">&#x20B9;</span><b style="font-size:12px;padding-left:5px;"><?php echo $value['total'].' /-'; ?></b></td>

                                                    <td style="border: 1px solid #4a9bbc; width:70px;padding-left: 3px;"><span>पैसे <br>Ps.</span></td>
                                                </tr>
                                            </table>
                                        </span>
                                        <span>₹ शब्दो मे<br>Rupees in words : </span><span style="font-size:10px;"><?php echo $this->CommenModel->convertToIndianCurrency($value['total']); ?></span>
                                        <table border="1" width="100%" height="100px" cellpadding="0" cellspacing="0" style="border-color: #77d8ff;">
                                            <tr>
                                                <td colspan="4" width="" style="background-color:#4a9bbc;color:#fff">नगदी/ चेक सं. दिनांक एवं बँक व शाखा का नाम <br>
                                                    Cash/Cheque No. Date & Name of Bank & Branch
                                                </td>
                                                <td width="13%" style="background-color:#4a9bbc;color:#fff"><span>₹</span></td>
                                                <td width="13%" style="background-color:#4a9bbc;color:#fff"><span><center>पैसे<br> P.</center></span></td>
                                            </tr>
                                            <tr>
                                                <td width="50%" style="padding-left:5px;font-size:10px;"><b>Cheque No.<?php echo $value['cno']; ?> </b></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo $value['total']; ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left:5px;font-size:10px;"><?php echo ucwords($value['cname']); ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:right;padding-right:10px;">एकूण /कुल/ Total</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="font-size:12px;"><b><?php echo $value['total']; ?></b></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <table border="0" cellpadding= "0" cellspacing="0">
                                            <tr style="font-size: 6px;">
                                                <td style="padding-right:10px;"> अधिकारी / रोकडिया / एकल खिडकी संचालक <br>
                                                    Officer/Cashier/ SWO</td>
                                                <td style="border : 1px solid #4a9bbc;padding: 5px 2px;">यूनियन बँक ऑफ इंडिया टोल फ्री 24 घंटे कॉल सेंटर <br>Union Bank of India Toll Free 24 hours call center<br>
                                                    टोल फ्री न./Toll Free No. 1800-22-2244</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td style="width: 27%;padding: 0 10px 0 10px;">
                            <table border="0" cellspacing="0" cellpadding="0" margin-left:10px; margin-right:10px; >
                                <tr>
                                    <td>
                                        <span><b style="font-size:8px; text-align:center;">पैसे भरणा स्लिप/ जमा पर्ची / DEPOSIT PAY SLIP</b></span><br>

                                        <span>
                                            <table style="margin-top:8px;">
                                                <tr>
                                                    <td style="width:8%;padding-top: 4px;font-size: 7px;">
                                                        पॅन कार्ड सं. <br>PAN NO. &nbsp;&nbsp;
                                                    </td>
                                                    <td style="width:33%; border-color:#4a9bbc;">
                                                        <table border="1" height= "20px" style="border-color: #77d8ff;">
                                                            <tr style="border-color:#4a9bbc;"> <td style="width:20px;"></td>
                                                                <td style="width:20px;border-color:#4a9bbc;"></td>
                                                                <td style="width:20px;border-color:#4a9bbc;"></td>
                                                                <td style="width:20px;border-color:#4a9bbc;"></td>
                                                                <td style="width:20px;border-color:#4a9bbc;"></td>
                                                                <td style="width:20px;border-color:#4a9bbc;"></td>
                                                                <td style="width:20px;border-color:#4a9bbc;"></td>
                                                                <td style="width:15px;border-color:#4a9bbc;"></td>
                                                                <td style="width:20px;border-color:#4a9bbc;"></td>
                                                                <td style="width:15px;border-color:#4a9bbc;"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </span>
                                        <span>

                                            <table>
                                                <tr>
                                                    <td>फॉर्म 60/ Form 60</td>&nbsp;&nbsp;&nbsp;
                                                    <td style="border: 1px solid #4a9bbc;height:20px; width:30px;"></td>
                                                </tr>
                                            </table>
                                        </span>
                                        <p class="text-center" >₹ 50,000/- एवं अधिक की नगदी जमा हेतू <br> For Cash Deposit of 50,000/- & Above</p>
                                        <table border="1" cellpadding="0" cellspacing="0" width="100%" style="border-color: #77d8ff;">
                                            <tr style="text-align:center;">
                                                <td colspan="4" style="background-color:#4a9bbc;color:#fff; font-size:8px;padding:3px 0 3px 0;">रोख जमा विवरण / नगदी जमा / CASH DEPOSIT</td></tr> 
                                            <tr style="text-align:center;">
                                                <td style="width: 30%;">नोट /Notes</td>
                                                <td style="width: 20%;">सं./ No.</td>
                                                <td style="width: 40%;">₹</td>
                                                <td style="width: 10%;">पैसे/Ps.</td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>2000 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>500 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>200 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>100 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>50 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>20 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>10 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>5 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>2 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>1 X</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <td>सिक्के/Coins</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr >
                                                <td colspan="2" style="border-bottom:1px solid #fff;border-left:1px solid #fff;text-align:right;">एकूण /कुल /Total &nbsp; &nbsp; </td>
                                                <td style="font-size:12px;padding-left:5px;"><b><?php echo $value['total']; ?></b></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <div style="border: 1px solid #4a9bbc; font-size:7px;">
                                            <table border="0">
                                                <tr><td>1. सभी चेक क्रॉस किये जाए |</td></tr>
                                                <tr><td>2. कृपया चेक के पीछे अपना खाता सं.व नाम लिखे |</td></tr>
                                                <tr><td>3. कृपया नगदी जमा , बाहरी केंद्र के चेक और स्थानीय  चेक के लिये अलग-अलग पर्चीयो का &nbsp; &nbsp;&nbsp;&nbsp;प्रयोग करे |</td></tr>
                                                <tr><td>1. All cheques must be crossed.</td></tr>
                                                <tr><td>2. Please mention your A/c No. and Name on back of the cheque.</td></tr>
                                                <tr><td>3. Please use separate slips for Cash Deposit, outstation cheques and local cheques.</td></tr>

                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td style="width: 40%;">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <span>
                                            <table>
                                                <tr>
                                                    <td style="width:60%; padding-bottom: 12px;">
                                                        <img src="../images/ub-logo.png" height="50px; width="150px;>
                                                    </td>
                                                    <td style="width:5%;padding-top: 10px;">
                                                        दिनांक <br> Date   &nbsp;&nbsp;&nbsp;
                                                    </td>
                                                    <td style="width:35%;">
                                                        <table border="1" height= "20px" style="border-color: #77d8ff;">
                                                            <tr style="border-color:#4a9bbc;"> 
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_date[0]; ?></td>
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_date[1]; ?></td>
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_month[0]; ?></td>
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_month[1]; ?></td>
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[0]; ?></td>
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[1]; ?></td>
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[2]; ?></td>
                                                                <td style="width:20px;border-color:#4a9bbc;text-align:center;font-size:10px;"><?php echo $split_yr[3]; ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </span>
                                        <span>शाखा _______ बचत/चालू/ओडी/कॅश क्रेडिट/आवर्ती जमा खाते/टीएल/डीएल खाते/क्रेडिट कार्ड न.</span><br>
                                        <span>Branch : ____________________ SB/CA/OD/CC/RD/TL/DL/A/c NO./credit Card No.</span><br><br>
                                        <span><table border="1" width="100%" height="20px" style="border-color: #77d8ff;">
                                            <tr style="text-align:center">
                                                <td style="width: 20px;"><?php echo $chars[4]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[5]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[6]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[7]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[8]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[9]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[10]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[11]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[12]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[13]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[14]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[15]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[16]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[17]; ?></td>
                                                <td style="width: 20px;"><?php echo $chars[18]; ?></td>
                                            </tr>
                                            </table>
                                        </span><br>
                                        <span>नाम / नाव </span><br>
                                        <span>Name : &nbsp; &nbsp;<?php echo $fetch->company_name;?></span><br>
                                        <span>टेलिफोन नं /मोबाइल नं.</span><br>
                                        <span>Tel. No./Mobile No.&nbsp; &nbsp;<?php echo $fetch->company_phone;?></span><br>
                                        <span>ई-मेल आईडी</span><br>
                                        <span>Email ID _____________________________________________________</span><br>
                                        <span>₹ शब्दो मे/ अक्षरी रक्कम :</span><br>
                                        <span>Rupees in words:</span>&nbsp;<span style="font-size:10px;"><?php echo  $this->CommenModel->convertToIndianCurrency($value['total']); ?></span>
                                        <span>
                                            <table border="1" width="100%" height="100px" cellpadding="0" cellspacing="0" style="border-color: #77d8ff;">
                                                <tr>
                                                    <td colspan="4" style="background-color:#4a9bbc;color:#fff">नगदी/ चेक सं. दिनांक एवं बँक व शाखा का नाम <br>
                                                        Cash/Cheque No. Date & Name of Bank & Branch
                                                    </td>
                                                    <td width="15%" style="background-color:#4a9bbc;color:#fff"><span>₹</span></td>
                                                    <td width="15%" style="background-color:#4a9bbc;color:#fff"><span><center>पैसे<br> P.</center></span></td>
                                                </tr>
                                                <tr>
                                                    <td width="50%" style="padding-left:5px;font-size:10px;"><b>Cheque No.<?php echo $value['cno']; ?> </b></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo $value['total']; ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left:5px;font-size:10px;"><?php echo ucwords($value['cname']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right;padding-right:10px;">एकूण /कुल/ Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="font-size:12px;padding-left:5px;"><b><?php echo $value['total']; ?></b></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </span><br>
                                        <span>
                                            <table border="0" cellpadding="0" cellpacing="0">
                                                <tr> 
                                                    <td style="border:1px solid #4a9bbc; width:41%;font-size:7px;">
                                                        ट्रँजॅकशन आईडी <br>
                                                        Transaction ID<br>
                                                        एसडब्लूओ  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;पारितकर्ता अधिकारी<br>
                                                        SWO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Passing Officer

                                                    </td>
                                                    <td>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="190px";>
                                                            <tr><td style="height:20px"></td></tr>
                                                            <tr>
                                                                <td style="margin_bottom:0;text-align:right;font-size:7px;"> जमा करणार / जमाकर्ता के हस्ताक्षर / Signature of Depositor </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </page>           
        <?php 
                }
            }
        }
        ?>
        <script>
            function doPrint() 
            {
                setTimeout(function(){window.close();},5000);
                window.print();            
                setTimeout(function(){document.location.href = "<?php echo site_url('PrintChequeSlip');?>"},5000);
            }
            window.onload = doPrint;
        </script>
    </body>
</html>