<?php
/**
 *
 */

namespace Mvc5\View\Exception;

use Exception;
use Mvc5\View\Model\Base;

class Model
    implements ExceptionModel
{
    /**
     *
     */
    use Base;

    /**
     * @param Exception $exception
     * @return mixed
     */
    public function exception(Exception $exception)
    {
        $this->set(self::EXCEPTION, $exception);
    }
}
