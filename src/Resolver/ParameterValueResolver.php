<?php

namespace Graft\Container\Resolver;

use Graft\Container\Definition\ParameterResolverInterface;
use Graft\Container\Exception\ParameterNotFoundException;
use Graft\Container\WPContainer;

/**
 * Container Parameter Value Resolver
 * 
 * @final
 * 
 * @package  Graft/Container/Resolver
 * @category ParameterResolver
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.4
 */
final class ParameterValueResolver implements ParameterResolverInterface
{  
    /**
     * Resolve Container Parameter Value from String
     *
     * @param string      $strParam  Parameter String
     * @param WPContainer $container Container to Resolve Parameter
     * 
     * @return mixed
     */
    public function resolveParameter(string $strParam, WPContainer $container)
    {
        //check if string match (ex: %parameterName%)
        if (\substr($strParam, 0, 1) !== '%' || \substr($strParam, -1, 1) !== '%') 
        {
            return null;
        }

        $name = \str_replace("%", '', $strParam);
        $parameterValue = null;

        try {
            $parameterValue = $container->getParameter($name);
        } catch(ParameterNotFoundException $e) {
            //parameter not found
        }

        return $parameterValue;
    }
}