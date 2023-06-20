<?php

namespace Src\Models;

use DateTime;
use Src\Exceptions\ValidationException;
use Src\Models\Model;

class ServiceSong extends Model  
{
    protected static $tableName = "culto_musica";
    protected static $primaryKey = "cult_mus_id";
    protected static $columns = [
        "cult_id",
        "mus_id",
        "position"
    ];
    
    protected static $required = [
        "cult_id",
        "mus_id",
        "position"
    ];
}