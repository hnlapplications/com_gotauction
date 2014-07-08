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
	<div>
		<?php
			//$urlImgs = JUri::base() . 'media/com_gotauction/css/style.css';
			$urlCSS = JUri::base() . 'media/com_gotauction/css/style.css';
			$document = JFactory::getDocument();
			$document->addStyleSheet($urlCSS);
			require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/gotauction.php';
			GotauctionHelper::getMenu();
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
	
	<div id="j-main-contaner">
	<form action='<?php echo JRoute::_('index.php?option=com_gotauction&view=auctioneers'); ?>' method="POST" id="adminForm" name="adminForm">
		
		<!--------------- ORDERING STUFFS ------------------------>
		<table style="width:100%">
			<tr style="border-top:1px solid">
				<td style="padding-top:5px;" colspan='2'>
					<strong>Search</strong>
					<input type="text" name="filter_search" id="filter_search" placeholder="Search..." value="<?php echo $this->escape($this->state->get('filter.search'));?>" title="Search" />
					<button class="button btn-primary btn-lg"  onclick="this.form.submit()">Search</button>
					<button class="button btn-primary btn-lg"  onclick="jQuery('#filter_search').val(''); this.form.submit()">Clear Search</button> 
				</td>
				<td>
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
					</div>
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
		<!--------------- END ORDERING STUFFS -------------------->
		
		<input type = "hidden" name = "task" value = "" />
		<input type = "hidden" name = "option" value = "com_gotauction" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		
	</form>
	<div class="clearfix"></div>
	
	<!-- LIST OUTPUT-->
	
	<div class="table auctioneer-table" id="auctioneerList">

			<ul class = "auctioneerList">
			<?php foreach($this->items as $item): ?>
				
				<li class="grid_auctioneer">
					<table width = "100%">
						<tr>
							<td width = "70%">
								<ul class = "listDetails">
									<li> Name: <a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auctioneer&layout=default&id=" . $item->id); ?>"><strong><?php echo $item->name; ?></strong></a> </li>
									<li> Tel No: <strong><?php echo $item->contact_no; ?></strong> </li>
									<li> Company: <strong><?php echo $item->company; ?></strong> </li>
									<li> Email: <strong><?php echo $item->email; ?></strong> </li>
									
								</ul>
							</td>
							<td>
								<?php if ($canEdit) :?>
								<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
								<?php endif; ?>
									<img src = "<?php echo JUri::base() . "/" . $item->profile_image; ?>" class = "profileSmall" />
								<?php if ($canEdit): ?>
								</a>
								<?php endif; ?>
							</td>
						</tr>
						<tr class = "contentLinks">
							<td><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auctions&layout=default&auctioneer_id=" . $item->id); ?>">View Auctions</a> </td>
							<?php if ($canEdit): ?> <td><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">Edit</a> </td> <?php endif; ?>
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
	</div> <!-- end j-main-container -->
</div> <!-- gotAuctionContainer -->
</form>
