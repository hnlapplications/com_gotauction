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
		echo "
			<ul class = 'componentMenu'>
				<li><a href = '".JRoute::_('index.php?option=com_gotauction&view=auctions&layout=default') . "'>AUCTIONS</a></li>
				<li><a href = '".JRoute::_('index.php?option=com_gotauction&view=auctioneers&layout=default') . "'>AUCTIONEERS</a></li>
				<li><a href = '".JRoute::_('index.php?option=com_gotauction&view=setting&layout=edit') . "'>SETTINGS</a></li>
				<li><a href = '".JRoute::_('index.php?option=com_gotauction&view=setting&layout=edit') . "'>REPORTS</a></li>
			</ul>
		";
	}
}
