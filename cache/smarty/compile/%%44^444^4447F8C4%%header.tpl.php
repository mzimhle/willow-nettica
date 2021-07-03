<?php /* Smarty version 2.6.20, created on 2014-04-22 09:17:45
         compiled from admin/includes/header.tpl */ ?>
<div class="hide-btn top tip-s" original-title="Close sidebar"></div>
<div class="hide-btn center tip-s" original-title="Close sidebar"></div>
<div class="hide-btn bottom tip-s" original-title="Close sidebar"></div>
<div id="top">
	<h1 id="logo"><a href="/admin/"></a></h1>
	<div id="labels">
		<ul>
			<li><a href="#" class="user"><span class="bar">Welcome <?php echo $this->_tpl_vars['userData']['administrator_name']; ?>
 <?php echo $this->_tpl_vars['userData']['administrator_surname']; ?>
 </span></a></li>
			<li><a href="/admin/logout.php" class="logout"></a></li>
		</ul>
	</div>
	<div id="menu">
		<ul> 
			<li <?php if ($this->_tpl_vars['currentPage'] == ''): ?>class="current"<?php endif; ?>><a href="/admin/">Dashboard</a></li>
			<?php if ($this->_tpl_vars['userData']['administrator_type'] == 'SU'): ?>
			<li <?php if ($this->_tpl_vars['currentPage'] == 'clients'): ?>class="current"<?php endif; ?>><a href="/admin/clients/">Clients</a> </li> 
			<!-- <li <?php if ($this->_tpl_vars['currentPage'] == 'domains'): ?>class="current"<?php endif; ?>><a href="/admin/domains/">Domains</a></li> -->
			<li <?php if ($this->_tpl_vars['currentPage'] == 'accounts'): ?>class="current"<?php endif; ?>><a href="/admin/accounts/">Accounts</a></li>
			<!-- <li <?php if ($this->_tpl_vars['currentPage'] == 'products'): ?>class="current"<?php endif; ?>><a href="/admin/products/">Products</a></li> -->
			<li <?php if ($this->_tpl_vars['currentPage'] == 'archive'): ?>class="current"<?php endif; ?>><a href="/admin/archive/">Archive</a></li>
			<li <?php if ($this->_tpl_vars['currentPage'] == 'invoices'): ?>class="current"<?php endif; ?>><a href="/admin/invoices/">Invoices</a></li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['userData']['administrator_type'] == 'NE'): ?>
			<li <?php if ($this->_tpl_vars['currentPage'] == 'newsletters'): ?>class="current"<?php endif; ?>><a href="/admin/newsletters/">Newsletters</a></li>
			<li <?php if ($this->_tpl_vars['currentPage'] == 'archive'): ?>class="current"<?php endif; ?>><a href="/admin/archive/">Archive</a></li>
			<li <?php if ($this->_tpl_vars['currentPage'] == 'enquiries'): ?>class="current"<?php endif; ?>><a href="/admin/enquiries/">Enquiries</a></li>
			<?php endif; ?>
		</ul>
	</div>
</div>