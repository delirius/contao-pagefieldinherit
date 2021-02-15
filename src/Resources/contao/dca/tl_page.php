<?php

// contao/dca/tl_example.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\Config;

// PaletteManipulator::create()
//     // add a new "custom_legend" before the "date_legend"
//     ->addLegend('pageinherit_legend', 'publish_legend', PaletteManipulator::POSITION_BEFORE)
//
//     // directly add new fields to the new legend
//     ->addField('pageinheritvalue', 'pageinherit_legend', PaletteManipulator::POSITION_APPEND)
//
//     // then apply it to the palette as usual
//     ->applyToPalette('regular', 'tl_page')
// ;


$pm = PaletteManipulator::create()
// add a new "custom_legend" before the "date_legend"
->addLegend('pageinherit_legend', 'publish_legend', PaletteManipulator::POSITION_BEFORE)
// directly add new fields to the new legend
->addField('pageinheritcssclass', 'pageinherit_legend', PaletteManipulator::POSITION_APPEND)
->addField('pageinheritvalue', 'pageinherit_legend', PaletteManipulator::POSITION_APPEND)
;


foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $name => $palette) {
    if ('__selector__' === $name || 'redirect' === $name) {
        continue;
    }

    $pm->applyToPalette($name, 'tl_page');
}


// Hinzufügen der Feld-Konfiguration
//
$GLOBALS['TL_DCA']['tl_page']['fields']['pageinheritcssclass'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_page']['pageinheritcssclass'],
    'exclude' => true,
    'filter' => true,
    'sorting' => true,
    'search' => false,
    'inputType' => 'text',
    'eval' => array(
        'tl_class' => 'w50',
        'maxlength' => 255,
        'placeholder' => tl_page_ext::getPlaceholder('pageinheritcssclass')
    ),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['pageinheritvalue'] = array
(
'label' => &$GLOBALS['TL_LANG']['tl_page']['pageinheritvalue'],
'exclude' => true,
    'filter' => true,
    'sorting' => true,
    'search' => false,
    'inputType' => 'text',
    'eval' => array(
    'tl_class' => 'clr w50',
        'maxlength' => 255,
        'placeholder' => tl_page_ext::getPlaceholder('pageinheritvalue')
    ),
    'sql' => "varchar(255) NOT NULL default ''"
);


class tl_page_ext extends Backend {

    public function getPlaceholder($field) {
        $str = '';
        $pageid= \Input::get('id');

        if (NULL != $pageid && NULL != $field )
        {
            $str = tl_page_ext::getInheritValue($pageid, $field);
        }
        return $str;

    }

    public function getInheritValue($pageid, $getfield ): ?string
    {
        global $strInherit;
        $strInherit = '';
        $sql = "SELECT id,pid,type,".$getfield." FROM tl_page WHERE id = ? ORDER BY sorting";
        $objData = \Database::getInstance()->prepare($sql)->execute($pageid);
        while ($objData->next())
        {
            if (NULL != $objData->$getfield)
            {
                $strInherit = $objData->$getfield;
                break;
            }
            if ($objData->type !== 'root')
            {
                self::getInheritValue($objData->pid, $getfield);
            }
        }
        return $strInherit;

    }
} // class
