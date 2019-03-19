<?php

namespace Graft\Container;

use Graft\Container\Exception\WPComponentNotFoundException;
use Psr\Container\ContainerInterface;
use Graft\Container\WPComponent;
use Graft\Container\WPExecutableComponent;
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
class WPContainer implements ContainerInterface
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
}