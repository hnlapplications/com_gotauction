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

	<div>
		<?php
			$url = JUri::base() . 'media/com_gotauction/css/style.css';
			$document = JFactory::getDocument();
			$document->addStyleSheet($url);
			require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/gotauction.php';
			GotauctionHelper::getMenu();
		?>
	</div>

	<h1>Auctions</h1>
	<?php
		echo $this->addToolbar();
	?>
	<div id="j-main-contaner">
	<form action='<?php echo JRoute::_('index.php?option=com_gotauction&view=auctions'); ?>' method="POST" id="adminForm" name="adminForm">
		
		
		
		
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
		<input type = "hidden" name = "option" value = "com_gotauction" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		
	</form>
	<div class="clearfix"></div>
	
	<!-- LIST OUTPUT-->
	
	<div class="table auction-table" id="auctionList">

			<ul class = "auctioneerList">
				<?php foreach($this->items as $item): ?>
					
					<li class="grid_auction">
						<table width = "100%">
							<tr>
								<td width = "50%"><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auction&layout=default&id=" . $item->id); ?>"><strong><?php echo $item->title; ?></strong><br /></a></td>
								<td width = "50%">Auction ID: <strong><?php echo "#_" . $item->auction_id; ?></strong></td>
							</tr>
							<tr>
								<td>
									<?php $images=$this->getImages($item->id); //echo "<pre>" . print_r($images, true) . "</pre>"; 
									 
										$count = count($images); 
										$count--;
										$rand = 0;
									?>
									<table>
										<tr>
											<td>
												<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
													<img src = "<?php echo JUri::base() . "images/com_gotauction/lots/" . $images[0]; ?>" class = "big" />
												</a>
											</td>
										</tr>
										
									</table>
									
									
								</td>
								<td>
									<ul class = "listDetails">
										<li> Category: <strong><?php echo $item->auction_category_title; ?></strong> </li>
										<li> Type: <strong><?php echo $item->auction_type_title; ?></strong> </li>
										<li> Date: <strong><?php echo $item->date; ?></strong> </li>
										<li> Time: <strong><?php echo $item->time; ?></strong> </li>
										<li> Viewing Date: <strong><?php echo $item->viewing_date; ?></strong> </li>
										<li> Viewing Time: <strong><?php echo $item->viewing_time; ?></strong> </li>
										<li> Address: <strong><?php echo $item->address; ?></strong> </li>
										<li> GPS Coordinates: <strong><?php echo $item->address; ?></strong> </li>
										<li> Description: <strong><?php echo $item->description; ?></strong> </li>
										<li> Auctioneer: <a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auctioneer&layout=default&id=" . $item->auctioneer); ?>"><strong><?php echo $item->auctioneer_name; ?></strong></a> </li>
									</ul>
								</td>
							</tr>
						</table>
						<table width = "100%">
							<tr>
								<td width = "75%">
									<?php for($i = 0; $i < 4; $i++) : ?>
										<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
											<img src = "<?php $rand = rand(0, $count); echo JUri::base() . "images/com_gotauction/lots/" . $images[$rand]; ?>" class = "small" />
										</a>
									<?php endfor; ?>
								</td>
								<td>
									<ul class = "listDetails">
										<li><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauction&layout=edit&id=" . $item->id); ?>">Edit Auction</a> </li>
										<li><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auction&layout=default&id=" . $item->id); ?>">View Auction</a> </li>
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
	</div> <!-- end j-main-container -->
</form>
