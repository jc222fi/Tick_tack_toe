<?php

namespace model;

class MiniMax{

    private function score(GameModel $gm){
        if($gm->getWinner()->getSign() == "X"){
            return 10;
        }
        else if($gm->getWinner()->getSign() == "O"){
            return -10;
        }
        else{
            return 0;
        }
    }
    public function miniMax(GameModel $gm){
        $scores = array();
        $moves = array();
        $possibleGames = array();

        foreach($gm->availableMoves() as $i => $move){
            $possibleGameBoard = $gm->futurePossibleBoard($i);
            $newGameModel = new GameModel($gm->getPlayers(), $possibleGameBoard);
            array_push($possibleGames, $newGameModel);
        }

        if($gm->getPlayerTurn()->getSign() == "X"){
            foreach($possibleGames as $game){
                $this->maxValue($game);
                $game->checkWinner();
            }
        }
        else {
            foreach($possibleGames as $game){
                $this->minValue($game);
            }
        }
    }
    private function maxValue(\model\GameModel $gm){
        $score = $this->score($gm);
    }
}