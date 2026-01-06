<?php
require_once __DIR__ . '/../src/Core/Container/ServiceContainer.php';
require_once __DIR__ . '/../src/Core/Router/Router.php';

use App\Core\Container\ServiceContainer;
use App\Core\Router\Router;

$container = new ServiceContainer();
$router = new Router($container);

// Register routes
$router->get('/', 'App\Modules\Forum\Controllers\HomeController@index');
$router->get('/search', 'App\Modules\Forum\Controllers\SearchController@index');
$router->get('/login', 'App\Modules\Auth\Controllers\LoginController@index');

return $router;