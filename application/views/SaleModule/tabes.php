<?php 
$active_tab = $this->uri->segment(1);
?>
   <ul class="nav nav-justified nav-pills">
    <li class="<?php echo $active_tab == 'Sale' ? 'active' : ''; ?>"><a href="<?php echo site_url('Sale');?>">New Sale</a></li>
    <li class="<?php echo $active_tab == 'AllSales' ? 'active' : ''; ?>"><a href="<?php echo site_url('AllSales');?>">View All Sales</a></li>
    <li class="<?php echo $active_tab == 'PendingList' ? 'active' : ''; ?>"><a href="<?php echo site_url('PendingList');?>">Pending List</a></li>
    <li class="<?php echo $active_tab == 'SaleSummeray' ? 'active' : ''; ?>"><a href="<?php echo site_url('SaleSummeray');?>">Sales Summary</a></li>
    <li class="<?php echo $active_tab == 'Transaction' ? 'active' : ''; ?>"><a href="<?php echo site_url('Transaction');?>">Transaction</a></li>
    <li class="<?php echo $active_tab == 'SaleExecutive' ? 'active' : ''; ?>"><a href="<?php echo site_url('SaleExecutive');?>">Sale Executive</a></li>
    <li class="<?php echo $active_tab == 'CollectionFormat' ? 'active' : ''; ?>"><a href="<?php echo site_url('CollectionFormat');?>">Collection Format</a></li>
</ul>