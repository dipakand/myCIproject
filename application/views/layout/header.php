<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title;?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <style>
            .size{
                font-size: 25px;
                margin-top: 6px;
            }
            /*.glyphicon-zoom-in {
            color:initial;
            }*/
            /*.role{
            color:dodgerblue;
            }*/
            /*.margin_tp_btm
            {
            margin: 5% 0px;
            }*/
        </style>
        <style>
            .ui-autocomplete{
                cursor : pointer;
                height: 200px;
                overflow-y: scroll;
            }
        </style>
        <link href="<?php echo site_url();?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo site_url();?>/assets/css/simple-sidebar.css" rel="stylesheet">
        <link href="<?php echo site_url();?>/assets/css/jquery-ui.min.css" rel="stylesheet">
        <script src="<?php echo site_url();?>/assets/js/jquery.min.js"></script>

        <!--        <script src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default no-margin"> 
                <div class="navbar-header fixed-brand">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                        <span class="glyphicon glyphicon-th-large" style="color:#fff;" aria-hidden="true"></span>
                    </button>
                    <a class="navbar-brand hidden-sm hidden-xs" href="#"><i class=""></i> <img src="<?php echo base_url().'/uploads/'.$company_row->logo_image; ?>" class=" img-rounded" style="margin-top:-7.5%; width: 180px;height: 50px;" /></a><!--width: 180px;-->

                    <a class="navbar-brand hidden-lg hidden-md" href="#"><i class=""></i><img src="<?php echo base_url().'/uploads/'.$company_row->logo_image; ?>" class=" img-rounded" style="margin-top:-4%; width: 100px;height: 35px;" /></a><!--width: 180px;-->

                    <div class="hidden-lg hidden-md hidden-sm " style="padding-top:3.5%; font-size:15px; text-align: center;color:#fff;">
                        <b><?php echo strtoupper($company_row->company_name); ?></b>
                        <span style="font-size: 10px;color:#fff;"><?php //echo strtoupper($_SESSION['sess_username']);?>&nbsp;<strong class="role">[<?php //echo strtoupper($_SESSION['sess_userrole']);?>]</strong></span>
                    </div>
                </div>
                <!-- navbar-header-->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <a style="font-size: 35px;font-weight: 900;text-decoration: none;padding-top: 13px;color:#fff;" href="#"><?php echo strtoupper($company_row->company_name); ?></a>
                    <a style="float:right;font-size: 18px;font-weight: 900;color: #F96332;text-decoration: none;padding-top: 13px; z-index:100;" class="glyphicon glyphicon-off" href="<?php echo site_url('/logout');?>"></a>
                    <ul class="nav navbar-nav">
                        <li class="active" >
                            <!--<button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> 
