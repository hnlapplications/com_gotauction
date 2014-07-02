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
		$html="<a class='button' href='index.php?option=com_gotuction&view=auction&layout=edit'>New Auction</a>";
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
}
