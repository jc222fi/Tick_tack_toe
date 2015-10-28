<?php

namespace model;

class Winner{
    private $winner;

    public function checkWinner($box){
        if(($this->playerInARow($box))||
            ($this->playerInAColumn($box))||
            ($this->playerDiagonal($box))){
            $this->winner = "X";
        }
        else if(($this->computerInARow($box))||
            ($this->computerInAColumn($box))||
            ($this->computerDiagonal($box))){
            $this->winner = "O";
        }
    }
    public function getWinner(){
        return $this->winner;
    }
    private function playerInARow($box){
        if(($box[0] == 'X' && $box[1] == 'X' && $box[2] == 'X')||
            ($box[3] == 'X' && $box[4] == 'X' && $box[5] == 'X')||
            ($box[6] == 'X' && $box[7] == 'X' && $box[8] == 'X')){
            return true;
        }
        return false;
    }
    private function playerInAColumn($box){
        if(($box[0] == 'X' && $box[3] == 'X' && $box[6] == 'X')||
            ($box[1] == 'X' && $box[4] == 'X' && $box[7] == 'X')||
            ($box[2] == 'X' && $box[5] == 'X' && $box[8] == 'X')){
            return true;
        }
        return false;
    }
    private function playerDiagonal($box){
        if(($box[0] == 'X' && $box[4] == 'X' && $box[8] == 'X')||
            ($box[2] == 'X' && $box[4] == 'X' && $box[6] == 'X')){
            return true;
        }
        return false;
    }
    private function computerInARow($box){
        if(($box[0] == 'O' && $box[1] == 'O' && $box[2] == 'O')||
            ($box[3] == 'O' && $box[4] == 'O' && $box[5] == 'O')||
            ($box[6] == 'O' && $box[7] == 'O' && $box[8] == 'O')){
            return true;
        }
        return false;
    }
    private function computerInAColumn($box){
        if(($box[0] == 'O' && $box[3] == 'O' && $box[6] == 'O')||
            ($box[1] == 'O' && $box[4] == 'O' && $box[7] == 'O')||
            ($box[2] == 'O' && $box[5] == 'O' && $box[8] == 'O')){
            return true;
        }
        return false;
    }
    private function computerDiagonal($box){
        if(($box[0] == 'O' && $box[4] == 'O' && $box[8] == 'O')||
            ($box[2] == 'O' && $box[4] == 'O' && $box[6] == 'O')){
            return true;
        }
        return false;
    }
}