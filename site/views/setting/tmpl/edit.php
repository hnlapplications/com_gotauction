<?php
defined("_JEXEC") or die();
JHtml::_('script', 'system/core.js', false, true);
JHtml::_('jquery.framework');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">	
	jQuery.noConflict();
	
	var recordType=""; //used to check what we are adding (auction type/category or lot type), rather than writing 36547 functions to handle them all, use a switch here and there to do it.
	var addNewType=true; //will be false if we are updating a type
	var recordEditId=null; //id of the current auction type/category/lot type that is being edited.  Null if we are adding a new one.
	
	jQuery(document).ready(function()
	{
		jQuery("#add_type_dialog").dialog(
		{
			autoOpen:false,
			width:300,
			height:300,
			buttons:
			{
				"Save":function()
				{
					saveType();
				},
				Cancel:function()
				{
					jQuery("#new_type_name").val("");
					jQuery(this).dialog("close");
				}
			},
			close:function()
			{
				jQuery("#new_type_name").val("");
				jQuery(this).dialog("close");
			}
		});
	});
	
	function manageType(type, isNew, id)
	{
		//type will be auctiontype / auctioncategory / lottype
		//isNew will be true/false
		recordType=type;
		addNewType=isNew;
		if (id!==undefined)
		{
			recordEditId=id;
		}
		
		var heading="";
		if (isNew)
		{
			heading="Please enter a name for your new ";
			recordEditId=null; //make sure that no previous recs are edited.
		}
		else
		{
			heading="Please enter a new name for this ";
		}
		
		switch(type)
		{
			case "auctiontype":
				heading+="auction type.";
				break;
			case "auctioncategory":
				heading+="auction category.";
				break;
			case "lottype":
				heading+="lot type.";
				break;
			default:
				break;
		}
		
		jQuery("#add_type_heading").html(heading);
		
		jQuery("#add_type_dialog").dialog("open");
	}
	
	
	
	function saveType()
	{
		jQuery.ajax(
		{
			url:"index.php?option=com_gotauction&task=setting.save_type",
			type:"POST",
			data:{title:jQuery("#new_type_name").val(), isNew:addNewType, recordType:recordType, recordId:recordEditId}
		})
		.done(function(data)
		{
			if (data=="ok")
			{
				alert("Your new type/category was successfully saved");
				location.reload();
			}
			else
			{
				alert(data);
			}
		})
		.fail(function()
		{
			alert("An error occured while saving.  Please contact support.");
		});
	}
	
	function deleteType(type, id)
	{
		jQuery.ajax(
		{
			url:"index.php?option=com_gotauction&task=setting.delete_type",
			type:"POST",
			data:{recordType:type, recordId:id}
		})
		.done(function(data)
		{
			if (data=="ok")
			{
				alert("Your new type/category was successfully deleted");
				location.reload();
			}
			else
			{
				alert(data);
			}
		})
		.fail(function()
		{
			alert("An error occured while deleting.  Please contact support.");
		});
	}
	
</script>
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

