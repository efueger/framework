<?php

namespace Framework\View\Model;

use Framework\Config\Configuration;

interface ViewModel
    extends Configuration
{
    /**
     *
     */
    const CHILD = '__child';

    /**
     *
     */
    const TEMPLATE = '__template';

    /**
     * @return array
     */
    function config();

    /**
     * @param $model
     * @return void
     */
    function child($model);

    /**
     * @return string|self
     */
    function model();

    /**
     * @return string
     */
    function path();

    /**
     * @param string $path
     * @return void
     */
    function template($path);

    /**
     * @param array $config
     * @return void
     */
    function vars(array $config = []);

    /**
     * @param $name
     * @return mixed
     */
    function __get($name);

    /**
     * @param $name
     * @return mixed
     */
    function __isset($name);
    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    function __set($name, $value);

    /**
     * @param $name
     * @return mixed
     */
    function __unset($name);
}
