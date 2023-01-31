<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;
use Src\Models\Service;
use Src\Models\ServiceTypes;
use Src\Models\Team;
use Src\Models\Block;
use Src\Models\Song;

class User extends Model  
{
    protected static $tableName = "usuario";
    protected static $primaryKey = "id";
    protected static $columns = [
        "nome",
        "email",
        "senha",
        "apelido",
        "token",
        "tip_usu_id",
        "data_c",
        "data_m"
    ];
    protected static $required = [
        "nome",
        "email",
        "senha",
        "apelido",
        "tip_usu_id",
        "data_c",
        "data_m"
    ];
    public $services = [];
    public $teams = [];
    public $blocks = [];
    public $serviceTypes = [];
    public $songs = [];

    public function save(): bool 
    {
        $this->data_c = $this->data_c 
            ? (new DateTime($this->data_c))->format("Y-m-d H:i")
            : date("Y-m-d H:i");
        $this->data_m = date("Y-m-d H:i");
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        $this->token = $this->token 
            ? $this->token
            : md5($this->email);

        $this->validate();
        return parent::save();
    }

    public function services(string $columns = '*'): ?array
    {
        $this->services = Service::get(['cult_usu_criador' => $this->id], $columns);
        return $this->services;
    }

    public function teams(string $columns = '*'): ?array
    {
        $pivots = TeamUser::get(['eq_usu_usu_id' => $this->id]);
        if($pivots) {
            $ids = [];
            foreach($pivots as $pivot) {
                $ids[] = $pivot->eq_usu_eq_id;
            }

            $in = implode(',', $ids);
            $this->teams = Team::get(['raw' => "equi_id IN ({$in})"]);
            return $this->teams;
        }
        return null;
    }

    public function blocks(string $columns = '*'): ?array 
    {
        $this->blocks = Block::get([
            'blo_usu_id' => $this->id
        ], $columns);
        return $this->blocks;
    }

    public function serviceTypes(string $columns = '*'): ?array
    {
        $this->serviceTypes = ServiceTypes::get([
            'tip_culto_usuario_criador' => $this->id
        ], $columns);
        return $this->serviceTypes;
    }

    public function songs(string $columns = '*'): ?array 
    {
        $this->songs = Song::get([
            'mus_usu_criador' => $this->id
        ], $columns);
        return $this->songs;
    }

    public function isAdmin(): bool 
    {
        if($this->tip_usu_id == 1) {
            return true;
        }
        return false;
    }

    public function isEditor(): bool 
    {
        if($this->tip_usu_id == 2) {
            return true;
        }
        return false;
    }

    public function isMinistry(): bool 
    {
        if($this->tip_usu_id == 3) {
            return true;
        }
        return false;
    }

    public function isViewer(): bool 
    {
        if($this->tip_usu_id == 4) {
            return true;
        }
        return false;
    }

    private function validate() 
    {
        $errors = [];

        if(!$this->nome) {
            $errors["nome"] = "O Nome é obrigatório!";
        }

        if(!$this->email) {
            $errors["email"] = "O E-mail é obrigatório!";
        }

        if(!$this->senha) {
            $errors["senha"] = "A Senha é obrigatória!";
        }

        if(!$this->apelido) {
            $errors["apelido"] = "O Apelido é obrigatório!";
        }

        if(!$this->tip_usu_id) {
            $errors["tip_usu_id"] = "O Tipo de Usuário é obrigatório!";
        }

        if(!$this->data_c) {
            $errors["data_c"] = "A Data de Criação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->data_c)) {
            $errors["data_c"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }

        if(!$this->data_m) {
            $errors["data_m"] = "A Data de Modificação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->data_m)) {
            $errors["data_m"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }
        
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}