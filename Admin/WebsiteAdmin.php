<?php
/*
 * This file is part of the Presta Bundle project.
 *
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Presta\CMSCoreBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Knp\Menu\MenuItem;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Presta\CMSCoreBundle\Model\ThemeManager;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin as BaseAdmin;
/**
 * Admin definition for the Site class
 *
 * @author     Nicolas Bastien <nbastien@prestaconcept.net>
 */
class WebsiteAdmin extends BaseAdmin
{
    /**
     * The translation domain to be used to translate messages
     *
     * @var string
     */
    protected $translationDomain = 'PrestaCMSCoreBundle';

    /**
     * @var array
     */
    protected $availableLocales;

    /**
     * @var Presta\CMSCoreBundle\Model\ThemeManager
     */
    protected $themeManager;

    /**
     * Return current edition locale
     * -> paramètre de l'url
     *
     * @return string
     */
    protected function getTranslatableLocale()
    {
        if ($this->request && $this->getRequest()->get('translatable_locale') != null) {
            return  $this->getRequest()->get('translatable_locale');
        }

        return $this->getConfigurationPool()->getContainer()->getParameter('locale');
    }

    /**
     * Set available locales : called via DI
     *
     * @param array $availableLocales
     */
    public function setAvailableLocales($availableLocales)
    {
        $this->availableLocales = $availableLocales;
    }

    /**
     * Setter for themeManager
     *
     * @param  ThemeManager $themeManager
     * @return void
     */
    public function setThemeManager(ThemeManager $themeManager)
    {
        $this->themeManager = $themeManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        //Should be create by Fixtures
        //Host handle by configuration
        $collection->remove('create');

        parent::configureRoutes($collection);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', 'text')
            ->add('theme', 'text')
            ->add('defaultLocale', 'locale', array('template' => 'PrestaCMSCoreBundle:CRUD:list_locale.html.twig'))
            ->add('availableLocales', 'array', array('template' => 'PrestaCMSCoreBundle:CRUD:list_array_locale.html.twig'))

            ->add('isActive', 'boolean')
            ->add('isDefault', 'boolean')

            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name', null, array())
            ->add('theme', null, array())
            ->add('default', 'boolean', array())
            ->add('active', 'boolean', array())
            ->add('defaultLocale', null, array())
        ;
    }

    /**
     * Configure form per locale
     *
     * @param  Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $locale = $this->getTranslatableLocale();
        $formMapper
            ->with($this->trans('form_site.label_general'))
//                ->add('default', 'checkbox', array('attr' => array('class' => 'locale locale_' . $locale), 'required' => false))
//                ->add('active', 'checkbox', array('attr' => array('class' => 'locale locale_' . $locale), 'required' => false))

                ->add('theme', 'choice', array('attr' => array('class' => 'sonata-medium locale locale_' . $locale), 'choices' => $this->themeManager->getAvailableThemeCodesForSelect()))
//                ->add('defaultLocale', 'choice', array('choices' => $this->availableLocales))
//                ->add('availableLocales', 'choice', array(
//                    'choices'   => $this->availableLocales,
//                    'expanded'  => true,
//                    'multiple'  => true
//                ))
            ->end()
        ;
    }

    /**
     * Allow to select locale to edit in side menu
     *
     * @param  MenuItemInterface              $menu
     * @param                                 $action
     * @param  Sonata\AdminBundle\Admin\Admin $childAdmin
     * @return void
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $object = $this->getSubject();
        if (!in_array($action, array('edit')) || is_null($this->getUrlsafeIdentifier($object))) {
            return;
        }

        foreach ($object->getAvailableLocales() as $locale) {
            $menuItem = $menu->addChild(
                $this->trans($locale),
                array('uri' => $this->generateObjectUrl('edit', $object, array('translatable_locale' => $locale)))
            );
            $menuItem->setAttribute('class', 'locale locale_' . $locale);

            // select current edited locale item in menu
            if ($object->getLocale() == $locale) {
                $menu->setCurrentUri($this->generateObjectUrl('edit', $object, array('translatable_locale' => $locale)));
            }
        }
    }

    /**
     * Refresh object to load locale get in param
     *
     * @param   $id
     * @return  $subject
     */
    public function getObject($id)
    {
        $subject = parent::getObject($id);

        $subject = $this->modelManager->getDocumentManager()->findTranslation(null, $subject->getPath(), $this->getTranslatableLocale());

        return $subject;
    }

    /**
     * {@inheritdoc}
     */
    public function generateUrl($name, array $parameters = array(), $absolute = false)
    {
        if ($name == 'create' || $name == 'edit') {
            $parameters = $parameters + array('translatable_locale' => $this->getTranslatableLocale());
        }

        return parent::generateUrl($name, $parameters, $absolute);
    }

}
