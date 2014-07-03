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


	<h1>Auction</h1>
	<?php
		echo $this->addToolbar();
	?>
	
	<div class="clearfix"></div>
	
	<!-- LIST OUTPUT-->
	
	<div class="table auction-table" id="auctionList">

				<div class="grid_auction">
					<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=auction&layout=default&id=" . $this->item->id); ?>"><strong><?php echo $this->item->title; ?></strong><br /></a>
					<?php echo $this->item->date . ' @ ' . $this->item->time; ?>
				</div>
				<div class="grid_lots">
					<?php foreach($this->lots as $lot): ?>
						<?php print_r($lot); ?><hr />
					<?php endforeach; ?>
				</div>
		
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	<!-- END LIST OUTPUT -->
</form>
