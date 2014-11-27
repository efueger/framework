<?php
/**
 *
 */

//demo calling specific service methods
return [
    'blog:create' => [
        ['@Blog\Controller\Validate'],
        ['@Blog\Controller\Add'],
        ['@Blog\Controller\Respond']
    ]
] + include __DIR__ . '/../../config/event.php';
