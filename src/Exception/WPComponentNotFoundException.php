<?php

namespace Graft\Container\Exception;

use Graft\Container\Exception\WPContainerException;
use Psr\Container\NotFoundExceptionInterface;

/**
 * WP Component Not Found Exception
 * 
 * @package  Graft/Container/Exception
 * @category Exception
 * @author   Zusoy <gregoire.drapeau79@gmail.com>
 * @license  MIT
 * @since    0.0.1
 */
class WPComponentNotFoundException extends WPContainerException implements NotFoundExceptionInterface
{
    
}