<?php

namespace view;

class GameView{
    private $gameBoard;

    public function __construct(\model\Board $gameBoard){
        $this->gameBoard = $gameBoard;
    }
    public function generateGameBoard(){
        $ret = "<form id='gameBoard' method='post' >";
        $ret2 = "";
        $inputBox = $this->getInputBox();
        for($i = 1; $i <= 3; $i++){
            $ret2 .= "<div id='row". $i ."'>$inputBox</div>";
        }

		$ret3= "    <input type='submit' name='submit' value='Submit'/>
                </form>";
        return $ret . $ret2 . $ret3;
    }
    private function getInputBox(){
        $ret= "";
        for($i=1;$i<=3;$i++){
            $ret .= "<input type='text' name='column". $i ."' value=''/>";
        }
        return $ret;
    }
}