<?php
defined ('_JEXEC') or die();
JHtml::_('script', 'system/core.js', false, true);
class GotauctionViewAuctions extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state; //ordering
	
	public function display($tpl=null)
	{
		$this->items = $this->get('Items');
		
		$this->state=$this->get('State'); //get the ordering
		$app=JFactory::getApplication();
		$params=$app->getParams();
		$this->assignRef('params', $params);
		$this->pagination=$this->get('Pagination');
		
		if (count($errors=$this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->state = $this->get('State');
		
		parent::display($tpl);
	}
	
	public function addToolbar()
	{
		$user=JFactory::getUser();
		$html="";
		if ($user->authorise('core.create', 'com_gotauction'))
		{
			$html="<a class='button' href='index.php?option=com_gotauction&view=editauction&layout=edit'>New Auction</a>";
		}
		//~ check usergroups, and render a toolbar if the user is allowed to do stuff
		return $html;
	}
	
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.title' => 'First Name',
		);
	}
	
	protected function getImages($auction_id)
	{
		$images=array();
	
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select($db->quoteName(array("id", "title", "description", "lot_type", "quantity")));
		$query->from($db->quoteName("#__gotauction_lot"));
		$query->where($db->quoteName("auction_id") . "='" . $auction_id . "'");
		$db->setQuery($query);
		
		$lots=$db->loadObjectList();
		
		foreach($lots as &$lot)
		{
			$query=$db->getQuery(true);
			$query->select($db->quoteName(array("id", "image")));
			$query->from($db->quoteName("#__gotauction_images"));
			$query->where($db->quoteName("lot_id") . "='" . $lot->id . "'");
			$db->setQuery($query);
			
			$imagesArray=$db->loadObjectList();
			foreach($imagesArray as $i)
			{
				array_push($images, $i->image);
			}
		}
		
		return $images;
	}
}
