<?php
/**
 *
 */

namespace Framework\View\Exception;

use Exception;
use Framework\View\Model\Base;

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
