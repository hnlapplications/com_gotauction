<?php
defined ('_JEXEC') or die();
JHtml::_('script', 'system/core.js', false, true);
class GotauctionViewAuctioneers extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state; //ordering
	
	public function display($tpl=null)
	{
		$this->items = $this->get('Items');
		print_r($this->items);
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
		$html="<a class='button' href='index.php?option=com_gotauction&view=editauctioneer&layout=edit'>New Auctioneer</a>";
		//~ check usergroups, and render a toolbar if the user is allowed to do stuff
		return $html;
	}
	
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.name' => 'Name',
		);
	}
}
