<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;
use Src\Models\User;

class Song extends Model  
{
    protected static $tableName = "musica";
    protected static $primaryKey = "mus_id";
    protected static $columns = [
        "mus_usu_criador",
        "mus_nome",
        "mus_bpm",
        "mus_tom",
        "mus_data_c",
        "mus_data_m"
    ];
    protected static $required = [
        "mus_usu_criador",
        "mus_nome",
        "mus_bpm",
        "mus_tom",
        "mus_data_c",
        "mus_data_m"
    ];
    public $user;

    public function save(): bool 
    {
        $this->mus_data_c = $this->mus_data_c 
            ? (new DateTime($this->mus_data_c))->format("Y-m-d H:i") 
            : date("Y-m-d H:i");
        $this->mus_data_m = date("Y-m-d H:i");

        $this->validate();
        return parent::save();
    }

    public function user(string $columns = '*'): ?User
    {
        $this->user = User::getById($this->id, $columns);
    }

    private function validate() 
    {
        $errors = [];

        if(!$this->mus_usu_criador) {
            $errors["mus_usu_criador"] = "É necessário ter um usuário criador!";
        }

        if(!$this->mus_nome) {
            $errors["mus_nome"] = "O Nome é obrigatório!";
        }

        if(!$this->mus_bpm) {
            $errors["mus_bpm"] = "Por favor, informe o número de batidas por minuto dessa música!";
        }

        if(!$this->mus_tom) {
            $errors["mus_tom"] = "Por favor, informe um tom para essa música";
        }

        if(!$this->mus_data_c) {
            $errors["mus_data_c"] = "A Data de Criação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->mus_data_c)) {
            $errors["mus_data_c"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }

        if(!$this->mus_data_m) {
            $errors["mus_data_m"] = "A Data de Modificação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->mus_data_m)) {
            $errors["mus_data_m"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }
        
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}