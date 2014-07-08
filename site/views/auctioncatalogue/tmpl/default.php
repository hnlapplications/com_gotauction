<?php

defined("_JEXEC") or die();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


JHtml::_('bootstrap.framework');
JHtml::_('script', 'system/core.js', false, true);
$document = JFactory::getDocument();
/*
$listOrder=$this->escape($this->state->get('list.ordering'));
$listDirn=$this->escape($this->state->get('list.direction'));
*/
$sortFields=$this->getSortFields()

?>
<div class = "gotAuctionContainer">
	<div>
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
			<h1>Auction Catalogue</h1>
		</div>
		<div class = "subMenu">
			<?php
				echo $this->addToolbar();
			?>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<!-- LIST OUTPUT-->
	<?php
	
		$auction_id=JFactory::getApplication()->input->get('auction');
		
	?>
	
	<form action='<?php echo JRoute::_('index.php?option=com_gotauction&view=auctioncatalogue&layout=default&auction=' . $auction_id); ?>' method="POST" id="adminForm" name="adminForm">
	<div class="table auction-table" id="auctionList">

				<div class="grid_auction2">
					<div class="auction_lots_table">
					<?php foreach ($this->items as $item): ?>
							<div style="float:left; width:50%">
								<table>
									<tr>
										<td>
											<!-- lot nr -->
											<?php echo $item->id; ?>
										</td>
										<td>
											<!-- lot description -->
											<?php echo $item->description; ?>
										</td>
										<td>
											<!-- lot qty -->
											<?php echo $item->quantity; ?>
										</td>
										<td>
											<!-- lot VAT -->
											<?php 
												echo ($item->vat?"Yes":"No");
											?>
										</td>
									</tr>
								</table>
							</div>
					<?php endforeach; ?>
					</div>
				</div>
		<!-- Pagination -->
						<label for="limit" class="">
							<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC') . " " . $this->pagination->getLimitBox(); echo $this->pagination->getListFooter(); ?><br />
							<?php  ?>
						</label>
						
					<!-- end pagination -->
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
	</form>
	<!-- END LIST OUTPUT -->
</div> <!-- gotAuctionContainer -->
</form>
