<?php
declare (strict_types = 1);

namespace Delirius\ContaoPagefieldinherit\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;

#[AsHook('generatePage')]
class PageClassListener {
	/**
	 * Prepends the css class of the root page.
	 *
	 * @param PageModel   $pageModel
	 * @param LayoutModel $layoutModel
	 * @param PageRegular $pageRegular
	 */
	public function __invoke(PageModel $pageModel, LayoutModel $layoutModel, PageRegular $pageRegular): void {
		$strValue = '';

		if (is_array($pageModel->trail)) {
			$trails = PageModel::findMultipleByIds(array_reverse($pageModel->trail));

			if (NULL !== $trails) {
				foreach ($trails as $arrValue) {
					if ( ! empty($arrValue->pageinheritcssclass)) {
						$strValue = $arrValue->pageinheritcssclass;
						break;
					}

				}
			}

		}

		if ($strValue != '') {
			$layoutModel->cssClass = $layoutModel->cssClass . ' ' . $strValue;
		}

	}
}