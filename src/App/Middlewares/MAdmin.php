<?php

namespace Src\App\Middlewares;

use Coffeecode\Router\Router;

class MAdmin 
{
    public function handle(Router $router): bool
    {
        $user = getUserSession();
        if(!$user || !$user->isAdmin()) {
            addErrorMsg('Você precisa estar autenticado como Administrador para acessar essa área!');
            header('Location: ' . $router->route('web.login'));
            exit();
            return false;
        }

        return true;
    }
}