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
     * Check if Filter is Playing
     *
     * @return boolean
     */
    public function isPlaying()
    {
        return \doing_filter($this->tag);
    }


    /**
     * Hook Filter into WordPress
     *
     * @return void
     */
    public function hook()
    {
        \add_filter(
            $this->tag,
            $this->callback,
            $this->priority,
            $this->acceptedParams
        );
    }
}