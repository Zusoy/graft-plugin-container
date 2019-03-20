<?php

namespace Graft\Container;

use Graft\Container\WPExecutableComponent;

/**
 * WordPress Hook Component
 * 
 * @abstract
 * 
 * @package  Graft/Container
 * @category Component
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
abstract class WPHook extends WPExecutableComponent
{
    /**
     * Hook Tag
     *
     * @var string
     */
    protected $tag;
    
    /**
     * Hook Priority
     *
     * @var int
     */
    protected $priority;

    /**
     * Hook Accept Params
     *
     * @var int
     */
    protected $acceptedParams;


    /**
     * WPHook Constructor
     *
     * @param string $tag Hook Tag
     */
    public function __construct(string $tag)
    {
        $this->setTag($tag);
    }


    /**
     * Set Hook Tag
     *
     * @param string $tag Hook Tag
     * 
     * @return self
     */
    public function setTag(string $tag)
    {
        $this->tag = $tag;

        return $this;
    }


    /**
     * Get Hook Tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }


    /**
     * Set Hook Priority
     *
     * @param integer $priority Hook Priority
     * 
     * @return self
     */
    public function setPriority(int $priority)
    {
        $this->priority = $priority;

        return $this;
    }


    /**
     * Get Hook Priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }


    /**
     * Set Hook Accepted Params Count
     *
     * @param integer $params Accepted Params Counts
     * 
     * @return self
     */
    public function setAcceptedParams(int $params)
    {
        $this->acceptedParams = $params;

        return $this;
    }


    /**
     * Get Hook Accepted Params Count
     *
     * @return int
     */
    public function getAcceptedParams()
    {
        return $this->acceptedParams;
    }


    /**
     * Check if Hook is Playing
     * 
     * @abstract
     *
     * @return boolean
     */
    public abstract function isPlaying();
}