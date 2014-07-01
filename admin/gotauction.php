<?php

defined("_JEXEC") or die();

//if the user does not have permissions to manage this component, throw an error
if (!JFactory::getUser()->authorise('core.manage', 'com_gotauction'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$controller=JControllerLegacy::getInstance('Gotauction'); //this will call up the class GotauctionController
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect(); //the controller will now redirect to the appropriate page depending on the given task (which is probably in the url)
