<?php

$namespace = 'Idy\Idea\Controllers\Web';

$router->addGet('/idea/add',[
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'addView'
]);

$router->addPost('/idea/add',[
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'add'
]);