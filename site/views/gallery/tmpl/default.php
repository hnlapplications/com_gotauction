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
	
				
	<div class="table galleryList">
	
		<ul class = "galleryList">
			<?php foreach($this->lots as $lot): ?>
					<li class="gallery">
						<table width = "100%">
							<tr>
								<td>
									<a href="<?php echo JRoute::_("index.php?option=com_gotauction&view=editauctioneer&layout=edit&id=" . $item->id); ?>">
										<img src = "<?php echo JUri::base() . "images/com_gotauction/lots/" . $lot->images[0]->image; ?>" class = "smallLot" />
									</a>
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

