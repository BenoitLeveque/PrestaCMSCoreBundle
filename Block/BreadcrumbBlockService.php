<?php
/**
 * This file is part of the PrestaCMSCoreBundle
 *
 * (c) PrestaConcept <www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSCoreBundle\Block;

use Presta\CMSCoreBundle\Block\BaseBlockService;

/**
 * @author Yohann Valentin <yohann.valentin.pro@gmail.com>
 */
class BreadcrumbBlockService extends BaseBlockService
{
    /**
     * @var string
     */
    protected $template = 'PrestaCMSCoreBundle:Block:block_breadcrumb.html.twig';
}
