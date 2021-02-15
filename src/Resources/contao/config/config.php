<?php

$GLOBALS['FE_MOD']['miscellaneous']['page_inherit_module'] = '\Delirius\PageFieldInherit\FrontendModule\PageFieldInheritModule';

if (defined('TL_MODE') && TL_MODE == 'FE')
{
    $GLOBALS['TL_HOOKS']['generatePage'][] = array('Delirius\PageFieldInherit\EventListener\PageClassListener', 'onGeneratePage');
}
