<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;
use Src\Models\User;

class ServiceTypes extends Model  
{
    protected static $tableName = "tipo_culto";
    protected static $primaryKey = "tip_culto_id";
    protected static $columns = [
        "tip_culto_usuario_criador",
        "tip_culto_nome",
        "tip_culto_data_c",
        "tip_culto_data_m"
    ];
    
    protected static $required = [
        "tip_culto_usuario_criador",
        "tip_culto_nome",
        "tip_culto_data_c",
        "tip_culto_data_m"
    ];
    public $user;

    public function save(): bool 
    {
        $this->tip_culto_data_c = $this->tip_culto_data_c 
            ? (new DateTime($this->tip_culto_data_c))->format("Y-m-d H:i") 
            : date("Y-m-d H:i");
        $this->tip_culto_data_m = date("Y-m-d H:i");

        $this->validate();
        return parent::save();
    }

    public function user(string $columns = '*'): ?User
    {
        $this->user = User::getById($this->id, $columns);
        return $this->user;
    }

    private function validate() 
    {
        $errors = [];

        if(!$this->tip_culto_usuario_criador) {
            $errors["tip_culto_usuario_criador"] = "Informe o usuário que criou o tipo de culto, por favor.";
        }

        if(!$this->tip_culto_nome) {
            $errors["tip_culto_nome"] = "Informe o nome do tipo de culto, por favor.";
        }

        if(!$this->tip_culto_data_c) {
            $errors["tip_culto_data_c"] = "A Data de Criação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->tip_culto_data_c)) {
            $errors["tip_culto_data_c"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }

        if(!$this->tip_culto_data_m) {
            $errors["tip_culto_data_m"] = "A Data de Modificação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->tip_culto_data_m)) {
            $errors["tip_culto_data_m"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }
        
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}