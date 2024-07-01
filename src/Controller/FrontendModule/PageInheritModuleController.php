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

namespace Delirius\ContaoPagefieldinherit\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'miscellaneous', template: 'mod_page_inherit')]
class PageInheritModuleController extends AbstractFrontendModuleController {
	public const TYPE = 'page_inherit_module';

	protected ?PageModel $page;

	/**
	 * This method extends the parent __invoke method,
	 * its usage is usually not necessary.
	 */
	public function __invoke(Request $request, ModuleModel $model, string $section, array $classes = null, PageModel $page = null): Response {
		// Get the page model
		$this->page = $page;

		$scopeMatcher = $this->container->get('contao.routing.scope_matcher');

		if ($this->page instanceof PageModel && $scopeMatcher->isFrontendRequest($request)) {
			$this->page->loadDetails();
		}

		return parent::__invoke($request, $model, $section, $classes);
	}

	protected function getResponse(Template $template, ModuleModel $model, Request $request): Response {

		$trails = PageModel::findMultipleByIds(array_reverse($GLOBALS['objPage']->trail));

		$arrInheritValues = array();
		if (NULL !== $trails) {
			foreach ($trails as $arrValues) {
				if ( ! empty($arrValues->pageinheritvalue)) {
					$arrInheritValues[] = $arrValues->pageinheritvalue;
				}

			}
		}

		$template->inheritvalue = $arrInheritValues[0] ?? '';

		return $template->getResponse();
	}
}
