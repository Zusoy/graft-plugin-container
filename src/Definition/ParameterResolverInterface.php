<?php

namespace Graft\Container\Definition;

use Graft\Container\WPContainer;

/**
 * Container Parameter
 * 
 * @package  Graft/Container/Definition
 * @category Definition
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.4
 */
interface ParameterResolverInterface
{
    /**
     * Resolve Container Parameter
     *
     * @param string      $strParam  String to Resolve
     * @param WPContainer $container Container to get Parameter From
     * 
     * @return mixed
     */
    public function resolveParameter(string $strParam, WPContainer $container);
}