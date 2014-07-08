<?php 
	defined ("_JEXEC") or die(); 
	JHtml::_('bootstrap.framework');
	JHtml::_('script', 'system/core.js', false, true);
	
	
?>

<script type="text/javascript">
	jQuery(document).ready(function()
	{
		//load settings from the database if there are any
		
	});
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

<h1>Gotauction Settings</h1>

<div id="gotauction_settings">
	<form id="settings_form" enctype="multipart/form-data" method="POST" action="index.php?option=com_gotauction&view=settings&task=save">
		<div id="gotauction_basic_settings">
			<h2>Basic Settings</h2>
				<label for="company_name">Company Name</label>
				<input value="<?php ($this->fields->company_name!=""?$this->fields->company_name:""); ?>" type="text" name="company_name" id="company_name" /><br />
				
				<label for="director">Director</label>
				<input value="<?php ($this->fields->director!=""?$this->fields->director:""); ?>" type="text" name="director" id="director" /><br />
				
				<label for="logo">Logo</label>
				<input value="<?php ($this->fields->logo!=""?$this->fields->logo:""); ?>" type="file" name="logo" id="logo" /><br />
				
				<label for="contact_no">Contact Number</label>
				<input value="<?php ($this->fields->contact_no!=""?$this->fields->contact_no:""); ?>" type="text" name="contact_no" id="contact_no" /><br />
				
				<label for="email">Email Address</label>
				<input value="<?php ($this->fields->email!=""?$this->fields->email:""); ?>" type="text" name="email" id="email" /><br />
				
				<div id="company_address">
					<label for="street_number">Street Number</label>
					<input value="<?php ($this->fields->address->street_number!=""?$this->fields->address->street_number:""); ?>" type="text" name="street_number" id="street_number" /><br />
					
					<label for="street_name">Street Name</label>
					<input value="<?php ($this->fields->address->street_name!=""?$this->fields->address->street_name:""); ?>" type="text" name="street_name" id="street_name" /><br />
					
					<label for="suburb">Suburb</label>
					<input value="<?php ($this->fields->address->suburb!=""?$this->fields->address->suburb:""); ?>" type="text" name="suburb" id="suburb" /><br />
					
					<label for="city">City</label>
					<input value="<?php ($this->fields->address->city!=""?$this->fields->address->city:""); ?>" type="text" name="city" id="city" /><br />
					
					<label for="post_code">Post code</label>
					<input value="<?php ($this->fields->address->post_code!=""?$this->fields->address->post_code:""); ?>" type="text" name="post_code" id="post_code" /><br />
					
					<label for="gpsx">GPS X</label>
					<input value="<?php ($this->fields->address->gps_x!=""?$this->fields->address->gps_x:""); ?>" type="text" name="gpsx" id="gpsx" /><br />
					
					<label for="gpsy">GPS Y</label>
					<input value="<?php ($this->fields->address->gps_y!=""?$this->fields->address->gps_y:""); ?>" type="text" name="gpsy" id="gpsy" /><br />
				</div>
				
		</div>
		<input type="submit" value="Save Settings" />
	</form>
</div> <!-- gotAuctionContainer -->
</div>
