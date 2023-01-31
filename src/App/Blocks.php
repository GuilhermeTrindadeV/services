<?php

namespace Src\App;

use DateTime;
use Exception;
use League\Plates\Engine;
use ReflectionClass;

use Src\Models\User;
use Src\Models\Block;
use Src\Exceptions\AppException;
use Src\App\Controller;

class Blocks extends Controller 
{
    public function block() 
    {
        $session = getUserSession(); 

        session_start();

        $blocks = Block::get();
        if($blocks) {
            foreach($blocks as $block) {
                $block->blo_data_c = (new DateTime($block->blo_data_c))->format("d/m/Y H:i");
                $block->blo_data_m = (new DateTime($block->blo_data_m))->format("d/m/Y H:i");
            }
        }

        $this->renderView('block', [
            "blocks" => $blocks,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function get(array $data) 
    {
        $user = getUserSession();

        $blockData = [];
        try {
            if(isset($data['block_id'])) {
                $dbBlock = Block::getOne([
                    'blo_id' => $data['block_id']
                ]);
                if(!$dbBlock) {
                    addErrorMsg('Nenhum Bloqueio foi encontrado!');
                    $this->redirectTo("bloqueios");
                    exit();
                }
                
                $blockData = $dbBlock->getValues();
                $saveBlockURL = $this->getRoute("blocks.update", [
                    "block_id" => $data["block_id"]
                ]);
            } else {
                $saveBlockURL = $this->getRoute("blocks.store");
            }
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
        }

        $this->renderView("save-block", $blockData + [
            "saveBlockURL" => $saveBlockURL,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function save(array $data) 
    {
        $user = getUserSession();

        $blockData = [];
        try {
            if(isset($data['block_id'])) {
                $dbBlock = Block::getOne([
                    'blo_id' => $data['block_id']
                ]);
                if(!$dbBlock) {
                    addErrorMsg('Nenhum Bloqueio foi encontrado!');
                    $this->redirectTo("bloqueios");
                    exit();
                }
                
                $saveBlockURL = $this->getRoute("blocks.update", [
                    "block_id" => $data["block_id"]
                ]);
            } else {
                $dbBlock = new Block();
                $saveBlockURL = $this->getRoute("blocks.store");
            }

            $dbBlock->setValues([
                "blo_usu_id" => $user->id,
                "blo_data_inicio" => $data["blo_data_inicio"],
                "blo_data_termino" => $data["blo_data_termino"],
                "blo_motivo" => $data["blo_motivo"]
            ]);
            $dbBlock->save();

            $startDate = (new DateTime($dbBlock->blo_data_inicio))->format("d/m/Y");
            $this->addMsg("O Bloqueio para o dia \"{$startDate}\" foi salvo com sucesso!");
            $this->redirectTo("bloqueios/{$dbBlock->blo_id}");
        } catch(Exception $e) {
            addErrorMsg($e->getMessage());
            $errors = $this->getFormErrors($e);
        } finally {
            $blockData = $data;
        }

        $this->renderView("save-block", $blockData + [
            "errors" => $errors,
            "saveBlockURL" => $saveBlockURL,
            "items" => $this->addLeftMenu()
        ]);
    }

    public function delete(array $data)
    {
        $user = getUserSession();
        
        try {
            $dbBlock = Block::getOne([
                'blo_id' => $data['block_id']
            ]);
            if(!$dbBlock) {
                addErrorMsg("Nenhum Bloqueio foi encontrado!");
                $this->redirectTo("bloqueios");
                exit();
            }

            $dbBlock->destroy();
            $startDate = (new DateTime($dbBlock->blo_data_inicio))->format("d/m/Y");
            $this->addMsg("O Bloqueio do dia \"{$startDate}\" foi excluído com sucesso");
            $this->redirectTo("bloqueios");
            exit();
        } catch(Exception $e) {
            AddErrorMsg($e->getMessage());
        }
    }
}