<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
</button>-->
                            <span class="navbar-toggle collapse in glyphicon glyphicon-th-large" style="color:#fff;" data-toggle="collapse" id="menu-toggle-2" aria-hidden="true"></span>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a style="margin-right: 20px; color:#fff;" href="" title="Change Password"><span class="glyphicon glyphicon-user">&nbsp;Welcome&nbsp;</span></a> </li>
                    </ul>
                </div>
            </nav>

        </header>
        <div id="wrapper">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                    <?php 
                    $addr = $this->uri->segment(1);
                    $dashboard = array('Dashboard');
                    $company = array('company','companyEdit');
                    $manag_user = array('userList','executiveList');
                    $ManageProduct = array('ProductAdd', 'ProductView', 'brandAdd', 'brandView', 'brandEdit','ProductEdit','EditDesc');
                    $MangeParty = array('PartyAdd','PartyView','PartyEdit');
                    $MangeVendor = array('VendorAdd','VendorView','VendorEdit');
                    $Sale = array('Sale','SaleController','AllSales','EditSales','CODUpdate','SaleView','PendingList','PartyChange','ReceiveMain','ReceivePayment','Receipts','ReturnProduct','CancelSale','SaleSummeray','SaleExecutive','CollectionFormat','EditTempSale');

                    $PurchaseOrder = array('PurchaesOrder','ManageOrder','ViewPurchaseOrder','ReceiveOrder','PaymentReceiveOrder','PurchaseSummary','ItemWisePurchaesSummary');
                    $gstReport = array('PurchaseRegister','SalesRegister','SummaryB2B','SummaryB2CS');
                    $stockreport = array('ProductReport','ProductStock','SalesProduct');
                    $specialreturn = array('SpecialReturn');
                    $broadcast = array('PartySMS','VendorSMS');
                    $ledger = array('PartyLedger','VendorLedger');
                    $voucher = array('GeneratVoucher','ViewVoucher');
                    $MonthSummary = array('MonthSummary');
                    $PaymentSummery = array('PaymentSummery');
                    $StockTransfer = array('StockTransfer');
                    $Order = array('Order','AllOrder','OrderEdit');
                    $PrintChequeSlip = array('PrintChequeSlip');
                    $StockCounter = array('StockCounter','AllStockCounter');
                    ?>
                    <!--<li class="<?php echo in_array($addr, $dashboard)? "active":""; ?>">
                        <a href="<?php echo site_url('/Dashboard');?>" ><i class="size glyphicon glyphicon-home pull-left"></i> Dashboard</a>
                    </li>-->
                    <li  class="<?php echo in_array($addr, $dashboard)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/Dashboard');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-home pull-left"></i><span class="showhide100" style="display:none;">&nbsp; Dashboard</span>&nbsp;</a>
                    </li>
                    <li class="<?php echo in_array($addr, $company)? "active":""; ?>">
                        <a href="<?php echo site_url('/company');?>" ><i class="size glyphicon glyphicon-asterisk pull-left" ></i> Caompany Master</a>
                    </li>
                    <li class="<?php echo in_array($addr, $manag_user)? "active":""; ?>">
                        <a href="<?php echo site_url('/userList');?>" ><i class="size glyphicon glyphicon-user pull-left" ></i> Manage Users</a>
                    </li>
                    <li class="<?php echo in_array($addr, $ManageProduct)? "active":""; ?>">
                        <a href="<?php echo site_url('/ProductAdd');?>" ><i class="size glyphicon glyphicon-th pull-left" ></i>Product Master</a>
                    </li>
                    <li class="<?php echo in_array($addr, $MangeParty)? "active":""; ?>">
                        <a href="<?php echo site_url('/PartyAdd');?>" ><i class="size glyphicon glyphicon-blackboard pull-left" ></i>Manage Party</a>
                    </li>
                    <li class="<?php echo in_array($addr, $MangeVendor)? "active":""; ?>">
                        <a href="<?php echo site_url('/VendorAdd');?>" ><i class="size glyphicon glyphicon-shopping-cart pull-left" ></i>Manage Vendor</a>
                    </li>
                    <li class="<?php echo in_array($addr, $Sale)? "active":""; ?>">
                        <a href="<?php echo site_url('/Sale');?>" ><i class="size glyphicon glyphicon-gift pull-left" ></i>Sale</a>
                    </li>
                    <li class="<?php echo in_array($addr, $PurchaseOrder)? "active":""; ?>">
                        <a href="<?php echo site_url('/PurchaesOrder');?>" ><i class="size glyphicon glyphicon-book pull-left" ></i>Generate Purchase order</a>
                    </li>
                    <li class="<?php echo in_array($addr, $gstReport)? "active":""; ?>">
                        <a href="<?php echo site_url('/PurchaseRegister');?>" ><i class="size glyphicon glyphicon-refresh pull-left" ></i>GST Report</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $stockreport)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/ProductReport');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-home pull-left"></i><span class="showhide100" style="display:none;">&nbsp; Stock Report</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $specialreturn)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/SpecialReturn');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-tasks pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Special Return</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $broadcast)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/PartySMS');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-send pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Broadcast</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $ledger)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/PartyLedger');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-random pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Ledger</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $voucher)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/GeneratVoucher');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-list pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Voucher</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $MonthSummary)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/MonthSummary');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-calendar pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Monthly Summery</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $PaymentSummery)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/PaymentSummery');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-usd pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Payment Summery</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $StockTransfer)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/StockTransfer');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-copy pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Stock Transfer</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $Order)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/Order');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-asterisk pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Order</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $PrintChequeSlip)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/PrintChequeSlip');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-align-center pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Print Cheque Slip</span>&nbsp;</a>
                    </li>
                    <li  class="<?php echo in_array($addr, $StockCounter)? "active":""; ?>" style="display: flex;">
                        <a href="<?php echo site_url('/StockCounter');?>" style="display: flex;" class="namewidth100"><i class="size glyphicon glyphicon-transfer pull-left"></i><span class="showhide100" style="display:none;">&nbsp;Stock Counter</span>&nbsp;</a>
                    </li>
                </ul>
            </div>
            <div id="page-content-wrapper">
                <div class="container-fluid xyz">
                    <div class="row">
                        <!--<div class="col-lg-12">
<h2>
<div class="alert alert-info text-center">
<a href="view_estimate.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-chevron-left"></i></a>
<b style="text-transform:capitalize;"><?php echo $head_name;?></b>
<a href="<?php echo site_url('/logout');?>" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-log-out"></i></a>
</div>
</h2>
</div>-->
                        <div class="col-lg-5">
                            <h3 style="margin-top: 0px;" >
                                <a href="<?php echo site_url('Dashboard');?>" class="pull-left "><i class="glyphicon glyphicon-chevron-left" style="color : #F96332;"></i></a>
                                <b style="color:#0D2747;"><?php echo $head_name;?></b>
                            </h3>
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <!--<div class="panel-heading">Panel Heading</div>-->
                                <div class="panel-body">
                                    <?php 
                                    if($this->session->flashdata('success')){
                                    ?>
                                    <div class="col-sm-12">

                                        <div id="success" class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php 
                                    if($this->session->flashdata('error')){
                                    ?>
                                    <div class="col-sm-12">

                                        <div id="error" class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-sm-12" style="display : none;" id="div_success">
                                        <div id="success" class="alert alert-success text-center"></div>
                                    </div>
                                    <div class="col-sm-12" style="display : none;" id="div_error">
                                        <div id="error" class="alert alert-danger text-center"></div>
                                    </div>
