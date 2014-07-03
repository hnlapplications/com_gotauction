<?php

//this is the model for the list view of clients

defined ("_JEXEC") or die();

class GotauctionModelLot extends JModelList
{
	public function __construct ($config=array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields']=array(
				'id', 'a.id',
				'title', 'a.title',
				'lot_type', 'a.lot_type',
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
		$lot_id=JFactory::getApplication()->input->get('id');
		
		$db=$this->getDbo();
		
		$query=$db->getQuery(true);
		
		$query->select($this->getState(
			'list.select',
			'a.id, a.title, a.lot_type, a.quantity'
		));
		
		$query->from($db->quoteName("#__gotauction_lot").' AS a');
		
		
		$query->where("a.id=" . $lot_id);
	
		return $query;
	}
	
	
	
	
}

