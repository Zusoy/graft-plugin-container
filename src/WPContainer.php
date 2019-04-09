<?php

namespace Graft\Container;

use Graft\Container\WPComponent;
use Graft\Container\WPHook;
use Graft\Container\Component\AdminMenu;
use DI\Container;

/**
 * Container for WordPress Application
 * 
 * @package  Graft/Container
 * @category Container
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
class WPContainer extends Container
{
    /**
     * Used WordPress Components
     * (Hook, AdminMenu, Filter...)
     *
     * @var WPComponent[]
     */
    protected $wpComponents = [];


    /**
     * Add WordPress Component in Container
     *
     * @param WPComponent $component
     * 
     * @return self
     */
    public function addWordPressComponent(WPComponent $component)
    {
        $this->wpComponents[] = $component;

        return $this;
    }


    /**
     * Get WordPress Components
     *
     * @return WPComponent[]
     */
    public function getWordPressComponents()
    {
        return $this->wpComponents;
    }


    /**
     * Get WordPress Hook Components
     *
     * @return WPHook[]|null
     */
    public function getHookComponents()
    {
        return \array_filter($this->wpComponents, function($component)
        {
            return ($component instanceof WPHook);
        });
    }


    /**
     * Get WordPress Administration Menu Components
     *
     * @return void
     */
    public function getMenuComponents()
    {
        return \array_filter($this->wpComponents, function($component)
        {
            return ($component instanceof AdminMenu);
        });
    }
}