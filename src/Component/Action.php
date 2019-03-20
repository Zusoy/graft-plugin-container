<?php

namespace Graft\Container\Component;

use Graft\Container\WPHook;

/**
 * WordPress Action
 * 
 * @package  Graft/Container/Component
 * @category Component
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
class Action extends WPHook
{
    /**
     * Action Constructor
     * 
     * @final
     * 
     * @param string $tag Action Tag
     */
    final public function __construct(string $tag)
    {
        parent::__construct($tag);
        $this->setId("hook.action.".$this->tag);
    }


    /**
     * Check if Action is Playing
     *
     * @return boolean
     */
    public function isPlaying()
    {
        return \doing_action($this->tag);
    }
}