<?php

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['page_inherit_module'] = '{title_legend},name,type;{template_legend},pageinherit_template;';



/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['pageinherit_template'] = array
(
'label' => &$GLOBALS['TL_LANG']['tl_module']['pageinherit_template'],
 'default' => 'pageinherit_default',
 'exclude' => true,
 'inputType' => 'select',
 'options_callback' => array('tl_module_pageinherit', 'getTemplates'),
 'eval' => array('includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50', 'placeholder' => 'inhert'),
 'sql' => "varchar(64) NOT NULL default ''"
);





class tl_module_pageinherit extends Backend
{

    /**
     * Return all event templates as array
     * @param object
     * @return array
     */
    public function getTemplates(DataContainer $dc)
    {
        return Controller::getTemplateGroup('pageinherit_');
    }

}

?>
