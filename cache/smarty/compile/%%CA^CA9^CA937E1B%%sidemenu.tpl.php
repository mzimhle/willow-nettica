<?php /* Smarty version 2.6.20, created on 2014-04-22 09:17:45
         compiled from admin/includes/sidemenu.tpl */ ?>
<div class="box togglemenu">
	<div class="content">
		<ul>
			<li><h2>Menu</h2></li>
			<?php if ($this->_tpl_vars['userData']['administrator_type'] == 'SU'): ?>
			<li class="title">Clients</li>
			<li class="content">
				<ul>
					<li>Companies</li>
					<li>
						<ul>
							<li><a href="/admin/clients/companies/">List</a></li>
							<li><a href="/admin/clients/companies/details.php">Add</a></li>
						</ul>					
					</li>					
				</ul>
			</li>
			<li class="title">Domains</li>
			<li class="content">
				<ul>
					<li>Websites</li>
					<li>
						<ul>
							<li><a href="/admin/domains/websites/">List</a></li>
							<li><a href="/admin/domains/websites/details.php">Add</a></li>
						</ul>					
					</li>
				</ul>
			</li>
			<li class="title">Products</li>
			<li class="content">
				<ul>
					<li>Product Items</li>
					<li>
						<ul>
							<li><a href="/admin/products/items/">List</a></li>
							<li><a href="/admin/products/items/details.php">Add</a></li>
						</ul>
					</li>
					<li><a href="/admin/products/clientproducts/">Client Products</a></li>
				</ul>
			</li>
			<li class="title">Accounts</li>
			<li class="content">
				<ul>
					<li>Login</li>
					<li>
						<ul>
							<li><a href="/admin/accounts/logins/">List</a></li>
							<li><a href="/admin/accounts/logins/details.php">Add</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="title">Archive</li>
			<li class="content">				
				<ul>
					<li>Services</li>
					<li>
						<ul>
							<li><a href="/admin/archive/services/">List  Services</a></li>
							<li><a href="/admin/archive/services/details.php">Add a Service</a></li>
						</ul>
					</li>
				</ul>
				<ul>
					<li>Documents</li>
					<li>
						<ul>
							<li><a href="/admin/archive/documents/">List documents</a></li>
							<li><a href="/admin/archive/documents/details.php">Add a document</a></li>
						</ul>					
					</li>					
				</ul>	
				<ul>
					<li><a href="/admin/archive/calendar/">Calendar</a></li>				
				</ul>	
				<ul>
					<li>Scrape</li>
					<li>
						<ul>
							<li><a href="/admin/archive/scrape/">Spam</a></li>
							<li><a href="/admin/archive/scrape/details.php">Add a spam</a></li>
						</ul>					
					</li>					
				</ul>					
			</li>
			<li class="title">Invoices</li>
			<li class="content">
				<ul>
					<li><a href="/admin/invoices/paid/">Paid</a></li>
					<li><a href="/admin/invoices/unpaid/">Not Paid</a></li>
					<li><a href="/admin/invoices/create/">Create an invoice</a></li>
				</ul>
			</li>
			<li class="title">Newsletters</li>	
			<li class="content">
				<ul>
					<li><a href="/admin/newsletters/">Newsletter Pages</a></li>
					<li><a href="/admin/newsletters/details.php">Newsletter Add Page</a></li>
					<li><a href="/admin/newsletters/subscribers/">Newsletter Subscribers</a></li>
					<li><a href="/admin/newsletters/subscribers/details.php">Newsletter Add Subscriber</a></li>
				</ul>
			</li>
			<li class="title">Enquiries</li>	
			<li class="content">
				<ul>
					<li><a href="/admin/enquiries/">View Enquiries</a></li>
				</ul>
			</li>			
			<?php endif; ?>
			<?php if ($this->_tpl_vars['userData']['administrator_type'] == 'NE'): ?>
			<li class="title">Newsletters</li>	
			<li class="content">
				<ul>
					<li><a href="/admin/newsletters/">Newsletter Pages</a></li>
					<li><a href="/admin/newsletters/details.php">Newsletter Add Page</a></li>
					<li><a href="/admin/newsletters/subscribers/">Newsletter Subscribers</a></li>
					<li><a href="/admin/newsletters/subscribers/details.php">Newsletter Add Subscriber</a></li>
				</ul>
			</li>
			<li class="title">Enquiries</li>	
			<li class="content">
				<ul>
					<li><a href="/admin/enquiries/">View Enquiries</a></li>
				</ul>
			</li>
			<li class="title">Archive</li>
			<li class="content">
				<ul>
					<li>Documents</li>
					<li>
						<ul>
							<li><a href="/admin/archive/documents/">List documents</a></li>
							<li><a href="/admin/archive/documents/details.php">Add a document</a></li>
						</ul>					
					</li>					
				</ul>	
				<ul>
					<li><a href="/admin/archive/calendar/">Calendar</a></li>				
				</ul>					
			</li>			
			<?php endif; ?>
		</ul>
	</div>
</div>