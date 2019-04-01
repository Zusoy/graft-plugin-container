<?php

namespace Graft\Container\Definition;

use Psr\Container\ContainerInterface;
use Graft\Container\WPComponent;
use Graft\Container\Parameter;

/**
 * WordPress Container Interface
 * 
 * @package  Graft/Container
 * @category Definition
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
interface WPContainerInterface extends ContainerInterface
{
    /**
     * Register WordPress Component
     *
     * @param string      $id        Component ID
     * @param WPComponent $component Component Instance
     * 
     * @return self
     */
    public function register(string $id, WPComponent $component);
    
    /**
     * Add Container Parameter
     *
     * @param Parameter $parameter Parameter to Add
     * 
     * @return self
     */
    public function addParameter(Parameter $parameter);

    /**
     * Get Container Parameter
     *
     * @param string $name Parameter Name
     * 
     * @return mixed
     */
    public function getParameter(string $name);

    /**
     * Check if Container have Parameter
     *
     * @param string $name Parameter Name
     * 
     * @return boolean
     */
    public function hasParameter(string $name);
}