<?php  $page = $this->uri->segment(1);?>
   <ul class="nav nav-justified nav-pills">
    <li class="<?php echo $page == 'GeneratePurchaesOrder' ? 'active' : ''; ?>"><a href="<?php echo site_url('GeneratePurchaesOrder');?>">Generate PO</a></li>
    <li class="<?php echo $page == 'ManageOrder' ? 'active' : ''; ?>"><a href="<?php echo site_url('ManageOrder');?>">Manage PO</a></li>
    <li class="<?php echo $page == 'HoldPurchaseOrder' ? 'active' : ''; ?>"><a href="<?php echo site_url('HoldPurchaseOrder');?>">Hold PO</a></li>
    <li class="<?php echo $page == 'PurchaesOrder' ? 'active' : ''; ?>"><a href="<?php echo site_url('PurchaesOrder');?>">Direct PO</a></li>
    <li class="<?php echo $page == 'PurchaseSummary' ? 'active' : ''; ?>"><a href="<?php echo site_url('PurchaseSummary');?>">Purchase Summary</a></li>
    <li class="<?php echo $page == 'ItemWisePurchaesSummary' ? 'active' : ''; ?>"><a href="<?php echo site_url('ItemWisePurchaesSummary');?>">Itemwise Purchase Summary</a></li>
</ul>