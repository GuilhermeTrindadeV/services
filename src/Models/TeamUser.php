<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;

class TeamUser extends Model  
{
    protected static $tableName = "equipe_usuario";
    protected static $primaryKey = "eq_usu_id";
    protected static $columns = [
        "eq_usu_eq_id",
        "eq_usu_usu_id"
        
    ];
    
    protected static $required = [
        "eq_usu_eq_id",
        "eq_usu_usu_id"
    ];
}