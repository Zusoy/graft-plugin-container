<?php

namespace Graft\Container;

use Graft\Container\WPComponent;
use Graft\Container\WPHook;
use Graft\Container\Component\AdminMenu;
use Graft\Container\Parameter;
use Graft\Container\Exception\ParameterAlreadyExistException;
use Graft\Container\Exception\ParameterNotFoundException;
use DI\Container;

/**
 * Container for WordPress Application
 * 
 * @package  Graft/Container
 * @category Container
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
class WPContainer extends Container
{
    /**
     * Used WordPress Components
     * (Hook, AdminMenu, Filter...)
     *
     * @var WPComponent[]
     */
    protected $wpComponents = [];

    /**
     * Container Parameters
     *
     * @var Parameter[]
     */
    protected $parameters = [];


    /**
     * Add WordPress Component in Container
     *
     * @param WPComponent $component
     * 
     * @return self
     */
    public function addWordPressComponent(WPComponent $component)
    {
        $this->wpComponents[] = $component;

        return $this;
    }


    /**
     * Get WordPress Components
     *
     * @return WPComponent[]
     */
    public function getWordPressComponents()
    {
        return $this->wpComponents;
    }


    /**
     * Get WordPress Hook Components
     *
     * @return WPHook[]|null
     */
    public function getHookComponents()
    {
        return \array_filter($this->wpComponents, function($component)
        {
            return ($component instanceof WPHook);
        });
    }


    /**
     * Get WordPress Administration Menu Components
     *
     * @return void
     */
    public function getMenuComponents()
    {
        return \array_filter($this->wpComponents, function($component)
        {
            return ($component instanceof AdminMenu);
        });
    }


    /**
     * Check if Container has Parameter
     * 
     * @param string $name Parameter Name
     *
     * @return boolean
     */
    public function hasParameter(string $name)
    {
        foreach ($this->parameters as $parameter)
        {
            if ($parameter->getName() == $name)
            {
                return true;
            }
        }

        return false;
    }


    /**
     * Add Container Parameter
     * 
     * @throws ParameterAlreadyExistException
     *
     * @param Parameter $parameter Parameter object to Add
     * 
     * @return self
     */
    public function addParameter(Parameter $parameter)
    {
        if ($this->hasParameter($parameter->getName())) {
            throw new ParameterAlreadyExistException(
                "The parameter with name '".$parameter->getName()."' already exist 
                in Container"
            );
        }

        $this->parameters[] = $parameter;

        return $this;
    }


    /**
     * Add Container Parameters from Array
     *
     * @param array $parametersArray Multidimensional Array
     * 
     * @return self
     */
    public function addParameters(array $parametersArray)
    {
        foreach ($parametersArray as $name => $value)
        {
            $param = new Parameter();
            $param->setName($name)->setValue($value);

            $this->addParameter($param);
        }

        return $this;
    }


    /**
     * Get Container parameter by Name
     * 
     * @throws ParameterNotFoundException
     *
     * @param string $name Parameter Name to find
     * 
     * @return Parameter|null
     */
    public function getParameter(string $name)
    {
        foreach ($this->parameters as $parameter)
        {
            if ($parameter->getName() == $name)
            {
                return $parameter;
            }
        }

        throw new ParameterNotFoundException(
            "Parameter with name '".$name."' not found in Container"
        );
    }
}