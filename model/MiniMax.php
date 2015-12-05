<?php

namespace model;

class MiniMax{
    const DEFAULT_MIN = -10000;
    const DEFAULT_MAX = 10000;

    private function score($winner, $depth){
        if($winner == null){
                return 0;
            }
        else if($winner->getSign() == "X"){
            return 10-$depth;
        }
        else{
            return $depth-10;
        }
    }
    public function miniMax($board, $winner, $depth, $maximizingPlayer){
        if($winner != null || $depth == 0){
            return $this->score($winner, $depth);
        }
        //var_dump($board->getAvailableBoxes());
        $possibleGames = array();
        $scores = array();
        $moves = array();

        foreach($board->getAvailableBoxes() as $i => $move){
            $temp = $board->futurePossibleBoard($move);
            array_push($moves, $this->miniMax($temp, $winner,$depth));
        }
        var_dump($moves);
        /*$newGameModel = new GameModel($gm->getPlayers());
        foreach ($moves as &$move) {
            $newGameModel->updateBoard($move, false);
            $currentBoard = $newGameModel->getBoard();
            var_dump($currentBoard);
            //array_push($possibleGames, $newGameModel);
        }*/

        /*if($maximizingPlayer){
            $bestValue = self::DEFAULT_MIN;
            foreach($possibleGames as $game){
                $value = $this->miniMax($game, $winner, $depth-1, false);
                $bestValue = max($bestValue, $value);
            }
            return $bestValue;
        }
        else {
            $bestValue = self::DEFAULT_MAX;
            foreach($possibleGames as $game){
                $value = $this->miniMax($game,$winner, $depth-1, true);
                $bestValue = min($bestValue, $value);
            }
            return $bestValue;
        }*/
    }
}