<?php  $page = $this->uri->segment(1);?>
   <ul class="nav nav-justified nav-pills">
    <li class="<?php echo $page == 'ProductReport' ? 'active' : ''; ?>"><a href="<?php echo site_url('ProductReport');?>">Product Report</a></li>
<!--    <li class="<?php echo $page == 'SalesGraphp' ? 'active' : ''; ?>"><a href="<?php echo site_url('SalesGraphp');?>">Sales Graph</a></li>-->
<!--    <li class="<?php echo $page == 'BrandSales' ? 'active' : ''; ?>"><a href="<?php echo site_url('BrandSales');?>">Brand Sales Reports</a></li>-->
    <li class="<?php echo $page == 'ProductStock' ? 'active' : ''; ?>"><a href="<?php echo site_url('ProductStock');?>">Stock Reports</a></li>
    <li class="<?php echo $page == 'SalesProduct' ? 'active' : ''; ?>"><a href="<?php echo site_url('SalesProduct');?>">Sales Product</a></li>
</ul>