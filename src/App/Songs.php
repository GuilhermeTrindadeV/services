<?php

namespace Src\App;

use DateTime;
use Exception;
use League\Plates\Engine;
use ReflectionClass;
use Src\Models\User;
use Src\Models\Song;
use Src\Exceptions\AppException;
use Src\App\Template1;

class Songs extends Template1
{
    public function songs() 
    {
        $this->setTemplate();
        $user = getUserSession();

        session_start();

        $songs = Song::get();
        if($songs) {
            foreach($songs as $song) {
                $song->mus_data_c = (new DateTime($song->mus_data_c))->format("d/m/Y H:i");
                $song->mus_data_m = (new DateTime($song->mus_data_m))->format("d/m/Y H:i");
            }
        }

        $this->renderView("songs", [
            "songs" => $songs,
            "items" => $this->addLeftMenu(),
        ]);
    }

    public function get(array $data)
    {
        $this->setTemplate();
        $user = getUserSession();

        $songData = [];
        try {
            if(isset($data['songs_id'])) {
                $dbSong = Song::getOne([
                    'mus_id' => $data['songs_id']
                ]);
                if(!$dbSong) {
                    addErrorMsg('Nenhuma Música foi encontrada!');
                    $this->redirectTo("musicas");
                    exit();
                }
                
                $songData = $dbSong->getValues();
                $saveSongURL = $this->getRoute("songs.update", [
                    "songs_id" => $data["songs_id"]
                ]);
            } else {
                $saveSongURL = $this->getRoute("songs.store");
            }
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }

        $this->renderView("save-song", $songData + [
            "saveSongURL" => $saveSongURL,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function save(array $data)
    {
        $this->setTemplate();
        $user = getUserSession();

        $songData = [];
        try {
            if(isset($data['songs_id'])) {
                $dbSong = Song::getOne([
                    'mus_id' => $data['songs_id']
                ]);
                if(!$dbSong) {
                    addErrorMsg('Nenhuma Música foi encontrada');
                    $this->redirectTo("musicas");
                    exit();
                }
                
                $saveSongURL = $this->getRoute("songs.update", [
                    "songs_id" => $data["songs_id"]
                ]);
            } else {
                $dbSong = new Song();
                $saveSongURL = $this->getRoute("songs.store");
            }

            $dbSong->setValues([
                "mus_usu_criador" => $user->id,
                "mus_nome" => $data["mus_nome"],
                "mus_bpm" => $data["mus_bpm"],
                "mus_tom" => $data["mus_tom"]
            ]);
            $dbSong->save();

            $this->addMsg("A Música \"{$dbSong->mus_nome}\" foi salva com sucesso!");
            $this->redirectTo("musicas/{$dbSong->mus_id}");
            exit();
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
            $errors = $this->getFormErrors($e);
        } finally {
            $songData = $data;
        }

        $this->renderView("save-song", $songData + [
            "errors" => $errors,
            "saveSongURL" => $saveSongURL
        ]);
    }

    public function delete(array $data)
    {
        $user = getUserSession();
        
        try {
            $dbSong = Song::getOne([
                "mus_id" => $data['songs_id']
            ]);
            if(!$dbSong) {
                addErrorMsg("Nenhuma Música foi encontrada!");
                $this->redirectTo("musicas");
                exit();
            }

            $dbSong->destroy();

            $this->addMsg("O Usuário \"$dbSong->mus_nome\" foi excluído com sucesso");
            $this->redirectTo("musicas");
            exit();
        } catch(Exception $e) {
            AddErrorMsg($e->getMessage());
        }
    }
}