<?php

defined("_JEXEC") or die();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

	// import joomla's filesystem classes
	//jimport('joomla.filesystem.folder');
				
JHtml::_('bootstrap.framework');
JHtml::_('script', 'system/core.js', false, true);
$document = JFactory::getDocument();

$listOrder=$this->escape($this->state->get('list.ordering'));
$listDirn=$this->escape($this->state->get('list.direction'));

$sortFields=$this->getSortFields();

$canEdit=JFactory::getUser()->authorise('core.edit', 'com_gotauction');

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
<div class = "gotAuctionContainer">
	<div id = "componentMenu">
		<?php
			$url = JUri::base() . 'media/com_gotauction/css/style.css';
			$document = JFactory::getDocument();
			$document->addStyleSheet($url);
			require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/gotauction.php';
			GotauctionHelper::getMenu();
			GotauctionHelper::setCSS();
		?>
	</div>

	<div class = "componentContentHeader">
		<div class = "pageHeading">
			<h1>Auctioneers</h1>
		</div>
		<div class = "subMenu">
			<?php
				echo $this->addToolbar();
			?>
		</div>
	</div>
	
	<form action='<?php echo JRoute::_('index.php?option=com_gotauction&view=auctioneers'); ?>' method="POST" id="adminForm" name="adminForm">
		
			<!--------------- ORDERING STUFFS ------------------------>
		<div class = "ordering">
		<table style="width:100%;">
			<tr style="border-top:1px solid">
				<td style="padding-top: 15px;">
					<strong>Search</strong>
					<input type="text" name="filter_search" id="filter_search" placeholder="Search..." value="<?php echo $this->escape($this->state->get('filter.search'));?>" title="Search" />
					<button class="button btn-primary btn-lg"  onclick="this.form.submit()">Search</button>
					<button class="button btn-primary btn-lg"  onclick="jQuery('#filter_search').val(''); this.form.submit()">Clear Search</button> 
				</td>
				<td rowspan = "2" style="padding-top: 15px;">
					
						<strong>Sorting</strong>
						<br />
						<select name="sortTable" class="input-medium" id="sortTable" onchange="Joomla.orderTable()">
							<option value="">
								<?php echo JText::_('JGLOBAL_SORT_BY');?>
							</option>
							<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
						</select>
						<br />
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
					
				</td>
			</tr>
			<tr>
				<td>
					<div class="btn-group">
						<!-- Pagination -->
						<label for="limit" class="">
							<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC') . " " . $this->pagination->getLimitBox();; ?>
						</label>
						
					<!-- end pagination -->
					</div>
				</td>
			</tr>
		</table>
		</div>
		<!--------------- END ORDERING STUFFS -------------------->
		
		<input type = "hidden" name = "task" value = "" />
		<input type = "hidden" name = "option" value = "com_gotauction" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		
	</form>
	
	<!-- LIST OUTPUT-->
	
	<div class="table auctioneerList">

			<ul class = "auctioneerList">
			<?php foreach($this->items as $item): ?>
				
				<li class="grid_auctioneer">
					<table width = "100%">
						<tr>
							
							<td>
								<?php if ($canEdit) :?>
								<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
								<?php endif; ?>
									<img src = "<?php echo JUri::base() . "/" . $item->profile_image; ?>" class = "profileSmall" />
								<?php if ($canEdit): ?>
								</a>
								<?php endif; ?>
							</td>
							<td class = "contentLinks">
								<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auctions&layout=default&auctioneer_id=" . $item->id); ?>">View Auctions</a> 
								<br /><br />
							<?php if ($canEdit): ?> 
							
								<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">Edit Auctioneer</a> 
							</td> <?php endif; ?>
							
						</tr>
						<tr>
							<td colspan = "2">
								<ul class = "listDetails">
									<li class = "contentLinks"> Name: <a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auctioneer&layout=default&id=" . $item->id); ?>"><strong><?php echo $item->name; ?></strong></a> </li>
									<li> Tel No: <strong><?php echo $item->contact_no; ?></strong> </li>
									<li> Company: <strong><?php echo $item->company; ?></strong> </li>
									<li> Email: <strong><?php echo $item->email; ?></strong> </li>
									
								</ul>
							</td>
						</tr>
					</table>
					
					
				</li>
			<?php endforeach; ?>
			</ul>
		
		<?php echo $this->pagination->getListFooter(); ?>
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	<!-- END LIST OUTPUT -->
</div> <!-- gotAuctionContainer -->
</form>
