<?php

defined("_JEXEC") or die();
JHtml::_('script', 'system/core.js', false, true);

//the is the edit view

class GotauctionViewEditlot extends JViewLegacy
{
	protected $item; //store data retrieved from the model
	protected $form;
	
	public function display($tpl=null)
	{
		$this->item=$this->get('Item');
		$this->form=$this->get('Form');
		
		if (count($errors=$this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		parent::display($tpl);
	}
}
