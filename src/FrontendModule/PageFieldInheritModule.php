<?php
declare(strict_types=1);

namespace Delirius\PageFieldInherit\FrontendModule;
use Doctrine\DBAL\Driver\Connection;
use Contao\PageModel;

class PageFieldInheritModule extends \Module {

    /**
    * Template
    * @var string
    */
    protected $strTemplate = 'pageinherit_default';

    /**
    * Display a wildcard in the back end
    *
    * @return string
    */
    public function generate() {
        if (TL_MODE == 'BE') {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['page_inherit_module'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
    * Compile the current element
    */
    protected function compile() {

        $this->Template = new \FrontendTemplate($this->strTemplate);


        $objParams = \Database::getInstance()->prepare("SELECT * FROM tl_module WHERE id=?")
        ->limit(1)
        ->execute($this->id);



        //Wenn nötig, dann neues Template aktivieren
        if (($objParams->pageinherit_template != $this->strTemplate) && ($objParams->pageinherit_template != ''))
        {
            $this->strTemplate = $objParams->pageinherit_template;
            $this->Template = new \FrontendTemplate($this->strTemplate);
        }



        //$query = 'SELECT pageinheritvalue FROM tl_page WHERE 1 AND alias = ? ';
        $trails = PageModel::findMultipleByIds(array_reverse($GLOBALS['objPage']->trail));

        $arrInheritValues = array();
        if (NULL !== $trails) {
            foreach ($trails as $arrValues) {
                if ( !empty($arrValues->pageinheritvalue) )
                {
                    $arrInheritValues[] = $arrValues->pageinheritvalue;
                }

            }
        }

        $this->Template->inheritvalue = $arrInheritValues[0];


    } // compile



} // class
