<?php

namespace Graft\Container\Component;

use Graft\Container\WPExecutableComponent;
use Cocur\Slugify\Slugify;

/**
 * WordPress Administration Menu
 * 
 * @package  Graft/Container/Component
 * @category Component
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
class AdminMenu extends WPExecutableComponent
{
    /**
     * Menu Title
     *
     * @var string
     */
    protected $title;

    /**
     * Menu Capability
     *
     * @var string
     */
    protected $capability;

    /**
     * Menu Parent
     *
     * @var string|null
     */
    protected $parent;

    /**
     * Menu Icon
     *
     * @var string|null
     */
    protected $icon;

    /**
     * Menu Position
     *
     * @var int|null
     */
    protected $position;

    /**
     * Menu Slug
     *
     * @var string
     */
    protected $slug;


    /**
     * AdminMenu Constructor
     * 
     * @final
     *
     * @param string           $title      Menu Title
     * @param array            $callback   Menu Callback
     * @param string           $capability Menu Capability
     * @param self|string|null $parent     Menu Parent
     * @param string|null      $icon       Menu Icon
     * @param integer|null     $pos        Menu Position
     */
    final public function __construct(
        string $title,
        array $callback,
        string $capability,
        $parent = null,
        ?string $icon = null,
        ?int $pos = null
    )
    {
        $this->setTitle($title)
            ->setCallback($callback)
            ->setCapability($capability)
            ->setParent($parent)
            ->setIcon($icon)
            ->setPosition($pos);
        
        //set menu Slug
        $slugify = new Slugify();
        $this->setSlug($slugify->slugify($title, '_'));

        //create Menu through Hook
        $action = ($this->isSubmenu()) 
            ? "hookCreateSubmenu" 
            : "hookCreateMenu";
        
        add_action("admin_menu", [$this, $action]);
    }


    /**
     * Create WordPress Menu
     *
     * @return void
     */
    public function hookCreateMenu()
    {
        \add_menu_page(
            $this->getTitle(),
            $this->getTitle(),
            $this->getCapability(),
            $this->getSlug(),
            $this->getCallback(),
            $this->getIcon(),
            $this->getPosition()
        );
    }


    /**
     * Create WordPress Submenu
     *
     * @return void
     */
    public function hookCreateSubmenu()
    {
        \add_submenu_page(
            $this->getParent(),
            $this->getTitle(),
            $this->getTitle(),
            $this->getCapability(),
            $this->getSlug(),
            $this->getCallback()
        );
    }


    /**
     * Set Menu Title
     *
     * @param string $title Menu Title
     * 
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Get Menu Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set Menu Capability
     *
     * @param string $capability Menu Capability
     * 
     * @return self
     */
    public function setCapability(string $capability)
    {
        $this->capability = $capability;

        return $this;
    }


    /**
     * Get Menu Capability 
     *
     * @return string
     */
    public function getCapability()
    {
        return $this->capability;
    }


    /**
     * Set Menu Parent
     *
     * @param self|string|null $parent Menu Parent
     * 
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = ($parent instanceof AdminMenu)
            ? $this->parent->getSlug()
            : $parent;
        
        return $this;
    }

    
    /**
     * Get Menu Parent
     *
     * @return string|null
     */
    public function getParent()
    {
        return $this->parent;
    }


    /**
     * Set Menu Icon
     *
     * @param string|null $icon Menu Icon Path
     * 
     * @return self
     */
    public function setIcon(?string $icon)
    {
        $this->icon = $icon;

        return $this;
    }


    /**
     * Get Menu Icon
     *
     * @return string|null
     */
    public function getIcon()
    {
        return $this->icon;
    }


    /**
     * Set Menu Position
     *
     * @param int|null $position Menu Position
     * 
     * @return self
     */
    public function setPosition(?int $position)
    {
        $this->position = $position;
        
        return $this;
    }


    /**
     * Get Menu Position
     * 
     * @return int|null
     */
    public function getPosition()
    {
        return $this->position;
    }


    /**
     * Set Menu Slug
     *
     * @param string $slug Menu Slug
     * 
     * @return self
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }


    /**
     * Get Menu Slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Check if is Submenu
     *
     * @return boolean
     */
    public function isSubmenu()
    {
        return ($this->parent !== null);
    }
}