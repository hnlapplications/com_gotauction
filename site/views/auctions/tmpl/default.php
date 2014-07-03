<?php

defined("_JEXEC") or die();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


JHtml::_('bootstrap.framework');
JHtml::_('script', 'system/core.js', false, true);
$document = JFactory::getDocument();

$listOrder=$this->escape($this->state->get('list.ordering'));
$listDirn=$this->escape($this->state->get('list.direction'));

$sortFields=$this->getSortFields()

?>
<script type="text/javascript">
	/************ Joomla! functions **************************/
	
	Joomla.orderTable=function()
	{
		table=document.getElementById("sortTable");
		direction=document.getElementById("directionTable");
		order=table.options[table.selectedIndex].value;
		if (order !='<?php echo $listOrder; ?>')
		{
			dirn='asc';
		}
		else
		{
			dirn=direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
	
	/************ END Joomla! functions **********************/
	
	
	
	
</script>


	<h1>Auctions</h1>
	<?php
		echo $this->addToolbar();
	?>
	<div id="j-main-contaner">
	<form action="<?php echo JRoute::_('index.php?option=com_gotauction&view=auctions'); ?>" method="POST" id="adminForm" name="adminForm">
		
		
		
		
		<table style="width:100%">
			<tr style="border-top:1px solid">
				<td style="padding-top:5px; text-align:center;" colspan='2'>
					<div style='width:50%; margin-left:auto; margin-right:auto;'>
						<strong>Search</strong>
						<input type="text" name="filter_search" id="filter_search" placeholder="Search..." value="<?php echo $this->escape($this->state->get('filter.search'));?>" title="Search" />
						<button class="button btn-primary btn-lg" style="float:right; width:auto;" onclick="this.form.submit()">Search</button>
						<button class="button btn-primary btn-lg" style="float:right;  width:auto;" onclick="jQuery('#filter_search').val(''); this.form.submit()">Clear Search</button> 
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!--------------- ORDERING STUFFS ------------------------>
					<div class="gw_ordering" style="text-align:center;">
						
						<div class="btn-group">
							<strong>Sorting</strong>
							<select name="sortTable" class="input-medium" id="sortTable" onchange="Joomla.orderTable()">
								<option value="">
									<?php echo JText::_('JGLOBAL_SORT_BY');?>
								</option>
								<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
							</select>			
							<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable();">
								<option value="">
									<?php echo JText::_('COM_GOTAUCTION_ORDERING');?>
								</option>
								<option value="asc" <?php if ($listDirn=='asc') echo 'selected="selected"';?>>
									<?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?>
								</option>
								<option value="desc" <?php if ($listDirn=='desc') echo 'selected="selected"';?>>
									<?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?>
								</option>
							</select>
							<!-- Pagination -->
							<label for="limit" class="">
								<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?>
							</label>
							<?php echo $this->pagination->getLimitBox(); ?>
						<!-- end pagination -->
						</div>
						
					</div>
					
				</td>
			</tr>
		</table>
		
		
		
		
		
		
		<!--------------- END ORDERING STUFFS -------------------->
		
		<input type = "hidden" name = "task" value = "" />
		<input type = "hidden" name = "option" value = "com_gottodo" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		
	</form>
	<div class="clearfix"></div>
	
	<!-- LIST OUTPUT-->
	
	<div class="table auction-table" id="auctionList">

			<?php foreach($this->items as $item): ?>
				<div class="grid_auction">
					img<br />
					<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auction&layout=default&id=" . $item->id); ?>"><strong><?php echo $item->title; ?></strong><br /></a>
					<?php echo $item->date . ' @ ' . $item->time; ?>
				</div>
			<?php endforeach; ?>
		
		
		<?php echo $this->pagination->getListFooter(); ?>
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	<!-- END LIST OUTPUT -->
	</div> <!-- end j-main-container -->
</form>
