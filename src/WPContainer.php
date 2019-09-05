<?php

namespace Graft\Container;

use Graft\Container\WPComponent;
use Graft\Container\WPHook;
use Graft\Container\Component\AdminMenu;
use Graft\Container\Component\Action;
use Graft\Container\Component\Filter;
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
     * (Action, AdminMenu, Filter...)
     *
     * @var WPComponent[]
     */
    protected $usedWpComponents = [];

    /**
     * Available Custom WordPress Hooks
     * (Action, Filter)
     *
     * @var WPHook[]
     */
    protected $availableWpHooks = [];

    /**
     * Container Parameters
     *
     * @var Parameter[]
     */
    protected $parameters = [];


    /**
     * Add Used WordPress Component in Container
     *
     * @param WPComponent $component
     * 
     * @return self
     */
    public function addUsedWordPressComponent(WPComponent $component)
    {
        $this->usedWpComponents[] = $component;

        return $this;
    }


    /**
     * Get Used WordPress Components
     *
     * @return WPComponent[]
     */
    public function getUsedWordPressComponents()
    {
        return $this->usedWpComponents;
    }


    /**
     * Get Used WordPress Hook Components
     *
     * @return WPHook[]
     */
    public function getUsedHookComponents()
    {
        return \array_filter($this->usedWpComponents, function($component)
        {
            return ($component instanceof WPHook);
        });
    }


    /**
     * Get Used WordPress Administration Menu Components
     *
     * @return AdminMenu[]
     */
    public function getUsedMenuComponents()
    {
        return \array_filter($this->usedWpComponents, function($component)
        {
            return ($component instanceof AdminMenu);
        });
    }


    /**
     * Add Available Hook Component in Container
     *
     * @param WPHook $hook
     * 
     * @return self
     */
    public function addAvailableHookComponent(WPHook $hook)
    {
        $this->availableWpHooks[] = $hook;

        return $this;
    }


    /**
     * Get Available WordPress Hooks Components
     *
     * @return WPHook[]
     */
    public function getAvailableHookComponents()
    {
        return $this->availableWpHooks;
    }


    /**
     * Get Available WordPress Action Components
     *
     * @return Action[]
     */
    public function getAvailableActionComponents()
    {
        return \array_filter($this->availableWpHooks, function($hook)
        {
            return ($hook instanceof Action);
        }); 
    }


    /**
     * Get Available WordPress Filter Components
     *
     * @return Filter[]
     */
    public function getAvailableFilterComponents()
    {
        return \array_filter($this->availableWpHooks, function($hook)
        {
            return ($hook instanceof Filter);
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
     * @param array $parametersArray Multidimensional Array (name => value)
     * 
     * @return self
     */
    public function addParametersFromArray(array $parametersArray)
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
     * Get Container parameters
     *
     * @return Parameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
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