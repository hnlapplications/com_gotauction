<?php

//this is the model for the list view of clients

defined ("_JEXEC") or die();

class GotauctionModelAuctioneers extends JModelList
{
	public function __construct ($config=array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields']=array(
				'id', 'a.id',
				'name', 'a.title',
				'company', 'a.auction_id',
				'contact_no', 'a.auction_type',
				'email', 'a.auctioneer',
				'profile_image', 'a.autction_category',
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
		$db=$this->getDbo();
		
		$query=$db->getQuery(true);
		
		$query->select($this->getState(
			'list.select',
			'a.id, a.name, a.company, a.contact_no, a.email, a.profile_image'
		));
		
		$query->from($db->quoteName("#__gotauction_auctioneer").' AS a');
		
		
		/*$published=$this->getState('filter.state');
		if (is_numeric($published))
		{
			$query->where('a.state='.(int)$published);
		}
		elseif($published==='')
		{
			$query->where('(a.state IN (0, 1))');
		}
		*/
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
				
				$conditions='a.name LIKE '.$search; 
				
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
