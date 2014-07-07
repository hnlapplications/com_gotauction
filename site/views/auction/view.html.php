<?php
defined ('_JEXEC') or die();
JHtml::_('script', 'system/core.js', false, true);
class GotauctionViewAuction extends JViewLegacy
{
	protected $item;
	protected $state; //ordering
	protected $lots;
	public function display($tpl=null)
	{
		$this->item = $this->get('Items');
		$this->item=$this->item[0];
		$this->state=$this->get('State'); //get the ordering
		$this->lots=$this->getLots();
		$app=JFactory::getApplication();
		$params=$app->getParams();
		$this->assignRef('params', $params);
		
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
		$html="<a class='button' href='" . JRoute::_("index.php?option=com_gotauction&view=editauction&layout=edit&id=" . $this->item->id) . "'>Edit Auction</a>";
		$html.="<a class='button' href='" . JRoute::_("index.php?option=com_gotauction&view=editlot&layout=edit&auction=" . $this->item->id) . "'>Add Lot</a>";
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
	
	protected function getLots()
	{
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select($db->quoteName(array("id", "title", "description", "lot_type", "quantity")));
		$query->from($db->quoteName("#__gotauction_lot"));
		$query->where($db->quoteName("auction_id") . "='" . $this->item->id . "'");
		$db->setQuery($query);
		
		$lots=$db->loadObjectList();
		
		foreach($lots as &$lot)
		{
			$query=$db->getQuery(true);
			$query->select($db->quoteName(array("id", "image")));
			$query->from($db->quoteName("#__gotauction_images"));
			$query->where($db->quoteName("lot_id") . "='" . $lot->id . "'");
			$db->setQuery($query);
			
			$lot->images=$db->loadObjectList();
		}
		
		return $lots;
	}
}
