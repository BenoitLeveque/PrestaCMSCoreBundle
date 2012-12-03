<?php
/*
 * This file is part of the Presta Bundle project.
 *
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSCoreBundle\Document\Website\Theme;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCRODM;
use Symfony\Component\Validator\Constraints as Assert;

use Presta\CMSCoreBundle\Document\Website\Theme;

use Symfony\Cmf\Bundle\BlockBundle\Document\ContainerBlock;

/**
 * Theme Document child of a website
 *
 * @package    Presta
 * @subpackage CMSCoreBundle
 * @author     Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * @PHPCRODM\Document(referenceable=true)
 */
class Zone extends ContainerBlock
{

    public function getType()
    {
        return 'presta_cms.theme.zone';
    }

    public function getBlocks()
    {
        return $this->getChildren();
    }

//    /** @PHPCRODM\Id(strategy="parent") */
//    protected $id;
//
//    /**
//     * @var Theme
//     * @Assert\NotBlank
//     * @PHPCRODM\ParentDocument()
//     */
//    protected $parent;
//
//    /**
//     * @var string
//     * @Assert\NotBlank
//     * @PHPCRODM\Nodename()
//     */
//    protected $name;
//
//    /** @PHPCRODM\Children */
//    protected  $children;
//
//
//    public function __toString()
//    {
//        return $this->getName();
//    }
//
//    /**
//     * Id (path) of this document
//     *
//     * @return string the id
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @param string $name
//     */
//    public function setName($name)
//    {
//        $this->name = $name;
//    }
//
//    /**
//     * @return string
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param Website $parent
//     */
//    public function setParent($parent)
//    {
//        $this->parent = $parent;
//    }
//
//    /**
//     * @return Website
//     */
//    public function getParent()
//    {
//        return $this->parent;
//    }
//
//
//    /**
//     * The children documents of this document
//     *
//     * If there is information on the document type, the documents are of the
//     * specified type, otherwise they will be Generic documents
//     *
//     * @return object documents
//     */
//    public function getChildren()
//    {
//        return $this->children;
//    }
//
//    /**
//     * Sets the children
//     *
//     * @param $children ArrayCollection
//     */
//    public function setChildren(ArrayCollection $children)
//    {
//        $this->children = $children;
//    }
//
//    /**
//     * Add a child to this document
//     *
//     * @param $child
//     */
//    public function addChild($child)
//    {
//        if (null === $this->children) {
//            $this->children = new ArrayCollection();
//        }
//
//        $this->children->add($child);
//    }

}