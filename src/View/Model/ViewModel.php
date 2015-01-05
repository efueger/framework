<?php
/**
 *
 */

namespace Framework\View\Model;

use Countable;
use Framework\Config\Configuration;
use Iterator;

interface ViewModel
    extends Configuration, Countable, Iterator
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
     * @param string|self $model
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
