<?php 

	defined ("_JEXEC") or die();

//this is the controller for the home view

class GotauctionControllerHome extends JControllerAdmin
{
	public function getModel($name='Home', $prefix='GotauctionModel', $config=array('ignore_request'=>true))
	{
		$model=parent::getModel($name, $prefix, $config);
		return $model;
	}
}
