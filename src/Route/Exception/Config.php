<?php
/**
 *
 */

namespace Mvc5\Route\Exception;

use Mvc5\Route\Base;
use Mvc5\Route\Route;

class Config
    implements RouteException
{
    /**
     *
     */
    use Base;

    /**
     * @return \Exception
     */
    public function exception()
    {
        return $this->get(self::EXCEPTION);
    }

    /**
     * @return Route
     */
    public function route()
    {
        return $this->get(self::ROUTE);
    }
}
