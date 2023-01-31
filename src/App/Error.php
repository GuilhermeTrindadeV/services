<?php

namespace Src\App;

use Src\App\Controller;

class Error extends Controller
{
    public function main($data) 
    {
        $code = $data["error_code"];
        if($code == "404") {
            echo "Lamentamos, mas a sua página não foi encontrada!";
        } elseif($code == "405") {
            echo "O método de requisição não foi encontrado pelo sistema!";
        } elseif($code == "400") {
            echo "O arquivo de requisição não foi encontrado!";
        } elseif($code == "500") {
            echo "Ocorreu um erro no servidor";
        }
    }
}