<?php
/**
 *
 */

namespace Framework\View\Render;

use Framework\Event\Event;
use Framework\Service\Resolver\EventSignal;
use Framework\View\Model\ViewModel;

class Render
    implements Event, RenderView
{
    /**
     *
     */
    use EventSignal;

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
}
