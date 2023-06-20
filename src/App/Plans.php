<?php

namespace Src\App;

use DateTime;
use Exception;

use League\Plates\Engine;
use ReflectionClass;
use Src\Models\Service;
use Src\Models\ServiceSong;
use Src\Models\User;
use Src\Models\Song;
use Src\Exceptions\AppException;
use Src\App\Template1;

class Plans extends Template1 {
    public function plans() 
    {
        $session = getUserSession(); 

        $this->renderView("plans-list", [
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

        $songs = Song::get();
        
        $this->renderView("plan", [
            "service" => $service,
            "items" => $this->addLeftMenu(),
            "songs" => $songs
        ]);
    }  

    public function addSong(array $data)
    {
        $callback = [];
        $callback['success'] = false;
        $user = getUserSession();

        try {
            $dbService = Service::getById(intval($data['services_id']));
            if(!$dbService) {
                throw new Exception('Este culto é inexistente');
            }

            $count = ServiceSong::getCount(["cult_id" => $dbService->cult_id]);

            $dbServiceSong = new ServiceSong();
            $dbServiceSong->setValues([
                "cult_id" => $dbService->cult_id,
                "mus_id" => $data["mus_id"],
                "position" => $count + 1
            ]);
            $dbServiceSong->save();

            if($callback["success"] = true) {
                $callback['message'] = "Música adicionada com sucesso!";
            }
        } catch(Exception $e) {
            $callback['message'] = $e->getMessage();
            $callback['errors'] = $this->getFormErrors($e);
        }

        echo json_encode($callback);
    }
}