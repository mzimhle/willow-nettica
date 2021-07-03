<!-- Start Content Table -->
<div class="content_table">
    <form name="htmlForm" id="htmlForm" action="/admin/shop/products/html.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Added</th>
        <th>Company Name</th>
		<th>Email</th>
		<th>Contact Number(s)</th>
		<th>Area</th>
       </tr>
	   <caption>Table: clients </caption>
      {foreach from=$clientItems item=item}
      <tr>
        <td align="left" class="alt">{$item.client_added|date_format}</td>		
        <td align="left" class="alt"><a href="/admin/shop/clientproduct/details.php?reference={$item.client_reference}">{$item.client_company}</a></td>	
		<td align="left" class="alt">{$item.client_contact_email}</td>
		<td align="left" class="alt">{$item.client_contact_cell|default:"N/A"} / {$item.client_contact_telephone|default:"N/A"}</td>
		<td align="left" class="alt">{$item.areaMap_shortPath}</td>
      </tr>
      {foreachelse}
    	<tr>
        	<td colspan="9">There are no current items in the system.</td>
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