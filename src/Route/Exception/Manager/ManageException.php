<?php
/**
 *
 */

namespace Mvc5\Route\Exception\Manager;

use Mvc5\Route\Route;
use Mvc5\View\Model\ViewModel;

trait ManageException
{
    /**
     * @var ExceptionManager
     */
    protected $em;

    /**
     * @param Route $route
     * @param \Exception $exception
     * @return ViewModel
     */
    public function exception(Route $route, \Exception $exception)
    {
        return $this->em->exception($route, $exception);
    }

    /**
     * @param ExceptionManager $em
     */
    public function setExceptionManager(ExceptionManager $em)
    {
        $this->em = $em;
    }
}
