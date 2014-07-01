<?php

defined("_JEXEC") or die();

//this is the toolbar buttons and title for our view is defined

class GotauctionViewHome extends JViewLegacy
{
	
	
	public function display($tpl=null)
	{
		
		require_once JPATH_COMPONENT.'/helpers/gotauction.php';
		
		if (count($errors=$this->get('Errors')))
		{
			JError::raiseError(500, implode('\n', $errors));
			return false;
		}
		
		parent::display($tpl);
	}
}

