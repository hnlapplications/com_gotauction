<?php
defined("_JEXEC") or die();


JHtml::_('script', 'system/core.js', false, true);

JHtml::stylesheet(Juri::base() . 'media/jui/css/bootstrap.min.css');
?>
<h1>Manage Auction</h1>
<form action="<?php echo JRoute::_('index.php?option=com_gotauction&view=editauction&layout=edit&id='.(int)$this->item->id); ?>" method="POST" enctype="multipart/form-data" name="adminForm" id="adminForm" class=form-validate">
	<div class="btn-toolbar">
		<div class="btn-group">
			<button tyoe="button" class="btn btn-primary" onclick="Joomla.submitbutton('editauction.save');">
				<i class="icon-new"></i> <?php echo JText::_('COM_GOTAUCTION_BUTTON_SAVE_AND_CLOSE') ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('editauction.apply');">
				<i class="icon-new"></i> <?php echo JText::_('JSAVE'); ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('editauction.cancel');">
				<i class="icon-cancel"></i> <?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
	</div>
	


	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				
				<?php echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_GOTAUCTION_NEW_AUCTION', true) : JText::sprintf('COM_GOTAUCTION_EDIT_AUCTION', $this->item->id, true)); ?>
				
					<!-- the data rendered below comes from models/forms/designer.xml -->
					<?php foreach($this->form->getFieldset('auction_fields') as $field): ?>					
						<?php 							
							$style="";							
							if ($field->name=="jform[id]")							
							{								
								$style="display:none";							
							}
						?>													
						<div class="control-group" style="<?php echo $style; ?>">								
							<div class="control-label">									
								<?php echo $field->label; ?>								
							</div>								
							<div class="controls">									
								<?php echo $field->input; ?>								
							</div>							
						</div>	
					<?php endforeach;?>
					
					
					
				<?php echo JHtml::_('bootstrap.endPanel'); ?>
				
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
				
				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>

</form>



