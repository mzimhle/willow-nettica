<!-- Start Content Table -->
<div class="content_table">
    <form name="htmlForm" id="htmlForm" action="/admin/shop/invoices/html.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Added</th>
		<th>Invoice Reference</th>
        <th>Client</th>
		<th>Payment Date</th>
		<th>Send to Client Date</th>
		<th>Invoice Paid</th>
		<th>Download Invoice</th>
       </tr>
	   <caption>Table: clients </caption>
      {foreach from=$invoiceItems item=item}
      <tr>
        <td align="left" class="alt">{$item.invoice_added|date_format}</td>		
        <td align="left" class="alt"><a href="/admin/shop/invoices/details.php?reference={$item.invoice_reference}">{$item.invoice_reference}</a></td>	
		<td align="left" class="alt">{$item.client_company}</td>
		<td align="left" class="alt">{$item.client_payment_date|date_format}</td>
		<td align="left" class="alt">{$item.invoice_send_to_client|date_format}</td>
		<td align="left" class="alt">{if $item.invoice_paid eq 1}<span style="color: green;">Paid</span>{else}<span style="color: red;">Not Paid</span>{/if}</td>
		<td align="left" class="alt"><a href="{$item.invoice_file}" target="_blank">Download Invoice</a></td>
      </tr>
      {foreachelse}
    	<tr>
        	<td colspan="7">There are no current items in the system.</td>
        </tr>
      {/foreach}     
    </table>
     </form>
 </div>
 <!-- End Content Table -->

{if $paginator->firstPageInRange neq $paginator->lastPageInRange}
 <!-- Start Pagination --><br />
<div class="paging">
     <ul class="pagination">
		   {if $paginator->current gt 1 }
			<li class="paginate_prev"><a href="javascript:void(0);" onclick="send_filter({$paginator->previous});">&laquo; Previous</a></li>
			{/if}
			 {foreach from=$paginator->pagesInRange item=page}
        		<li {if $page eq $paginator->current} class="active" {/if}><a href="javascript:void(0);" onclick="send_filter({$page});">{$page}</a></li>
       		{/foreach}
			{if $paginator->current lt $paginator->lastPageInRange}
			<li class="paginate_next"><a href="javascript:void(0);" onclick="send_filter({$paginator->next});">Next &raquo;</a></li>
			{/if}
	</ul>
</div>      
{/if}
      <div class="clear"></div>