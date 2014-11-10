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
     * @return self
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
        if (!$this->model) {
            return $vars ? new Base(null, $vars) : new Base;
        }

        $vars && $this->model->vars($vars);

        return $this->model;
    }

    /**
     * @param string $template
     * @param array $vars
     * @return Model
     */
    public function view($template, array $vars = [])
    {
        $model = $this->model($vars);

        $template && $model->template($template);

        return $model;
    }
}
