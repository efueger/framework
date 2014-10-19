<?php

namespace Framework\View\Render;

use Framework\Event\EventInterface;
use Framework\Event\EventTrait;
use Framework\Service\Resolver\SignalTrait;
use Framework\View\Model\ModelInterface as ViewModel;

class Render
    implements EventInterface, RenderInterface
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;

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
