<?php

namespace Src\App;

use DateTime;
use Exception;

use League\Plates\Engine;
use ReflectionClass;
use Src\Models\User;
use Src\Models\Service;
use Src\Models\ServiceTypes;
use Src\Exceptions\AppException;
use Src\App\Controller;

class ServiceTypesCRUD extends Controller 
{
    public function serviceTypes() 
    {
        $user = getUserSession();
        if(!$user) {
            addErrorMsg("Você precisa estar logado para acessar essa área!");
            $this->redirectTo("inicio");
            exit();
        } elseif(!$user->isAdmin() && !$user->isEditor()) {
            addErrorMsg("Você precisa de permissão de Administrador para entrar!");
            $this->redirectTo("inicio");
            exit();
        } 

        $serviceTypes = ServiceTypes::get();
        if($serviceTypes) {
            foreach($serviceTypes as $serviceType) {
                $serviceType->tip_culto_data_c = (new DateTime($serviceType->tip_culto_data_c))->format("d/m/Y H:i");
                $serviceType->tip_culto_data_m = (new DateTime($serviceType->tip_culto_data_m))->format("d/m/Y H:i");
            }
        }

        $this->renderView("serviceTypes", [
            "serviceTypes" => $serviceTypes,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function get(array $data) 
    {
        $user = getUserSession();

        $serviceTypesData = [];
        try {
            if(isset($data["services_types_id"])) {
                $dbServiceTypes = ServiceTypes::getOne([
                    "tip_culto_id" => $data["services_types_id"]
                ]);
                if(!$dbServiceTypes) {
                    addErrorMsg("O Tipo de Culto não foi encontrado");
                    $this->redirectTo("tipo-de-culto");
                    exit();
                }

                $serviceTypesData = $dbServiceTypes->getValues();
                $saveServiceTypesURL = $this->getRoute("serviceTypesCRUD.update", [
                    "services_types_id" => $data["services_types_id"]
                ]);
            } else {
                $saveServiceTypesURL = $this->getRoute("serviceTypesCRUD.store");
            }

        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }

        $this->renderView("save-service-type", $serviceTypesData + [
            "saveServiceTypesURL" => $saveServiceTypesURL,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function save(array $data) 
    {
        $user = getUserSession();

        $serviceTypesData = [];
        try {
            if(isset($data["services_types_id"])) {
                $dbServiceTypes = ServiceTypes::getOne([
                    "tip_culto_id" => $data["services_types_id"]
                ]);
                if(!$dbServiceTypes) {
                    addErrorMsg("O Tipo de Culto não foi encontrado");
                    $this->redirectTo("tipo-de-culto");
                    exit();
                }

                $serviceTypesData = $dbServiceTypes->getValues();
                $saveServiceTypesURL = $this->getRoute("serviceTypesCRUD.update", [
                    "services_types_id" => $data["services_types_id"]
                ]);
            } else {
                $dbServiceTypes = new ServiceTypes();
                $saveServiceTypesURL = $this->getRoute("serviceTypesCRUD.store");
            }

            $dbServiceTypes->setValues([
                "tip_culto_usuario_criador" => $user->id,
                "tip_culto_nome" => $data["tip_culto_nome"]
            ]);
            $dbServiceTypes->save();

            $this->addMsg("O Tipo de Culto \"{$dbServiceTypes->tip_culto_nome}\" foi salvo com sucesso!");
            $this->redirectTo($this->getRoute("serviceTypesCRUD.edit", [
                'services_types_id' => $dbServiceTypes->tip_culto_id
            ]));
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
            $errors = $this->getFormErrors($e);
        } finally {
            $serviceTypesData = $data;
        }

        $this->renderView("save-service-type", $serviceTypesData + [
            'errors' => $errors,
            "saveServiceTypesURL" => $saveServiceTypesURL
        ]);
    }

    public function delete(array $data) 
    {
        $user = getUserSession();

        try {
            $dbServiceTypes = ServiceTypes::getOne([
                "tip_culto_id" => $data['services_types_id']
            ]);
            if(!$dbServiceTypes) {
                addErrorMsg("Nenhumo Tipo de Culto foi encontrado!");
                $this->redirectTo("tipo-de-culto");
                exit();
            }

            $dbServiceTypes->destroy();

            $this->addMsg("O Tipo de Culto \"$dbServiceTypes->tip_culto_nome\" foi excluído com sucesso!");
            $this->redirectTo("tipo-de-culto");
            exit();
        } catch(Exception $e) {
            AddErrorMsg($e->getMessage());
        }
    }
}