<?php

namespace Src\App\Middlewares;

use CoffeeCode\Router\Router;

class MServiceTypes
{
    public function handle(Router $router): bool
    {
        $user = getUserSession();
        if(!$user) {
            addErrorMsg("Você precisa estar logado para acessar essa área!!");
            header('Location: ' . $router->route('web.login'));
            exit();
            return false;
        } elseif(!$user->isAdmin() && !$user->isEditor()) {
            addErrorMsg("Você precisa de permissão de Administrador para entrar!");
            header('Location: ' . $router->route('web.login'));
            exit();
            return false;
        }

        return true;
    }
}