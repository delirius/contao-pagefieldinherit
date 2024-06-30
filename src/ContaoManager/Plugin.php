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

namespace Delirius\ContaoPagefieldinherit\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface {
	public function getBundles(ParserInterface $parser): array {
		return [
			BundleConfig::create('Delirius\ContaoPagefieldinherit\DeliriusContaoPagefieldinherit')
				->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle']),
		];
	}
}
