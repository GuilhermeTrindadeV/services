<?php 

namespace Src\Models; 

use DateTime;
use Src\Exceptions\ValidationException; 
use Src\Models\Model; 

class UserTypes extends Model   
{ 
    protected static $tableName = "tipo_usuario"; 
    protected static $primaryKey = "tip_usu_id"; 
    protected static $columns = [
        "tip_nome", 
        "tip_nome_plural", 
        "tip_data_c", 
        "tip_data_m" 
    ];
    
    protected static $required = [
        "tip_nome", 
        "tip_nome_plural", 
        "tip_data_c", 
        "tip_data_m" 
    ]; 

    public function save(): bool  
    { 
        $this->tip_data_c = $this->tip_data_c  
            ? (new DateTime($this->tip_data_c))->format("Y-m-d H:i")
            : date("Y-m-d H:i"); 
        $this->tip_data_m = date("Y-m-d H:i"); 

        $this->validate(); 
        return parent::save(); 
    } 

    private function validate()  
    { 
        $errors = []; 

        if(!$this->tip_nome) { 
            $errors["tip_nome"] = "O Tipo do Usúario é obrigatório!"; 
        } 

        if(!$this->tip_nome_plural) { 
            $errors["tip_nome_plural"] = "O Usúario no Plural é obrigatório!"; 
        } 

        if(!$this->tip_data_c) { 
            $errors["tip_data_c"] = "A Data de Criação é obrigatória!"; 
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->tip_data_c)) { 
            $errors["tip_data_c"] = "O formato de data precisa ser dd/mm/aaaa hh:mm."; 
        } 

        if(!$this->tip_data_m) { 
            $errors["tip_data_m"] = "A Data de Modificação é obrigatória!"; 
        } elseif(!DateTime::createFromFormat("Y-m-d H:i", $this->tip_data_m)) { 
            $errors["tip_data_m"] = "O formato de data precisa ser dd/mm/aaaa hh:mm."; 
        } 
        
        if(count($errors) > 0) { 
            throw new ValidationException($errors); 
        } 
    } 
}