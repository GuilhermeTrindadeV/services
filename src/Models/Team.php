<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;
use Src\Models\TeamUser;
use Src\Models\User;

class Team extends Model  
{
    protected static $tableName = "equipe";
    protected static $primaryKey = "equi_id";
    protected static $columns = [
        "equi_nome",
        "equi_usu_criador",
        "equi_lider",
        "equi_data_c",
        "equi_data_m"
    ];
    
    protected static $required = [
        "equi_nome",
        "equi_usu_criador",
        "equi_lider",
        "equi_data_c",
        "equi_data_m"
    ];
    public $users = [];

    public function save(): bool 
    {
        $this->equi_data_c = $this->equi_data_c 
            ? (new DateTime($this->equi_data_c))->format("Y-m-d H:i")
            : date("Y-m-d H:i");
        $this->equi_data_m = date("Y-m-d H:i");

        $this->validate();
        return parent::save();
    }

    public function users(string $columns = '*'): ?array
    {
        $pivots = TeamUser::get(['eq_usu_eq_id' => $this->equi_id]);
        if($pivots) {
            $ids = [];
            foreach($pivots as $pivot) {
                $ids[] = $pivot->eq_usu_usu_id;
            }

            $in = implode(',', $ids);
            $this->users = User::get(['raw' => "id IN ({$in})"]);
            return $this->users;
        }
        return null;
    }

    private function validate() 
    {
        $errors = [];

        if(!$this->equi_nome) {
            $errors["equi_nome"] = "O Nome da Equipe é obrigatório!";
        }

        if(!$this->equi_lider) {
            $errors["equi_lider"] = "O Lider da Equipe é obrigatório!";
        }

        if(!$this->equi_data_c) {
            $errors["equi_data_c"] = "A Data de Criação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->equi_data_c)) {
            $errors["equi_data_c"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }

        if(!$this->equi_data_m) {
            $errors["equi_data_m"] = "A Data de Modificação é obrigatória!";
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->equi_data_m)) {
            $errors["equi_data_m"] = "O formato de data precisa ser dd/mm/aaaa hh:mm.";
        }
        
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}