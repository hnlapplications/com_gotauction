<?php

defined("_JEXEC") or die();

//this is the toolbar buttons and title for our view is defined

	class GotauctionViewHome extends JViewLegacy
	{
		protected $state;

		public function display($tpl=null)
		{
			$this->state=$this->get('State');
			
			require_once JPATH_COMPONENT.'/helpers/gotauction.php';
			
			if (count($errors=$this->get('Errors')))
			{
				JError::raiseError(500, implode('\n', $errors));
				return false;
			}
			
			$this->addToolbar();
			
			parent::display($tpl);
		}
		
		protected function addToolbar()
		{
			$state = $this->get('State');
			
			//$canDo = FolioHelper::getActions($state->get('filter.category_id'));
			$canDo=GotauctionHelper::getActions();
			$user = JFactory::getUser();
			$bar = JToolBar::getInstance('toolbar');
			$state=$this->get('State');
			
			if ($canDo->get('core.admin'))
			{
				JToolbarHelper::preferences('com_gotauction');
			}
			
			JToolbarHelper::title(JText::_('COM_GOTAUCTION_MANAGER_HOME'), '');
			
		}
	}

