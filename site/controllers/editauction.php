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
		//first check if this is a new or existing auction
		$isNew=true;
		$auction_id="";
		if (isset($data['id']) && $data['id']!=0)
		{
			$isNew=false;
			$auction_id=$data['id'];
		}
		
		$address=new stdClass();
		$address->street_number=$data['street_number'];
		$address->street_name=$data['street_name'];
		$address->suburb=$data['suburb'];
		$address->city=$data['city'];
		$address->gps_x=$data['gps_x'];
		$address->gps_y=$data['gps_y'];
		$address_id="";
		if ($isNew)
		{
			$db->insertObject("#__gotauction_address", $address);
			$address_id=$db->insertid();
		}
		else
		{
			//get the existing address id from the database
			$query->select("address")->from("#__gotauction_auction")->where("id='" . $auction_id . "'");
			$db->setQuery($query);
			$address_row=$db->loadObject();
			$address_id=$address_row->address;
			$address->id=$address_row->address;
			$db->updateObject("#__gotauction_address", $address, "id");
		}
		
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
		
		if ($isNew)
		{
			$db->insertObject("#__gotauction_auction", $auction);
			$auction_id=$db->insertid();
		}
		else
		{
			//get the existing address id from the database
			$auction->id=$auction_id;
			$db->updateObject("#__gotauction_auction", $auction, "id");
		}
		
		$this->setRedirect("index.php?option=com_gotauction&view=auctions");	
	}
	
	public function cancel()
	{
		$app=JFactory::getApplication();
		$input=JFactory::getApplication()->input;
		$referer=$input->server->get('HTTP_REFERER', 'null', 'string');
		
		$referer=substr($referer, strpos($referer, '&id=')+4);
		$this->setRedirect(JRoute::_('index.php?option=com_gotauction&view=auction&id=' . $referer));
	}
}
