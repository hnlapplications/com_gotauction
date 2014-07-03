<?php
defined("_JEXEC") or die();

//This is the model for our edit view

class GotauctionModelEditlot extends JModelAdmin
{
	protected $text_prefix = 'COM_GOTAUCTION';
	
	public function getTable($type='Editlot', $prefix='GotauctionTable', $config=array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data=array(), $loadData=true)
	{
		$app=JFactory::getApplication();
		
		$form=$this->loadForm('com_gotauction.editlot', 'editlot', array('control' => 'jform', 'load_data' => $loadData));
		
		if (empty($form))
		{
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData()
	{
		$data=JFactory::getApplication()->getUserState('com_gotauction.edit.lot.data', array());
		
		if (empty($data))
		{
			$data = $this->getItem();
		}
		
		return $data;
	}
	
	protected function prepareTable($table)
	{
		$table->title=htmlspecialchars_decode($table->title, ENT_QUOTES);
	}
	
	
		
}