<h1>GotAuction Settings</h1>
<form action="<?php echo JRoute::_('index.php?option=com_gotauction&view=setting&layout=edit&id=1'); ?>" method="POST" enctype="multipart/form-data" name="adminForm" id="adminForm" class=form-validate">
	<div class="btn-toolbar">
		<div class="btn-group">
			<button tyoe="button" class="btn btn-primary" onclick="Joomla.submitbutton('setting.save');">
				<i class="icon-new"></i> Save and Close
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('setting.apply');">
				<i class="icon-new"></i> <?php echo JText::_('JSAVE'); ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('setting.cancel');">
				<i class="icon-cancel"></i> <?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
	</div>
	


	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				
				<?php echo JHtml::_('bootstrap.addPanel', 'myTab', 'details',JText::_('COM_GOTAUCTION_SETTINGS', true)); ?>
				
					<!-- the data rendered below comes from models/forms/designer.xml -->
					
					<?php 					
					foreach($this->form->getFieldset('settings_fields') as $field): 
					//~ echo "<pre>" . print_r($field, true) . "</pre>";
					if ($field->value==null) //$field->value=="")
					{
						switch($field->fieldname)
						{
							case "street_number":
								$field->value=$this->item->street_number;
								break;
							case "street_name":
								$field->value=$this->item->street_name;
								break;
							case "suburb":
								$field->value=$this->item->suburb;
								break;
							case "city":
								$field->value=$this->item->city;
								break;
							case "post_code":
								$field->value=$this->item->post_code;
								break;
							case "gps_x":
								$field->value=$this->item->gps_x;
								break;
							case "gps_y":
								$field->value=$this->item->gps_y;
								break;
							default:
								//do nothing
								break;
						}
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
					<?php 
						endforeach;
					?>
					
					
					
				<?php echo JHtml::_('bootstrap.endPanel'); ?>
				
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
				
				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>
</div> <!-- gotAuctionContainer -->
</form>

<div class="row-fluid">
	<div class="row-fluid span4 well" >
		<strong>Auction Types</strong>
		<button class="btn btn-primary  pull-right" onclick="manageType('auctiontype', true); ">New</button><br />
		<div id="auction_types" class="row-fluid">
			<?php 
				if (count($this->auction_types)==0):
			?>
				There are no auction types available yet.
			<?php 
				else:
					?>
						<table>
						<?php
							foreach($this->auction_types as $auction_type):
						?>
							<tr><td><?php echo $auction_type->title; ?></td>
								<td style = "padding: 5px;">
									<button class="btn btn-primary  pull-right" onclick="deleteType('auctiontype', <?php echo $auction_type->id; ?>); ">Delete</button>
									<button class="btn btn-primary  pull-right" onclick="manageType('auctiontype', false, <?php echo $auction_type->id; ?>); ">Edit</button>
								</td>
							</tr>
						<?php
							endforeach; 
						?>
						</table>
					<?php
				endif; 
			?>
		</div>
	</div>
	<div class="row-fluid span4 well">
		<strong>Auction Categories</strong>
		<button class="btn btn-primary  pull-right" onclick="manageType('auctioncategory', true); ">New</button><br />
		<div id="auction_categories" class="row-fluid">
			<?php 
				if (count($this->auction_categories)==0):
			?>
				There are no auction categories available yet.
			<?php 
				else:
					?>
						<table>
						<?php
							foreach($this->auction_categories as $auction_category):
						?>
							<tr><td><?php echo $auction_category->title; ?></td>
								<td style = "padding: 5px;">
									<button class="btn btn-primary  pull-right" onclick="deleteType('auctioncategory', <?php echo $auction_category->id; ?>); ">Delete</button>
									<button class="btn btn-primary  pull-right" onclick="manageType('auctioncategory', false, <?php echo $auction_category->id; ?>); ">Edit</button>
								</td>
							</tr>
						<?php
							endforeach; 
						?>
						</table>
					<?php
				endif; 
			?>
		</div>
	</div>
	<div class="row-fluid span4 well">
		<strong>Lot Types</strong>
		<button class="btn btn-primary pull-right" onclick="manageType('lottype', true); ">New</button><br />
		<div id="lot_types" class="row-fluid">
			<?php 
				if (count($this->lot_types)==0):
			?>
				There are no lot types available yet.
			<?php 
				else:
					?>
						<table>
						<?php
							foreach($this->lot_types as $lot_type):
						?>
							<tr>
								<td><?php echo $lot_type->title; ?></td>
								<td style = "padding: 5px;">
									<button class="btn btn-primary  pull-right" onclick="deleteType('lottype', <?php echo $lot_type->id; ?>); ">Delete</button>
									<button class="btn btn-primary  pull-right" onclick="manageType('lottype', false, <?php echo $lot_type->id; ?>); ">Edit</button>
								</td>
							</tr>
						<?php
							endforeach; 
						?>
						</table>
					<?php
				endif; 
			?>
		</div>
	</div>
	
	<div id="add_type_dialog">
		<strong id="add_type_heading"></strong><br />
		<input type="text" id="new_type_name" /><br />
	</div>
</div>




