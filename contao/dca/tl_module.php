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

use Delirius\ContaoPagefieldinherit\Controller\FrontendModule\PageInheritModuleController;

/**
 * Frontend modules
 */
$GLOBALS['TL_DCA']['tl_module']['palettes'][PageInheritModuleController::TYPE] = '{title_legend},name,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
