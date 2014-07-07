<?php


defined ("_JEXEC") or die();

class GotauctionModelAuctioneer extends JModelList
{
	public function __construct ($config=array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields']=array(
				'id', 'a.id',
				'name', 'a.name',
				'company', 'a.company',
			);
		}
		parent::__construct($config);
	}
	
	protected function populateState($orderding=null, $direction=null)
	{
		$app = JFactory::getApplication();
		$search=$this->getUserStateFromRequest($this->context.'.filter.search','filter_search');
		$this->setState('filter.search', $search);
		
		$published=$this->getUserStateFromRequest($this->context.'.filter.state','filter_state', '', 'string');
		
		$this->setState('filter.state', $published);
		
		parent::populateState('a.id', 'asc');
	}
	
	protected function getListQuery()
	{
		$auctioneer_id=JFactory::getApplication()->input->get('id');
		
		$db=$this->getDbo();
		
		$query=$db->getQuery(true);
		
		$query->select($this->getState(
			'list.select',
			'a.id, a.name, a.company, a.contact_no, a.email, profile_image'
		));
		
		$query->from($db->quoteName("#__gotauction_auctioneer").' AS a');
		
		
		$query->where("a.id=" . $auctioneer_id);
	
		return $query;
	}
	
}

