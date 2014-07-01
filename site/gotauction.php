<?php

defined ("_JEXEC") or die();

$document=JFactory::getDocument();


$controller=JControllerLegacy::getInstance('Gotauction');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();

