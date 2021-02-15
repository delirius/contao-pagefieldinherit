<?php
declare(strict_types=1);



namespace Delirius\PageFieldInherit\EventListener;

use Contao\LayoutModel;
use Contao\PageModel;

class PageClassListener
{
    /**
    * Prepends the css class of the root page.
    *
    * @param PageModel   $objPage
    * @param LayoutModel $objLayout
    */
    public function onGeneratePage(PageModel $pageModel, LayoutModel $layoutModel): void
    {
        $strValue = '';

        if ( is_array($pageModel->trail) )
        {
            $trails = PageModel::findMultipleByIds(array_reverse($pageModel->trail));

            if (NULL !== $trails) {
                foreach ($trails as $arrValue) {
                    if ( !empty($arrValue->pageinheritcssclass) )
                    {
                        $strValue = $arrValue->pageinheritcssclass;
                        break;
                    }

                }
            }

        }

        if ($strValue != '')
        {
            $layoutModel->cssClass = $layoutModel->cssClass.' '.$strValue;
        }

    }
}
