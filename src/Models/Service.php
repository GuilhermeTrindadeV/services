<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;
use Src\Models\User;

class Service extends Model  
{
    protected static $tableName = "culto";
    protected static $primaryKey = "cult_id";
    protected static $columns = [
        "cult_usu_criador",
        "cult_nome",
        "cult_tipo",
        "cult_data_inicio",
        "cult_hora_inicio",
        "cult_data_termino",
        "cult_hora_termino",
        "cult_data_c",
        "cult_data_m"
    ];
    
    protected static $required = [
        "cult_usu_criador",
        "cult_nome",
        "cult_tipo",
        "cult_data_inicio",
        "cult_hora_inicio",
        "cult_data_termino",
        "cult_hora_termino",
        "cult_data_c",
        "cult_data_m"
    ];
    public $user;

    public function save(): bool 
    {
        $this->cult_data_c = $this->cult_data_c 
            ? (new DateTime($this->cult_data_c))->format("Y-m-d H:i") 
            : date("Y-m-d H:i");
        $this->cult_data_m = date("Y-m-d H:i");

        $this->validate();
        return parent::save();
    }

    public function user(string $columns = '*'): ?User
    {
        $this->user = User::getById($this->cult_usu_criador, $columns);
        return $this->user;
    }

    private function validate() 
    {
        $errors = [];

        if(!$this->cult_usu_criador) {
            $errors["cult_usu_criador"] = "Informe o usuário que criou o culto, por favor.";
        }

        if(!$this->cult_nome) {
            $errors["cult_nome"] = "Informe o nome do culto, por favor.";
        }

        if(!$this->cult_tipo) {
            $errors["cult_tipo"] = "O Tipo de Culto é Obrigatório";
        }

        if(!$this->cult_data_inicio) {
            $errors["cult_data_inicio"] = "A Data de início do culto é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d", $this->cult_data_inicio)) {
            $errors["cult_data_inicio"] = "O formato de data precisa ser dd/mm/aaaa";
        }

        if(!$this->cult_hora_inicio) {
            $errors["cult_hora_inicio"] = "A Hora de início do culto é obrigatória!";
        } elseif(!DateTime::createFromFormat("H:i", $this->cult_hora_inicio)) {
            $errors["cult_hora_inicio"] = "O formato de data precisa ser hh:mm.";
        }

        if(!$this->cult_data_termino) {
            $errors["cult_data_termino"] = "A Data de término do culto é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d", $this->cult_data_termino)) {
            $errors["cult_data_termino"] = "O formato de data precisa ser dd/mm/aaaa";
        }

        if(!$this->cult_hora_termino) {
            $errors["cult_hora_termino"] = "A Hora de término do culto é obrigatória!";
        } elseif(!DateTime::createFromFormat("H:i", $this->cult_hora_termino)) {
            $errors["cult_hora_termino"] = "O formato de data precisa ser hh:mm.";
        }

        if(!$this->cult_data_c) {
            $errors["cult_data_c"] = "A Data de Criação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->cult_data_c)) {
            $errors["cult_data_c"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }

        if(!$this->cult_data_m) {
            $errors["cult_data_m"] = "A Data de Modificação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->cult_data_m)) {
            $errors["cult_data_m"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }
        
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}