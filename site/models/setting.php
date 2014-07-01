<?php 





defined ('_JEXEC') or die();

class GotauctionModelSetting extends JModelAdmin
{	
	protected $text_prefix = 'COM_GOTAUCTION';
	
	public function getTable($type='Setting', $prefix='GotauctionTable', $config=array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data=array(), $loadData=true)
	{
		$app=JFactory::getApplication();
		
		$form=$this->loadForm('com_gotauction.setting', 'setting', array('control' => 'jform', 'load_data' => $loadData));
		
		if (empty($form))
		{
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData()
	{
		$data=JFactory::getApplication()->getUserState('com_gotauction.edit.setting.data', array());
		
		if (empty($data))
		{
			$data = $this->getItem();
		}
		
		return $data;
	}
	
	/*protected function prepareTable($table)
	{
		$table->first_name=htmlspecialchars_decode($table->first_name, ENT_QUOTES);
	}*/
}
