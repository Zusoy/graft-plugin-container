<?php

namespace Graft\Container;

/**
 * Container Parameter
 * 
 * @package  Graft/Container
 * @category Container
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.2
 */
class Parameter
{
    /**
     * Parameter Name
     *
     * @var string
     */
    protected $name;

    /**
     * Parameter Value
     *
     * @var mixed
     */
    protected $value;


    /**
     * Parameter Constructor
     *
     * @param string|null $name  Parameter Name (optional)
     * @param mixed|null  $value Parameter Value (optional)
     */
    public function __construct(?string $name = null, $value = null)
    {
        if ($name !== null) {
            $this->setName($name);
        }

        if ($value !== null) {
            $this->setValue($value);
        }
    }


    /**
     * Set Parameter Name
     *
     * @param string $name Parameter Name
     * 
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Get Parameter Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set Parameter Value
     *
     * @param mixed $value Parameter Value
     * 
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }


    /**
     * Get Parameter Value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}