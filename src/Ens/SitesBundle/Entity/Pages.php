<?php

namespace Ens\SitesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ens\SitesBundle\Utils\Sites as Sites;

/**
 * Pages
 */
class Pages
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var boolean
     */
    private $menu;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $titleEn;

    /**
     * @var string
     */
    private $slugEn;

    /**
     * @var string
     */
    private $contentEn;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Pages
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set menu
     *
     * @param boolean $menu
     * @return Pages
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    
        return $this;
    }

    /**
     * Get menu
     *
     * @return boolean 
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Pages
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * @var string
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     * @return Pages
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set titleEn
     *
     * @param string $titleEn
     * @return Pages
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;
    
        return $this;
    }

    /**
     * Get titleEn
     *
     * @return string 
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * Set slugEn
     *
     * @param string $slugEn
     * @return Pages
     */
    public function setSlugEn($slugEn)
    {
        $this->slugEn = $slugEn;
    
        return $this;
    }

    /**
     * Get slugEn
     *
     * @return string 
     */
    public function getSlugEn()
    {
        return $this->slugEn;
    }

    /**
     * Set contentEn
     *
     * @param string $contentEn
     * @return Pages
     */
    public function setContentEn($contentEn)
    {
        $this->contentEn = $contentEn;
    
        return $this;
    }

    /**
     * Get contentEn
     *
     * @return string 
     */
    public function getContentEn()
    {
        return $this->contentEn;
    }


    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->slug = Sites::slugify($this->title) ;
        $this->slugEn = Sites::slugify($this->titleEn) ;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->slug = Sites::slugify($this->title) ;
        $this->slugEn = Sites::slugify($this->titleEn) ;
    }










}