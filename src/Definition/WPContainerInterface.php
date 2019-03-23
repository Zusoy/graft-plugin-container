<?php

namespace Graft\Container\Definition;

use Psr\Container\ContainerInterface;
use Graft\Container\WPComponent;

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
}