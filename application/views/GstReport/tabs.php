<?php  $page = $this->uri->segment(1);?>
   <ul class="nav nav-justified nav-pills">
    <li class="<?php echo $page == 'PurchaseRegister' ? 'active' : ''; ?>"><a href="<?php echo site_url('PurchaseRegister');?>">GSTR2 (Purchase)</a></li>
    <li class="<?php echo $page == 'SalesRegister' ? 'active' : ''; ?>"><a href="<?php echo site_url('SalesRegister');?>">Sales Register</a></li>
    <li class="<?php echo $page == 'SummaryB2B' ? 'active' : ''; ?>"><a href="<?php echo site_url('SummaryB2B');?>">Summary B2B</a></li>
    <li class="<?php echo $page == 'SummaryB2CS' ? 'active' : ''; ?>"><a href="<?php echo site_url('SummaryB2CS');?>">Summary B2CS</a></li>
</ul>