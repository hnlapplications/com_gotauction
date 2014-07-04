<?php

defined("_JEXEC") or die();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//this is the controller for the edit view
class GotauctionControllerEditauctioneer extends JControllerForm
{
	function __construct()
	{
		$this->view_list="auctioneers";
		parent::__construct();
	}	
	
	/*public function save()
	{
		$app=JFactory::getApplication();
		//get the form data
		$data=JRequest::getVar('jform', array(), 'post', 'array');		
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		//here we will just separate the address from the rest of the data and save it before everything else...
		//first check if this is a new or existing auction
		$isNew=true;
		$auctioneer_id="";
		if (isset($data['id']) && $data['id']!=0)
		{
			$isNew=false;
			$auctioneer_id=$data['id'];
		}
		
		
		$auctioneer=new stdClass();
		
		
		$auctioneer_id->name			= $data['title'];
		$auctioneer_id->company			= $data['auction_id'];
		$auctioneer_id->contact_no		= $data['auction_type'];
		$auctioneer_id->email			= $data['auctioneer'];
		$auctioneer_id->profile_image	= $data['auction_category'];
	
		if ($isNew)
		{
			$db->insertObject("#__gotauction_auctioneer", $auctioneer);
		}
		else
		{
			//get the existing address id from the database
			$auctioneer->id=$auctioneer_id;
			$db->updateObject("#__gotauction_auctioneer", $auctioneer, "id");
		}
		
		$this->setRedirect("index.php?option=com_gotauction&view=auctioneers");	
	}*/
	
	
}
