<?php
/*
 * This file is part of the Presta Bundle project.
 *
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSCoreBundle\Document\Block;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCRODM;

use Symfony\Cmf\Bundle\BlockBundle\Document\BaseBlock as CmfBaseBlock;

/**
 * BaseBlock Model
 *
 * @package    Presta
 * @subpackage CMSCoreBundle
 * @author     Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * @PHPCRODM\Document(referenceable=true, translator="attribute")
 */
abstract class BaseBlock extends CmfBaseBlock
{
    /**
     * @var boolean
     * @PHPCRODM\Boolean(translated=true)
     */
    protected $isEditable;

    /**
     * @var boolean
     * @PHPCRODM\Boolean(translated=true)
     */
    protected $isDeletable;

    /**
     * @var boolean $is_active
     * @PHPCRODM\Boolean(translated=true)
     */
    protected $isActive;

    /**
     * @var bool
     */
    protected $isAdminMode = false;

//    /**
//     * @PHPCRODM\String(multivalue=true)
//     */
//    protected $settings;

    /**
     * @PHPCRODM\Locale
     */
    protected $locale;

//    /**
//     * Returns the type
//     *
//     * @return string $type
//     */
//    function getType()
//    {
//        return 'presta_cms.block.base';
//    }

    public function getHtmlId()
    {
        return str_replace('/', '-', $this->getId());
    }
    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return boolean
     */
    public function isEditable()
    {
        return $this->isEditable;
    }

    /**
     * Set if block is editable
     *
     * @param  boolean $isEditable
     * @return \Presta\CMSCoreBundle\Block\BaseBlockService
     */
    public function setIsEditable($isEditable)
    {
        $this->isEditable = $isEditable;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDeletable()
    {
        return $this->isDeletable;
    }

    /**
     * Set if block is delitable
     *
     * @param  boolean $isDeletable
     * @return \Presta\CMSCoreBundle\Block\BaseBlockService
     */
    public function setIsDeletable($isDeletable)
    {
        $this->isDeletable = $isDeletable;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSettings()
    {
        if (!is_array($this->settings)) {
            //If translation is not created yet, Gedmo return an empty string
            return array();
        }
        return $this->settings;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return BaseThemeBlock
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /**
     * Set admin mode
     */
    public function setAdminMode()
    {
        $this->isAdminMode = true;
    }

    /**
     * @return boolean
     */
    public function isAdminMode()
    {
        return $this->isAdminMode;
    }
}
//class BaseBlock extends BaseBlock
//{
//    /** @PHPCRODM\String(translated=true) */
//    protected $title;
//
//    /** @PHPCRODM\String(translated=true) */
//    protected $content;
//
//    /**
//     * Returns the type
//     *
//     * @return string $type
//     */
//    function getType()
//    {
//        return 'presta_cms.block.simple';
//    }
//
//    public function setTitle($title)
//    {
//        $this->title = $title;
//    }
//
//    public function getTitle()
//    {
//        return $this->title;
//    }
//
//    public function setContent($content)
//    {
//        $this->content = $content;
//    }
//
//    public function getContent()
//    {
//        return $this->content;
//    }
//
//}