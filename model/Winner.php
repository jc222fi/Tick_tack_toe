<?php

namespace model;

class Winner{
    private $winner;

    public function checkWinner(\model\Board $board, Player $player){
        if(($this->playerInARow($board, $player))||
            ($this->playerInAColumn($board, $player))||
            ($this->playerDiagonal($board, $player))) {
            //$board->clearBoard();
            $this->winner = $player;
        }
    }
    public function getWinner(){
        return $this->winner;
    }
    private function playerInARow($board, Player $player){
        $box = $board->getBoard();
        if(($box[0] == $player->getSign() && $box[1] == $player->getSign() && $box[2] == $player->getSign())||
            ($box[3] == $player->getSign() && $box[4] == $player->getSign() && $box[5] == $player->getSign())||
            ($box[6] == $player->getSign() && $box[7] == $player->getSign() && $box[8] == $player->getSign())){
            return true;
        }
        return false;
    }
    private function playerInAColumn($board, Player $player){
        $box = $board->getBoard();
        if(($box[0] == $player->getSign() && $box[3] == $player->getSign() && $box[6] == $player->getSign())||
            ($box[1] == $player->getSign() && $box[4] == $player->getSign() && $box[7] == $player->getSign())||
            ($box[2] == $player->getSign() && $box[5] == $player->getSign() && $box[8] == $player->getSign())){
            return true;
        }
        return false;
    }
    private function playerDiagonal($board, Player $player){
        $box = $board->getBoard();
        if(($box[0] == $player->getSign() && $box[4] == $player->getSign() && $box[8] == $player->getSign())||
            ($box[2] == $player->getSign() && $box[4] == $player->getSign() && $box[6] == $player->getSign())){
            return true;
        }
        return false;
    }
}