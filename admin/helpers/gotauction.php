<?php defined ("_JEXEC") or die();

class GotauctionHelper
{
	public static function getActions($categoryId=0)
	{
		$user=JFactory::getUser();
		$result=new JObject;
		
		if (empty($categoryId))
		{
			$assetName='com_gotauction';
			$level='component';
		}
		else
		{
			$assetName='com_gotauction.category.'.(int)$categoryId;
			$level='category';
		}
		
		$actions=JAccess::getActions('com_gotauction', $level);
		
		foreach($actions as $action)
		{
			//we populate the $result array with the available actions and their true/false permission states)
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
		return $result;
	}
	
	public static function getMenu()
	{	
		$user=JFactory::getUser();
		echo "
			<ul class = 'componentMenu'>
				<li><a href = '".JRoute::_('index.php?option=com_gotauction&view=auctions&layout=default') . "'>Auctions</a></li>
				<li><a href = '".JRoute::_('index.php?option=com_gotauction&view=auctioneers&layout=default') . "'>Auctioneers</a></li>
				" . ($user->authorise('core.configure', 'cmo_gotauction')?"<li><a href = '".JRoute::_('index.php?option=com_gotauction&view=setting&layout=edit&id=1') . "'>Settings</a></li>":"") . 
			"</ul>
		";
	}
	
	public static function setCSS()
	{
		
		$app=JFactory::getApplication();
		$params=$app->getParams();
		
		$backgroundColor=$params->get('background_color');
		$backgroundBorderColor=$params->get('background_border_color');
		$backgroundBorderSize=$params->get('background_border_size');
		
		$auctionContentColor=$params->get('auction_content_color');
		$auctioneerContentColor=$params->get('auctioneer_content_color');
		$lotContentColor=$params->get('lot_content_color');
		
		$contentBorderColor=$params->get('content_border_color');
		$contentBorderSize=$params->get('content_border_size');
		$contentBorderRadius=$params->get('content_border_radius');
		//print_r("Background-Color: " . $backgroundColor);
		
		$menuLinkColor=$params->get('component_menu_link_color');
		$menuLinkColorhover=$params->get('component_menu_link_color_hover');
		$subMenuLinkColor=$params->get('component_submenu_link_color');
		$subMenuLinkColorhover=$params->get('component_submenu_link_color_hover');
		
		$contTypeLinkColor=$params->get('content_type_link_color');
		$contTypeLinkColorhover=$params->get('content_type_link_color_hover');
		$innerContentLinkColor=$params->get('inner_content_link_color');
		$innerContentLinkColorhover=$params->get('inner_content_link_color_hover');
		//component background color
		if (!empty($backgroundColor) && $backgroundColor!='')
		{
			?>
			<style>
				.gotAuctionContainer 
				{ 	
					background:<?php echo $backgroundColor; ?>; 
					border:<?php echo $backgroundBorderSize . " solid " . $backgroundBorderColor; ?>;
				}
				
				.grid_auction, .grid_auction2, .grid_auction3 
				{ 	
					background:<?php echo $auctionContentColor; ?>; 
					border:<?php echo $contentBorderSize . " solid " . $contentBorderColor; ?>;
					border-radius: <?php echo $contentBorderRadius; ?>; 
				}
				
				.grid_auctioneer 
				{ 	
					background:<?php echo $auctioneerContentColor; ?>; 
					border:<?php echo $contentBorderSize . " solid " . $contentBorderColor; ?>;
					border-radius: <?php echo $contentBorderRadius; ?>; 
				}
				
				.grid_lot 
				{ 	
					background:<?php echo $lotContentColor; ?>; 
					border:<?php echo $contentBorderSize . " solid " . $contentBorderColor; ?>;
					border-radius: <?php echo $contentBorderRadius; ?>; 
				}
				
				ul.componentMenu a
				{
					color:<?php echo $menuLinkColor; ?>; 
				}

				ul.componentMenu a:hover
				{
					color:<?php echo $menuLinkColorhover; ?>; 
				}
				
				.subMenu a
				{
					color:<?php echo $subMenuLinkColor; ?>; 
				}

				.subMenu a:hover
				{
					color:<?php echo $subMenuLinkColorhover; ?>; 
				}
				
				.contentLinks a
				{
					color:<?php echo $innerContentLinkColor; ?>; 
				}
				
				.contentLinks a:hover
				{
					color:<?php echo $innerContentLinkColorhover; ?>; 
				}
				
				.contentTypeLinks a
				{
					color:<?php echo $contTypeLinkColor; ?>; 
				}
				
				.contentTypeLinks a:hover
				{
					color:<?php echo $contTypeLinkColorhover; ?>; 
				}
			</style>
			<?php
		}
	}
}
