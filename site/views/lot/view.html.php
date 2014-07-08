<?php
defined ('_JEXEC') or die();
JHtml::_('script', 'system/core.js', false, true);
class GotauctionViewLot extends JViewLegacy
{
	protected $items;
	protected $state; //ordering
	protected $lots;
	public function display($tpl=null)
	{
		$this->item = $this->get('Items');
		$this->item=$this->item[0];
		$this->state=$this->get('State'); //get the ordering
		$this->images=$this->getImages();
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
		$html="";
		if (JFactory::getUser()->authorise('core.edit', 'com_gotauction'))
		{
			$html="<a class='button' href='" . JRoute::_("index.php?option=com_gotauction&view=editlot&layout=edit&id=" . $this->item->id) . "'>Edit Lot</a>";
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
	
	protected function getImages()
	{
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select($db->quoteName(array("id", "image")));
		$query->from($db->quoteName("#__gotauction_images"));
		$query->where($db->quoteName("lot_id") . "='" . $this->item->id . "'");
		$db->setQuery($query);
		
		return $db->loadObjectList();
	}
}
