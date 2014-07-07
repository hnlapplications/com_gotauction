<?php

defined("_JEXEC") or die();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


JHtml::_('bootstrap.framework');
JHtml::_('script', 'system/core.js', false, true);
$document = JFactory::getDocument();

//~ $listOrder=$this->escape($this->state->get('list.ordering'));
//~ $listDirn=$this->escape($this->state->get('list.direction'));

//~ $sortFields=$this->getSortFields()

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

	<h1>Lot</h1>
	<?php
		echo $this->addToolbar();
	?>
	
	<div class="clearfix"></div>
	
	<!-- LIST OUTPUT-->
	
	<div class="table auction-table" id="auctionList">
			<div class="grid_auction3">
				<table width = "100%">
					<tr>
						<td colspan = "2">Lot: <strong><?php echo $this->item->title; ?></strong></td>
					</tr>
					<tr>
						<td colspan = "2">Lot Type: <strong><?php echo $this->item->lot_type; ?></strong></td>
					</tr>
					<tr>
						<td colspan = "2">Quantity: <strong><?php echo $this->item->quantity; ?></strong></td>
					</tr>
					<tr>
						<td colspan = "2">Description: <strong><?php echo $this->item->description; ?></strong></td>
					</tr>
					<tr>
						<td>
							<?php foreach($this->images as $image): ?>
							<img src = "<?php echo JUri::base() . "images/com_gotauction/lots/" . $image->image; ?>" class = "profileSmall" />
							<?php endforeach; ?>
							
						</td>
					</tr>
				</table>
			</div>
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	<!-- END LIST OUTPUT -->
</form>
