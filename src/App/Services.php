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

class Services extends Controller 
{
    public function service() 
    {
        $user = getUserSession();

        $serviceTypes = ServiceTypes::get();
        $services = Service::get();

        if($serviceTypes) {
            $serviceTypes = ServiceTypes::getMappedObjects($serviceTypes, "tip_culto_id");
        }

        if($services) {
            foreach($services as $service) {
                $service->service_type_name = $serviceTypes[$service->cult_tipo]->tip_culto_nome;
            }
        }

        if($services) {
            foreach($services as $service) {
                $service->cult_data_c = (new DateTime($service->cult_data_c))->format("d/m/Y H:i");
                $service->cult_data_m = (new DateTime($service->cult_data_m))->format("d/m/Y H:i");
            }
        }


        $this->renderView("service", [
            "services" => $services,
            "serviceTypes" => $serviceTypes,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function get(array $data)
    {
        $user = getUserSession();

        $serviceData = [];
        try {
            $serviceTypes = ServiceTypes::get();
            if(isset($data['services_id'])) {
                $dbService = Service::getOne([
                    "cult_id" => $data['services_id']
                ]);
                if(!$dbService) {
                    addErrorMsg("O Culto não foi encontrado!");
                    $this->redirectTo("cultos");
                    exit();
                }

                $serviceData = $dbService->getValues();
                $saveServiceURL = $this->getRoute("services.update", [
                    "services_id" => $data['services_id']
                ]);
            } else {
                $saveServiceURL = $this->getRoute("services.store");
            }
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }
        $this->renderView("save-service", $serviceData + [
            "saveServiceURL" => $saveServiceURL,
            "serviceTypes" => $serviceTypes,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function save(array $data)
    {
        $user = getUserSession();

        $serviceData = [];
        try {
            $serviceTypes = ServiceTypes::get();
            if(isset($data['services_id'])) {
                $dbService = Service::getOne([
                    "cult_id" => $data['services_id']
                ]);
                if(!$dbService) {
                    addErrorMsg("O Culto não foi encontrado!");
                    $this->redirectTo("cultos");
                    exit();
                }

                $serviceData = $dbService->getValues();
                $saveServiceURL = $this->getRoute("services.update", [
                    "services_id" => $data['services_id']
                ]);
            } else {
                $dbService = new Service();
                $saveServiceURL = $this->getRoute("services.store");
            }
            $dbService->setValues([
                "cult_usu_criador" => $user->id,
                "cult_nome" => $data["cult_nome"],
                "cult_tipo" => $data["cult_tipo"]
            ]);
            $dbService->save();

            $this->addMsg("O Culto \"{$dbService->cult_nome}\" foi salvo com sucesso!");
            $this->redirectTo("cultos/{$dbService->cult_id}");
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
            $errors = $this->getFormErrors($e);
        } finally {
            $serviceData = $data;
        }

        $this->renderView("save-service", $serviceData + [
            'errors' => $errors,
            "saveServiceURL" => $saveServiceURL
        ]);
    }

    public function delete(array $data)
    {
        $user = getUserSession();

        try {
            $dbService = Service::getOne([
                "cult_id" => $data['services_id']
            ]);
            if(!$dbService) {
                addErrorMsg("Nenhumo Culto foi encontrado!");
                $this->redirectTo("cultos");
                exit();
            }

            $dbService->destroy();

            $this->addMsg("O Culto \"$dbService->cult_nome\" foi excluído com sucesso!");
            $this->redirectTo("cultos");
            exit();
        } catch(Exception $e) {
            AddErrorMsg($e->getMessage());
        }
    }

}