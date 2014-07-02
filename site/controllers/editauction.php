<?php

defined("_JEXEC") or die();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//this is the controller for the edit view
class GotauctionControllerEditauction extends JControllerForm
{
	function __construct()
	{
		parent::__construct();
	}	
	
	public function save()
	{
		$app=JFactory::getApplication();
		//get the form data
		$data=JRequest::getVar('jform', array(), 'post', 'array');		
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		//here we will just separate the address from the rest of the data and save it before everything else...
		$address=new stdClass();
		$address->street_number=$data['street_number'];
		$address->street_name=$data['street_name'];
		$address->suburb=$data['suburb'];
		$address->city=$data['city'];
		$address->gps_x=$data['gps_x'];
		$address->gps_y=$data['gps_y'];
		
		$db->insertObject("#__gotauction_address", $address);
		$address_id=$db->insertid();
		
		$auction=new stdClass();
		$auction->title				= $data['title'];
		$auction->auction_id		= $data['auction_id'];
		$auction->auction_type		= $data['auction_type'];
		$auction->auctioneer		= $data['auctioneer'];
		$auction->auction_category	= $data['auction_category'];
		$auction->description		= $data['description'];
		$auction->date				= $data['date'];
		$auction->time				= $data['time'];
		$auction->viewing			= $data['viewing'];
		$auction->viewing_date		= $data['viewing_date'];
		$auction->viewing_time		= $data['viewing_time'];
		$auction->terms				= $data['terms'];
		$auction->address			= $address_id;
		
		$db->insertObject("#__gotauction_auction", $auction);
		
		$this->setRedirect("index.php?option=com_gotauction&view=setting&layout=edit&id=1");	
	}
}
