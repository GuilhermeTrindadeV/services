<?php

namespace Src\App;

use Src\App\Controller;

class Template1 extends Controller
{
    protected function setTemplate(): void
    {
        $this->view->addData([
            "left" => [
                "items" => $this->addLeftMenu()
            ],
        ]);
    }

    protected function addLeftMenu(): array 
    {
        
        return [
            ["url" => url("inicio"), "name" => "Página Principal"],
            ["url" => url("usuarios"), "name" => "Lista de Usuários"],
            ["url" => url("tipo-de-usuarios"), "name" => "Tipos de Usuários"],
            ["url" => url("equipes"), "name" => "Equipes"],
            ["url" => url("musicas"), "name" => "Listas de Músicas"],
            ["url" => url("cultos"), "name" => "Cultos"],
            ["url" => url("tipos-de-culto"), "name" => "Tipos de Cultos"],
            ["url" => url("bloqueios"), "name" => "Bloqueios"]
        ];
    }
}