<?php
/**
 *
 */

namespace Framework\Service\Resolver;

use Framework\Event\Base;

trait EventSignal
{
    /**
     *
     */
    use Base;
    use Signal;

    /**
     * @return array
     */
    protected abstract function args();

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        return $this->signal($callable, $this->args() + $args, $callback);
    }
}
