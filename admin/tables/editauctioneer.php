<?php
defined("_JEXEC") or die();

class GotauctionTableEditauctioneer extends JTable
{
	public function __construct(&$db)
	{
		parent::__construct("#__gotauction_auctioneer", "id", $db);
	}
	
	public function bind($array, $ignore='')
	{
		return parent::bind($array, $ignore);
	}
	
	public function store($updateNulls = false)
	{
		return parent::store($updateNulls);
	}
	
	
}
