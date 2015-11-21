<?php

namespace model;

class Winner{
    private $winner;

    public function checkWinner($box, Player $player){
        if(($this->playerInARow($box, $player))||
            ($this->playerInAColumn($box, $player))||
            ($this->playerDiagonal($box, $player))) {
            $this->winner = $player;
        }
    }
    public function getWinner(){
        return $this->winner;
    }
    private function playerInARow($box, Player $player){
        if(($box[0] == $player->getSign() && $box[1] == $player->getSign() && $box[2] == $player->getSign())||
            ($box[3] == $player->getSign() && $box[4] == $player->getSign() && $box[5] == $player->getSign())||
            ($box[6] == $player->getSign() && $box[7] == $player->getSign() && $box[8] == $player->getSign())){
            return true;
        }
        return false;
    }
    private function playerInAColumn($box, Player $player){
        if(($box[0] == $player->getSign() && $box[3] == $player->getSign() && $box[6] == $player->getSign())||
            ($box[1] == $player->getSign() && $box[4] == $player->getSign() && $box[7] == $player->getSign())||
            ($box[2] == $player->getSign() && $box[5] == $player->getSign() && $box[8] == $player->getSign())){
            return true;
        }
        return false;
    }
    private function playerDiagonal($box, Player $player){
        if(($box[0] == $player->getSign() && $box[4] == $player->getSign() && $box[8] == $player->getSign())||
            ($box[2] == $player->getSign() && $box[4] == $player->getSign() && $box[6] == $player->getSign())){
            return true;
        }
        return false;
    }
}