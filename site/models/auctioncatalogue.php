<?php

//this is the model for the list view of clients

defined ("_JEXEC") or die();

class GotauctionModelAuctioncatalogue extends JModelList
{
	public function __construct ($config=array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields']=array(
				'id', 'a.id',
				'title', 'a.title',
				'auction_id', 'a.auction_id',
				'auction_type', 'a.auction_type',
				'auctioneer', 'a.auctioneer',
				'autction_category', 'a.autction_category',
				'description', 'a.description',
				'address', 'a.address',
				'date', 'a.date',
				'time', 'a.time',
				'viewing', 'a.viewing',
				'viewing_date', 'a.viewing_date',
				'viewing_time', 'a.viewing_time',
				'terms', 'a.terms'
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
		
		$auction_id=JFactory::getApplication()->input->get('auction');
		$this->setState('filter.auction', $auction_id);
		
		parent::populateState('a.id', 'asc');
	}
	
	protected function getListQuery()
	{
		
		
		$db=$this->getDbo();
		
		$query=$db->getQuery(true);
		
		$query->select($this->getState(
			'list.select',
			'a.id, a.title, a.auction_id, a.description, a.quantity, a.vat,
			b.title as lot_type'
		));
		
		$query->from($db->quoteName("#__gotauction_lot").' AS a');
		$query->from($db->quoteName("#__gotauction_lot_type").' AS b');
		
		$query->where("a.auction_id=" . $this->getState('filter.auction'));
		$query->where("b.id=a.lot_type");
		
		
		//filter by search in title
		$search=$this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:')===0)
			{
				$query->where('a.id = '.(int)substr($search, 3));
			}
			else
			{
				$search=$db->Quote('%'.$db->escape($search, true).'%');
				
				$conditions='a.title LIKE '.$search; 
				
				$query->where($conditions);
			}
		}
		
		$orderCol=$this->state->get('list.ordering');
		$orderDirn=$this->state->get('list.direction');
		if ($orderCol!='' && $orderDirn!='')
		{	
			$query->order($db->escape($orderCol.' '.$orderDirn));
		}
		
		return $query;
	}
	
	
	
	
}

