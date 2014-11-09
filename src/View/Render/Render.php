<?php

namespace Framework\View\Render;

use Framework\Event\Base;
use Framework\Event\Event;
use Framework\Service\Resolver\Signal;
use Framework\View\Model\ViewModel;

class Render
    implements Event, RenderView
{
    /**
     *
     */
    use Base;
    use Signal;

    /**
     *
     */
    const EVENT = self::VIEW;

    /**
     * @var ViewModel
     */
    protected $model;

    /**
     * @param ViewModel $model
     */
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Args::EVENT => $this,
            Args::MODEL => $this->model
        ];
    }

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
