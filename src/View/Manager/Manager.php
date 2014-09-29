<?php

namespace Framework\View\Manager;

use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Service\AliasTrait as Alias;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;
use Framework\View\Exception\EventInterface as Exception;
use Framework\View\Render\EventInterface as Render;
use Framework\View\Plugin\PluginInterface;
use Framework\View\Render\RenderInterface;
use Framework\View\Model\ModelInterface as ViewModel;

class Manager
    implements EventManagerInterface,
               ManagerInterface,
               PluginInterface,
               RenderInterface,
               ServiceManagerInterface
{
    /**
     *
     */
    use Alias,
        Events;

    /**
     * @param \Exception $exception
     * @return mixed
     */
    public function exception(\Exception $exception)
    {
        return $this->trigger([Exception::EXCEPTION, $exception]);
    }

    /**
     * @param string $name
     * @param array $args
     * @return null|callable|object
     */
    public function plugin($name, array $args = [])
    {
        return $this->get($this->alias(strtolower($name)), $args);
    }

    /**
     * @param ViewModel $viewModel
     * @param array $options
     * @return mixed
     */
    public function render(ViewModel $viewModel, array $options = [])
    {
        return $this->trigger([Render::RENDER, $viewModel], $options);
    }
}
