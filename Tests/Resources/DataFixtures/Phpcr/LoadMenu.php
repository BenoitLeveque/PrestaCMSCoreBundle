<?php
/**
 * This file is part of the PrestaCMSCoreBundle
 *
 * (c) PrestaConcept <www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSCoreBundle\Tests\Resources\DataFixtures\Phpcr;

use Doctrine\Common\Persistence\ObjectManager;
use PHPCR\Util\NodeHelper;
use Symfony\Component\Yaml\Parser;

use Presta\CMSCoreBundle\DataFixtures\PHPCR\BaseMenuFixture;

use Presta\CMSCoreBundle\Doctrine\Phpcr\Website;

/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 */
class LoadMenu extends BaseMenuFixture
{
    /**
     * Création des menus de navigation
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $session = $manager->getPhpcrSession();

        //Create namespace menu
        NodeHelper::createPath($session, '/website/sandbox/menu');
        $root = $manager->find(null, '/website/sandbox/menu');

        $configuration = array(
            'parent' => $root,
            'name' => 'main',
            'title' => array(
                'en' => 'Main navigation',
                'fr' => 'Menu principal'
            ),
            'children_content_path' => '/website/sandbox/page',
            'children' => array()
        );
        $yaml = new Parser();
        $datas = $yaml->parse(file_get_contents(FIXTURES_DIR . 'pages.yml'));
        foreach ($datas['pages'] as $pageConfiguration) {
            if (isset($pageConfiguration['meta']['title'])) {
                $pageConfiguration['title'] = $pageConfiguration['meta']['title'];
            }

            $configuration['children'][] = $pageConfiguration;
        }

        $main = $this->getFactory()->create($configuration);
        $main->setChildrenAttributes(array("class" => "nav"));

        $configuration = array(
            'parent' => $root,
            'name' => 'singles-pages',
            'title' => array(
                'en' => 'Singles Pages',
                'fr' => 'Pages simples'
            ),
            'children_content_path' => '/website/sandbox/page',
            'children' => array()
        );
        $singlePages = $this->getFactory()->create($configuration);

        $manager->flush();
    }
}
