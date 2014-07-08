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
<div class = "gotAuctionContainer">
	<div id = "componentMenu">
		<?php
			$url = JUri::base() . 'media/com_gotauction/css/style.css';
			$document = JFactory::getDocument();
			$document->addStyleSheet($url);
			require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/gotauction.php';
			GotauctionHelper::getMenu();
		?>
	</div>

	<div class = "componentContentHeader">
		<div class = "pageHeading">
			<h1>Auctions</h1>
		</div>
		<div class = "subMenu">
			<?php
				echo $this->addToolbar();
			?>
		</div>
	</div>
	
	<form action='<?php echo JRoute::_('index.php?option=com_gotauction&view=auctions'); ?>' method="POST" id="adminForm" name="adminForm">
		
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
	
	<div class="table auctionList">

			<ul class = "auctionList">
				<?php foreach($this->items as $item): ?>
					
					<li class="grid_auction">
						<table width = "100%">
							<tr>
								<td width = "50%"><h2><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auction&layout=default&id=" . $item->id); ?>"><strong><?php echo $item->title; ?></strong><br /></a></h2></td>
								<td width = "50%"><h3>Auction ID: <strong><?php echo "#_" . $item->auction_id; ?></strong></h3></td>
							</tr>
							<tr>
								<td width = "60%">
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
									<div style = "width: 100%;">
									<?php for($i = 0; $i < 6; $i++) : ?>
										<div style = "width: 45%; float: left; padding: 5px;">
										<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
											<img src = "<?php $rand = rand(0, $count); echo JUri::base() . "images/com_gotauction/lots/" . $images[$rand]; ?>" class = "small" />
										</a>
										</div>
									<?php endfor; ?>
									</div>
								</td>
							</tr>
						</table>
				
						<table width = "100%">
							<tr class = "trDetails">
								<td>
									<table class = "listDetails">
										<tr>
											<td>Category:</td><td><strong><?php echo $item->auction_category_title; ?></strong></td>
										</tr>
										<tr>
											<td>Type:</td><td><strong><?php echo $item->auction_type_title; ?></strong></td>
										</tr>
										<tr>
											<td>Date:</td><td><strong><?php echo $item->date; ?></strong></td>
										</tr>
										<tr>
											<td>Time:</td><td><strong><?php echo $item->time; ?></strong></td>
										</tr>
										<tr>
											<td>Viewing Date:</td><td><strong><?php echo $item->viewing_date; ?></strong></td>
										</tr>
										<tr>
											<td>Viewing Time:</td><td><strong><?php echo $item->viewing_time; ?></strong></td>
										</tr>
									</table>
								</td>
								<td>
									<table class = "listDetails">
										<tr>
											<td>Address:</td><td><strong><?php echo $item->street_number . " ". $item->street_name . ", ". 
																					$item->suburb . "<br /> ". $item->city . ", ". 
																					$item->post_code ?></strong></td>
										</tr>
										<tr>
											<td>GPS:</td><td><strong><?php echo $item->gps_x . ", ". $item->gps_y; ?></strong></td>
										</tr>
										<tr>
											<td>Description:</td><td><strong><?php echo $item->description; ?></strong></td>
										</tr>
										<tr>
											<td>Auctioneer:</td><td><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auctioneer&layout=default&id=" . $item->auctioneer); ?>"><strong><?php echo $item->auctioneer_name; ?></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr class = "contentLinks">
								<td>
									<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auction&layout=default&id=" . $item->id); ?>">View Auction</a>
								</td>
								<td>
									<?php if (JFactory::getUser()->authorise('core.edit', 'com_gotauction')): ?>
										<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauction&layout=edit&id=" . $item->id); ?>">Edit Auction</a>
									<?php endif; ?>
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
