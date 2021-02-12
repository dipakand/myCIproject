<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/ 
$route['default_controller'] = 'UserController';

//users
$route['login'] = 'UserController/login';
$route['logout'] = 'UserController/logout';
$route['registration'] = 'UserController/register';

$route['session_menu'] = 'UserController/set_session';

//Dash Board
$route['Dashboard'] = 'DashboardController/dashboard';

//company
$route['company'] = 'CompanyController/view';
$route['companyEdit/(:num)'] = 'CompanyController/edit/$1';
//$route['subjects/(:num)/{:any}'] = 'subjects/view/$1/$2';

//Manage User
$route['userList'] = 'ManageUserController/userList';
$route['deleteUser/(:num)'] = 'ManageUserController/userDelete';
$route['activeDeactive/(:num)/(:any)'] = 'ManageUserController/active_deactive/$1/$2';
$route['executiveList'] = 'ManageUserController/exeList';
$route['delete_exe/(:num)'] = 'ManageUserController/delete_exe';
//$route['subjects/(:num)/{:any}'] = 'subjects/view/$1/$2';

//Products
$route['ProductAdd'] = 'ProductController/productadd';
$route['ProductDesc'] = 'ProductController/productadddesc';
$route['AddProductDesc/(:num)'] = 'ProductController/addproductadddesc';
$route['subProductDelete/(:num)'] = 'ProductController/productRemove';
$route['subProductSave'] = 'ProductController/subProductSave';
$route['ProductView'] = 'ProductController/productview';
$route['ProductEdit/(:num)'] = 'ProductController/productedit/$1';
$route['EditDesc/(:num)'] = 'ProductController/edit_description/$1';
$route['deleteDesc/(:num)'] = 'ProductController/delete_description/$1';

$route['brandAdd'] = 'ProductController/addbrand';
$route['brandView'] = 'ProductController/viewbrand';
$route['brandEdit/(:num)'] = 'ProductController/editbrand/$1';
$route['branddelete/(:num)'] = 'ProductController/deletebrand/$1';

//Manage Party
$route['PartyAdd'] = 'PartyController/paryadd';
$route['PartyView'] = 'PartyController/paryview';
$route['PartyEdit/(:num)'] = 'PartyController/paryedit/$1';
$route['PartyDelete/(:num)'] = 'PartyController/parydelete/$1';

//Manage Vendor
$route['VendorAdd'] = 'VendorController/vendorAdd';
$route['VendorView'] = 'VendorController/vendorView';
$route['VendorEdit/(:num)'] = 'VendorController/vendorEdit/$1';

//Sale Model
$route['Sale'] = 'SaleController/sale';
$route['AllSales'] = 'SaleController/allsale';
$route['PartyChange/(:num)'] = 'SaleController/party_change/$1';
$route['EditSales/(:num)'] = 'SaleController/edit_sale/$1';
$route['CODUpdate/(:num)'] = 'SaleController/cod_update/$1';
$route['SaleView/(:num)'] = 'SaleController/sale_view/$1';
$route['ReceiveMain/(:num)/(:any)'] = 'SaleController/receive_main/$/$2';
$route['ReceivePayment/(:num)'] = 'SaleController/receive_Payment/$1';
$route['Receipts/(:num)'] = 'Salecontroller/receipt_page/$1';
$route['ReceiptPrint/(:num)'] = 'Salecontroller/receipt_print/$1';
$route['ReturnProduct/(:num)'] = 'Salecontroller/return_product/$1';
$route['CancelSale/(:num)'] = 'Salecontroller/cancle_sale/$1';

$route['PendingList'] = 'SaleController/pending_list';
$route['PartyPendingList'] = 'SaleController/party_pending_list';
$route['SaleSummeray'] = 'SaleController/sale_summary';
$route['Transaction'] = 'SaleController/transaction';
$route['SaleExecutive'] = 'SaleController/sale_executive';
$route['EditTempSale/(:num)'] = 'SaleController/edit_temp_sale/$1';
$route['CollectionFormat'] = 'SaleController/collection_format';

//PUrchase Order
$route['PurchaesOrder'] = 'PurchaseController/purchase_order';
//$route['GeneratePurchaesOrder'] = 'PurchaseController/purchase_order';
$route['ManageOrder'] = 'PurchaseController/manage_order';
$route['ViewPurchaseOrder/(:num)'] = 'PurchaseController/view_purchase_order/$1';
$route['PrintPage/(:num)'] = 'PurchaseController/print_page/$1';
$route['ReceiveOrder/(:num)'] = 'PurchaseController/receive_order/$1';
$route['PaymentReceiveOrder/(:num)'] = 'PurchaseController/pament_receive/$1';
$route['CancelOrder/(:num)'] = 'PurchaseController/cancle_order/$1';
$route['ItemWiseCancel/(:num)'] = 'PurchaseController/item_wise_cancel/$1';
$route['EditOrder/(:num)'] = 'PurchaseController/edit_order/$1';

$route['HoldPurchaseOrder'] = 'PurchaseController/manage_hold_order';
$route['ProcessHoldOrder/(:num)'] = 'PurchaseController/process_hold_order/$1';
$route['PurchaseSummary'] = 'PurchaseController/purchase_summary';
$route['ItemWisePurchaesSummary'] = 'PurchaseController/itemwise_purchase_summary';

//Report
$route['PurchaseRegister'] = 'GSTReportController/purchase_register';
$route['SalesRegister'] = 'GSTReportController/sales_register';
$route['SummaryB2B'] = 'GSTReportController/summary_b2b';
$route['SummaryB2CS'] = 'GSTReportController/summary_b2cs';

$route['ProductReport'] = 'StockRportController/product_report';
$route['ProductStock'] = 'StockRportController/product_stock';
$route['SalesProduct'] = 'StockRportController/view_sales_product';

//Speial return
$route['SpecialReturn'] = 'SpecialReturnController/special_return';

//broadcast
$route['PartySMS'] = 'BroadcastController/party_sms';
$route['VendorSMS'] = 'BroadcastController/vendor_sms';

//ledger
$route['PartyLedger'] = 'LedgerController/party_ledger';
$route['VendorLedger'] = 'LedgerController/vendor_ledger';

//voucher
$route['GeneratVoucher'] = 'VoucherController/generat_voucher';
$route['ViewVoucher'] = 'VoucherController/view_voucher';

//Month Summary
$route['MonthSummary'] ='MonthSUmmaryController/month_summary';

//PaymentSummery
$route['PaymentSummery'] = 'PaymentSummeryController/payment_summery';

//StockTransfer
$route['StockTransfer'] = 'StockTransferController/stock_transfer';

//Order
$route['Order'] = 'OrderController/order';
$route['AllOrder'] = 'OrderController/view_order';
$route['OrderEdit/(:num)'] = 'OrderController/edit_order/$1';

//Print Cheque Slip
$route['PrintChequeSlip'] = 'PrintChequeSlipController/print_cheque_slip';
$route['Slip'] = 'PrintChequeSlipController/print_slip';

//Stock Counter
$route['StockCounter'] = 'StockCounterController/stock_counter';
$route['AllStockCounter'] = 'StockCounterController/all_stock_counter';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
