<?php
namespace Delirius\PageFieldInherit\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Delirius\PageFieldInherit\DeliriusPageFieldInherit;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(DeliriusPageFieldInherit::class)
            ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
               ];
    }
}
?>
