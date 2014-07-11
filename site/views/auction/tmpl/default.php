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
			<h1>Auction</h1>
		</div>
		<div class = "subMenu">
			<?php
				echo $this->addToolbar();
			?>
		</div>
	</div>
	
	<!-- LIST OUTPUT-->
	
	<div class="grid_auction2">
		<table width = "100%">
			<tr>
				<td width = "50%"><h2><strong><?php echo $this->item->title; ?></strong><br /></h2></td>
				<td width = "50%"><h3>Auction ID: <strong><?php echo "#_" . $this->item->auction_id; ?></strong></h3></td>
			</tr>
			<tr>
				<td>
					<table class = "listDetails">
						<tr>
							<td>Category:</td><td><strong><?php echo $this->item->auction_category_title; ?></strong></td>
						</tr>
						<tr>
							<td>Type:</td><td><strong><?php echo $this->item->auction_type_title; ?></strong></td>
						</tr>
						<tr>
							<td>Date:</td><td><strong><?php echo $this->item->date; ?></strong></td>
						</tr>
						<tr>
							<td>Time:</td><td><strong><?php echo $this->item->time; ?></strong></td>
						</tr>
						<tr>
							<td>Viewing Date:</td><td><strong><?php echo $this->item->viewing_date; ?></strong></td>
						</tr>
						<tr>
							<td>Viewing Time:</td><td><strong><?php echo $this->item->viewing_time; ?></strong></td>
						</tr>
					</table>
				
				</td>
				<td>
					<table class = "listDetails">
						<tr>
							<td>Address:</td><td><strong><?php echo $this->item->street_number . " ". $this->item->street_name . ", ". 
																	$this->item->suburb . "<br /> ". $this->item->city . ", ". 
																	$this->item->post_code ?></strong></td>
						</tr>
						<tr>
							<td>GPS:</td><td><strong><?php echo $this->item->gps_x . ", ". $this->item->gps_y; ?></strong></td>
						</tr>
						<tr>
							<td>Description:</td><td><strong><?php echo $this->item->description; ?></strong></td>
						</tr>
						<tr>
							<td>Auctioneer:</td><td class = "contentLinks"><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auctioneer&layout=default&id=" . $this->item->auctioneer); ?>"><strong><?php echo $this->item->auctioneer_name; ?></a></td>
						</tr>
					</table>
					
				</td>
			</tr>
			<tr>
				<td width = "50%"><h2 class = "contentLinks"><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=gallery&layout=default&id=" . $this->item->id); ?>"><strong>Gallery</strong><br /></a></h2></td>			</tr>
		</table>
	</div>
				
	<div class="table lotList">
	
				<ul class = "lotList">
					<?php foreach($this->lots as $lot): ?>
							<li class="grid_lot">
								<table width = "100%">
									<tr>
										<td>
										<h3>Lot: <a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=lot&layout=default&id=" . $lot->id); ?>"><?php echo $lot->title; ?></a></h3>
										</td>
									</tr>
									<tr>
										<td>
											<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
												<img src = "<?php echo JUri::base() . "images/com_gotauction/lots/" . $lot->images[0]->image; ?>" class = "smallLot" />
											</a>
										</td>
										
									</tr>
									<tr>
										<td colspan = "2">Lot Type: <strong><?php echo $lot->lot_type; ?></strong></td>
									</tr>
									<tr>
										<td class = "contentLinks" style="vertical-align:middle">
											<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=lot&layout=default&id=" . $lot->id); ?>">View Lot</a> <br />
											
											<?php if (JFactory::getUser()->authorise('core.edit', 'com_gotauction')) : ?>
											<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editlot&layout=edit&id=" . $lot->id); ?>">Edit Lot</a>
											<?php endif; ?>
										</td>
									</tr>
								</table>
							</li>
					<?php endforeach; ?>
				</ul>
			
		
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	<!-- END LIST OUTPUT -->
</div> <!-- gotAuctionContainer -->
</form>
