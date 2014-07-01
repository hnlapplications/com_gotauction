<?php defined("_JEXEC") or die();

class GotauctionController extends JControllerLegacy
{
	protected $default_view='home';
	
	public function display($cachable=false, $urlparams=false)
	{
		require_once JPATH_COMPONENT.'/helpers/gotauction.php';
		
		$view=$this->input->get('view','home');
		$layout=$this->input->get('layout', 'default');
		$id=$this->input->get('id');
		
		parent::display();
		return $this;
	}
}
