<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Composer Autoloader
require_once __DIR__ . '/../src/Core/Container/ServiceContainer.php';
require_once __DIR__ . '/../src/Core/Router/Router.php';

use App\Core\Container\ServiceContainer;
use App\Core\Router\Router;

$container = new ServiceContainer();

$container->bind('database', function() {
    require_once __DIR__ . '/../src/Core/Database/Connection.php';
    return new Database();
});

$router = new Router($container);

// Register routes
require_once __DIR__ . '/../routes/web.php';

return $router;