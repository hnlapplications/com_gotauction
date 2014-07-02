<?php
defined ('_JEXEC') or die();
JHtml::_('script', 'system/core.js', false, true);
class GotauctionViewSetting extends JViewLegacy
{
	protected $item; //store data retrieved from the model
	protected $form;
	
	public function display($tpl=null)
	{
		$this->item=$this->get('Item');
		$this->form=$this->get('Form');
					
		$address=$this->loadAddress();
		$this->item->street_number=$address->street_number;
		$this->item->street_name=$address->street_name;
		$this->item->suburb=$address->suburb;
		$this->item->city=$address->city;
		$this->item->post_code=$address->post_code;
		$this->item->gps_x=$address->gps_x;
		$this->item->gps_y=$address->gps_y;
		
		$this->auction_types=$this->getAuctionTypes();
		$this->auction_categories=$this->getAuctionCategories();
		$this->lot_types=$this->getLotTypes();
		
		if (count($errors=$this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		parent::display($tpl);
	}
	
	public function addToolbar()
	{
		//do nothing yet
	}
	
	private function loadAddress()
	{
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select($db->quoteName(array("address")));
		$query->from($db->quoteName("#__gotauction_settings"));
		$query->setLimit(1);
		$db->setQuery($query);
		$results=$db->loadObject();
		if ($results==null)
		{
			//return a blank address
			$address=new stdClass();
			$address->street_number="";
			$address->street_name="";
			$address->suburb="";
			$address->city="";
			$address->post_code="";
			$address->gps_x="";
			$address->gps_y="";
			return $address;
		}
		else
		{
			$address=new stdClass();
			//load the address
			$query=$db->getQuery(true);
			$query->select($db->quoteName(array("street_number", "street_name", "suburb", "city", "post_code", "gps_x", "gps_y")))
					->from($db->quoteName("#__gotauction_address"))
					->where($db->quoteName("id") . ' = ' . $results->address);
			$db->setQuery($query);
			$address=$db->loadObject();
			return $address;
		}
		
		
	}
	
	private function getAuctionTypes()
	{
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select($db->quoteName(array("id", "title")))->from($db->quoteName("#__gotauction_auction_type"));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	private function getAuctionCategories()
	{
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select($db->quoteName(array("id", "title")))->from($db->quoteName("#__gotauction_auction_category"));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	private function getLotTypes()
	{
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select($db->quoteName(array("id", "title")))->from($db->quoteName("#__gotauction_lot_type"));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}
