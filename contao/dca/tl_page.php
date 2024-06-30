<?php
declare (strict_types = 1);

/*
 * This file is part of Felder mit Vererbung in der Seitenstruktur.
 *
 * (c) Daniel Herren 2024 <contao@delirius.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/delirius/contao-pagefieldinherit
 */

use Contao\Backend;
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\Database;
use Contao\DataContainer;

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
//$GLOBALS['TL_DCA']['tl_page']['fields']['alias']['save_callback'] = array( array('tl_page_ext', 'generateAlias') );

$GLOBALS['TL_DCA']['tl_page']['config']['onload_callback'][] = array('tl_page_extend', 'getPlaceholder');

$GLOBALS['TL_DCA']['tl_page']['fields']['pageinheritcssclass'] = array
	(
	'exclude' => true,
	//'filter' => false,
	//'sorting' => false,
	'search' => true,
	'inputType' => 'text',
	'eval' => array(
		'tl_class' => 'w50',
		'maxlength' => 255,
		'placeholder' => &$GLOBALS['TL_LANG']['tl_page']['pageinheritcssclass_value'],
	),
	'sql' => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['pageinheritvalue'] = array
	(
	'exclude' => true,
	//'filter' => false,
	//'sorting' => false,
	'search' => true,
	'inputType' => 'textarea',
	'eval' => array(
		'tl_class' => 'clr w50',
		'maxlength' => 255,
		'preserveTags' => true,
		'placeholder' => &$GLOBALS['TL_LANG']['tl_page']['pageinheritvalue_value'],
	),
	'sql' => "varchar(255) NOT NULL default ''",
);

class tl_page_extend extends Backend {

	public function getPlaceholder(DataContainer $dc) {

		$pageid = $dc->id;

		if (NULL != $pageid) {
			$GLOBALS['TL_LANG']['tl_page']['pageinheritcssclass_value'] = tl_page_extend::getInheritValue($pageid, 'pageinheritcssclass');
			$GLOBALS['TL_LANG']['tl_page']['pageinheritvalue_value'] = tl_page_extend::getInheritValue($pageid, 'pageinheritvalue');
		}

	}

	public function getInheritValue($pageid, $getfield): ?string {
		global $strInherit;
		$strInherit = '';
		$sql = "SELECT id,pid,type," . $getfield . " FROM tl_page WHERE id = ? ORDER BY sorting";
		$objData = Database::getInstance()->prepare($sql)->execute($pageid);
		while ($objData->next()) {
			if (NULL != $objData->$getfield) {
				$strInherit = $objData->$getfield;
				break;
			}
			if ($objData->type !== 'root') {
				self::getInheritValue($objData->pid, $getfield);
			}
		}
		return $strInherit;

	}
} // class
