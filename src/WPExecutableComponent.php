<?php

namespace Graft\Container;

use Graft\Container\WPComponent;

/**
 * WordPress Executable Component
 * 
 * @abstract
 * 
 * @package  Graft/Container
 * @category Component
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
abstract class WPExecutableComponent extends WPComponent
{
    /**
     * Component Callback
     *
     * @var array
     */
    protected $callback;


    /**
     * Set Component Callback
     *
     * @param array $callback Component Callback
     * 
     * @return self
     */
    public function setCallback(array $callback)
    {
        $this->callback = $callback;

        return $this;
    }


    /**
     * Get Component Callback
     *
     * @return array
     */
    public function getCallback()
    {
        return $this->callback;
    }
}