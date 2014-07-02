<?php

//this is the model for the list view of clients

defined ("_JEXEC") or die();

class GotauctionModelAuction extends JModelList
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
		
		parent::populateState('a.id', 'asc');
	}
	
	protected function getListQuery()
	{
		$auction_id=JFactory::getApplication()->input->get('id');
		
		$db=$this->getDbo();
		
		$query=$db->getQuery(true);
		
		$query->select($this->getState(
			'list.select',
			'a.id, a.title, a.auction_id, a.auction_type, a.auctioneer, a.auction_category, a.description, a.address, a.date,a.time, a.viewing, a.viewing_date, a.viewing_time, a.terms, 
			b.title AS auction_type_title,
			c.title as auction_category_title,
			d.name as auctioneer_name,
			e.street_number, e.street_name, e.suburb, e.city, e.post_code, e.gps_x, e.gps_y'
		));
		
		$query->from($db->quoteName("#__gotauction_auction").' AS a');
		$query->from($db->quoteName("#__gotauction_auction_type").' AS b');
		$query->from($db->quoteName("#__gotauction_auction_category").' AS c');
		$query->from($db->quoteName("#__gotauction_auctioneer").' AS d');
		$query->from($db->quoteName("#__gotauction_address").' AS e');
		
		$query->where("a.id=" . $auction_id);
		$query->where("a.auction_type=b.id");
		$query->where("a.auction_category=c.id");
		$query->where("a.auctioneer=d.id");
		$query->where("a.address=e.id");
		
		
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

