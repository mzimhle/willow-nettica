<div id="top">
	<h1 id="logo"><a href="/admin/"></a></h1>
	<div id="labels">
		<ul>
			<li><a href="#" class="user"><span class="bar">Welcome {$userData.administrator_name} {$userData.administrator_surname} </span></a></li>
			<li><a href="/admin/logout.php" class="logout"></a></li>
		</ul>
	</div>
	<div id="menu">
		<ul> 
			<li {if $currentPage eq ''}class="current"{/if}><a href="/admin/">Dashboard</a></li>
			{if $userData.administrator_type eq 'SU'}
			<li {if $currentPage eq 'clients'}class="current"{/if}><a href="/admin/clients/">Clients</a> </li> 
			<!-- <li {if $currentPage eq 'domains'}class="current"{/if}><a href="/admin/domains/">Domains</a></li> -->
			<li {if $currentPage eq 'accounts'}class="current"{/if}><a href="/admin/accounts/">Accounts</a></li>
			<!-- <li {if $currentPage eq 'products'}class="current"{/if}><a href="/admin/products/">Products</a></li> -->
			<li {if $currentPage eq 'archive'}class="current"{/if}><a href="/admin/archive/">Archive</a></li>
			<li {if $currentPage eq 'invoices'}class="current"{/if}><a href="/admin/invoices/">Invoices</a></li>
			{/if}
			{if $userData.administrator_type eq 'NE'}
			<li {if $currentPage eq 'newsletters'}class="current"{/if}><a href="/admin/newsletters/">Newsletters</a></li>
			<li {if $currentPage eq 'archive'}class="current"{/if}><a href="/admin/archive/">Archive</a></li>
			<li {if $currentPage eq 'enquiries'}class="current"{/if}><a href="/admin/enquiries/">Enquiries</a></li>
			{/if}
		</ul>
	</div>
</div>