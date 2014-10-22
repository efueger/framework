<?php

namespace Framework\View\Render;

use Framework\Event\Event;
use Framework\Event\BaseEvent;
use Framework\Service\Resolver\Signal;
use Framework\View\Model\ViewModel;

class Render
    implements Event, ViewRender
{
    /**
     *
     */
    use BaseEvent;
    use Signal;

    /**
     *
     */
    const EVENT = self::VIEW;

    /**
     * @var ViewModel
     */
    protected $viewModel;

    /**
     * @param ViewModel $viewModel
     */
    public function __construct(ViewModel $viewModel)
    {
        $this->viewModel = $viewModel;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Args::EVENT      => $this,
            Args::VIEW_MODEL => $this->viewModel
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [], callable $callback = null)
    {
        return $this->signal($listener, $this->args() + $args, $callback);
    }
}
