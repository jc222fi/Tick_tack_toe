<?php

namespace view;

class GameView{
    private $gameBoard;

    public function __construct(\model\Board $gameBoard){
        $this->gameBoard = $gameBoard;
    }
    public function generateGameBoard(){
        $rows = $this->gameBoard->getRows();
        $boxes = $this->gameBoard->getBoxes();
        $ret = "<table>";

        for($i=1;$i==$rows;$i++){
            $ret.="<tr></tr>";
        }
    }
}