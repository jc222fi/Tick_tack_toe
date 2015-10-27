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

        for($i = 0; $i <=8; $i++){
            $ret2 .= "<input type='text' name='box". $i ."' value=''/>";
            if($i==2 || $i==5 || $i==8){
                $ret2 .="<br>";
            }
        }
		$ret3= "    <input type='submit' name='submit' value='Submit'/>
                </form>";
        return $ret . $ret2 . $ret3;
    }
    public function submitForm(){
        if(isset($_POST["submit"])){
            return true;
        }
        return false;
    }
}