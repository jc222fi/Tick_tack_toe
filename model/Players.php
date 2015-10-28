<?php

namespace model;

require_once("model/Player.php");

class Players{
    private $players = array();

    public function addPlayer(Player $player){
        $this->players[$player->getName()] = $player;
    }
    public function getPlayerByName($playerName){
        if(isset($this->players[$playerName])){
            return $this->players[$playerName];
        }
        return null;
    }
}