<?php
defined("_JEXEC") or die();

//This is the model for our edit view

class GotauctionModelEditauctioneer extends JModelAdmin
{
	protected $text_prefix = 'COM_GOTAUCTION';
	
	public function getTable($type='Editauctioneer', $prefix='GotauctionTable', $config=array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data=array(), $loadData=true)
	{
		$app=JFactory::getApplication();
		
		$form=$this->loadForm('com_gotauction.editauctioneer', 'editauctioneer', array('control' => 'jform', 'load_data' => $loadData));
		
		if (empty($form))
		{
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData()
	{
		$data=JFactory::getApplication()->getUserState('com_gotauction.edit.auctioneer.data', array());
		
		if (empty($data))
		{
			$data = $this->getItem();
		}
		
		return $data;
	}
	
	protected function prepareTable($table)
	{
		$table->name=htmlspecialchars_decode($table->name, ENT_QUOTES);
	}
	
	
		
}
