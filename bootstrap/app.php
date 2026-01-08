<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Compose Autoloader
require_once __DIR__ . '/../src/Core/Container/ServiceContainer.php';
require_once __DIR__ . '/../src/Core/Router/Router.php';
require_once __DIR__ . '/../src/Core/Database/Connection.php';

use App\Core\Container\ServiceContainer;
use App\Core\Router\Router;
use App\Core\Database\Connection;

$container = new ServiceContainer();

$container->bind('database', function() {
    return Connection::getInstance();
});

$router = new Router($container);

// Register routes
require_once __DIR__ . '/../routes/web.php';

return $router;