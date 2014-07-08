<?php

defined("_JEXEC") or die();

jimport( 'joomla.filesystem.folder' );

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
define('DS', DIRECTORY_SEPARATOR);
//this is the controller for the edit view
class GotauctionControllerEditlot extends JControllerForm
{
	function __construct()
	{
		
		parent::__construct();
	}	
	
	public function save()
	{
		$lot_id=null;
		$app=JFactory::getApplication();
		$input=$app->input;
		//get the form data
		$data=JRequest::getVar('jform', array(), 'post', 'array');		
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		//save data before saving images
		$lot=new stdClass();
		$lot->id=$data['id'];
		$lot->title=$data['title'];
		$lot->auction_id=$data['auction_id'];
		$lot->description=$data['description'];
		$lot->lot_type=$data['lot_type'];
		$lot->quantity=$data['quantity'];
		$lot->vat=$data['vat'];
		
		if ($lot->id!=null&&$lot->id!="")
		{
			$db->updateObject("#__gotauction_lot", $lot, 'id');
			$lot_id=$lot->id;
		}
		else
		{
			$db->insertObject("#__gotauction_lot", $lot);
			//now that we have inserted the lot, get the lot id
			$lot_id=$db->insertid();
		}
		
		
		
		//upload images
		$path=JPATH_BASE . DS . "images" . DS .  "com_gotauction" . DS . "lots";
		
		if (!JFolder::exists($path))
		{
			JFolder::create($path);
		}
		
		//Retrieve file details from uploaded file, sent from upload form
		$files = $input->files->get('jform1');
		//Import filesystem libraries. Perhaps not necessary, but does not hurt
		jimport('joomla.filesystem.file');
				
		foreach($files as $file)
		{
			foreach($file as $f)
			{
				if ($f['size']==0) continue;
				$filename=time() . "_" . JFile::makeSafe($f['name']);
				$src=$f['tmp_name'];
				$dest=$path . DS . $filename;
				
				if ( JFile::upload($src, $dest) ) 
				{
					//upload failed
					
					$db_record=new stdClass();
					$db_record->image=$filename;
					$db_record->lot_id=$lot_id;
					$db->insertObject("#__gotauction_images", $db_record);
				}
				else
				{
					$app->enqueueMessage("File upload failed on " . $lot_id);
				}
			}
			
			
			
		}
		//set redirect
		
		$this->setRedirect(JRoute::_("index.php?option=com_gotauction&view=lot&layout=default&id=" . $lot_id));
			
	}
	
	public function cancel()
	{
		$app=JFactory::getApplication();
		$input=JFactory::getApplication()->input;
		$referer=$input->server->get('HTTP_REFERER', 'null', 'string');
		
		$pos=strpos($referer, '&auction=');
		if ($pos!=null)
		{
			$referer=substr($referer, $pos + 9 );
			$this->setRedirect(JRoute::_('index.php?option=com_gotauction&view=auction&id=' . $referer));
		}
		else
		{
			$data=JRequest::getVar('jform', array(), 'post', 'array');
			$this->setRedirect(JRoute::_('index.php?option=com_gotauction&view=lot&id=' . $referer));
			//~ $app->enqueueMessage("<pre>" . print_r($input, true) . "</pre>");
		}
	}
}
