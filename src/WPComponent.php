<?php

namespace Graft\Container;

/**
 * WordPress Application Component
 * 
 * @abstract
 * 
 * @package  Graft/Container
 * @category Component
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
abstract class WPComponent
{
    /**
     * Component ID
     *
     * @var string
     */
    protected $id;


    /**
     * Set Component ID
     *
     * @param string $id Component ID
     * 
     * @return self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get Component ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}