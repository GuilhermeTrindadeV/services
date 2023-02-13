<?php

namespace Src\App;

use DateTime;
use Exception;

use League\Plates\Engine;
use ReflectionClass;
use Src\Models\Service;
use Src\Models\User;
use Src\Exceptions\AppException;
use Src\App\Template1;

class Plans extends Template1 {
    public function plans() 
    {
        $session = getUserSession(); 

        $this->renderView("plans", [
            "items" => $this->addLeftMenu(),
        ]);
    }

    public function get(array $data) 
    {
        $session = getUserSession(); 

        try {
            $service = Service::getById(intval($data['services_id']));
            if(!$service) {
                addErrorMsg('Este Culto não foi encontrado!');
                $this->redirectTo('inicio');
            }
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }

        $this->renderView("plans", [
            'service' => $service,
            "items" => $this->addLeftMenu(),
        ]);
    }  
}