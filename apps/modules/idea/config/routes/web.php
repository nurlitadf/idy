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

$router->addGet('/idea/rate/{ideaId}',[
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'rateView'
]);

$router->addPost('/idea/rate',[
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'rate',
]);

$router->addGet('/idea/vote/{ideaId}',[
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'vote',
]);