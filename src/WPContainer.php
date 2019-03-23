<?php

namespace Graft\Container;

use Graft\Container\Definition\WPContainerInterface;
use Graft\Container\Exception\WPComponentNotFoundException;
use Graft\Container\Exception\WPContainerException;
use Graft\Container\WPComponent;
use Graft\Container\WPExecutableComponent;
use Graft\Container\WPHook;
use Graft\Container\Component\Action;
use Graft\Container\Component\Filter;
use Graft\Container\Component\AdminMenu;

/**
 * Container for WordPress Application
 * 
 * @package  Graft/Container
 * @category Container
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
class WPContainer implements WPContainerInterface
{
    /**
     * WordPress Container Components
     *
     * @var WPComponent[]
     */
    protected $components = [];


    /**
     * Check if Container has Component with ID
     *
     * @param string $id
     * 
     * @return boolean
     */
    public function has($id)
    {
        foreach ($this->components as $component)
        {
            if ($component->getId() === $id)
            {
                return true;
            }
        }

        return false;
    }


    /**
     * Register Component into Container
     *
     * @param string      $id        Component ID
     * @param WPComponent $component Component Instance
     * 
     * @throws WPContainerException
     * 
     * @return self
     */
    public function register(string $id, WPComponent $component)
    {
        if ($this->has($id)) {
            throw new WPContainerException(
                "The Component with ID '".$id."' already exist in container"
            );
        }

        $this->components[] = $component;

        return $this;
    }


    /**
     * Get Component by ID
     *
     * @param string $id
     * 
     * @throws WPComponentNotFoundException
     * 
     * @return WPComponent|null
     */
    public function get($id)
    {
        foreach ($this->components as $component)
        {
            if ($component->getId() === $id)
            {
                return $component;
            }
        }

        throw new WPComponentNotFoundException("WP Component with ID '".$id."' not found.");
    }


    /**
     * Get All Container Components
     *
     * @return WPComponent[]
     */
    public function getComponents()
    {
        return $this->components;
    }


    /**
     * Get Executable Components
     *
     * @return WPExecutableComponent[]|WPExecutableComponent|null
     */
    public function getExecutableComponents()
    {
        return \array_filter($this->components, function($component)
        {
            return ($component instanceof WPExecutableComponent);
        });
    }


    /**
     * Get Hook Components
     *
     * @return WPHook[]|WPHook|null
     */
    public function getHookComponents()
    {
        return \array_filter($this->components, function($component)
        {
            return ($component instanceof WPHook);
        });
    }


    /**
     * Get Action Components
     *
     * @return Action[]|Action|null
     */
    public function getActionComponents()
    {
        return \array_filter($this->components, function($component)
        {
            return ($component instanceof Action);
        });
    }


    /**
     * Get Filter Components
     *
     * @return Filter[]|Filter|null
     */
    public function getFilterComponents()
    {
        return \array_filter($this->components, function($component)
        {
            return ($component instanceof Filter);
        });
    }


    /**
     * Get Admin Menu Components
     *
     * @return AdminMenu[]|AdminMenu|null
     */
    public function getAdminMenuComponents()
    {
        return \array_filter($this->components, function($component)
        {
            return ($component instanceof AdminMenu);
        });
    }
}