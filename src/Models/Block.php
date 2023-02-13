<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;
use Src\Models\User;

class Block extends Model  
{
    protected static $tableName = "bloqueio";
    protected static $primaryKey = "blo_id";
    protected static $columns = [
        "blo_usu_id",
        "blo_data_inicio",
        "blo_data_termino",
        "blo_motivo",
        "blo_data_c",
        "blo_data_m"
        
    ];
    
    protected static $required = [
        "blo_usu_id",
        "blo_data_inicio",
        "blo_data_termino",
        "blo_motivo",
        "blo_data_c",
        "blo_data_m"
    ];
    public $user; 

    public function save(): bool 
    {
        $this->blo_data_c = $this->blo_data_c 
            ? (new DateTime($this->blo_data_c))->format("Y-m-d H:i") 
            : date("Y-m-d H:i");
        $this->blo_data_m = date("Y-m-d H:i");

        $this->validate();
        return parent::save();
    }

    public function user(string $columns = '*'): ?User
    {
        $this->user = User::getById($this->blo_usu_id, $columns);
        return $this->user;
    }

    // Validar Campos
    private function validate() 
    {
        $errors = [];
        
        if(!$this->blo_motivo) {
            $errors["blo_motivo"] = "Informe o motivo do bloqueio, por favor!";
        }

        if(!$this->blo_data_inicio) {
            $errors["blo_data_inicio"] = "A Data de Início é obrigatória!";
        }

        if(!$this->blo_data_termino) {
            $errors["blo_data_termino"] = "A Data de Termino é obrigatória!";
        }
        
        if(!$this->blo_data_c) {
            $errors["blo_data_c"] = "A Data de Criação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->blo_data_c)) {
            $errors["blo_data_c"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }

        if(!$this->blo_data_m) {
            $errors["blo_data_m"] = "A Data de Modificação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->blo_data_m)) {
            $errors["blo_data_m"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }
        
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}