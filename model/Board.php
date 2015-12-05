<?php

namespace model;

class Board{
    private $boxes = Array();
    //private static $sessionSaveLocation = "gameBoard";
    //private static $sessionSaveLocation2 = "gameBoard2";

    public function __construct(Array $boxes){
        $this->boxes = $boxes;
    }
    /*public function getBoxes($first){
        if($first){
            if (isset($_SESSION[self::$sessionSaveLocation])) {
                $this->boxes = $_SESSION[self::$sessionSaveLocation];
            }
        }
        else{
            if (isset($_SESSION[self::$sessionSaveLocation2])) {
                $this->boxes = $_SESSION[self::$sessionSaveLocation2];
            }
        }
        return $this->boxes;
    }
    public function getAvailableBoxes(){
        $boxes = $this->getBoxes(true);
        $availableMoves = array();
        for($i = 0; $i <=8; $i++)
        {
            if($boxes[$i] == ''){
                array_push($availableMoves, $i);
            }
        }
        return $availableMoves;
    }
    public function futurePossibleBoard($move){
        $newBoard = new Board($this->getBoxes(true));
        $this->makeMove($move, $newBoard);
        return $newBoard;
    }
    public function makeMove($position, Board $board){
        $board->setBoxValue($position, "O");
    }
    public function setBoxValue($position, $value){
        $this->boxes[$position] = $value;
        $this->setBoard($this->boxes, false);
    }
    public function setBoard(Array $boxes, $first){
        if ($first) {
            $_SESSION[self::$sessionSaveLocation] = $boxes;
        } else {
            $_SESSION[self::$sessionSaveLocation2] = $boxes;
        }
    }
    public function clearBoard(){
        unset($_SESSION[self::$sessionSaveLocation]);
        $this->boxes = Array('', '', '', '', '', '', '', '', '');
    }*/
}