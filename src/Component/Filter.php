<?php

namespace Graft\Container\Component;

use Graft\Container\WPHook;

/**
 * WordPress Filter
 * 
 * @package  Graft/Container/Component
 * @category Component
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
class Filter extends WPHook
{
    /**
     * Filter Constructor
     * 
     * @final
     * 
     * @param string $tag Filter Tag
     */
    final public function __construct(string $tag)
    {
        parent::__construct($tag);
        $this->setId("hook.filter.".$this->tag);
    }


    /**
     * Check if Filter is Playing
     *
     * @return boolean
     */
    public function isPlaying()
    {
        return \doing_filter($this->tag);
    }
}