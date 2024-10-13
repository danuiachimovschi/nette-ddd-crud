<?php

declare(strict_types=1);

namespace YourProjectName\Core\Infrastructure\Routing;

use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList;

        $router->addRoute('', 'Dashboard:default');

        $router->addRoute('sign/up', 'Sign:up');
        $router->addRoute('sign/out', 'Sign:out');
        $router->addRoute('sign/in', 'Sign:in');

        $router->addRoute('users', 'User:index');
        $router->addRoute('users/add', 'User:create');
        $router->addRoute('users/<id>', 'User:show');
        $router->addRoute('users/<id>/edit', 'User:edit');
        $router->addRoute('users/<id>/remove', 'User:delete');

        return $router;
    }
}
