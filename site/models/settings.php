<?php

//this is the model for the list view of clients

defined ("_JEXEC") or die();

class GotauctionModelSettings extends JModelList
{
	public function __construct ($config=array())
	{
		parent::__construct($config);
	}
	
	
	
	/*protected function getListQuery()
	{
		$db=$this->getDbo();
		
		$query=$db->getQuery(true);
		
		$query->select($this->getState(
			'list.select',
			'a.id, company_name, director, logo, contact_no, address, email, street_number, street_name, suburb, city, post_code, gps_x, gps_y'
		));
		
		$query->from($db->quoteName("#__gotauction_settings").' AS a');
		$query->from($db->quoteName("#__gotauction_address").' AS b');
		
		$query->where("a.address=b.id");
		$query->setLimit(1);
		return $query;
	}*/
	
	
	
	
}
