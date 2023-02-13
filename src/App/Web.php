<?php

namespace Src\App;

use DateTime;
use Exception;

use League\Plates\Engine;
use ReflectionClass;
use Src\Models\User;
use Src\Models\Service;
use Src\Exceptions\AppException;
use Src\App\Template1;
use Src\Support\Email;

class Web extends Template1 
{
    public function home() 
    {
        $this->setTemplate();
        $session = getUserSession(); 
        if(!$session) {
            addErrorMsg("Você precisa estar logado para acessar a Página Principal");
            $this->redirectTo("login");
            exit();
        }

        $services = Service::get();

        $this->renderView("home", [
            "services" => $services
        ]);
    }   

    public function login(array $data) 
    {
        $user = getUserSession(); 

        if($user) { 
            $this->redirectTo("inicio"); 
            exit(); 
        }

        try {

            if(isset($data["login_email"])) {
                if(!$data["login_email"]) {
                    $this->throw("Você precisa digitar um e-mail!");
                }

                if(!$data["login_senha"]) {
                    $this->throw("Você precisa digitar uma senha!");
                }

                $dbUser = User::getOne([
                    "email" => $data["login_email"]
                ]);
                
                if(!$dbUser) {
                    $this->throw("Este e-mail não corresponde à nenhum usuário!");
                }

                if(!password_verify($data["login_senha"], $dbUser->senha)) {
                    $this->throw("A senha está incorreta!");
                }
                
                $this->setUserSession($dbUser); 

                $this->addMsg("Seja bem-vindo! {$dbUser->nome}"); 
                $this->redirectTo("inicio"); 
                exit();
            } 
        } catch(Exception $e) {
            addErrorMsg($e->getMessage()); 
        } 

        $this->renderView("login", [
            
        ]); 
    }

    public function logout() 
    {
        session_start();
        session_destroy();
        $this->redirectTo("login");
    }

    public function sendToLeader(array $data)
    {
        $callback = [];
        $user = getUserSession(); 

        $email = new Email();
        $email->add(
            $data['assunto'], $data['mensagem'], 'Guilherme', 'guiviveiro@gmail.com'
        )->send($user->nome, $user->email);

        if($email->error()) {
            $callback['error'] = $email->error()->getMessage();
        } else {
            $callback['success'] = 'Seu E-mail foi enviado com sucesso';
        }

        echo json_encode($callback);
    }
}