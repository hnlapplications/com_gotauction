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

	<div>
		<?php
			$url = JUri::base() . 'media/com_gotauction/css/style.css';
			$document = JFactory::getDocument();
			$document->addStyleSheet($url);
			require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/gotauction.php';
			GotauctionHelper::getMenu();
		?>
	</div>

	<h1>Auction</h1>
	<?php
		echo $this->addToolbar();
	?>
	
	<div class="clearfix"></div>
	
	<!-- LIST OUTPUT-->
	
	<div class="table auction-table" id="auctionList">

				<div class="grid_auction2">
					<table width = "100%">
						<tr>
							<td width = "50%"><a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auction&layout=default&id=" . $this->item->id); ?>"><strong><?php echo $this->item->title; ?></strong><br /></a></td>
						</tr>
						<tr>
							<td>
								<ul class = "listDetails">
									<li> Category: <strong><?php echo $this->item->auction_category; ?></strong> </li>
									<li> Type: <strong><?php echo $this->item->auction_type; ?></strong> </li>
									<li> Date: <strong><?php echo $this->item->date; ?></strong> </li>
									<li> Time: <strong><?php echo $this->item->time; ?></strong> </li>
									<li> Viewing Date: <strong><?php echo $this->item->viewing_date; ?></strong> </li>
									<li> Viewing Time: <strong><?php echo $this->item->viewing_time; ?></strong> </li>
								</ul>
							</td>
							<td>
								<ul class = "listDetails">
									<li> Address: <strong><?php echo $this->item->address; ?></strong> </li>
									<li> GPS Coordinates: <strong><?php echo $this->item->address; ?></strong> </li>
									<li> Description: <strong><?php echo $this->item->description; ?></strong> </li>
									<li> Auction ID: <strong><?php echo "#_" . $this->item->auction_id; ?></strong> </li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
				
				<div class="grid_lots">
					<ul class = "lotList">
						<?php foreach($this->lots as $lot): ?>
								<li class="grid_lot">
									<table width = "100%">
										<tr>
											<td colspan = "2">Lot: <strong><?php echo "#_" . $lot->title; ?></strong></td>
										</tr>
										<tr>
											<td colspan = "2">Description: <strong><?php echo "#_" . $lot->description; ?></strong></td>
										</tr>
										<tr>
											<td>
												<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
													<img src = "<?php echo JUri::base() . "images/com_gotauction/lots/" . $lot->images[0]->image; ?>" class = "profileSmall" />
												</a>
											</td>
											<td>
												<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=lot&layout=default&id=" . $lot->id); ?>">View Lot</a> <br />
												<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editlot&layout=edit&id=" . $lot->id); ?>">Edit Lot</a>
											</td>
										</tr>
									</table>
								</li>
						<?php endforeach; ?>
					</ul>
				</div>
		
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	<!-- END LIST OUTPUT -->
</form>
