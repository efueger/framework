<?php
/**
 *
 */

return [
    'Controller\Dispatch' => [
        ['Controller\Dispatcher']
    ],
    'Controller\Exception' => [
        ['Controller\Exception\Controller']
    ],
    'Exception\View' => [
        ['Exception\Renderer']
    ],
    'Mvc' => [
        ['Mvc\Route'],
        ['Mvc\Controller'],
        ['Mvc\Layout'],
        ['Mvc\View'],
        ['Mvc\Response']
    ],
    'Response\Dispatch' => [
        ['Response\Sender']
    ],
    'Response\Exception' => [
        ['Response\Exception\Dispatch'],
        ['Response\Exception\Renderer']
    ],
    'View\Render' => [
        ['View\Renderer']
    ],
];
