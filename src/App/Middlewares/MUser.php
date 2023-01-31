<?php

namespace Src\App\Middlewares;

use CoffeeCode\Router\Router;

class MUser 
{
    public function handle(Router $router): bool
    {
        $user = getUserSession();
        if(!$user) {
            addErrorMsg('Você precisa estar autenticado para acessar essa área!');
            header('Location: ' . $router->route('web.login'));
            exit();
            return false;
        }

        return true;
    }
}