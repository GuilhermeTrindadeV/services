<?php

namespace Src\App;

use DateTime;
use Exception;
use League\Plates\Engine;
use ReflectionClass;
use Src\Models\User;
use Src\Models\UserTypes;
use Src\Exceptions\AppException;
use Src\App\Controller;

class Users extends Controller
{
    public function users() 
    {
        $user = getUserSession();
        
        $userTypes = UserTypes::get();
        $users = User::get();
        // Mapeando os Tipos de Usuário pelo ID
        if($userTypes) {
            $userTypes = UserTypes::getMappedObjects($userTypes, "tip_usu_id");
        }
        
        if($users) {
            foreach($users as $dbUser) {
                $dbUser->user_type_name = $userTypes[$dbUser->tip_usu_id]->tip_nome;
                $dbUser->data_c = (new DateTime($dbUser->data_c))->format("d/m/Y H:i");
                $dbUser->data_m = (new DateTime($dbUser->data_m))->format("d/m/Y H:i");
            }
        }
        
        $this->renderView("users", [
            "users" => $users,
            "userTypes" => $userTypes,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function get(array $data) 
    {
        $user = getUserSession();

        $userData = [];
        try {
            $userTypes = UserTypes::get();
            if(isset($data["user_id"])) {
                $dbUser = User::getOne([
                    "id" => $data["user_id"]
                ]);
                if(!$dbUser) {
                    addErrorMsg("Nenhum Usuário foi encontrado");
                    $this->redirectTo("usuarios");
                    exit();
                }

                $userData = $dbUser->getValues();
                $saveURL = $this->getRoute("users.update", [
                    "user_id" => $data["user_id"]
                ]);
            } else {
                $saveURL = $this->getRoute("users.store");
            }
        } catch(Exception $e) {
            $this->addMsg($e->getMessage(), 'error');
        }

        $this->renderView("save-user", $userData + [
            "userTypes" => $userTypes,
            "saveURL" => $saveURL,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function save(array $data) 
    {
        $user = $this->getUserSession();

        $userData = [];
        try {
            $userTypes = UserTypes::get();
            if(isset($data["user_id"])) {
                $dbUser = User::getOne([
                    "id" => $data["user_id"]
                ]);
                if(!$dbUser) {
                    addErrorMsg("Nenhum Usuário foi encontrado");
                    $this->redirectTo("usuarios");
                    exit();
                }

                $saveURL = $this->getRoute("users.update", [
                    "user_id" => $data["user_id"]
                ]);
            } else {
                $dbUser = new User();
                $saveURL = $this->getRoute("users.store");
            }

            $dbUser->setValues([
                "nome" => $data["nome"],
                "email" => $data["email"],
                "senha" => $data["senha"],
                "apelido" => $data["apelido"],
                "tip_usu_id" => $data["tip_usu_id"]
            ]);
            $dbUser->save();

            $this->addMsg("O Usuário \"{$dbUser->nome}\" foi salvo com sucesso!");
            $this->redirectTo("usuarios/{$dbUser->id}");
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
            $errors = $this->getFormErrors($e);
        } finally {
            $userData = $data;
        }

        $this->renderView("save-user", $userData + [
            "errors" => $errors,
            "userTypes" => $userTypes,
            "saveURL" => $saveURL
        ]);
    }

    public function delete(array $data) 
    {
        $user = getUserSession();

        try {
            $dbUser = User::getOne([
                "id" => $data["user_id"]
            ]);
            if(!$dbUser) {
                addErrorMsg("Nenhum Usuário foi encontrado!");
                $this->redirectTo("usuarios");
                exit();
            }

            $dbUser->destroy();

            $this->addMsg("O Usuário \"{$dbUser->nome}\" foi excluído com sucesso!");
            $this->redirectTo("usuarios");
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }
    }
}