<?php

namespace Framework\View\Model\Service;

use Framework\View\Model\Model as Base;
use Framework\View\Model\ViewModel as Model;

trait ViewModel
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     * @return void
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $vars
     * @return Model
     */
    public function model(array $vars = [])
    {
        !$this->model && $this->model = new Base;

        $vars && $this->model->vars($vars);

        return $this->model;
    }

    /**
     * @param string $template
     * @param array $vars
     * @return Model
     */
    public function view($template = null, array $vars = [])
    {
        $this->model($vars);

        $template && $this->model->template($template);

        return $this->model;
    }
}
