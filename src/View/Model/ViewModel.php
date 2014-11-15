<?php

namespace Framework\View\Model;

use ArrayAccess;
use Framework\Config\Configuration;

interface ViewModel
    extends Configuration, ArrayAccess
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
    function assigned();

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
}
