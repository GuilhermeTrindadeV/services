<?php

namespace Src\App;

use DateTime;
use Exception;

use League\Plates\Engine;
use ReflectionClass;
use Src\Models\User;
use Src\Models\UserTypes;
use Src\Exceptions\AppException;
use Src\App\Template1;

class AUserTypes extends Template1
{
    public function userTypes() 
    {
        $this->setTemplate();
        $user = getUserSession();
        if(!$user) {
            addErrorMsg("Você precisa estar logado para acessar essa área!");
            $this->redirectTo("inicio");
            exit();
        } elseif(!$user->isAdmin()) {
            addErrorMsg("Você precisa de permissão de Administrador para entrar!");
            $this->redirectTo("inicio");
            exit();
        } 
        
        $userTypes = UserTypes::get();
        if($userTypes) {
            foreach($userTypes as $userType) {
                $userType->tip_data_c = (new DateTime($userType->tip_data_c))->format("d/m/Y H:i");
                $userType->tip_data_m = (new DateTime($userType->tip_data_m))->format("d/m/Y H:i");
            }
        }

        $this->renderView("userTypes", [
            "userTypes" => $userTypes,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function get(array $data) 
    {

        $user = getUserSession();
        if(!$user) {
            addErrorMsg("Você precisa estar logado para acessar essa área!");
            $this->redirectTo("inicio");
            exit();
        } elseif(!$user->isAdmin()) {
            addErrorMsg("Você precisa de permissão de Administrador para entrar!");
            $this->redirectTo("inicio");
            exit();
        } 

        session_start();
        $userTypeData = [];
        try {
            if(isset($data["user_types_id"])) {
                $dbUserType = UserTypes::getOne([
                    "tip_usu_id" => $data["user_types_id"]
                ]);
                if(!$dbUserType) {
                    addErrorMsg("Nenhum Tipo de Usuário foi encontrado");
                    $this->redirectTo("tipo-de-usuarios");
                    exit();
                }

                $userTypeData = $dbUserType->getValues();
                $saveTypeURL = $this->getRoute("userTypesCRUD.update", [
                    "user_types_id" => $data["user_types_id"]
                ]);
            } else {
                $saveTypeURL = $this->getRoute("userTypesCRUD.store");
            }
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }

        $this->renderView("save-user-type", $userTypeData + [
            "saveTypeURL" => $saveTypeURL,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function save(array $data) 
    {

        $user = getUserSession();
        if(!$user) {
            addErrorMsg("Você precisa estar logado para acessar essa área!");
            $this->redirectTo("inicio");
            exit();
        } elseif(!$user->isAdmin()) {
            addErrorMsg("Você precisa de permissão de Administrador para entrar!");
            $this->redirectTo("inicio");
            exit();
        } 

        session_start();
        $userTypeData = [];
        try {
            if(isset($data["user_types_id"])) {
                $dbUserType = UserTypes::getOne([
                    "tip_usu_id" => $data["user_types_id"]
                ]);
                if(!$dbUserType) {
                    addErrorMsg("Nenhum Tipo de Usuário foi encontrado");
                    $this->redirectTo("tipo-de-usuarios");
                    exit();
                }

                $saveTypeURL = $this->getRoute("userTypesCRUD.update", [
                    "user_types_id" => $data["user_types_id"]
                ]);
            } else {
                $dbUserType = new UserTypes();
                $saveTypeURL = $this->getRoute("userTypesCRUD.store");
            }

            $dbUserType->setValues([
                "tip_nome" => $data["tip_nome"], 
                "tip_nome_plural" => $data["tip_nome_plural"],
            ]);
            $dbUserType->save();

            $this->addMsg("O Usuário \"{$dbUserType->tip_nome}\" foi salvo com sucesso!");
            $this->redirectTo("tipo-de-usuarios/{$dbUserType->tip_usu_id}");
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
            $errors = $this->getFormErrors($e);
        } finally {
            $userTypeData = $data;
        }

        $this->renderView("save-user-type", $userTypeData + [
            "errors" => $errors,
            "saveTypeURL" => $saveTypeURL
        ]);
    }
    
    public function delete(array $data) 
    {

        $user = getUserSession();
        if(!$user) {
            addErrorMsg("Você precisa estar logado para acessar essa área!");
            $this->redirectTo("inicio");
            exit();
        } elseif(!$user->isAdmin()) {
            addErrorMsg("Você precisa de permissão de Administrador para entrar!");
            $this->redirectTo("inicio");
            exit();
        } 

        session_start();

        try {
            $dbUserType = UserTypes::getOne([
                "tip_usu_id" => $data["user_types_id"]
            ]);
            if(!$dbUserType) {
                addErrorMsg("Nenhum Usuário foi encontrado!");
                $this->redirectTo("tipo-de-usuarios");
                exit();
            }

            $dbUserType->destroy();
            $this->addMsg("O Usuário \"{$dbUserType->tip_nome}\" foi excluido com sucesso");
            $this->redirectTo("tipo-de-usuarios");
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }
    }
}