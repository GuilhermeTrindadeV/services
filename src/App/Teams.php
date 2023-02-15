<?php

namespace Src\App;

use DateTime;
use Exception;
use League\Plates\Engine;
use ReflectionClass;
use Src\Models\User;
use Src\Models\Team;
use Src\Models\ServiceTypes;
use Src\Models\Service;
use Src\Exceptions\AppException;
use Src\App\Template1;

class Teams extends Template1 
{
    public function team() 
    {
        $this->setTemplate();
        $session = getUserSession(); 

        session_start();

        $serviceTypes = ServiceTypes::get();
        $teams = Team::get();

        if($serviceTypes) {
            $serviceTypes = ServiceTypes::getMappedObjects($serviceTypes, "tip_culto_id");
        }

        if($teams) {
            foreach($teams as $team) {
                $team->equi_data_c = (new DateTime($team->equi_data_c))->format("d/m/Y H:i");
                $team->equi_data_m = (new DateTime($team->equi_data_m))->format("d/m/Y H:i");
            }
        }

        $this->renderView('team', [
            "teams" => $teams,
            "serviceTypes" => $serviceTypes,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function get(array $data) 
    {
        $this->setTemplate();
        $user = getUserSession();

        $teamData = [];
        try {
            $users = User::get();
            if(isset($data['team_id'])) {
                $dbTeam = Team::getOne([
                    "equi_id" => $data['team_id']
                ]);
                if(!$dbTeam) {
                    addErrorMsg('Nenhuma Equipe foi encontrada!');
                    $this->redirectTo("equipes");
                    exit();
                }
                
                $teamData = $dbTeam->getValues();
                $saveTeamURL = $this->getRoute("teams.update", [
                    "team_id" => $data['team_id']
                ]);
            } else {
                $saveTeamURL = $this->getRoute("teams.store");
            }
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }

        $this->renderView("save-team", $teamData + [
            "saveTeamURL" => $saveTeamURL,
            "users" => $users,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function save(array $data) 
    {
        $this->setTemplate();
        $user = getUserSession();

        $teamData = [];
        try {
            $users = User::get();
            if(isset($data['team_id'])) {
                $dbTeam = Team::getOne([
                    'equi_id' => $data['team_id']
                ]);
                if(!$dbTeam) {
                    addErrorMsg('Nenhuma Equipe foi encontrada!');
                    $this->redirectTo("equipes");
                    exit();
                }
                
                $teamData = $dbTeam->getValues();
                $saveTeamURL = $this->getRoute("teams.update", [
                    "team_id" => $data["team_id"]
                ]);
            } else {
                $dbTeam = new Team();
                $saveTeamURL = $this->getRoute("teams.store");
            }

            $dbTeam->setValues([
                "equi_usu_criador" => $user->id,
                "equi_lider" => $data["equi_lider"],
                "equi_nome" => $data["equi_nome"]
            ]);

            $dbTeam->save();

            $this->addMsg("A Equipe \"{$dbTeam->equi_nome}\" foi salva com sucesso!");
            $this->redirectTo("equipes/{$dbTeam->equi_id}");
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
            $errors = $this->getFormErrors($e);
        } finally {
            $teamData = $data;
        }

        $this->renderView("save-team", $teamData + [
            "errors" => $errors,
            "users" => $users,
            "saveTeamURL" => $saveTeamURL
        ]);
    }

    public function delete(array $data)
    {
        $user = getUserSession();
        
        try {
            $dbTeam = Team::getOne([
                "equi_id" => $data['team_id']
            ]);
            if(!$dbTeam) {
                addErrorMsg("Nenhuma Equipe foi encontrada!");
                $this->redirectTo("equipes");
                exit();
            }

            $dbTeam->destroy();

            $this->addMsg("A Equipe \"{$dbTeam->equi_nome}\" foi excluída com sucesso");
            $this->redirectTo("equipes");
            exit();
        } catch(Exception $e) {
            AddErrorMsg($e->getMessage());
        }
    }
}